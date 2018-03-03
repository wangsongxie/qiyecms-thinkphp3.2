<?php


//定义回调URL通用的URL
define('URL_CALLBACK', 'http://wx.xmhdwonder.com/index.php?m=Admin&c=Login&a=callback&type=');

return array(
    //支付宝登录
    'THINK_SDK_ALIPAY' => array(
        'APP_KEY' => '', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'alipay',
    ),
    //微信登录
    'THINK_SDK_WEIXIN' => array(
        'APP_KEY' => '', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'weixin',
    ),
    //腾讯QQ登录配置
    'THINK_SDK_QQ' => array(
        'APP_KEY' => '101260590', //应用注册成功后分配的 APP ID
        'APP_SECRET' => 'ed1d357abe6195f393050093c88290aa', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'qq',
    ),
    //新浪微博配置
    'THINK_SDK_SINA' => array(
        'APP_KEY' => '', //应用注册成功后分配的 APP ID
        'APP_SECRET' => '', //应用注册成功后分配的KEY
        'CALLBACK' => URL_CALLBACK . 'sina',
    ),

);