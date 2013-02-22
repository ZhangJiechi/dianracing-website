<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class BlogAction extends GlobalAction {
    public function index(){
		//参数
		$currentPage = isset($_GET['p'])?intval($_GET['p']):1;
		$numPerPage = 5;
		
		//读取数据
		$tBlog = M('blog');
		$ret = $tBlog->where("lang=\"{$this->lang}\"")->order('createtime')->page("{$currentPage},{$numPerPage}")->select();
		
		//生成URL
		foreach($ret as $a => $b) {
			$ret[$a]['url'] = U('Blog/view', array(
				'id' => $b['id']
			));
		}
		$this->assign('blogs', $ret);
		unset($ret);
		
		//分页类
		import('ORG.Util.Page');
		$count = $tBlog->where("lang=\"{$this->lang}\"")->count();
		unset($tBlog);
		$Page = new Page($count, $numPerPage);
		$Page->setConfig('prev', '◀');
		$Page->setConfig('next', '►');
		$Page->setConfig('theme', '<span class="nav">%upPage%</span> <span class="num">%linkPage%</span> <span class="nav">%downPage%</span>');
		$pageNavi = $Page->show();
		unset($Page);
		$this->assign('page', $pageNavi);
		
		//显示
		$this->assign('selectedTab', 'blog');
		import('ORG.Util.String');	//导入切割字符串的函数
		$this->display();
    }
	
	//单篇日志
	public function view() {
		if(!isset($_GET['id'])) {
			$this->error('参数错误！');
			exit();
		}
		$id = intval($_GET['id']);
		
		$tBlog = M('blog');
		$ret = $tBlog->where("id={$id}")->find();
		$this->assign('blog', $ret);
		unset($tBlog);
		
		$this->assign('selectedTab', 'blog');
		$this->assign('prevPage', $_SERVER['HTTP_REFERER']);
		$this->assign('lang', $this->lang);
		$this->display();
	}
}