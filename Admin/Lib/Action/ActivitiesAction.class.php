<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class ActivitiesAction extends AuthAction {
	
	public function index(){
		$tActivities = M('activities');
		$activities = $tActivities->order('date_end DESC')->select();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'activities' => $activities
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
			$tActivities = M('activities');
			$tActivities->create();
			$tActivities->date_start = $this->date2timestamp($_POST['date_start']);
			$tActivities->date_end = $this->date2timestamp($_POST['date_end']);
			$tActivities->add();
			$this->success('添加成功！', U('Activities/index'));
		}
	}
	//编辑活动
	public function edit() {
		$tActivities = M('activities');
		$activity = $tActivities->where("id={$_GET['id']}")->find();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'activity' => $activity
		));
		$this->display();
	}
	//保存活动
	public function do_edit() {
		if($this->isPost()){
			$tActivities = M('activities');
			$tActivities->create();
			$tActivities->date_start = $this->date2timestamp($_POST['date_start']);
			$tActivities->date_end = $this->date2timestamp($_POST['date_end']);
			$tActivities->save();
			$this->success('更新成功！', U('Activities/index'));	
		}
	}
	//删除活动
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['activToDel']);
			$tActivities = M('activities');
			$tActivities->where("id IN ({$delRange})")->delete();
			$this->success('删除成功！', U('Activities/index'));
		}
	}
	
}