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
	<div id="header-container">
		<header class="wrapper clearfix">
			<h1 id="title">Rest-Recipe</h1>
			<nav>
				<ul>
					<li><a href="/page/list">List</a></li>
                    <li><a class="active" href="/page/new">Add Recipe</a></li>
                    <?php if (Auth::isLogged()) { ?>
					<li><a href="/iface_v01/author/logout">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="/page/login">Login</a></li>
                    <?php } ?>
				</ul>
			</nav>
		</header>
	</div>