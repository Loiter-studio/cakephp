<?php
	echo $this->Html->script('function');
?>

<div class="tab-pane" id="effectiveness">
	<div class="progress progress-striped active">
		<div class="bar" ></div>
	</div>
</div>

<script>
	$('.breadcrumb').empty();
	$('.breadcrumb').append('<li><a href=".">首页</a> <span class="divider">></span></li>');
	$('.breadcrumb').append('<li id="added-bc" class="active">效率查看 <span class="divider">></span></li>');
</script>

<script type="text/javascript">
	var p = 0;
	var int;
	int = setInterval(function(){
		$('.bar').css('width', (p+=1)+'%');
		if(p === 100){
			clearInterval(int);
		}
	}, 1000);
</script>