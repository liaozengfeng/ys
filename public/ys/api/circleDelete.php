<?php
	include("../include/init.php");//引入链接数据库 
	
	$id = $_POST['id'];
	
	delete("y_learn_circle","cid = ".$id);
?>