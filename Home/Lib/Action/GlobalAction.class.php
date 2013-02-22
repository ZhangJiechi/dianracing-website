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
		$this->assignDownload();
	}
	
	//是否IE6,7,8
	protected function isBadIE() {
		preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
		if (count($matches)>1){
			$version = $matches[1];
			return $version<=8? true : false;
		}
	}
	
	//No IE
	private function noie() {
		if ($this->isBadIE() && !isset($_COOKIE['ignore_ie'])){
			$this->redirect('Error/noie', array(
				'r' => base64_encode($_SERVER['REQUEST_URI'])	//记录下请求页面
			));
			exit();
		}
	}
	
	//语言
	protected $lang;
	private function setLang() {
		$this->lang = L('lang');
	}
	
	//近期活动
	protected function assignActiv($n = 3) {
		$tActivities = M('activities');
		$ret = $tActivities->field('title,place,date_start,date_end')->where("lang=\"{$this->lang}\"")->order('date_end DESC')->limit($n)->select();
		$this->assign('activities', $ret);
	}
	
	//底部职员
	protected function assignStaff($n = 4){
		$tStaff = M('staff');
		$ret = $tStaff->where("lang=\"{$this->lang}\"")->order('queue ASC')->limit($n)->select();
		$this->assign('staffs', $ret);
	}
	
	//每月之星
	protected function assignStar($n = 3){
		$tStar = M('star');
		$ret = $tStar->where("lang=\"{$this->lang}\"")->order('id DESC')->limit($n)->select();
		$this->assign('stars', $ret);
	}
	
	//下载&赞助商
	protected function assignDownload(){
		$tContent = M('content');
		$ret = $tContent->field('value')->where('key="index_downloads"')->find();
		$this->assign('downloads', unserialize($ret['value']));
		$ret = $tContent->field('value')->where('key="index_sponsor"')->find();
		$this->assign('sponsors', explode("\n", $ret['value']));
	}
	
	
	
}