<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="zh-cn">
    <meta charset="UTF-8">
    <title>聊天窗</title>
    <style>
        span {
            color:red;
        }

        #msg {
            width:400px;
        }

        #content {
            width: 500px;
            height:500px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1><span class="ser"><?php echo ($senderName); ?></span>正在和<span class="ger"><?php echo ($getterName); ?></span>聊天中...</h1>
    <div id="content"></div>
    <p></p>
    <input type="hidden" name="sender" value="<?php echo ($senderId); ?>" id="sender" />
    <input type="hidden" name="getter" value="<?php echo ($getterId); ?>" id="getter" />
    <input type="text" name="msg" id="msg" />
    <input type="button" value="发送" id="btn" />
    <div id="res"></div>


    <script type="text/javascript" src="/qiye/Public/chat/Js/Jquery/jquery.js"></script>
    <script type="text/javascript">
        $(function(){

            window.resizeTo(500,800);

            //重点，每隔一段时间去服务器获取数据
            window.setInterval("getMsg()",3000);

            $('#btn').click(function(){

                $('#content').append($('.ser').html()+' : '+$('#msg').val()+'</br>');
                $('#content').val();


                $.post("<?php echo U('Message/sendMsg');?>",{
                    'content' : $('#msg').val(),
                    'sender' : $('#sender').val(),
                    'getter' : $('#getter').val()
                },function(response){
                    if(response['status'] == 1){
                        $('#res').html('发送成功！').show().hide(3000);
                        $('#msg').val('');
                    }else{
                        $('#res').html('发送失败！').show().hide(3000);
                    }
                },'json');

            });

        });

        function getMsg(){
            $.post("<?php echo U('Message/getMsg');?>",{
                'sender' : $('#sender').val(),
                'getter' : $('#getter').val()
            },function(response){
                $.each(response,function(index,value){
                    $('#content').append($('.ger').html()+' : '+value.content+'</br>');
                });

                $('#content').val();

            },'json');
        }
    </script>
</body>
</html>