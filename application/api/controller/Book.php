<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class Book extends Controller
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
	
	
	public function getBookList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Book');
        $data = $model->getBookList($uid);// 查询数据
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
        $model = model('Book');
        $data = $model->getBookList($uid);// 查询数据
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];		
		}
        return json($data);			
		
	}
	
	public function getBookSection()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Book');
        $data = $model->getBookSection($id);// 查询数据
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
        $model = model('Book');
        $data = $model->getBookSection($id);// 查询数据
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
		}
        return json($data);			
		
	}
	
	public function getSectionList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Book');
        $data = $model->getSectionList($id,$uid);// 查询数据
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
        $model = model('Book');
        $data = $model->getSectionList($id,$uid);// 查询数据
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
		}
        return json($data);			
		
	}
	
	public function getSectionInfo()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Book');
        $data = $model->getSectionInfo($id);// 查询数据
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
        $model = model('Book');
        $data = $model->getSectionInfo($id);// 查询数据
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
		}
        return json($data);			
		
	}
	
	public function updateRead()
	{ 
		
           $code = 200;
		   $msg = "success";
		
        $data = [
            'code' => $code,
            'data' => [],
			'msg' =>  $msg
        ];		
        return json($data);			
	
	}
	
}
