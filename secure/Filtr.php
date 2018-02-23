<?php

/* 
 * REST-RECIPE
 * Copyright 2018 //github.com/tvitcom. All rights reserved.

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

class Filtr
{
    public static $notice = array();
    public static $err_mesage = array();

    public static function mail($mail = '',$max=128)
    {
        //проверим почту:
        $mail = substr($mail, 0, $max);
        $regex = "/[a-z0-9-_]{2,64}\@[a-z0-9\-\_]{2,64}\.[a-z0-9]{2,6}/i";
        $mail = str_replace(' ', '', $mail); //удаление пробелов в строке (хотя RFC'ы допускают пробелы в кавычках)

        if (preg_match($regex, $mail))
            return $mail;
        else
            return;
    }

    //В строке отавляем все экранированные символы кроме тэгов
    public static function txt($str = '' , $maxlen=128)
    {
        mb_substr( $str, 0, $maxlen); // выполняем преобразование строки
        if (trim($str))
            return trim(addslashes($str));
    }

    //В строке отавляем все кроме пробелов
    public static function pwd($str = '')
    {
        $str = preg_replace('/\s\s+/', '', $str); 
        return $str;
    }

    //В строке оставляем только первую цифру
    public static function int($val = 0)
    {   
        return intval($val);
    }

    public static function onlyciphers($str = '')
    {
        return preg_replace("/[^0-9]/", '', $str);
    }
}
