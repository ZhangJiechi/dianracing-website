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
		//News
		$tBlog = M('blog');
		$ret = $tBlog->where("lang=\"{$this->lang}\"")->order('createtime DESC')->limit($n)->select();
		foreach($ret as $a => $b) {
			$ret[$a]['url'] = U('Blog/view', array(
				'id' => $b['id']
			));
		}
		$this->assign('blogs', $ret);
		unset($tBlog);
		
		unset($ret);
		
		//每月之星
		$this->assignStar();
		
		//显示
		$this->assign('selectedTab', 'index');
		import('ORG.Util.String');	//导入切割字符串的函数
		$this->display();
    }
}