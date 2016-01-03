<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>众筹一览</h2>
								<ul class="data-header-actions">
									<li class="demoTabs"><a href="/admin/crowdfunded/create" class="btn">创建新项目</a></li>
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
											<label for="input" class="control-label">商家名称</label>
											<div class="controls">
												<input type="text" name="company_name" class="input-xxlarge" id="company_name" value="<?php echo empty($keyword['company_name'])?'':rawurldecode($keyword['company_name']);?>">
											</div>
											<label for="input" class="control-label">众筹名称</label>
											<div class="controls">
												<input type="text" name="item_name" class="input-xxlarge" id="item_name" value="<?php echo empty($keyword['item_name'])?'':rawurldecode($keyword['item_name']);?>">
											</div>
											<label for="input" class="control-label">开始日期</label>
											<div class="controls">
												<input type="text" name="buy_start" class="input-large" id="buy_start" onClick="WdatePicker()" value="<?php echo empty($keyword['buy_start'])?'':$keyword['buy_start'];?>">
											</div>
											<label for="input" class="control-label">结束日期</label>
											<div class="controls">
												<input type="text" name="buy_stop" class="input-large" id="buy_stop" onClick="WdatePicker()" value="<?php echo empty($keyword['buy_stop'])?'':$keyword['buy_stop'];?>">
											</div>
											<label for="input" class="control-label">状态</label>
											<div class="controls">
												<select id="status" name="status">
													<option value="0">请选择...</option>
													<?php foreach($crowdfunded_status as $key=>$val) { ?>
													<option value="<?php echo $val['id']; ?>" <?php echo $val['id']==$keyword['status']?'selected':'';?>><?php echo $val['status']; ?></option>
													<?php } ?>
												</select>
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
												<th width="">众筹名称</th>
												<th width="">额度</th>
												<th width="">开始时间</th>
												<th width="">结束时间</th>
												<th width="">终止日期</th>
												<th width="">众筹项目</th>
												<th width="">已众筹金额</th>
												<th >状态</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($crowdfunded_list as $crowdfunded) { ?>
											<tr>
												<td><a href="#" target="_blank"><?php echo $crowdfunded['id'];?></a></td>
												<!-- <td><img src="<?php echo get_thumb_pic($crowdfunded['img_name'], 'm'); ?>" style="height:100px"/></td> -->
												<td><?php echo $crowdfunded['item_name'];?></td>
												<td><?php echo $crowdfunded['total'];?></td>
												<td><?php echo date('Y-m-d', $crowdfunded['buy_start']);?></td>
												<td><?php echo date('Y-m-d', $crowdfunded['buy_stop']);?></td>
												<td><?php echo date('Y-m-d', $crowdfunded['lock_stop']);?></td>
												<td><?php echo $crowdfunded['status'];?></td>
												<td class="toolbar">
													<div class="btn-group">
														<button tag="<?php echo $crowdfunded['id'];?>" class="btn upd"><span class="awe-wrench"></span></button>
														<button tag="<?php echo $crowdfunded['id'];?>" class="btn del"><span class="awe-remove"></span></button>
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
		var company_name = check($("#company_name").val());
		var item_name = check($("#item_name").val());
		var buy_start = check($("#buy_start").val());
		var buy_stop = check($("#buy_stop").val());
		var status = check($("#status").val());
		location.href = '/admin/crowdfunded/'+company_name+'_'+item_name+'_'+buy_start+'_'+buy_stop+'_'+status+"/"+$(this).attr('tag');
		return false;
	});
	$(".del").click(function(){
		var id = $(this).attr("tag");
		if( ! confirm("确定要删除？")) return;
		location.href = "/admin/news/del/"+id;
		return false;
	});
	$("#act_search").click(function(){
		var company_name = check($("#company_name").val());
		var item_name = check($("#item_name").val());
		var buy_start = check($("#buy_start").val());
		var buy_stop = check($("#buy_stop").val());
		var status = check($("#status").val());
		location.href = '/admin/crowdfunded/'+company_name+'_'+item_name+'_'+buy_start+'_'+buy_stop+'_'+status;
	});
	$(".upd").click(function(){
		var id = $(this).attr("tag");
		location.href = "/admin/news/upd/"+id;
		return false;
	});
	function go(obj){
		if(obj.keyCode == 13) {
			location.href = '/admin/chengyu_list/<?php echo $status;?>/'+$("#keyword").val();
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