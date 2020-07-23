<?php
	include("../include/init.php");//引入链接数据库 
	include("ImgAddress.php");//引入链接数据库 
	
	if(isset($_FILES['video']))
	{
		//echo isset($_FILES);
		$name = $_FILES['video']['name'];
		$name_tmp = $_FILES['video']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//图片名称
        $pic_url = $video_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $video_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    } else {
        echo json_encode(array("error"=>"2"));
    }
	if(isset($_FILES['file']))
	{
		//echo isset($_FILES);
		$name = $_FILES['file']['name'];
		$name_tmp = $_FILES['file']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		
		$num= time() . rand(1000, 9999);
		$pic_name2 = $num . "." . $type;//图片名称
        $pic_url2 = $theme_path . $pic_name2;//上传后图片路径+名称
		$pic_web_url2 = $theme_web . $pic_name2;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url2)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    } else {
        echo json_encode(array("error"=>"2"));
    }
	
	$id = $_POST['id'];
	$theme_name = $_POST['theme_name'];
	$circle_id = $_POST['circle_id'];
	$lv = $_POST['lv'];
	$ysType = $_POST['ysType'];
	$tx = $_POST['tx'];
	$theme_content = $_POST['theme_content'];
	$jointime = time();
	$video_text = $_POST['video_text'];
	
	$arr=array(
		"themeName"=>$theme_name,
		"themeContent"=>$theme_content,
		"cid"=>$circle_id,
		"ysType"=>$ysType,
		"lv"=>$lv,
		"isTx"=>$tx,
		"themeVideo"=>$pic_web_url
	);
	if($pic_url2!=null&&$pic_url2!=""){
		$arr["themeCover2"]=$pic_web_url2;
	}
	if($pic_url==null||$pic_url==""){
		$arr["themeVideo"]=$video_text;
	}
	
	edit("y_learn_theme",$arr,"tid=".$id);
	echo json_encode(array("error"=>"0"));
?>