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

class Page {
    
    public function __construct() {
        Files::loadfile('Recipe','models');
        Files::loadfile('Author','models');
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
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            //exit(var_dump(Recipe::selectById($id)));
            $data = Recipe::selectById($id);
            if ($data) {
                Flight::render('read', [
                    'data'=> $data[0],
                    'sort'=>'',
                    'title' => ucfirst(explode('::',__METHOD__)[1]),
                ]);
            } else {
                Flight::redirect('/page/error404');
            }
        } else {
            Flight::redirect('/page/listing');
        }
    }
    
    public function add() {
        if (!Auth::isLogged())
            Flight::redirect('/page/login');
        
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
        if (Auth::isLogged() && (isset($_SET) || isset($_POST))) {
            $id = intval($_GET['id']);
            //exit(var_dump(Recipe::selectById($id)));
            $data = Recipe::selectById($id);
            if ($data) {
                Flight::render('edit', [
                    'data'=> $data[0],
                    'sort'=>'',
                    'title' => ucfirst(explode('::',__METHOD__)[1]),
                ]);
            } else {
                Flight::redirect('/page/error404');
            }
            
        } else {
            Flight::redirect('/page/login');
        }
    }
    
    public function deleteOwn() {
        if (Auth::isLogged() && (isset($_SET) || isset($_POST))) {
            $id = intval($_GET['id']);
            //exit(var_dump(Recipe::selectById($id)));
            if (isset($_GET['id'])) {
                    $data = Recipe::selectById($id);
                    if ($data) {
                        Flight::render('delete', [
                        'data'=> $data[0],
                        'title' => ucfirst(explode('::',__METHOD__)[1]),
                        ]); 
                    } else {
                        Flight::redirect('/page/error404');
                    }
               
            } elseif (isset($_POST['affirmation']) && $_POST['affirmation']==='yes' && Recipe::deleteById($id)[0]) {
                Flight::redirect('/page/listing');
            } else { 
                Flight::redirect('/page/listing');
            }
        } else {
            Flight::redirect('/page/login');
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

        if (empty($_POST) && !Auth::isLogged()) {
            Flight::render('login', [
                'id'=>'',
                'author_id'=>'',
                'title' => ucfirst(explode('::',__METHOD__)[1]),
                'content'=>'',
                'date'=>'',
                'name'=>'',
            ]);
        } else {
            $user = Author::selectByEmail(Filtr::txt($_POST['email']));
            if (is_array($user) && (Auth::hash(Filtr::pwd($_POST['password'])) === $user['pass_hash'])) {
                Auth::setLogin($user);
                Flight::redirect('/page/listing');
            } else {
                Flight::halt(401,'Error 401 Not authorized.');
                if (WEB_DEBUG)
                    exit('Filtr::txt($_POST[\'email\']:'.Filtr::txt($_POST['email']).' $user[\'pass_hash\']:'.$user['pass_hash'].' Filtr::pwd($_POST[\'password\']:'.Filtr::pwd($_POST['password']));
                else    
                    exit();
            }
        }
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