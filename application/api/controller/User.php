<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class User extends Controller
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
	
	public function getUserInfo()
	{   
        $uid = input('uid');
		$token = input('token');
        $model = model('User');
        $data = $model->getInfo($uid);// 查询数据
        if ($data) {
            $code = 200;
			$msg = "success";
		
        } else {
            $code = 404;
			$msg = "Invaild Token";
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
        return json($data);
	}
	
	public function getCourseType()
	{
        $uid = input('uid');
		$token = input('token');
        $model = model('User');
        $data = $model->getCourseType($uid);// 查询数据
        if ($data) {
            $code = 200;
			$msg = "success";
		
        } else {
            $code = 404;
			$msg = "Invaild Token";
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
        return json($data);		
	}
	
	public function getCourseRecord()
	{
		
	    $uid = input('uid');
	    $token = input('token');
		$typeId = input('typeId');
		$typeCn = input('typeCn');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('User');
        $data = $model->getCourseRecord($uid,$typeId,$typeCn);// 查询数据
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
	
	public function getRule()
	{   $model = model('User');
	   $rdata = $model->getRule(1);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
        return json($data);		
	}
	
	public function getCourseRule()
	{   $model = model('User');
	   $rdata = $model->getRule(2);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
        return json($data);				
	}

	public function getIeltsRule()
	{  $model = model('User');
	   $rdata = $model->getRule(3);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
        return json($data);				
	}	
	
	public function getShopRule()
	{
       $model = model('User');
	   $rdata = $model->getRule(4);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
        return json($data);				
		
	}
	
	public function form()
	{
       $uid = input('uid');
        $token = input('token');
		$formId = input('formId');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('User');
        $rdata = $model->form($uid,$formId);// 查询数据
        $data = [
            'code' => 200,
            'data' => [],
			'msg'  => "success"
        ];
		}else{
        $data = [
            'code' => 401,
            'data' => [],
			'msg'=> "Invalid Token"
        ];		
		}
        return json($data);			
	}

}
