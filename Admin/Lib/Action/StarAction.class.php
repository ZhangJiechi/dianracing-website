<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class StarAction extends AuthAction {
	
	public function index(){
		$tStar = M('star');
		$stars = $tStar->order('id DESC')->select();
		import('ORG.Util.String');
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'stars' => $stars
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
			$tStar = M('star');
			$tStar->create();
			$tStar->add();
			$this->success('添加成功！', U('Star/index'));
		}
	}
	//编辑活动
	public function edit() {
		$tStar = M('star');
		$star = $tStar->where("id={$_GET['id']}")->find();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'star' => $star
		));
		$this->display();
	}
	//保存活动
	public function do_edit() {
		if($this->isPost()){
			$tStar = M('star');
			$tStar->create();
			$tStar->save();
			$this->success('更新成功！', U('Star/index'));	
		}
	}
	//删除活动
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['starToDel']);
			$tStar = M('star');
			$tStar->where("id IN ({$delRange})")->delete();
			$this->success('删除成功！', U('Star/index'));
		}
	}
}