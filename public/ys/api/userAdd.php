<?php
	include("../include/init.php");//引入链接数据库 
	
	$id = $_POST['id'];
	
	$real_name = $_POST['real_name'];
	$tel = $_POST['tel'];
	$lv = $_POST['lv'];
	$isYsTest = $_POST['isYsTest'];
	$ysScore = $_POST['ysScore'];
	
	$prepareTime = $_POST['prepareTime'];
	$targetScore = $_POST['targetScore'];
	$extraScore = $_POST['extraScore'];
	
	$testScore = $_POST['testScore'];
	$speak = $_POST['speak'];
	$composition = $_POST['composition'];
	
	$user_learn = $_POST['user_learn'];
	
	$arr=array(
		"userName"=>$real_name,
		"tel"=>$tel,
		"lv"=>$lv,
		"isYsTest"=>$isYsTest,
		"ysScore"=>$ysScore,
		"speak"=>$speak,
		"composition"=>$composition,
		"prepareTime"=>$prepareTime,
		"targetScore"=>$targetScore,
		"extraScore"=>$extraScore,
		
		"testScore"=>$testScore,
	);
	delete("y_user_learn","b_uid = ".$id);
	if($_POST['user_learn']){
		$arr2 = explode(",", $_POST['user_learn']);
		foreach ($arr2 as $circle){
			$arr2=array(
				"b_uid"=>$id,
				"b_lid"=>$circle
			);
			add("y_user_learn",$arr2);
			echo $circle;
		}
	}
	
	
	edit("y_user",$arr,"uid=".$id);
	echo json_encode(array("error"=>"0"));
	
	
	/*add("s_class",$arr);
	$id = mysql_insert_id();
	echo json_encode(array("error"=>"0","id"=>$id));*/
	
?>