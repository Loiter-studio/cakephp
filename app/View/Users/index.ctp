<div class="tab-content">
	<!-- 用户管理 -->
	<div class="tab-pane active" id="project-management">
		<!-- 项目缩略图 -->
		<ul class="thumbnails">
			<?php
				foreach($users as $user){
			?>
			<li class="span2" style="margin-left: 15px;">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">
					<img class="img-polaroid" src="<?php echo $this->webroot;?>img/wolf.jpg" style="width:125px; height:100px;"></img>
					<h4 style="text-align: center;"><?php echo $user['name'];?></h4>
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
	$('.breadcrumb').append('<li id="added-bc" class="active">用户管理 <span class="divider">></span></li>');
</script>