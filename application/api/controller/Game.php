<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class Game extends Controller
{
    public function read()
    {   
        $data = [
            'code' => 404,
            'data' => [],
			'msg'  => "Invaild Request"
        ];
        return json($data);
    }
	
	public function index()
	{
        $data = [
            'code' => 404,
            'data' => [],
			'msg'  => "Invaild Request"
        ];
        return json($data);
	}
	
	public function save()
	{
        $data = [
            'code' => 404,
            'data' => [],
			'msg'  => "Invaild Request"
        ];
        return json($data);		
	}
	
	
	public function uploadSelf()
	{  header('Access-Control-Allow-Origin: *');
        $uid= input('uid');
        $token = input('token');
		$imgv = input('img');
		$model = model('Game');
		//$user =  $model->checkToken($uid);
		$user = 1;
	   if($user){
           $imgData=$imgv;
		   $img = base64_decode($imgData);
		   $time = time();
		   $imgname= $uid."_".$time.".png";
		   $dir='C:/sam/public/video/user'.$uid."/";
		   $path=$dir.$imgname;
		   if(!is_dir($dir)){mkdir($dir,0777);};
		   file_put_contents($path,$img);
		   $url="/public/video/user".$uid."/".$imgname;    
          $date=date("Y-m-d",time());			   
          $arr=["uid"=>$uid,"pic"=>$url,"date"=>$date,"time"=>time()];		   
          $data = $model->uploadSelf($arr,$uid);// 查询数据
         if($data){
            $code = 200;
        } else {
            $code = 404;
        }
		   $msg="success";
		}else{
			$code = 404;
			$data =[];
			$msg="Invaild token";
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' => $msg
        ];
        return json($data);				
	}
	
	public function checkCode($code)
	{
         $url="http://ynwebapi.vivo.xyz:8888/api/Account/GetYNAgentAndMarketLevel?snnumber=".$code;
		 $res = $this->sendRequest($url);
		 $rex= json_decode($res,true);
	     return $rex;
	}
	
	
    public function sendRequest($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }	
}
