<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class StaffAction extends AuthAction {
	
	public function index(){
		$tStaff = M('staff');
		$staffs = $tStaff->order('queue ASC')->select();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'staffs' => $staffs
		));
		$this->display();
	}
	
	//创建新活动
	public function create(){
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true
		));
		$this->display();
	}
	//写入新活动
	public function do_create() {
		if($this->isPost()){
			$tStaff = M('staff');
			$tStaff->create();
			$tStaff->add();
			$this->success('添加成功！', U('Staff/index'));
		}
	}
	//编辑活动
	public function edit() {
		$tStaff = M('staff');
		$staff = $tStaff->where("id={$_GET['id']}")->find();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'staff' => $staff
		));
		$this->display();
	}
	//保存活动
	public function do_edit() {
		if($this->isPost()){
			$tStaff = M('staff');
			$tStaff->create();
			$tStaff->save();
			$this->success('更新成功！', U('Staff/index'));	
		}
	}
	//删除活动
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['staffToDel']);
			$tStaff = M('staff');
			$tStaff->where("id IN ({$delRange})")->delete();
			$this->success('删除成功！', U('Staff/index'));
		}
	}
}