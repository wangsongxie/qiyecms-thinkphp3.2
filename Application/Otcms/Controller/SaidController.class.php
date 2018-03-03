<?php
namespace Otcms\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;
class SaidController extends AuthController {


	public function index() {
		
		$Said = D('Said');		
		$count = $Said -> count();
		$p = getpage($count, 10);
		$show = $p -> show();
		$list = $Said -> page(I('get.p')) -> limit(10) ->order('create_time desc')-> select();
		$this -> assign('list', $list);
		$this -> assign('page', $show);
		$this -> display();
	}


    public function add(){
		$dir=APP_PATH."Home/View/Said/";
		$file=scandir($dir);

		$showarray=array();
		foreach($file as $v){
			if(end(explode('.', $v))=="html"){

				if( strstr($v,"page")){
					$showarray[]=$v;
				}
			}
		}
		$this->assign('showarray',$showarray);
        $this->display();
    }


    public function runadd()
    {
        if (!IS_AJAX) {
            $this->error('提交方式不正确', U('Said/add'), 0);
        } else {

			$create_time = strtotime(date("Y-m-d H:i:s", time()));
			$data['s_content'] = $_POST['s_content'];		
			$data['create_time'] = $create_time;		
			$data['s_from'] = getOS();
			$data['s_img'] = session('admin.userimg');	
			$data['s_writer'] = trim(I('post.s_writer', '', 'htmlspecialchars'));
			$data['title'] = trim(I('post.title', '', 'htmlspecialchars'));
			$data['keyword'] = trim(I('post.keyword', '', 'htmlspecialchars'));
			$data['remark'] = trim(I('post.remark', '', 'htmlspecialchars'));
			$data['s_view'] = trim(I('post.s_view', '', 'htmlspecialchars'));
			$data['photo'] = trim(I('post.photo', '', 'htmlspecialchars'));
			$data['articlehtml'] = trim(I('post.articlehtml'));

			$data['create_ip'] = get_client_ip();

			if ($data['s_content'] == null) {
				$this -> error('单页内容不能为空');
				return;
			}			                 
			
            M('Said')->add($data);
			
            $this->success('单页发表成功', U('Said/index'), 1);
        }
    }


	public function edit() {
		
		$detail = M('Said')->where(array('s_id' => I('s_id')))->find();
        $this->assign('detail', $detail);

		$dir=APP_PATH."Home/View/Said/";
		$file=scandir($dir);

		$showarray=array();
		foreach($file as $v){
			if(end(explode('.', $v))=="html"){

				if( strstr($v,"page")){
					$showarray[]=$v;
				}
			}
		}
		$this->assign('showarray',$showarray);

        $this->display();
		
	}

	public function said_state() {
		$id=I('id');
		if (empty($id))
		{
			$this->error('非法操作',U('index'),1);
		}
		$status=M('said')->where(array('s_id'=>$id))->getField('s_view');//判断当前状态情况
		if($status==1)
		{
			$statedata = array('s_view'=>0);
			$auth_group=M('said')->where(array('s_id'=>$id))->setField($statedata);
			$this->success('状态禁止',1,1);
		}
		else
		{
			$statedata = array('s_view'=>1);
			$auth_group=M('said')->where(array('s_id'=>$id))->setField($statedata);
			$this->success('状态开启',1,1);
		}
	}


	public function runedit() {

		$s_id = I('s_id', '', htmlspecialchars);
		
		if (!IS_AJAX) {
            $this->error('提交方式不正确', U('Said/edit'), 0);
        } else {
           
			$create_time = strtotime(date("Y-m-d H:i:s", time()));
			$data['s_content'] = $_POST['s_content'];					
			$data['title'] = trim(I('post.title', '', 'htmlspecialchars'));
			$data['keyword'] = trim(I('post.keyword', '', 'htmlspecialchars'));
			$data['remark'] = trim(I('post.remark', '', 'htmlspecialchars'));
			$data['s_writer'] = trim(I('post.s_writer', '', 'htmlspecialchars'));
			$data['s_view'] = trim(I('post.s_view', '', 'htmlspecialchars'));
			$data['photo'] = trim(I('post.photo', '', 'htmlspecialchars'));
			$data['articlehtml'] = trim(I('post.articlehtml'));
			if ($data['s_content'] == null) {
				$this -> error('单页内容不能为空');
				return;
			}			

            M('Said')->where('s_id='.$s_id)->save($data);
			
            $this->success('单页发表成功', U('Said/index'), 1);
        }
	}

    public function del() {

        $p = I('p');
        M('said')->where(array('s_id' => I('s_id')))->delete();
        $this->redirect('index', array('p' => $p));

    }

}
