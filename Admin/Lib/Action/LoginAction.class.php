<?php
class LoginAction extends Action {
   //登录
	public function index() {
		if($this->isPost()) {
			$this->_login()?$this->success('登录成功！', U('Index/index')):$this->error('登录失败！');
		} else {
			$this->assign('isLogin', false);
			$this->display();
		}
	}
	
	//登出
	public function logout() {
		setcookie('token', 0, time()-1, '/');
		$this->redirect('index');
	}
	
	//处理登录
	private function _login(){
		$tAccount = M('account');
		$ret = $tAccount->field('password')->where("account=\"{$_POST['account']}\"")->find();

		if( md5($_POST['password']) == $ret['password'] ) {
			$uniqd = md5(time().rand(100,999));
			setcookie('token', $uniqd, 0, '/');
			$_SESSION['token'] = $uniqd;
			$_SESSION['account'] = $_POST['account'];
			return true;
		} else {
			return false;
		}
	}
}