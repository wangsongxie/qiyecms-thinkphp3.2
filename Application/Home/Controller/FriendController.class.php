<?php
//好友列表类
namespace Home\Controller;

use Think\Controller;

class FriendController extends Controller {
	//好留列表
    public function flist(){
        $loginUser = session('loginInfo.username');
        $this->assign('loginUser',$loginUser);


        $userModel = D('User');
        $res = $userModel->allFriend($loginUser);

        $this->assign('res',$res);

        $this->display();
    }



}