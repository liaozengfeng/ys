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
        $pic_url = $banner_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $banner_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    } else {
        echo json_encode(array("error"=>"2"));
    }
	
	if(isset($_FILES['file2']))
	{
		//echo isset($_FILES);
		$name = $_FILES['file2']['name'];
		$name_tmp = $_FILES['file2']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//图片名称
        $pic_url2 = $banner_path . $pic_name;//上传后图片路径+名称
		$pic_web_url2 = $banner_web . $pic_name;//上传后保存图片路径+名称
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
	$bannerTitle = $_POST['bannerTitle'];
	$isWx = $_POST['isWx'];
	$bannerLink = $_POST['bannerLink'];
	$time = time();
	$arr=array(
		"bannerTitle"=>$bannerTitle,
		"isWx"=>$isWx,
		"bannerLink"=>$bannerLink,
		"updateTime"=>$time
	);
	
	if($pic_url!=null&&$pic_url!=""){
		$arr["bannerCover"]=$pic_web_url;
		//array_push($arr,"book_cover"=>$pic_web_url);
	}
	if($pic_url2!=null&&$pic_url2!=""){
		$arr["bannerContent"]=$pic_web_url2;
		//array_push($arr,"book_cover"=>$pic_web_url);
	}
	edit("y_banner",$arr,"bannerId=".$id);
	echo json_encode(array("error"=>"0"));
?>