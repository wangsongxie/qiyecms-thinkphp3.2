<?php
namespace Otcms\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;
class ArticleController extends AuthController {
	
    public function index(){
		
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
        $count = M('article')->where($map)->count();//计算总页面
        $allpage = ceil($count / $limits);
        $allpage = intval($allpage);



		$lists = M('article')->where($map)->page($Nowpage, $limits)->order('a_id desc')->select();
		foreach($lists as $k=>$v)
        {

            $lists[$k]['cate_id']=$status=M('article_cate')->where(array('id'=>$lists[$k]['cate_id']))->getField('cate_name');


			$lists[$k]['create_time']=date('Y年m月d日',$v['create_time']);
            $lists[$k]['last_time']=date('Y年m月d日',$v['last_time']);
        }
		$this->assign('Nowpage', $Nowpage);
        $this->assign('allpage', $allpage);
		if(I("page")){


            $this->success($lists);
        }

        $nav = new \Org\Util\Leftnav;


        $lists = M('article_cate')->order('orderby asc')->select();

        $lists = $nav::rule($lists);

        $this->assign('list', $lists);

		
        $this->display();
    }
 
	 /*
	  * 添加文章
	  */   
    public function add_article(){
    	
		
		
		

		if (!IS_AJAX) {
            $add_time=date("Y-m-d H:i");

            $nav = new \Org\Util\Leftnav;


            $lists = M('article_cate')->order('orderby asc')->select();

            $lists = $nav::rule($lists);

            $this->assign('list', $lists);
            $this->assign('add_time', $add_time);
            $this->display();
        } else {
           
            $create_time          = strtotime(I('post.add_time', '', 'htmlspecialchars'));
            $last_time            = strtotime(date("Y-m-d H:i:s",time()));
            $data['a_title']      = trim(I('post.a_title', '', 'htmlspecialchars'));        
            $data['cate_id']      = trim(I('post.cate_id', '', 'htmlspecialchars'));
            $data['photo']     = trim(I('post.photo', '', 'htmlspecialchars'));
            $data['a_keyword']    = trim(I('post.a_keyword', '', 'htmlspecialchars'));
            $data['a_remark']     = trim(I('post.a_remark', '', 'htmlspecialchars'));
            $data['a_content']    = $_POST['a_content'];
            $data['video']=trim(I('post.video', '', 'htmlspecialchars'));



            $data['a_red']        = trim(I('post.a_red', '', 'htmlspecialchars'));
            $data['a_type']       = trim(I('post.a_type', '', 'htmlspecialchars'));
            $data['a_views']      = trim(I('post.a_views', '', 'htmlspecialchars'));
            $data['a_writer']     = trim(I('post.a_writer', '', 'htmlspecialchars'));
			$data['laiyuan']     = trim(I('post.laiyuan', '', 'htmlspecialchars'));
			$data['laiyuan_url']     = trim(I('post.laiyuan_url', '', 'htmlspecialchars'));
            $data['create_time']  = $create_time;
            $data['tujilist']  = serialize($_POST['tujilist']);
            $data['datas']  = serialize($_POST['data']);
            $data['create_ip']    = get_client_ip();
            $data['last_time']    = $last_time;
            $data['a_from']       = getOS();
			$data['state']       = trim(I('post.state', '', 'htmlspecialchars'));

			
            if (empty($data['a_title'])) {
                $this->error('文章标题不能为空');
            }   
            if (empty($data['a_keyword'])) {
                $this->error('关键字不能为空');
            }        
            if (empty($data['a_remark'])) {
                $this->error('文章描述不能为空');
            }
            if (empty($data['a_content'])) {
                $this->error('内容不能为空');
            }
            
            M('Article')->add($data);

            $this->success('添加成功', U('article/index'), 1);
        }
		
		

		
		

    }

