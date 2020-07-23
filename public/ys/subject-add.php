<?php 
	include("include/init.php");//引入链接数据库 	
	$text = null;
	if($_GET["id"]){
		$sql="select * from y_revise where reviseId = ".$_GET["id"];
		$text = selectRow($sql);
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
	<div class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>题目标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["question"]; ?>" placeholder="" id="question" name="question">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>题目序号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["num"]; ?>" placeholder="" id="num" name="num">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>题目选项A：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["answerA"]; ?>" placeholder="" id="answerA" name="answerA">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>题目选项B：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["answerB"]; ?>" placeholder="" id="answerB" name="answerB">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>解释：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["ex"]; ?>" placeholder="" id="ex" name="ex">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>题目答案：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="current" class="select">
						<option value="A" <?php if($text["newsType"]=="A"){ echo ' selected = "selected"'; } ?>>A</option>
						<option value="B" <?php if($text["newsType"]=="B"){ echo ' selected = "selected"'; } ?>>B</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" onclick="upload()"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button" style="<?php if($_GET["id"]){ echo "display:none;";} ?>">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
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
//var ue = UE.getEditor('editor');
function upload(){
	
	if(!$('#question').val()){ $.Huimodalalert('请输入题目',2000);return;}
	if(!$('#num').val()){ $.Huimodalalert('请输入题目序号',2000);return;}
	if(!$('#answerA').val()){ $.Huimodalalert('请输入答案A',2000);return;}
	if(!$('#answerB').val()){ $.Huimodalalert('请输入答案B',2000);return;}
	if(!$('#ex').val()){ $.Huimodalalert('请输入解释',2000);return;}
	
	
	var oMyForm = new FormData();
	oMyForm.append("question", $("input[name='question']").val());
	oMyForm.append("num", $("input[name='num']").val());
	oMyForm.append("answerA", $("input[name='answerA']").val());
	oMyForm.append("answerB", $("input[name='answerB']").val());
	oMyForm.append("ex", $("input[name='ex']").val());
	oMyForm.append("current", $("#current").val());
	
	<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
	$.ajax({
		type: "POST",
		url:"<?php if($_GET["id"]){ echo "api/subjectChange.php";}else{echo "api/subjectAdd.php";}; ?>", 
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
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	//表单验证
	/*$("#form-article-add").validate({
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
			
		}
	});*/
	
	
	

	
});
</script>
<!--/请在上方写此页面业务相关的脚本-->

</body>
</html>