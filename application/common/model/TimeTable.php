<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class TimeTable extends Model
{
   

	
	public function getCourseList($uid)
	{
		
		   //情景英语
           //预约课卡 获取课表
		   $cardUpdate =  Db::name('s_user_course')->join("s_course_info","s_course_info.info_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->select();
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
           $resCourse =  Db::name('s_user_course')->join("s_course_info","s_course_info.info_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->select();
           
		   if(count($resCourse))
		   {
			   for($i=0;$i<count($resCourse);$i++)
			   {
				   $rv =  Db::name('s_course')->where("course_id",$resCourse[$i]["c_id"])->find();
				   $resCourse[$i]["cMark"] = $rv['cMark']; //beizhu
				   $resCourse[$i]["tableType"] = "course";
				   $resCourse[$i]["cDate"] = $resCourse[$i]['course_data'];
				   $resCourse[$i]["vDate"] = date("Y-m-d",$resCourse[$i]['course_data']);
			   }
		   }else{
			  $resCourse =[]; 
		   }
		    // return $resCourse;
		   //雅思英语
		   //班级 获取课表
		   $resUser =  Db::name('s_student_class')->where("suid",$uid)->select();
		   // 数据量超大的情况下 选择设置学习时间区间 按照学习时间区间检索 目前全表检索
		   
		   if($resUser)
		   {
			   $resC = Db::name('s_ielts_info')->where("eShow",1)->select();
			   $all =count($resC);
			   $allClass =count($resUser);
			   $arrIelts=[]; //存入 info_id
			   for($i=0;$i<$allClass;$i++)
			  {
				 $classId = $resUser[$i]["sclassId"];
                  for($j=0;$j<$all;$j++)
				 {
				     $classIds = $resC[$j]['classId']; //可能存在 1,2 // 2 这样的情况
					 if($classIds!=$classId){  // 1 在 1,2 里面的情况
				        $classIdsArr =explode(',', $classIds);
					    if(in_array($classId,$classIdsArr))
					    {
						  array_push($arrIelts,$resC[$j]['info_id']);
					    }
					 }else{    // 1 = 1  的情况
						 array_push($arrIelts,$resC[$j]['info_id']);
					 }
				 }
			  } 
			 
			  if(count($arrIelts))
			  {
			     $unique = array_unique($arrIelts);
				 $resIelts = Db::name('s_ielts_info')->join("s_ielts","s_ielts.ielts_id =s_ielts_info.c_id")->where("eShow",1)->where("info_id",'in',$unique)->select();
				 if(count($resIelts)){
				 for($i=0;$i<count($resIelts);$i++)
				 {
					 $resIelts[$i]['cDate'] =$resIelts[$i]['date'];
					 $resIelts[$i]['vDate'] =date("Y-m-d",$resIelts[$i]['date']);
					 $resIelts[$i]['tableType']="ielts";
				 }
				 }
			  }else{
				$resIelts =[];  
			  }
		   }else{
              $resIelts =[];			
		   }
		   
		   //return $resIelts;
		   //由此得出2个数组 按时间排序 合并成数据集合
		   //创建 时间数组 数字形式
		   $dateArr=[];
		   if(count($resCourse)){
			   for($i=0;$i<count($resCourse);$i++)
			   {
				  array_push($dateArr,$resCourse[$i]['cDate']); 
			   }
		   }
		   
		   if(count($resIelts)){
			   for($i=0;$i<count($resIelts);$i++)
			   {
				  array_push($dateArr,$resIelts[$i]['cDate']); 
			   }
		   }
		   
		   $unDateArr = array_unique($dateArr);
           sort($unDateArr);
		   $sv = count($unDateArr);
	
		  $courseList = [];
		   if($sv == 0){
			   return [];
		   }
		   else if($sv ==1){
				$datev =date("Y-m-d",$unDateArr[0]);
				$datecArr =[];
		        if(count($resCourse)){
			      for($i=0;$i<count($resCourse);$i++)
			     {
					if($datev==$resCourse[$i]['vDate'])
					{
				      array_push($datecArr,$resCourse[$i]); 
					}
			     }
		       }			
		        if(count($resIelts)){
			      for($i=0;$i<count($resIelts);$i++)
			     {
					if($datev==$resIelts[$i]['vDate'])
					{
				      array_push($datecArr,$resIelts[$i]); 
					}
			     }
		       }	  
			    $dataIn = ["date"=>$datev,"courseList"=>$datecArr];
				array_push($courseList,$dataIn);
			 if(count($courseList))
			 {
				 return $courseList;
			 }else{
				  return [];
			 }				
		   }
		   else if($sv>1){  //[1585843200,1586275200] //[1585843200,1586275200]
			 //时间排序
			 for($i=0;$i<$sv;$i++)
			 {
				$datev =date("Y-m-d",$unDateArr[$i]);
				$datecArr =[];
		        if(count($resCourse)){
			      for($j=0;$j<count($resCourse);$j++)
			     {
					if($unDateArr[$i]==$resCourse[$j]['cDate'])
					{
				      array_push($datecArr,$resCourse[$j]); 
					}
			     }
		       }
                
		        if(count($resIelts)){
			      for($j=0;$j<count($resIelts);$j++)
			     {
					if($unDateArr[$i]==$resIelts[$j]['cDate'])
					{
				      array_push($datecArr,$resIelts[$j]); 
					}
			     }
		       }	
                
			    $dataIn = ["date"=>$datev,"courseList"=>$datecArr];
				array_push($courseList,$dataIn);
			 }
			
			 if(count($courseList))
			 {
				 return $courseList;
			 }else{
				  return [];
			 }
		   }else{
			   return [];
		   }
		   
	}


	public function getDayCourseList($uid,$time ='2019-06-04')
	{
		  $time = $time.' 00:00:00';
		  $rtime =  strtotime($time);		
		   //情景英语
           //预约课卡 获取课表
		   $cardUpdate =  Db::name('s_user_course')->join("s_course_info","s_course_info.info_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->select();
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
           $resCourse =  Db::name('s_user_course')->join("s_course_info","s_course_info.info_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->select();
           
		   if(count($resCourse))
		   {
			   for($i=0;$i<count($resCourse);$i++)
			   {
				   $rv =  Db::name('s_course')->where("course_id",$resCourse[$i]["c_id"])->find();
				   $resCourse[$i]["cMark"] = $rv['cMark'];
				   $resCourse[$i]["tableType"] = "course";
				   $resCourse[$i]["cDate"] = $resCourse[$i]['course_data'];
				   $resCourse[$i]["vDate"] = date("Y-m-d",$resCourse[$i]['course_data']);
			   }
		   }else{
			  $resCourse =[]; 
		   }
		    // return $resCourse;
		   //雅思英语
		   //班级 获取课表
		   $resUser =  Db::name('s_student_class')->where("suid",$uid)->select();
		   // 数据量超大的情况下 选择设置学习时间区间 按照学习时间区间检索 目前全表检索
		   
		   if($resUser)
		   {
			   $resC = Db::name('s_ielts_info')->where("eShow",1)->select();
			   $all =count($resC);
			   $allClass =count($resUser);
			   $arrIelts=[]; //存入 info_id
			   for($i=0;$i<$allClass;$i++)
			  {
				 $classId = $resUser[$i]["sclassId"];
                  for($j=0;$j<$all;$j++)
				 {
				     $classIds = $resC[$j]['classId']; //可能存在 1,2 // 2 这样的情况
					 if($classIds!=$classId){  // 1 在 1,2 里面的情况
				        $classIdsArr =explode(',', $classIds);
					    if(in_array($classId,$classIdsArr))
					    {
						  array_push($arrIelts,$resC[$j]['info_id']);
					    }
					 }else{    // 1 = 1  的情况
						 array_push($arrIelts,$resC[$j]['info_id']);
					 }
				 }
			  } 
			 
			  if(count($arrIelts))
			  {
			     $unique = array_unique($arrIelts);
				 $resIelts = Db::name('s_ielts_info')->join("s_ielts","s_ielts.ielts_id =s_ielts_info.c_id")->where("eShow",1)->where("info_id",'in',$unique)->select();
				 if(count($resIelts)){
				 for($i=0;$i<count($resIelts);$i++)
				 {
					 $resIelts[$i]['cDate'] =$resIelts[$i]['date'];
					 $resIelts[$i]['vDate'] =date("Y-m-d",$resIelts[$i]['date']);
					 $resIelts[$i]['tableType']="ielts";
				 }
				 }
			  }else{
				$resIelts =[];  
			  }
		   }else{
              $resIelts =[];			
		   }
		   
		   //return $resIelts;
		   //由此得出2个数组 按时间排序 合并成数据集合
		   //创建 时间数组 数字形式
		   $dateArr=[];
		   if(count($resCourse)){
			   for($i=0;$i<count($resCourse);$i++)
			   {
				  array_push($dateArr,$resCourse[$i]['cDate']); 
			   }
		   }
		   
		   if(count($resIelts)){
			   for($i=0;$i<count($resIelts);$i++)
			   {
				  array_push($dateArr,$resIelts[$i]['cDate']); 
			   }
		   }
		   
		   $unDateArr = array_unique($dateArr);
           sort($unDateArr);
		   $sv = count($unDateArr);
	
		  $courseList = [];
	
		  
            $datev =date("Y-m-d",$rtime);
			$datecArr =[];
		        if(count($resCourse)){
			      for($i=0;$i<count($resCourse);$i++)
			     {
					if($datev==$resCourse[$i]['vDate'])
					{
				      array_push($datecArr,$resCourse[$i]); 
					}
			     }
		       }			
		        if(count($resIelts)){
			      for($i=0;$i<count($resIelts);$i++)
			     {
					if($datev==$resIelts[$i]['vDate'])
					{
				      array_push($datecArr,$resIelts[$i]); 
					}
			     }
		       }	  
			  //  $dataIn = ["date"=>$datev,"courseList"=>$datecArr];
				//array_push($courseList,$dataIn);
			 if(count($datecArr))
			 {   $ts = time();
				  for($i=0;$i<count($datecArr);$i++)
				  {
					 if($datecArr[$i]['sTime'] > $ts)
					 {
						$datecArr[$i]['aState']="待上课";
						
					 }else{		
						 $resv =Db::name('s_user_attence')->where("uid",$uid)->where("infoId",$datecArr[$i]['info_id'])->where("cState",0)->where("cType",$datecArr[$i]['tableType'])->find();
                         if($resv){
							 $datecArr[$i]['aState']="缺席";
						 }else{
							 $datecArr[$i]['aState']="已上课";
						 }
					
					 }
				  }
				 return $datecArr;
			 }else{
				  return [];
			 }				
		   
   
	}


		public function getTCourseList($uid)
	{
		
		   //情景英语
           //teacherId 获取课表
	
           $resCourse =  Db::name('s_course_info')->join("s_course","s_course.course_id =s_course_info.c_id")->where('teacherId',$uid)->where('eShow',1)->select();
           
		   if(count($resCourse))
		   {
			   for($i=0;$i<count($resCourse);$i++)
			   {
				 
				   $resCourse[$i]["tableType"] = "course";
				   $resCourse[$i]["cDate"] = $resCourse[$i]['course_data'];
				   $resCourse[$i]["vDate"] = date("Y-m-d",$resCourse[$i]['course_data']);
			   }
		   }else{
			  $resCourse =[]; 
		   }
		    // return $resCourse;
		   //雅思英语
		   //班级 获取课表
           $resIelts =  Db::name('s_ielts_info')->join("s_ielts","s_ielts.ielts_id =s_ielts_info.c_id")->where('teacherId',$uid)->where('eShow',1)->select();
           
		   if(count($resIelts))
		   {
			   for($i=0;$i<count($resIelts);$i++)
			   {
				 
				   $resIelts[$i]["tableType"] = "ielts";
				   $resIelts[$i]["cDate"] = $resIelts[$i]['date'];
				   $resIelts[$i]["vDate"] = date("Y-m-d",$resIelts[$i]['date']);
			   }
		   }else{
			  $resIelts =[]; 
		   }
		   //return $resIelts;
		   //由此得出2个数组 按时间排序 合并成数据集合
		   //创建 时间数组 数字形式
		   $dateArr=[];
		   if(count($resCourse)){
			   for($i=0;$i<count($resCourse);$i++)
			   {
				  array_push($dateArr,$resCourse[$i]['cDate']); 
			   }
		   }
		   
		   if(count($resIelts)){
			   for($i=0;$i<count($resIelts);$i++)
			   {
				  array_push($dateArr,$resIelts[$i]['cDate']); 
			   }
		   }
		   
		   $unDateArr = array_unique($dateArr);
           sort($unDateArr);
		   $sv = count($unDateArr);
	
		  $courseList = [];
		   if($sv == 0){
			   return [];
		   }
		   else if($sv ==1){
				$datev =date("Y-m-d",$unDateArr[0]);
				$datecArr =[];
		        if(count($resCourse)){
			      for($i=0;$i<count($resCourse);$i++)
			     {
					if($datev==$resCourse[$i]['vDate'])
					{
				      array_push($datecArr,$resCourse[$i]); 
					}
			     }
		       }			
		        if(count($resIelts)){
			      for($i=0;$i<count($resIelts);$i++)
			     {
					if($datev==$resIelts[$i]['vDate'])
					{
				      array_push($datecArr,$resIelts[$i]); 
					}
			     }
		       }	  
			    $dataIn = ["date"=>$datev,"courseList"=>$datecArr];
				array_push($courseList,$dataIn);
			 if(count($courseList))
			 {
				 return $courseList;
			 }else{
				  return [];
			 }				
		   }
		   else if($sv>1){  //[1585843200,1586275200] //[1585843200,1586275200]
			 //时间排序
			 for($i=0;$i<$sv;$i++)
			 {
				$datev =date("Y-m-d",$unDateArr[$i]);
				$datecArr =[];
		        if(count($resCourse)){
			      for($j=0;$j<count($resCourse);$j++)
			     {
					if($unDateArr[$i]==$resCourse[$j]['cDate'])
					{
				      array_push($datecArr,$resCourse[$j]); 
					}
			     }
		       }
                
		        if(count($resIelts)){
			      for($j=0;$j<count($resIelts);$j++)
			     {
					if($unDateArr[$i]==$resIelts[$j]['cDate'])
					{
				      array_push($datecArr,$resIelts[$j]); 
					}
			     }
		       }	
                
			    $dataIn = ["date"=>$datev,"courseList"=>$datecArr];
				array_push($courseList,$dataIn);
			 }
			
			 if(count($courseList))
			 {
				 return $courseList;
			 }else{
				  return [];
			 }
		   }else{
			   return [];
		   }
		   
	}

		public function getTDCourseList($uid,$time ='2019-06-04')
	{  		$time = $time.' 00:00:00';
		   $rtime =  strtotime($time);	
		
		   //情景英语
           //teacherId 获取课表
	
           $resCourse =  Db::name('s_course_info')->join("s_course","s_course.course_id =s_course_info.c_id")->where('teacherId',$uid)->where('eShow',1)->select();
           
		   if(count($resCourse))
		   {
			   for($i=0;$i<count($resCourse);$i++)
			   {
				 
				   $resCourse[$i]["tableType"] = "course";
				   $resCourse[$i]["cDate"] = $resCourse[$i]['course_data'];
				   $resCourse[$i]["vDate"] = date("Y-m-d",$resCourse[$i]['course_data']);
			   }
		   }else{
			  $resCourse =[]; 
		   }
		    // return $resCourse;
		   //雅思英语
		   //班级 获取课表
           $resIelts =  Db::name('s_ielts_info')->join("s_ielts","s_ielts.ielts_id =s_ielts_info.c_id")->where('teacherId',$uid)->where('eShow',1)->select();
           
		   if(count($resIelts))
		   {
			   for($i=0;$i<count($resIelts);$i++)
			   {
				 
				   $resIelts[$i]["tableType"] = "ielts";
				   $resIelts[$i]["cDate"] = $resIelts[$i]['date'];
				   $resIelts[$i]["vDate"] = date("Y-m-d",$resIelts[$i]['date']);
			   }
		   }else{
			  $resIelts =[]; 
		   }
		   //return $resIelts;
		   //由此得出2个数组 按时间排序 合并成数据集合
		   //创建 时间数组 数字形式

	
		       $courseList = [];
		
				$datev =date("Y-m-d",$rtime);
				$datecArr =[];
		        if(count($resCourse)){
			      for($i=0;$i<count($resCourse);$i++)
			     {
					if($datev==$resCourse[$i]['vDate'])
					{
				      array_push($datecArr,$resCourse[$i]); 
					}
			     }
		       }			
		        if(count($resIelts)){
			      for($i=0;$i<count($resIelts);$i++)
			     {
					if($datev==$resIelts[$i]['vDate'])
					{
				      array_push($datecArr,$resIelts[$i]); 
					}
			     }
		       }	  
			    //$dataIn = ["date"=>$datev,"courseList"=>$datecArr];
				//array_push($courseList,$dataIn);
			 if(count($datecArr))
			 {
				 // 教师上课状态 待上课 已上课 根据时间判断
				 for($i=0;$i<count($datecArr);$i++)
				 {   
			         $ts = time();
					 if($datecArr[$i]['sTime']>$ts)
					 {
						  $datecArr[$i]['aState']="待上课";
					 }else{
						  $datecArr[$i]['aState']="已上课";
					 }
					 
				 }
				 return $datecArr;
			 }else{
				  return [];
			 }				
		   
  
	}


	
	    public function getCourseListv($uid,$time ='2019-06-04')
	{
		$time = $time.' 00:00:00';
		$rtime =  strtotime($time);
		//获取用户剩余次卡
		//->where("card_time","<",$rtime)
		$card = Db::name('s_user_course')->where('uid',$uid)->where('state',0)->select();
		//return $card;
		if($card)
		{  //存在次卡 则根据选择日期内的班级 匹配学生的班级
		  
		  $resCourse =  Db::name('s_course_info')->join("s_course","s_course.course_id =s_course_info.c_id")->where('course_data',$rtime)->where('eShow',1)->select();
          if(!count($resCourse)){ return [];} //检索不到当天课程 则返回空数组
		  $resClass =  Db::name('s_student_class')->where("suid",$uid)->select();
		  if(count($resClass))
		  {
			  
			   $arrIelts=[]; //存入 info_id
			   for($i=0;$i<count($resClass);$i++)
			  {
				 $classId = $resClass[$i]["sclassId"];
                  for($j=0;$j<count($resCourse);$j++)
				 {
				     $classIds = $resCourse[$j]['classId']; //可能存在 1,2 // 2 这样的情况
					 if($classIds!=$classId){  // 1 在 1,2 里面的情况
				        $classIdsArr =explode(',', $classIds);
					    if(in_array($classId,$classIdsArr))
					    {
						  array_push($arrIelts,$resCourse[$j]['info_id']);
					    }
					 }else{    // 1 = 1  的情况
						 array_push($arrIelts,$resCourse[$j]['info_id']);
					 }
				 }
			  } 
			 
			  if(count($arrIelts))
			  {
			     $unique = array_unique($arrIelts);
				 $resCoursev =  Db::name('s_course_info')->join("s_course","s_course.course_id =s_course_info.c_id")->where("info_id",'in',$unique)->where('eShow',1)->select();
				  for($i=0;$i<count($resCoursev);$i++)
				  {
					  $cid = $resCoursev[$i]['info_id'];
					  $resL= Db::name('s_user_course')->where("uid",$uid)->where("course_id",$cid)->where("state",1)->find();
					  if($resL){
						  $resCoursev[$i]['state'] = 1;
					  }else{
						  $resCoursev[$i]['state'] = 0;
					  }
				  } 
 
			  }else{
				$resCoursev =[];  
			  }			  
			  
			  return  $resCoursev;
		  }else{
			  return []; //检索不到班级 则返回空数组
		  }
		  
		}else{ //不存在次卡 则返回空数组
			return [];
		}
	}
	
	public function getAttenceList($id,$type)
	{
		if($type=="course"){  //情景英语考勤     预约制度
		    //查询记录
			$mark =  Db::name('s_course_info')->where("info_id",$id)->find();
			if(!$mark['fcMark']){
				$mark['fcMark']='暂无';
			}
			$res = Db::name('s_user_attence')->where("infoId",$id)->where("cType",$type)->select();
			if(count($res))
			{     //存在记录
				$res = Db::name('s_user_attence')->join("s_user","s_user.uid = s_user_attence.uid")->join("s_user_info","s_user_info.user_id = s_user_attence.uid")->where("infoId",$id)->where("cType",$type)->field('s_user.uid,infoId,cType,cState,user_logo,real_name')->select();
			    $rv = ["student"=>$res,"mark"=>$mark['fcMark']];
				return $rv;   				
			}else{//不存在记录  默认签到
				
			   $res =  Db::name('s_user_course')->join("s_user","s_user.uid =s_user_course.uid")->join("s_user_info","s_user_info.user_id = s_user_course.uid")->where('course_id',$id)->where('state',1)->field('s_user.uid,user_logo,real_name')->select();
	           if(count($res))
			   {
				   for($i=0;$i<count($res);$i++)
				   {
					   $res[$i]['cState'] = 1;
					   $res[$i]['infoId'] = $id;
				   }
				  $rv = ["student"=>$res,"mark"=>$mark['fcMark']];
				  return $rv;   
			   }else{
				 $rv = ["student"=>[],"mark"=>$mark['fcMark']];
				  return $rv;   
			   }	
			}
		     			
		}else if($type=="ielts"){ //雅思英语考勤  班级制
		    //查询记录
			$mark =  Db::name('s_ielts_info')->where("info_id",$id)->find();
			if(!$mark['fcMark']){
				$mark['fcMark']='暂无';
			}
			$res = Db::name('s_user_attence')->where("infoId",$id)->where("cType",$type)->select();
			if(count($res))
			{     //存在记录
				$res = Db::name('s_user_attence')->join("s_user","s_user.uid = s_user_attence.uid")->join("s_user_info","s_user_info.user_id = s_user_attence.uid")->where("infoId",$id)->where("cType",$type)->field('s_user.uid,infoId,cType,cState,user_logo,real_name')->select();
                 $rv = ["student"=>$res,"mark"=>$mark['fcMark']];
				  return $rv;   				
			}else{//不存在记录  默认签到
				//查找班级
				$resIelts =   Db::name('s_ielts_info')->where("info_id",$id)->find();
				if(!$resIelts){ return [];}
				$classIds = $resIelts['classId']; //可能存在 1,2 // 2 这样的情况
				if(stristr($classIds,",")) //该课程2个班级或以上
				{    
				    $resUser =[];
				    $classIdsArr =explode(',', $classIds);
					
					for($i=0;$i<count($classIdsArr);$i++)
					{
						$resV =  Db::name('s_student_class')->where("sclassId",$classIdsArr[$i])->select();
						if(count($resV))
						{   
					       for($j=0;$j<count($resV);$j++)
						   {  
					          array_push($resUser,$resV[$j]['suid']);
						   }
						}
						
					}
					//return  $resUser;
					if(count($resUser))
					{   //班级有人 则需要去重;
				
	                   $unDateArr = array_unique($resUser);
					   
          			   $res =   Db::name('s_user')->join("s_user_info","s_user_info.user_id = s_user.uid")->where("uid","in",$unDateArr)->field('s_user.uid,user_logo,real_name')->select();
				        // $rv = ["student"=>$res,"mark"=>"暂无"];
				        //return $rv;
					}else{
				    $rv = ["student"=>[],"mark"=>$mark['fcMark']];
				     return $rv ;  //班级没人直接返回空数组
					}
					
                }else{  //该课程只有一个班级
					$res =  Db::name('s_student_class')->join("s_user","s_user.uid =s_student_class.suid")->join("s_user_info","s_user_info.user_id = s_student_class.suid")->where('sclassId',$classIds)->field('s_user.uid,user_logo,real_name')->select();

				}
								
			   //$res =  Db::name('s_student_class')->join("s_user","s_user.uid =s_user_course.uid")->join("s_user_info","s_user_info.user_id = s_user_course.uid")->where('course_id',$id)->where('state',1)->field('s_user.uid,user_logo,real_name')->select();
	           
			   
			   if(count($res))
			   {
				   for($i=0;$i<count($res);$i++)
				   {
					   $res[$i]['cState'] = 1;
					   $res[$i]['infoId'] = $id;
					    //$res[$i]['cMark'] = $id;
				   }
				   $rv = ["student"=>$res,"mark"=>$mark['fcMark']];
				   return $rv;
			   }else{
				 $rv = ["student"=>[],"mark"=>$mark['fcMark']];
				 return $rv ;   
			   }	
			}		

		}else{
				 $rv = ["student"=>[],"mark"=>"暂无"];
				 return $rv ; 
		
		}
		
	}
	
	public function saveAttenceList($id,$type,$sign,$absent)
	{
		//检查数据  
		//存在数据则先删除  
		$res =  Db::name('s_user_attence')->where("infoId",$id)->where("cType",$type)->delete();
		if($sign) // 0  // 1   //1,6
		{
              if(stristr($sign,",")) //该课程2个人或以上 已签
		     {    
				   
				    $userArr =explode(',', $sign);
					for($i=0;$i<count($userArr);$i++)
					{
						if($userArr[$i]!=0){
						 $data =["uid"=>$userArr[$i],"cType"=>$type,"cState"=>1,"infoId"=>$id];
						 $rs = Db::name('s_user_attence')->insertGetId($data);
						 //执行 积分记录
						 //上课积分+up
						 $vs = $this->bonus($userArr[$i],$type,$id);
						}
					}
					
		     }else{ //该课程1个人 已签
			     if($sign!=0){
						 $data =["uid"=>$sign,"cType"=>$type,"cState"=>1,"infoId"=>$id];
						 $rs = Db::name('s_user_attence')->insertGetId($data);	
						 //执行 积分记录
						 //上课积分+up
						 $vs = $this->bonus($sign,$type,$id);
				 }						 
			 }
			
		}
		
		if($absent)
		{
              if(stristr($absent,",")) //该课程2个人或以上 缺席
		     {    
				   
				    $userArr =explode(',', $absent);
					for($i=0;$i<count($userArr);$i++)
					{
						if($userArr[$i]!=0){
						 $data =["uid"=>$userArr[$i],"cType"=>$type,"cState"=>0,"infoId"=>$id];
						 $rs = Db::name('s_user_attence')->insertGetId($data);
						}
					}
					
		     }else{ //该课程1个人 缺席
			     if($absent!=0){
						 $data =["uid"=>$absent,"cType"=>$type,"cState"=>0,"infoId"=>$id];
						 $rs = Db::name('s_user_attence')->insertGetId($data);	
				 }						 
			 }			
			
		}
		return [];
	}
	
	public function updateMark($id,$type,$mark)
	{
		//$res =  Db::name('s_user_attence')->where("infoId",$id)->where("cType",$type)->find();
		$dataUpdate =["fcMark"=>$mark];
		if($type=='ielts'){
			 $rs = Db::name('s_ielts_info')->where('info_id',$id)->update($dataUpdate);	
		}else{
			 $rs = Db::name('s_course_info')->where('info_id',$id)->update($dataUpdate);	
		}
		return 1;
	}
	
	public function getNowMonth()
	{
		return date("Y年m");
	}
	
    public function getDateMonth($time)
	{
		$time = $time.' 00:00:00';
		$rtime =  strtotime($time);	
		return date('Y年m',$rtime);
	}
	
	public function getWorkTime($uid)
    {
		//获取当前月份的时间戳
		$time=time();
	    $beginThisMonth =mktime(0,0,0,date('m'),1,date('Y'));
		$endThisMonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
        $list =Db::name('s_course_info')->where('sTime','>',$beginThisMonth)->where('eTime','<',$endThisMonth)->where('teacherId',$uid)->select();
		$list2 =Db::name('s_ielts_info')->where('sTime','>',$beginThisMonth)->where('eTime','<',$endThisMonth)->where('teacherId',$uid)->select();
	
	  $allcount =count($list);
	  $allcount2 =count($list2);
	  $min = 0;
	 if($allcount>0)
	 {
	    for($i=0;$i<$allcount;$i++)
	   {
	   	if($list[$i]['attence']<3){
	  		$min =$min + $list[$i]['classHour'];
	    	}
	    }
	   }
	  $min2 = 0;
	  if($allcount2>0)
	  {
	  for($i=0;$i<$allcount2;$i++)
	  {
		  if($list2[$i]['attence']<3){
		  	$min2 =$min2 + $list2[$i]['classHour'];
		  }
	  }
	  }
	  $min3 = $min+$min2;
	   return $min3;
	}
	public function getWorkTime2($time,$uid)
    {
		//获取传入月份的时间戳
				$time = $time.' 00:00:00';
		$rtime =  strtotime($time);	
	    $beginThisMonth =mktime(0,0,0,date('m',$rtime),1,date('Y',$rtime));
		$endThisMonth = mktime(23,59,59,date('m',$rtime),date('t',$rtime),date('Y',$rtime));
      $list =Db::name('s_course_info')->where('sTime','>',$beginThisMonth)->where('eTime','<',$endThisMonth)->where('teacherId',$uid)->where('eShow',1)->select();
		$list2 =Db::name('s_ielts_info')->where('sTime','>',$beginThisMonth)->where('eTime','<',$endThisMonth)->where('teacherId',$uid)->where('eShow',1)->select();
	
	  $allcount =count($list);
	  $allcount2 =count($list2);
	  $min = 0;
	 if($allcount>0)
	 {
	    for($i=0;$i<$allcount;$i++)
	   {
	   	if($list[$i]['attence']<3){
	  		$min =$min + $list[$i]['classHour'];
	    	}
	    }
	   }
	  $min2 = 0;
	  if($allcount2>0)
	  {
	  for($i=0;$i<$allcount2;$i++)
	  {
		  if($list2[$i]['attence']<3){
		  	$min2 =$min2 + $list2[$i]['classHour'];
		  }
	  }
	  }
	  $min3 = $min+$min2;
	   return $min3;
	}


	public function bonus($uid,$cType,$cid)
	{
		//$type 1 -主题打卡  2-阅读打卡  3-阅读90s
		
		// 1 -主题打卡  是否存在记录; 是 不执行操作; 否 新增记录 ,执行加分操作
		// 2 -阅读打卡  是否存在记录;是 不执行操作; 否 新增记录; 是否存在加分记录; 是,不执行操作 ; 否， 判断 3 阅读90s  两者同时存在 则 执行加分操作 新增记录	
		// 3 -阅读90s   是否存在记录;是 不执行操作; 否 新增记录; 是否存在加分记录; 是,不执行操作 ; 否， 判断 2 阅读打卡 两者同时存在 则 执行加分操作 新增记录
        // 4 - type 上课打卡积分
		//cType 课程type  cid 课程id[infoId]
		$type = 4;
     	   $res =  Db::name('s_user_attence')->where('uid',$uid)->where('cType',$cType)->where('infoId',$cid)->where('cState',1)->find();
		   if($res){
			   //
			   if($cType=='ielts')
			   {
				   $oid = 1;
			   }else{
				   $oid = 2;
			   }
			   // 1 雅思 ，2 情景英语
			   //查询上课积分添加记录
			   $rsv = Db::name('s_bonus_log')->where('uid',$uid)->where('ctype',1)->where('gid',$cid)->where('orderId',$oid)->find();
			   if(!$rsv){
				   //不存在记录则添加
			   $resv = Db::name('s_bonus_active')->where('bid',1)->find();
			   $data=["uid"=>$uid,"cbonus"=>$resv['points'],"source"=>$resv['activeName'],"activeName"=>$resv['bonusName'],"time"=>time(),'ctype'=>1,"gid"=>$cid,"orderId"=>$oid ] ;
			   $res3 = Db::name('s_bonus_log')->insertGetId($data);
			   $res4 =  Db::name('s_user')->where('uid',$uid)->find();
			   $bonus =$res4['bonus']+$resv['points'];
			   $data=['bonus'=>$bonus];
			   $res5 =  Db::name('s_user')->where('uid',$uid)->update($data);
			   }
		   }
		   return 1;
	}		 
}
?>