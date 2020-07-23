<?php 
	include("include/init.php");//引入链接数据库 	
	$text = null;
	if($_GET["id"]){
		$sql3="select * from y_homework_list where hid = ".$_GET["id"];
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
	<form class="form form-horizontal" enctype="multipart/form-data"   id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>口语标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["title"]; ?>" placeholder="" id="title" name="title">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["order"]; ?>" placeholder="" id="order" name="order">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">partA内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				 <input type="file"  class="input-text" id="file01" placeholder="">
				  <br/>
				 ----
				 <br/> 
				 <?php 
				 if(isset($text["part1"])){$arr1 = json_decode($text["part1"],true);}
				 if(isset($text["part2"])){$arr2 = json_decode($text["part2"],true);}
				 if(isset($text["part3"])) {$arr3 = json_decode($text["part3"],true);}
			     ?>
				 <?php if($arr1['speak']['0']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr1['speak']['0']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['0']['script']; ?>" placeholder="请输入script" id="s01" name="s01">
				 <br/>
				 ----
				 <br/>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['0']['tips']; ?>" placeholder="请输入tips" id="t01" name="t01">
				 <br/>----<br/>
				 <input type="file"  class="input-text" id="file02" placeholder=""><br/>----<br/>
				 <?php if($arr1['speak']['1']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr1['speak']['1']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['1']['script'];  ?>" placeholder="请输入script" id="s02" name="s02">
				 <br/>
				 ----
				 <br/>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['1']['tips']; ?>" placeholder="请输入tips" id="t02" name="t02">
				 <br/>
				 ----
				 <br/>
				 <input type="file"  class="input-text" id="file03" placeholder=""><br/>----<br/>
				 <?php if($arr1['speak']['2']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr1['speak']['2']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['2']['script']; ?>" placeholder="请输入script" id="s03" name="s03"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['2']['tips'];  ?>" placeholder="请输入tips" id="t03" name="t03"><br/>----<br/>
				 <br/>
				 <input type="file"  class="input-text" id="file04" placeholder=""><br/>----<br/>
				 <?php if($arr1['speak']['3']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr1['speak']['3']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['3']['script']; ?>" placeholder="请输入script" id="s04" name="s04"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr1['speak']['3']['tips']; ?>" placeholder="请输入tips" id="t04" name="t04"><br/>----<br/>
				 <br/>
				  <div id="file01url" hidden><?php echo $arr1['speak']['0']['audio']; ?></div>
				  <div id="file02url" hidden><?php echo $arr1['speak']['1']['audio']; ?></div>
				  <div id="file03url" hidden><?php echo $arr1['speak']['2']['audio']; ?></div>
				  <div id="file04url" hidden><?php echo $arr1['speak']['3']['audio']; ?></div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">partB内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				 <input type="file" class="input-text" id="file05"  placeholder=""><br/>----<br/>
				 <?php if($arr2['speak']['0']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr2['speak']['0']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr2['speak']['0']['script']; ?>" placeholder="请输入script" id="s05" name="s05"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr2['speak']['0']['tips']; ?>" placeholder="请输入tips" id="t05" name="t05"><br/>----<br/>
				 <br/>
				 <div id="file05url" hidden><?php echo $arr2['speak']['0']['audio']; ?></div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">partC内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<input type="file" class="input-text"    id="file06" placeholder=""><br/>----<br/>
				 <?php if($arr3['speak']['0']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr3['speak']['0']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['0']['script']; ?>" placeholder="请输入script" id="s06" name="s06"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['0']['tips']; ?>" placeholder="请输入tips" id="t06" name="t06"><br/>----<br/>
				 <br/>
				<input type="file" class="input-text"    id="file07" placeholder=""><br/>----<br/>
				 <?php if($arr3['speak']['1']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr3['speak']['1']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['1']['script'];?>" placeholder="请输入script" id="s07" name="s07"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['1']['tips']; ?>" placeholder="请输入tips" id="t07" name="t07"><br/>----<br/>
				 <br/>
				<input type="file" class="input-text"    id="file08" placeholder=""><br/>----<br/>
				 <?php if($arr3['speak']['2']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr3['speak']['2']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['2']['script']; ?>" placeholder="请输入script" id="s08" name="s08"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['2']['tips'];?>" placeholder="请输入tips" id="t08" name="t08"><br/>----<br/>
				 <br/>
				<input type="file" class="input-text"    id="file09" placeholder=""><br/>----<br/>
				 <?php if($arr3['speak']['3']['audio']){?>
				 <audio controls>
                         <source src="<?php echo $arr3['speak']['3']['audio']; ?>" type="audio/mp3">
                        您的浏览器不支持 audio 元素。
                 </audio><?php }?>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['3']['script']; ?>" placeholder="请输入script" id="s09" name="s09"><br/>----<br/>
				 <input type="text" class="input-text" value="<?php echo $arr3['speak']['3']['tips']; ?>" placeholder="请输入tips" id="t09" name="t09">
				 <br/><br/>----<br/>
				<div id="file06url" hidden><?php echo $arr3['speak']['0']['audio']; ?></div>
				<div id="file07url" hidden><?php echo $arr3['speak']['1']['audio']; ?></div>
				<div id="file08url" hidden><?php echo $arr3['speak']['2']['audio']; ?></div>
				<div id="file09url" hidden><?php echo $arr3['speak']['3']['audio']; ?></div>
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

var urlFix = "https://sam.xinglufamily.com/ys/manage/";
var audioArr=[];
function editArr(array,num,link)
{
	audioArr.push(array);
	console.log(audioArr);
	$("#file0"+num+"url").empty();
	$("#file0"+num+"url").text(link);
	
}
  $("#file01").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file01")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file01"];
					editArr(uploadArr,1,res.data);
				
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	

  $("#file02").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file02")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file02"];
					editArr(uploadArr,2,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
 
   $("#file03").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file03")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file03"];
					editArr(uploadArr,3,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
  
 
   $("#file04").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file04")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file04"];
					editArr(uploadArr,4,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
  
    $("#file05").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file05")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file05"];
					editArr(uploadArr,5,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
 
    $("#file06").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file06")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file06"];
					editArr(uploadArr,6,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
  
  
    $("#file07").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file07")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file07"];
					editArr(uploadArr,7,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
  
     $("#file08").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file08")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file08"];
					editArr(uploadArr,8,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
  
 
  
     $("#file09").change(function(){
	  var oMyForm = new FormData();
	  oMyForm.append("sound", $("#file09")[0].files[0]);
        $.ajax({
				type: "POST",
				url:urlFix+"uploadAudio", 
				cache: false,
				data:oMyForm,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(res){
					var uploadArr=[res.data,"file09"];
					editArr(uploadArr,9,res.data);
					console.log(audioArr);
					layer.msg('上传成功', {icon:6,time:2500},function(){
						console.log(res.data);
					});
				}
			});
  });	
  
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
			if(!$("input[name='title']").val()){alert("请上传口语标题");return false;}
			if(!$("input[name='order']").val()){alert("请上传排序");return false;}
			if(!$('#file01url').text()){alert("请上传录音");return false;}
			if(!$('#file02url').text()){alert("请上传录音");return false;}
			if(!$('#file03url').text()){alert("请上传录音");return false;}
			if(!$('#file04url').text()){alert("请上传录音");return false;}
			if(!$('#file05url').text()){alert("请上传录音");return false;}
			if(!$('#file06url').text()){alert("请上传录音");return false;}
			if(!$('#file07url').text()){alert("请上传录音");return false;}
			if(!$('#file08url').text()){alert("请上传录音");return false;}
			if(!$('#file09url').text()){alert("请上传录音");return false;}
			var oMyForm = new FormData();
			oMyForm.append("title", $("input[name='title']").val());
			oMyForm.append("order", $("input[name='order']").val());
			oMyForm.append("file01", $('#file01url').text());
			oMyForm.append("file02", $('#file02url').text());
			oMyForm.append("file03", $('#file03url').text());
			oMyForm.append("file04", $('#file04url').text());
			oMyForm.append("file05", $('#file05url').text());
			oMyForm.append("file06", $('#file06url').text());
			oMyForm.append("file07", $('#file07url').text());
			oMyForm.append("file08", $('#file08url').text());
			oMyForm.append("file09", $('#file09url').text());
			oMyForm.append("s01", $("input[name='s01']").val());
			oMyForm.append("s02", $("input[name='s02']").val());
			oMyForm.append("s03", $("input[name='s03']").val());
			oMyForm.append("s04", $("input[name='s04']").val());
			oMyForm.append("s05", $("input[name='s05']").val());
			oMyForm.append("s06", $("input[name='s06']").val());
			oMyForm.append("s07", $("input[name='s07']").val());
			oMyForm.append("s08", $("input[name='s08']").val());
			oMyForm.append("s09", $("input[name='s09']").val());
			oMyForm.append("t01", $("input[name='t01']").val());
			oMyForm.append("t02", $("input[name='t02']").val());
			oMyForm.append("t03", $("input[name='t03']").val());
			oMyForm.append("t04", $("input[name='t04']").val());
			oMyForm.append("t05", $("input[name='t05']").val());
			oMyForm.append("t06", $("input[name='t06']").val());
			oMyForm.append("t07", $("input[name='t07']").val());
			oMyForm.append("t08", $("input[name='t08']").val());
			oMyForm.append("t09", $("input[name='t09']").val());
			//$('#file_1')[0].files[0]
			<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
			$.ajax({
				type: "POST",
				url:urlFix+"<?php if(!isset($_GET["id"])){ echo "speakAdd";}else{echo "speakEdit";}; ?>", 
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

function newA()
{
	
	alert("新增了Apart");
}
</script>
</body>
</html>