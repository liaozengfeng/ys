<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Times extends Model
{
   
	public function addTime($data)
	{
		
		 $res=Db::name('s_teacher_time')->where('uid',$data['uid'])->where('startTime','>=',$data['startTime'])->where('endTime','<=',$data['endTime'])->find();
		 if($res){
		     return 0;
		 }else{
			return  Db::name('s_teacher_time')->insertGetId($data);
		 }		 		
		
	}

   public function addRoomTime($data)
   {
		 $res=Db::name('s_room_time')->where('roomId',$data['roomId'])->where('startTime','>=',$data['startTime'])->where('endTime','<=',$data['endTime'])->find();
		 if($res){
		     return 0;
		 }else{
			return  Db::name('s_room_time')->insertGetId($data);
		 }		   
   }
	
	public function editTime($data,$id)
	{
		
		 $res=Db::name('s_teacher_time')->where('tid',$id)->find();
		 if($res){
		     return Db::name('s_teacher_time')->where('tid',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
		
	}

	
	public function editRoomTime($data,$id)
	{
		
		 $res=Db::name('s_room_time')->where('rsid',$id)->find();
		 if($res){
		     return Db::name('s_room_time')->where('rsid',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
		
	}
	
	public function editOrderEdit($data,$id)
	{
		 $res=Db::name('s_teacher_order')->where('oid',$id)->find();
		 if($res){
		     return Db::name('s_teacher_order')->where('oid',$id)->update($data);
		 }else{
			 return $res;
		 }				
	}
	
	public function delTime($id)
	{
		$res=Db::name('s_teacher_time')->where('tid',$id)->find();
		if($res){
			$de=Db::name('s_teacher_time')->where('tid',$id)->delete();
			return 1;
		}else{
			return 0;
		}
		
	}
	
	public function delRoomTime($id)
	{
		$res=Db::name('s_room_time')->where('rsid',$id)->find();
		if($res){
			$de=Db::name('s_room_time')->where('rsid',$id)->delete();
			return 1;
		}else{
			return 0;
		}
		
	}

	public function orderAdd($id,$order)
	{
		//删除所有优先度
		$res=Db::name('s_teacher_order')->where('teacherId',$id)->delete();
		//teacherId typeId typeCn round
		//新建优先度
		 $orderArr =explode(',', $order);
		 $resv=Db::name('s_type')->where('is_show',1)->order("type_cn,type_id")->select();
		 $sv = count($resv);
		 $uv = count($orderArr);
		 if($sv==$uv){
		 for($i=0;$i<count($resv);$i++)
		 {
			 
			 $data=["teacherId"=>$id,"typeId"=>$resv[$i]['type_id'],"typeCn"=>$resv[$i]['type_cn'],"round"=>$orderArr[$i]];
			 $rv = Db::name('s_teacher_order')->insertGetId($data);
		 }
		    return 1;
		 }else{
			 return 0;
		 }
		
	}
	
	public function checkTr($uid,$rid,$sTime,$eTime)
	{
		//checkRoom
		$res =Db::name('s_room_time')->where("roomId",$rid)->where('startTime',"<",$eTime)->where('endTime',">",$eTime)->find();
		if($res){return 2;}
		$res =Db::name('s_course_info')->where("classRoom",$rid)->where('sTime',"<",$eTime)->where('eTime',">",$eTime)->find();
		if($res){return 2;}
		$res =Db::name('s_ielts_info')->where("classRoom",$rid)->where('sTime',"<",$eTime)->where('eTime',">",$eTime)->find();
		if($res){return 2;}
		$resv =Db::name('s_teacher_time')->where("uid",$uid)->where('startTime',"<",$eTime)->where('endTime',">",$eTime)->find();
		if($resv){return 3;}
		$res =Db::name('s_course_info')->where("teacherId",$uid)->where('sTime',"<",$eTime)->where('eTime',">",$eTime)->find();
		if($res){return 4;}
		$res =Db::name('s_ielts_info')->where("teacherId",$uid)->where('sTime',"<",$eTime)->where('eTime',">",$eTime)->find();
		if($res){return 4;}
		return 1;
	}
	
	public function setShow($sTime,$eTime)
	{
		$res =Db::name('s_course_info')->where('sTime',">",$sTime)->where('eTime',"<",$eTime)->select();
		if($res)
		{
		 for($i=0;$i<count($res);$i++)
		 {
			 $data =["eShow"=>1];
			 $resv =Db::name('s_course_info')->where("info_id",$res[$i]['info_id'])->update($data);
		 }			
		}
		$res2 =Db::name('s_ielts_info')->where('sTime',">",$sTime)->where('eTime',"<",$eTime)->select();
		if($res2)
		{
		 for($i=0;$i<count($res2);$i++)
		 {
			 $data =["eShow"=>1];
			 $resv =Db::name('s_ielts_info')->where("info_id",$res2[$i]['info_id'])->update($data);
		 }			
		}	
        return 1;		
	}
	
	public function setHide($sTime,$eTime)
	{
		$res =Db::name('s_course_info')->where('sTime',">",$sTime)->where('eTime',"<",$eTime)->select();
		if($res)
		{
		 for($i=0;$i<count($res);$i++)
		 {
			 $data =["eShow"=>0];
			 $resv =Db::name('s_course_info')->where("info_id",$res[$i]['info_id'])->update($data);
		 }			
		}
		$res2 =Db::name('s_ielts_info')->where('sTime',">",$sTime)->where('eTime',"<",$eTime)->select();
		if($res2)
		{
		 for($i=0;$i<count($res2);$i++)
		 {
			 $data =["eShow"=>0];
			 $resv =Db::name('s_ielts_info')->where("info_id",$res2[$i]['info_id'])->update($data);
		 }			
		}	
        return 1;		
	}
}
?>