 	/*
	 * 文章状态
	 */
	 public function article_state() {
       $id=I('id');
    	if (empty($id))
        {
    		$this->error('非法操作',U('index'),1);
    	}
    	$status=M('article')->where(array('a_id'=>$id))->getField('state');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('state'=>0);
    		$auth_group=M('article')->where(array('a_id'=>$id))->setField($statedata);
    		$this->success('状态禁止',1,1);
    	}
        else
        {
    		$statedata = array('state'=>1);
    		$auth_group=M('article')->where(array('a_id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}
    }
	
	
	/*
	 * 文章头条
	 */
	 public function article_toutiao() {
       $id=I('id');
    	if (empty($id))
        {
    		$this->error('非法操作',U('index'),1);
    	}
    	$status=M('article')->where(array('a_id'=>$id))->getField('a_type');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('a_type'=>0);
    		$auth_group=M('article')->where(array('a_id'=>$id))->setField($statedata);
    		$this->success('取消头条',1,1);
    	}
        else
        {
    		$statedata = array('a_type'=>1);
    		$auth_group=M('article')->where(array('a_id'=>$id))->setField($statedata);
    		$this->success('设为头条',1,1);
    	}
    }
	
	
	/*
	 * 文章推荐
	 */
	 public function article_tuijian() {
       $id=I('id');
    	if (empty($id))
        {
    		$this->error('非法操作',U('index'),1);
    	}
    	$status=M('article')->where(array('a_id'=>$id))->getField('a_red');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('a_red'=>0);
    		$auth_group=M('article')->where(array('a_id'=>$id))->setField($statedata);
    		$this->success('取消推荐',1,1);
    	}
        else
        {
    		$statedata = array('a_red'=>1);
    		$auth_group=M('article')->where(array('a_id'=>$id))->setField($statedata);
    		$this->success('设为推荐',1,1);
    	}
    }
 
	 /*
	  * 编辑文章
	  */   
    public function edit() {


		 $a_id = I('id', '', htmlspecialchars);
        
        if (!IS_AJAX) {
            $nav = new \Org\Util\Leftnav;


            $lists = M('article_cate')->order('orderby asc')->select();

            $lists = $nav::rule($lists);

            $this->assign('list', $lists);
            $detail = M('article')->where(array('a_id' => $a_id ))->find();

            $cate=M("article_cate")->find($detail['cate_id']);

            $ziduans=$cate["ziduans"];
            $ziduanarray=explode(";",$ziduans);
            $dataarr=array();
            foreach($ziduanarray as $v){
                $arr=explode("|",$v);
                if($arr[1]){
                    $dataarr[]=array("name"=>$arr[0],"ziduan"=>$arr[1]);

                }
            }
            $this->assign('dataarr', $dataarr);
            $this->assign('hastuji',$cate['hastuji']);
            $this->assign('hasvideo',$cate['hasvideo']);
            $detail['add_time']=date("Y-m-d H:i",$detail['create_time']);

            $datas=unserialize($detail['datas']);



            foreach( $datas as $k=>$v){
                $detail[$k]=$v;

            }
            $tujilist=unserialize($detail['tujilist']);

            $this->assign('tujilist', $tujilist);
            $this->assign('detail', $detail);

            $this->display();
        } else {
           
            $last_time         = strtotime(date("Y-m-d H:i:s",time()));
			$create_time          = strtotime(I('post.add_time', '', 'htmlspecialchars'));
            $data['a_title']   = trim(I('post.a_title', '', 'htmlspecialchars'));        
            $data['cate_id']   = trim(I('post.cate_id', '', 'htmlspecialchars'));
            $data['photo']     = trim(I('post.photo', '', 'htmlspecialchars'));
            $data['a_keyword'] = trim(I('post.a_keyword', '', 'htmlspecialchars'));
            $data['a_remark']  = trim(I('post.a_remark', '', 'htmlspecialchars'));
            $data['a_content'] = $_POST['a_content'];
            $data['video']=trim(I('post.video', '', 'htmlspecialchars'));
            $data['a_red']     = trim(I('post.a_red', '', 'htmlspecialchars'));
            $data['a_type']    = trim(I('post.a_type', '', 'htmlspecialchars'));
            $data['a_views']   = trim(I('post.a_views', '', 'htmlspecialchars'));
            $data['a_writer']  = trim(I('post.a_writer', '', 'htmlspecialchars'));
			$data['laiyuan']     = trim(I('post.laiyuan', '', 'htmlspecialchars'));
			$data['laiyuan_url']     = trim(I('post.laiyuan_url', '', 'htmlspecialchars'));
            $data['create_ip'] = get_client_ip();
			$data['create_time'] = $create_time ;
            $data['last_time'] = $last_time;
            $data['tujilist']  = serialize($_POST['tujilist']);
            $data['datas']  = serialize($_POST['data']);
            $data['a_from']    = getOS();

            if (empty($data['a_title'])) {
                $this->error('文章标题不能为空');
            }   
            if (empty($data['a_keyword'])) {
                $this->error('关键字不能为空');
            }        
            if (empty($data['a_remark'])) {
                $this->error('文章描述不能为空');
            }
            if (empty($data['a_content'])) {
                $this->error('内容不能为空');
            }          

            M('Article')->where('a_id='.$a_id)->save($data);
            
            $this->success('文章保存成功', U('Article/index'), 1);
        }
		

		


    }

    
                    
//    获取文章特殊字段
    public function getziduans(){
        $cate_id=I("post.cate_id");
        $cate=M("article_cate")->find($cate_id);

        $ziduans=$cate["ziduans"];
        $ziduanarray=explode(";",$ziduans);
        $dataarr=array();
        foreach($ziduanarray as $v){
            $arr=explode("|",$v);
            if($arr[1]){
                $dataarr[]=array("name"=>$arr[0],"ziduan"=>$arr[1]);

            }
        }
        if(empty($dataarr)){

            $data=array("code"=>0,"hasvideo"=>$cate['hasvideo'],"hastuji"=>$cate['hastuji']);
        }else{
            $data=array("code"=>1,"lists"=>$dataarr,"hasvideo"=>$cate['hasvideo'],"hastuji"=>$cate['hastuji']);
        }
        $this->ajaxReturn($data);

    }
	 /*
	  *删除文章
	  */   
    public function del_article() {

        $list = M('article')->where(array('a_id'=>I('id')))->delete();
        if($list){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }

    }




