<div role="main" class="content-block">
				
				<!-- Grid row -->
				<div class="row">
				
					<!-- Data block -->
					<article class="span12 data-block">
						<div class="data-container">
							<header>
								<h2>新闻一览</h2>
                                <!--
								<ul class="data-header-actions">
									<li class="demoTabs"><a href="/admin/chengyu_create" class="btn">创建新成语</a></li>
								</ul>
                                -->
							</header>
							<section class="tab-content">
								<!-- Tab #static -->
								<div id="static" class="tab-pane active">
								
									<div class="span3" style="margin-left: 0px;width:500px;">
										<h3>搜索</h3>
										<p>
											</p>
											<input type="text" placeholder="" class="span2" id="keyword" value="<?php echo empty($keyword) ? '' : rawurldecode($keyword);?>" onkeydown="go(event)">
											<button class="btn btn-large" id="act_search" style="margin-bottom: 9px;">搜索</button>
										<p></p>
										<p></p>
										<p></p>
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
												<th width="240px">标题</th>
												<th width="240px">图片</th>
												<th >内容</th>
												<th width="120px">创建时间</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($news_list as $news) { ?>
											<tr>
												<td><a href="#" target="_blank"><?php echo $news['title'];?></a></td>
												<td><img src="<?php echo get_thumb_pic($news['img_name'], 'm'); ?>" style="height:100px"/></td>
												<td><?php echo cut_str($news['content'], 25);?></td>
												<td><?php echo date('Y-m-d', $news['create_time']);?></td>
												<td class="toolbar">
													<div class="btn-group">
														<button tag="<?php echo $news['id'];?>" class="btn upd"><span class="awe-wrench"></span></button>
														<button tag="<?php echo $news['id'];?>" class="btn del"><span class="awe-remove"></span></button>
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

<script>
	$(".page").click(function(){
		location.href = "/admin/news/1/<?php echo $keyword;?>/"+$(this).attr('tag');
		return false;
	});
	$(".del").click(function(){
		var id = $(this).attr("tag");
		if( ! confirm("确定要删除？")) return;
		location.href = "/admin/news/del/"+id;
		return false;
	});
	$("#act_search").click(function(){
		location.href = '/admin/news/1/'+$("#keyword").val();
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
</script>