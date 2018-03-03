<?php


namespace Otcms\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;
use Think\Model;
use Think\Db;
use OT\Database;

class SysController extends AuthController {

    //站点设置
    public function sys()
    {
        if (!IS_AJAX)
        {
    	   $sys=M('sys')->where(array('sys_id'=>1))->find();
    	   $this->assign('sys',$sys)->display();
    	}
        else
        {
    		M('sys')->save($_POST);
    		$this->success('设置保存成功',1,1);
    	}

    }
    

   
    //发送邮件设置
    public function emailsys()
    {
        if (!IS_AJAX)
        {
            $sys=M('sys')->where(array('sys_id'=>1))->find();
            $this->assign('sys',$sys)->display();
    	}
        else
        {
    		M('sys')->save($_POST);
    		$this->success('邮件设置保存成功',1,1);
    	}
    
    }

    //删除缓存
    public function clearRuntime() 
    {          
        delFileByDir(APP_PATH.'Runtime/'); 
        $this->success('删除缓存成功！');
    }
    
    
/************************************管理员模块****************************************/
    
	public function admin_list(){

		$admin=M('admin');
		$val=I('val');
		$auth = new Auth();
		$this->assign('testval',$val);
		if($val){
			$map['admin_username']= array('like',"%".$val."%");
		}
		
		$count= $admin->where($map)->count();// 查询满足要求的总记录数
		$Page= new \Think\Page($count,C('DB_PAGENUM'));// 实例化分页类 传入总记录数和每页显示的记录数

		foreach($map as $key=>$val) {
			$Page->parameter[$key]=urlencode($val);
		}

		$show= $Page->show();// 分页显示输出
		$admin_list=$admin->where($map)->order('admin_id')->limit($Page->firstRow.','.$Page->listRows)->select();

		foreach ($admin_list as $k=>$v){
			$group = $auth->getGroups($v['admin_id']);
			$admin_list[$k]['group'] = $group[0]['title'];
		}
		
		$this->assign('admin_list',$admin_list);
		$this->assign('page',$show);		
		$this->display();
	}
    




    public function admin_list_add(){
        
        if (!IS_AJAX){
    		$auth_group=M('auth_group')->select();
    		$this->assign('auth_group',$auth_group);
    		$this->display();
        }else{
            $admin=M('admin');
    		$admin_access=M('auth_group_access');
    		$check_user=$admin->where(array('admin_username'=>I('admin_username')))->find();
    		if ($check_user){
    			$this->error('用户已存在，请重新输入用户名',0,0);
    		}
    		$sldata=array(
    			'admin_username'=>I('admin_username'),
    			'admin_pwd'=>I('admin_pwd','','md5'),
    			'admin_email'=>I('admin_email'),
                'admin_img'=>I('admin_img'),
    			'admin_tel'=>I('admin_tel'),
    			'admin_open'=>I('admin_open'),
    			'admin_realname'=>I('admin_realname'),
    			'admin_ip'=>get_client_ip(),
    			'admin_addtime'=>time(),
    		);
    		$result=$admin->add($sldata);
    		$accdata=array(
    			'uid'=>$result,
    			'group_id'=>I('group_id'),
    		);
    		$admin_access->add($accdata);
    		$this->success('用户添加成功',U('admin_list'),1);
        }  
		
	}

	

	public function admin_list_edit(){
            
        if (!IS_AJAX){
        	$auth_group=M('auth_group')->select();
    		$admin_list=M('admin')->where(array('admin_id'=>I('admin_id')))->find();
    		$auth_group_access=M('auth_group_access')->where(array('uid'=>$admin_list['admin_id']))->getField('group_id');
    		$this->assign('admin_list',$admin_list);
    		$this->assign('auth_group',$auth_group);
    		$this->assign('auth_group_access',$auth_group_access);
    		$this->display();
        }else{
            $admin_list=M('admin');
            $admin_pwd=I('admin_pwd');
            $group_id=I('group_id');
            $admindata['admin_id']=I('admin_id');
            if ($admin_pwd){
                $admindata['admin_pwd']=I('admin_pwd','','md5');
            }
            $admindata['admin_email']=I('admin_email');
            $admindata['admin_img']=I('admin_img');
            $admindata['admin_tel']=I('admin_tel');
            $admindata['admin_realname']=I('admin_realname');
            $admindata['admin_open']=I('admin_open');
            $admin_list->save($admindata);
            //修改用户组
            M('auth_group_access')->where(array('uid'=>I('admin_id')))->setField('group_id',$group_id);
            $this->success('用户修改成功',U('admin_list'),1);
        }
            		
	}
	
	

