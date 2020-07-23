<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class Event extends Controller
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
	
	
	public function getEventList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Event');
        $data = $model->getEventList();// 查询数据
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
	
	public function getEventInfo()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Event');
        $data = $model->getEventInfo($id,$uid);// 查询数据
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
		$name = input('name');
		$tel = input('tel');
		$wx = input('wx');
		$lv = input('level');
		$introducter = input('introducter');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Event');
		$arr=[
		    "uid"=>$uid,
			"name"=>$name,
			"tel"=>$tel,
			"wx"=>$wx,
			"level"=>$lv,
			"introducter"=>$introducter,
			"event_id"=>$id,
			"join_time"=>time(),
		];
        $data = $model->enroll($arr,$uid,$id);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "Invaild Repeat Request";			
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
	
	

}
