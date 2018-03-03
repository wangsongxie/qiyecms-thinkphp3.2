<?php
//信息类
namespace Home\Controller;

use Think\Controller;

class MessageController extends Controller {


	//对话框
    public function chatHall(){
        $senderName = session('loginInfo.username');
        $this->assign('senderName',$senderName);

        $senderId = session('loginInfo.id');
        $this->assign('senderId',$senderId);

        $getterName = $_GET['getter'];
        $getterId = $_GET['id'];
        $this->assign('getterName',$getterName);
        $this->assign('getterId',$getterId);

        $this->display();
    }
	//发送信息
    public function sendMsg(){


            $sender = $_POST['sender'];
            $getter = $_POST['getter'];
            $content = $_POST['content'];
            $date = date('Y-m-d H:m:s');
            $isGet = 0;

            $data = array(
                'sender'=>$sender,
                'getter'=>$getter,
                'content'=>$content,
                'date'=>$date,
                'isGet'=>$isGet
            );




            $messageModel = D('Message');
            $res = $messageModel->send($data);
            $response = array();
            if($res>0){
                $response['status'] = 1;
            }else{
                $response['status'] = 0;
            }
			//ajax返回
            $this->ajaxReturn($response);

    }
	//获取信息
    public function getMsg(){


        $sender = $_POST['sender'];
        $getter = $_POST['getter'];
        $isGet = 0;

        $data = array(
            'sender'=>$getter,
            'getter'=>$sender,
            'isGet'=>$isGet
        );

        $messageModel = D('Message');
        $res = $messageModel->get($data);
        $response = array();
        if($res>0){
            $response['status'] = 1;
            $response['data'] = $res;
        }else{
            $response['status'] = 0;
        }


        //取得所有需要更新 isGet 状态 信息的ID
        $idArr = array();
        foreach($res as $k=>$v){
            $idArr[] = $v['id'];
        }
        $messageModel->setIsGet($idArr);
		//ajax返回
        $this->ajaxReturn($response['data']);
    }


}