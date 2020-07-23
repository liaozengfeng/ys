<?php 
	include("include/init.php");//引入链接数据库 	
	if($_GET["id"]){
		$sql3="select * from y_learn_theme where tid = ".$_GET["id"];
		$text = selectRow($sql3);
	}
	$sql2="select * from y_learn";
	$list2 = selectAll($sql2);
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

<title>添加主题 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<div class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>主题名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["themeName"]; ?>" placeholder="" id="themename" name="themename">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>主题封面：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<div id="preview_1">
						<img id="imghead_1" onclick="changeimg()" style="height:100px" src='<?php if($text["themeCover2"]){echo $text["themeCover2"];}else{echo "upload/emm.png";} ?>'>
					</div>
					<input type="file" class="file" id="file_1" name="file" onchange="previewImage(this)" />
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属圈子：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="learn" class="select">
						<?php foreach ($list2 as $learn) { ?>
							<option value="<?php echo $learn["learnId"]; ?>" <?php if($learn["learnId"]==$text["cid"]){ echo ' selected = "selected"'; } ?>><?php echo $learn["learnArea"]; ?></option>
						<?php } ?>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>难度等级：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="lv" class="select">
						<option value="1" <?php if(1==$text["lv"]){ echo ' selected = "selected"'; } ?>>难度1</option>
						<option value="2" <?php if(2==$text["lv"]){ echo ' selected = "selected"'; } ?>>难度2</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类型分类：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="ysType" class="select">
						<option value="1" <?php if(1==$text["ysType"]){ echo ' selected = "selected"'; } ?>>雅思小白</option>
						<option value="2" <?php if(2==$text["ysType"]){ echo ' selected = "selected"'; } ?>>提分技巧</option>
						<option value="3" <?php if(3==$text["ysType"]){ echo ' selected = "selected"'; } ?>>高分锦囊</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>腾讯视频：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="tx" class="select">
							<option value="0" <?php if($text["isTx"]==0){ echo 'selected = "selected"'; } ?>>非腾讯视频</option>
						    <option value="1" <?php if($text["isTx"]==1){ echo 'selected = "selected"'; } ?>>腾讯视频</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<input type="text" id="avatval" placeholder="请选择文件···" style="vertical-align: middle;" value="<?php echo $text["themeVideo"]; ?>" />
					<input type="file" name="avatar" id="file_video"/>
					<a href="javascript:void(0);" class="button-selectimg" id="avatsel1">选择文件</a>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">主题内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo $text["themeContent"]; ?></script> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="button" onclick="upload()"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
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
	<?php $str ="if(!$('#file_1').val()){ $.Huimodalalert('".'请输入主题封面'."',2000);return;}";if(!isset($_GET["id"])){ echo $str; } ?>
	if(!$('#themename').val()){ $.Huimodalalert('请输入主题名称',2000);return;}
	if(!ue.getContent()){ $.Huimodalalert('请输入主题内容',2000);return;}
	
	var oMyForm = new FormData();
	<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
	var themename = $("input[name='themename']").val();
	
	
	
	themename = themename.replace(/\'/g,"’").replace(/</g,"《").replace(/>/g,"》").replace(/</g,"《").replace(/>/g,"》").replace(/\"/g,"”");

	oMyForm.append("theme_name", themename);
	oMyForm.append("circle_id", $("#learn").val());
	oMyForm.append("lv", $("#lv").val());
	oMyForm.append("tx", $("#tx").val());
	oMyForm.append("ysType", $("#ysType").val());
	oMyForm.append("theme_content",ue.getContent());
	oMyForm.append("file",$('#file_1')[0].files[0]);
	oMyForm.append("video",$('#file_video')[0].files[0]);
	oMyForm.append("video_text",$("#avatval").val());
	console.log($("#avatval").val());
	$.ajax({
		type: "POST",
		url:"<?php if($_GET["id"]){ echo "api/themeChange.php";}else{echo "api/themeAdd.php";}; ?>", 
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
				$("#percent").text(Math.floor(percent)+"%");
			}else{
				$(".mask").css("display","none");
				$(".loading").css("display","none");
				$(".loadingtext").css("display","none");
			}
			console.log(percent);
		}  
	}  
}
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#avatsel1").click(function(){
		console.log("01");
		$("#file_video").trigger('click');
	});
	$("#avatval").click(function(){
		//console.log("02");
		//$("#file_video").trigger('click');
	});
	$("#file_video").change(function(){
		console.log("03");
		$("#avatval").val($(this).val());
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