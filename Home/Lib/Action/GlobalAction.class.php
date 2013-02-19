<?php
class GlobalAction extends Action {
    public function __construct(){
		//No IE<=8
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
}