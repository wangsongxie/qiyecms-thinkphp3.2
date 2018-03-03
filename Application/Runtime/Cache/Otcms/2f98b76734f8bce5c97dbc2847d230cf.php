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


	<body class="gray-bg wrapper wrapper-content">


		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5><i class="fa fa-tasks"></i> 表单管理</h5>
					</div>
					<div class="ibox-content">
                    
                    
        
        <div class="hr-line-dashed"></div>
        
                    <form id="leftnav" name="leftnav" method="post" action="" >
                    <input type="hidden" name="checkk" id="checkk" value="1" />
						<table class="table table-bordered">
							<thead>
								<tr class="long-tr">
									<th width="4%">编号</th>										
									<th width="18%">姓名</th>									
									<th>电话</th>
									<th>邮箱</th>
									<th>地址</th>
									<th>留言内容</th>
									<th>添加时间</th>
									<th width="15%">操作</th>
								</tr>
							</thead>
                            
                            
                            
                            <script id="arlist" type="text/html">
								{{# for(var i=0;i<d.length;i++){  }}

								<tr class="long-td">
								  	<td>{{d[i].id}}</td>
									<td>{{d[i].name}}</td>
									<td>{{d[i].tel}}</td>
									<td>{{d[i].email}}</td>
									<td>{{d[i].address}}</td>
									<td>{{d[i].content}}</td>
									<td>{{d[i].addtime}}</td>
									<td>
										
										<a href="javascript:;" onclick="del({{d[i].id}})" class="btn btn-danger btn-xs">
											<i class="fa fa-trash-o"></i> 删除</a>
									</td>
								</tr>
								{{# } }}
							</script>
							<tbody id="article_list"></tbody>
                            
                            
						</table>
						</form>

					<div id="AjaxPage" style=" text-align: right;"></div>
					<div id="allpage" style=" text-align: right;"></div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="/qiye/Public/Common/laytpl/laytpl.js"></script>
	<script type="text/javascript" src="/qiye/Public/Common/laypage/laypage.js"></script>
	
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


	<script type="text/javascript">
	//laypage分页
	function Ajaxpage(curr){
		var caitid="<?php echo ($testcatid); ?>";
		var val="<?php echo ($testval); ?>";
		$.post('<?php echo U("Sys/put");?>', {
	        page: curr || 1,val:val,catid:caitid
	    }, function(data){
			if(data.list=null){
				$("#article_list").html('<center style="margin-top:300px;font-size:15px;">没有数据</center>');
			}else{
				article_list(data.info);
				laypage({
					cont: $('#AjaxPage'),//容器。值支持id名、原生dom对象，jquery对象,
					pages:'<?php echo ($allpage); ?>',//总页数
					skip: true,//是否开启跳页
					skin: '#1AB5B7',
					curr: curr || 1,
					groups: 4,//连续显示分页数
					jump: function(obj, first){

						if(!first){
							Ajaxpage(obj.curr)
						}
						$('#allpage').html('第'+ obj.curr +'页，共'+ obj.pages +'页');
					}
				});
			}
		});
	}
	Ajaxpage();

//接收异步获取的数据渲染到模板
function article_list(list){
	var tpl = document.getElementById('arlist').innerHTML;
	laytpl(tpl).render(list, function(html){
		document.getElementById('article_list').innerHTML = html;
	});
}

//状态
function state(val){
	$.post('<?php echo U("article_state");?>',
	{id:val},
	function(data){
	var $v=val;
		if(data.status){
			if(data.info=='状态禁止'){
				var a='<span class="label label-danger" title="已禁用">禁用</span>'
				$('#zt'+val).html(a);
				layer.msg(data.info,{icon:4});
				return false;
			}else{
				var b='<span class="label label-info" title="已开启">开启</span>'
				$('#zt'+val).html(b);
				layer.msg(data.info,{icon:1});
				return false;
			}

		}
	});
	return false;
}

//头条
function toutiao(val){
	$.post('<?php echo U("article_toutiao");?>',
	{id:val},
	function(data){
	var $v=val;
		if(data.status){
			if(data.info=='取消头条'){
				var a='<span class="label label-warning">否</span>'
				$('#tt'+val).html(a);
				layer.msg(data.info,{icon:4});
				return false;
			}else{
				var b='<span class="label label-success">是</span>'
				$('#tt'+val).html(b);
				layer.msg(data.info,{icon:1});
				return false;
			}

		}
	});
	return false;
}


//推荐
function tuijian(val){
	$.post('<?php echo U("article_tuijian");?>',
	{id:val},
	function(data){
	var $v=val;
		if(data.status){
			if(data.info=='取消推荐'){
				var a='<span class="label label-warning">否</span>'
				$('#tj'+val).html(a);
				layer.msg(data.info,{icon:4});
				return false;
			}else{
				var b='<span class="label label-success">是</span>'
				$('#tj'+val).html(b);
				layer.msg(data.info,{icon:1});
				return false;
			}

		}
	});
	return false;
}

//编辑
function edit(id){

	location.href = '/qiye/index.php?s=/Otcms/Sys/edit/id/'+id+'.html';
}

//删除
function del(id){

	layer.confirm('你确定要删除吗？', {icon: 3}, function(index){
		layer.close(index);
		$.ajax({
			url : "<?php echo U('Sys/put_del');?>",
			type : "post",
			data:{id:id},
			success : function(res) {
				if(res.status) {
					layer.msg(res.info,{icon:1,time:1000});
					Ajaxpage(1,5)
				} else {
					layer.msg(res.info,{icon:0});
				}
			}
		});
	});

}


</script>
	</body>
</html>