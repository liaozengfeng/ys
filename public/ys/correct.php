<?php 
	include("include/init.php");//引入链接数据库 	
     $sql ="SELECT * FROM y_user_homework WHERE huid = ".$_GET['id'];
	 $s =selectRow($sql);
	 $sqlv ="SELECT * FROM y_homework_correct WHERE hwid = ".$_GET['id'];
	 $sv =selectRow($sqlv);
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
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>小作文：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<pre><?php echo $s['content']; ?> </pre>
			</div>
		</div>
	    
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批改分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $sv['allScore']; ?>" placeholder="" id="allScore" name="">
			</div>
		</div>
		<div class="row cl">
		 <label class="form-label col-xs-4 col-sm-2">小作文长图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<div class="uploader-thum-container">
					<div id="preview_1">
						<img id="imghead_1" onclick="changeimg()" style="height:100px" src='<?php if($sv["homePic"]){echo $sv["homePic"];}else{echo "upload/emm.png";} ?>'>
					</div>
					<input type="file" class="file" id="file_1" name="file" onchange="previewImage(this)" />
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo  $sv['AScore']; ?>" placeholder="" id="trScore" name="">
			</div>
		</div>
		<?php $Aarr=json_decode($sv['AJson'],true); ?>
		<?php $Barr=json_decode($sv['BJson'],true); ?>
		<?php $Carr=json_decode($sv['CJson'],true); ?>
		<?php $Darr=json_decode($sv['DJson'],true); ?>
		<?php $Earr=json_decode($sv['EJson'],true); ?>
		<?php //$Farr=json_decode($sv['resultJson'],true); ?>
		<?php //$Garr=json_decode($sv['EpointJson'],true); ?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：强调主要内容</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][0]['content']; ?>" placeholder="" id="tr01" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：概括整体信息</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][1]['content']; ?>" placeholder="" id="tr02" name="">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：趋势的描述</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][2]['content']; ?>" placeholder="" id="tr03" name="">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：数据的支持</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][3]['content']; ?>" placeholder="" id="tr04" name="">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：报告相同点</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][4]['content'];  ?>" placeholder="" id="tr05" name="">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：对比不同点</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][5]['content']; ?>" placeholder="" id="tr06" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TR：全文清晰</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Aarr['TR'][6]['content']; ?>" placeholder="" id="tr07" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>CC分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo  $sv['BScore']; ?>" placeholder="" id="ccScore" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>CC段落逻辑清晰：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Barr['TR'][0]['content'];?>" placeholder="" id="cc01" name="">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>CC句子间逻辑：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Barr['TR'][1]['content'];?>" placeholder="" id="cc02" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>CC指代使用：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Barr['TR'][2]['content'];?>" placeholder="" id="cc03" name="">
			</div>
		</div>		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>CC逻辑关系词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Barr['TR'][3]['content']; ?>" placeholder="" id="cc04" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>LR分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo  $sv['CScore'];?>" placeholder="" id="lrScore" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>LR无多次重复：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Carr['TR'][0]['content']; ?>" placeholder="" id="lr01" name="">
			</div>
		</div>	
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>LR用词充分灵活：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Carr['TR'][1]['content']; ?>" placeholder="" id="lr02" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>LR词汇搭配地道：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Carr['TR'][2]['content']; ?>" placeholder="" id="lr03" name="">
			</div>
		</div>	
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>GRA分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php  echo  $sv['DScore']; ?>" placeholder="" id="graScore" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>GRA语法准确性：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php  echo $Darr['TR'][0]['content']; ?>" placeholder="" id="gra01" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>GRA语法多样性：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Darr['TR'][1]['content'];?>" placeholder="" id="gra02" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>GRA从句使用：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Darr['TR'][2]['content']; ?>" placeholder="" id="gra03" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>GRA标点准确：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Darr['TR'][3]['content'];?>" placeholder="" id="gra04" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Others分数：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo  $sv['EScore'];?>" placeholder="" id="otherScore" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Others字数满足：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Earr['TR'][0]['content'];?>" placeholder="" id="other01" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Others是否偏题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Earr['TR'][1]['content']; ?>" placeholder="" id="other02" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Others生硬背诵：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Earr['TR'][2]['content'];?>" placeholder="" id="other03" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>Others字迹书写：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Earr['TR'][3]['content']; ?>" placeholder="" id="other04" name="">
			</div>
		</div>	
		<!--
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批改建议（任务与回应）TR：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php  echo $Farr['result'][0]['content'];?>" placeholder="" id="r01" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批改建议（一致与连接）CC：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Farr['result'][1]['content'];?>" placeholder="" id="r02" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批改建议（词汇资源）LR：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Farr['result'][2]['content'];?>" placeholder="" id="r03" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批改建议（语法范围与正确性）GRA：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Farr['result'][3]['content'];?>" placeholder="" id="r04" name="">
			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>提分宝（任务与回应）TR：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Garr['point'][0]['content'];?>" placeholder="" id="p01" name="">
			</div>
		</div>	
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>提分宝（一致与连接）CC：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Garr['point'][1]['content'];?>" placeholder="" id="p02" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>提分宝（词汇资源）LR：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Garr['point'][2]['content']; ?>" placeholder="" id="p03" name="">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>提分宝（语法范围与正确性）GRA：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $Garr['point'][3]['content'];?>" placeholder="" id="p04" name="">
			</div>
		</div>	
        --->
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>批改建议</label>
			<div class="formControls col-xs-8 col-sm-9">
				 <script id="editor01" type="text/plain" style="width:600px;height:300px;"><?php echo $sv["resultJson"]; ?></script> 	
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>提分宝</label>
			<div class="formControls col-xs-8 col-sm-9">
				 <script id="editor02" type="text/plain" style="width:600px;height:300px;"><?php echo $sv["EpointJson"]; ?></script> 	
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
var ue01 = UE.getEditor('editor01');
var ue02 = UE.getEditor('editor02');
var urlFix = "https://sam.xinglufamily.com/ys/manage/";
function upload(){
	<?php $str ="if(!$('#file_1').val()){ $.Huimodalalert('".'请输入封面'."',2000);return;}";if(!isset($_GET["id"])){ echo $str; } ?>
	if(!$('#allScore').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#trScore').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#lrScore').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#ccScore').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#graScore').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#otherScore').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	if(!$('#tr01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#tr02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#tr03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#tr04').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#tr05').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#tr06').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#tr07').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	if(!$('#cc01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#cc02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#cc03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#cc04').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	if(!$('#lr01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#lr02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#lr03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	
	if(!$('#gra01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#gra02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#gra03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#gra04').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	if(!$('#other01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#other02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#other03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	if(!$('#other04').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	//if(!$('#r01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	//if(!$('#r02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	//if(!$('#r03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	//if(!$('#r04').val()){ $.Huimodalalert('请完善内容！',2000);return;}

	//if(!$('#p01').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	//if(!$('#p02').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	//if(!$('#p03').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	//if(!$('#p04').val()){ $.Huimodalalert('请完善内容！',2000);return;}
	
	var oMyForm = new FormData();
	oMyForm.append("allScore", $("#allScore").val());
	oMyForm.append("trScore", $("#trScore").val());
	oMyForm.append("lrScore", $("#lrScore").val());
	oMyForm.append("ccScore", $("#ccScore").val());
	oMyForm.append("graScore", $("#graScore").val());
	oMyForm.append("otherScore", $("#otherScore").val());
	
	oMyForm.append("tr01", $("#tr01").val());
	oMyForm.append("tr02", $("#tr02").val());
	oMyForm.append("tr03", $("#tr03").val());
	oMyForm.append("tr04", $("#tr04").val());
	oMyForm.append("tr05", $("#tr05").val());
	oMyForm.append("tr06", $("#tr06").val());
	oMyForm.append("tr07", $("#tr07").val());
	
	oMyForm.append("cc01", $("#cc01").val());
	oMyForm.append("cc02", $("#cc02").val());
	oMyForm.append("cc03", $("#cc03").val());
	oMyForm.append("cc04", $("#cc04").val());
	
	oMyForm.append("lr01", $("#lr01").val());
	oMyForm.append("lr02", $("#lr02").val());
	oMyForm.append("lr03", $("#lr03").val());
	
	
	oMyForm.append("gra01", $("#gra01").val());
	oMyForm.append("gra02", $("#gra02").val());
	oMyForm.append("gra03", $("#gra03").val());
	oMyForm.append("gra04", $("#gra04").val());
	
	oMyForm.append("other01", $("#other01").val());
	oMyForm.append("other02", $("#other02").val());
	oMyForm.append("other03", $("#other03").val());
	oMyForm.append("other04", $("#other04").val());
	
	oMyForm.append("result", ue01.getContent());
	oMyForm.append("point", ue02.getContent());
	
	//oMyForm.append("r01", $("#r01").val());
	//oMyForm.append("r02", $("#r02").val());
	//oMyForm.append("r03", $("#r03").val());
	//oMyForm.append("r04", $("#r04").val());
	
	//oMyForm.append("p01", $("#p01").val());
	//oMyForm.append("p02", $("#p02").val());
	//oMyForm.append("p03", $("#p03").val());
	//oMyForm.append("p04", $("#p04").val());
	
	oMyForm.append("image",$('#file_1')[0].files[0]);
	
	<?php if($_GET["id"]){ echo "oMyForm.append(\"id\",".$_GET["id"].");";} ?>
	$.ajax({
		type: "POST",
		url:urlFix+"<?php if($_GET["id"]){ echo "correctReport";}else{echo "correctReport";}; ?>", 
		cache: false,
		data:oMyForm,
		processData: false,
		contentType: false,
		//dataType: "json",
		success: function(data){
			layer.msg('<?php if($_GET["id"]){ echo "更新成功";}else{ echo "更新成功";} ?>', {icon:6,time:2500},function(){
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