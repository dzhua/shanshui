<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>后台管理 </title>
		<meta name="description" content="">
		<meta name="author" content="后台管理 ">
		<meta name="robots" content="index, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSS styles -->
		<link rel='stylesheet' type='text/css' href='/ci/css/admin/huraga-blue.css'>
		<!-- JS Libs -->
		<script>window.jQuery || document.write('<script src="/ci/js/admin/jquery-1.8.3.min.js"><\/script>')</script>		
	</head>
	<body>
		
		<!-- Main page header -->
	
		<!-- Main page container -->
		<section class="container" role="main">
		<div role="main" style="float:none;margin-top:100px;">
				<center>
				<!-- Grid row -->
				<div class="row">
				
					<!-- Example form styling -->
					<!-- Data block -->
					<article class="span6 data-block" style="float:none" >
						<div class="data-container">
							<header>
								<h2>LOGIN</h2>
							</header>
							<section>
								<form class="form-inline" action="/admin/login" method="post">
									<fieldset>
										<?php if ($error === TRUE) { ?>
										<div class="alert alert-error">
											<strong>错误：用户名或密码错误！！！</strong> 
										</div>
										<?php } ?>
										<div class="control-group">											
										  <div class="controls">
												<label for="inputMask" class="control-label">用户名：</label>&nbsp;<input type="text" name="name">
											</div>
										</div>
										<div class="control-group">											
										  <div class="controls">
												<label for="inputMask" class="control-label">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label><input type="password" name="password">
											</div>
										</div>
										<div class="control-group">											
											<div class="controls">
												<input type="submit" class="btn" value="登   录">
											</div>
										</div>
									</fieldset>
								</form>
							</section>
						</div>
					</article>
					<!-- /Data block -->
					
				</div>
				<!-- /Grid row -->
				</center>
		</div>
			
	</section>
		<!-- /Main page container -->
		
		<!-- Main page footer -->
		<footer class="container">
			<center><p style="float:none;"><b>Copyright © 2015 xxx.com. </b></p></center>
		</footer>
		<!-- /Main page footer -->
		
		
	</body>
</html>