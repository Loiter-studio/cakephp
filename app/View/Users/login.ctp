<?php 
	echo $this->Html->css('login');	
?>

<?if ($error):?>  
<p>The login credentials you supplied could not be recognized. Please try again.</p>  
<? endif; ?>  
  
<form action='<?php echo $this->webroot;?>users/login' method="post">  
<div>  
    <label for="username">帐号:</label>
    <input type="text" name="userName"/>
</div>  
<div>  
    <label for="password">密码:</label>  
    <input type="password" name="password"/>
</div>  
<div>  
   <input class="btn" type="submit" value="登录"/>
   <input class="btn" type="reset" value="重置" />
</div>  
</form>  