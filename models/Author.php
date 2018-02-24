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
        $this->name = 'John Doe';
    }

    public static function login($email, $secret)
    {
        $query = Pgsql::getInstance()->prepare('
            SELECT id, email, pass_hash, api_key, ts_cretate, ts_update, recovery_key
            FROM author
            WHERE email=:email AND is_active=1 limit 1
        ');
        $query->BindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $author = $query->fetch(PDO::FETCH_ASSOC);
        return $author;
    }

//    public static function count()
//    {
//        $query = Pgsql::getInstance()->query("
//            SELECT count(*) as quantity
//            FROM  author
//            WHERE is_active = 1"
//        );
//        return $query->fetch(PDO::FETCH_ASSOC);
//    }

    public static function update($data = array())
    {
        if (!count($data))
            return;
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
        $query = Pgsql::getInstance()->prepare($query);
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
        $query->bindValue(':is_active', $data['is_active'], PDO::PARAM_BOOL);
        $query->execute();
    }

    public static function delete($author_id = 0)
    {
        $query = Pgsql::getInstance()->prepare("DELETE FROM author WHERE id = :id");
        $query->bindValue(':id', $author_id, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    }

    public static function create($data)
    {
        $query = Pgsql::getInstance()->prepare("
            INSERT INTO author
            VALUES (:id,:fio,:whois,:email,:passhash,:credit_card,:card_expire,
                    :sex,:photo,:rights,:t_passhash,:is_active)
        ");
        $query->bindValue(':id', '', PDO::PARAM_STR);
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
        $query->bindValue(':is_active', $data['is_active'], PDO::PARAM_BOOL);
        try
        {
            $query->execute();
            return true;
        }
        catch (PDOException $e)
        {
            echo '{"notice":"' . addslashes($e->getMessage()) . '"}';
            exit();
        };
    }

    public static function select($email = '')
    {
        if (!empty($email)) {
            $author = Pgsql::getInstance()->prepare('
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
