<?php
class ErrorAction extends Action {
	//升级浏览器提示
	public function noie() {
		$this->assign(array(
			'lang' => L('lang'),
			'continue' => U("Error/ignoreie", array(
						'r' => $_GET['r']	//传递请求页面
				))
		));
		$this->display();
	}
	//跳过升级提示
	public function ignoreie() {
		setcookie('ignore_ie', true, time()+3600*24*14, '/');
		$rf = base64_decode($_GET['r']);	//恢复请求页面
		header("Location: {$rf}");	//302
	}
}