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
	
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="/qiye/Uploads/<?php echo ($_SESSION['admin_img']); ?>" onerror="this.src='/qiye/Public/Admin/img/touxiang_default.gif'" width="70px" height="70px"/></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong><?php echo ($_SESSION['admin_realname']); ?></strong></span>
                                <span class="text-muted text-xs block">
                                    <?php echo ($admin_group["title"]); ?>
                                	<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="<?php echo U('Sys/pwd');?>">修改密码</a></li>
                                <li><a href="javascript:;" id="cache">清除缓存</a></li>
                                <li class="divider"></li>
                                <li><a class="logout" href="javascript:;">退出系统</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">OT<sup>+</sup></div>
                    </li>
                    <li>
                        <a href="<?php echo U('index/index');?>"><i class="fa fa-home"></i> <span class="nav-label">后台首页</span></a>
                    </li>
                    
                    <script>
                    	$(".dropdown-menu").mouseleave(function(){
							$(".dropdown").click();	
						})
                    </script>

<?php use Common\Controller\AuthController; use Think\Auth; $m = M('auth_rule'); $field = 'id,name,title,css'; $data = $m->field($field)->where('pid=0 AND status=1')->order('sort')->select(); $auth = new Auth(); foreach ($data as $k=>$v){ if(!$auth->check($v['name'], $_SESSION['aid']) && $_SESSION['aid'] != 1){ unset($data[$k]); } } ?>

	<?php if(is_array($data)): foreach($data as $key=>$v): ?><li class="<?php if(CONTROLLER_NAME == $v['name']): ?>active<?php endif; ?>"><!--open代表打开状态-->
				<a href="#">
					<i class="menu-icon fa <?php echo ($v["css"]); ?>"></i>
					<span class="nav-label"><?php echo ($v["title"]); ?></span><span class="fa arrow"></span>
				</a>

			<ul class="nav nav-second-level">
    <?php $m = M('auth_rule'); $dataa = $m->where(array('pid'=>$v['id'],'status'=>1))->order('sort')->select(); foreach ($dataa as $kk=>$vv){ if(!$auth->check($vv['name'], $_SESSION['aid']) && $_SESSION['aid'] != 1){ unset($dataa[$kk]); } } ?>
		    <?php if(is_array($dataa)): foreach($dataa as $key=>$j): ?><li>
						<a class="J_menuItem" href="<?php echo U($j['name'],array('se'=>$j['id']));?>"><?php echo ($j["title"]); ?></a>						
					</li><?php endforeach; endif; ?>
			</ul>
		</li><?php endforeach; endif; ?>

        </ul>
    </div>
</nav>



    <div id="page-wrapper" class="gray-bg dashbard-1">
    <!--<div class="row border-bottom">
	<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
			<form role="search" class="navbar-form-custom" method="post" action="search_results.html">
				<div class="form-group">
					<input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
				</div>
			</form>
		</div>
		<ul class="nav navbar-top-links navbar-right">
			<li>
               <a href="/" title="网站首页" target="_blank"><i class="fa fa-home"></i> 网站首页</a>
			</li>
			<li>
				<a href="javascript:;"  id="loginout">
					<i class="fa fa-sign-out"></i> 退出
				</a>
			</li>
		</ul>
	</nav>
</div>-->


<script type="text/javascript">
$(document).ready(function(){
	$("#loginout").click(function(){
		layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
	    layer.close(index);
	    window.location.href="<?php echo U('Login/logout');?>";
	});
	});
});
</script>



 <!--右侧部分开始-->
   
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                        class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a href="/" target="_blank">
                            <i class="fa fa-home"></i> 网站首页
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">常用操作<span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabGo"><a>前进</a></li>
                    <li class="J_tabBack"><a>后退</a></li>
                    <li class="J_tabFresh"><a>刷新</a></li>
                    <li class="divider"></li>
                    <li class="J_tabShowActive"><a>定位当前选项卡</a></li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a></li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a></li>
                </ul>
            </div>
            <a href="javascript:;" class="roll-nav roll-right J_tabExit logout">
                <i class="fa fa fa-sign-out"></i>退出
            </a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Index/indexpage');?>" frameborder="0" data-id="index.html" seamless></iframe>
        </div>
       
   <div class="footer">
            <div class="pull-right"><a href="#"  target="_blank" style="color:#999">&copy; OTCMS V3.2.3</a>
            </div>
        </div>
    <!--右侧部分结束-->
    
    
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">
            <ul class="nav nav-tabs navs-3">
                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                        <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                    </div>
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定宽度</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="title">皮肤选择</div>
                        <div class="setings-item default-skin nb">
                            <span class="skin-name ">
                                 <a href="#" class="s-skin-0">
                                     默认皮肤
                                 </a>
                            </span>
                        </div>
                        <div class="setings-item blue-skin nb">
                            <span class="skin-name ">
                                <a href="#" class="s-skin-1">
                                    蓝色主题
                                </a>
                            </span>
                        </div>
                        <div class="setings-item yellow-skin nb">
                            <span class="skin-name ">
                                <a href="#" class="s-skin-3">
                                    黄色/紫色主题
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--右侧边栏结束-->




    
		
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

        
        <script src="/qiye/Public/Admin/js/jquery.leoweather.min.js"></script>
<script src="/qiye/Public/Admin/js/contabs.js"></script>
<script type="text/javascript">
//退出登录
$(document).ready(function(){
    $(".logout").click(function(){
        layer.confirm('你确定要退出吗？', {icon: 3}, function(index){
            layer.close(index);
            window.location.href="<?php echo U('Login/logout');?>";
        });
    });
});

//清除缓存
$(function(){
    $("#cache").click(function(){
        layer.confirm('你确定要清除缓存吗？', {icon: 3, title:'提示'}, function(index){                   
            $.getJSON("<?php echo U('Sys/clearRuntime');?>",function(data){
                if(data.status == 1){
					layer.msg(data.info,{icon:1});
					
                }else{
					layer.msg(data.info,{icon:4});
                }
		
            });
            layer.close(index);
        })
    });      
});



$("#right-sidebar").mouseleave(function(){
	$(".right-sidebar-toggle").click();	
})
</script>

</body>
</html>