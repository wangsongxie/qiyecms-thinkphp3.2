<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-cn">
    <meta charset="UTF-8">
    <title>前台登陆</title>
    <style>
        #from {
            width:300px;
            margin:80px auto;
        }
    </style>
</head>
<body>
    <div id="from">
        <form action="<?php echo U('Login/login');?>" method="post">
            <p>用户名：<input type="text" name="username" /></p>
            <p>密码：<input type="password" name="password" /></p>
            <p><input type="submit" value="登陆" />&nbsp;&nbsp;<a href="<?php echo U('Login/reg');?>">注册</a></p>
        </form>
    </div>
</body>
</html>