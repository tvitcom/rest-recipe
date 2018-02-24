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

// Work with REST Api:
Flight::route('GET|POST /iface_v01(/@entity(/@method(/@id)))', function($entity, $method, $id){
    $classname = ucfirst($entity);
    
    // load only entity classe;
    $fpath_model = 'models/'.$classname.'.php';
    if (file_exists($fpath_model)) {
        require $fpath_model;
        
        if (method_exists($classname,$method)) {
            if ($_SERVER['REQUEST_METHOD']==='POST' && Author::is_user($_POST['email'],$_POST['apikey']))
                Flight::set('result', $classname::{$method}($_POST));
            elseif ($_SERVER['REQUEST_METHOD']==='GET' && Author::is_user($_GET['email'],$_GET['apikey']))
                Flight::set('result', $classname::{$method}($_GET));
        } else {
            Flight::set('error','action not found');
        }
        
        /*
         * Format returned json:
         * {
         * context:string,
         * result:{},
         * error:[]
         * }
         */
        Flight::json([
            'context'=> $_SERVER['REQUEST_URI'],
            'result'=> Flight::get('result'),
//(Flight::get('result')=='') 
//                ? [
//                    'params'=> $_POST,
//                    'request-get'=> $_GET,
//                    'id' => $id,
//                    'method'=> $method,
//                    'entity'=> $entity,
//                    ]
//                : 
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
    //test only: 
    //Flight::halt(200, print_r($_REQUEST));
});

Flight::start();