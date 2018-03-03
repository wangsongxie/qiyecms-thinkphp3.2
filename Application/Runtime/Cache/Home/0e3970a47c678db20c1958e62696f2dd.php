<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="robots" content="index, follow" />
<title>选号码 - 鸿通400电话 -做400电话领导者！</title>
<meta name="application-name" content="欧腾传媒" />
<meta name="Author" content="OuTengMedia" />
<meta name="Copyright" Content="欧腾传媒。OuTengMedia All Rights Reserved." />
<link href="/qiye/Public/400/css/index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/qiye/Public/400/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/qiye/Public/400/js/jquery-2.1.1.js"></script>
</head>

<body>
<!--header-->
<div class="header">


<div class="main">
<div class="left_logo"><img src="/qiye/Public/400/images/logo.png" alt="鸿通400电话 -做400电话领导者！" title="鸿通400电话 -做400电话领导者！"></div>
<div class="right_nav">

<ul>
<li><a href="#">首页</a></li>
<li><a href="#">资费套餐</a></li>
<li><a href="#" class="on">选号码</a></li>
<li><a href="#">选择我们</a></li>
<li><a href="#">帮助中心</a></li>
</ul>

</div>
</div>


<!--banner-->
<div class="banner2"></div>
<!--banner END-->
</div>
<!--header END-->



<!--probation-->
<div class="probation" style="margin-top:-40px;">
	<div class="main_form">
		<div class="mf_title">申请免费试用400电话</div>
        <div class="mf_content">
        <p><input name="" type="text" placeholder="请输入姓名"></p>
        <p><input name="" type="text" placeholder="请输入电话"></p>
        <p><input name="" type="text" placeholder="请输入验证码" style="width:100px;"><span><a href="javascript:;"><img src="/qiye/Public/400/images/code.png"></a></span></p>
        <p style="margin-top:30px;"><input name="" type="button" class="button" value="立即申请"></p>
        </div>
		</div>
	</div>
<!--probation END-->
<div class="custom_2">
<p><span>办理流程</span>挑选号码 - 选择套餐 - 提交资料 - 开通成功。</p>
<p><span>申请条件</span>个体户：营业执照、法人身份证复印件
           公司：营业执照、法人身份证复印件
</p>
</div>

<!--pick_search-->
<div class="pick_search">
<div class="tel"><input type="text" maxlength="1" value="4" id="num1"><input type="text" maxlength="1" value="0" id="num2"><input type="text" maxlength="1" value="0" id="num3"><input type="text" maxlength="1" id="num4"><input type="text" maxlength="1" id="num5"><input type="text" maxlength="1" id="num6"><input type="text" maxlength="1" id="num7"><input type="text" maxlength="1" id="num8"><input type="text" maxlength="1" id="num9"><input type="text" maxlength="1" id="num10"></div>
<div class="describe"><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=642327979&amp;site=qq&amp;menu=yes" target="_blank">咨询在线客服</a></div>
<div class="button"><input name="" type="button" id="but" value="搜   索"></div>
</div>
<!--pick_search-->
<!--search_list-->
<div class="search_list">
<div class="condition">
<dl><dt>顶级靓号</dt><dd id="ding"><a href="javascript:;" onClick="cha('AAAA');" class="on">AAAA</a><span>|</span><a href="javascript:;" onClick="cha('ABCABC');">ABCABC</a><span>|</span><a href="javascript:;" onClick="cha('ABCD');">ABCD</a><span>|</span><a href="javascript:;" onClick="cha('ABABAB');">ABABAB</a><span>|</span><a href="javascript:;" onClick="cha('AABBCC');">AABBCC</a><span>|</span><a href="javascript:;" onClick="cha('AABAA');">AABAA</a><span>|</span><a href="javascript:;" onClick="cha('AAAAA');">AAAAA</a><span>|</span><a href="javascript:;" onClick="cha('AAABBB');">AAABBB</a></dd></dl>
<dl><dt>超级靓号</dt><dd id="chao"><a href="javascript:;" onClick="cha('ABBB');">ABBB</a><span>|</span><a href="javascript:;" onClick="cha('AABB');">AABB</a><span>|</span><a href="javascript:;" onClick="cha('AABCC');">AABCC</a></dd></dl>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list" id="table">
  <tr id='rds'>
	<?php if(is_array($tel)): $i = 0; $__LIST__ = $tel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td align="center" valign="middle"><?php echo ($vo["tel"]); if($vo["status"] == 1): ?><span class="out">靓</span><?php endif; ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
  </tr>
</table>
<div class="public_page"><?php echo ($page); ?></div>
</div>

<script>
var URL = '/qiye/index.php?s=/Home/Index';
$(function(){
	
	$('#but').click(function(){
		//alert(num8);
		$.ajax({
			url:URL + '/search',
			type:'post',
			datatype:'json',
			data:{num1:$('#num1').val(),num2:$('#num2').val(),num3:$('#num3').val(),num4:$('#num4').val(),num5:$('#num5').val(),num6:$('#num6').val(),num7:$('#num7').val(),num8:$('#num8').val(),num9:$('#num9').val(),num10:$('#num10').val()},
			success:function(data){
				if(data.tel){
					alert('您查询的电话为：' + data.tel + ' 级别为' + data.types);
				}else{
					alert('您查询的电话目前还没有收录！');
				}
				
			},
		});
	});
	$('#ding a').click(function(){
		$( this ).addClass( "on" ).siblings().removeClass( "on" );
		$(".public_page a").live('click',function(){
			var pageObj = this;
			var url = pageObj.href;
			$.ajax({
				type:'get',
				url:url,
				success:function(res){
					 $(".public_page").html(res);
				}
			})

			return false;
		});
	});
	$('#chao a').click(function(){
		$( this ).addClass( "on" ).siblings().removeClass( "on" );
	});
	
	
	
	
});
function cha(types){
	//var typed = types;
	//$(this).addClass('.on');
	$.ajax({
		url:URL + '/tt',
		type:'post',
		datatype:'json',
		data:{types:types},
		success:function(data,status){
			$('#rds').remove();
			var ms;
			$.each(data,function(i,result){
				ms = '<tr id="rds">';
				ms +='<td align="center" valign="middle">' + result['tel'] + '</td>';
				ms +='</tr>';
				$('#table').append(ms);
			});

		},
	});
}
	
</script>
<!--search_list END-->
<div class="footer"><a href="#">关于我们</a><span>|</span><a href="#">400介绍</a><span>|</span><a href="#">资费套餐</a><span>|</span><a href="#">选号码</a><span>|</span><a href="#">帮助中心</a><p>Copyright © 2010 - 2015 [鸿通400] HT400.CN All Rights Reserved .</p></div>
</body>
<script type="text/javascript" src="/qiye/Public/400/js/index.js"></script>
</html>