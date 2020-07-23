<?php
namespace app\ys\controller;
use think\Controller;
use think\Request;
use app\ys\controller\CheckToken as checkToken;

class News extends Controller
{
    public function getNewsList()
    {   
	    $type = input('type');
		if($type){
        $model = model('News');
        $data = $model->getNewsList($type);// 查询数据
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
            'code' => 404,
            'data' => [],
			'msg'  =>"Invalid type"
        ];	    
		
		}
        return json($data);			
    }
	
    public function searchList()
    {   
	    $type = input('key');
		if($type){
        $model = model('News');
        $data = $model->searchList($type);// 查询数据
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
            'code' => 404,
            'data' => [],
			'msg'  =>"Invalid type"
        ];	    
		
		}
        return json($data);			
    }
	
    public function getNewsInfo()
    {   
	    $id = input('id');
		if($id){
        $model = model('News');
        $data = $model->getNewsInfo($id);// 查询数据
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
            'code' => 404,
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
