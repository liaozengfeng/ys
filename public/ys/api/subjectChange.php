<?php
	include("../include/init.php");//�����������ݿ� 
	include("ImgAddress.php");//�����������ݿ� 

	$id = $_POST['id'];
	$question = $_POST['question'];
	$num = $_POST['num'];
	$answerA = $_POST['answerA'];
	$answerB = $_POST['answerB'];
	$ex = $_POST['ex'];
	$current = $_POST['current'];
	
	$arr=array(
		"question"=>$question,
		"num"=>$num,
		"answerA"=>$answerA,
		"answerB"=>$answerB,
		"ex"=>$ex,
		"current"=>$current,
	);
	edit("y_revise",$arr,"reviseId=".$id);
	echo json_encode(array("error"=>"0"));
	
	
?>