<?php


namespace Common\Controller;
use Think\Controller;
use Think\Auth;
use Think\Model;

//权限认证
class AuthController extends CommonController {


	protected function _initialize(){

        $this->assign('sys',M("Sys")->where('sys_id=1')->find());
		$this->assign('admin_group',session('admin_group'));//显示当前用户所属的会员组
		session('se',I('se'));

		if(!$_SESSION['aid']){
			$this->redirect('Login/login');
		}

		$not_check = array('Index/index','Sys/optimize','Sys/repair');//session存在时，不需要验证的权限

		//当前操作的请求                 模块名/方法名
		if(in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $not_check)){

            return true;
		}

		//动态判断权限
		$auth = new Auth();

		if(!$auth->check(CONTROLLER_NAME.'/'.ACTION_NAME,$_SESSION['aid']) && $_SESSION['aid']!= 1){

            $this->error('您没有操作权限',0,0);
		}


		//获取访客信息
		//$address = Getaddress(get_client_ip());

        // $info=array(

        //     'c_browser' => getUserBrowser(),
        //     'c_ip' => get_client_ip(),
        //     'c_os' => getOS(),
        //     'c_url' => get_url(),
        //     'c_address' => $address[0][1]."".$address[0][2],
        //     'add_time' => time(),

        // );

        //M('visitor_logs')->add($info);


	}
}
