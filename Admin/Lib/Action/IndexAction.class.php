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
    
	public function useradd() {
	    return false;
        
        $tAc = M('account');
        
        $tAc->data(array(
            'account' => 'account',
            'password' => 'password'    //Password with MD5 encrypted
        ))->add();
        
	}
	
}