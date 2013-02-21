<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class IndexAction extends GlobalAction {
    public function index(){
		//Welcome
		$tContent = M('content');
		$ret = $tContent->field('value')->where("key=\"welcome_{$this->lang}\"")->find();
		$this->assign('welcome', $ret['value']);
		unset($tContent);
		
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
		unset($ret);
		
		//每月之星，新闻，下载
		$this->assignStar();
		$this->assignBlogs(5);
		$this->assignDownload();
		
		//显示
		$this->assign('selectedTab', 'index');
		import('ORG.Util.String');	//导入切割字符串的函数
		$this->display();
    }
}