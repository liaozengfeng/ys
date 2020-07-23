<?php
	include("include/init.php");//引入链接数据库 
	
	$sql="select * from y_user";
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="r">共有数据：<strong><?php echo count($list) ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="60">ID</th>
					<th width="80">用户名</th>
					<th width="80">头像</th>
					<th width="80">真实姓名</th>
					<th width="80">联系方式</th>
					<th width="80">教室操作</th>
					<th width="80">学生操作</th>
					<th width="80">信息操作</th>
				</tr>
			</thead>
			<tbody>
				<!--<tr class="text-c">
					<td><input type="checkbox" value="" name=""></td>
					<td>10001</td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看">资讯标题</u></td>
					<td>行业动态</td>
					<td>H-ui</td>
					<td>2014-6-11 11:11:42</td>
					<td>21212</td>
					<td class="td-status"><span class="label label-success radius">已发布</span></td>
					<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<tr class="text-c">
					<td><input type="checkbox" value="" name=""></td>
					<td>10002</td>
					<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看">资讯标题</u></td>
					<td>行业动态</td>
					<td>H-ui</td>
					<td>2014-6-11 11:11:42</td>
					<td>21212</td>
					<td class="td-status"><span class="label label-success radius">草稿</span></td>
					<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this,'10001')" href="javascript:;" title="审核">审核</a> <a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>-->
				<?php 
					foreach ($list as $user) {
				?>
				<tr class="text-c">
					<td class="userid"><? echo $user["uid"]; ?></td>
					<td class="userid"><?php echo $user["nickName"]; ?></td>
					<td><image src='<?php echo $user["logo"]; ?>' style='width:100px' /></td>
					<td><?php if($user["userName"]!=null&&$user["userName"]!=""){ echo $user["userName"]; }else{ echo "暂无"; } ?></td>
					<td><?php if($user["tel"]!=null&&$user["tel"]!=""){ echo $user["tel"]; }else{ echo "暂无"; }  ?></td>
					<td class="f-14 td-teacher">
						<?php if($user["isTeacher"]){ 
							echo '<a style="text-decoration:none" onClick="teacher_stop(this,'.$user["uid"].')" href="javascript:;" title="取消教师资格"><i class="Hui-iconfont">&#xe6de;</i>取消教师</a>';
						}else{
							echo '<a style="text-decoration:none" onClick="teacher_start(this,'.$user["uid"].')" href="javascript:;" title="成为教师"><i class="Hui-iconfont">&#xe603;</i>成为教师</a>';
						} ?>
					</td>
					<td class="f-14 td-manage">
						<?php if($user["isStudent"]){ 
							echo '<a style="text-decoration:none" onClick="article_stop(this,'.$user["uid"].')" href="javascript:;" title="取消学生资格"><i class="Hui-iconfont">&#xe6de;</i>取消学生</a>';
						}else{
							echo '<a style="text-decoration:none" onClick="article_start(this,'.$user["uid"].')" href="javascript:;" title="成为学生"><i class="Hui-iconfont">&#xe603;</i>成为学生</a>';
						} ?>
					</td>
					<td class="f-14 ">
						<a style="text-decoration:none" class="ml-5" onClick="article_edit('编辑','user-add.php','<? echo $user["uid"]; ?>')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i>资料编辑</a>
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
	"aaSorting": [[ 0, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"pading":false,
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[5]}// 不参与排序的列
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
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
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
	layer.confirm('确认要取消其学生资格吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:"api/drawstudent.php", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,'+id+')" href="javascript:;" title="成为学生"><i class="Hui-iconfont">&#xe603;</i>成为学生</a>');
				//$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已取消学生!',{icon: 5,time:1000});
			}
		});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要让其成为学生吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:"api/drawstudent.php", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+id+')" href="javascript:;" title="取消学生资格"><i class="Hui-iconfont">&#xe6de;</i>取消学生</a>');
				//$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
				$(obj).remove();
				layer.msg('已成为学生!',{icon: 6,time:1000});
			}
		});
	});
}
/*资讯-发布*/
function teacher_start(obj,id){
	layer.confirm('确认要让其成为教师吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:"api/drawteacher.php", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").find(".td-teacher").prepend('<a style="text-decoration:none" onClick="teacher_stop(this,'+id+')" href="javascript:;" title="取消教师资格"><i class="Hui-iconfont">&#xe6de;</i>取消教师</a>');
				//$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
				$(obj).remove();
				layer.msg('已成为教师!',{icon: 6,time:1000});
			}
		});
	});
}
/*资讯-下架*/
function teacher_stop(obj,id){
	layer.confirm('确认要取消其教师资格吗？',function(index){
		var oMyForm = new FormData();
		oMyForm.append("id", id);
		$.ajax({
			type: "POST",
			url:"api/drawteacher.php", 
			cache: false,
			data:oMyForm,
			processData: false,
			contentType: false,
			//dataType: "json",
			success: function(data){
				$(obj).parents("tr").find(".td-teacher").prepend('<a style="text-decoration:none" onClick="teacher_start(this,'+id+')" href="javascript:;" title="成为教师"><i class="Hui-iconfont">&#xe603;</i>成为教师</a>');
				//$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已取消教师!',{icon: 5,time:1000});
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