<?php
class GlobalAction extends Action {
    public function __construct(){
		//No IE<=8
		$this->noie();
		//设置语言变量
		$this->setLang();
		
		/* 头部与尾部数据查询 */
		$this->assignActiv();
		$this->assignStaff();
	}
	
	//No IE
	private function noie() {
		preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
		if (count($matches)>1 && !isset($_COOKIE['ignore_ie'])){
			$version = $matches[1];
			if($version<=8) {
				$this->redirect('Error/noie', array(
					'r' => base64_encode($_SERVER['REQUEST_URI'])	//记录下请求页面
				));
				exit();
			}
		}
	}
	
	//语言
	protected $lang;
	private function setLang() {
		$this->lang = L('lang');
	}
	
	//近期活动
	private function assignActiv() {
		$tActivities = M('activities');
		$ret = $tActivities->field('title,place,date_start,date_end')->where("lang=\"{$this->lang}\"")->order('date_end DESC')->limit(3)->select();
		$this->assign('activities', $ret);
		unset($tActivities);
	}
	
	//底部职员
	private function assignStaff(){
		$tStaff = M('staff');
		$ret = $tStaff->where("lang=\"{$this->lang}\"")->order('queue ASC')->limit(4)->select();
		$this->assign('staffs', $ret);
		unset($tStaff);
	}
	
}