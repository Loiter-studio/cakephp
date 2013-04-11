<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		//css
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('mystyle');
	?>

	
</head>
<body>
	<div class="container-fluid">
		<!-- Header -->
		<div class="header row-fluid">
			<div class="span2">
				<div class="logo thumbnails">
					<a class="thumbnail" href="#">
					<img src="<?php echo $this->webroot;?>img/wolf.jpg" alt="wolf" style="width: 160px; height: 80px;"></img>
					</a>
				</div>
			</div>
			
			<div class="span8 text-right header-bar">
				<button class="btn" id="search" data-animation="true" data-title="搜索" data-placement="bottom">
					<i class="icon-search"></i>
					搜索
				</button>
				<button class="btn" href="#AddProject" data-toggle="modal">
					<i class="icon-pencil"></i>
					添加项目
				</button>
				<button class="btn">
					<i class="icon-comment"></i>
					消息
				</button>
				<button class="btn">
					<i class="icon-road"></i>
					登出
				</button>
			</div>
			
			<div class="span2">
				<div class="avatar thumbnails">
					<a class="thumbnail" href="#">
					<img src="<?php echo $this->webroot;?>img/wolf.jpg" alt="wolf" style="width: 260px; height: 80px;"></img>
					</a>
				</div>
			</div>
			
			
			<!-- 添加项目 -->
			<div id="AddProject" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>添加项目</h3>
				</div>
				<div class="modal-body">
					<form>
						<fieldset>
							<p>项目名称： <input type="text" placeholder="Project name…" id="project-name-input"></input></p>
							<p>负责人：&nbsp&nbsp&nbsp&nbsp   <input type="text" placeholder="Manager…" id="manager-input"></input></p>
							<p>项目简介： <textarea type="text" rows="3" placeholder="Description…" id="description-input"></textarea></p>
							<p>开始时间： <input type="text" placeholder="Start time…" id="startTime-input"></input></p>
							<p>结束时间： <input type="text" placeholder="End time…" id="endTime-input"></input></p>
						</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn">关闭</a>
					<a href="#" class="btn btn-primary" id="save-project">保存项目</a>
				</div>
			</div>
		</div>
		
		<!-- divider -->
		<div class="row-fluid">
			<div style="height:1px; background:#ccc; margin: 15px 0;"></div>
		</div>
		
		<!-- Main View -->
		<div class="row-fluid" style="height:490px;">
			<div class="span2">					
				<!-- 栈式导航 -->
				<ul class="nav nav-tabs nav-stacked" id="myTab">
					<li id="project-list"><a class="meun-item" id="proj-m" href="<?php echo $this->webroot;?>companies">项目管理<i class="icon-chevron-right"></i></a></li>						
					<li><a class="meun-item" href="#user-management" data-toggle="tab">用户管理<i class="icon-chevron-right"></i></a></li>
					<li><a class="meun-item" href="<?php echo $this->webroot;?>effectiveness" data-toggle="tab">效率查看<i class="icon-chevron-right"></i></a></li>
				</ul>
				
				<!-- 暂未用到 -->
				<ul id="project-list" class="project-list collapse">
					<li><a href="#project_1" data-toggle="tab">project1</a></li>
					<li><a href="#project_2" data-toggle="tab">project2</a></li>
					<li><a href="#project_3" data-toggle="tab">project3</a></li>
					<li><a href="#project_4" data-toggle="tab">project4</a></li>
					<li><a href="#project_5" data-toggle="tab">project5</a></li>
				</ul>				
			</div>
			
			<div class="span10">
				<!-- 面包屑导航 -->
				<ul class="breadcrumb">
					<li><a href=".">首页</a> <span class="divider">></span></li>	
				</ul>
				
				<?php
					echo $this->Html->script('jquery');
					echo $this->Html->script('bootstrap');
					echo $this->Html->script('function');
				?>
				
				
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>		
	</div>
	
	<?php echo $this->element('sql_dump'); ?>
	

</body>
</html>
