<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class PasswdAction extends AuthAction {
	public function index(){
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true
		));
		$this->display();
	}
	
	public function change(){
		if($this->isPost()){
			$tAccount = M('account');
			$ret = $tAccount->field('password')->where("account=\"{$_SESSION['account']}\"")->find();
			if( md5($_POST['ori-password']) == $ret['password'] ) {
					$tAccount->where("account=\"{$_SESSION['account']}\"")->save(array(
						'password' => md5($_POST['password'])
					));
					$this->success('修改成功！');
			} else {
					$this->error('修改失败！');
			}
		} else {
			$this->error('请用POST方式提交');
		}	
	}
}