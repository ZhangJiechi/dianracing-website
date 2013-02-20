<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class BlogAction extends GlobalAction {
    public function index(){
		$this->assignBlogs();
		
		$this->assign('selectedTab', 'blog');
		import('ORG.Util.String');	//导入切割字符串的函数
		$this->display();
    }
}