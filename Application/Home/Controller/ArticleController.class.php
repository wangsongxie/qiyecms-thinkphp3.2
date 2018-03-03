<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends BaseController {

    public function index(){
        $id=I("get.id");
        $cate=M("ArticleCate")->find($id);
		//dump($cate);
		$wheresd['pid'] = $cate['id'];
		$pcate=M("ArticleCate")->field('id,cate_name')->where($wheresd)->select();
		if(empty($pcate)){
			$pcate = M("ArticleCate")->field('id,cate_name')->where("pid=".$cate['pid'])->select();
		}
        
        $this->config["sys_key"]=$cate['keysword'];
        $this->config["sys_des"]=$cate['miaoshu'];
        if(!empty($pcate)){
            $this->config["sys_title"]=$cate['cate_name']."-". $pcate['cate_name']."-". $this->config["sys_title"];
        }else{
            $this->config["sys_title"]= $cate['cate_name']."-". $this->config["sys_title"];
        }

        $this->assign('config',$this->config);
        $cate['listhtml']=str_replace(".html","", $cate['listhtml']);
        $keyword=I("keyword");
        if($keyword){

            $where=' and a_title like "%'.$keyword.'%" ';
        }

        $catelist=M("ArticleCate")->where("pid=".$id." and state=1 ")->select();
        $cateids=$id;
        foreach($catelist as $v){
            $cateids.=",".$v['id'];
        }

        $count = M("Article")->where("cate_id in (".$cateids.") and state=1 ".$where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出

        $this->assign("cate", $cate);
        $this->assign("pcate", $pcate);
        $yeshu=intval(I("p"));
        $yeshu= $yeshu>0? $yeshu:1;

        $start=($yeshu-1)*20;



        $artlist=M("Article")->where("cate_id in (".$cateids.") and state=1 ".$where)->limit($start,20)->select();
        $this->assign('artlist',$artlist);
        $this->display($cate['listhtml']);
    }


    public function show(){
        $id=I("get.id");
        $detail=M("Article")->find( $id);

        $cate=M("ArticleCate")->find( $detail["cate_id"]);
        $pcate=M("ArticleCate")->find($cate['pid']);
		//读取子栏目
		$wheresd['pid'] = $cate['id'];
		$pcate=M("ArticleCate")->field('id,cate_name')->where($wheresd)->select();
		//子栏目下读取平级栏目
		if(empty($pcate)){
			$pcate = M("ArticleCate")->field('id,cate_name')->where("pid=".$cate['pid'])->select();
		}
        $this->config["sys_key"]=$cate['keysword'];
        $this->config["sys_des"]=$cate['miaoshu'];

        if(!empty($pcate)){
            $this->config["sys_title"]=$detail['a_title']."-".$cate['cate_name']."-". $pcate['cate_name']."-". $this->config["sys_title"];
        }else{
            $this->config["sys_title"]=$detail['a_title']."-". $cate['cate_name']."-". $this->config["sys_title"];
        }
        $this->assign('config',$this->config);
        $cate['articlehtml']=str_replace(".html","", $cate['articlehtml']);

        $datas=unserialize($detail['datas']);



        foreach( $datas as $k=>$v){
            $detail[$k]=$v;

        }
        $this->assign("cate", $cate);
        $this->assign("pcate", $pcate);
        $a=array("a"=>"red","b"=>"green");
		//上一篇
		$pre = $id + 1;
		$this->pre = M('Article')->field('a_id,a_title')->find($pre);
		//下一篇
		$next = $id - 1;
		$this->nex = M('Article')->field('a_id,a_title')->find($next);
        

        $this->assign('detail', $detail);

        $this->display($cate['articlehtml']);
    }

}
