<?php
	include("../include/init.php");//�����������ݿ� 
	
	$id = $_POST['id'];
	
	$sql = "select isTeacher from y_user where uid = ".$id;
	$show = selectRow($sql)["isteacher"];
	if($show ==1){
		$arr=array(
			"isTeacher"=>0
		);
	}else{
		$arr=array(
			"isTeacher"=>1
		);
	}
	
	edit("y_user",$arr,"uid=".$id);
	echo $show;
?>