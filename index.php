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
#-require_once 'secure/Auth.php';
require_once 'models/storage_connector.php';
require_once 'models/config.php';
require_once 'models/Model.php';

require_once 'models/Author.php';
require_once 'models/Recipe.php';
#-require_once 'view/user/index.php';
#-require_once 'view/recipe/index.php';

//Flight::route('/@entity(/@action)', function($entity, $action){
//    $classname = ucfirst($entity);
//    exit($classname);
//});

Flight::route('/', array($entity, 'select'));

Flight::start();