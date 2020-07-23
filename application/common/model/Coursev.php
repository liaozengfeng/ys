<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Coursev extends Model
{
   
	public function upload($data)
	{	
	    return  Db::name('s_course_info')->insertGetId($data);
	 				
	}

	public function check($id)
	{
		
		return Db::name('s_course')->where('course_id',$id)->find();
	}

	public function checkv($id)
	{
		
		return Db::name('s_course_info')->where('info_id',$id)->find();
	}

	public function checkRoom($id)
	{
		
		return Db::name('s_room')->where('rid',$id)->find();
	}
	
	public function edit($data,$id)
	{
		 $res=Db::name('s_course_info')->where('info_id',$id)->find();
		 if($res){
		     return Db::name('s_course_info')->where('info_id',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
		
	}
	
	public function delCourse($id)
	{
		$res=Db::name('s_course_info')->where('info_id',$id)->find();
		if($res){
			$de=Db::name('s_course_info')->where('info_id',$id)->delete();
			return 1;
		}else{
			return 0;
		}
		
	}
	
	public function change($id,$attence)
	{    
	     $data=["attence"=>$attence];
		 $res=Db::name('s_course_info')->where('info_id',$id)->find();
		 if($res){
		     return Db::name('s_course_info')->where('info_id',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
	}
	
	public function autov($sTime,$eTime,$roomArr,$teacherArr)
	{
		$dels =  Db::name('s_check_list')->where('sTime',"<=",$sTime)->where('eTime',">=",$sTime)->delete();
		$course = Db::name('s_course_info')->where('sTime',"<=",$sTime)->where('eTime',">=",$sTime)->select();
		if($course){
		 for($i=0;$i<count($course);$i++)
		 {
			 $data =["infoId"=>$course[$i]['info_id'],"cId"=>$course[$i]['c_id'],"sType"=>"course","classRoom"=>$course[$i]['classRoom'],"teacherId"=>$course[$i]['teacherId'],"sTime"=>$course[$i]['sTime'],"eTime"=>$course[$i]['eTime']];			  
			 $rCourse= Db::name('s_check_list')->insertGetId($data);
		 }			
		}
		$ielts = Db::name('s_ielts_info')->where('sTime',"<=",$sTime)->where('eTime',">=",$sTime)->select();
		if($ielts){
		 for($i=0;$i<count($ielts);$i++)
		 {
			 $data =["infoId"=>$ielts[$i]['info_id'],"cId"=>$ielts[$i]['c_id'],"sType"=>"ielts","classRoom"=>$ielts[$i]['classRoom'],"teacherId"=>$ielts[$i]['teacherId'],"sTime"=>$ielts[$i]['sTime'],"eTime"=>$ielts[$i]['eTime']];			  
			 $rIelts= Db::name('s_check_list')->insertGetId($data);
		 }			
		}
		$list = Db::name('s_check_list')->where('sTime',"<=",$sTime)->where('eTime',">=",$sTime)->select();
		
		if($list)
		{
			$roomIds =explode(',', $roomArr);
			$teacherIds =explode(',', $teacherArr);
			
			 for($i=0;$i<count($list);$i++)
			 {
				
				 $roomIds = array_merge(array_diff($roomIds, array($list[$i]['classRoom'])));
				 $teacherIds = array_merge(array_diff($teacherIds, array($list[$i]['teacherId'])));
			 }
			$data=["roomId"=>$roomIds[0],"teacherId"=>$teacherIds[0]];
			return $data;		
		}else{
			$roomIds =explode(',', $roomArr);
			$teacherIds =explode(',', $teacherArr);
			$data=["roomId"=>$roomIds[0],"teacherId"=>$teacherIds[0]];
			return $data;
		}
		
	}


}
?>