<?php
//登录注册类
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {

	//登录页面
    public function index(){
        $this->display();
    }

	//登录验证
    public function login(){

        if(IS_POST){
            $userModel = D('User');
            $data = $userModel->create();
            $res = $userModel->checkLogin($data);
            if(!empty($res)){
                session('loginInfo',$res);
                $this->success('登陆成功！',U('Friend/flist'));
            }else{
                $this->error('登陆失败！');
            }
        }
    }
	//注册页面
	public function reg(){
		if(empty($_POST)){
			$this->display();
		}else{
			if(M('User')->add($_POST)){
				$this->success('注册成功！');
			}else{
				$this->error('注册失败！');
			}
		}
	}
	//退出登录
    public function logout(){
        session('[destroy]'); // 销毁session
        $this->success('退出成功！',U('Login/index'));
    }
	
}