<?php


namespace Otcms\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class LogsController extends AuthController {
	

    //操作日志
    public function logs_list(){
                   
        $key=I('key');

        if($key&&$key!=""){
            $map = array(
                'admin_name' =>array('like', $key),
                'description'=>array('like', $key),                
                '_logic'     =>'or',
            );
            
        }

        $sldate=urldecode(I('reservation',''));//获取格式 2015-11-12 - 2015-11-18
        $arr = explode(" - ",$sldate);//转换成数组
        $arrdateone=strtotime($arr[0]);
        $arrdatetwo=strtotime($arr[1].' 23:55:55');  

        if($arrdateone && $arrdatetwo){
            $map['add_time'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
        }     

        $count= M('Log')->where($map)->count();// 查询满足要求的总记录数
        $p= getpage($count,C('DB_PAGENUM'));// 实例化分页类 传入总记录数和每页显示的记录数
        $p->parameter=I('param.');
        $show= $p->show();// 分页显示输出
        $list=D('Log')->where($map)->limit($p->firstRow.','.$p->listRows)->order('log_id desc')->select();
        $this->assign('s',$sldate);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('val',$key); 
        $this->display();

    }



    //访客日志
    public function visitor_list(){
    	
        $keytype=I('keytype',admin_name);  
        $key=I('key');
        $datatype_id=I('datatype_id');      
        $map[$keytype]= array('like',"%".$key."%");

        $sldate=I('reservation','');//获取格式 2015-11-12 - 2015-11-18
        $arr = explode(" - ",$sldate);//转换成数组
        $arrdateone=strtotime($arr[0]);
        $arrdatetwo=strtotime($arr[1].' 23:55:55');      
        $map['add_time'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
        $count= M('visitor_logs')->where($map)->count();// 查询满足要求的总记录数
        $Page= new \Think\Page($count,C('DB_PAGENUM'));// 实例化分页类 传入总记录数和每页显示的记录数
        $show= $Page->show();// 分页显示输出
        $list=D('visitor_logs')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('c_id desc')->select();
        //var_dump($list);exit;
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('val',$key);  
        $this->display();

    }
     	
}