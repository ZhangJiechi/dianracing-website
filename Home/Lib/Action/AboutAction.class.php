<?php
include(APP_PATH.'/Lib/Action/GlobalAction.class.php');

class AboutAction extends GlobalAction {
	public function index() {
		$tContent = M('content');
		$ret = $tContent->where("key=\"team_{$this->lang}\"")->find();
		$this->assign('team', $ret['value']);
		
		$ret = $tContent->where("key=\"car_general_{$this->lang}\"")->find();
		$this->assign('car', $ret['value']);
		
		unset($tContent);
		
		$tStar = M('star');
		$ret = $tStar->where("lang=\"{$this->lang}\"")->order('id DESC')->limit(6)->select();
		foreach($ret as $star) {
			$stars[] = array(
				'iscurrent' => $star['id'] == $id,
				'name' => $star['name'],
				'face' => $star['faceimg'],
				'href' => U('About/star', array(
					'id' => $star['id']
				))
			);
		}
		$this->assign('stars', $stars);
		unset($ret);
		unset($stars);
		
		$this->display();
	}
	
	public function team() {
		$tContent = M('content');
		$ret = $tContent->where("key=\"team_{$this->lang}\"")->find();
		$this->assign('general', $ret['value']);
		unset($tContent);

		$tTeam = M('group');
		$tMember = M('member');
		$teams = array();
		$ret = $tTeam->where("lang=\"{$this->lang}\" AND gtype>0 AND children<>'-'")->order('gtype ASC')->select();
		foreach($ret as $key => $value) {
			$teams[$key] = array(
				'name' => $value['name'],
				'members' => array()
			);
			$tt = $tMember->field('face,name')->where("lang=\"{$this->lang}\" AND gtype={$value['gtype']}")->select();
			foreach($tt as $t) {
				$teams[$key]['members'][] = $t;
			}
			if(!empty($value['children'])) {
				$teams[$key]['child'] = array();
				$gg = $tTeam->where("lang=\"{$this->lang}\" AND gtype in ({$value['children']})")->order('sort ASC')->select();
				foreach($gg as $k => $g) {
					$teams[$key]['child'][$k] = array(
						'name' => $g['name'],
						'members' => array()
					);
					$tt = $tMember->field('face,name')->where("lang=\"{$this->lang}\" AND gtype={$g['gtype']}")->select();
					foreach($tt as $t) {
						$teams[$key]['child'][$k]['members'][] = $t;
					}
				}
			}
		}
		$this->assign('teams', $teams);
		unset($teams);
		
		$ret = $tTeam->field('name')->where("lang=\"{$this->lang}\" AND gtype=0")->find();
		$this->assign('advisorTitle', $ret['name']);
		
		$ret = $tMember->where("lang=\"{$this->lang}\" AND gtype=0")->select();
		$this->assign('advisor', $ret);
		unset($tTeam);
		unset($tMember);
		
		$this->display();
	}
	
	public function star() {
		$tStar = M('star');
		if(isset($_GET['id'])) {
			$id = intval($_GET['id']);
			$ret= $tStar->where("id={$id}")->find();
		} else {
			$ret= $tStar->where("lang=\"{$this->lang}\"")->order('id DESC')->find();
			$id = $ret['id'];
		}
		$this->assign('currentstar', $ret);
		
		$stars = array();
		$ret = $tStar->where("lang=\"{$this->lang}\"")->order('id DESC')->select();
		foreach($ret as $star) {
			$stars[] = array(
				'iscurrent' => $star['id'] == $id,
				'name' => $star['name'],
				'face' => $star['faceimg'],
				'href' => U('About/star', array(
					'id' => $star['id']
				))
			);
		}
		$this->assign('stars', $stars);
		unset($ret);
		unset($stars);
		
		$this->display();
	}
	
	public function car() {
		$tContent = M('content');
		$ret = $tContent->where("key=\"car_general_{$this->lang}\"")->find();
		$this->assign('general', $ret['value']);
		
		$ret = $tContent->where("key=\"car_addition_{$this->lang}\"")->find();
		$this->assign('addition', $ret['value']);
		
		unset($ret);
		unset($tContent);
		
		$this->display();
	}
}