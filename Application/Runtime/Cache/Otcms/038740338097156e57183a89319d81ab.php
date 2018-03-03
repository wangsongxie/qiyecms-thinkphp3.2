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

	<style>
.pages a,.pages span {
    display:inline-block;
    padding:4px 7px;
    margin:0 2px;
    border:1px solid #D5D4D4;
    -webkit-border-radius:1px;
    -moz-border-radius:1px;
    border-radius:1px;
}
.pages a,.pages li {
    display:inline-block;
    list-style: none;
    text-decoration:none; color:#077ee3;
}

.pages a:hover{
    border-color:#077ee3;
}
.pages span.current{
    background:#077ee3;
    color:#FFF;
    font-weight:700;
    border-color:#077ee3;
}

.long-tr th{
	text-align: center
}
.long-td td{
	text-align: center
}
.long-td:hover{ background:#f5f5f5}
</style>

	<script>
$(function(){
	$('#admin_rule_add').ajaxForm({
		beforeSubmit: checkForm, 
		success: complete, 
		dataType: 'json'
	});
	
	function checkForm(){
		if( '' == $.trim($('#title').val())){
			layer.alert('名称不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#title').focus(); 
			});
			return false;
		}
		
		if( '' == $.trim($('#name').val())){
			layer.alert('控制器/方法不能为空', {icon: 6}, function(index){
 			layer.close(index);
			$('#name').focus(); 
			});
			return false;
		}
 }
	function complete(data){
		if(data.status==1){
			layer.alert(data.info, {icon: 6}, function(index){
 			layer.close(index);
			window.location.href=data.url;
			});
		}else{
			alert(data.info);
			return false;	
		}
	}
 
});



$(function(){
	$('#ruleorder').ajaxForm({
		success: complete, 
		dataType: 'json'
	});


	function complete(data){
		if(data.status==1){
			layer.alert(data.info, {icon: 6}, function(index){
 			layer.close(index);
			window.location.href=data.url;
			});
		}else{
			layer.alert(data.info, {icon: 6}, function(index){
 			layer.close(index);
			window.location.href=data.url;
			});
		}
	}
});

