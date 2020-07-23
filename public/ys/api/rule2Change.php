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
        $pic_url = $rule_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $rule_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$data=array( "url"=>"http://127.0.0.1/photocompetition/static/uploads/".$pic_name,"num"=>1);
            //echo  '{ "resultCode":0,"data":'.json_encode($data).', "msg":"success" }';
		}else{
			echo json_encode(array("error"=>"{$name_tmp}"));
		}

    }
	
	
	
	$id = $_POST['id'];
	$arr=array();
	if($pic_url!=null&&$pic_url!=""){
		$arr["ruleContent"]=$pic_web_url;
		edit("y_rule",$arr,"ruleId=".$id);
	}
	
	
	echo json_encode(array("error"=>"0"));
?>