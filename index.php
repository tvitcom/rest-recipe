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

require 'vendor/autoload.php';

require_once 'secure/Auth.php';
require_once 'secure/Filtr.php';
require_once 'models/config.php';
//require_once 'models/pgsql.php';
require_once 'models/mysql.php';
require_once 'models/model.php';
require_once 'models/Author.php';//because is as the user class and be always accessible.

// Work with REST Api:
Flight::route('GET|POST /iface_v01(/@entity(/@method))', function($entity, $method){
    $classname = ucfirst($entity);
    
    // load only file of entity class;
    $fpath_model = 'models'.DS.$classname.'.php';
    if (file_exists($fpath_model)) {
        require_once $fpath_model;
        if (method_exists($classname, $method)) {
            $apikey_data = isset($_REQUEST['apikey'])?$_REQUEST['apikey']:'';
            if (Author::is_user($apikey_data) 
                || ($entity ==='person' && $method ==='create') 
                || $method ==='login' 
                || $method ==='logout') {
                $params = count($_GET)?$_GET:$_POST;
                Flight::set('result', $classname::{$method}($params));
            } else {
                Flight::halt(403, 'Error 403 Not authorized.');
                exit();
            }
        } else {
            Flight::halt(404,'Error 404. Page not found.');
            exit();
        }
        
        /*
         * Format returned json:
         * {
         * context:string,
         * result:string,
         * error:string
         * }
         */
        Flight::json([
            'context'=> $_SERVER['REQUEST_URI'],
            'result'=> Flight::get('result'), 
            'error'=> Flight::get('error'),
        ]);
    } else { 
        Flight::halt(404, 'Error 404. Page not found!');
    }
});

// Work with frontends pages and forms.
Flight::route('GET /page(/@name)', function($name){
    // load only stored files;
    $pagename = Flight::get('flight.views.path').DS.$name.Flight::get('flight.views.extension');
    //exit($pagename);
    if (file_exists($pagename)) {
        Flight::render($name, [
            'title' => ucfirst($name),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    } else { 
        Flight::halt(404, 'Error 404. Page not found!');
    }
});

Flight::route('/', function(){
    Flight::redirect('/page/list');
});

Flight::route('/*', function(){
    Flight::halt(404, 'Error 404. Page not found!');
});

Flight::start();