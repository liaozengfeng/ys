<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use app\api\controller\CheckToken as checkToken;
header('Access-Control-Allow-Origin:*');  

class TimeTable extends Controller
{


   
    public function getList()
    {   
	    $uid = input('uid');
	    $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	 $isCheck=1;
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->getCourseList($uid);// 查询数据
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
	
    public function getDayList()
    {   
	    $uid = input('uid');
	    $token = input('token');
		$time = input('time');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	 $isCheck=1;
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->getDayCourseList($uid,$time);// 查询数据
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
	
    public function getTcList()
    {   
	    $uid = input('uid');
	    $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	 $isCheck=1;
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->getTCourseList($uid);// 查询数据
        $code = 200;
		$msg = "success";
		$month =$model->getNowMonth();
		$min = $model->getWorkTime($uid);
		$v=["month"=>$month,"min"=>$min];
        $data = [
            'code' => $code,
            'data' => $data,
			'date'=>  $v,
			'msg' =>  $msg
        ];
		}else{
		$month =$model->getNowMonth();
		$min = $model->getWorkTime($uid);
		$v=["month"=>$month,"min"=>$min];
        $data = [
            'code' => 404,
            'data' => [],
			'date'=>  $v,
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
    }

    public function getDayTcList()
    {   
	    $uid = input('uid');
	    $token = input('token');
		$time = input('time');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	 $isCheck=1;
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->getTDCourseList($uid,$time);// 查询数据
        $code = 200;
		$msg = "success";
		$month =$model->getDateMonth($time);
		$min = $model->getWorkTime2($time,$uid);
		$v=["month"=>$month,"min"=>$min];
        $data = [
            'code' => $code,
            'data' => $data,
			'date'=>  $v,
			'msg' =>  $msg
        ];
		}else{
		$v=["month"=>'Eorror',"min"=>0];
        $data = [
            'code' => 404,
            'data' => [],
			'date'=>  $v,
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
    }
	
	public function getCourseList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$time = input('time');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->getCourseListv($uid,$time);// 查询数据
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
	

	public function getAttenceList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');  //infoId
		$type = input('type');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	$isCheck=1;
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->getAttenceList($id,$type);// 查询数据
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
	
	public function saveAttenceList()
	{   
	
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');  //infoId
		$type = input('type');
		$sign = input('sign');
		$absent = input('absent');
		$mark = input('mark');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	 $isCheck=1;
		if($isCheck){
        $model = model('TimeTable');
        $data = $model->saveAttenceList($id,$type,$sign,$absent);// 查询数据
		$datav = $model->updateMark($id,$type,$mark);
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
