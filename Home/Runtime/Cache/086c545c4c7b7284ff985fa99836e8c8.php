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

<div id="left-sider"><ul>
    <li><a href="<?php echo U('Admin/index');?>">管理首页</a></li>
    <li><a href="<?php echo U('Admin/passwd');?>">修改密码</a></li>
</ul>
</div>
<div id="main">
	<div class="main-hd">
		<h2>管理首页</h2>
	</div>
    <div class="main-bd">
    	<ul>
    <li><a href="<?php echo U('Admin/index');?>">管理首页</a></li>
    <li><a href="<?php echo U('Admin/passwd');?>">修改密码</a></li>
</ul>

    </div>
</div>


</body>
</html>