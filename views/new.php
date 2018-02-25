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
					<h1><?=$title?> recipe</h1>
                    <?php if (Auth::isLogged()) { ?>
                    <pre>Yuo API_KEY: <?php echo isset($_SESSION['api_key'])?$_SESSION['api_key']:'none' ?></pre>
                    <?php } else {?>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. .</p>
                    <?php } ?>
					
					
				</header>
				<section>
					<h2>Fill here:</h2>
					<p>
                                        <form method="POST" enctype="" accept-charset="utf-8" action="/iface_v01/recipe/create" target="_self">
                                          <fieldset>
                                            <legend>Write your recipe here:</legend>
                                            Recipe title:<br>
                                            <input type="hidden" name="apikey" value="<?php echo isset($_SESSION['api_key'])?$_SESSION['api_key']:'none' ?>"><br>
                                            <input type="text" name="title" required="on" autofocus="on" autocomplete="on" pattern="^[0-9a-zA-Zа-яА-Я-\.\s\S!?,\(\)]+$"><br>
                                              Recipe (text):<br>
                                              <textarea name="content" cols="40" rows="3" required="on" autocomplete="on"></textarea><br><br>
                                              May be one photo? Download here:<br>
                                              <input type="file" name="filename">
                                              <br><p></p>
                                              <input type="reset" value="Clear form">
                                              <input type="submit" formenctype="multipart/form-data" value="Submit">
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


