<div class="user-view">
	<div class="row-fluid">
		<div class="span3" style="height: 130px; width: 140px">
			<div class="user-avatars thumbnails">
				<a class="thumbnail" href="#">
					<img style="height: 130px;" src="<?php echo $this->webroot;?>img/wolf.jpg">
				</a>				
			</div>
		</div>
		
		<div class="span9">
			<p id="name">姓名：<?php echo $user['name'];?></p>
			<p id="company">公司：<?php echo $user['company'];?></p>
			<p id="position">职位：<?php echo $user['position'];?></p>
			<p id="tel">电话：<?php echo $user['tel'];?></p>
			<p id="email">E-mail：<?php echo $user['email'];?></p>
		</div>
	</div>
	
	<div class="row-fluid" id="u-projects-form">
		<?php foreach($tasks as $project){ ?>
			<div class="u-single">
				<p>
					<span><?php echo $project['name'];?></span>
					<span class="u-priority"><?php echo $project['priority'];?></span>
				</p>
				<p><span style="font-size: 11px; line-height: 11px;"><?php echo $project['content'];?></span></p>
				<div class="u-progress">
					<img src="<?php echo $this->webroot;?>img/progress.jpg">					
				</div>
				<p><span>还剩</span>
					<span>2</span>
					<span>天</span></p>
				<div class="u-status">
					<img src="<?php echo $this->webroot;?>img/u_status.gif">
				</div>
			</div>

			<!-- <div class="span3">
				<div class="thumbnails">
					<div class="thumbnail">
						<h4><?php echo $project['name'];?></h4>
						<a href="<?=$this->webroot;?>projects/view/<?=$project['_id']?>"><?php echo $project['summary'];?></a>					
						<div class="progress progress-striped active">
						  <div class="bar" style="width: 40%;"></div>
						</div>
						<p>
							<?php 
								$leftTime = $project['endTime'] - $project['startTime'];
								echo '还剩'.$leftTime.'分钟';
							?>
						</p>
						<p><?php echo $project['status'];?></p>
					</div>
				</div>
			</div> -->
		<?php } ?>
	</div>
</div>


<script>
	$('.breadcrumb').empty();
	$('.breadcrumb').append('<li><a href=".">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>users">用户管理</a><span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active"><?php echo $user['name'];?><span class="divider">></span></li>');

</script>