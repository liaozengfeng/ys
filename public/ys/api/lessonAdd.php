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
        $pic_url = $lesson_path . $pic_name;//�ϴ���ͼƬ·��+����
		$pic_web_url = $lesson_web . $pic_name;//�ϴ��󱣴�ͼƬ·��+����
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    } else {
        echo json_encode(array("error"=>"2"));
    }
	
	$lessonName = $_POST['lessonName'];
	$lessonPrice = $_POST['lessonPrice'];
	$discountPrice = $_POST['discountPrice'];
	
	
	if($pic_url==null||$pic_url==""){
		echo json_encode(array("error"=>"1"));
	}
	else{
		$arr=array(
			"lessonName"=>$lessonName,
			"lessonPrice"=>$lessonPrice,
			"discountPrice"=>$discountPrice,
			"lessonCover"=>$pic_web_url,
			"isShow"=>0
		);
		add("y_lesson",$arr);
		$id = mysql_insert_id();
		echo json_encode(array("error"=>"0","id"=>$id));
	}
	
	
?>