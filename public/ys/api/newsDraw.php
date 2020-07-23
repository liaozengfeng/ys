<?php
	include("../include/init.php");//引入链接数据库 
	
	$id = $_POST['id'];
	
	$sql = "select isShow from y_news where newsId = ".$id;
	$show = selectRow($sql);
	$show1= $show["isShow"];
	if($show1 == 1){
		$arr=array(
			"isShow"=>0
		);
	}else{
		$arr=array(
			"isShow"=>1
		);
	}
	var_dump($show1);
	
	edit("y_news",$arr," newsId = ".$id);
?>