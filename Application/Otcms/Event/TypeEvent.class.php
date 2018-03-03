<?php


namespace Zszm\Event;
use LT\ThinkSDK\ThinkOauth;
Header('Content-Type: text/html; charset=utf-8');

class TypeEvent
{
    //登录成功，获取腾讯QQ用户信息
    public function qq($token)
    {

        $qq = ThinkOauth::getInstance('Qq', $token);      
        $data = $qq->call('user/get_user_info'); //调用接口 
        if ($data['ret'] == 0) {
            return $data;
        } else {
            throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取腾讯微博用户信息
    public function tencent($token)
    {
        $tencent = ThinkOauth::getInstance('tencent', $token);
        $data = $tencent->call('user/info');

        if ($data['ret'] == 0) {
            $userInfo['type'] = 'TENCENT';
            $userInfo['name'] = $data['data']['name'];
            $userInfo['nick'] = $data['data']['nick'];
            $userInfo['head'] = $data['data']['head'];
            return $userInfo;
        } else {
            throw_exception("获取腾讯微博用户信息失败：{$data['msg']}");
        }
    }

    //登录成功，获取新浪微博用户信息
    public function sina($token)
    {
        $sina = ThinkOauth::getInstance('sina', $token);
        $data = $sina->call('users/show', "uid={$sina->openid()}");

        if ($data['error_code'] == 0) {
            $userInfo['type'] = 'SINA';
            $userInfo['name'] = $data['name'];
            $userInfo['nick'] = $data['screen_name'];
            $userInfo['head'] = $data['avatar_large'];
            return $userInfo;
        } else {
            throw_exception("获取新浪微博用户信息失败：{$data['error']}");
        }
    }
}