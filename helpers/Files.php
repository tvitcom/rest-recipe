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
 * This helper handle uploaded one file as secure manner without GD and ImageMagick libs.
 * 
 * ------Necessary settings (in Flightphp manner):-----
 * Flight::set('uploaddir', './filestorage/');
 * Flight::set('fs_uploaddir', '/var/www/recipe/webroot/filestorage/');
 * Flight::set('allow_mimes', ['jpg','jpeg','png']);
 * Flight::set('hash_salt','RAWSOMESALTIDS');
 */
class Files {
    public static function uploadHandler(){
        
        if (is_array($_FILES["filename"])) {
            $components = explode('.',basename($_FILES["filename"]["name"]));
            $suffix = array_pop($components);
            if (!in_array($suffix, Flight::get('allow_mimes'),true)){
                Flight::set('error','File not uploaded: type file not allowed.');
                return false;
            } else {
                $newfilename = md5($_FILES["filename"]["name"] . Flight::get('hash_salt').time()).'.'.$suffix;

                if (move_uploaded_file($_FILES['filename']['tmp_name'], Flight::get('uploaddir').DS.$newfilename)) {
                    chmod(Flight::get('fs_uploaddir').DS.$newfilename, 0660);
                    return $newfilename;
                }
            }
        }
        
        Flight::set('error','File not uploaded.');
        return false;
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