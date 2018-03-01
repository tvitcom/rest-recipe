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
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?=$title?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="/static/css/style.css">

	<script src="/static/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body>
	<div id="header-container">
		<header class="wrapper clearfix">
			<h1 id="title">Rest-Recipe</h1>
			<nav>
				<ul>
					<li><a href="/page/listing">List</a></li>
                    <li><a class="active" href="/page/add">Add Recipe</a></li>
                    <?php if (Auth::isLogged()) { ?>
					<li><a href="/iface_v01/author/logout">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="/page/login">Login</a></li>
                    <?php } ?>
				</ul>
			</nav>
		</header>
	</div>