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
					<h1>Page read recipe:</h1>
                    <p>Welcome dear friend!</p>
				</header>
				<section>
					<h2><?=$data['title']?></h2>
					<p><?=$data['content']?></p>
                                        <p><?=$data['ts_create']?> . <?php 
                                        echo (isset($_SESSION['user_id']) && $_SESSION['user_id']==$data['author_id'])
                                        ?'<a href=/page/edit?id='.$data['id'].'>Edit</a>'
                                        :'';
                                        ?>
				</section>
				<!--section>
					<h2>article section h2</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
				</section-->
				<footer>
					<h3>article footer h3</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
				</footer>
			</article>
			
			<?php require 'main_aside.php'?>
			
		</div> <!-- #main -->
	</div> <!-- #main-container -->
<?php require 'main_footer.php'?>

</body>
</html>