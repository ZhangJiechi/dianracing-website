<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class FseAction extends GlobalAction {
    public function index(){
		//Fse
		$tFse = M('fse');
        $fses = $tFse->where("lang=\"{$this->lang}\"")->select();
		$this->assign('fses', $fses);
		unset($tFse);
		unset($fses);
		
		//显示
		$this->assign('selectedTab', 'fse');
		$this->display();
    }
}