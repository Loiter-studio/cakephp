<div class="tab-content">
	<!-- 项目管理 -->
	<div class="tab-pane active" id="project-management">
		<!-- 项目缩略图 -->
		<ul class="thumbnails">
			<?php
				foreach($projects as $project){
			?>
			<li class="span3" style="margin-left: 15px;">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">
					<h4>Project <?php echo $project['_id'];?></h4>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="<?php echo $this->webroot;?>img/wolf.jpg" style="width:125px; height:100px;"></img></div>
						<div class="span1"></div>
						<div class="span6">
							<p>已完成: 60%</p>
							<p>进行中: 20%</p>
							<p>进行中: 20%</p>
							<p>审核中: 20%</p>
						<div>
					</div>
				</div>
			</li>
			
			<?php
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