<div class="project-view">
	<div class="row-fluid">
		<div class="span3" style="height:240px;">		
			<div class="project-logo thumbnails">
				<a class="thumbnail" href="#">
					<img src="<?php echo $this->webroot;?>img/wolf.jpg">
				</a>				
			</div>
			
		</div>
		<div class="span9">
			<h2><?php echo $project['name'];?></h2>
			<p><?php echo $project['leader'];?></p>
			<p><?php echo $project['summary'];?></p>
			<div class="row-fluid">
				<button class="btn" href="#AddTask" data-toggle="modal">
					<i class="icon-pencil"></i>
					添加任务
				</button>
				<button class="btn" href="#AddStage" data-toggle="modal">
					<i class="icon-pencil"></i>
					添加阶段
				</button>
			</div>
			
			
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
							<div class="input-prepend"><span class="add-on">任务名称：</span><input type="text" placeholder="Project name…" name="content" id="project-name-input"></input></div>
							<div class="input-prepend"><span class="add-on">阶段：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
							<select name="stage_id">
									<?php foreach($stages as $stage){ ?>
										<option value="<?php echo $stage['_id'];?>"><?php echo $stage['index'];?></option>
									<?php }	?>
								</select>
							</div>
							<!--
							<div class="input-prepend"><span class="add-on">状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><input type="text" placeholder="Status" name="status" id="status-input"></div>
							-->
							<div class="input-prepend"><span class="add-on">优先级别：</span><input type="text" placeholder="Priority…" name="priority" id="startTime-input"></input></div>
							<div class="input-prepend"><span class="add-on">结束时间：</span><input type="text" placeholder="End time…" name="deadline" id="endTime-input"></input></div>
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
							<div class="input-prepend"><span class="add-on">开始时间：</span><input type="text" placeholder="startTime..." name="startTime" id="startTime-input"></input></div>
							<div class="input-prepend"><span class="add-on">结束时间：</span><input type="text" placeholder="endTime..." name="endTime" id="endTime-name-input"></input></div>
							<!--
							<div class="input-prepend"><span class="add-on">状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><input type="text" placeholder="Status" name="status" id="status-input"></div>
							-->
							<div class="input-prepend"><span class="add-on">阶段简介：</span><textarea type="text" rows="3" placeholder="Summary..." name="summary" id="summary-input"></textarea></div>
							
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
			<?php foreach($stages as $stage){ ?>
			<div class="row-fluid">
				<div class="divider" />
				<h3 style="text-align: center;">第<?php $stageID=$stage['index'];
									$toCN = array('零','一','二','三','四','五','六','七','八','九');
									echo $toCN[$stageID];
								?>阶段</h3>
				<div class="row-fluid">
					<?php foreach($stage['task'] as $task){ ?>
						<div class="span3" style="margin-left: 15px;">
							<div class="project-logo thumbnails">
								<a class="thumbnail" href="#">
									<img src="<?php echo $this->webroot;?>img/wolf.jpg">
								</a>				
							</div>
							<p style="text-align: center;"><?php echo "content: ".$task['content']; ?></p>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php }	?>
		</div>
	</div>
</div>

<script>
	$('.breadcrumb').empty();
	$('.breadcrumb').append('<li><a href=".">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>projects">项目管理</a><span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active"><?php echo $project['name'];?><span class="divider">></span></li>');
</script>