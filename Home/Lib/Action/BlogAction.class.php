<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class BlogAction extends GlobalAction {
    public function index(){
		//Blog
		$tBlog = M('blog');
		$ret = $tBlog->where("lang=\"{$this->lang}\"")->order('createtime DESC')->limit(6)->select();
		foreach($ret as $a => $b) {
			$ret[$a]['url'] = U('Blog/view', array(
				'id' => $b['id']
			));
		}
		$this->assign('blogs', $ret);
		unset($tBlog);
		
		//显示
		unset($ret);
		$this->assign('selectedTab', 'blog');
		import('ORG.Util.String');	//导入切割字符串的函数
		$this->display();
    }
}