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
require 'vendor/autoload.php';

require_once 'secure/Filtr.php';
require_once 'models/config.php';
require_once 'models/pgsql.php';
require_once 'models/model.php';

//require_once 'models/Author.php';
//require_once 'models/Recipe.php';
//-require_once 'view/user/index.php';
//-require_once 'view/recipe/index.php';

// Register your class
//Flight::register('recipe', 'Recipe');

//Flight::route('/author/select', array('Author','select'));
//Flight::route('/author/create', array('Author','create'));
//Flight::route('/author/update', array('Author','update'));
//Flight::route('/author/delete', array('Author','delete'));

Flight::route('GET|POST /iface_v01(/@entity(/@method(/@id)))', function($entity, $method, $id){
    $classname = ucfirst($entity);
    
    // load only entity class;
    $fpath_model = 'models/'.$classname.'.php';
    if (file_exists($fpath_model)) {
        require $fpath_model;
        //echo "LOADED:".$entity . '->'.$method.'('.$id.')';
        //echo "LOADED:".$entity . '->'.$method.'('.$id.')';
        Flight::json([
            'id' => $id,
            'method'=> $method,
            'entity'=> $entity,
        ]);


    } else { 
        Flight::halt(404, 'Error 404. Page not found!');
    }
});

Flight::route('/*', function(){
    Flight::render('list.php', array('name' => 'Bob'));
});

Flight::start();