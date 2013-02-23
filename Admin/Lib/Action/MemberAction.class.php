<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class MemberAction extends AuthAction {
	
	public function index(){
		$tContent = M('content');
		$ret = $tContent->where('key="team_zh-cn"')->find();
		$this->assign('team_cn', $ret);
		$ret = $tContent->where('key="team_en-us"')->find();
		$this->assign('team_en', $ret);
		unset($tContent);
		
		$tMember = M('member');
		$members = $tMember->order('id DESC')->select();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'members' => $members
		));
		$this->display();
	}
	
	public function create(){
		$glist = $this->glist();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'glist' => $glist,
		));
		$this->display();
	}
	
	public function do_create() {
		if($this->isPost()){
			$tMember = M('member');
			$tMember->create();
			$tMember->add();
			$this->success('添加成功！', U('Member/index'));
		}
	}
	
	public function edit() {
		$tMember = M('member');
		$member = $tMember->where("id={$_GET['id']}")->find();
		$glist = $this->glist();
		$this->assign(array(
			'account' => $_SESSION['account'],
			'isLogin' => true,
			'member' => $member,
			'glist' => $glist
		));
		$this->display();
	}
	
	public function do_edit() {
		if($this->isPost()){
			$tMember = M('member');
			$tMember->create();
			$tMember->save();
			$this->success('更新成功！', U('Member/index'));	
		}
	}
	
	public function remove(){
		if($this->isPost()){
			$delRange = implode(',', $_POST['memberToDel']);
			$tMember = M('member');
			$tMember->where("id IN ({$delRange})")->delete();
			$this->success('删除成功！', U('Member/index'));
		}
	}
	
	private function glist() {
		$list = array(array(
			'name' => '',
			'group' => -1
		));
		$tGroup = M('group');
		$groups = $tGroup->where('lang="en-us" AND children<>"-"')->order('gtype ASC')->select();
		foreach($groups as $group) {
			$list[] = array(
				'name' => $group['name'],
				'group' => $group['gtype']
			);
			if(!empty($group['children'])) {
				$gg = $tGroup->where("lang=\"en-us\" AND gtype in ({$group['children']})")->order('gtype ASC')->select();
				foreach($gg as $g) {
					$list[] = array(
						'name' => " -- {$g['name']}",
						'group' => $g['gtype']
					);	
				}
			}
		}
		return $list;
	}
	
	public function general() {
		if($this->isPost()){
			$tContent = M('content');
			$tContent->create();
			$tContent->save();
			$this->success('保存成功!');
		}
	}

}