<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function index(){
        $this->assign('config',$this->config);
		//读取最新动态
		$where['cate_id'] = array('in','10,15,16');
		$this->news = M('Article')->where($where)->limit(4)->select();
		//甜品展示
		$data['cate_id'] = array('in','11,17');
		$this->tian = M('Article')->where($data)->limit(6)->select();
        $this->display();
    }
	
	
	//表单提交
	Public function put(){
		$yzm = I('post.yzm');  
		$verify = new \Think\Verify();
		$yzmyz=$verify->check($yzm);
		if(!$yzmyz){
					$this->error('验证码错误',0,0);	 
			}
		$data = array(
			'name' => I('post.lc_name'),
			'tel' => I('post.lc_tel'),
			'email' => I('post.lc_email'),
			'address' => I('post.lc_address'),
			'content' => I('post.lc_content'),
			'addtime' => date('Y-m-d')
		);
		if(M('Put')->add($data)){
			$this->success('提交成功');
		}else{
			$this->error('提交失败');
		}
		
	}
	
	public function tel(){
		$data['types'] = I('types');
		if(!$data['types']){
			$data['types'] = 'AAAA';
		}
		//$limits = 10;// 获取总条数
        $count = M('tel')->where($data)->count();//计算总页面
		//分页
        $Page = new \Think\Page($count, 10);
		//显示分页
		$this->page = $Page->show();
		
		$this->tel = M('tel')->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->display();
	}
	//查询电话
	public function search(){
		$tel = I('num1').I('num2').I('num3').'-'.I('num4').I('num5').I('num6').'-'.I('num7').I('num8').I('num9').I('num10');
		$data = array(
			'tel'=>$tel,
		);
		$result = M('tel')->where($data)->find();
		if($result){
			$this->ajaxReturn($result);
		}else{
			$this->ajaxReturn('数据中没有该电话');
		}
		
	}
	public function tt(){
		$data['types'] = I('types');
		
		$result = M('tel')->where($data)->limit(10)->select();
		if($result){
			$this->ajaxReturn($result);
		}else{
			$this->ajaxReturn('没有数据！');
		}
	}
}
