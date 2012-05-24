<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="{$config.paths.base_url}/" />
<link type="text/css" rel="stylesheet" href="./assets/css/styles.css" />
<title>Personal Domain Manager</title>
</head>
<body>
<div id="content">
<br />
<center><img src="./assets/images/logo.png" border="0" alt="Logo"/></center>
  <div id="add" class="clearfix"> 
  {if $is_error == '1'}<div class="error">{$error_message}</div>{/if}
    <form action="{$config.paths.base_url}/login.php" method="post">
      <label for="username">Username</label>
      <input name="username" id="username" size="60" type="text" />
      <label for="password">Password</label>
      <input name="password" id="password" size="60" type="password" />
      <hr>
      <input name="login" value="Login &raquo;" type="submit" />
    </form>
  </div>
</div>
</body>
</html>