<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class GalleryAction extends GlobalAction {
	
    public function index(){
		$tGallery = M('album');
		$galleries = $tGallery->where('hide=0')->order('createtime DESC')->select();
		unset($tGallery);
		
		$albums = array();
		$tPhoto = M('photo');
		foreach($galleries as $gallery) {
			$photos = $tPhoto->where("aid={$gallery['id']}")->order('createtime DESC')->limit(11)->select();
			$tmp = array();
			foreach($photos as $photo) {
				$tmp[] = array(
					'path' => $photo['filename'],
					'href' => U('Gallery/view', array('id' => $photo['id']))
				);
			}
			$albums[] = array(
				'href' => U('Gallery/album', array('id' => $gallery['id'])),
				'name' => $gallery['name'],
				'photos' => $tmp
			);
		}
		$this->assign('albums', $albums);
		
		//显示
		$this->assign('selectedTab', 'gallery');
		$this->display();
    }
	
	public function album() {
		$id = $this->checkId();
		
		$tGallery = M('album');
		$ret = $tGallery->field('name')->where("id={$id}")->find();
		unset($tGallery);
		$this->assign('albumname', $ret['name']);
		
		$tPhoto = M('photo');
		$ret = $tPhoto->where("aid={$id}")->order('createtime DESC')->select();
		unset($tPhoto);
		
		$photos = array();
		foreach($ret as $photo) {
			$photos[] = array(
				'path' => $photo['filename'],
				'href' => U('Gallery/view', array('id' => $photo['id']))
			);
		}
		$this->assign('photos', $photos);
		
        $this->assign('selectedTab', 'gallery');
		$this->display();
	}
	
	public function view() {
		$id = $this->checkId();
		
		$tPhoto = M('photo');
		$ret = $tPhoto->field('filename, aid')->where("id={$id}")->find();

		$aid = $ret['aid'];
		$this->assign('photo_src', $ret['filename']);
		$this->assign('back_href', U('Gallery/album', array('id' => $aid)));
		
		//PrevPage
		$ret = $tPhoto->field('id')->where("aid={$aid} AND id < {$id}")->order('id DESC')->find();
		if($ret) {
			$this->assign('prev_page', U('Gallery/view', array('id' => $ret['id'])));
		}
		
		//NextPage
		$ret = $tPhoto->field('id')->where("aid={$aid} AND id > {$id}")->order('id ASC')->find();
		if($ret) {
			$this->assign('next_page', U('Gallery/view', array('id' => $ret['id'])));
		}
		
        $this->assign('selectedTab', 'gallery');
		$this->display();
	}
	
	private function checkId() {
		if(!isset($_GET['id'])) {
			$this->error('参数错误');
			exit();
		}
		return intval($_GET['id']);
	}
}