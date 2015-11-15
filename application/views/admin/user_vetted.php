<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>注册审核-查看详情</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a class="btn" href="/admin/user">返回</a></li>
								</ul>
							</header>
							<section class="tab-content">
							
								<!-- Tab #basic -->
								<div id="basic" class="tab-pane active">
								
									<!-- Example vertical forms -->
									<div class="row-fluid">
									  <div class="span8">
											<fieldset>
												<div class="control-group">
													<label for="input" class="control-label">注册时间：<?php echo date('Y-m-d', $create_time);?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">商家名称：<?php echo $compay_name;?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">营业执照：<?php echo $IDnumber;?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">联&nbsp;&nbsp;系&nbsp;&nbsp;人：<?php echo $linkman;?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">手机号码：<?php echo $tel;?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">电子邮箱：<?php echo $email;?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">联系地址：<?php echo $address;?></label>
												</div>
												<div class="control-group">
													<label for="input" class="control-label">简介：<?php echo $introduce;?></label>
												</div>
												<div class="form-actions">
													<a class="btn" href="/admin/user/vetted/<?php echo $id;?>/2">不通过</a>&nbsp;&nbsp;&nbsp;&nbsp;
													<a class="btn" href="/admin/user/vetted/<?php echo $id;?>/1">通过</a>
												</div>
											</fieldset>
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