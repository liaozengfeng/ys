<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use app\api\controller\CheckToken as checkToken;
header('Access-Control-Allow-Origin:*');  

class Times extends Controller
{


    public function add()
    {   
	    $uid = input('uid');
		$startTime = input('startTime');
		$endTime = input('endTime');
		if($uid){
        $Arrdata=[
		    "uid"=>$uid,
			"startTime"=>$startTime,
			"endTime"=>$endTime,
			"editTime"=>time()
		];
        $model = model('Times');
        $data = $model->addTime($Arrdata);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
    public function edit()
    {   
	    $uid = input('uid');
		$startTime = input('startTime');
		$endTime = input('endTime');
		$id = input('id');
		if($id){
        $Arrdata=[
		    "uid"=>$uid,
			"startTime"=>$startTime,
			"endTime"=>$endTime,
			"editTime"=>time()
		];
        $model = model('Times');
        $data = $model->editTime($Arrdata,$id);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
    public function del()
    {   
	    $id = input('id');
		if($id){
        $model = model('Times');
        $data = $model->delTime($id);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid id"
        ];			
		}

        return json($data);			
    }
	

    public function roomAdd()
    {   
	    $roomId = input('roomId');
		$startTime = input('startTime');
		$endTime = input('endTime');
		if($roomId){
        $Arrdata=[
		    "roomId"=>$roomId,
			"startTime"=>$startTime,
			"endTime"=>$endTime,
			"editTime"=>time()
		];
        $model = model('Times');
        $data = $model->addRoomTime($Arrdata);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }	

    public function roomEdit()
    {   

		$startTime = input('startTime');
		$endTime = input('endTime');
		$id = input('id');
		if($id){
        $Arrdata=[
			"startTime"=>$startTime,
			"endTime"=>$endTime,
			"editTime"=>time()
		];
        $model = model('Times');
        $data = $model->editRoomTime($Arrdata,$id);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
	
    public function roomDel()
    {   
	    $id = input('id');
		if($id){
        $model = model('Times');
        $data = $model->delRoomTime($id);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid id"
        ];			
		}

        return json($data);			
    }
	
    public function orderEdit()
    {   

		$round = input('round');
		$id = input('id');
		if($id){
        $Arrdata=[
			"round"=>$round
		];
        $model = model('Times');
        $data = $model->editOrderEdit($Arrdata,$id);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }

    public function orderAdd()
    {   

		
		$uid = input('uid');
		$order = input('order');
        if($order&&$uid){
        $model = model('Times');
        $data = $model->orderAdd($uid,$order);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
    public function check()
    {   

		
		$uid = input('uid');
		$rid = input('rid');
		$sTime = input('sTime');
	    $eTime = input('eTime');
        if($rid&&$uid&&$sTime&&$eTime){
        $model = model('Times');
        $data = $model->checkTr($uid,$rid,$sTime,$eTime);// 查询数据
        if ($data==1) {
            $code = 200;
			$msg  = "success";
        } else if($data==2){  //教室时间冲突
            $code = 404;      
			$msg  = "当前时间,教室已有其他用途";
        }else if($data==3){
            $code = 404;
			$msg  = "当前时间,教师在调休";
        }else if($data==4){
            $code = 404;
			$msg  = "当前时间,教师在任课";
        }else{
			 $code = 404;
			 $msg = "未知错误";
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  => $msg
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
    public function setHide()
    {   
	    $sTime = input('sv');
		$eTime = input('ev');
		if($sTime&&$eTime){
        $model = model('Times');
        $data = $model->setHide($sTime,$eTime);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
    public function setShow()
    {   
	    $sTime = input('sv');
		$eTime = input('ev');
		if($sTime&&$eTime){
        $model = model('Times');
        $data = $model->setShow($sTime,$eTime);// 查询数据
        if ($data) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $data,
			'msg'  =>"success"
        ];
		}else{
        $data = [
            'code' => 402,
            'data' => [],
			'msg'  =>"Invalid Parameter"
        ];			
		}

        return json($data);			
    }
	
	public function index()
	{
        
        $data = [
            'code' => 404,
            'data' => [],
			'msg'=>"Invalid Request"
        ];		
        return json($data);		
	}
	
	public function read()
	{
        
        $data = [
            'code' => 404,
            'data' => [],
			'msg'=>"Invalid Request"
        ];		
        return json($data);		
	}
	
}
