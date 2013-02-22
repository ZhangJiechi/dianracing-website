<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class FseAction extends GlobalAction {
    public function index(){
		//Fse
		$tContent = M('content');
		$ret = $tContent->field('value')->where("key=\"fse_{$this->lang}\"")->find();
		$this->assign('fse', $ret['value']);
		unset($tContent);
		unset($ret);
		
		//显示
		$this->assign('selectedTab', 'fse');
		$this->display();
    }
}