<?php 
session_start(); 
require('./include/init.php');
require_once "./jssdk.php";
$jssdk = new JSSDK("wx05a27289598519f5","00f8956303dbc5a2d3fc4b2dd8b6fab1");
$signPackage = $jssdk->GetSignPackage();
$access_token= $jssdk->getAccessToken();
$JsApiTicket = $jssdk->getJsApiTicket();
$apiTicket = $jssdk->getapiTicket();
$data=array("access_token"=>$access_token,"jsapi_ticket"=>$JsApiTicket,"api_ticket"=>$apiTicket,"expire_time"=>time());
edit("s_jssdk",$data,"jdkId = 1");

$jsSql="SELECT * FROM s_jssdk WHERE jdkId = 1";
$jsSdk=selectRow($jsSql);	


 ?>