<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class IndexAction extends GlobalAction {
    public function index(){
		//语言
		$lang = L('lang');
		
		//近期活动
		$tActivities = M('activities');
		$ret = $tActivities->field('title,place,date_start,date_end')->where("lang=\"{$lang}\"")->order('date_end DESC')->limit(3)->select();
		$this->assign('activities', $ret);
		unset($tActivities);
		
		//每月之星
		$tStar = M('star');
		$ret = $tStar->where("lang=\"{$lang}\"")->order('id DESC')->limit(3)->select();
		$this->assign('stars', $ret);
		unset($tStar);
		
		//底部职员
		$tStaff = M('staff');
		$ret = $tStaff->where("lang=\"{$lang}\"")->order('queue ASC')->limit(4)->select();
		$this->assign('staffs', $ret);
		unset($tStaff);
		
		//member
		$tMember = M('member');
		$ret = $tMember->field('face,text')->where("lang=\"{$lang}\" AND gtype=0")->find();
		$this->assign('member', $ret);
		unset($tMember);
		//team
		$tTeam = M('group');
		$ret = $tTeam->field('gtype,name')->where("lang=\"{$lang}\" AND gtype>0 AND children<>'-'")->order('gtype ASC')->select();
		$this->assign('teams', $ret);
		unset($tTeam);
		
		//显示
		$this->assign('selectedTab', 'index');
		$this->display();
    }
}