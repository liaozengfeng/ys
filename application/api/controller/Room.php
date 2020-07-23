<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use app\api\controller\CheckToken as checkToken;
header('Access-Control-Allow-Origin:*');  

class Room extends Controller
{


    public function add()
    {   
	    $roomName = input('roomName');
		$ielts = input('ielts');
		$intro = input('intro');
		$l4 = input('l4');
		$pNum = input('pNum');
		if($pNum){
        $Arrdata=[
		    "roomName"=>$roomName,
			"ielts"=>$ielts,
			"intro"=>$intro,
			"l4"=>$l4,
			"pNum"=>$pNum
		];
        $model = model('Room');
        $data = $model->addRoom($Arrdata);// 查询数据
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
	    $roomName = input('roomName');
		$ielts = input('ielts');
		$intro = input('intro');
		$l4 = input('l4');
		$pNum = input('pNum');
		$id = input('id');
		if($id){
        $Arrdata=[
		    "roomName"=>$roomName,
			"ielts"=>$ielts,
			"intro"=>$intro,
			"l4"=>$l4,
			"pNum"=>$pNum
		];
        $model = model('Room');
        $data = $model->editRoom($Arrdata,$id);// 查询数据
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
        $model = model('Room');
        $data = $model->delRoom($id);// 查询数据
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
