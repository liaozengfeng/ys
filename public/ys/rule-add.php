<?php 
	include("include/init.php");//引入链接数据库 	
	$text = null;
	$sql = "select *from y_rule where ruleId = ".$_GET["id"];
	$query = selectRow($sql);
?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui/css/video.css" />
<style>
	.file{display:none}
	.mask{
		width:100%;
		height:100%;
		background:#000;
		opacity:0.5;
		position:fixed;
		z-index:1000;
		display:none;
	}
	.loading{
		color:#fff;
		text-align:center;
		position:fixed;
		z-index:1003;
		top:50%;
		left:50%;
		display:none;
	}
	.loadingtext{
		color:#fff;
		text-align:center;
		position:fixed;
		z-index:1003;
		top:50%;
		left:40%;
		margin-top:100px;
		display:none;
	}
</style>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>新增文章 - 资讯管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<div class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><?php echo $query["ruleName"]; ?>：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo $query["ruleContent"]; ?></script> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="button" onclick="upload()"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button" style="<?php if($_GET["id"]){ echo "display:none;";} ?>">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</div>
	<div class="mask"></div>
	<div class="loading">
	</div>
	<div class="loadingtext">
	正在上传…请勿关闭页面…<span id="percent">0%</span>
	</div>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
var ue = UE.getEditor('editor');
function upload(){
	var oMyForm = new FormData();
	<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
	oMyForm.append("r_detail", ue.getContent());
	$.ajax({
		type: "POST",
		url:"api/ruleChange.php", 
		cache: false,
		data:oMyForm,
		processData: false,
		contentType: false,
		//dataType: "json",
		xhr: function(){ //获取ajaxSettings中的xhr对象，为它的upload属性绑定progress事件的处理函数  
			myXhr = $.ajaxSettings.xhr();  
			if(myXhr.upload){ //检查upload属性是否存在  
			//绑定progress事件的回调函数  
			myXhr.upload.addEventListener('progress',progressHandlingFunction, false);   
			}  
			return myXhr; //xhr对象返回给jQuery使用  
		}, 
		success: function(data){
			layer.msg('修改成功', {icon:6,time:2500},function(){
				ok();
			});
			function ok(){
				window.location.reload();
			}
		}
	});
	
	function progressHandlingFunction(e) {  
		if (e.lengthComputable) {  
			/*$('#progress').attr({value : e.loaded, max : e.total}); //更新数据到进度条  
			var percent = e.loaded/e.total*100;  
			$('#progress').html(e.loaded + "/" + e.total+" bytes. " + percent.toFixed(2) + "%");  
			$('#progress').css('width', percent.toFixed(2) + "%");*/
			var percent = e.loaded/e.total*100;
			if(percent<100){
				$(".mask").css("display","block");
				$(".loading").css("display","block");
				$(".loadingtext").css("display","block");
				$("#percent").text(percent+"%");
			}else{
				$(".mask").css("display","none");
				$(".loading").css("display","none");
				$(".loadingtext").css("display","none");
			}
			console.log(percent);
		}  
	}  
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>