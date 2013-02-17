<?php
class AuthAction extends Action {
    public function __construct(){
		if(!$this->checkLogin()) {
			$this->error('请登陆！', U('Login/index'));
		}
	}
	//检查是否登录
	protected function checkLogin(){
		return (isset($_COOKIE['token']) && $_COOKIE['token'] == $_SESSION['token'])? true:false;
	}
	
	//转换来自input[type=date]的日期为时间戳
	//格式：年-月-日，如2013-01-17
	protected function date2timestamp($a) {
		$b = explode('-', $a);
		return mktime(0, 0, 0, $b[1], $b[2], $b[0]);
	}
	
	protected $lang = array(
		'zh-cn',
		'en-us'
	);
}