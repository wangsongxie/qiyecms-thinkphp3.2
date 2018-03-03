<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-cn">
    <meta charset="UTF-8">
    <title>好友列表</title>
    <style>
        .hidden {
            display:none;
        }
    </style>
</head>
<body>
    <p>欢迎您,<?php echo ($loginUser); ?>  ,<a href="<?php echo U('Login/logout');?>">注销</a></p>
    <ul>
        <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="uli"><span class="hidden"><?php echo ($vo["id"]); ?></span><span class="show"><?php echo ($vo["username"]); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

    <script type="text/javascript" src="/qiye/Public/chat/Js/Jquery/jquery.js"></script>
    <script type="text/javascript">
		//var URL = 'U("Message/chatHall")';
        $(function(){
            //鼠标悬停事件
            $('.uli').mouseover(function(){
                $(this).css('color','red');
            }).mouseout(function(){
                $(this).css('color','black');
            });
            //点击事件
            $('.uli').click(function(){
                var getter = $(this).find('.show').html();
                var id = $(this).find('.hidden').html();
                openWindow(getter,id);
            });
        });

		//点开对话框
        function openWindow(getter,id){
            window.open('/qiye/index.php/Message/chatHall?getter='+getter+'&id='+id,'_blank',200,200);
        }
    </script>
</body>
</html>