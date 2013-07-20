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
			<p id="name"><span class="label label-info">姓名</span>&nbsp&nbsp&nbsp<?php echo $user['name'];?></p>
			<p id="company"><span class="label label-info">公司</span>&nbsp&nbsp&nbsp<?php echo $user['company'];?></p>
			<p id="position"><span class="label label-info">职位</span>&nbsp&nbsp&nbsp<?php echo $user['position'];?></p>
			<p id="tel"><span class="label label-info">电话</span>&nbsp&nbsp&nbsp<?php echo $user['tel'];?></p>
			<p id="email"><span class="label label-info">邮箱</span>&nbsp&nbsp&nbsp<?php echo $user['email'];?></p>
		</div>
	</div>
	

	<div id="task-selector">
		<div id="selector-trigger"></div>
		<ul>
			<li><a id="all" href="javascript:void(0);">全部任务</a></li>
			<li><a id="underway" href="javascript:void(0);">进行中</a></li>
			<li><a id="checking" href="javascript:void(0);">待审核</a></li>
			<li><a id="finish" href="javascript:void(0);">已完成</a></li>
		</ul>
	</div>

	<div class="row-fluid thumbnail" id="u-projects-form">
		<?php foreach($tasks as $project){ ?>

			<div class="u-single thumbnail" id="<?=$project['task_id']?>-<?=$project['status']?>">
				<p>
					<span><?php echo $project['name'];?></span>
					<span class="u-priority"><?php echo $project['priority'];?></span>
				</p>
				<p><span style="font-size: 11px; line-height: 11px;"><?php echo $project['content'];?></span></p>
				<div class="u-progress">
					<div class="progress progress-striped active">
						<div class="bar"></div>
					</div>				
				</div>
				<p><span>还剩</span>
					<span class="left-day"></span>
					<span>天</span></p>
				<div class="u-status">
					<div class="switch switch-small" id="switch-<?=$project['task_id']?>">
					    <input type="checkbox" checked disabled/>
					</div>
				</div>

				<script type="text/javascript">
					(function setStatus() {
						var status = "<?=$project['status'];?>";
						switch(status) {
							case "1":
								$("#switch-<?=$project['task_id']?>").attr("data-on-label", "进行中");
								$("#switch-<?=$project['task_id']?>").attr("data-off-label", "待审核");
								$("#switch-<?=$project['task_id']?>").attr("data-on", "warning");
								$("#switch-<?=$project['task_id']?>").attr("data-off", "info");
								break;
							case "2":
								$("#switch-<?=$project['task_id']?>").attr("data-on-label", "待审核");
								$("#switch-<?=$project['task_id']?>").attr("data-off-label", "已完成");
								$("#switch-<?=$project['task_id']?>").attr("data-on", "info");
								$("#switch-<?=$project['task_id']?>").attr("data-off", "success");
								$("#switch-<?=$project['task_id']?>").children()[0].disabled = true;
								break;
							case "3":
								$("#switch-<?=$project['task_id']?>").attr("data-off-label", "已完成");
								$("#switch-<?=$project['task_id']?>").attr("data-off", "success");
								$("#switch-<?=$project['task_id']?>").children()[0].checked = false;
								$("#switch-<?=$project['task_id']?>").children()[0].disabled = true;
								break;
						}
					})();

					(function setPriority() {
						var priority = "<?php echo $project['priority'];?>";
						var strColor;

						switch (priority) {
							case "HIGH":
								strColor = "#ff0000";
								break;
							case "NORMAL":
								strColor = "#000000";
								break;
							case "LOW":
								strColor = "#aaaaaa";
								break;
						}

						$("#<?=$project['task_id']?>-<?=$project['status']?> .u-priority").css('color', strColor);
					})();

					(function setProgress() {
						var datetime= "<?=$project['deadline']?>".split(" "),
							date = datetime[1].split("/"),
							time = datetime[0].split(":");
						var someDate = new Date(Date.UTC(parseInt(date[2]), parseInt(date[1])-1, parseInt(date[0]), parseInt(time[0])-8, parseInt(time[1])));
						var secDiff = someDate - Date.now();
						var dayDiff = secDiff / (1000 * 60 * 60 * 24);
						dayDiff = dayDiff > 0 ? dayDiff.toFixed(2) : 0;
						$("#<?=$project['task_id']?>-<?=$project['status']?> .left-day").html(dayDiff);
					})();
				</script>
			</div>
		<?php } ?>		
	</div>
</div>

<script>
	$('.breadcrumb').empty();
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li><a href="<?php echo $this->webroot;?>users">用户管理</a><span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active"><?php echo $user['name'];?><span class="divider">></span></li>');

	$("#user-view").ready(function() {
		var uSingleList = document.getElementsByClassName("u-single");
		window.userTasksList = Array();
		for (var i = 0; i < uSingleList.length; i++) {
			window.userTasksList.push(uSingleList[i]);
		};
	});

	$("#all").click(function() {
		var form = document.getElementById("u-projects-form");
		form.innerHTML = "";

		for (var i = 0; i < userTasksList.length; i++) {
			form.appendChild(userTasksList[i]);
		};		
	});

	$("#underway").click(function() {		
		var form = document.getElementById("u-projects-form");
		form.innerHTML = "";

		for (var i = 0; i < userTasksList.length; i++) {
			var status = userTasksList[i].id.split("-");
			if(status[1] == "1") {
				form.appendChild(userTasksList[i]);
			}
		};
	});

	$("#checking").click(function() {		
		var form = document.getElementById("u-projects-form");
		form.innerHTML = "";

		for (var i = 0; i < userTasksList.length; i++) {
			var status = userTasksList[i].id.split("-");
			if(status[1] == "2") {
				form.appendChild(userTasksList[i]);
			}
		};
	});

	$("#finish").click(function() {		
		var form = document.getElementById("u-projects-form");
		form.innerHTML = "";

		for (var i = 0; i < userTasksList.length; i++) {
			var status = userTasksList[i].id.split("-");
			if(status[1] == "3") {
				form.appendChild(userTasksList[i]);
			}
		};
	});

	// 权限控制
	var username = "<?php echo $user['name'];?>";
	var currentUserObj = eval("("+'<?php echo json_encode($currentUser);?>'+")");
	if (currentUserObj.authority === 3 && currentUserObj.userName !== username) {
		// 普通用户查看其他用户的资料时， 将状态开关设置为disabled
		$(".switch").each(function() {
			$(this).children()[0].disabled = true;
		});
	} else if (currentUserObj.authority === 2 && currentUserObj.userName !== username) {

	} else if (currentUserObj.authority === 1) {
		// 管理员用户可以更改所有用户的任务状态
		$(".switch").each(function() {
			$(this).children()[0].disabled = false;
		})
	} else if (currentUserObj.userName === username) {
		// 普通用户查看自己的资料时， 将状态开关设置为enabled
		$(".switch").each(function() {
			$(this).children()[0].disabled = false;
		});
	}

	// 监听状态开关改变事件，向服务器Post更新后的状态
	$(".switch").on('switch-change', function (e, data) {
		var $id = $(this).attr('id');
		console.log($id);
	});
</script>