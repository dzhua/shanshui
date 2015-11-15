<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>管理员列表</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a href="/admin/admin/create" class="btn">添加管理员</a></li>
								</ul>
							</header>
							<section class="tab-content">
								<!-- Tab #static -->
								<div id="static" class="tab-pane active">
								
								  <div class="span8">
								  	<?php if ( ! empty($error)) { ?>
									  <div class="alert">
										<button data-dismiss="alert" class="close">×</button>
										<strong>警告：</strong> <?php echo $error;?>
									  </div>
									<?php } ?>
									</div>
								
									<h3>&nbsp;</h3>
									<ul class="subsubsub">
									<!-- 
										<li class="all"><a class="current" href="/admin/chengyu_list/0"><?php if($status == 0) { ?><b>未审核</b><?php } else { ?>未审核<?php } ?></a> <span class="count gray">(<?php echo $num0; ?>)</span>&nbsp;|&nbsp;</li>
										<li class="publish"><a href="/admin/chengyu_list/1"><?php if($status == 1) { ?><b>已审核</b><?php } else { ?>已审核<?php } ?></a> <span class="count gray">(<?php echo $num1; ?>)</span></li>
										 -->
									</ul>
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th width="">#</th>
												<th width="">用户名</th>
												<th width="">姓名</th>
												<th width="">账户类型</th>
												<th width="">状态</th>
												<th ></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($admin_list as $admin) { ?>
											<tr>
												<td><a href="#" target="_blank"><?php echo $admin['id'];?></a></td>
												<td><?php echo $admin['user_name'];?></td>
												<td><?php echo $admin['real_name'];?></td>
												<td><?php echo $admin['type']==1?'普通管理员':'超级管理员';?></td>
												<td><?php echo $admin['status']==1?'启用':'禁用';?></td>
												<td class="toolbar">
													<div class="btn-group">
														<button tag="<?php echo $admin['id'];?>" class="btn upd"><span class="awe-wrench"></span></button>
														<button tag="<?php echo $admin['id'];?>" class="btn del"><span class="awe-remove"></span></button>
													</div>
												</td>
											</tr>
											<? } ?>
										</tbody>
									</table>							
							  </div>
								<!-- /Tab #static -->
                            </section>
						</div>
					</article>
					<!-- /Data block -->
					
				</div>
				<!-- /Grid row -->
</div>

<script>
	$(".upd").click(function(){
		var id = $(this).attr("tag");
		location.href = "/admin/admin/upd/"+id;
		return false;
	});
</script>