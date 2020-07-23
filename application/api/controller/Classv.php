<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use app\api\controller\CheckToken as checkToken;
header('Access-Control-Allow-Origin:*');  

class Classv extends Controller
{


    public function add()
    {   
	    $className = input('className');
		$classDesc = input('classDesc');
		$clType = input('clType');
		if($clType){
        $Arrdata=[
		    "className"=>$className,
			"classDesc"=>$classDesc,
			"clType"=>$clType
		];
        $model = model('Classv');
        $data = $model->addClass($Arrdata);// 查询数据
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
	    $className = input('className');
		$classDesc = input('classDesc');
		$clType = input('clType');
		$id = input('id');
		if($id){
        $Arrdata=[
		    "className"=>$className,
			"classDesc"=>$classDesc,
			"clType"=>$clType
		];
        $model = model('Classv');
        $data = $model->editClass($Arrdata,$id);// 查询数据
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
        $model = model('Classv');
        $data = $model->delClass($id);// 查询数据
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
