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
class Controller {
    public function __construct($param) {
        return;
    }
    
    public static function loadfile($filename = '', $dir = 'models') {
        $filepath = Flight::get('webdir') . DS . $dir . DS . $filename . '.php';
        if (!file_exists($filepath)){
            Flight::halt(404, '<h1 color="red">Error 404. Page not found!</h1>');
            exit();
        }

        require_once $filepath;
        return true;
    }
}