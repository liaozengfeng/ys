<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class Course extends Controller
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
	
	
	public function getCourseList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$time = input('time');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Course');
        $data = $model->getCourseList($uid,$time);// 查询数据
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
		
	}
	
	public function getCourseInfo()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Course');
        $data = $model->getCourseInfo($id,$uid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "Invaild Id";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
		
	}
	
	public function enroll()
	{
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Course');
		 $checkTime = $model->enrollCheck($id);
		 if($checkTime){
        $data = $model->enroll($id,$uid);// 查询数据
		if($data==1){
           $code = 404;
		   $msg = "不能重复预约相同课程";
		}else if($data==9){
           $code = 404;
		   $msg = "该课程已经预约满员了";
		}else if($data==[]){
           $code = 404;
		   $msg = "课程卡不足!";			
		}else{
           $code = 200;
		   $msg = "success";
           $cid = $data['cid'];
           $url="http://sam.xinglufamily.com/public/samWx/msg/joinCourse.php?uid=".$uid."&token=".$token."&cid=".$cid;
		   $res = $this->sendRequest($url);		   
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
		 }else{
         $data = [
            'code' => 403,
            'data' => [],
			'msg' =>  "超过截止时间,操作错误!"
         ];				 
		 }
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
		
        return json($data);				
	}
	
	public function cancel()
	{
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Course');
          $checkTime = $model->enrollCheck($id);
		 if($checkTime){
        $data = $model->cancel($id,$uid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		   $cid = $id;
           $url="http://sam.xinglufamily.com/public/samWx/msg/cancleCourse.php?uid=".$uid."&token=".$token."&cid=".$cid;
		   $res = $this->sendRequest($url);	
		}else{
           $code = 404;
		   $msg = "Invaild Card";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
		 ];}else{
           $data = [
             'code' => 403,
             'data' => [],
			 'msg' =>  "超过截止时间,操作错误!"
           ];		
		 }
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
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
