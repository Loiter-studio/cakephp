<div class="tab-content">
	<!-- 用户管理 -->
	<div class="tab-pane active" id="project-management">
		<!-- 项目缩略图 -->
		<ul class="thumbnails">
			<?php
				foreach($users as $user){
			?>
			<li class="span3" style="margin-left: 15px;">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">
					<h4>Project <?php echo $user['_id'];?></h4>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="<?php echo $this->webroot;?>img/wolf.jpg" style="width:125px; height:100px;"></img></div>
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
	$('.breadcrumb').append('<li id="added-bc" class="active">项目管理 <span class="divider">></span></li>');
</script>