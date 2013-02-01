<?php
class AdminAction extends Action {
	//首页
    public function index(){
		if ( $this->checkLogin() ) {
			$this->assign(array(
				'account' => $_SESSION['account'],
				'isLogin' => true
			));
			$this->display();
		} else {
			$this->redirect('login');
		}
    }
	//登录
	public function login() {
		if($this->isPost()) {
			$this->_login()?$this->success('登录成功！', 'index'):$this->error('登录失败！');
		} else {
			$this->assign('isLogin', false);
			$this->display();
		}
	}
	//登出
	public function logout() {
		setcookie('token', null);
		$this->redirect('login');
	}
	
	//检查是否登录
	private function checkLogin(){
		return (isset($_COOKIE['token']) && $_COOKIE['token'] == $_SESSION['token'])? true:false;
	}
	//处理登录
	private function _login(){
		$tAccount = M('account');
		$ret = $tAccount->field('password')->where("account=\"{$_POST['account']}\"")->find();
		
		if( md5($_POST['password']) == $ret['password'] ) {
			$uniqd = md5(time().rand(100,999));
			setcookie('token', $uniqd);
			$_SESSION['token'] = $uniqd;
			$_SESSION['account'] = $_POST['account'];
			return true;
		} else {
			return false;
		}
	}
	
	//修改密码
	public function passwd() {
		if($this->checkLogin()){
			if($this->isPost()){
				$tAccount = M('account');
				$ret = $tAccount->field('password')->where("account=\"{$_SESSION['account']}\"")->find();
				if( md5($_POST['ori-password']) == $ret['password'] ) {
						$tAccount->where("account=\"{$_SESSION['account']}\"")->save(array(
							'password' => md5($_POST['password'])
						));
						$this->success('修改成功！', 'passwd');
				} else {
						$this->error('修改失败！');
				}
			} else {
				$this->assign(array(
					'account' => $_SESSION['account'],
					'isLogin' => true
				));
				$this->display();
			}
		}
	}
	
	//近期活动
	public function activities(){
		if($this->checkLogin()){
			if($this->isPost()){
				switch(isset($_POST['t'])?$_POST['t']:'') {
					case 'new':
						$tActivities = M('activities');
						$tActivities->create();
						$tActivities->date_start = $this->date2timestamp($_POST['date_start']);
						$tActivities->date_end = $this->date2timestamp($_POST['date_end']);
						$tActivities->add();
						$this->success('添加成功！', 'activities');
						break;
					case 'edit':
						$tpl = 'activity-edit';
						$tActivities = M('activities');
						$tActivities->create();
						$tActivities->date_start = $this->date2timestamp($_POST['date_start']);
						$tActivities->date_end = $this->date2timestamp($_POST['date_end']);
						$tActivities->save();
						$this->success('更新成功！', 'activities');
						break;
					case 'del':
						$delRange = implode(',', $_POST['activToDel']);
						$tActivities = M('activities');
						$tActivities->where("id IN ({$delRange})")->delete();
						$this->success('删除成功！', 'activities');
						break;
				}
			} else {
				switch(isset($_GET['t'])?$_GET['t']:'') {
					case 'new':
						$tpl = 'activity-new';
						break;
					case 'edit':
						$tpl = 'activity-edit';
						$tActivities = M('activities');
						$activity = $tActivities->where("id={$_GET['id']}")->find();
						$this->assign('activity', $activity);
						break;
					default:
						$tpl = 'activities';
						$tActivities = M('activities');
						$lang = L('lang');
						$activities = $tActivities->order('date_end DESC')->select();
						$this->assign('activities', $activities);
						break;
				}
				
				$this->assign(array(
					'account' => $_SESSION['account'],
					'isLogin' => true
				));
				$this->display($tpl);
			}
		}
	}
	
	protected function date2timestamp($a) {
		$b = explode('-', $a);
		return mktime(0, 0, 0, $b[1], $b[2], $b[0]);
	}
	
}