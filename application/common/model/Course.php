<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Course extends Model
{
   
    public function getCourseList($uid,$time ='2019-06-04')
	{
		$time = $time.' 00:00:00';
		$rtime =  strtotime($time);
		//获取用户剩余次卡
		$card = Db::name('s_user_course')->where('uid',$uid)->where('state',0)->Distinct(true)->field('card_id')->select();
		if($card)
		{
		   $array=[];
		   if($card)
		  {
			  for($i=0;$i<count($card);$i++){
				  if($card[$i]['card_id'])
				  {
					 array_push($array,$card[$i]['card_id']);
				  }
			  }
		  }
		  //获取用户剩余次卡的不重复cardId
		  if($array)
		  {    $arrStr = implode(",", $array);
			   $cardType= Db::name('s_card')->where('card_cn',"course")->where('card_lv',1)->where("card_id","in",$arrStr)->select(); 
                if($cardType)
				{   $type ="";
					for($i=0;$i<count($cardType);$i++)
					{  if($i==0){
						$type =$cardType[$i]['card_type'];
					     }else{
						  $type=$type.",".$cardType[$i]['card_type'];
						}
					}
					$typeArr =explode(',', $type);
					if(count($typeArr)){
						$typeArr=array_unique($typeArr);
						sort($typeArr);
						$typeStr =implode(',',$typeArr);
						$res = Db::name('s_course_info')->join("s_course","s_course.course_id = s_course_info.c_id")->join("s_type","s_type.type_id = s_course_info.c_type")->where('course_data',$rtime)->where('c_type','in',$typeStr)->where('c_lv',1)->order('info_id desc')->select();
                       if($res)
		              {
			            for($i = 0;$i<count($res);$i++)
			           {
				          //$res[$i]['state'] = 0;
			           }
		             }else{ $res=[];  }					
					}else{ $res=[];  }	
	
				}else{ $res=[];  }	
			
			   $cardType2 = Db::name('s_card')->where('card_cn',"course")->where('card_lv',2)->where("card_id","in",$arrStr)->select(); 
                if($cardType2)
				{   $type ="";
					for($i=0;$i<count($cardType2);$i++)
					{  if($i==0){
						$type =$cardType2[$i]['card_type'];
					     }else{
						  $type=$type.",".$cardType2[$i]['card_type'];
						}
					}
					$typeArr =explode(',', $type);
					if(count($typeArr)){
						$typeArr=array_unique($typeArr);
						sort($typeArr);
						$typeStr =implode(',',$typeArr);
						$resx = Db::name('s_course_info')->join("s_course","s_course.course_id = s_course_info.c_id")->join("s_type","s_type.type_id = s_course_info.c_type")->where('course_data',$rtime)->where('c_type','in',$typeStr)->where('c_lv',2)->order('info_id desc')->select();
                       if($resx)
		              {
			            for($i = 0;$i<count($resx);$i++)
			           {
				         // $res[$i]['state'] = 0;
			           }
		             }					
				  }else{ $resx=[];  }
				}else{ $resx=[];  }
                  //
				  $arrAll=array();
				  if($res)
				  {
					  for($i=0;$i<count($res);$i++)
					  {
						  array_push($arrAll,$res[$i]);
					  }
				  }
				  if($resx)
				  {
						for($i=0;$i<count($resx);$i++)
					  {
						  array_push($arrAll,$resx[$i]);
					  }				  
				  }
				  if($arrAll){
				  for($i=0;$i<count($arrAll);$i++)
				  {
					  $cid = $arrAll[$i]['info_id'];
					  $resL= Db::name('s_user_course')->where("uid",$uid)->where("course_id",$cid)->where("state",1)->find();
					  if($resL){
						  $arrAll[$i]['state'] = 1;
					  }else{
						   $arrAll[$i]['state'] = 0;
					  }
				  }
				  }
			     return $arrAll;				
		  }else{
			  return $array;
		  }
		}else{
			return $card;
		}
	}
	
	public function getCourseInfo($id,$uid)
	{
        $res = Db::name('s_course_info')->join("s_course"," s_course.course_id = s_course_info.c_id")->where('info_id',$id)->find();
		if($res)
		{
			$resType =Db::name('s_type')->where('type_id',$res['c_type'])->find();
			if($resType)
			{
				$res['type_name'] =$resType['type_name'];
			}else{
				$res['type_name'] = '类型不存在';
			}
			$card =  Db::name('s_user_course')->where('uid',$uid)->where('state',1)->where("course_id",$id)->find();
			if($card)
			{
				$res['enroll']= 1;
			}else{
				$res['enroll']= 0;
			}
		}
		return $res;		
	}
   
    public function enrollCheck($id)
	{   $time =time();
	    $res = Db::name('s_course_info')->where('info_id',$id)->find();
		if($res)
		{  
	         if($time>$res['stop_time'])
			 {
				 return [];
				 
			 }else{
				 return 1;
			 }
		}else{
			return $res;
		}
	}
   
    public function enroll($id,$uid)
	{   $time =time();
        $res = Db::name('s_course_info')->where('info_id',$id)->find();
		//return $res;
		if($res)
		{   $lvsu=$res['appointment']+1;
	        if($lvsu>$res['course_limit']){ return 9;}
	        $csId=$res['c_id'];
	        $resc = Db::name('s_user_course_log')->where('uid',$uid)->where('courseId',$csId)->find();
			if(!$resc){
        	$cType = $res['c_type'];  $cLv = $res['c_lv'];
	        //checkCard
			$card =  Db::name('s_user_course')->where('uid',$uid)->where('state',0)->where("card_time",'>',$time)->select();
			//return $card;
			if($card)
			{
				
				$c = $this->getCard($uid,$cType,$cLv);//返回card_id   空返回则不存在 
	
				if($c){
					   //return  $c;	
					   $cardCo =  Db::name('s_user_course')->where('uid',$uid)->where('card_id',$c)->where('state',0)->where("card_time",'>',$time)->select();
					   $data= ["course_id"=>$id,"course_type"=>$res['c_type'],"update_time"=>$time,"state"=>1];
				       $res2 =Db::name('s_user_course')->where('cid',$cardCo[0]['cid'])->update($data);
					   //send requset 
				       $res3=["enroll"=>1,"cid"=>$cardCo[0]['cid']];
					   //update  course  usercard
					   $lesCourse= Db::name('s_user_course')->where('uid', $uid)->where('state', 0)->where("card_time",'>',$time)->select();//情景英语
					   $les =count($lesCourse);
					   $datas=["lesEcourse"=>$les];
					   $resn =Db::name('s_user')->where('uid',$uid)->update($datas);
					    //update  course  appointment
				      $allCourse = Db::name('s_user_course')->where('course_id', $id)->select();//情景英语
				      $all = count($allCourse);
				      $datau=["appointment"=>$all];
				      $resu =Db::name('s_course_info')->where('info_id',$id)->update($datau);
					  
					  $dataus=["uid"=>$uid,"time"=>time(),"courseId"=>$csId];
					  $resus =Db::name('s_user_course_log')->insertGetId($dataus);
			          return  $res3;	
					
				}else{
			      $res=[];
			      return  $res;						
				}
			}else{
			  $res=[];
			  return  $res;				
			}
			}else{
			$res=1;
			return  $res;			
			}
		}else{
			$res=[];
			return  $res;
		}			
	}

    public function cancel($id,$uid)
	{   $time =time();
        $res = Db::name('s_course_info')->where('info_id',$id)->find();
		if($res)
		{  
             $card =  Db::name('s_user_course')->where('uid',$uid)->where('state',1)->where("course_id",$id)->find();
			 if($card){
				$data= ["course_id"=>'',"course_type"=>'',"update_time"=>$time,"state"=>0];
				$res2 =Db::name('s_user_course')->where('cid',$card['cid'])->update($data);
				$res3=["cancel"=>1];
				 //update  course  usercard
				$lesCourse= Db::name('s_user_course')->where('uid', $uid)->where('state', 0)->where("card_time",'>',$time)->select();//情景英语
				$les =count($lesCourse);
				$datas=["lesEcourse"=>$les];
				$resn =Db::name('s_user')->where('uid',$uid)->update($datas);
				//update course appointment
				$allCourse = Db::name('s_user_course')->where('course_id', $id)->select();//情景英语
				$all = count($allCourse);
				$datau=["appointment"=>$all];
				$resu =Db::name('s_course_info')->where('info_id',$id)->update($datau);
                $csId=$res['c_id'];
	            $resc = Db::name('s_user_course_log')->where('uid',$uid)->where('courseId',$csId)->find();
			    if($resc){
					 $rescd = Db::name('s_user_course_log')->where('rlid',$resc['rlid'])->delete();
				}				
			    return  $res3;					 
				 
			 }else{
			  $res=[];
			  return  $res;				 
			 }			
		}else{
			$res=[];
			return  $res;			
		}			
	}

	public function getCard($uid,$cType,$cLv)
	{    $time =time();
	      //*******获取剩余的课卡
         $card = Db::name('s_user_course')->where('uid',$uid)->where('state',0)->where("card_time",'>',$time)->Distinct(true)->field('card_id')->select();
		 if($card)
		 {
		   $array=[];
		   if($card)
		  {
			  for($i=0;$i<count($card);$i++){
				  if($card[$i]['card_id'])
				  {
					 array_push($array,$card[$i]['card_id']);
				  }
			  }
		  }
		  
		  if($array)
		  {    //$arrStr = implode(",", $array);
	          //*******获取符合条件的课卡
			  if($cLv==3){
				   return 12;
			  }
			  else{
			   $cardType= Db::name('s_card')->where('card_cn',"course")->where('card_lv',$cLv)->select(); 
			   $cardArr=[];
			   for($i=0;$i<count($cardType);$i++)
			   {
				    //$arrFor=[];
				   $arrFor=explode(",",$cardType[$i]['card_type']);
				   if(in_array($cType,$arrFor)){ array_push($cardArr,$cardType[$i]['card_id']);}
			   }
			  
			  $array2 =  $cardArr;
               if($array2)
				{  
				    $array3=[];
                   for($i=0;$i<count($array);$i++)
				   {
                       for($j=0;$j<count($array2);$j++)
				      {
					      if($array[$i]==$array2[$j])
						  {
							   array_push($array3,$array2[$j]);
						  }
					   
				      }					     
				   }

				   if($array3)
				   {
					   if(count($array3)==1)
					   {
						   return $array3[0];
						   
					   }else{
						    $cardMa= Db::name('s_card')->where('card_cn',"course")->where('card_lv',$cLv)->where('card_type',$cType)->Distinct(true)->field('card_id')->find();
							if($cardMa){
							 if (in_array($cardMa['card_id'], $array3)){ return $cardMa['card_id']; }else{ return $array3[0];}	
								
							}else{
							  return $array3[0];	
							}
						   //choose one 
					   }
				   }else{
					 return [];  	  
				   }
				}else{
				  return [];  	
				}	
			  }
		
		}else{
			return [];
		}
	}else{
			return [];
		}
	}
}

?>