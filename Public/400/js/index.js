jQuery(".banner").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"topLoop",  autoPlay:true, autoPage:true, trigger:"click" });
jQuery(".Platform").slide({titCell:".hd ul",mainCell:".bd .ulWrap",autoPage:true,effect:"leftLoop",autoPlay:true,vis:2});
$(document).ready(function() {
  $(".adv_main dl").click(function(){
	var num=$(this).attr("data-num");
	if(num==1){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(0deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("提成品牌形象");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("现国内企业中400电话已经成为形象的代言人，它不单单只是一个号码，更多的是代表企业对客户的服务理念，好的形象可以获得更高的客户主动拨打量，好的服务理念才是企业发展的硬道理。");
		}
	if(num==2){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(305deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("唯一号码，独占鳌头");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("全国唯一号码，简单易记 1个400号码可以解决企业对于全国客户的服务接入，客户记住了号码等于记住了企业。");
		}
	if(num==3){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(50deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("企业营销好帮手");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("企业把400号码公布在名片、广告中可以全面提升行业覆盖面、影响力，帮您在与竞争对手相比时更胜一筹。");
		}
	if(num==4){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(250deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("轻松移动办公");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("400总机可转接手机，及时出差旅行，照样可以实现外地办公。轻松自如。");
		}
	if(num==5){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(110deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("智能转接，定向服务");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("可根据时间、星期、地区等多种情况作出个性化的设置，按策略进行呼转，体现了您对客户用心服务的理念，为客户提供专业便捷的服务。");
		}
	if(num==6){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(205deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("帮助企业规范管理");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("400总机服务避免了客户只记住员工的号码，任何一个客户的来访都可以保存记录，帮助企业管理客户、及时监控、保障客户资源的私密性。");
		}
	if(num==7){
		$(this).parent().parent().find(".adv_center").css("transform","rotate(155deg)");
		$(this).parent().parent().find(".adv_center_info .content p.t").html("企业客户绝不流失");
		$(this).parent().parent().find(".adv_center_info .content p.c").html("400号码可以终身不变，企业搬家，只需要更换绑定的实体电话，客户一个也不会流失。");
		}
	$(this).siblings().removeClass("on");	
	$(this).addClass("on");
 	});
	
	
	
	//400选号
	$("#num4").keyup(function(){
		$("#num5").focus();	
	});
	$("#num5").keyup(function(){
		$("#num6").focus();	
	});
	$("#num6").keyup(function(){
		$("#num7").focus();	
	});
	$("#num7").keyup(function(){
		$("#num8").focus();	
	});
	$("#num8").keyup(function(){
		$("#num9").focus();	
	});
	$("#num9").keyup(function(){
		$("#num10").focus();	
	});
})