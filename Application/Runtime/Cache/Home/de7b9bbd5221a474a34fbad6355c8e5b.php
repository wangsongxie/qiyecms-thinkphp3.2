<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="/qiye/Public/style/css/webstyle.css" rel="stylesheet" type="text/css" />
<title>在线留言_龙采Smarty</title>
<script src="/qiye/Public/style/js/jquery-1.11.3.min.js"></script>
<script src="/qiye/Public/style/js/unslider-min.js"></script>
<script type="text/javascript">
function newgdcode(obj,url) {
	obj.src = url+ '&nowtime=' + new Date().getTime();//后面传递一个随机参数，否则在IE7和火狐下，不刷新图片
}
// 表单提交客户端检测
function Isyx(yx){
	var reyx= /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
	return(reyx.test(yx));
	}
function doSubmit(){
	var Rname=document.getElementById("Rlc_name");
	var Rtel=document.getElementById("Rlc_tel");
	var Remail=document.getElementById("Rlc_email");
	var Rtitle=document.getElementById("Rlc_title");
	var Rcontent=document.getElementById("Rlc_content");
	var Ryzm=document.getElementById("Ryzm");
    if (document.myform.lc_name.value==""){
        Rname.innerHTML="亲，请写姓名！";
		Rname.style.color="red";
        document.myform.lc_name.focus();
        return false;
    }
    
    if (document.myform.lc_name.value.length>5||document.myform.lc_name.value.length<1 ){
        Rname.innerHTML="亲,您输入的姓名必须在1~5个字之间！";
		Rname.style.color="red";
        document.myform.lc_name.focus();
        return false;
    }
    var reg =/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/; 
    if (document.myform.lc_tel.value==""){
        Rtel.innerHTML="亲，请写电话！";
		Rtel.style.color="red";
        document.myform.lc_tel.focus();
        return false;
    }
    if(!reg.test(document.myform.lc_tel.value)){ 
        Rtel.innerHTML="亲，请输入正确的电话！";
		Rtel.style.color="red";
        document.myform.lc_tel.focus();
        return false; 
     }
    
    if (document.myform.lc_email.value==""){
        Remail.innerHTML="亲，请写邮箱！";
		Remail.style.color="red";
        document.myform.lc_email.focus();
        return false;
    }
    if (!Isyx(document.myform.lc_email.value)){
		 Remail.innerHTML="亲，请输入正确的邮箱地址！";
		 Remail.style.color="red";
		 document.myform.lc_email.value="";
		 document.myform.lc_email.focus();
		 return false;
     }
     
    if (document.myform.lc_title.value==""){
        Rtitle.innerHTML="亲，请填写您留言的标题！";
		Rtitle.style.color="red";
        document.myform.lc_title.focus();
        return false;
    }
    if (document.myform.lc_content.value==""){
        Rcontent.innerHTML="亲，请填写您的留言内容！";
		Rcontent.style.color="red";
        document.myform.lc_content.focus();
        return false;
    }
    if (document.myform.yzm.value==""){
        Ryzm.innerHTML="亲，请填写验证码！";
		Ryzm.style.color="red";
        document.myform.yzm.focus();
        return false;
    }
}
//数据填写验证
function check_name(obj){
	//验证 姓名
	var name=obj.value;
	var Rname=document.getElementById("Rlc_name");
	if(name){
		if(name.length>5 || name.length<1){
			Rname.innerHTML="亲,您输入的姓名必须在1~5个字之间！";
			Rname.style.color="red";
			}else{
				Rname.innerHTML="正确";
				Rname.style.color="green";
				return true;
				}
		}else{
			Rname.innerHTML="亲，请写姓名！";
			Rname.style.color="red";
			}
	}
function check_tel(obj){
	//验证 电话
	var tel=obj.value;
	var Rtel=document.getElementById("Rlc_tel");
	if(tel){
		var reg =/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;
		if(!reg.test(tel)){
			Rtel.innerHTML="亲，请输入正确的电话！";
			Rtel.style.color="red";
			}else{
				Rtel.innerHTML="正确";
				Rtel.style.color="green";
				}
		}else{
			Rtel.innerHTML="亲，请写电话！";
			Rtel.style.color="red";
			}
	}
