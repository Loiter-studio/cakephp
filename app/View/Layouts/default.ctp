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
		
		echo $this->Html->script('bootstrap-datetimepicker');
		//css
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('mystyle');
		echo $this->Html->css('datetimepicker');
	?>

	
</head>
<body>
	<div class="container-fluid">
		<!-- Header -->
		<div class="header row-fluid" id="header">
			<div class="span2">
				<div class="logo thumbnails">
					<img src="<?php echo $this->webroot;?>img/logo.png" alt="logo" id="cpn-logo">
				</div>
			</div>
			
			<div class="span8 text-right header-bar">
				<a class="btn" id="search" data-animation="true" data-title="搜索" data-placement="bottom">
					<i class="icon-search"></i>
					搜索
				</a>
				<a class="btn" href="#AddProject" data-toggle="modal">
					<i class="icon-pencil"></i>
					添加项目
				</a>
				<a class="btn">
					<i class="icon-comment"></i>
					消息
				</a>
				<a class="btn" href="<?=$this->webroot;?>users/logout">
					<i class="icon-road"></i>
					登出
				</a>
			</div>
			
			<div class="span2">
				<div class="avatar thumbnails">
					
					<img src="<?php echo $this->webroot;?>img/hwfc.png" alt="wolf" id="user-avatar">
					
					<a href="<?=$this->webroot;?>users/edit">编辑</a>
					<a href="<?=$this->webroot;?>uploads/upload">修改头像</a>
				</div>
			</div>
			
			
			<!-- 添加项目 -->
			<div id="AddProject" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>添加项目</h3>
				</div>
				<form method="post" action="<?=$this->webroot;?>projects/create">
					<div class="modal-body">						
						<fieldset>
							<div class="input-prepend">
								<span class="add-on">项目名称：</span>
								<input type="text" placeholder="Project name…" name="name" id="project-name-input">
							</div>

							<div class="input-prepend">
								<span class="add-on">负责人员：</span>
								<input type="text" placeholder="Manager…" name="leader" id="manager-input" autocomplete="off" data-provide="typeahead" data-items="4" data-source="<?php echo '[&quot;wayzh&quot;,&quot;rathinho&quot;,&quot;lichaop&quot;]';?>">
							</div>

							<div class="input-prepend">
								<span class="add-on">项目简介：</span>
								<textarea type="text" rows="3" placeholder="Description…" name="summary" id="description-input"></textarea>
							</div>

							<div class="input-prepend input-append date" id="dp1">
								<span class="add-on">开始时间：</span>
								<input size="16" type="text" placeholder="End time…" name="startTime" id="startTime-input">
								<span class="add-on"><i class="icon-remove"></i></span>
    							<span class="add-on"><i class="icon-th"></i></span>
							</div>

							<div class="input-prepend input-append date" id="dp2">
								<span class="add-on">结束时间：</span>
								<input size="16" type="text" placeholder="End time…" name="endTime" id="endTime-input">
								<span class="add-on"><i class="icon-remove"></i></span>
    							<span class="add-on"><i class="icon-th"></i></span>
							</div>
						</fieldset>					
					</div>
					<div class="modal-footer">
						<p class="btn" data-dismiss="modal" type="button">关闭</p>
						<input class="btn" id="save-project" type="submit"></input>
					</div>
				</form>
			</div>
		</div>
		
		<!-- Main View -->
		<div class="row-fluid" id="main-view">
			<div class="span2" id="sidebar">					
				<!-- 栈式导航 -->
				<ul class="nav nav-tabs nav-stacked" id="myTab">
					<li id="project-list"><a class="meun-item" id="proj-m" href="<?php echo $this->webroot;?>projects">项目管理<i class="icon-chevron-right"></i></a></li>						
					<li><a class="meun-item" href="<?php echo $this->webroot;?>users">用户管理<i class="icon-chevron-right"></i></a></li>
					<li><a class="meun-item" href="<?php echo $this->webroot;?>effectiveness">效率查看<i class="icon-chevron-right"></i></a></li>
				</ul>	
			</div>
			
			<div class="span10">
				<!-- 面包屑导航 -->
				<ul class="breadcrumb" id="breadcrumb">
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

				<div id="footer">
					<p>©Loiter Company</p>
					<p>2013</p>
				</div>
			</div>
		</div>		
	</div>
	
	<?php echo $this->element('sql_dump'); ?>
	
	<script type="text/javascript">
		var mainHeight = $('#main-view').css("height");
		$('#sidebar').css("height", mainHeight);

		$('#dp1').datetimepicker({
			startDate: new Date(),
			todayBtn: true,
			format: 'hh:ii dd/mm/yyyy',
			autoclose: true,
			todayHighlight: true,
			keyboardNavigation: true,
			showMeridian: true
		});

		$('#dp2').datetimepicker({
			startDate: new Date(),
			todayBtn: true,
			format: 'hh:ii dd/mm/yyyy',
			autoclose: true,
			todayHighlight: true,
			keyboardNavigation: true,
			showMeridian: true
		});

		$('manager-input').typeahead({
			item: 4,
			source: ["wayzh", "rathinho","lichaop"]
		});
	</script>
</body>
</html>
