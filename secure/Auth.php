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

class Auth
{
    public static function isLogged()
    {
        if (null !==@$_SESSION['user_id'])
            return $_SESSION['user_id'];
        else 
            return;
    }

    public static function setLogin($user)
    {
        if (isset($user)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['rights'] = $user['rights'];
        }
        return self::isLogged();
    }

    public static function setLogout(){
        $_SESSION = array();
        session_unset();
        session_destroy();
        session_regenerate_id(true);
        return true;
    }

    public static function hash($pass = '', $tstamp = '') {
        $tstamp = ($tstamp!=='')?$tstamp:time(); 
        if (($pass == true)){
            $half_hash = base64_encode(
                hash_hmac('sha256', $pass, $tstamp, true)
            );
            return substr($half_hash, 0, -2);
        } else
            return false;
    }

    public static function affirm($email='',$time=''){
        return md5($email.$time);
    }

    //Создаем хэш-код для проверки форм
    public static function csrf()
    {
        $is_logged = (self::isLogged())?self::isLogged():'none';
        $server_vars=$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'];
        $_SESSION['csrf'] = md5($server_vars . $is_logged . date("md"));
        return (null !== $_SESSION['csrf'])? $_SESSION['csrf']:null; 
    }
}
