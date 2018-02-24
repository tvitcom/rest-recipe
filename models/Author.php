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

class Author extends Model
{
    public function __construct() {
        return;
    }
    
    /*
     * Test is users email assign to existent user and is valid api_key or not
     * @return user id or false;
     */
    public static function is_user($email, $api_key)
    {
        $query = Mysql::getInstance()->prepare('
            SELECT id, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM author
            WHERE email=:email AND api_key = :api_key limit 1
        ');
        $query->BindValue(':email', $email, PDO::PARAM_STR);
        $query->BindValue(':api_key', $api_key, PDO::PARAM_STR);
        $query->execute();
        $author = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($author['api_key'] != '') {
            return $author['id'];
        } else {
            return false;
        }
    }

    public static function update($data)
    {
        if (!count($data))
            return false;
        $query = "
            UPDATE author
            SET (
                name=:name,
                email=:email,
                pass_hash=:pass_hash,
                api_key=:api_key,
                ts_update=:ts_update,
                recover_key=:recover_key,
            WHERE id = :id
            ";
        $query = Mysql::getInstance()->prepare($query);
        $query->bindValue(':id', $data['id'], PDO::PARAM_STR);
        $query->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $query->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->bindValue(':pass_hash', Auth::hash($data['secret']), PDO::PARAM_STR);
        $query->bindValue(':api_key', hash('sha256', $data['secret']), PDO::PARAM_STR);
        //$query->bindValue(':ts_create', time(), PDO::PARAM_INT);
        $query->bindValue(':ts_update', time(), PDO::PARAM_INT);
        $query->bindValue(':recover_key', '', PDO::PARAM_STR);
        $query->execute();
    }

//    public static function delete($author_id = 0)
//    {
//        $query = Mysql::getInstance()->prepare("DELETE FROM author WHERE id = :id");
//        $query->bindValue(':id', $author_id, PDO::PARAM_INT);
//        $result = $query->execute();
//        return $result;
//    }

    public static function create($data)
    {
        $query = Mysql::getInstance()->prepare("
            INSERT INTO author (name, email, pass_hash, api_key, ts_create, ts_update, recover_key)
            VALUES (:name, :email, :pass_hash, :api_key, :ts_create, :ts_update, :recover_key)
        ");
        //$query->bindValue(':id', '', PDO::PARAM_STR);
        $query->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $query->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->bindValue(':pass_hash', Auth::hash($data['secret']), PDO::PARAM_STR);
        $query->bindValue(':api_key', hash('sha256', $data['secret']), PDO::PARAM_STR);
        $query->bindValue(':ts_create', time(), PDO::PARAM_INT);
        $query->bindValue(':ts_update', time(), PDO::PARAM_INT);
        $query->bindValue(':recover_key', '', PDO::PARAM_STR);

        try
        {
            $query->execute();
            //return $query->lastInsertId('seq_author_id_integer');
            return Mysql::getInstance()->lastInsertId();
        }
        catch (PDOException $e)
        {
            Flight::set('error','{"message":"' . addslashes($e->getMessage()) . '"}');
            if (defined('WEB_DEBUG'))
                exit(Flight::get('error'));
        };
    }

    public static function select($identity = '')
    {
        // If $identity is email array or not (another one be int id).
        if (is_array($identity)) {
            $author = Mysql::getInstance()->prepare('
                SELECT id, name, email, pass_hash, api_key, ts_create, ts_update, recover_key
                FROM author
                WHERE email = :email
                LIMIT 1
            ');
            $author->bindValue(':email', $identity['email'], PDO::PARAM_STR);
            $author->execute();
            return $author->fetch(PDO::FETCH_ASSOC);
        } else {
            $author = Mysql::getInstance()->prepare('
                SELECT id, name, email, pass_hash, api_key, ts_create, ts_update, recover_key
                FROM author
                WHERE id = :id
                LIMIT 1
            ');
            $author->bindValue(':id', $identity, PDO::PARAM_INT);
            $author->execute();
            return $author->fetch(PDO::FETCH_ASSOC);
        }
        return;
    }
}
