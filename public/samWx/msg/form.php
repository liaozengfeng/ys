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
     function send($openId,$formId,$token)
    {
        //模板消息配置
        $post_faqi = array(
            "touser" => $openId,//推送的人的openid
            "template_id" =>'8UOd8WCjAWBZ59WiL_4p5QKIVt_yHkxpJdvjWanVLmM',//模板id
            "page" => 'pages/index/index',//跳转路径
            "form_id" => $formId,//form_id
            //data 自己根据公众平台申请的消息模板进行填写
            "data" => array(
                'keyword1' => array("value" => '今天你阅读了吗？', "color" => "#9b9b9b"),
                'keyword2' => array("value" => '在线阅读书本', "color" => "#9b9b9b") )
               //"emphasis_keyword" => "keyword1.DATA",//需加大显示的字体
        );
          $resv = send_post($post_faqi,$token);
    }   
	
$time = time();
$w = date('w',$time);
if($w != 0 and $w != 6)
{
   $date=date("Y-m-d",time());
   $nightTime =strtotime($date." 16:00:00");
   if($time>$nightTime){
   $csql ="SELECT * FROM s_push WHERE date = '".$date."' AND type = 1";
   $cs=selectRow($csql);
   if(!$cs){
	$datax =["date"=>$date,"type"=>1];
	add("s_push",$datax);
     
	$sql ="SELECT DISTINCT(uid) FROM s_user WHERE isstudent = 1 AND uid = 25";
    $Alls=selectAll($sql);
    $count =count($Alls);
   for($i=0;$i<$count;$i++)
   { 
     $sqlInfo ="SELECT * FROM s_user_form WHERE is_use = 0 AND uid =".$Alls[$i]["uid"]. "  ORDER BY time DESC";
	// echo  $sqlInfo;
     $userForm=selectAll($sqlInfo);
	 if($userForm){
     $openId = $userForm[0]['open_id'];
	 $formId = $userForm[0]['form_id'];
	 $fid = $userForm[0]['fid'];
	 $rdata=["is_use"=>1];
	 edit("s_user_form",$rdata,"fid =".$fid);
	 // echo "uid = ".$Alls[$i]["uid"] ;
	 $res = send($openId,$formId,$token);
     $fp = @fopen("update.txt", "a+"); 
     fwrite($fp, $res."\n"); 
     fwrite($fp, date("Y-m-d H:i:s") . " Updateing！\n"); 
     fclose($fp); 
	 }	
    }
   }
  }else{
	 echo '时间不到';  
  }
}
else
{
    echo '双休日';
}

     $fp = @fopen("update.txt", "a+"); 
     fwrite($fp, date("Y-m-d H:i:s") . " Ending！\n"); 
     fclose($fp); 
?>

