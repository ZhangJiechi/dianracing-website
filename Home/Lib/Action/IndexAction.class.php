<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class IndexAction extends GlobalAction {
    public function index(){
		
		//每月之星
		$tStar = M('star');
		$ret = $tStar->where("lang=\"{$this->lang}\"")->order('id DESC')->limit(3)->select();
		$this->assign('stars', $ret);
		unset($tStar);
		
		//member
		$tMember = M('member');
		$ret = $tMember->field('face,text')->where("lang=\"{$this->lang}\" AND gtype=0")->find();
		$this->assign('member', $ret);
		unset($tMember);
		//team
		$tTeam = M('group');
		$ret = $tTeam->field('gtype,name')->where("lang=\"{$this->lang}\" AND gtype>0 AND children<>'-'")->order('gtype ASC')->select();
		$this->assign('teams', $ret);
		unset($tTeam);
		
		//blog
		$tBlog = M('blog');
		$ret = $tBlog->where("lang=\"{$this->lang}\"")->order('createtime DESC')->limit(5)->select();
		foreach($ret as $a => $b) {
			$ret[$a]['url'] = U('Blog/view', array(
				'id' => $b['id']
			));
		}
		$this->assign('blogs', $ret);
		unset($tBlog);
		
		//显示
		unset($ret);
		$this->assign('selectedTab', 'index');
		import('ORG.Util.String');	//导入切割字符串的函数
		$this->display();
    }
}