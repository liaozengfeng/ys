<?php
namespace app\ys\controller;
use think\Controller;
use think\Request;
use app\ys\controller\CheckToken as checkToken;

class Banner extends Controller
{
    public function getBannerList()
    {  
        $model = model('Banner');
        $data = $model->getBannerList();// 查询数据
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

		
        return json($data);			
    }
	
    public function getBannerInfo()
    {   
	    $id = input('id');
		if($id){
        $model = model('Banner');
        $data = $model->getBannerInfo($id);// 查询数据
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
