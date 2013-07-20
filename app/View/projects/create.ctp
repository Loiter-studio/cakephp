<div class="create-info">
	<?if ($code === 0) { ?>  
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>The login credentials you supplied could not be recognized. Please try again.</strong> 
		</div>
	<? } else { ?>
		<div class="alert alert-success" style="text-align: center">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>创建项目成功.</strong> 
		</div>
	<? } ?>
	<div class="create-return">
		<span>
			<a href="<?php echo $this->webroot?>projects/view/<?=$project_id?>">返回查看项目</a>
			<span>(</span>
			<span class="counter">3</span>
			<span>秒后自动返回)</span>
		</span>
	</div>
</div>

<script type="text/javascript">
	$(".create-info").ready(function() {
		var counter = 2;
		var tid = setInterval(function(){
			if(counter >= 0) {
				$(".counter").html(counter);
				counter -= 1;
			} else {
				clearInterval(tid);
			}
		}, 1000);

		setTimeout(function(){
			var pid = "<?=$project_id;?>";

			window.location.pathname = "/moiter/projects/view/"+pid;
		}, 3000);
	}); 
</script>