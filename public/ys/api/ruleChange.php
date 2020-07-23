<?php
	include("../include/init.php");//引入链接数据库 
	include("ImgAddress.php");//引入链接数据库 
	
	
	$id = $_POST['id'];
	$r_detail = $_POST['r_detail'];
	$arr=array(
		"ruleContent"=>$r_detail
	);
	
	edit("y_rule",$arr,"ruleId=".$id);
	
	echo json_encode(array("error"=>"0"));
?>