<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class IndexAction extends GlobalAction {
    public function index(){
		//Welcome
		$tContent = M('content');
		$ret = $tContent->field('value')->where("key=\"welcome_{$this->lang}\"")->find();
		$this->assign('welcome', $ret['value']);
		$ret = $tContent->field('value')->where("key=\"team_{$this->lang}\"")->find();
		$this->assign('teamgeneral', $ret['value']);
		unset($tContent);
		
		//member
		$tMember = M('member');
		$ret = $tMember->field('face,text')->where("lang=\"{$this->lang}\" AND gtype=0")->find();
		$this->assign('member', $ret);
		unset($tMember);
		//team
		$tTeam = M('group');
		$teams = array();
		$ret = $tTeam->where("lang=\"{$this->lang}\" AND gtype>0 AND children<>'-'")->order('gtype ASC')->select();
		foreach($ret as $key => $value) {
			$teams[$key] = array(
				'name' => $value['name'],
				'group' => $value['gtype']
			);
			if(!empty($value['children'])) {
				$gg = $tTeam->where("lang=\"{$this->lang}\" AND gtype in ({$value['children']})")->order('gtype ASC')->select();
				$teams[$key]['child'] = array();
				foreach($gg as $g) {
					$teams[$key]['child'][] = array(
						'name' => $g['name'],
						'group' => $g['gtype']
					);	
				}
			}
		}
		$this->assign('teams', $teams);
		unset($tTeam);
		unset($teams);
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