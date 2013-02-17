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
	
	private function _uploadImg($path, $maxSize = 2097152, $saveRule = time, $thumb = false) {
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize  = $maxSize;
		$upload->allowExts  = array('jpg', 'png', 'jpeg');
		$upload->allowTypes=array('image/png','image/jpg', 'image/jpeg');
		$upload->savePath =  $path;
		$upload->saveRule = $saveRule;
		
		if($thumb) {
			$upload->thumb = true;
			$upload->thumbMaxWidth = '200';
			$upload->thumbMaxHeight = '200';	
		}
		
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
	//Upload photo to Gallery
	public function photos(){
		if(isset($_FILES['photo'])){
			$photos = $this->_uploadImg('./Uploads/galleries/', 5000000, 'uniqid', true);
			$tPhoto = M('photo');
			foreach($photos as $photo) {
				$tPhoto->add(array(
					'filename' => $photo['savename'],
					'aid' => intval($_POST['album_id']),
					'createtime' => time()
				));
			}
			$this->success('上传成功！', U("Gallery/album?id={$_POST['album_id']}"));
		} else {
			$this->error('请选择文件!');
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
	
	
	public function brochure(){
		$this->display();	
	}
	public function do_brochure(){
		if(isset($_FILES['brochure'])){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize  = 20971520;	//20M
			$upload->allowExts  = explode(',', 'doc,docx,pdf');
			$upload->savePath =  './Uploads/docs/';
			$upload->saveRule = time;
			
			if(!$upload->upload()) {
				$this->error($upload->getErrorMsg());
			}else{
				$info = $upload->getUploadFileInfo();
				$this->assign('brochure', $info[0]['savename']);
				$this->display();
			}
		} else {
			$this->error('上传失败！');
		}
	}
	
	
}