<?php

/* 
 * REST-RECIPE
 * Copyright 2018 github.com/tvitcom. All rights reserved.

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at:
 *
 *    https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License
 */

/*
 * URL:       | Method:| REST-link:
----------------------------------------
/iface_v01/   [POST]  recipe/login
/iface_v01/   [POST]  recipe/create
 * * * * * * * * * *  
/iface_v01/   [GET]   recipe/selectLast
/iface_v01/   [POST]  recipe/create
/iface_v01/   [POST]  recipe/updateOwn
/iface_v01/   [POST]  recipe/deleteOwn
 */
class Recipe 
{
    
    public function __construct() {
        return;
    }
    
    /*
     * Test is users email assign to existent user and is valid api_key or not
     * @return user id or false;
     */
    public static function is_own($own_id)
    {
        $query = self::$db->prepare('
            SELECT id, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM recipe
            WHERE id = :id limit 1
        ');
        $query->BindValue(':id', intval($own_id), PDO::PARAM_INT);
        $query->execute();
        $recipe = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($recipe['api_key'] != '') {
            return $recipe['id'];
        } else {
            return false;
        }
    }

    public static function updateOwn($data)
    {
        $own_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:Author::selectByApikey($_POST['apikey'])['id'];
        
        if (!count($data))
            return false;
        $query = "
            UPDATE recipe
            SET
                ts_create=:ts_create,
                title=:title,
                content=:content,
                picture_uri=:picture_uri,
                is_enable=:is_enable
            WHERE id = :id and author_id = :author_id
            ";
        $query = Flight::db()->prepare($query);
        $query->bindValue(':id', $data['id'], PDO::PARAM_STR);
        $query->bindValue(':author_id', $own_id, PDO::PARAM_INT);
        $query->bindValue(':ts_create', (new \DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_INT);
        $query->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $query->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $query->bindValue(':picture_uri', isset($data['picture_uri'])?$data['picture_uri']:'', PDO::PARAM_STR);
        $query->bindValue(':is_enable', 1, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();
    }

    public static function deleteOwn($params)
    {
        $own_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:Author::selectByApikey($_POST['apikey'])['id'];
        $query = Flight::db()->prepare("DELETE FROM recipe WHERE id = :id and author_id = :author_id");
        $query->bindValue(':author_id', $own_id, PDO::PARAM_INT);
        $query->bindValue(':id', $params['id'], PDO::PARAM_INT);
        $result = $query->execute();
        return $query->rowCount();
    }

    public static function create($data)
    {
        $query = Flight::db()->prepare("
            INSERT INTO recipe (author_id, ts_create, title, content, picture_uri, is_enable)
            VALUES (:author_id, :ts_create, :title, :content, :picture_uri, :is_enable)
        ");
        //$query->bindValue(':id', '', PDO::PARAM_STR);
        $query->bindValue(':author_id', $_SESSION['user_id'], PDO::PARAM_STR);
        $query->bindValue(':ts_create', time(), PDO::PARAM_INT);
        $query->bindValue(':title', Filtr::txt($data['title'],55), PDO::PARAM_STR);
        $query->bindValue(':content', Filtr::txt($data['content'],2048), PDO::PARAM_STR);
        $query->bindValue(':picture_uri', Files::uploadHandler(), PDO::PARAM_INT);
        $query->bindValue(':is_enable', 1, PDO::PARAM_INT);

        try
        {
            $query->execute();
            //return $query->lastInsertId('seq_recipe_id_integer');
            return Flight::db()->lastInsertId();
        }
        catch (PDOException $e)
        {
            Flight::set('error','{"message":"' . addslashes($e->getMessage()) . '"}');
            if (defined('WEB_DEBUG'))
                exit(Flight::get('error'));
        };
    }

    public static function selectLast($params='')
    {
        $recipe = Flight::db()->prepare('
            SELECT id, author_id, ts_create, title, content, picture_uri, is_enable
            FROM recipe
            WHERE is_enable = :is_enable
            ORDER BY ts_create DESC
            LIMIT :limit
        ');
        $recipe->bindValue(':is_enable', 1, PDO::PARAM_INT);
        $recipe->bindValue(':limit', intval(Flight::get('limit_last_list')), PDO::PARAM_INT);
        $recipe->execute();
        return $recipe->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function selectById($id)
    {
        $recipe = Flight::db()->prepare('
            SELECT id, author_id, ts_create, title, content, picture_uri, is_enable
            FROM recipe
            WHERE id = :id AND is_enable = :is_enable
            LIMIT :limit
        ');
        $recipe->bindValue(':id', $id, PDO::PARAM_INT);
        $recipe->bindValue(':is_enable', 1, PDO::PARAM_INT);
        $recipe->bindValue(':limit', intval(Flight::get('limit_last_list')), PDO::PARAM_INT);
        $recipe->execute();
        return $recipe->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function selectByAuthorId($params)
    {
        $recipe = Flight::db()->prepare('
            SELECT id, author_id, ts_create, title, content, picture_uri, is_enable
            FROM recipe
            WHERE author_id = :author_id AND is_enable = :is_enable
            LIMIT :limit
        ');
        $recipe->bindValue(':author_id', $params, PDO::PARAM_INT);
        $recipe->bindValue(':is_enable', 1, PDO::PARAM_INT);
        $recipe->bindValue(':limit', intval(Flight::get('limit_last_list')), PDO::PARAM_INT);
        $recipe->execute();
        return $recipe->fetchAll(PDO::FETCH_ASSOC);
    }
}
