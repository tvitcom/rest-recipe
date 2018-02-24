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
class Mysql
{
    private static $instance = NULL;
    
    private static $param = [];

    private function __construct()
    {
        self::$param = [
            'host' => '127.0.0.1',
            'port' => '3306',
            'name' => 'recipe',
            'user' => 'recipe',
            'pass' => 'pass_to_recipe',
            ];
    }

    private function __clone()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PDO('mysql:host='.self::param['host'].';port='. self::$param['port'].';dbname='.self::$param['name'],
                self::$param['user'],
                self::param['pass']
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}