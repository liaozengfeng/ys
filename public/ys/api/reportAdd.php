<?php
	include("../include/init.php");//引入链接数据库 
	$title = 1;//$_POST['title'];
	$content = 2;//$_POST['content'];
	$order = 3;//$_POST['order'];
	$data =[
			"title"=>$title,
			"order"=>$order,
			"content"=>$content,
			"etype"=>1,
			"isShow"=>1
		 ];
		//var_dump($arr);
     $insert = add("y_homework_list",$data);
	 if($insert){
		 $id = 1;
	 }else{
		 $id = 0;
	  }
	  echo json_encode(array("error"=>"0","id"=>$id));
	
	
?>