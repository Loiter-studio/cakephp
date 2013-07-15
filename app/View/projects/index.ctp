<div class="tab-content">
	<!-- 项目管理 -->
	<div class="tab-pane active" id="project-management">
		<!-- 项目缩略图 -->
		<ul class="thumbnails">
			<?php
				$count = 1;
				foreach($projects as $project){
					
			?>
			<li class="span3" style="margin-left: 15px;">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='<?=$this->webroot;?>projects/view/<?=$project['_id']?>'">
					<div class="project-header thumbnail">
						<h4 style="text-align: center;"><?php echo $project['name'];?></h4>
					</div>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="<?php echo $this->webroot;?>img/hwfc.png" style="width:125px; height:100px;"></img></div>
						<div class="span6 project-statistics">
							<p><span class="label label-warning">进行中</span> <span><?=$project['status_1']?></span><span>个任务</span></p>
							<p><span class="label ">审核中</span> <span><?=$project['status_2']?></span><span>个任务</p>
							<p><span class="label label-success">已完成</span> <span><?=$project['status_3']?></span><span>个任务</p>
						<div>
					</div>
				</div>
			</li>
			
			<?php
					$count = $count + 1;
				}
			?>			
		</ul>
	</div>
</div>


<script>
	$('.breadcrumb').empty();
	$('.breadcrumb').append('<li><a href=".">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active">项目管理 <span class="divider">></span></li>');
</script>