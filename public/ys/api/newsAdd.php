<?php
	include("../include/init.php");//�����������ݿ� 
	include("ImgAddress.php");//�����������ݿ� 

	if(isset($_FILES['file']))
	{
		//echo isset($_FILES);
		$name = $_FILES['file']['name'];
		$name_tmp = $_FILES['file']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //��ȡ�ļ�����
		
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//ͼƬ����
        $pic_url = $news_path . $pic_name;//�ϴ���ͼƬ·��+����
		$pic_web_url = $news_web . $pic_name;//�ϴ��󱣴�ͼƬ·��+����
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    } else {
        echo json_encode(array("error"=>"2"));
    }
	
	$newsTitle = $_POST['newsTitle'];
	$newsType = $_POST['newsType'];
	$author = $_POST['author'];
	$newsContent = $_POST['newsContent'];
	$newsLink = $_POST['newsLink'];
	$isWx = $_POST['isWx'];
	$time = time();
	
	if($pic_url==null||$pic_url==""){
		echo json_encode(array("error"=>"1"));
	}
	else{
		$arr=array(
			"newsTitle"=>$newsTitle,
			"newsType"=>$newsType,
			"newsContent"=>$newsContent,
			"author"=>$author,
			"isWx"=>$isWx,
			"newsLink"=>$newsLink,
			"updateTime"=>$time,
			"newsCover"=>$pic_web_url,
		);
		add("y_news",$arr);
		$id = mysql_insert_id();
		echo json_encode(array("error"=>"0","id"=>$id));
	}
	
	
?>