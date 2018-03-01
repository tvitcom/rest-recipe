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
					<h1><?=$title?> recipe</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. .</p>
				</header>
				<section>
					<h2>Fill here:</h2>
					<p>
                        <form method="POST" enctype="" accept-charset="utf-8" action="/iface_v01/recipe/updateOwn" target="_self">
                          <input type="hidden" name="apikey" value="<?php echo isset($_SESSION['api_key'])?$_SESSION['api_key']:'none' ?>"><br>
                          <input type="hidden" name="id" value="<?php echo $data['id'] ?>"><br>
                          <fieldset>
                            <legend>Write your recipe here:</legend>
                            Recipe title:<br>
                            <input type="text" name="title" required="on" autofocus="on" autocomplete="on" pattern="^[0-9a-zA-Zа-яА-Я-\.\s\S!?,\(\)]+$" value="<?=$data['title']?>"><br>
                              Recipe (text):<br>
                            <textarea name="content" cols="40" rows="3" required="on" autocomplete="on"><?=$data['content']?></textarea><br><br>
                              May be one photo? Download here:<br>
                              <img src="/filestorage/<?=$data['picture_uri']?>" 
                                   alt="May be this is absent picture..." width="400" height="341"><br>
                            <input type="file" name="filename" accept="image/jpeg,image/png">
                              <br><p></p>
                            <input type="submit" formenctype="multipart/form-data" value="Submit">
                          <a style="
                                 width: 100px; padding: 4px; cursor: pointer; box-shadow: 6px 6px 5px; #999; -webkit-box-shadow: 6px 6px 5px #999; -moz-box-shadow: 6px 6px 5px #999; font-weight: bold; background: #ff7500; color: #000; border-radius: 3px; border: 1px solid #999; font-size: 100%;
                                 " href="/page/deleteOwn?id=<?=$data['id']?>">  Delete  </a>
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


