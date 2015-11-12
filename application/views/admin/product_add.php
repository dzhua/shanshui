<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>添加产品</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a class="btn" href="/admin/product">产品一览</a></li>
								</ul>
							</header>
							<section class="tab-content">
							
								<!-- Tab #basic -->
								<div id="basic" class="tab-pane active">
								
									<!-- Example vertical forms -->
									<div class="row-fluid">
									  <div class="span8">
											<form action="/admin/product/do_add" method="post" id="myform" enctype="multipart/form-data">
												<fieldset>
													<div class="control-group">
														<label for="input" class="control-label">产品分类</label>
														<div class="controls">
															<select id="category" name="category">
																<option>请选择...</option>
																<?php foreach($category as $key=>$val) { ?>
																<option value="<?php echo $val['id']; ?>"><?php echo $val['category']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>													
													<div class="control-group">
														<label for="input" class="control-label">图片</label>
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
<!-- Fileupload and Inputmask plugin -->
<script src="/ci/js/admin/plugins/fileupload/bootstrap-fileupload.js"></script>
