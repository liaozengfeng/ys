<?php
	include("../include/init.php");//�����������ݿ� 
	
	$id = $_POST['id'];
	
	delete("y_learn_circle","cid = ".$id);
?>