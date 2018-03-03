<?php
namespace Home\Controller;
use Think\Controller;
class SaidController extends BaseController {

    public function index(){
        $id['s_id']=I("get.id");
        $detail=M("Said")->where($id)->find();
        $this->config["sys_key"]=$detail['keysword'];
        $this->config["sys_des"]=$detail['miaoshu'];
        $this->config["sys_title"]=$detail['title']."-". $this->config["sys_title"];
        $this->assign('config',$this->config);


        $this->assign('detail', $detail);

        $detail['articlehtml']=str_replace(".html","", $detail['articlehtml']);
        $this->display($detail['articlehtml']);
    }
	public function verify(){
		$config =    array(
			'fontSize'    =>    45,    // 验证码字体大小
			'length'      =>    4,     // 验证码位数
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();	
		
	}




}
