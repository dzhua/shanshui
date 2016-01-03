<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>添加众筹项目</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a class="btn" href="/admin/crowdfunded">众筹项目一览</a></li>
								</ul>
							</header>
							<section class="tab-content">
							
								<!-- Tab #basic -->
								<div id="basic" class="tab-pane active">
								
									<!-- Example vertical forms -->
									<div class="row-fluid">
									  <div class="span8">
											<form action="/admin/crowdfunded/do_create" method="post" id="myform" enctype="multipart/form-data">
												<fieldset>
													<div class="control-group">
														<label for="input" class="control-label">商家名称</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="title" name="title">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">项目名称</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="item_name" name="item_name">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">开始时间</label>
														<div class="controls">
															<input type="text" name="buy_start" class="input-xlarge" id="buy_start" onClick="WdatePicker()">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">结束时间</label>
														<div class="controls">
															<input type="text" name="buy_stop" class="input-xlarge" id="buy_stop" onClick="WdatePicker()">
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">众筹总额</label>
														<div class="controls">
															<input type="text" class="input-xlarge" id="total" name="total">
														</div>
													</div>			
													<div class="control-group">
														<label for="input" class="control-label">封面</label>
														<div class="controls">
															<div data-provides="fileupload" class="fileupload fileupload-new">
															<div class="fileupload-preview fileupload-large thumbnail"></div>
															<div>
																<span class="btn btn-alt btn-file">
																	<span class="fileupload-new">Select image</span>
																	<span class="fileupload-exists">Change</span>
																	<input type="file" name="userfile" id="userfile" >
																</span>
																<a data-dismiss="fileupload" class="btn btn-alt btn-danger fileupload-exists" href="#">Remove</a>
															</div>
															</div>
														</div>
													</div>
													<div class="control-group">
														<label for="input" class="control-label">介绍</label>
														<div class="controls">
															<script type="text/plain" id="introduce" name="introduce"></script>
														</div>
													</div>
													<div class="form-actions">
														<button type="submit" class="btn btn-alt btn-large btn-primary">添 加</button>
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
    initialFrameHeight:510,
    initialContent:''
};
var ue1 = UE.getEditor('introduce', options1);
</script>