<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>账户管理</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a href="/admin/user/create" class="btn">添加新账户</a></li>
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
										<fieldset>
											<label for="input" class="control-label">账户名称</label>
											<div class="controls">
												<input type="text" name="user_name" class="input-xxlarge" id="user_name" value="<?php echo empty($keyword['user_name'])?'':rawurldecode($keyword['user_name']);?>">
											</div>
											<label for="input" class="control-label">手机号码</label>
											<div class="controls">
												<input type="text" name="tel" class="input-xxlarge" id="tel" value="<?php echo empty($keyword['tel'])?'':$keyword['tel'];?>">
											</div>
											<div class="controls">
												<label for="input" class="control-label"></label>
												<button class="btn btn-large" id="act_search" style="margin-bottom: 9px;">搜索</button>
											</div>
										</fieldset>
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
												<th width="">账户名称</th>
												<th width="">商户名称</th>
												<th width="">联系人</th>
												<th width="">手机号码</th>
												<th width="">状态</th>
												<th width="">查看</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($user_list as $user) { ?>
											<tr>
												<td><a href="#" target="_blank"><?php echo $user['id'];?></a></td>
												<td><?php echo $user['user_name'];?></td>
												<td><?php echo $user['company_name'];?></td>
												<td><?php echo $user['linkman'];?></td>
												<td><?php echo $user['tel'];?></td>
												<td><?php echo $user['status'];?></td>
												<td><a href="/admin/user/vetted/<?php echo $user['id'];?>">查看资料</a></td>
												<td class="toolbar">
													<div class="btn-group">
														<button tag="<?php echo $user['id'];?>" class="btn upd"><span class="awe-wrench"></span></button>
														<button tag="<?php echo $user['id'];?>" class="btn del"><span class="awe-remove"></span></button>
													</div>
												</td>
											</tr>
											<? } ?>
										</tbody>
									</table>
									<div class="btn-toolbar" style="float:right;">
										<div class="btn-group">
											<? if ($page_count > 1) { ?>
									        <? if ($current_page != $prev_page) { ?>
											<button class="btn page" tag="0">首页</button>
									        <button class="btn page" tag="<?=$current_page-1;?>">上一页</button>
									        <? } ?>
											<? for ($i=$page_start; $i<=$page_end; $i++) { ?> 
									        <button class="btn page <?=$current_page==$i?'active':'';?>" tag="<?=$i;?>"><?=$i;?></button>
									        <? } ?>
									        <? if ($current_page != $next_page) { ?>
									        <button class="btn page" tag="<?=$current_page+1;?>">下一页</button>
											<button class="btn page" tag="<?=$page_count;?>">末页</button>
									        <? } ?>
									        <? } ?>
										</div>
									</div>									
							  </div>
								<!-- /Tab #static -->
                            </section>
						</div>
					</article>
					<!-- /Data block -->
					
				</div>
				<!-- /Grid row -->
</div>
<script type="text/javascript" src="/ci/js/My97DatePicker/WdatePicker.js"></script>

<script>
	$(".page").click(function(){
		var user_name = check($("#user_name").val());
		var tel = check($("#tel").val());
		location.href = '/admin/user/'+user_name+'_'+tel+"/"+$(this).attr('tag');
		return false;
	});
	$(".del").click(function(){
		var id = $(this).attr("tag");
		if( ! confirm("确定要删除？")) return;
		location.href = "/admin/news/del/"+id;
		return false;
	});
	$("#act_search").click(function(){
		var user_name = check($("#user_name").val());
		var tel = check($("#tel").val());
		location.href = '/admin/user/'+user_name+'_'+tel;
	});
	$(".upd").click(function(){
		var id = $(this).attr("tag");
		location.href = "/admin/news/upd/"+id;
		return false;
	});
	function go(obj){
		if(obj.keyCode == 13) {
			//location.href = '/admin/chengyu_list/<?php echo $status;?>/'+$("#keyword").val();
		}
	}
	function check(obj) {
		var content = $.trim(obj); 
		if(content) {
			return content;
		}
		return 0;
	}
</script>