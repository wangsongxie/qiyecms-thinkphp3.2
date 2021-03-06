<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo ($sys['sys_name']); ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="/qiye/Public/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/font-awesome.min.css?v=4.1" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="/qiye/Public/Admin/css/animate.min.css" rel="stylesheet">  
    <link href="/qiye/Public/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">	
    <link href="/qiye/Public/Admin/css/uploadfile.css" rel="stylesheet">
   	<script src="/qiye/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/qiye/Public/Common/layer/layer.js"></script>
    <script src="/qiye/Public/Admin/js/jquery.form.js"></script>
</head>
	
<body class="gray-bg wrapper wrapper-content">




<div style="display:none;">
<?php echo ($sys["sys_tongji"]); ?>
</div>
<script>
window.onload=function(){
	var num = $("#cnzz_stat_icon_1253472858").html();
	var data = /([^\[\]]+)(?=\])/g;
	data = num.match(data);
	
	var add = "<span style=\"font-size:14px\"> IP</span>"
	var dayip = data[0];
	var dayip2 = data[2];
	$("#dayip").html(dayip+add);
	$("#dayip2").html(dayip2+"IP");
	dayip = parseInt(dayip);
	dayip2 = parseInt(dayip2);
	if(dayip>dayip2){
			var daysum = dayip-dayip2;
			$("#dayip3").html("+"+daysum);
			$("#dayipclass").attr("class","fa fa-level-up");
		}else{
			var daysum = dayip2-dayip;
			$("#dayip3").html("-"+daysum);
			$("#dayipclass").attr("class","fa fa-level-down");
	}
	
	var add2 = "<span style=\"font-size:14px\"> PV</span>"
	var daypv = data[1];
	var daypv2 = data[3];
	$("#daypv").html(daypv+add2);
	$("#daypv2").html(daypv2+"PV");
	daypv = parseInt(daypv);
	daypv2 = parseInt(daypv2);
	if(daypv>daypv2){
			var daysum2 = daypv-daypv2;
			$("#daypv3").html("+ "+daysum2);
			$("#daypvclass").attr("class","fa fa-level-up");
		}else{
			var daysum2 = daypv2-daypv;
			$("#daypv3").html("- "+daysum2);
			$("#daypvclass").attr("class","fa fa-level-down");
	}
	
	var add3 = "<span style=\"font-size:14px\"> 人</span>"
	var online = data[4];
	$("#online").html(online+add3);

	
	

	}

//通过时间判断早上、晚上
$(function(){
	var d = new Date();
	var vYear = d.getFullYear()
	var vMon = d.getMonth() + 1
	var vDay = d.getDate()
	var h = d.getHours(); 
	
	var weather1 = "<?php echo ($getweather["result"]["data"]["weather"]["0"]["info"]["day"]["1"]); ?>";
	var weather11 = "<?php echo ($getweather["result"]["data"]["weather"]["0"]["info"]["day"]["3"]); ?>";
	var weather12 = "<?php echo ($getweather["result"]["data"]["weather"]["0"]["info"]["day"]["4"]); ?>";
	
	var weather2 = "<?php echo ($getweather["result"]["data"]["weather"]["0"]["info"]["night"]["1"]); ?>";
	var weather21 = "<?php echo ($getweather["result"]["data"]["weather"]["0"]["info"]["night"]["3"]); ?>";
	var weather22 = "<?php echo ($getweather["result"]["data"]["weather"]["0"]["info"]["night"]["4"]); ?>";
	
	if(h>8||h<20){
		$("#getweather").html(weather1+" ("+weather11+weather12+")");
	}
	if(h<8||h>20){
		$("#getweather").html(weather2+" ("+weather21+weather22+")");
	}
});	
//END
</script>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">今日</span>
                        <h5>当前在线</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span id="online">0<span style="font-size:14px"> 人</span></span></h1>
                        <div class="stat-percent font-bold text-success"><i class="fa fa-bolt"></i>
                        </div>
                        <small>在线人数统计</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">今日</span>
                        <h5>浏览次数（PV）</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span id="daypv">0<span style="font-size:14px"> PV</span></span></h1>
                        <div class="stat-percent font-bold text-info">相比昨日 <span id="daypv3">0</span>PV <i class="fa" id="daypvclass"></i>
                        </div>
                        <small>昨日 <span id="daypv2">0PV</span></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">今日</span>
                        <h5>IP访问</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><span id="dayip">0<span style="font-size:14px"> IP</span></span></h1>
                        <div class="stat-percent font-bold text-danger">相比昨日 <span id="dayip3">0</span>IP <i class="fa" id="dayipclass"></i>
                        </div>
                        <small>昨日 <span id="dayip2">0IP</span></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <span class="label label-primary pull-right" id="weather_cs"></span>
                    <h5>每日天气</h5>
                </div>
                <div class="ibox-content" id="weather_data">
                	<h1 class="no-margins">数据加载中...</h1><small>&nbsp;</small></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    
                    <div class="col-sm-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>热门文章</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="overflow:hidden;">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>标题</th>
                                            <th>点击数</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($arclists)): $val = 0; $__LIST__ = $arclists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($val % 2 );++$val;?><tr>
                                            <td style="verflow:hidden;"><?php echo ($vo["a_title"]); ?><p style="color:#bbb"><i class="fa fa-clock-o"></i> <?php echo (date("m-d",$vo["create_time"])); ?></p></td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> <?php echo ($vo["a_views"]); ?></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-sm-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>行为日志</h5>
                                
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                           
                            <div class="ibox-content">
                                <ul class="todo-list small-list ui-sortable">
                                    <?php if(is_array($loglists)): $val = 0; $__LIST__ = $loglists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($val % 2 );++$val;?><li>
                                       <?php echo ($vo["description"]); ?><span class="stat-percent"><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></span>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                                                   </ul>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>系统信息</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <td>当前域名：<?php echo $_SERVER['SERVER_NAME'] ;?></td>
                                        </tr>
                                        <tr>
                                            <td>框架版本：ThinkPHP<?php echo ($info["ThinkPHPTYE"]); ?></td>    
                                        </tr>
                                        <tr>
                                            <td>上传最大限制：<?php echo ini_get('post_max_size');?></td>
                                        </tr>
                                        <tr>
                                            <td>PHP运行方式：<?php echo php_sapi_name()?></td>
                                        </tr>
                                        <tr>
                                            <td>系统版本：<?php echo ($info["RUNTYPE"]); ?></td>
                                        </tr>
                                        <tr>
                                            <td>MYSQL版本：<?php echo phpversion();?></td>
                                        </tr>
                                    </thead>                                 
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
		
</div>
</div>
<script type="text/javascript" src="/qiye/Public/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/hplus.min.js?v=4.0.0"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/switchery/switchery.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/contabs.min.js"></script>
<script type="text/javascript" src="/qiye/Public/Common/laydate/laydate.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="/qiye/Public/Admin/js/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

        
        <script src="/Public/Admin/js/jquery.leoweather.min.js"></script>

<script type="text/javascript">
	$('#weather_time').leoweather({format:'{年}年{月}月{日}日 星期{周} {时}:{分}:{秒}'});
	$('#weather_data').leoweather({format:'<h1 class="no-margins">{夜间气温}℃ ~ {白天气温}℃</h1><small>{天气} - {风向}（{风级}）</small><div class="stat-percent font-bold text-navy">{时段}</div>'});
	$('#weather_cs').leoweather({format:'{城市} - {天气}'});
</script>
</body>
</html>