function check_email(obj){
	//验证 邮箱
	var email=obj.value;
	var Remail=document.getElementById("Rlc_email");
	if(email){
		if(!Isyx(email)){
			Remail.innerHTML="亲，请输入正确的邮箱地址！";
	 		Remail.style.color="red";
			}else{
				Remail.innerHTML="正确";
				Remail.style.color="green";
				}
		}else{
			Remail.innerHTML="亲，请写邮箱！";
			Remail.style.color="red";
			}
	}
function check_title(obj){
	//验证 标题
	var title=obj.value;
	var Rtitle=document.getElementById("Rlc_title");
	if(title){
		Rtitle.innerHTML="正确";
		Rtitle.style.color="green";
		}else{
			Rtitle.innerHTML="亲，请填写您留言的标题！";
			Rtitle.style.color="red";
			}
	}
function check_content(obj){
	//验证 内容
	var content=obj.value;
	var Rcontent=document.getElementById("Rlc_content");
	if(content){
		Rcontent.innerHTML="正确";
		Rcontent.style.color="green";
		}else{
			Rcontent.innerHTML="亲，请填写您的留言内容！";
			Rcontent.style.color="red";
			}
	}
</script>
</head>

<body>
<!--header start-->
<div class="top_bg">
	<div class="content">
		<div class="logo fl"><img src="/qiye/Public/style/images/19371_20161125172200.png"></div>
		<div class="nav fr">                                                
			<ul>
			
                            <li><a href="/">网站首页</a></li>
							<li><a href="<?php echo U('Said/index',array('id'=>6));?>">关于我们</a></li>
                            <li><a href="<?php echo U('Article/index',array('id'=>10));?>">最新动态</a></li>
                            <li><a href="<?php echo U('Article/index',array('id'=>11));?>">甜品展示</a></li>
                            <li><a href="<?php echo U('Article/index',array('id'=>12));?>">人才招聘</a></li>
                            <li><a href="<?php echo U('Said/index',array('id'=>8));?>">在线留言</a></li>
                            <li><a href="<?php echo U('Said/index',array('id'=>7));?>">联系我们</a></li>
              			</ul>
		</div>
	</div>
</div>
<div class="banner">
    <ul>
    
           <?php $result = M("CarouselList")->where("state = '1'")->order("orderby asc")->limit(3)->select();foreach ($result as $v):?><li><img src="/qiye/Public/style/images/61608_20161125172108.jpg" /></li><?php endforeach ?>
         </ul>
</div>
<script>
$(function(){
  $('.banner').unslider({
    dots: false,//点导航
    autoplay: true,//自动播放
    speed:400,//播放速度
    delay:5000,//轮播间隔
    arrows: false,//是否显示左右箭头
    fluid: true,//是否支持响应式
  });
});
</script>
<!--header end-->

<!--main start-->
<div class="main_bg cl">
	<div class="content">
		<div class="type fl">
			<img src="/qiye/Public/style/images/main02.jpg" class="fl">
			<p class="fl">
                <a href="<?php echo U('Said/index',array('id'=>8));?>">· 在线留言</a>
            </p>
		</div>
		<div class="path fr"><img src="/qiye/Public/style/images/main03.jpg">您的当前位置：<a href="/">首页</a> >在线留言</div>
		<div class="m_about cl" style="padding: 0px 0 0;">
			<div class="m_about_txt">
              <div id="gbook" >
        	<ul>
          <form action="<?php echo U('Index/put');?>" method="post" name="myform">
            <li>姓&nbsp;&nbsp;&nbsp;&nbsp;名：
              <input type="text" name="lc_name" required onBlur="check_name(this)">
              <span id="Rlc_name" style="color:#373835">必填，且在1~5个字之间</span></li>
            <li>电&nbsp;&nbsp;&nbsp;&nbsp;话：
              <input type="text" name="lc_tel" required onBlur="check_tel(this)">
              <span id="Rlc_tel" style="color:#373835">请按照正确格式填写，例150********</span></li>
            <li>邮&nbsp;&nbsp;&nbsp;&nbsp;箱：
              <input type="text" name="lc_email" required onBlur="check_email(this)">
              <span id="Rlc_email" style="color:#373835">请按照正确邮箱格式填写，例：******@qq.com</span></li>
            <!--<li>标&nbsp;&nbsp;&nbsp;&nbsp;题：
              <input type="text" name="lc_title" required onBlur="check_title(this)">
              <span id="Rlc_title">请填写您留言的标题</span></li>-->
            <li>地&nbsp;&nbsp;&nbsp;&nbsp;址：
              <input type="text" name="lc_address" required onBlur="check_title(this)">
              <span id="Rlc_title" style="color:#373835">请填写您留言的地址</span></li>
            <li>内&nbsp;&nbsp;&nbsp;&nbsp;容：
              <textarea name="lc_content" required onBlur="check_content(this)"></textarea>
              <span id="Rlc_content"></span></li>
            <li>验证码：
              &nbsp;<input name="yzm" type="text" id="yzm" style="width:80px;">
              <img src="<?php echo U('Said/verify');?>" alt="看不清楚，换一张" align="absmiddle" style="cursor:pointer" onClick="newgdcode(this,this.src)"> <span id="Ryzm"></span></li>
            <li>
              <input type="submit" id="tijiao" value="提交" style="background-color:#fa6374; color:#FFF; cursor:pointer; border:0px; margin-left:63px;">
              <input type="reset" id="chongzhi" value="重置" style="background-color:#fa6374; color:#FFF; cursor:pointer; border:0px;">
            </li>
          </form>
        </ul>
        </div>
            </div>
		</div>		
	</div>
