<div class="user-view">
	<div class="row-fluid">
		<div class="span3" style="height: 130px; width: 140px">
			<div class="user-avatars thumbnails">
				<a class="thumbnail" href="#">
					<img style="height: 130px;" src="<?php echo $this->webroot;?><?=$user['pic_url']?>">
				</a>				
			</div>
		</div>
		
		<div class="span9">
			<p id="name"><span class="label label-warning">姓名</span>&nbsp&nbsp&nbsp<?php echo $user['name'];?></p>
			<p id="company"><span class="label label-warning">公司</span>&nbsp&nbsp&nbsp<?php echo $user['company'];?></p>
			<p id="position"><span class="label label-warning">职位</span>&nbsp&nbsp&nbsp<?php echo $user['position'];?></p>
			<p id="tel"><span class="label label-warning">电话</span>&nbsp&nbsp&nbsp<?php echo $user['tel'];?></p>
			<p id="email"><span class="label label-warning">邮箱</span>&nbsp&nbsp&nbsp<?php echo $user['email'];?></p>
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
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>users">用户管理</a><span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active"><?php echo $user['name'];?><span class="divider">></span></li>');

</script>