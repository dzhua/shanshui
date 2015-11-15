<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>添加管理员</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a class="btn" href="/admin/admin">管理员一览</a></li>
								</ul>
							</header>
							<section class="tab-content">
							
								<!-- Tab #basic -->
								<div id="basic" class="tab-pane active">
								
									<!-- Example vertical forms -->
									<div class="row-fluid">
									  <div class="span8">
											<form action="/admin/admin/do_upd" method="post" id="myform">
												<fieldset>
													<div class="control-group">
														<label for="input" class="control-label">用户名</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="user_name" name="user_name" value="<?php echo $user_name; ?>">
														</div>
													</div>	
													<div class="control-group">
														<label for="input" class="control-label">姓名</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="real_name" name="real_name" value="<?php echo $real_name; ?>">
														</div>
													</div>	
													<div class="control-group">
														<label for="input" class="control-label">密码</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="password" name="password">
														</div>
													</div>	
													<div class="control-group">
														<label for="input" class="control-label">重复密码</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="repassword" name="repassword">
														</div>
													</div>	
													<div class="control-group">
														<label for="input" class="control-label">账户类型</label>
														<div class="controls">
															<input type="radio" id="type" name="type" value="1" <?php echo $type==1?'checked':'';?>>普通管理员
															<input type="radio" id="type" name="type" value="2" <?php echo $type==2?'checked':'';?>>超级管理员
														</div>
													</div>	
													<div class="form-actions">
														<button type="submit" class="btn btn-alt btn-large btn-primary">更  新</button>
													</div>
												</fieldset>
												<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
											</form>
										</div>
									</div>
									
									<!-- Example horizontal forms -->
									
								</div>
								<!-- /Tab #basic -->
								
                            </section>
						</div>
					</article>
					<!-- /Data block -->
					
				</div>
				<!-- /Grid row -->
</div>