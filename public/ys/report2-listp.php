<?php
	include("include/init.php");//引入链接数据库 
	
	$sql="select * from y_user_homework Join y_homework_list on y_homework_list.hid = y_user_homework.hid Join y_user on y_user.uid = y_user_homework.uid where y_homework_list.etype =2";
	$list = selectAll($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 作业管理 <span class="c-gray en">&gt;</span> 口语作业列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">

		</span> 
		<span class="r">共有数据：<strong><?php echo count($list) ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">名字</th>
					<th width="80">logo</th>
					<th width="80">tel</th>
					<th width="100">大作文标题</th>
					<th width="120">是否批改</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($list as $circle) {
				?>
				<tr class="text-c">
					<td><input type="checkbox" value="" name="newscheck"></td>
					<td class="newsid"><? echo $circle["nickName"]; ?></td>
					<td class="newsid"><img src="<? echo $circle["logo"]; ?>" style="width:50px;height:50px;"></td>
					<td class="newsid"><? echo $circle["tel"]; ?></td>
					<td class="text-l"><?php echo $circle["title"]; ?></u></td>
					<td class="text-l"><?php if($circle["rsid"]){ echo "已批改";}else{ echo "未批改";} ?></u></td>
					<td class="f-14 td-manage">
						<a style="text-decoration:none" class="ml-5" onClick="article_edit('编辑','correct2.php','<? echo $circle["huid"]; ?>')" href="javascript:;" title="编辑">批改</a>
					</td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"pading":false,
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,2]}// 不参与排序的列
	]
});

/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url+"?id="+id
	});
	layer.full(index);
}
/*资讯-删除*/
var urlFix ="https://sam.xinglufamily.com/ys/manage/"
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:urlFix+"reportDelete", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			}
		});
	});
}
/*资讯-批量删除*/
function datadel(){
	layer.confirm('确认要批量删除吗？',function(index){
		$('input[type="checkbox"][name="newscheck"]:checked').each(
			function() {
				var id = $(this).parent().next().text();
				var that = $(this);
				var oMyForm = new FormData();
				oMyForm.append("id", id);
				$.ajax({
					type: "POST",
					url:"api/circleDelete.php", 
					cache: false,
					data:oMyForm,
					processData: false,
					contentType: false,
					//dataType: "json",
					success: function(data){
						that.parents("tr").remove();
						layer.msg('已删除!',{icon:1,time:1000});
					}
				});
			}
		);
	});
}

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:"api/drawbanner.php", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,'+id+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已下架!',{icon: 5,time:1000});
			}
		});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:"api/drawbanner.php", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
				$(obj).remove();
				layer.msg('已发布!',{icon: 6,time:1000});
			}
		});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

</script> 
</body>
</html>