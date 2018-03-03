<?php if (!defined('THINK_PATH')) exit();?>﻿﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="/qiye/Public/style/css/webstyle.css" rel="stylesheet" type="text/css" />
<title><?php echo ($config["sys_title"]); ?><</title>
<meta name="keywords" content="<?php echo ($config["sys_key"]); ?>" >
<meta name="description" content="<?php echo ($config["sys_des"]); ?>"/>
<script src="/qiye/Public/style/js/jquery-1.11.3.min.js"></script>
<script src="/qiye/Public/style/js/unslider-min.js"></script>
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
			<?php $result = M("CarouselList")->where("state = '1'")->order("orderby asc")->limit(3)->select();foreach ($result as $v):?><li><img src="/qiye/Uploads<?php echo ($v["img"]); ?>" /></li><?php endforeach ?>
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

<!--index start-->
<div class="about_bg">
	<div class="content rel">
		<div class="menu">
			<ul>
				<li class="bg1"><a href="<?php echo U('Said/index',array('id'=>6));?>"><img src="/qiye/Public/style/images/menu1.png"><p>关于我们</p></a></li>
				<li class="bg2"><a href="<?php echo U('Article/index',array('id'=>10));?>"><img src="/qiye/Public/style/images/menu2.png"><p>最新动态</p></a></li>
				<li class="bg3"><a href="<?php echo U('Article/index',array('id'=>11));?>"><img src="/qiye/Public/style/images/menu3.png"><p>甜品展示</p></a></li>
				<li class="bg4"><a href="<?php echo U('Said/index',array('id'=>7));?>"><img src="/qiye/Public/style/images/menu4.png"><p>联系我们</p></a></li>
			</ul>
			<div class="cl"></div>
		</div>
		<div class="about">
			<div class="tit_bg1">
				<div class="fl tr tit">
					<span class="en_tit">about us</span>
					<span class="ch_tit">关于我们</span>
				</div>
				<div class="fr letter">A</div>
			</div>
			<div class="about_txt tc cl"><div align="justify">
	一直以来，美心烘焙通过严格的生产规范与供应链管理来保持始终如一的高品质。用爱为消费者制作“健康、营养、绿色、安全、美味”的产品和高品质的服务，是我们一贯秉承的宗旨。作为一个颇具名气的西点品牌，我们不仅有着传统产品的好味道，还注重将食品与艺术融为一体，所制造的每款产品都注入了设计制作师的爱心和情感，并赋予了生命。20世纪初，小镇上的de Laharpe大叔为了安慰失恋的孙女，让她发现和体验世间更多的爱，于是开了一家叫“L'espace heureux”的面包房，法语意为“幸福空间”。美味甜蜜的甜点、温馨惬意的布置、清新舒缓的音乐，这个充斥着满满爱意的幸福空间，仿佛一个热情又充满魅惑的少女，令人迷恋陶醉。
</div></div>
			<div class="tc"><img src="/qiye/Public/style/images/20161125093850_61185.jpg" alt="" width="536" height="396" /></div>
		</div>
	</div>
</div>
<div class="news_bg">
	<div class="content">
		<div class="tit_bg2">
			<div class="fl tr tit">
				<span class="en_tit">news</span>
				<span class="ch_tit" style="color: #fff;">最新动态</span>
			</div>
			<div class="fr letter" style="color: #fa6374;">N</div>
		</div>
		<div class="news cl">
			<div id="demo" style="overflow:hidden;width:1200px;">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td id="demo1"><table width="1200" border="0" cellspacing="0" cellpadding="0">
					<tr>
                    
                      					<!--循环开始-->
						<?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><td align="center" style="padding-left:10px;"><table width="130" border="0" cellspacing="0" cellpadding="0" style="margin-left:10">
								<tr>
									<td><a href="<?php echo U('Article/show',array('id'=>$v['a_id']));?>"><img src="/qiye/Uploads/<?php echo ($v["photo"]); ?>" width="275" height="199" /></a></td>
								</tr>
								<tr>
									<td valign="top" class="news_txt"><a href="<?php echo U('Article/show',array('id'=>$v['a_id']));?>"><?php echo ($v["a_title"]); ?></a><p><?php echo ($v["a_remark"]); ?>...</p><span><img src="/qiye/Public/style/images/time.jpg"><?php echo (date('Y-m-d',$v["create_time"])); ?></span></td>
								</tr>
						</table></td><?php endforeach; endif; else: echo "" ;endif; ?>
											<!--循环结束-->
					</tr>
				</table></td>
			<td id="demo2"></td>
		</tr>
	</table>
</div>
<script> 
var speed=30 
demo2.innerHTML=demo1.innerHTML 
function Marquee(){ 
if(demo2.offsetWidth-demo.scrollLeft<=0) 
demo.scrollLeft-=demo1.offsetWidth 
else{ 
demo.scrollLeft++ 
} 
} 
var MyMar=setInterval(Marquee,speed) 
demo.onmouseover=function() {clearInterval(MyMar)} 
demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)} 
</script>
		</div>
	</div>
</div>
<div class="search_bg">
	<div class="content">
		<h3 class="tc">欢迎搜索我们的产品</h3>
        <script>
		function check_seachkey(){
			var key=$("#textfield").val();
			if(!key){
				alert("请输入查询的关键词！！！");
				return false;
				}else{
					return true;
					}
			} 
	</script>
        <form action="index.php?p=seach_list" method="post" onsubmit="return check_seachkey()">
		<div class="search">
			<input name="key" type="text" class="ss fl" id="textfield" placeholder="请输入产品名称"><input type="submit" value="GO" class="ss_btn fl" style="cursor:pointer">
		</div>
        </form>
	</div>
</div>
<div class="pro_bg">
	<div class="content">
		<div class="tit_bg1">
			<div class="fl tr tit">
				<span class="en_tit">products</span>
				<span class="ch_tit">甜品展示</span>
			</div>
			<div class="fr letter">P</div>
		</div>
		<div class="pro cl">
			<ul>
				<?php if(is_array($tian)): $i = 0; $__LIST__ = $tian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Article/show',array('id'=>$vo['a_id']));?>"><img src="/qiye/Uploads/<?php echo ($vo["photo"]); ?>" width="380" height="292"><p><?php echo ($vo["a_title"]); ?></p></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="cl"></div>
		</div>
	</div>
</div>

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