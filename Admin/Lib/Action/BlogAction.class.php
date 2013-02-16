<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class BlogAction extends AuthAction {
	
	public function index(){
		$tBlog = M('blog');
		$blogs = $tBlog->order('id DESC')->select();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'blogs' => $blogs
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
			$tBlog = M('blog');
			$tBlog->create();
			$tBlog->createtime = $this->date2timestamp($_POST['createtime']);
			$tBlog->add();
			$this->success('添加成功！', U('Blog/index'));
		}
	}
	//编辑活动
	public function edit() {
		$tBlog = M('blog');
		$blog = $tBlog->where("id={$_GET['id']}")->find();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'blog' => $blog
		));
		$this->display();
	}
	//保存活动
	public function do_edit() {
		if($this->isPost()){
			$tBlog = M('blog');
			$tBlog->create();
			$tBlog->save();
			$this->success('更新成功！', U('Blog/index'));	
		}
	}
	//删除活动
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['blogToDel']);
			$tBlog = M('blog');
			$tBlog->where("id IN ({$delRange})")->delete();
			$this->success('删除成功！', U('Blog/index'));
		}
	}
}