<?php
class IndexAction extends Action {
    public function index(){
		$tActivities = M('activities');
		$lang = L('lang');
		$activities = $tActivities->field('title,place,date_start,date_end')->where("lang=\"{$lang}\"")->order('date_end DESC')->limit(3)->select();
		$this->assign('activities', $activities);
		$this->display();
    }
}