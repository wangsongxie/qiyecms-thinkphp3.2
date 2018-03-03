<?php


namespace Otcms\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;
use Vendor\ThinkImage\ThinkImage;

class MemberController extends AuthController {

    public function index(){

        $key=I('key');

        if($key&&$key!=""){
            $map = array(
                'user_number' =>array('like', "%" . $key . "%"),
                'username'=>array('like', "%" . $key . "%"),
                '_logic'     =>'or',
            );

        }

        $sldate=urldecode(I('reservation',''));//获取格式 2015-11-12 - 2015-11-18
        $arr = explode(" - ",$sldate);//转换成数组
        $arrdateone=strtotime($arr[0]);
        $arrdatetwo=strtotime($arr[1].' 23:55:55');
        if($arrdateone && $arrdatetwo){
            $map['birthdate'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
        }

        $Nowpage = $_GET['page']?$_GET['page']:1;
        $limits = 10;// 获取总条数
        $count = M('member_list')->where($map)->count();//计算总页面
        $allpage = ceil($count / $limits);
        $allpage = intval($allpage);
        $lists = M('member_list')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
        foreach($lists as $k=>$v)
        {
            $lists[$k]['birthdate']=date('Y年m月d日',$v['birthdate']);
            $lists[$k]['create_time']=date('Y年m月d日',$v['create_time']);
        }
        $this->assign('Nowpage', $Nowpage);
        $this->assign('allpage', $allpage);
        $this->assign('s',$sldate);
        $this->assign('val',$key);
        //var_dump($_GET['page']);exit;
        if($_GET['page']){
            $this->success($lists);
        }
        $this->display();
    }

    //会员状态
    public function member_state()
    {
    	$id=I('id');
    	if (empty($id))
        {
    		$this->error('用户不存在',U('index'),1);
    	}
    	$status=M('member_list')->where(array('id'=>$id))->getField('state');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('state'=>0);
    		$auth_group=M('member_list')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态禁止',1,1);
    	}
        else
        {
    		$statedata = array('state'=>1);
    		$auth_group=M('member_list')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}

    }


    //添加会员
    public function add()
    {
    	if(!IS_AJAX)
        {
    		$this->display();
    	}
        else
        {
    		$obj=M('member_list');
            $data['username']=trim(I('post.username', '', 'htmlspecialchars'));
            $data['sex']=trim(I('post.sex', '', 'htmlspecialchars'));
            $data['birthdate']  = trim(I('post.birthdate', '', 'htmlspecialchars'));
            $data['birthdate']  = strtotime($data['birthdate']);
            $data['headpic']=trim(I('post.headpic', '', 'htmlspecialchars'));
            $data['email']=trim(I('post.email', '', 'htmlspecialchars'));
            $data['phone']=trim(I('post.phone', '', 'htmlspecialchars'));
            $data['address']=trim(I('post.address', '', 'htmlspecialchars'));
            $data['note']=trim(I('post.note', '', 'htmlspecialchars'));
            $data['create_time']=time();
            $data['state']=trim(I('post.state', '', 'htmlspecialchars'));
    		$obj->add($data);
    		$this->success('添加成功',U('index'),1);
    	}
    }

    //编辑会员
    public function edit(){

        if (!IS_AJAX){
    		$list=M('member_list')->where(array('id'=>I('id')))->find();
    		$this->assign('list',$list);
    		$this->display();
        }else{
            $obj=M('member_list');
            $data['id']=trim(I('post.id', '', 'htmlspecialchars'));
            $data['username']=trim(I('post.username', '', 'htmlspecialchars'));
            $data['sex']=trim(I('post.sex', '', 'htmlspecialchars'));
            $data['birthdate']  = trim(I('post.birthdate', '', 'htmlspecialchars'));
            $data['birthdate']  = strtotime($data['birthdate']);
            $data['headpic']=trim(I('post.headpic', '', 'htmlspecialchars'));
            $data['email']=trim(I('post.email', '', 'htmlspecialchars'));
            $data['phone']=trim(I('post.phone', '', 'htmlspecialchars'));
            $data['address']=trim(I('post.address', '', 'htmlspecialchars'));
            $data['note']=trim(I('post.note', '', 'htmlspecialchars'));
            $data['state']=trim(I('post.state', '', 'htmlspecialchars'));
            $obj->save($data);
            $this->success('修改成功',U('index'),1);
        }

	}

    //删除会员
    public function del(){
        $id=$_REQUEST['id'];
        $list = M('member_list')->where(array('id'=>$id))->delete();
        if($list){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }


}
