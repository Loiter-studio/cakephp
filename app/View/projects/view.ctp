<div class="project-view">
	<div class="row-fluid">
		<div class="span2" >		
			<div class="project-logo thumbnails" style="height:120px; width: 120px;" >
				<a class="thumbnail" href="#">
					<img style="height:120px; width: 120px;" src="<?php echo $this->webroot;?>img/hwfc.png">
				</a>				
			</div>
			
		</div>
		<div class="span9" style="font-family: '微软雅黑', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
			<h3><span class="label label-warning">项目名称&nbsp&nbsp&nbsp</span>&nbsp<?php echo $project['name'];?></h2>
			<p><span class="label label-success">项目负责人</span>&nbsp&nbsp&nbsp<?php echo $project['leader'];?></p>
			<p><span class="label label-info">项目简介&nbsp&nbsp&nbsp</span>&nbsp&nbsp&nbsp<?php echo $project['summary'];?></p>
			
			
			<!-- 添加任务 -->
			<div id="AddTask" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>添加任务</h3>
				</div>
				<?php if(count($stages) == 0) {?>
					<div class="alert">
						<strong>请先创建阶段!</strong>
					</div>
				<?php } 
					  else {
				?>
				<form method="post" action="<?=$this->webroot;?>tasks/create">
					<div class="modal-body">
						<fieldset>
							<div class="input-prepend">
								<span class="add-on">任务名称：</span>
								<input type="text" placeholder="Project name…" name="content" id="project-name-input"></input>
							</div>
							<div class="input-prepend">
								<span class="add-on">负责人员：</span>
								<input type="text" placeholder="Manager…" name="leader" id="manager-input" autocomplete="off" data-provide="typeahead" data-items="4" data-source="<?php echo '[&quot;wayzh&quot;,&quot;Rathinho&quot;,&quot;lichaop&quot;]';?>">
							</div>
							<div class="input-prepend">
								<span class="add-on">阶段：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
								<select name="stage_id">
									<?php foreach($stages as $stage){ ?>
										<option value="<?php echo $stage['_id'];?>"><?php echo $stage['index'];?></option>
									<?php }	?>
								</select>
							</div>

							<div class="input-prepend">
								<span class="add-on">优先级别：</span>
								<select name="priority">
									<option>HIGH</option>
									<option>NORMAL</option>
									<option>LOW</option>
								</select>
							</div>

							<div class="input-prepend input-append date" id="dp5">
								<span class="add-on">结束时间：</span>
								<input  size="16" type="text" placeholder="End time…" name="deadline" id="endTime-input" autocomplete="off">
								<span class="add-on"><i class="icon-remove"></i></span>
    							<span class="add-on"><i class="icon-th"></i></span>
							</div>
						</fieldset>						
					</div>
					<div class="modal-footer">
						<p class="btn" data-dismiss="modal" type="button">关闭</p>
						<input class="btn" id="save-task" type="submit"></input>
					</div>
				</form>
				<?php } ?>
			</div>	
			
			
			<!-- 添加阶段 -->
			<div id="AddStage" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>添加阶段</h3>
				</div>
				<form method="post" action="<?=$this->webroot;?>stages/create">
					<div class="modal-body">						
						<fieldset>
							<div class="input-prepend">
								<span class="add-on">负责人员：</span>
								<input type="text" placeholder="Manager…" name="leader" id="manager-input" autocomplete="off" data-provide="typeahead" data-items="4" data-source="<?php echo '[&quot;wayzh&quot;,&quot;Rathinho&quot;,&quot;lichaop&quot;]';?>">
							</div>
													
							<div class="input-prepend">
								<span class="add-on">阶段简介：</span>
								<textarea type="text" rows="3" placeholder="Summary..." name="summary" id="summary-input"></textarea>
							</div>

							<div class="input-prepend input-append date" id="dp3">
								<span class="add-on">开始时间：</span>
								<input size="16" type="text" placeholder="Start time…" name="startTime" id="startTime-input" autocomplete="off">
								<span class="add-on"><i class="icon-remove"></i></span>
    							<span class="add-on"><i class="icon-th"></i></span>
							</div>

							<div class="input-prepend input-append date" id="dp4">
								<span class="add-on">结束时间：</span>
								<input size="16" type="text" placeholder="End time…" name="endTime" id="endTime-name-input" autocomplete="off">
								<span class="add-on"><i class="icon-remove"></i></span>
    							<span class="add-on"><i class="icon-th"></i></span>
							</div>
							
							<input type="hidden" name="index" id="index-input" 
								value="<?php echo count($stages)+1;?>">							
							</input>
							<input type="hidden" name="project_id" id="projectid-input" value="<?php echo $project['_id'];?>"></input>
						</fieldset>						
					</div>
					<div class="modal-footer">
						<p class="btn" data-dismiss="modal" type="button">关闭</p>
						<input class="btn" id="save-stage" type="submit"></input>
					</div>
				</form>
			</div>	
			
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<?php if(!$stages): ?>
				<div class="alert" style="width: 500px; margin: 50px auto 0 auto;">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>项目内容为空，请添加阶段和任务.</strong> 
				</div>
			<?php endif ?>

			<?php foreach($stages as $stage){ ?>
			<div class="row-fluid">				
				<h4 style="text-align: center; text-shadow: 2px 1px 2px;">第<?php $stageID=$stage['index'];
									$toCN = array('零','一','二','三','四','五','六','七','八','九');
									echo $toCN[$stageID];
								?>阶段</h4>
				<div class="stage-separator"></div>
				<div class="row-fluid">
					<?php foreach($stage['task'] as $task){ ?>
						<div class="p-single" id="p-single-<?=$task['task_id']?>">
							<div class="p-status-bar"></div>
							<div class="p-manager">
								<div class="p-avatar thumbnail">
									<img src="<?php echo $this->webroot;?><?=$task['pic_url']?>">
								</div>
								<div class="p-name"><span><?php echo $task['user_name'];?></span></div>
							</div>
							<div class="p-detail">
								<div class="p-summary">
									<p><span><?php echo $task['content'];?></span></p>
								</div>
								<div class="p-start">
									<p><span><?php echo $stage['startTime'];?></span></p>
								</div>
								<div class="p-end">
									<p><span><?php echo $task['deadline'];?></span></p>
								</div>
							</div>
							<div class="p-status">
								<span></span>
							</div>
							<script type="text/javascript">							
								var statusId = <?= $task['status'] ?>;
								var statusStr, statusColor, statusBg;
								switch (statusId) {
									case 1:
										statusStr = "进行中";
										statusColor = "#f89406";
										statusBg = "status_underway.png";
										break;
									case 2:
										statusStr = "待审核";
										statusColor = "#999999";
										statusBg = "status_checking.png";
										break;
									case 3:
										statusStr = "已完成";
										statusColor = "#468847";
										statusBg = "status_finished.png";
										break;
									default:
										statusStr = "出错啦";
										statusColor = "#ff0000";
								}


								$("#p-single-<?=$task['task_id']?>").css({
									'border-color': statusColor
								});
								$("#p-single-<?=$task['task_id']?> .p-status-bar").css({
									'background-color': statusColor
								});
								$("#p-single-<?=$task['task_id']?> .p-status").css({
									'background-image': 'url(<?=$this->webroot?>/img/'+statusBg+")"
								});
								$("#p-single-<?=$task['task_id']?> .p-status > span").html(statusStr);							
							</script>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php }	?>
		</div>
	</div>
</div>

<?php
	echo $this->Html->css('datetimepicker');
	echo $this->Html->script('bootstrap-datetimepicker');
?>

<script>
	$('#dp3').datetimepicker({
		startDate: new Date(),
		todayBtn: true,
		format: 'hh:ii dd/mm/yyyy',
		autoclose: true,
		todayHighlight: true,
		keyboardNavigation: true,
		showMeridian: true
	});

	$('#dp4').datetimepicker({
		startDate: new Date(),
		todayBtn: true,
		format: 'hh:ii dd/mm/yyyy',
		autoclose: true,
		todayHighlight: true,
		keyboardNavigation: true,
		showMeridian: true
	});

	$('#dp5').datetimepicker({
		startDate: new Date(),
		todayBtn: true,
		format: 'hh:ii dd/mm/yyyy',
		autoclose: true,
		todayHighlight: true,
		keyboardNavigation: true,
		showMeridian: true
	});

	$('.breadcrumb').empty();
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>projects">项目管理</a><span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active"><?php echo $project['name'];?><span class="divider">></span></li>');
	
	

	// 所有用户都能创建任务，登录用户为当前任务负责人或者管理员才可创建阶段
	var projectLeader = "<?php echo $project['leader'];?>";
	var currentUserObj = eval("("+'<?php echo json_encode($currentUser);?>'+")");
	var projectAdder;
	if (window.currentUserObj.authority <= 2 && currentUserObj.userName === projectLeader) {
		projectAdder = '<li><div id="project-adder"><a href="#AddStage" data-toggle="modal"><i class="icon-pencil"></i>添加阶段</a>&nbsp&nbsp&nbsp<a href="#AddTask" data-toggle="modal"><i class="icon-pencil"></i>添加任务</a></div></li>';
	} else {
		projectAdder = '<li><div id="project-adder"><a href="#AddTask" data-toggle="modal"><i class="icon-pencil"></i>添加任务</a></div></li>';
	}

	$('.breadcrumb').append(projectAdder);
</script>