</div>
<!--main end-->
﻿<!--footer start-->
<script type="text/javascript">
function Isyx(yx){
	var reyx= /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
	return(reyx.test(yx));
	}
function doSubmit(){
	if(document.getElementById('lc_name').value == '')
	{
		alert("请输入姓名");
		document.getElementById('lc_name').focus();
		return false;
	}
	
	if(document.getElementById('lc_email').value == '')
	{
		alert("请输入邮箱");
		document.getElementById('lc_email').focus();
		return false;
	}
	if (!Isyx(document.getElementById('lc_email').value)){
		 alert("请输入正确的邮箱");
		document.getElementById('lc_email').focus();
		return false;
     }
	
	var reg =/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/; 
	if(document.getElementById('lc_tel').value == '')
	{
		alert("请输入电话");
		document.getElementById('lc_tel').focus();
		return false;
	}
	if(!reg.test(document.getElementById('lc_tel').value)){ 
        alert("请输入正确电话");
		document.getElementById('lc_tel').focus();
		return false;
     }
	
	if(document.getElementById('lc_address').value == '')
	{
		alert("请输入地址");
		document.getElementById('lc_address').focus();
		return false;
	}
	
	if(document.getElementById('lc_content').value == '')
	{
		alert("请输入留言内容");
		document.getElementById('lc_content').focus();
		return false;
	}
}
</script>
<div class="contact_bg cl">
	<div class="content">
		<div class="contact fl">
			<img src="/qiye/Public/style/images/cont_tit.jpg">
			<p>多年来，华琳食品用心孕育汉密哈顿，引进欧式烘焙制作工艺、聘请国际一流水平烘焙师，潜心研发数千种精致美观、营养健康的烘焙臻品，而优雅舒适的店面环境更成为时尚品味人士的首选。一切努力源于一份追求，源于心中里的一份执着：让大众吃上好面包。</p>
			<ul>
				<li><img src="/qiye/Public/style/images/cont1.jpg"><br>哈尔滨市道里区尚志大街160号龙采科技16楼技术中心</li>
				<li><img src="/qiye/Public/style/images/cont2.jpg"><br>0451-88888888<br />
13912345678</li>
				<li><img src="/qiye/Public/style/images/cont3.jpg"><br>12345678@qq.com</li>
			</ul>
		</div>
		<div class="message fr">
        <form action="<?php echo U('Public/put');?>" method="post" name="myform" onSubmit="return doSubmit()">
			<p><input type="text" class="mes_form1 fl" name="lc_name" id="lc_name" placeholder="姓名："><input type="text" name="lc_tel" id="lc_tel" class="mes_form1 fr" placeholder="电话："><div class="cl"></div></p>
			<p><input type="text" name="lc_email" id="lc_email" class="mes_form2" placeholder="邮箱："></p>
			<p><textarea name="lc_content" id="lc_content" class="mes_form3" placeholder="留言："></textarea></p>
			<p><input type="submit" value="提交留言  →" class="mes_btn" style="cursor:pointer"></p>
        </form>
		</div>
		<div class="cl"></div>
	</div>
</div>
<div class="footer cl">
	<div class="content tc">版权所有：***科技公司&nbsp; 咨询热线：400-681-8888&nbsp; 地址：中国北京&nbsp; 备案号：京ICP*****号</div>
</div>
<!--footer end-->
</body>


</html>