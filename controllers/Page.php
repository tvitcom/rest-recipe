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

class Page extends Controller {
    
    public function __construct() {
        self::loadfile('Recipe','models');
        self::loadfile('Author','models');
        Flight::set('flight.views.path','views' . DS . lcfirst(__CLASS__));
    }
    
    public function listing() {
        
        Flight::render('listing', [
            'data'=>Recipe::selectLast(),
            'sort'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            ]);
    }
    
    public function read() {
        Flight::render('read', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function add() {
        Flight::render('add', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function edit() {
        self::loadfile('Recipe','models');
        $id = intval($_GET['id']);
        Flight::render('edit', [
            'data'=> Recipe::selectById($id)[0],
            'sort'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            ]);
    }
    
    public function deleteOwn() {
        $id = isset($_GET['id'])?intval($_GET['id']):0;
        if (isset($_GET['id'])) {
           Flight::render('delete', [
            'data'=> Recipe::selectById($id)[0],
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            ]); 
        } elseif (isset($_POST['affirmation']) && $_POST['affirmation']==='yes' && Recipe::deleteById($id)[0]) {
            Flight::redirect('/page/listing');
        } else { 
            Flight::redirect('/page/listing');
        }
    }
    
    public function register() {
                Flight::render('register', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function login() {
        Flight::render('login', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
        
    public function error404() {
        Flight::render('error404', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst(explode('::',__METHOD__)[1]),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
}