<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class SponsorAction extends AuthAction {
	private $sponsorType = array(
		array(
			'zh-cn' => '铂金赞助商（冠名赞助）',
			'en-us' => 'Platinum Sponsor (Title Sponsor)'
		),
		array(
			'zh-cn' => '黄金赞助商',
			'en-us' => 'Gold Sponsor'
		),
		array(
			'zh-cn' => '核心技术合作伙伴',
			'en-us' => 'Key Technology Sponsor'
		),
		array(
			'zh-cn' => '技术合作伙伴',
			'en-us' => 'Technology partner'
		),
	);
	
	public function index(){
		$general = array();
		$tContent = M('content');
		foreach($this->lang as $l) {
			$info = $tContent->field('value')->where("key=\"sponsorship_{$l}\"")->find();
			$general[$l] = $info['value'];
		}
		
		$info = $tContent->field('value')->where("key=\"brochure\"")->find();
		$brochure = $info['value'];
		
		$sponsors = array();
		$tSponsor = M('sponsor');
		foreach($this->sponsorType as $a => $t) {
			$sponsors[$a] = array();
			foreach($this->lang as $l) {
				$info = $tSponsor->where("type={$a} AND lang=\"{$l}\"")->find();
				$sponsors[$a][$l] = $info;	
			}
		}
		
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'general' => $general,
			'brochure' => $brochure,
			'sponsors' => $sponsors,
			'type' => $this->sponsorType,
			'lang' => $this->lang
		));
		$this->display();
	}
	
	public function general(){
		if($this->isPost()){
			$ss = array(
				'sponsorship_zh-cn',
				'sponsorship_en-us'
			);
			$tContent = M('content');
			foreach($ss as $s) {
				$tContent->where("key=\"{$s}\"")->save(array(
					'value' => $_POST[$s]
				));
			}
			$this->success('更新成功!');
		}
	}

	public function brochure(){
		if($this->isPost()){
			$tContent = M('content');
			$tContent->where("key=\"brochure\"")->save(array(
				'value' => $_POST['brochure']
			));
			$this->success('更新成功!');
		}
	}
	
	public function sponsor(){
		if($this->isPost()){
			$tSponsor = M('sponsor');
			foreach($this->sponsorType as $a => $t) {
				foreach($this->lang as $l) {
					$id = $_POST["sponsor_id_{$a}_{$l}"];
					$tSponsor->where("id={$id}")->save(array(
						'content' => $_POST["sponsor_{$a}_{$l}"]
					));
				}
			}
			$this->success('更新成功!');
		}
	}
}