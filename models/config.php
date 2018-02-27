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

/*
 * Here set any settings and variables for web application.
 */

defined('DS') or define('DS', '/');// Define directory separator sign.
defined('DEV_ADDR') or define('DEV_ADDR', '127.0.0.1');// Define developers ip

Flight::set('webdir', '/var/www/recipe/webroot/');
Flight::set('fs_uploaddir', '/var/www/recipe/webroot/filestorage/');
Flight::set('limit_last_list',5);
Flight::set('uploaddir', './filestorage/');
Flight::set('allow_mimes', ['jpg','jpeg','png']);
Flight::set('actions_to_login', ['new','edit','delete']);
Flight::set('hash_salt','berRaWeliUD');
Flight::set('flight.views.path','views');
Flight::set('flight.views.extension','.php');