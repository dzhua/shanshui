<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="zh"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="zh"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="zh"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>后台管理 - UCGREAT</title>
		<meta name="description" content="">
		<meta name="author" content="后台管理 - UCGREAT">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- jQuery Visualize Styles -->
		<link rel='stylesheet' type='text/css' href='/ci/css/admin/plugins/jquery.visualize.css'>
		
		<!-- jQuery jGrowl Styles -->
		<link rel='stylesheet' type='text/css' href='/ci/css/admin/plugins/jquery.jgrowl.css'>
		
		<!-- CSS styles -->
		<link rel='stylesheet' type='text/css' href='/ci/css/admin/huraga-blue.css'>
		
		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="/ci/image/admin/icons/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ci/image/admin/icons/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ci/image/admin/icons/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="/ci/image/admin/icons/apple-touch-icon-57-precomposed.png">
		
		<!-- JS Libs -->
		<script src="/ci/js/admin/jquery-1.8.3.min.js"></script>
		<script>window.jQuery || document.write('<script src="/ci/js/admin/libs/jquery.js"><\/script>')</script>
		<script src="/ci/js/admin/libs/modernizr.js"></script>
		<script src="/ci/js/admin/libs/selectivizr.js"></script>
		
		<script>
			$(document).ready(function(){
				
				// Tooltips
				$('[title]').tooltip({
					placement: 'top'
				});
				
			});
		</script>
		
	</head>
	<body>
		
		<!-- Main page header -->
		<header class="container">
		
			<!-- Main page logo -->
			<h1>宜优家具 - 后台管理系统</h1>
			
			<!-- Main page headline -->
			
			<!-- Alternative navigation -->
			<nav>
				<ul>
				<!-- 
					<li>
						<form class="nav-search">
							<input type="text" placeholder="Search&hellip;">
						</form>
					</li>
				-->
					<li><a href="/admin/login/out">退出</a></li>
				</ul>
			</nav>
			<!-- /Alternative navigation -->
			
		</header>
		<!-- /Main page header -->
		
		<!-- Main page container -->
		<section class="container" role="main">
		
			<!-- Left (navigation) side -->
			<div class="navigation-block">
			
				<!-- User profile -->
				<section class="user-profile">
					<figure>
					  <image alt="John Pixel avatar" src="/ci/image/admin/LOGO.png">
					  <figcaption>
							<strong><a href="#" class=""><?php echo $this->session->userdata('admin_name');?></a></strong>
							<em>超级管理员</em>
							<ul>
								<li><a class="btn btn-primary btn-flat" href="#" title="Account settings">settings</a></li>
								<li><a class="btn btn-primary btn-flat" href="#" title="Message inbox">inbox</a></li>
							</ul>
						</figcaption>
					</figure>
				</section>
				<!-- /User profile -->
				
				<!-- Sample left search bar -->
				<!-- 
				<form class="side-search">
					<input type="text" class="rounded" placeholder="To search type and hit enter">
				</form>
				-->
				<!-- /Sample left search bar -->
				
				<?php 
					$statistics = $this->session->userdata('statistics');
				?>
				<!-- Main navigation -->
				<nav class="main-navigation" role="navigation">
					<ul>
						<li <?php if ($menu == 'dashboard') { ?>class="current"<?php } ?>><a href="/admin/news" class="no-submenu"><span class="awe-home"></span>Dashboard</a></li>
						<li <?php if ($menu == 'news') { ?>class="current"<?php } ?>>
							<a href="#"><span class="awe-tasks"></span>新闻<span class="badge"><?php echo empty($statistics['news_count'])?0:$statistics['news_count'];?></span></a>
							<ul>
								<li><a <?php if ($sub_menu == 'news_list') { ?>class="current"<?php } ?> href="/admin/news">新闻一览</a></li>
								<li <?php if ($sub_menu == 'news_add') { ?>class="current"<?php } ?>><a href="/admin/news/add">添加新闻</a></li>
							</ul>
						</li>						
						<li <?php if ($menu == 'product') { ?>class="current"<?php } ?>>
							<a href="#"><span class="awe-tasks"></span>产品<span class="badge"><?php echo empty($statistics['product_count'])?0:$statistics['product_count'];?></span></a>
							<ul>
								<li><a <?php if ($sub_menu == 'product_list') { ?>class="current"<?php } ?> href="/admin/product">产品一览</a></li>
								<li <?php if ($sub_menu == 'product_add') { ?>class="current"<?php } ?>><a href="/admin/product/add">添加产品</a></li>
							</ul>
						</li>
					</ul>
				</nav>
				<!-- /Main navigation -->
				
		  </div>
			<!-- Left (navigation) side -->
			
			<?php echo $main_content;?>
			
		</section>
		<!-- /Main page container -->
		
		<!-- Main page footer -->
		<footer class="container">
			<p><b> </b></p>
			<a href="#top" class="btn btn-primary btn-flat pull-right">Top &uarr;</a> 
		</footer>
		<!-- /Main page footer -->
		
		<!-- Scripts -->
		<script src="/ci/js/admin/navigation.js"></script>

		<!-- Bootstrap scripts -->
		<!--
		<script src="/ci/js/admin/bootstrap/bootstrap-tooltip.js"></script>
		<script src="/ci/js/admin/bootstrap/bootstrap-dropdown.js"></script>
		<script src="/ci/js/admin/bootstrap/bootstrap-button.js"></script>
		<script src="/ci/js/admin/bootstrap/bootstrap-alert.js"></script>
		<script src="/ci/js/admin/bootstrap/bootstrap-popover.js"></script>
		<script src="/ci/js/admin/bootstrap/bootstrap-collapse.js"></script>
		<script src="/ci/js/admin/bootstrap/bootstrap-transition.js"></script>
		-->
		<script src="/ci/js/admin/bootstrap/bootstrap.js"></script>
		
		<!-- Block TODO list -->
		<script>
			$(document).ready(function() {
				
				$('.todo-block input[type="checkbox"]').click(function(){
					$(this).closest('tr').toggleClass('done');
				});
				$('.todo-block input[type="checkbox"]:checked').closest('tr').addClass('done');
				
			});
		</script>
		
		<!-- jQuery Visualize -->
		<!--[if lte IE 8]>
			<script language="javascript" type="text/javascript" src="/ci/js/admin/plugins/visualize/excanvas.js"></script>
		<![endif]-->
		<script src="/ci/js/admin/plugins/visualize/jquery.visualize.min.js"></script>
		
		<script>
			$(document).ready(function() {
			
				var chartWidth = $(('.chart')).parent().width()*0.9;
				
				$('.chart').hide().visualize({
					type: 'pie',
					width: chartWidth,
					height: chartWidth,
					colors: ['#389abe','#fa9300','#6b9b20','#d43f3f','#8960a7','#33363b','#b29559','#6bd5b1','#66c9ee'],
					lineDots: 'double',
					interaction: false
				});
			
			});
		</script>
		
		
	</body>
</html>