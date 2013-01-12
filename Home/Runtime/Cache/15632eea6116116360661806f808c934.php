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


<h2>登录</h2>

<div id="login">
  <form name="form1" method="post" action="#">
    <p>
      <label for="account">帐号：</label>
      <input type="text" name="account" id="account"/>
    </p>
    <p>
      <label for="password">密码：</label>
      <input type="password" name="password" id="password"/>
    </p>
    <p>
      <input type="submit" id="login-submit" value="登录"/>
    </p>
  </form>
</div>


</body>
</html>