<?php
set_time_limit(0);
require('./include/init.php');
$urls="http://sam.xinglufamily.com/public/samWx/getSdk.php";
$resultv = file_get_contents($urls);
$jsSql="SELECT * FROM s_jssdk WHERE jdkId = 1";
$jsSdk=selectRow($jsSql);	
$token  = $jsSdk['access_token'];
//获取access_token



    //发送模板消息
    function send_post($post_data,$token){
        $post_data = json_encode($post_data, true);
        //将数组编码为 JSON
        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=".$token;
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type:application/json',
                //header 需要设置为 JSON
                'content' => $post_data,
                'timeout' => 60
                //超时时间
            )
        );
        $context = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
		var_dump($result);
        return $result;
    }

    //例子
    //注意：自己提交的formid只能发给自己的openid，一个form_id只能用一次
     function send($openId,$formId,$token,$courseInfo)
    {
        //模板消息配置
		$courseName = $courseInfo['c_name'];
		$courseDate = date("Y-m-d",$courseInfo['course_data']);
		$courseTime = $courseInfo['course_time'];
		$courseAddress = $courseInfo['course_address'];
        $post_faqi = array(
            "touser" => $openId,//推送的人的openid
            "template_id" =>'lvWM_Khk4hjPRf_RahRZXdsOYT_lR07GAsqGdKg9j54',//模板id
            "page" => 'pages/index/index',//跳转路径
            "form_id" => $formId,//form_id
            //data 自己根据公众平台申请的消息模板进行填写
            "data" => array(
                'keyword1' => array("value" => $courseName, "color" => "#9b9b9b"),
                'keyword2' => array("value" => $courseDate, "color" => "#9b9b9b") ,
				'keyword3' => array("value" => $courseTime, "color" => "#9b9b9b") ,
				'keyword4' => array("value" => $courseAddress, "color" => "#9b9b9b") ,
				'keyword5' => array("value" => '你已约课，别忘记上课哦', "color" => "#9b9b9b") )
               //"emphasis_keyword" => "keyword1.DATA",//需加大显示的字体
        );
          $resv = send_post($post_faqi,$token);
    }   
	

if(isset($_GET['uid'])&&isset($_GET['cid'])&&isset($_GET['token']))
{
	 $uid = $_GET['uid'];
	 $tokens = $_GET['token'];
	 $cid = $_GET['cid'];
	 $userSql="SELECT * FROM s_user WHERE uid = {$uid} AND token ='".$tokens."'";
	 $user =selectRow($userSql);
	 if($user){
		  $infoSql="SELECT * FROM s_user_course WHERE uid = {$uid} AND cid = {$cid}";
		  $info =selectRow($infoSql);
		  if($info){
			   $courseInfoSql = "SELECT * FROM  s_course_info WHERE info_id =".$info['course_id'];
			   $courseInfo =selectRow($courseInfoSql);
			  if($courseInfo){
               $sqlInfo ="SELECT * FROM s_user_form WHERE is_use = 0 AND uid = {$uid} ORDER BY time DESC";
               $userForm=selectAll($sqlInfo);
	           if($userForm){
                    $openId = $userForm[0]['open_id'];
	                $formId = $userForm[0]['form_id'];
	                $fid = $userForm[0]['fid'];
	                $rdata=["is_use"=>1];
	                edit("s_user_form",$rdata,"fid =".$fid);
	                $res = send($openId,$formId,$token,$courseInfo);			  
		      }
			  }
	      }
	 }
}

?>

