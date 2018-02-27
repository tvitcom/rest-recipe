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
        return;
    }
    public function listing() {
        Flight::render('listing', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('listing'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function read() {
        Flight::render('read', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('read'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function add() {
        Flight::render('add', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('add'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function edit() {
        Flight::render('edit', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('edit'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function delete() {
        Flight::render('delete', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('delete'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function register() {
                Flight::render('register', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('register'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
    public function login() {
        Flight::render('login', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('login'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
    
        
    public function error404() {
        Flight::render('error404', [
            'id'=>'',
            'author_id'=>'',
            'title' => ucfirst('error404'),
            'content'=>'',
            'date'=>'',
            'name'=>'',
            ]);
    }
}