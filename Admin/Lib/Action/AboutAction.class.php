<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class AboutAction extends AuthAction {
	
	public function index(){
		$tmp = array();
		$tContent = M('content');
		foreach($this->lang as $l) {
			$ret = $tContent->where("key=\"car_general_{$l}\"")->find();
			$tmp[$l] = $ret;
		}
		$this->assign('general', $tmp);
		
		$tmp = array();
		foreach($this->lang as $l) {
			$ret = $tContent->where("key=\"car_addition_{$l}\"")->find();
			$tmp[$l] = $ret;
		}
		$this->assign('addition', $tmp);
		
		unset($tmp);
		unset($ret);
		unset($tContent);
		
		$this->display();
	}
	
	public function save() {
		$tContent = M('content');
		$tContent->create();
		$tContent->save();
		$this->success('更新成功！');
	}

}