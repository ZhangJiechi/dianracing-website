<?php
class IndexAction extends Action {
    public function index(){
		//近期活动
		$tActivities = M('activities');
		$lang = L('lang');
		$activities = $tActivities->field('title,place,date_start,date_end')->where("lang=\"{$lang}\"")->order('date_end DESC')->limit(3)->select();
		$this->assign('activities', $activities);
		
		//每月之星
		$tStar = M('star');
		$lang = L('lang');
		$stars = $tStar->where("lang=\"{$lang}\"")->order('id DESC')->limit(3)->select();
		$this->assign('stars', $stars);
		
		//职员
		$tStaff = M('staff');
		$lang = L('lang');
		$staffs = $tStaff->where("lang=\"{$lang}\"")->order('queue ASC')->limit(4)->select();
		$this->assign('staffs', $staffs);
		
		//显示
		$this->display();
    }
}