<?php
	include("../include/init.php");//引入链接数据库 
	
	$id = $_POST['id'];
	
	$sql = "select isShow from y_lesson where lessonId = ".$id;
	$show = selectRow($sql)["isShow"];
	if($show ==1){
		$arr=array(
			"isShow"=>0
		);
	}else{
		$arr=array(
			"isShow"=>1
		);
	}
	
	edit("y_lesson",$arr,"lessonId=".$id);
?>