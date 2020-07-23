<?php 
	include("include/init.php");//引入链接数据库 	
	$text = null;
	if($_GET["id"]){
		$sql3="select * from y_lesson where lessonId = ".$_GET["id"];
		$text = selectRow($sql3);
	}
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
<style>
	.file{display:none}
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
	<form class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>课程名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["lessonName"]; ?>" placeholder="" id="lessonName" name="lessonName">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>课程封面：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<div id="preview_1">
						<img id="imghead_1" onclick="changeimg()" style="height:100px" src='<?php if($text["lessonCover"]){echo $text["lessonCover"];}else{echo "upload/emm.png";} ?>'>
					</div>
					<input type="file" class="file" id="file_1" name="file" onchange="previewImage(this)" />
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>课程价格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["lessonPrice"]; ?>" placeholder="" id="lessonPrice" name="lessonPrice" oninput = "value=value.replace(/[^\d]/g,'')">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>优惠价格：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["discountPrice"]; ?>" placeholder="" id="discountPrice" name="discountPrice" oninput = "value=value.replace(/[^\d]/g,'')">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button" style="<?php if($_GET["id"]){ echo "display:none;";} ?>">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
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
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	//表单验证
	$("#form-article-add").validate({
		rules:{
			bannertitle:{
				required:true,
			}
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			//$(form).ajaxSubmit();
			<?php $str ="if(!$('#file_1').val()){ $.Huimodalalert('".'请输入课程封面'."',2000);return;}";if(!isset($_GET["id"])){ echo $str; } ?>
			if(!$('#lessonName').val()){ $.Huimodalalert('请输入课程名称',2000);return;}
			if(!$('#lessonPrice').val()){ $.Huimodalalert('请输入课程价格',2000);return;}
			if(!$('#discountPrice').val()){ $.Huimodalalert('请输入优惠价格',2000);return;}
			var oMyForm = new FormData();
			oMyForm.append("lessonName", $("input[name='lessonName']").val());
			oMyForm.append("lessonPrice", $("input[name='lessonPrice']").val());
			oMyForm.append("discountPrice", $("input[name='discountPrice']").val());
			oMyForm.append("file",$('#file_1')[0].files[0]);
			<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
			$.ajax({
				type: "POST",
				url:"<?php if($_GET["id"]){ echo "api/lessonChange.php";}else{echo "api/lessonAdd.php";}; ?>", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				//dataType: "json",
				success: function(data){
					layer.msg('<?php if($_GET["id"]){ echo "修改成功";}else{ echo "添加成功";} ?>', {icon:6,time:2500},function(){
						ok();
					});
					function ok(){
					<?php 
						if($_GET["id"]){
							echo "var index=parent.layer.getFrameIndex(window.name);parent.layer.close(index);";
						}else{
							echo "window.location.reload();";
						}
					?>
					}
				}
			});
		}
	});
	

	
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
<script>
	var before = document.getElementById('preview_1').innerHTML;
	function previewImage(file)
	{
		var MAXWIDTH  = 800; 
		var MAXHEIGHT = 100;
		var back;
		var div = document.getElementById('preview_1');
		var back = document.getElementById('preview_1').innerHTML;
		div.innerHTML ='<img id=imghead_1 onclick="changeimg()">';
		var img = document.getElementById('imghead_1');
		if (file.files && file.files[0])
		{
			img.onload = function(){
			var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
			img.width  =  rect.width;
			img.height =  rect.height;
			//img.style.marginLeft = rect.left+'px';
			//img.style.marginTop = rect.top+'px';
			}
			var reader = new FileReader();
			reader.onload = function(evt){img.src = evt.target.result}
			reader.readAsDataURL(file.files[0]);
		}
		else //兼容IE
		{
			var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
			file.select();
			//console.log(back);
			//var src = document.selection.createRange().text;
			//var src = arrry[change-1];
			//console.log(src);
			if(before!=undefined){
				div.innerHTML = before;
			}else{
				div.innerHTML = "<img id='imghead_1' width=300 height=130 border=0 src='' onclick='changeimg()'>";
			}
			//var img = document.getElementById('imghead');
			
			
			/*img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
			var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
			status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
			div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";*/
		}
	}
	function clacImgZoomParam( maxWidth, maxHeight, width, height ){
		var param = {top:0, left:0, width:width, height:height};
		if( width>maxWidth || height>maxHeight )
		{
			rateWidth = width / maxWidth;
			rateHeight = height / maxHeight;
			 
			if( rateWidth > rateHeight )
			{
				param.width =  maxWidth;
				param.height = Math.round(height / rateWidth);
			}else
			{
				param.width = Math.round(width / rateHeight);
				param.height = maxHeight;
			}
		}
		 
		param.left = Math.round((maxWidth - param.width) / 2);
		param.top = Math.round((maxHeight - param.height) / 2);
		return param;
	}
	function changeimg(){
		console.log("01");
		$('#file_1').click();
	}
</script>
</body>
</html>