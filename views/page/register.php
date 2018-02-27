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
<?php
/* 
 * REST-RECIPE
 * Template Copyright 2018 by https://github.com/verekia/.
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="/static/css/style.css">

	<script src="/static/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body>

<?php require 'main_header.php'?>
	<div id="main-container">
		<div id="main" class="wrapper clearfix">
			
			<article>
				<header>
					<h1><?=$title?></h1>
                                        <p>If you wish be login click <a href="/page/login" target="_self">login</a>.</p>
				</header>
				<section>
					<h2>Sign here:</h2>
					<p>
                                        <form method="POST" accept-charset="utf-8" action="/iface_v01/author/create" target="_self">
                                          <fieldset>
                                            <legend>Personal information:</legend>
                                                You name:<br>
                                                <input type="text" name="name" autofocus="on" autocomplete="on" pattern="[A-Za-zА-Яа-яЁё/s-]{3,31}"><br>
                                                Email:<br>
                                            <input type="email" name="email" autocomplete="on" pattern="^[0-9a-zA-Z@-\.]+$"><br>
                                                Secretkey (password):<br>
                                                <input type="text" name="secret" autocomplete="off" pattern="^.{6,127}$"><br>
                                              <br><br>
                                              <input type="submit" value="Submit">
                                          </fieldset>
                                        </form> 
                                        </p>
				</section>
				
				<footer>
					<h3>article footer h3</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
				</footer>
			</article>
			
        <?php require 'main_aside.php' ?>
			
		</div> <!-- #main -->
	</div> <!-- #main-container -->

<?php require 'main_footer.php'?>

</body>
</html>