	/*
	 *文章分类 
	 */	
	public function index_cate() {

        $nav = new \Org\Util\Leftnav;


		$lists = M('article_cate')->order('orderby asc')->select();

        $lists = $nav::rule($lists);
        $this->assign('lists', $lists);
        $this->display();
    }
    public function catorder()
    {
        if (!IS_AJAX){
            $this->error('提交方式不正确',0,0);
        }else{
            $Catlist=M('ArticleCate');
            foreach ($_POST as $id => $sort){
                $Catlist->where(array('id' => $id ))->setField('orderby' , $sort);
            }
            $this->success('排序更新成功',U('index_cate'),1);
        }
    }
	/*
	 * 添加文章分类
	 */
    public function add_cate(){
        $nav = new \Org\Util\Leftnav;
        $catlist=M('ArticleCate')->order('orderby')->select();
        $arr = $nav::rule($catlist);
        $this->assign('catlist',$arr);//权限列表

        $dir=APP_PATH."Home/View/Article/";
        $file=scandir($dir);
        $listarray=array();
        $showarray=array();
        foreach($file as $v){
            if(end(explode('.', $v))=="html"){

                if( strstr($v,"list")){
                    $listarray[]=$v;
                }
                if( strstr($v,"show")){
                    $showarray[]=$v;
                }
            }
        }

        $this->assign('listarray',$listarray);
        $this->assign('showarray',$showarray);

        $this->display();
    }

