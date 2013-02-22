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
		
		$tSponsor = M('sponsor');
		$sponsors = $tSponsor->select();
		foreach($sponsors as $i => $sponsor) {
			$sponsors[$i]['type'] = $this->sponsorType[$sponsor['gtype']]['zh-cn'];
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
		import('ORG.Util.String');
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
	
	
	public function create(){
		$this->assign('sponsortype', $this->sponsorType);
		$this->display();
	}
	
	public function do_create(){
		if($this->isPost()){
			$tSponsor = M('sponsor');
			$tSponsor->create();
			$tSponsor->add();
			$this->success('添加成功!', U('Sponsor/index'));
		}
	}
	
	public function edit(){
		$tSponsor = M('sponsor');
		$ret = $tSponsor->where("id={$_GET['id']}")->find();
		$this->assign('sponsor', $ret);
		$this->assign('sponsortype', $this->sponsorType);
		$this->display();
	}
	
	public function do_edit(){
		if($this->isPost()){
			$tSponsor = M('sponsor');
			$tSponsor->create();
			$tSponsor->save();
			$this->success('添加成功!');
		}
	}
	
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['sponsorToDel']);
			$tSponsor = M('sponsor');
			$tSponsor->where("id IN ({$delRange})")->delete();
			$this->success('删除成功！', U('Sponsor/index'));
		}
	}
	
}