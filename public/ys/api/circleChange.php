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
        $pic_url = $circle_path . $pic_name;//�ϴ���ͼƬ·��+����
		$pic_web_url = $circle_web . $pic_name;//�ϴ��󱣴�ͼƬ·��+����
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    }
	
	$id = $_POST['id'];
	$circle_name = $_POST['circle_name'];
	$parent = $_POST['parent'];
	$learn = $_POST['learn'];

	$arr=array(
		"circleName"=>$circle_name,
		"circleLv"=>$parent,
		"learnId"=>$learn,
		"isShow"=>0
	);
	echo $pic_url;
	if($pic_url!=null&&$pic_url!=""){
		$arr["circleCover"]=$pic_web_url;
	}
	
	edit("y_learn_circle",$arr," cid = ".$id);
	echo json_encode(array("error"=>"0"));
	
	
?>