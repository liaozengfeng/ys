<?php
namespace app\ys\controller;
use think\Controller;
use think\Request;
use app\ys\controller\CheckToken as checkToken;

class Lesson extends Controller
{
    public function getLessonsList()
    {   

        $model = model('Lesson');
        $data = $model->getLessonList();// 查询数据
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
