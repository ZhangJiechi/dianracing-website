<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class FseAction extends AuthAction {
	
	public function index(){
		$fse = array();
		$tContent = M('content');
		foreach($this->lang as $l) {
			$info = $tContent->field('value')->where("key=\"fse_{$l}\"")->find();
			$fse[$l] = $info['value'];
		}
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'fse' => $fse
		));
		$this->display();
	}
	
	public function do_update() {
		if($this->isPost()){
			$tContent = M('content');
			foreach($this->lang as $l) {
				$tContent->where("key=\"fse_{$l}\"")->save(array(
					'value' => $_POST["fse_{$l}"]
				));
			}
			$this->success('更新成功！');
		}
	}
}