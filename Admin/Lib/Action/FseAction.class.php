<?php
include(APP_PATH.'/Lib/Action/AuthAction.class.php');

class FseAction extends AuthAction {
	
	public function index(){
		$tFse = M('fse');
        $fses = $tFse->order('id DESC')->select();
        $this->assign(array(
            'account' => $_SESSION['account'],
            'isLogin' => true,
            'fses' => $fses
        ));
        $this->display();
	}
	
	
    public function create(){
        $this->assign(array(
            'account' => $_SESSION['account'],
            'isLogin' => true
        ));
        $this->display();
    }
    
    public function do_create() {
        if($this->isPost()){
            $tFse = M('fse');
            $tFse->create();
            $tFse->add();
            $this->success('添加成功！', U('Fse/index'));
        }
    }
    
    public function edit() {
        $tFse = M('fse');
        $fse = $tFse->where("id={$_GET['id']}")->find();
        $this->assign(array(
            'account' => $_SESSION['account'],
            'isLogin' => true,
            'fse' => $fse
        ));
        $this->display();
    }
    
    public function do_edit() {
        if($this->isPost()){
            $tFse = M('fse');
            $tFse->create();
            $tFse->save();
            $this->success('更新成功！', U('Fse/index'));   
        }
    }
    
    public function remove(){
        if($this->isPost()){
            $delRange = implode(',', $_POST['fseToDel']);
            $tFse = M('fse');
            $tFse->where("id IN ({$delRange})")->delete();
            $this->success('删除成功！', U('Fse/index'));
        }
    }
}