<div class="row-fluid">
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
			<p class="btn" href="#Register" data-toggle="modal">注册</p>  
		</div>  
	</form> 


	<div id="Register" class="modal hide fade">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>用户注册</h3>
		</div>
		
		<form method="post" action="<?=$this->webroot;?>users/register">
			<div class="modal-body">		
				<fieldset>
					<div class="input-prepend"><span class="add-on">用户名：</span><input type="text" placeholder="User name..." name="name" id="user-name-input"></input></div>
					<div class="input-prepend"><span class="add-on">密码：</span><input type="password" placeholder="Password..." name="password" id="password-input"></input></div>
					<div class="input-prepend"><span class="add-on">重复密码：</span><input type="password" placeholder="Repeat your password..."  id="repeated-password-input"></input></div>
					<div class="input-prepend"><span class="add-on">邮箱：</span><input type="text" placeholder="Email..." name="email" id="email-input"></input></div>
				</fieldset>			
			</div>
			<div class="modal-footer">
				<p class="btn" data-dismiss="modal" type="button">关闭</p>
				<input class="btn" id="save-user" type="submit"></input>
			</div>
		</form>
	</div>
</div>