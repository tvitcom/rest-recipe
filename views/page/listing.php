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
					<h1><?=$title?> recipes</h1>
					<p>You can see last five recipes.</p>
				</header>
                <?php foreach ($data as $val) { ?>
				<section>
					<h2><?=$val['title']?></h2>
					<p><?=$val['content']?></p>
                                        <p><?=$val['ts_create']?> . <?php 
                                        echo (isset($_SESSION['user_id']) && $_SESSION['user_id']==$val['author_id'])
                                        ?'<a href=/page/edit?id='.$val['id'].'>Edit</a>'
                                        :'<a href=/page/read?id='.$val['id'].'>Read more</a>';
                                        ?>
				</section>
                <?php } ?>
				<!--section>
					<h2>article section h2</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra.</p>
				</section-->
                <hr color='cyan'>
				<footer>
					<h3>Yet awesome:</h3>
					<p>Here can be your advertisement...</p>
				</footer>
			</article>
			
			<?php require 'main_aside.php'?>
			
		</div> <!-- #main -->
	</div> <!-- #main-container -->
<?php require 'main_footer.php'?>
	
</body>
</html>
