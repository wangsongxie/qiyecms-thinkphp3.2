<?php
//信息model类
namespace Home\Model;

use Think\Model;

class MessageModel extends Model {


    public function send($data){
       return $this->add($data);
    }

    public function get($data){
        return $this->where($data)->select();
    }

    public function setIsGet($idArr){
        $set = array(
            'isGet'=>1
        );
        foreach($idArr as $k=>$v){
            $this->where('id='.$v)->save($set);
        }

    }
}