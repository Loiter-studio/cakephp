
<?if ($error):?>  
<p>The login credentials you supplied could not be recognized. Please try again.</p>  
<? endif; ?>  
  
<form action='http://localhost/moiter/users/login' method="post">  
<div>  
    <label for="username">Username:</label>
    <input type="text" name="userName"/>
</div>  
<div>  
    <label for="password">Password:</label>  
    <input type="text" name="password"/>
</div>  
<div>  
   <input type="submit" value="login"/>
</div>  
</form>  