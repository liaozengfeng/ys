<?php
	include("../include/init.php");//�����������ݿ� 
	include("ImgAddress.php");//�����������ݿ� 

	
	$question = $_POST['question'];
	$num = $_POST['num'];
	$answerA = $_POST['answerA'];
	$answerB = $_POST['answerB'];
	$ex = $_POST['ex'];
	$current = $_POST['current'];
	$time = time();
	
	$arr=array(
		"question"=>$question,
		"num"=>$num,
		"answerA"=>$answerA,
		"answerB"=>$answerB,
		"ex"=>$ex,
		"current"=>$current,
		"updatetime"=>$time
	);
	add("y_revise",$arr);
	$id = mysql_insert_id();
	echo json_encode(array("error"=>"0","id"=>$id));
	
	
	
?>