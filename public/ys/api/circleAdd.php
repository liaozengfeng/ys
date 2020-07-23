<?php
	include("../include/init.php");//引入链接数据库 
	include("ImgAddress.php");//引入链接数据库 

	if(isset($_FILES['file']))
	{
		//echo isset($_FILES);
		$name = $_FILES['file']['name'];
		$name_tmp = $_FILES['file']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//图片名称
        $pic_url = $circle_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $circle_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    } else {
        echo json_encode(array("error"=>"2"));
    }
	
	$circle_name = $_POST['circle_name'];
	$parent = $_POST['parent'];
	$learn = $_POST['learn'];
	
	
	if($pic_url==null||$pic_url==""){
		echo json_encode(array("error"=>"1"));
	}
	else{
		$arr=array(
			"circleName"=>$circle_name,
			"circleCover"=>$pic_web_url,
			"circleLv"=>$parent,
			"learnId"=>$learn,
			"isShow"=>0
		);
		add("y_learn_circle",$arr);
		$id = mysql_insert_id();
		echo json_encode(array("error"=>"0","id"=>$id));
	}
	
	
?>