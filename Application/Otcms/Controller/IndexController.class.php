<?php


namespace Otcms\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class IndexController extends AuthController {
	
/*
                   _ooOoo_
                  o8888888o
                  88" . "88
                  (| -_- |)
                  O\  =  /O
               ____/`---'\____
             .'  \\|     |//  `.
            /  \\|||  :  |||//  \
           /  _||||| -:- |||||-  \
           |   | \\\  -  /// |   |
           | \_|  ''\---/''  |   |
           \  .-\__  `-`  ___/-. /
         ___`. .'  /--.--\  `. . __
      ."" '<  `.___\_<|>_/___.'  >'"".
     | | :  `- \`.;`\ _ /`;.`/ - ` : | |
     \  \ `-.   \_ __\ /__ _/   .-` /  /
======`-.____`-.___\_____/___.-`____.-'======
                   `=---='
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
         佛祖保佑       永无BUG
*/
	
    public function index(){

    	if (empty($_SESSION['aid'])){
    		$this->redirect('Login/login');
    	}

    
	
	    $this->display();
       
    }
	
	 public function indexpage(){

    	if (empty($_SESSION['aid'])){
    		$this->redirect('Login/login');
    	}

    	$info = array(
  			'PCTYPE'=>PHP_OS,
  			'RUNTYPE'=>$_SERVER["SERVER_SOFTWARE"],
  			'ONLOAD'=>ini_get('upload_max_filesize'),
  			'ThinkPHPTYE'=>THINK_VERSION,
    	);

		$arclists = M('article')->order('a_views desc')->limit(5)->select();
		$this->assign('arclists',$arclists);


		$loglists = M('log')->order('add_time desc')->limit(10)->select();
		$this->assign('loglists',$loglists);

    	$this->assign('info',$info);
	    $this->display();
       
    }

}