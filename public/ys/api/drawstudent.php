<?php
	include("../include/init.php");//引入链接数据库 
	
	$id = $_POST['id'];
	
	$sql = "select isStudent from y_user where uid = ".$id;
	$show = selectRow($sql)["isStudent"];
	if($show ==1){
		$arr=array(
			"isStudent"=>0,
			"sTime"=>date("Y-m-d",time())
		);
	}else{
		$arr=array(
			"isStudent"=>1,
			"sTime"=>date("Y-m-d",time())
		);
	}
	
	edit("y_user",$arr,"uid=".$id);
	echo $show;
?>