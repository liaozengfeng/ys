<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class User extends Model
{
   

    public function getUser($uid)
    {
        $res = Db::name('s_user')->where('uid', $uid)->find();
        return $res;       

    }
	
	public function addUser($data)
	{
        return  Db::name('s_user')->insertGetId($data);
         		
	}
	
	public function getUserInfo($openid)
	{
        $res = Db::name('s_user')->where('openId', $openid)->find();
        return $res;		
		
	}
	
	public function form($uid,$formId)
	{
		 $res = Db::name('s_user')->where('uid', $uid)->find();
		 $openId =  $res['openId'];		
         $fdata=["uid"=>$uid,"form_id"=>$formId,"open_id"=>$openId,"time"=>time(),"expire_time"=>time()+604800,"is_use"=>0];
		 $res2 = Db::name('s_user_form')->insertGetId($fdata);		
	}
	
	public function getInfo($uid)
	{
         $res = Db::name('s_user')->where('uid',$uid)->find();
		 if($res){
			 $time =time();
			 $resIelts= Db::name('s_user_ielts')->where('uid', $uid)->where('state', 1)->select();//雅思英语
			 $resCourse= Db::name('s_user_course')->where('uid', $uid)->where('state', 1)->select();//情景英语
			 $resDs=Db::name('s_user_ielts')->where('uid', $uid)->where('state', 0)->where("card_time",'<',$time)->delete(); //更新次卡数据
			 $resDe=Db::name('s_user_course')->where('uid', $uid)->where('state', 0)->where("card_time",'<',$time)->delete();//更新次卡数据
			 
			 $lesIelts= Db::name('s_user_ielts')->where('uid', $uid)->where('state', 0)->where("card_time",'>',$time)->select();//雅思英语
			 $lesCourse= Db::name('s_user_course')->where('uid', $uid)->where('state', 0)->where("card_time",'>',$time)->select();//情景英语
			   $data=["lesEcourse"=>count($lesCourse),"lesIelts"=>count($lesIelts)];
			   $resUpdate = Db::name('s_user')->where('uid', $uid)->update($data);
			 $res['useIelts']=count($resIelts);
			 $res['useCourse']=count($resCourse);
			 $res['lesIelts']=count($lesIelts);
			 $res['lesEcourse']=count($lesCourse);
		 }
        return $res;   	
		
	}

	
	public function updateInfo($data,$uid)
	{
		
		 $res=Db::name('s_user')->where('uid',$uid)->find();
		 if($res){
		     return Db::name('s_user')->where('uid',$uid)->update($data);}
		 else{
			 return $res;
		 }		 		
		
	}
	
	public function getRule($id)
	{
		
		$res=Db::name('s_rule')->where('r_id',$id)->find();
		return $res;	 		
	}	
	
	public function getCourseType($uid)
	{
	     //雅思上课记录;
		  $resIe=Db::name('s_user_ielts')->where('uid',$uid)->Distinct(true)->field('course_type')->select();
		 //情景上课记录;
		  $resCo=Db::name('s_user_course')->where('uid',$uid)->Distinct(true)->field('course_type')->select();
		  $array=[];
		  if($resIe)
		  {
			  for($i=0;$i<count($resIe);$i++){
				  if($resIe[$i]['course_type'])
				  {
					 array_push($array,$resIe[$i]['course_type']);
				  }
			  }
		  }
		  
		  if($resCo)
		  {
			  for($i=0;$i<count($resCo);$i++){
				  if($resCo[$i]['course_type'])
				  {
					 array_push($array,$resCo[$i]['course_type']);
				  }
			  }
		  }
		  sort($array);
		  if($array)
		  {    $arrStr = implode(",", $array);
			   return Db::name('s_type')->where('type_id',"in",$arrStr)->select();  
		  }else{
			  return $array;
		  }
	
	}
	
	public function getCourseRecord($uid,$typeId,$typeCn)
	{
       if($typeCn=="course")
	   { 
           //update End
		   $cardUpdate =  Db::name('s_user_course')->join("s_course_info","s_course_info.info_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->where("s_user_course.course_type",$typeId)->select();
	       if($cardUpdate)
		   {
			   for($i=0;$i<count($cardUpdate);$i++)
			   {
				   $time=time();
				   if($cardUpdate[$i]["end"]==0){
				   if($time>$cardUpdate[$i]["stop_time"]){
					   $data=["end"=>1];
					   $res=Db::name('s_user_course')->where('cid',$cardUpdate[$i]["cid"])->update($data);
				   }
				   }
			   }
			   
		   }
           $card =  Db::name('s_user_course')->join("s_course_info","s_course_info.info_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->where("s_user_course.course_type",$typeId)->select();
	       return $card;
		   
	   }else if($typeCn=="ielts"){
           $cardUpdate =  Db::name('s_user_ielts')->join("s_ielts_info","s_ielts_info.info_id =s_user_ielts.ielts_id")->where('uid',$uid)->where('state',1)->where("s_user_ielts.course_type",$typeId)->select();
	       if($cardUpdate)
		   {
			   for($i=0;$i<count($cardUpdate);$i++)
			   {
				   $time=time();
				    if($cardUpdate[$i]["end"]==0){
				   if($time>$cardUpdate[$i]["stop_time"]){
					   $data=["end"=>1];
					   $res=Db::name('s_user_ielts')->where('eid',$cardUpdate[$i]["eid"])->update($data);
				   }
				   }
			   }
			   
		   }	       
		   $card =  Db::name('s_user_ielts')->join("s_ielts_info","s_ielts_info.info_id =s_user_ielts.ielts_id")->where('uid',$uid)->where('state',1)->where("s_user_ielts.course_type",$typeId)->select();
	       
		   return $card;		   
	   }
	   else{
		   $arr=[];
		   return $arr;
	   }
	
	}


}
?>