    public function admin_list_del()
    {

        $admin_id=I('admin_id');
    	if (empty($admin_id))
        {
    		$this->error('用户ID不存在',U('admin_list'),1);
    	}
    	M('admin')->where(array('admin_id'=>I('admin_id')))->delete();
    	M('auth_group_access')->where(array('uid'=>I('admin_id')))->delete();
    	$this->redirect('admin_list');
    	
    }
    


    public function admin_list_state()
    {
    	$id=I('x');
    	if (empty($id))
        {
    		$this->error('用户ID不存在',U('admin_list'),1);
    	}
    	$status=M('admin')->where(array('admin_id'=>$id))->getField('admin_open');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('admin_open'=>0);
    		$auth_group=M('admin')->where(array('admin_id'=>$id))->setField($statedata);
    		$this->success('状态禁止',1,1);
    	}
        else
        {
    		$statedata = array('admin_open'=>1);
    		$auth_group=M('admin')->where(array('admin_id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}
    
    }
    


    //用户组管理
    public function admin_group()
    {
    	$auth_group=M('auth_group')->select();
    	$this->assign('auth_group',$auth_group);
    	$this->display();
    }


    
    public function admin_group_add()
    {

    	if (!IS_AJAX)
        {
    		$this->display();
    	}
        else
        {
    		$sldata=array(
    			'title'=>I('title'),
    			'status'=>I('status'),
    			'addtime'=>time(),
    		);
    		M('auth_group')->add($sldata);
    		$this->success('角色添加成功',U('admin_group'),1);
    	}
    }
    


    public function admin_group_del()
    {
    	M('auth_group')->where(array('id'=>I('id')))->delete();
    	$this->redirect('admin_group');           
    }



    
    public function admin_group_edit()
    {  
        
        if (!IS_AJAX)
        {
            $group=M('auth_group')->where(array('id'=>I('id')))->find();
            $this->assign('group',$group);
            $this->display();      
    	}
        else
        {
    		$data=array(
				'id'=>I('id'),
				'title'=>I('title'),
				'status'=>I('status'),
    		);
    		M('auth_group')->save($data);
    		$this->success('角色修改成功',U('admin_group'),1);
    	}
    }

  
    
    public function admin_group_state()
    {

    	$id=I('x');
    	$status=M('auth_group')->where(array('id'=>$id))->getField('status');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('status'=>0);
    		$auth_group=M('auth_group')->where(array('id'=>$id))->setField($statedata);
			$this->success('状态禁止',1,1);
    	}
        else
        {
    		$statedata = array('status'=>1);
    		$auth_group=M('auth_group')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}
    }



    
    public function admin_rule()
    {
    	$nav = new \Org\Util\Leftnav;
    	$admin_rule=M('auth_rule')->order('sort')->select();
    	$arr = $nav::rule($admin_rule);
	   	$this->assign('admin_rule',$arr);//权限列表
    	$this->display();
    }


    
    public function admin_rule_add()
    {
    	if(!IS_AJAX)
        {
    		$this->error('提交方式不正确',0,0);
    	}
        else
        {
    		$admin_rule=M('auth_rule');
    		$data=array(
				'name'=>I('name'),
				'title'=>I('title'),
				'status'=>I('status'),
				'sort'=>I('sort'),
				'addtime'=>time(),
				'pid'=>I('pid'),
				'css'=>I('css'),
    		);
    		$admin_rule->add($data);
    		$this->success('菜单添加成功',U('admin_rule'),1);
    	}
    }



    
    public function admin_rule_state()
    {
    	$id=I('x');
    	$statusone=M('auth_rule')->where(array('id'=>$id))->getField('status');//判断当前状态情况
    	if($statusone==1)
        {
    		$statedata = array('status'=>0);
    		$auth_group=M('auth_rule')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态禁止',1,1);
    	}
        else
        {
    		$statedata = array('status'=>1);
    		$auth_group=M('auth_rule')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}
    
    }



    
    public function ruleorder()
    {
    	if (!IS_AJAX){
    		$this->error('提交方式不正确',0,0);
    	}else{
    		$auth_rule=M('auth_rule');
    		foreach ($_POST as $id => $sort){
    			$auth_rule->where(array('id' => $id ))->setField('sort' , $sort);
    		}
    		$this->success('排序更新成功',U('admin_rule'),1);
    	}
    }
    



    public function admin_rule_edit(){
     
        if(!IS_AJAX){
            $admin_rule=M('auth_rule')->where(array('id'=>I('id')))->find();
            $this->assign('rule',$admin_rule);
            $this->display();
    	}else{
    		$admin_rule=M('auth_rule');
    		$data=array(
				'id'=>I('id'),
				'name'=>I('name'),
				'title'=>I('title'),
				'status'=>I('status'),
				'css'=>I('css'),
				'sort'=>I('sort'),
    		);
    		$admin_rule->save($data);
    		$this->success('菜单修改成功',U('admin_rule'),1);
    	}
    }

   
    
    public function admin_rule_del()
    {
    	M('auth_rule')->where(array('id'=>I('id')))->delete();
    	$this->redirect('admin_rule');
    }


    
    //三重权限配置
    public function admin_group_access(){
        
        if(!IS_POST){
    		$admin_group=M('auth_group')->where(array('id'=>I('id')))->find();
            $m = M('auth_rule');
            $data = $m->field('id,name,title,pid')->select();
            //p($data);die;
            $this->assign('admin_group',$admin_group);	// 顶级
            $this->assign('datas',$data);	// 顶级
            $this->display();
    	}else{
                  
            $m = M('auth_group');
            $new_rules = I('new_rules');
            $imp_rules = implode(',', $new_rules).',';
            $data=array(
                'id'=>I('id'),
                'rules'=>$imp_rules,	
            );
            if($m->save($data)){
                $this->success('权限配置成功',U('admin_group'),1);
            }else{
                $this->error('权限配置失败',U('admin_group'),1);
            }        
        
        }       
    
    }
 

    //修改密码
    public function pwd() {

        $admin = M('admin');

        if (IS_AJAX) {

            $data['admin_username'] = I('post.admin_username');
            $data['admin_pwd'] = md5(I('post.oldpassword'));
            $pwd['admin_pwd'] = md5(I('post.newpassword'));
            $repassword = md5(I('post.repassword'));                    
            $result = $admin -> where($data) -> find();

            if ($result) {

                if ($pwd['admin_pwd'] != $repassword) {

                    $this -> error("两次输入新密码不一致");

                } else {
                    
                   $msg = $admin -> where($data) -> save($pwd);
                                       
                    if ($msg) {

                        $this -> success("密码修改成功", U('Login/login'));
                        return;
                    } else {

                        $this -> error("修改失败");
                        return;
                    }
                }

            } else {

                $this -> error("两次输入新密码不一致");
            }
        }

        $this -> display();
    }


	public function carousel_list()
	{
		$carousel_list = D('carousel_list');
		$count = $carousel_list -> count();
		$p = getpage($count, 10);
		$show = $p -> show();
		$list = $carousel_list -> page(I('get.p')) -> limit(10) ->order('id desc')-> select();
		$this -> assign('list', $list);
		$this -> assign('page', $show);
		$this -> display();
	}

	/*
   * 添加轮播操作
   */
	public function runadd()
	{
		if (!IS_AJAX) {
			$this->error('提交方式不正确', 0, 0);
		} else {

			$file = I('file0');//获取图片路径
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize = 3145728;// 设置附件上传大小
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath = './Uploads/carousel/'; // 设置附件上传根目录
			$upload->savePath = ''; // 设置附件上传（子）目录
			$upload->saveRule = 'time';
			$info = $upload->upload();

			if ($info) {
				$img_url = '/carousel/' . $info[file0][savepath] . $info[file0][savename];//如果上传成功则完成路径拼接

			} elseif (!$file) {
				$img_url = '';//否则如果字段为空，表示没有上传任何文件，赋值空
			} else {
				$this->error($upload->getError());//否则就是上传错误，显示错误原因
			}


			$data = array(
				'id' => I('id'),
				'title' => I('title'),
				'img' => $img_url,
				'state' => I('state'),
				'orderby' => I('orderby'),
				'note' => I('note'),
				'url' => I('url'),
				'addtime' => time(),

			);

			M('carousel_list')->add($data);
			$this->success('轮播添加成功', U('carousel_list'), 1);
		}
	}



	/*
     * 修改轮播
     */
	public function editcarousel()
	{

		$id = I('id');
		$list = M('carousel_list')->where(array('id' => $id))->find();
		$this->assign('list', $list);
		$this->display();

	}

	/*
     * 修改轮播操作
     */
	public function runeditcarousel()
	{
		if (!IS_AJAX) {
			$this->error('提交方式不正确', 0, 0);
		} else {

			$file = I('file1');//获取图片路径
			$checkpic = I('checkpic');
			$oldcheckpic = I('oldcheckpic');

			if ($checkpic != $oldcheckpic) {

				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize = 3145728;// 设置附件上传大小
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->rootPath = './Uploads/carousel/'; // 设置附件上传根目录
				$upload->savePath = ''; // 设置附件上传（子）目录
				$upload->saveRule = 'time';
				$info = $upload->upload();

				if ($info) {
					$img_url = '/carousel/' . $info[file0][savepath] . $info[file0][savename];//如果上传成功则完成路径拼接
				} else {
					$this->error($upload->getError());//否则就是上传错误，显示错误原因
				}
			}

			$data = array(
				'id' => I('id'),
				'title' => I('title'),
				'state' => I('state'),
				'orderby' => I('orderby'),
				'url' => I('url'),
				'note' => I('note'),
			);
			if ($checkpic != $oldcheckpic) {
				$data['img'] = $img_url;
			}

			M('carousel_list')->save($data);
			$this->success('轮播修改成功', U('carousel_list'), 1);
		}
	}
	
	
	//表单管理
	public function put(){
		$Nowpage = I("page")?I("page"):1;

        $val=I('val');
        $catid=I('catid');
        $this->assign('testcatid',$catid);

        $this->assign('testval',$val);

        if($val){
            $map['a_title']= array('like',"%".$val."%");
        }


        if($catid){
            $soncatids=M("article_cate")->where("pid=".$catid)->select();
            if($soncatids){
                foreach($soncatids as $v){
                    $catid.=",".$v['id'];
                }
            }


            $map['cate_id']= array('in',$catid);
        }


        $limits = 10;// 获取总条数
        $count = M('put')->where($map)->count();//计算总页面
        $allpage = ceil($count / $limits);
        $allpage = intval($allpage);



		$lists = M('put')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
		foreach($lists as $k=>$v)
        {

			$lists[$k]['create_time']=date('Y年m月d日',$v['create_time']);
        }
		$this->assign('Nowpage', $Nowpage);
        $this->assign('allpage', $allpage);
		if(I("page")){


            $this->success($lists);
        }

        $nav = new \Org\Util\Leftnav;

        $this->assign('list', $lists);
		$this->display();
	}
	/*
	  *删除留言
	  */   
    public function put_del() {

        $list = M('put')->where(array('id'=>I('id')))->delete();
        if($list){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }

    }
	
	
	
	public function carousel_state() {
		$id=I('id');
		if (empty($id))
		{
			$this->error('非法操作',U('index'),1);
		}
		$status=M('carousel_list')->where(array('id'=>$id))->getField('state');//判断当前状态情况
		if($status==1)
		{
			$statedata = array('state'=>0);
			$auth_group=M('carousel_list')->where(array('id'=>$id))->setField($statedata);
			$this->success('状态禁止',1,1);
		}
		else
		{
			$statedata = array('state'=>1);
			$auth_group=M('carousel_list')->where(array('id'=>$id))->setField($statedata);
			$this->success('状态开启',1,1);
		}
	}
	
	/*
     * 删除轮播
     */
	public function del()
	{
		$id = I('id');
		M('carousel_list')->where(array('id' => $id))->delete();
		$this->redirect('carousel_list', array('p' => $p));
	}
}