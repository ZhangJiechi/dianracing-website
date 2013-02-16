<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class UploadAction extends AuthAction {
	//头像
	public function face(){
		$this->display();
	}
	public function do_face(){
		if(!empty($_FILES['faceimg']['name'])){
			$info = $this->_uploadImg('./Uploads/faces/');
			$this->assign('faceimg', $info[0]['savename']);
			$this->display();
		} else {
			$this->error('请选择文件！');	
		}
	}
	
	private function _uploadImg($path) {
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize  = 2097152;	//2M
		$upload->allowExts  = array('jpg', 'png', 'jpeg');
		$upload->allowTypes=array('image/png','image/jpg', 'image/jpeg');
		$upload->savePath =  $path;
		$upload->saveRule = time;
		
		if(!$upload->upload()) {
			$this->error($upload->getErrorMsg());
			exit();
		}else{
			return $upload->getUploadFileInfo();
		}
	}
	
	//图像
	public function ajax_pic(){
		if(isset($_FILES['filedata'])){
			$info = $this->_uploadImg('./Uploads/pics/');
			echo json_encode(array(
				'msg' => array(
					'url' => "/Uploads/pics/{$info[0]['savename']}",
					'localfile' => $info[0]['name'],
					'id' => 1
				),
				'err' => ''
			));
		} else {
			echo json_encode(array(
				'msg' => '',
				'err' => '上传失败！'
			));
		}
	}
	
	//封面
	public function cover(){
		$this->display();
	}
	public function do_cover(){
		if(!empty($_FILES['cover']['name'])){
			$info = $this->_uploadImg('./Uploads/cover/');
			$this->assign('cover', $info[0]['savename']);
			$this->display();
		} else {
			$this->error('请选择文件！');	
		}
	}
	
	//文档
	public function ajax_doc(){
		if(isset($_FILES['filedata'])){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize  = 10000000;	//10M
			$upload->allowExts  = explode(',', 'zip,rar,7z,txt,doc,xls,ppt,pdf,docx,xlsx,pptx,psd');
			$upload->savePath =  './Uploads/docs/';
			$upload->saveRule = time;
			
			if(!$upload->upload()) {
				echo json_encode(array(
					'msg' => '',
					'err' => $upload->getErrorMsg()
				));
			}else{
				$info = $upload->getUploadFileInfo();
				echo json_encode(array(
					'msg' => array(
						'url' => "/Uploads/docs/{$info[0]['savename']}",
						'localfile' => $info[0]['name'],
						'id' => 1
					),
					'err' => ''
				));
			}
		} else {
			echo json_encode(array(
				'msg' => '',
				'err' => '上传失败！'
			));
		}
	}
	
	
}