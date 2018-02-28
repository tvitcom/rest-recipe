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
//$mem_start = memory_get_usage();
require 'vendor/autoload.php';

require_once 'models/config.php';//Configuration file.
require_once 'helpers/Auth.php'; //some helpers.
require_once 'helpers/Filtr.php';//yet.
require_once 'models/Author.php';//because is as the user class and be always accessible.
require_once 'controllers/Controller.php';//connnect parent controller.

if ($_SERVER['REMOTE_ADDR']===DEV_ADDR) {
    defined('WEB_DEBUG') or define('WEB_DEBUG', 'true');// Define directory separator sign.
    Flight::set('flight.log_errors', true);
    Flight::set('flight.handle_errors', true);
} else {
    defined('WEB_DEBUG') or define('WEB_DEBUG', 'false');// Define directory separator sign.
    Flight::set('flight.log_errors', false);
    Flight::set('flight.handle_errors', false);
}

// Work with REST Api - GET:
Flight::route('GET /iface_v01(/@entity(/@method))', function($entity, $method){
    
// load only file of entity class;
    $classname = ucfirst($entity);
    $fpath_model = 'models' . DS . $classname . '.php';
    
    if (file_exists($fpath_model)) {
        require_once $fpath_model;
        if (method_exists($classname, $method)) {
            
            //Authorisation and authebtication:
            $apikey_data = isset($_REQUEST['apikey'])?$_REQUEST['apikey']:'';
            if (Author::is_user($apikey_data) 
                || ($entity ==='person' && $method ==='create') 
                || $method ==='login'
                || $method ==='logout') {
                
                $params = count($_GET)?$_GET:'';
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

//Work with REST Api - POST:
Flight::route('POST /iface_v01(/@entity(/@method))', function($entity, $method){
    
    // load only file of entity class;
    $classname = ucfirst($entity);
    $fpath_model = 'models' . DS . $classname.'.php';
    
    if (file_exists($fpath_model)) {
        require_once $fpath_model;
        
        if (method_exists($classname, $method)) {
            
            //Authorisation and authebtication:
            $apikey_data = isset($_REQUEST['apikey'])?$_REQUEST['apikey']:'';
            if (Author::is_user($apikey_data) 
                || ($entity ==='person' && $method ==='create') 
                || $method ==='login') {

                if (isset($_FILES) && count($_FILES)) {
                    require_once 'helpers/Files.php';
                }
                $params = count($_POST)?$_POST:"";
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
Flight::route('GET /@controller(/@action)', function($controller, $action){

    // load only file of entity class;
    $classname = ucfirst($controller);
    $controller_file = 'controllers' . DS . $classname . '.php';
    
    
    //Authentication and authorisation if:
    if (in_array($action, Flight::get('actions_to_login')) && !Auth::isLogged())
        Flight::redirect('/page/login');
            
    if (file_exists($controller_file)) {
        
    // Register your class
    require_once $controller_file;
    Flight::register($controller, $classname);
    $action = ($action !='')?$action:'listing';
    Flight::{$controller}()->{$action}();

    } else { 
        Flight::redirect('/page/error404');
    }
});

Flight::route('/', function(){
    Flight::redirect('/page/listing');
});

Flight::route('/*', function(){
    Flight::halt(404, '<h1><font color="red">Error 404. Page not found!</font></h1>');
});

//Flight::register('db', 'PDO', array('pgsql:host=localhost;port=5432;dbname=recipe','recipe','pass_to_recipe'),
Flight::register('db', 'PDO', array('mysql:host=localhost;port=3306;dbname=recipe','recipe','pass_to_recipe'),
  function($db){
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
);

Flight::start();
//echo 'Memory:' . memory_get_usage() - $mem_start . '(bytes) get used.';