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
    public static function is_user($apikey = '')
    {
        $query = Mysql::getInstance()->prepare('
            SELECT id, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM author
            WHERE api_key = :api_key limit 1
        ');
        $query->BindValue(':api_key', $apikey, PDO::PARAM_STR);
        $query->execute();
        $author = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($author['api_key'] != '') {
            return Auth::setLogin(self::selectById($author['id']));
        } else {
            return false;
        }
    }
    
    public static function selectById($id = ''){
        $query = Mysql::getInstance()->prepare('
            SELECT id, name, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM author
            WHERE id = :id
            LIMIT 1
        ');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function selectByApikey($param = ''){
        $query = Mysql::getInstance()->prepare('
            SELECT id, name, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM author
            WHERE api_key = :apikey
            LIMIT 1
        ');
        $query->bindValue(':apikey', $param['apikey'], PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function selectByEmail($param = '')
    {
        $query = MySQL::getInstance()->prepare('
            SELECT id, name, email, pass_hash, api_key, ts_create, ts_update, recover_key
            FROM author
            WHERE email = :email
            LIMIT 1
        ');
        $query->bindValue(':email', $param, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function create($data = [])
    {
        $query = Mysql::getInstance()->prepare("
            INSERT INTO author (name, email, pass_hash, api_key, ts_create, ts_update, recover_key)
            VALUES (:name, :email, :pass_hash, :api_key, :ts_create, :ts_update, :recover_key)
        ");
        //$query->bindValue(':id', '', PDO::PARAM_STR);
        $query->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $query->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $query->bindValue(':pass_hash', hash('sha256',$data['password'].Flight::get('hash_salt')), PDO::PARAM_STR);
        $query->bindValue(':api_key', hash('sha256', $data['password']), PDO::PARAM_STR);
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
    
    public static function login($post) {
//exit(Filtr::txt($_POST['email']));
        $user = self::selectByEmail(Filtr::txt($_POST['email']));
//exit('<pre>'.var_dump($user).'</pre>');
        if (empty($_POST)) {
                Flight::redirect('/page/login');
        } elseif(is_array($user) && (Auth::hash(Filtr::pwd($_POST['password'])) === $user['pass_hash'])) {
            Auth::setLogin($user);
            Flight::redirect('/page/list');
        } else {
            Flight::halt(401,'Error 401 Not authorized.');
            exit('Filtr::txt($_POST[\'email\']:'.Filtr::txt($_POST['email']).' $user[\'pass_hash\']:'.$user['pass_hash'].' Filtr::pwd($_POST[\'password\']:'.Filtr::pwd($_POST['password']));
        }
    }
    
    public static function logout($params) {
        Auth::setLogout();
        Flight::redirect('/page/login');
    }
}
