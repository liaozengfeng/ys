<?php
	include("../include/init.php");//�����������ݿ� 
	
	$id = $_POST['id'];
	
	delete("y_banner","bannerId = ".$id);
?>