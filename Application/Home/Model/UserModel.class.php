<?php
//登录model类
namespace Home\Model;

use Think\Model;

class UserModel extends Model {
	//登录验证类
    public function checkLogin($data){
        $where = array(
            'username'=>$data['username'],
            'password'=>$data['password']
        );
        $res = $this->where($where)->find();
        if(empty($res)){
            return ;
        }else{
            return $res;
        }
    }

	//根据用户名所有好友
    public function allFriend($username){
        $where['username'] = array('neq',$username);
        $res = $this->where($where)->select();
        return $res;
    }
}