</script>
	<body class="gray-bg wrapper wrapper-content">
		
	
    
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5><i class="fa fa-tasks"></i> 菜单列表</h5>
					</div>
					<div class="ibox-content">
                    
                    
                    
                    
                    <div class="row">
                        
                            <div class="col-sm-2" style="width: 100px">
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">添加菜单</button>
                                </div>
                            </div>
                       
                    </div>
                    
                     <div class="hr-line-dashed"></div>
                    
					<form id="ruleorder" name="ruleorder" method="post" action="<?php echo U('ruleorder');?>" >
						<table width="100%" class="table table-striped table-bordered table-hover" id="dynamic-table">
							<thead>
								<tr class="long-tr">
								  <th width="6%">ID</th>
								  <th width="19%">权限名称</th>
								  <th width="15%">控制器/方法</th>
								  <th width="15%">菜单状态</th>
								  <th width="18%">添加时间</th>
								  <th width="11%">排序</th>
								  <th width="15%">操作</th>
							  </tr>
							</thead>

							<tbody>

                            <?php if(is_array($admin_rule)): foreach($admin_rule as $key=>$v): ?><tr>
									<td style="text-align: center;"><?php echo ($v["id"]); ?></td>
									<td style='padding-left:<?php if($v["leftpin"] != 0): echo ($v["leftpin"]); ?>px<?php endif; ?>' ><?php echo ($v["lefthtml"]); echo ($v["title"]); ?></td>
									<td><?php echo ($v["name"]); ?></td>
									<td style="text-align: center;">
									<?php if($v[status] == 1): ?><a class="red" href="javascript:;" onclick="return stateyes(<?php echo ($v["id"]); ?>);" title="已开启">
									<div id="zt<?php echo ($v["id"]); ?>"><span class="label label-info">显示</span></div>
									</a>
									<?php else: ?>
									<a class="red" href="javascript:;" onclick="return stateyes(<?php echo ($v["id"]); ?>);" title="已禁用">
									<div id="zt<?php echo ($v["id"]); ?>"><span class="label label-danger">隐藏</span>
									</a><?php endif; ?>														</td>
									<td style="text-align: center;"><?php echo (date('Y-m-d H:i:s',$v["addtime"])); ?></td>
									<td>
										<div class="col-md-10">
                                            <input name="<?php echo ($v["id"]); ?>" value=" <?php echo ($v["sort"]); ?>" class="form-control">
                                        </div>
									</td>
									<td style="text-align: center;">
										<a href="<?php echo U('admin_rule_edit',array('id'=>$v['id']));?>" class="btn btn-primary btn-sm">
											<i class="fa fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
										<a onclick="return del(<?php echo ($v["id"]); ?>);" href="javascript:;" class="btn btn-danger btn-sm">
											<i class="fa fa-trash-o"></i> 删除</a>
									</td>
								</tr><?php endforeach; endif; ?>   
                              <tr>
								  <td colspan="8" align="right">
								  <button type="submit"  id="btnorder" class="btn btn-info">更新排序</button></td>
							  </tr>
							</tbody>
					  </table>
					</form>
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

	<div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		            <h3 class="modal-title">添加菜单</h3>		           
		        </div>
		        <form class="form-horizontal" name="admin_rule_add" id="admin_rule_add" method="post" action="<?php echo U('admin_rule_add');?>">
		        	<div class="ibox-content">
							<div class="form-group">
				                <label class="col-sm-3 control-label">所属父级</label>
				                <div class="col-sm-8">                   				                    
                                    <select name="pid" class="form-control m-b">
	                                    <option value="0">--默认顶级--</option>
				                            <?php if(is_array($admin_rule)): foreach($admin_rule as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" style="margin-left:55px;"><?php echo ($v["lefthtml"]); echo ($v["title"]); ?></option><?php endforeach; endif; ?>
			                    	</select>                                    
				                </div>
				            </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">菜单名称</label>
								<div class="col-sm-8">
									<input type="text" name="title" id="title" placeholder="输入菜单名称" class="form-control"/>
								</div>
							</div>						
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">控制器/方法</label>
								<div class="col-sm-8">
									<input type="text" name="name" id="name" placeholder="输入控制器/方法名称" class="form-control"/>
								</div>
							</div>	
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">CSS样式</label>
								<div class="col-sm-8">
									<input type="text" name="css" id="css" placeholder="输入菜单名称前显示的CSS样式" class="form-control"/>
									<span class="help-block m-b-none"> <a href="http://fontawesome.dashgame.com/" target="_black">选择图标</a> 不带前缀fa-，如fa-user => user </span>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">排&nbsp;序</label>
								<div class="col-sm-8">
									<input type="text" name="sort" id="sort" value="50" placeholder="输入排序" class="form-control"/>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="form-group">
								<label class="col-sm-3 control-label">状&nbsp;态</label>
								<div class="col-sm-6">
									<div class="radio ">	                        			
	                        			<input type="checkbox" name='status' value="1" class="js-switch" checked />&nbsp;&nbsp;默认显示	                        			
	                        		</div>
								</div>
							</div>					
						</div>
			        <div class="modal-footer">
			        	<button type="submit" class="btn btn-primary">保存内容</button>
			            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>		            
			        </div>
		        </form>
		    </div>
		</div>
	</div>
	<script src="/qiye/Public/Admin/js/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script>

	//IOS开关样式配置
   var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }


function del(id){
		layer.confirm('你确定要删除吗？', {icon: 3}, function(index){
	    layer.close(index);
	    window.location.href="/qiye/index.php?s=/Otcms/Sys/admin_rule_del/id/"+id+"";
	});
}

function stateyes(val){
		  $.post('<?php echo U("admin_rule_state");?>',
		  {x:val},
	function(data){
		if(data.status){
			if(data.info=='状态禁止'){
				var a='<span class="label label-danger">隐藏</span>'
				$('#zt'+val).html(a);
				return false;
			}else{
				var b='<span class="label label-info">显示</span>'
				$('#zt'+val).html(b);
				return false;
			}
		}
	});
	return false;
}
</script>


	</body>

</html>