<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DIANRacing管理平台</title>
</head>
<link href="__PUBLIC__/css/manage.css" rel="stylesheet" type="text/css" media="screen" />

<body>
<div id="manage-hd">
	<h1>DIANRacing管理平台</h1>
    <p class="text-right">
    <?php if($isLogin): ?><a href="logout">注销</a><?php endif; ?>
    </p>
</div>


<h2>修改密码</h2>

<div id="passwd">
  <form id="form-passwd" method="post" action="">
    <p>
      帐号：<?php echo ($account); ?>
    </p>
    <p>
      <label for="ori-password">原密码：</label>
      <input type="password" name="ori-password" id="ori-password"/>
    </p>
    <p>
      <label for="new-password">新密码：</label>
      <input type="password" name="password" id="new-password"/>
    </p>
    <p>
      <label for="re-password">重复密码：</label>
      <input type="password" id="re-password"/>
    </p>
    <p>
      <input type="button" id="login-submit" value="修改"/>
    </p>
  </form>
</div>


</body>
</html>

<script>
	var oriPassword = document.getElementById('ori-password'),
		newPassword = document.getElementById('new-password'),
		rePassword = document.getElementById('re-password');
	
	document.getElementById('login-submit').addEventListener('click', function(){
		oriPassword.style.border = newPassword.style.border = rePassword.style.border = '1px solid #999';
		if( oriPassword.value.length == 0 ) {
				oriPassword.style.border = '1px solid red';
				return false;
		}
		if( newPassword.value.length == 0 ) {
				newPassword.style.border = '1px solid red';
				return false;
		}
		if( rePassword.value.length == 0 ) {
				newPassword.style.border = '1px solid red';
				return false;
		}
		if( rePassword.value != newPassword.value ) {
				rePassword.style.border = rePassword.style.border = '1px solid red';
				return false;
		}
		document.getElementById('form-passwd').submit();
	}, false);
</script>