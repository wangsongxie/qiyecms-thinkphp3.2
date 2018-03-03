<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends BaseController {
	
	public function footer(){
		$this->display();
	}
	public function put(){
		if(empty($_POST)){ $this->error('数据不能为空'); }
		$data = array(
			'name' => I('post.lc_name'),
			'tel' => I('post.lc_tel'),
			'content' => I('post.lc_content'),
			'addtime' => date('Y-m-d')
		);
		if(M('Put')->add($data)){
			$this->success('提交成功');
		}else{
			$this->error('提交失败');
		}
	}
}
?>