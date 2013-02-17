<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class GalleryAction extends AuthAction {
	
	public function index(){
		$tGallery = M('album');
		$galleries = $tGallery->order('createtime DESC')->select();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'galleries' => $galleries
		));
		$this->display();
	}
	
	//Create a Gallery
	public function create(){
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true
		));
		$this->display();
	}
	public function do_create() {
		if($this->isPost()){
			$tGallery = M('album');
			$tGallery->create();
			$tGallery->createtime = time();
			$tGallery->add();
			$this->success('添加成功！', U('Gallery/index'));
		}
	}
	
	//Rename the Gallery
	public function rename(){
		$tGallery = M('album');
		$gallery = $tGallery->where("id={$_GET['id']}")->find();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'gallery' => $gallery
		));
		$this->display();
	}
	public function do_rename() {
		if($this->isPost()){
			$tGallery = M('album');
			$tGallery->create();
			$tGallery->save();
			$this->success('更新成功！', U('Gallery/index'));
		}
	}
	//删除相册
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['galleryToDel']);
			$tGallery = M('album');
			$tGallery->where("id IN ({$delRange})")->delete();
			$tPhoto = M('photo');
			$photos = $tPhoto->where("aid IN ({$delRange})")->select();
			foreach($photos as $photo) {
				unlink("./Uploads/galleries/{$photo['filename']}");
				unlink("./Uploads/galleries/thumb_{$photo['filename']}");
			}
			$this->success('删除成功！', U('Gallery/index'));
		}
	}
	
	//Upload photos
	public function upload(){
		$this->display();
	}
	
	//do_upload => Upload/photos
	
	//Album
	public function album() {
		$tGallery = M('album');
		$gallery = $tGallery->where("id={$_GET['id']}")->find();
		$tPhoto = M('photo');
		$photos = $tPhoto->where("aid={$_GET['id']}")->order('createtime DESC')->select();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'photos' => $photos,
			'gallery' => $gallery,
			'id' => $_GET['id']
		));
		$this->display();
	}
	//删除照片
	public function del(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['photoToDel']);
			$tPhoto = M('photo');
			$photos = $tPhoto->field('filename')->where("id IN ({$delRange})")->select();
			$tPhoto->where("id IN ({$delRange})")->delete();
			foreach($photos as $photo) {
				unlink("./Uploads/galleries/{$photo['filename']}");
				unlink("./Uploads/galleries/thumb_{$photo['filename']}");
			}
			$this->success('删除成功！');
		}
	}
}