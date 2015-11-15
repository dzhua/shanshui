<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>注册账户</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a class="btn" href="/admin/user">账户一览</a></li>
								</ul>
							</header>
							<section class="tab-content">
							
								<!-- Tab #basic -->
								<div id="basic" class="tab-pane active">
								
									<!-- Example vertical forms -->
									<div class="row-fluid">
									  <div class="span8">
											<form action="/admin/user/do_create" method="post" id="myform" enctype="multipart/form-data">
												<fieldset>
													<div class="control-group">
														<label for="input" class="control-label">账户名称</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="user_name" name="user_name">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">密码</label>
														<div class="controls">
															<input type="password" class="input-xlarge" id="password" name="password">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">重复密码</label>
														<div class="controls">
															<input type="password" class="input-xlarge" id="repassword" name="repassword">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">商家名称</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="company_name" name="company_name">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">证件编号</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="IDnumber" name="IDnumber">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">联系人</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="linkman" name="linkman">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">手机号码</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="tel" name="tel">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">座机号码</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="mobile" name="mobile">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">邮箱地址</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="email" name="email">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">传真</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="fax" name="fax">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">QQ号码</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="qq" name="qq">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">联系地址</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="address" name="address">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">简介</label>
														<div class="controls">
															<script type="text/plain" id="introduce" name="introduce"></script>
														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn btn-alt btn-large btn-primary">提交注册申请</button>
													</div>
												</fieldset>
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

<script type="text/javascript" src="/ci/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/ci/js/ueditor/ueditor.all.min.js"></script>
<!-- Fileupload and Inputmask plugin -->
<script type="text/javascript" src="/ci/js/admin/plugins/fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="/ci/js/My97DatePicker/WdatePicker.js"></script>

<script>
window.UEDITOR_HOME_URL = "/ci/js/ueditor/";

//实例化编辑器
var options1 = {
    webAppKey:"X2I9F7RiYTOcAPLk9ir7zirZ",
    initialFrameWidth:840,
    initialFrameHeight:310,
    initialContent:''
};
var ue1 = UE.getEditor('introduce', options1);
</script>