<?php
namespace app\ys\controller;
use think\Controller;
use app\ys\controller\CheckToken as checkToken;

class Task extends Controller
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
	
	
	public function getUserTaskList()
	{
	    $uid = input('uid');
	    $token = input('token');
		$type = input('type');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	$isCheck=1;
		if($isCheck){
        $model = model('Task');
        $data = $model->getUserTaskList($uid,$type);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "暂无完成作业";			
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

	public function getUserCorrect()
	{
	    $uid = input('uid');
	    $token = input('token');
		$hid = input('hid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	$isCheck=1;
		if($isCheck){
        $model = model('Task');
        $data = $model->getUserCorrect($uid,$hid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "暂无批改记录";			
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

	public function getHomeWorkList()
	{
	    $uid = input('uid');
	    $token = input('token');
		$type = input('type');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	$isCheck=1;
		if($isCheck){
        $model = model('Task');
        $data = $model->getHomeWorkList($uid,$type);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "暂无作业";			
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
	
	public function getHomeWorkInfo()
	{
	    $uid = input('uid');
	    $token = input('token');
		$hid = input('hid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	$isCheck=1;
		if($isCheck){
        $model = model('Task');
        $data = $model->getHomeWorkInfo($hid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "暂无作业";			
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
	  public function uploadHomeWork()
	{
	    $uid = input('uid');
	    $token = input('token');
		$hid = input('hid');
		$content = input('content');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Task');
		$arrJson=["uid"=>$uid,"hid"=>$hid,"content"=>$content];
        $data = $model->uploadHomeWork($uid,$arrJson);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
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
	
	  public function uploadSpeak()
	{
	    $uid = input('uid');
	    $token = input('token');
		$hid = input('hid');
		$audio = input('json');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Task');
		$arrJson=["uid"=>$uid,"hid"=>$hid,"audio"=>$audio];
        $data = $model->uploadHomeWork($uid,$arrJson);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
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
	
	public function readSpeak()
	{
	    $uid = input('uid');
	    $token = input('token');
		$hid = input('hid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Task');
        $data = $model->readSpeak($uid,$hid);// 查询数据
        if($data){
        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];}else{
        $data = [
            'code' => 200,
            'data' => [],
			'msg' =>  "success"
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
