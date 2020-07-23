<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use app\api\controller\CheckToken as checkToken;
header('Access-Control-Allow-Origin:*');  

class Ieltsv extends Controller
{


    public function upload()
    {   
	    $id = input('id');
		$sTime = input('sTime');
		$eTime = input('eTime');
		$time = input('time');
		$date = input('date');
		$classRoom = input('classRoom');
		$teacherId = input('teacherId');
		$classHour = input('classHour');
		$classId = input('classId');
		$model = model('Ieltsv');
        $courseInfo = $model->check($id);// 查询数据
		if($courseInfo){
		  $c_id = $id;
		  $c_type =$courseInfo['course_type'];
		  $c_name =$courseInfo['ielts_name'];
		  $addressInfo = $model->checkRoom($classRoom);// 查询数据 
		  $address = input('courseAddress');;
		  $rName = $addressInfo['roomName'];
        $Arrdata=[
		    "c_id"=>$c_id,
			"c_type"=>$c_type,
			"c_name"=>$c_name,
			"date"=>$date,
			"time"=>$time,
			"stop_time"=>'',
			"ielts_limit"=>'',
			"classId"=>$classId,
			"teacherId"=>$teacherId,
			"classRoom"=>$classRoom,
			"ielts_address"=>$address,
			"rName"=>$rName,
			"classHour"=>$classHour,
			"sTime"=>$sTime,
			"eTime"=>$eTime
		];
        $data = $model->upload($Arrdata);// 查询数据
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
	
    public function uploadAll()
    {   
	    $id = input('id');
		$ids =explode(",",$id);
		$sTime = input('sTime');
		$eTime = input('eTime');
		$time = input('time');
		$date = input('date');
		$classRoom = input('classRoom');
		$teacherId = input('teacherId');
		$classHour = input('classHour');
		$classId = input('classId');
		 $address = input('courseAddress');
		$model = model('Ieltsv');
		if($ids){
        for($i=0;$i<count($ids);$i++){
		  $c_id = $ids[$i];
		  $courseInfo = $model->check($ids[$i]);
		  $c_type =$courseInfo['course_type'];
		  $c_name =$courseInfo['ielts_name'];
		  $addressInfo = $model->checkRoom($classRoom);// 查询数据 
		  $rName = $addressInfo['roomName'];
		  $sTimeN = $sTime+ 604800*$i;
		  $eTimeN = $eTime+ 604800*$i;
		  $sv = date("Y-m-d",$sTimeN)." 00:00:00";
		  $dateN=strtotime($sv);
        $Arrdata=[
		    "c_id"=>$c_id,
			"c_type"=>$c_type,
			"c_name"=>$c_name,
			"date"=>$dateN,
			"time"=>$time,
			"stop_time"=>'',
			"ielts_limit"=>'',
			"classId"=>$classId,
			"teacherId"=>$teacherId,
			"classRoom"=>$classRoom,
			"ielts_address"=>$address,
			"rName"=>$rName,
			"classHour"=>$classHour,
			"sTime"=>$sTimeN,
			"eTime"=>$eTimeN
		];
        $data = $model->upload($Arrdata);// 查询数据
		}
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
	 
    public function edit()
    {   
	    $id = input('id');
		$sTime = input('sTime');
		$eTime = input('eTime');
		$time = input('time');
		$date = input('date');
		$classRoom = input('classRoom');
		$teacherId = input('teacherId');
		$classHour = input('classHour');
		$classId = input('classId');
		$model = model('Ieltsv');
        $courseInfo = $model->checkv($id);// 查询数据
		if($courseInfo){
		  $addressInfo = $model->checkRoom($classRoom);// 查询数据 
		  $address = input('courseAddress');
		  $rName = $addressInfo['roomName'];
        $Arrdata=[
			"date"=>$date,
			"time"=>$time,
			"stop_time"=>'',
			"ielts_limit"=>'',
			"classId"=>$classId,
			"teacherId"=>$teacherId,
			"classRoom"=>$classRoom,
			"ielts_address"=>$address,
			"rName"=>$rName,
			"classHour"=>$classHour,
			"sTime"=>$sTime,
			"eTime"=>$eTime
		];
        $data = $model->edit($Arrdata,$id);// 查询数据
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
	
     public function del()
    {   
	    $id = input('id');
		if($id){
        $model = model('Ieltsv');
        $data = $model->delCourse($id);// 查询数据
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
	

    public function change()
    {   
	    $id = input('id');
		$attence = input('attence');
		if($id){
        $model = model('Ieltsv');
        $data = $model->change($id,$attence);// 查询数据
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
