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

<?php require 'main_header.php'?>
	<div id="main-container">
		<div id="main" class="wrapper clearfix">
			
			<article>
				<header>
					<h1><?=$title?></h1>
                                        <p>If you wish be register click <a href="/page/register" target="_self">register</a>.</p>
				</header>
				<section>
					<h2>Sign here:</h2>
					<p>
                    <form method="POST" accept-charset="utf-8" action="/page/login" target="_self">
                        Email:<br>
                        <input type="email" name="email" autofocus="on" autocomplete="on" pattern="^[0-9a-zA-Z@-\.]+$"><br>
                        Password:<br>
                          <input type="password" name="password" autocomplete="on"><br><br>
                          <input type="submit" value="Submit">
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