    public function runaddtype()
    {
        if (!IS_AJAX) {
            $this->error('提交方式不正确', U('Link/add'), 0);
        } else {
           
        $data['cate_name'] = trim(I('post.cate_name', '', 'htmlspecialchars'));
        $data['orderby'] =  trim(I('post.orderby', '', 'htmlspecialchars'));
		$data['state'] =  trim(I('post.state', '', 'htmlspecialchars'));
            $data['keysword'] =  trim(I('post.keysword', '', 'htmlspecialchars'));
            $data['miaoshu'] =  trim(I('post.miaoshu', '', 'htmlspecialchars'));
            $data['listhtml'] =  trim(I('post.listhtml'));
            $data['ziduans'] =  trim(I('post.ziduans'));
            $data['articlehtml'] =  trim(I('post.articlehtml'));
            $data['pid'] =  trim(I('post.pid'));
            $data['hasvideo']= trim(I('post.hasvideo', '', 'htmlspecialchars'));
            $data['hastuji']       = trim(I('post.hastuji', '', 'htmlspecialchars'));
        if ($data['cate_name'] == null) {
            $this->error('分类名称不能为空');
            return;
        }
        if ($data['orderby'] == null) {
            $this->error('排序不能为空');
            return;
        }
            
            M('article_cate')->add($data);
            
            $this->success('添加成功', U('index_cate'), 1);
        }
    }





    /*
     * 编辑文章分类
     */	
    public function edit_cate() {
        $nav = new \Org\Util\Leftnav;
        $catlist=M('ArticleCate')->order('orderby')->select();
        $arr = $nav::rule($catlist);
        $this->assign('catlist',$arr);//权限列表
        $dir=APP_PATH."Home/View/Article/";
        $file=scandir($dir);
        $listarray=array();
        $showarray=array();
        foreach($file as $v){

            if(end(explode('.', $v))=="html"){

                if( strstr($v,"list")){
                    $listarray[]=$v;
                }
                if( strstr($v,"show")){
                    $showarray[]=$v;
                }
            }
        }

        $this->assign('listarray',$listarray);
        $this->assign('showarray',$showarray);

        $detail = M('article_cate')->where(array('id' => I('id')))->find();
        $this->assign('detail', $detail);
        $this->display();
        
    }

    public function runedittype() {

        $cate_id = I('id', '', htmlspecialchars);
        
        if (!IS_AJAX) {
            $this->error('提交方式不正确', U('article/edit_cate'), 0);
        } else {
           
            $data['cate_name'] = trim(I('post.cate_name', '', 'htmlspecialchars'));
            $data['orderby'] =  trim(I('post.orderby', '', 'htmlspecialchars'));
			$data['state'] =  trim(I('post.state', '', 'htmlspecialchars'));
            $data['keysword'] =  trim(I('post.keysword', '', 'htmlspecialchars'));
            $data['miaoshu'] =  trim(I('post.miaoshu', '', 'htmlspecialchars'));
            $data['listhtml'] =  trim(I('post.listhtml', '', 'htmlspecialchars'));
            $data['ziduans'] =  trim(I('post.ziduans'));
            $data['articlehtml'] =  trim(I('post.articlehtml', '', 'htmlspecialchars'));
            $data['pid'] =  trim(I('post.pid'));
            $data['hasvideo']= trim(I('post.hasvideo', '', 'htmlspecialchars'));
            $data['hastuji']       = trim(I('post.hastuji', '', 'htmlspecialchars'));
            if ($data['cate_name'] == null) {
                $this->error('分类名称不能为空');
                return;
            }
            if ($data['orderby'] == null) {
                $this->error('排序不能为空');
                return;
            }           

            M('article_cate')->where('id='.$cate_id)->save($data);
            
            $this->success('保存成功', U('article/index_cate'), 1);
        }
    }


	/*
	 * 删除分类
	 */
    public function del_cate() {
        $list = M('article_cate')->where(array('id'=>I('id')))->delete();
        if($list){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
	
	/*
	 * 分类状态
	 */
	 public function cate_state() {
       $id=I('id');
    	if (empty($id))
        {
    		$this->error('非法操作',U('index_cate'),1);
    	}
    	$status=M('article_cate')->where(array('id'=>$id))->getField('state');//判断当前状态情况
    	if($status==1)
        {
    		$statedata = array('state'=>0);
    		$auth_group=M('article_cate')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态禁止',1,1);
    	}
        else
        {
    		$statedata = array('state'=>1);
    		$auth_group=M('article_cate')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}
    }

}
