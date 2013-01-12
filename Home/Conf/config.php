<?php
return array(
	'DEFAULT_MODULE'     => 'Index', //默认模块
    'SESSION_AUTO_START' => true,
	
	'LANG_SWITCH_ON' => true,
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'DEFAULT_LANG' => 'zh-cn', // 默认语言
	'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
	
	'DB_TYPE' => 'pdo',
	'DB_PREFIX' => 'think_',
	'DB_USER' => '',
	'DB_PWD' => '',
	'DB_DSN' => 'sqlite:./dr.sqlite',
);
?>