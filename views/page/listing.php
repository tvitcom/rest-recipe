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
                                        :'<a href=/page/read?id='.$val['$id'].'>Read more</a>';
                                        ?>
				</section>
                <?php } ?>
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
