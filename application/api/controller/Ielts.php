<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class Ielts extends Controller
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
        $model = model('Ielts');
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
        $model = model('Ielts');
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
        $model = model('Ielts');
          $checkTime = $model->enrollCheck($id);
		 if($checkTime){
        $data = $model->enroll($id,$uid);// 查询数据
		if($data==1){
           $code = 404;
		   $msg = "不能重复预约相同课程";
		}else if($data==[]){
           $code = 404;
		   $msg = "课程卡不足!";			
		}else{
           $code = 200;
		   $msg = "success";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
		 ];}
		 else{
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
        $model = model('Ielts');
          $checkTime = $model->enrollCheck($id);
		 if($checkTime){
        $data = $model->cancel($id,$uid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "Invaild Card";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
		 ];}
		 else{
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
	

}
