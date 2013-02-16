<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class IndexAction extends AuthAction {
    public function index(){
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true
		));
		$this->display();
    }
	
	
}