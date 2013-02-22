<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class SponsorAction extends GlobalAction {
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
		//General
		$tContent = M('content');
		$ret = $tContent->field('value')->where("key=\"sponsorship_{$this->lang}\"")->find();
		$this->assign('general', $ret['value']);
		$ret = $tContent->field('value')->where("key=\"brochure\"")->find();
		$this->assign('brochure', $ret['value']);
		unset($tContent);
		
		//sponsors
		$tSponsor = M('sponsor');
		$ret = $tSponsor->field('gtype')->where("lang=\"{$this->lang}\"")->group('gtype')->select();
		$sponsors = array();
		foreach($ret as $r) {
			$a = $r['gtype'];
			$b = $tSponsor->field('content')->where("lang=\"{$this->lang}\" AND gtype={$a}")->select();
			$sponsors[] = array(
				'type' => $this->sponsorType[$a][$this->lang],
				'content' => $b
			);
		}
		$this->assign('sponsors', $sponsors);
		
		unset($ret);
		
		//显示
		$this->assign('selectedTab', 'sponsor');
		$this->assign('lang', $this->lang);
		$this->display();
    }
}