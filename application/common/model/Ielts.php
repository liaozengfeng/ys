<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Ielts extends Model
{
   
    public function getCourseList($uid,$time ='2019-06-04')
	{
		$time = $time.' 00:00:00';
		$rtime =  strtotime($time);
		//获取用户剩余次卡
		$card = Db::name('s_user_ielts')->where('uid',$uid)->where('state',0)->Distinct(true)->field('card_id')->select();
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
		  {    $arrStr = implode(",", $array);
			   $cardType= Db::name('s_card')->where('card_cn',"ielts")->where("card_id","in",$arrStr)->select(); 
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
						$res = Db::name('s_ielts_info')->join("s_ielts","s_ielts.ielts_id = s_ielts_info.c_id")->join("s_type","s_type.type_id = s_ielts_info.c_type")->where('date',$rtime)->where('c_type','in',$typeStr)->order('ielts_id desc')->select();
				  if($res){
				  for($i=0;$i<count($res);$i++)
				  {
					  $cid = $res[$i]['info_id'];
					  $resL= Db::name('s_user_ielts')->where("uid",$uid)->where("ielts_id",$cid)->where("state",1)->find();
					  if($resL){
						  $res[$i]['state'] = 1;
					  }else{
						   $res[$i]['state'] = 0;
					  }
				  }
				  }
		             return $res;					
					}
					else{
						 $typeArr =[];
						 return  $typeArr;
					}
				}else{
					 return $cardType;
				}				
		  }else{
			  return $array;
		  }
		}else{
			return $card;
		}
	}
	
	public function getCourseInfo($id,$uid)
	{
        $res = Db::name('s_ielts_info')->join("s_ielts"," s_ielts.ielts_id = s_ielts_info.c_id")->where('info_id',$id)->find();
		if($res)
		{
			$card =  Db::name('s_user_ielts')->where('uid',$uid)->where('state',1)->where("ielts_id",$id)->find();
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
	    $res = Db::name('s_ielts_info')->where('info_id',$id)->find();
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
        $res = Db::name('s_ielts_info')->where('info_id',$id)->find();
		if($res)
		{   
             $csId=$res['c_id'];
	        $resc = Db::name('s_user_ielts_log')->where('uid',$uid)->where('ieltsId',$csId)->find();
           if(!$resc){			
		    $cType = $res['c_type'];  //$cLv = $res['c_lv'];
			$card =  Db::name('s_user_ielts')->where('uid',$uid)->where('state',0)->where("card_time",'>',$time)->select();
			if($card)
			{  $c = $this->getCard($uid,$cType);//返回card_id   空返回则不存在 
				if($c){
				$data= ["ielts_id"=>$id,"course_type"=>$res['c_type'],"update_time"=>$time,"state"=>1];
				$res2 =Db::name('s_user_ielts')->where('eid',$card[0]['eid'])->update($data);
				$res3=["enroll"=>1];
				$lesCourse= Db::name('s_user_ielts')->where('uid', $uid)->where('state', 0)->where("card_time",'>',$time)->select();//ielts英语
				$les =count($lesCourse);
				$datas=["lesIelts"=>$les];
				$resn =Db::name('s_user')->where('uid',$uid)->update($datas);
					  
					  $dataus=["uid"=>$uid,"time"=>time(),"ieltsId"=>$csId];
					  $resus =Db::name('s_user_ielts_log')->insertGetId($dataus);
				//
			    return  $res3;	
				}else{
					return [];
				}
			}else{
			  $res=[];
			  return  $res;				
			}
		   }else{
			  $res= 1;
			  return  $res;					   
		   }
		}else{
			$res=[];
			return  $res;
		}	
		
	}

    public function cancel($id,$uid)
	{   $time =time();
        $res = Db::name('s_ielts_info')->where('info_id',$id)->find();
		if($res)
		{
             $card =  Db::name('s_user_ielts')->where('uid',$uid)->where('state',1)->where("ielts_id",$id)->find();
			 if($card){
				$data= ["ielts_id"=>'',"course_type"=>'',"update_time"=>$time,"state"=>0];
				$res2 =Db::name('s_user_ielts')->where('eid',$card['eid'])->update($data);
				$res3=["cancel"=>1];
				$lesCourse= Db::name('s_user_ielts')->where('uid', $uid)->where('state', 0)->where("card_time",'>',$time)->select();//ielts英语
				$les =count($lesCourse);
				$datas=["lesIelts"=>$les];
				$resn =Db::name('s_user')->where('uid',$uid)->update($datas);
                $csId=$res['c_id'];
	            $resc = Db::name('s_user_ielts_log')->where('uid',$uid)->where('ieltsId',$csId)->find();
			    if($resc){
					 $rescd = Db::name('s_user_ielts_log')->where('rlid',$resc['rlid'])->delete();
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
	
     public function getCard($uid,$cType)
	{    $time =time();
	      //*******获取剩余的课卡
		  $cLv =1;
         $card = Db::name('s_user_ielts')->where('uid',$uid)->where('state',0)->where("card_time",'>',$time)->Distinct(true)->field('card_id')->select();
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
			   $cardType= Db::name('s_card')->where('card_cn',"ielts")->where('card_lv',$cLv)->select(); 
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
						    $cardMa= Db::name('s_card')->where('card_cn',"ielts")->where('card_lv',$cLv)->where('card_type',$cType)->Distinct(true)->field('card_id')->find();
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
		
		}else{
			return [];
		}
	}else{
			return [];
		}
	}
}
?>