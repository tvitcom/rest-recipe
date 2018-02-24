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
    public static function is_user($email, $secret)
    {
        $query = Mysql::getInstance()->prepare('
            SELECT id, email, pass_hash, api_key, ts_cretate, ts_update, recovery_key
            FROM author
            WHERE email=:email limit :limit
        ');
        $query->BindValue(':email', $email, PDO::PARAM_STR);
        $query->BindValue(':limit', 1, PDO::PARAM_INT);
        $query->execute();
        $author = $query->fetch(PDO::FETCH_ASSOC);
        if ($author['api_key'])
            return $author['id'];
        else {
            return false;
        }
    }

    public static function login($data)
    {
        $query = Mysql::getInstance()->prepare('
            SELECT id, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM author
            WHERE email=:email limit :limit
        ');
        $query->BindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->BindValue(':limit', 1, PDO::PARAM_INT);
        $query->execute();
        $author = $query->fetch(PDO::FETCH_ASSOC);
        return $author;
    }

//    public static function count()
//    {
//        $query = Mysql::getInstance()->query("
//            SELECT count(*) as quantity
//            FROM  author
//            WHERE api_key IS NOT NULL"
//        );
//        return $query->fetch(PDO::FETCH_ASSOC);
//    }

    public static function update($data)
    {
        if (!count($data))
            return false;
        $query = "
            UPDATE author
            SET (
                name=:name,
                email=:email,
                pass_hash=:passhash,
                credit_card=:credit_card,
                card_expire=:card_expire,
                t_passhash=:t_passhash,
                is_active=:is_active)
            WHERE id = :id
            ";
        $query = Mysql::getInstance()->prepare($query);
        $query->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $query->bindValue(':fio', $data['fio'], PDO::PARAM_STR);
        $query->bindValue(':whois', $data['whois'], PDO::PARAM_STR);
        $query->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->bindValue(':passhash', $data['passhash'], PDO::PARAM_STR);
        $query->bindValue(':credit_card', $data['credit_card'], PDO::PARAM_STR);
        $query->bindValue(':card_expire', $data['card_expire'], PDO::PARAM_STR);
        $query->bindValue(':sex', $data['sex'], PDO::PARAM_BOOL);
        $query->bindValue(':photo', $data['photo'], PDO::PARAM_STR);
        $query->bindValue(':rights', $data['rights'], PDO::PARAM_STR);
        $query->bindValue(':t_passhash', $data['t_passhash'], PDO::PARAM_STR);
        $query->execute();
    }

    public static function delete($author_id = 0)
    {
        $query = Mysql::getInstance()->prepare("DELETE FROM author WHERE id = :id");
        $query->bindValue(':id', $author_id, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    }

    public static function create($data)
    {
        $query = Mysql::getInstance()->prepare("
            INSERT INTO author
            VALUES (:name, :email, :pass_hash, :api_key, :ts_create, :ts_update, :recover_key)
        ");
        //-$query->bindValue(':id', '', PDO::PARAM_STR);
        $query->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $query->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->bindValue(':pass_hash', Auth::hash($data['secret']), PDO::PARAM_STR);
        $query->bindValue(':api_key', hash('sha256', $data['secret']), PDO::PARAM_STR);
        $query->bindValue(':ts_create', time(), PDO::PARAM_STR);
        $query->bindValue(':tc_update', time(), PDO::PARAM_BOOL);
        $query->bindValue(':recover_key', '', PDO::PARAM_STR);

        try
        {
            $query->execute();
            //return $query->lastInsertId('seq_author_id_integer');
            return $query->lastInsertId();
        }
        catch (PDOException $e)
        {
            Flight::set('error','{"notice":"' . addslashes($e->getMessage()) . '"}');
            exit(Flight::get('error'));
        };
    }

    public static function select($identity = '')
    {
        // If $identity is email string.
        if (is_string($identity)) {
            $author = Mysql::getInstance()->prepare('
                SELECT id, fio, whois, email, passhash, credit_card, card_expire,
                             sex, photo, rights, t_passhash, is_active
                FROM author
                WHERE email = :email
                LIMIT 1
            ');
            $author->bindValue(':email', $email, PDO::PARAM_STR);
            $author->execute();
            return $author->fetch(PDO::FETCH_ASSOC);
        }
        return;
    }
}
