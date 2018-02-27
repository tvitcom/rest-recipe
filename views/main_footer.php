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
?>
<div id="footer-container">
    <footer class="wrapper">
        <h3>tvitcom@github.com @ All right reserved. <?=date('Y')?></h3>
        <?php 
        if (WEB_DEBUG && 0) {
            echo '<pre>';
            
            echo '1) Hash: '. Auth::hash('test123').'<br>';
            echo '2) var_dump($_FILES) '.var_dump(var_dump($_FILES)).'<br>';
            //echo '3) session_start(): '. var_dump(session_start()).'<br>';
            //echo '4) $_SESSION: '.var_dump($_SESSION).'<br>';
            
            echo '</pre>';
        }
        ?>
    </footer>
</div>