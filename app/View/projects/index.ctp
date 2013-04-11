<?php
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('mystyle');
?>

<div class="tab-content">
	<!-- 首页 -->
	<div class="tab-pane active" id="home"></div>

	<!-- 项目管理 -->
	<div class="tab-pane" id="project-management">
		<!-- 项目缩略图 -->
		<ul class="thumbnails">
			<li class="span3">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">
					<h4>Project 1</h4>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="img/wolf.jpg" style="width:125px; height:100px;"></img></div>
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
			
			<li class="span3">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">					
					<h4>Project 2</h4>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="img/wolf.jpg" style="width:125px; height:100px;"></img></div>
						<div class="span1"></div>
						<div class="span6">
							<p>已完成: 60%</p>
							<p>进行中: 20%</p>
							<p>审核中: 20%</p>
						<div>
					</div>
				</div>
			</li>
			
			<li class="span3">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">							
					<h4>Project 3</h4>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="img/wolf.jpg" style="width:125px; height:100px;"></img></div>
						<div class="span1"></div>
						<div class="span6">
							<p>已完成: 60%</p>
							<p>进行中: 20%</p>
							<p>审核中: 20%</p>
						<div>
					</div>
				</div>
			</li>
			
			<li class="span3">
				<div class="thumbnail" style="cursor: pointer;" onclick="location.href='#'">
					<h4>Project 4</h4>
					<div class="row-fluid">
						<div class="span5"><img class="img-polaroid" src="img/wolf.jpg" style="width:125px; height:100px;"></img></div>
						<div class="span1"></div>
						<div class="span6">
							<p>已完成: 60%</p>
							<p>进行中: 20%</p>
							<p>审核中: 20%</p>
						<div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>