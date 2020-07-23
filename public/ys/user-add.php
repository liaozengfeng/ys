<?php 
	include("include/init.php");//引入链接数据库 	
	
	$sql="select * from y_user where uid = ".$_GET["id"];
	$text = selectRow($sql);
	
	$sql2="select * from s_class";
	$text2 = selectAll($sql2);
	
	$sql3 = "select * from y_learn";
	$text3 = selectAll($sql3);
	$sql5 = "select * from y_user_learn where b_uid = ".$_GET["id"];
	$text5 = selectAll($sql5);
	
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
	.checkbox_label{line-height:27px}
	.p-b10{padding-botton:10px}
</style>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>新增用户信息 - 资讯管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<div class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>用户昵称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["nickName"]; ?>" placeholder="" id="classname" name="classname" disabled="disabled">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>真实姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["userName"]; ?>" placeholder="" id="real_name" name="real_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系电话：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["tel"]; ?>" placeholder="" id="tel" name="tel">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>雅思课程等级：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="lv" class="select">
						<option value="1" <?php if($text["lv"]==1){ echo "selected='selected'"; } ?>>1级</option>
						<option value="2" <?php if($text["lv"]==2){ echo "selected='selected'"; } ?>>2级</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否参加过雅思考试：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select id="isYsTest" class="select">
						<option value="0" <?php if($text["isYsTest"]==0){ echo "selected='selected'"; } ?>>没有</option>
						<option value="1" <?php if($text["isYsTest"]==1){ echo "selected='selected'"; } ?>>有</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>过往雅思成绩：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["ysScore"]; ?>" placeholder="" id="ysScore" name="ysScore">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>备考时长：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["prepareTime"]; ?>" placeholder="" id="prepareTime" name="prepareTime">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>雅思目标分数</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $text["targetScore"]; ?>" placeholder="" id="targetScore" name="targetScore">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>其他成绩：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea id="extraScore" cols="" rows="" class="textarea" datatype="*10-100" dragonfly="true"><?php echo $text["extraScore"]; ?></textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>雅思自考测试成绩：</label>
			<div class="formControls col-xs-8 col-sm-9">
			<?php
		if($text['testScore']<30)
		 {
			 $ti="outsider";
		 }else if($text['testScore']<50){
			 $ti="fresh";
		 }else if($text['testScore']<80){
			 $ti="junior";
		 }else{
			  $ti="senior";
		 }
		 ?>
				<input type="text" class="input-text" value="<?php echo $ti; ?>" placeholder="" id="testScore" name="testScore">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>口语作业权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
				
			   <span class="select-box">
					<select id="speak" class="select">
						<option value="0" <?php if($text["speak"]==0){ echo "selected='selected'"; } ?>>未开通</option>
						<option value="1" <?php if($text["speak"]==1){ echo "selected='selected'"; } ?>>已开通</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>作文作业权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
			   <span class="select-box">
					<select id="composition" class="select">
						<option value="0" <?php if($text["composition"]==0){ echo "selected='selected'"; } ?>>未开通</option>
						<option value="1" <?php if($text["composition"]==1){ echo "selected='selected'"; } ?>>已开通</option>
					</select>
				</span> 
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">可见圈子：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<?php foreach ($text3 as $circle){ ?>
				<div class="check-box p-b10">
					<input type="checkbox" id="coursecheck" name="allowcomments1" value="<?php echo $circle["learnId"]; ?>" <?php  $ok=0;foreach ($text5 as $type){if($type["b_lid"]==$circle["learnId"]){$ok=1;}}if($ok==1){ echo "checked";}?>>
					<label class="checkbox_label" for="checkbox-pinglun"><?php echo $circle["learnArea"]; ?></label>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" onclick="upload()"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
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
function upload(){
	var oMyForm = new FormData();
	oMyForm.append("real_name", $("#real_name").val());
	oMyForm.append("tel", $("#tel").val());
	oMyForm.append("lv", $("#lv").val());
	oMyForm.append("isYsTest", $("#isYsTest").val());
	oMyForm.append("ysScore", $("#ysScore").val());
	oMyForm.append("prepareTime", $("#prepareTime").val());
	
	oMyForm.append("targetScore", $("#targetScore").val());
	oMyForm.append("extraScore", $("#extraScore").val());
	oMyForm.append("testScore", $("#testScore").val());
	oMyForm.append("speak", $("#speak").val());
	oMyForm.append("composition", $("#composition").val());
	var id_array=new Array();  
	$('input[name="allowcomments1"]:checked').each(function(){  
		id_array.push($(this).val());//向数组中添加元素  
	});  
	var idstr=id_array.join(',');//将数组元素连接起来以构建一个字符串  
	console.log(idstr); 
	oMyForm.append("user_learn", idstr);
	
	<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
	$.ajax({
		type: "POST",
		url:"<?php if($_GET["id"]){ echo "api/userAdd.php";} ?>", 
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
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>