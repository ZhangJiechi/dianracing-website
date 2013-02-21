<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class InfoAction extends AuthAction {
	//首页上的那些资料
	public function index() {
		
		$tContent = M('content');
		$ret = $tContent->where('key="welcome_zh-cn"')->find();
		$this->assign('welcome_cn', $ret);
		$ret = $tContent->where('key="welcome_en-us"')->find();
		$this->assign('welcome_en', $ret);
		
		$ret = $tContent->field('value')->where('key="index_downloads"')->find();
		$this->assign('downloads', unserialize($ret['value']));
		
		$this->display();
	}
	
	public function welcome() {
		$tContent = M('content');
		$tContent->create();
		$tContent->save();
		$this->success('保存成功!');
	}
	
	public function downloads(){
		$names = $_POST['filename'];
		$paths = $_POST['filepath'];
		$li = array();
		foreach($names as $a => $b) {
			$li[] = array(
				'name' => $b,
				'path' => $paths[$a]
			);
		}
		$tContent = M('content');
		$tContent->where('key="index_downloads"')->data(array(
			'value' => serialize($li)
		))->save();
		$this->success('保存成功!');
	}
}