<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Learn extends Model
{
   

    public function getCircle($uid,$type,$lv)
    {
        $res = Db::name('s_user')->where('uid', $uid)->find();
		if($res)
		{
			if($res['issue'])
			{
				$res2 = Db::name('s_circle')->where('issue', $res['issue'])->where('lv', $lv)->where('type', $type)->find();
				if($res2){
				$resn = Db::name('s_record')->where('circle_id', $res2['circle_id'])->select();
				$res2["join"]=count($resn);
                return $res2;}
				else{
				$arr=[]; return $arr;	
				}
			}else{
				$arr=[]; return $arr;
			}
		}else{return $res;  }   

    }
	

    public function getCircleV2($cid)
    {
		
			$res2 = Db::name('s_circle')->where('circle_id',$cid)->find();
			if($res2){
				$resn = Db::name('s_record')->where('circle_id', $cid)->select();
				$res2["join"]=count($resn);
                return $res2;
				}else{
				$arr=[]; return $arr;	
			}
			
	}
	
	
	public function getCircleList($uid,$type,$lv)
	{
		 $res = Db::name('s_circle')->where('lv', $lv)->where('type', $type)->select();
		 if($res){
			 //unset($data[$key]);
			 $all = count($res);
			 $resAll=array();
			 for($i=0;$i<$all;$i++)
			 {
				 $resN = Db::name('s_student_circle')->where('b_uid', $uid)->where('b_cid', $res[$i]['circle_id'])->find();
				 if($resN)
				 {
					 array_push($resAll,$res[$i]);
					 //unset($res[$i]);
					 //array_values($res);
				 }
			 }
			 return $resAll; 
		 }else{
			$arr=[]; return $arr; 
		 }
	}
	
	public function getCircleListV2($uid,$id)
	{
		 $res = Db::name('s_circle')->where("cid",$id)->select();
		 if($res){
			 //unset($data[$key]);
			 $all = count($res);
			 $resAll=array();
			 for($i=0;$i<$all;$i++)
			 {
				 $resN = Db::name('s_student_circle')->where('b_uid', $uid)->where('b_cid', $res[$i]['circle_id'])->find();
				 if($resN)
				 {
					 array_push($resAll,$res[$i]);
					 //unset($res[$i]);
					 //array_values($res);
				 }
			 }
			 return $resAll; 
		 }else{
			$arr=[]; return $arr; 
		 }
	}
	
	public function getLastTheme($cid)
	{
        $res = Db::name('s_theme')->where('circle_id', $cid)->order("update_time desc")->find();
        return $res;		
		
	}
	
	public function getThemeList($cid,$uid)
	{
        $res = Db::name('s_theme')->where('circle_id', $cid)->order("theme_id asc")->field("theme_id,theme_name,theme_cover")->select();
		////isread = 1/0
		$all = count($res);
		for($i=0;$i<$all;$i++)
		{
			$c = Db::name("s_record")->where("uid",$uid)->where("type_id",1)->where("theme_id",$res[$i]['theme_id'])->find();
			if($c){
				$res[$i]['is_read']=1;
			}else{
				$res[$i]['is_read']=0;
			}
			
		}
        return $res;		
		
	}
	
	public function getThemeInfo($id)
	{
        $res = Db::name('s_theme')->where('theme_id', $id)->find();
        return $res;		
		
	}
	
	public function getDairyList($cid,$tid,$uid)
	{
        $res = Db::name('s_record')->where('circle_id', $cid)->where('theme_id', $tid)->join("s_user","s_user.uid = s_record.uid")->where('type_id',1)->order("update_time desc")->limit(30)->select();
		if($res)
		{   $all=count($res);
			for($i=0;$i<$all;$i++)
			{
				$resLike = Db::name('s_record_like')->join("s_user","s_user.uid = s_record_like.like_uid")->where('record_id', $res[$i]['record_id'])->field('user_logo,uid')->limit(30)->select();
				$res[$i]['like']= $resLike;
				$isLike =Db::name('s_record_like')->where("like_uid",$uid)->where("record_id",$res[$i]['record_id'])->find();
				if($isLike){ $res[$i]['islike']= 1;}else{ $res[$i]['islike']=0;}
				$resComment = Db::name('s_record_comment')->join("s_user","s_user.uid = s_record_comment.comment_uid")->where('record_id', $res[$i]['record_id'])->field('user_logo,user_name,uid,comment_content,comment_id')->limit(30)->select();
				$res[$i]['comment']= $resComment;
				$resMark = Db::name('s_record_mark')->join("s_user","s_user.uid = s_record_mark.teacher_id")->where('record_id', $res[$i]['record_id'])->field('user_logo,user_name,uid,mark_content,mark_id,score')->limit(30)->select();
				$res[$i]['mark']= $resMark;
			}
			return $res;
		}else{ return $res;}			
	}
	
	public function getBookDairyList($bid,$sid,$uid)
	{
        $res = Db::name('s_record')->where('circle_id',$bid)->where('theme_id',$sid)->join("s_user","s_user.uid = s_record.uid")->where('type_id',2)->order("update_time desc")->limit(30)->select();
		if($res)
		{   $all=count($res);
			for($i=0;$i<$all;$i++)
			{
				$resLike = Db::name('s_record_like')->join("s_user","s_user.uid = s_record_like.like_uid")->where('record_id', $res[$i]['record_id'])->field('user_logo,uid')->limit(30)->select();
				$res[$i]['like']= $resLike;
				$isLike =Db::name('s_record_like')->where("like_uid",$uid)->where("record_id",$res[$i]['record_id'])->find();
				if($isLike){ $res[$i]['islike']= 1;}else{ $res[$i]['islike']=0;}
				$resComment = Db::name('s_record_comment')->join("s_user","s_user.uid = s_record_comment.comment_uid")->where('record_id', $res[$i]['record_id'])->field('user_logo,user_name,uid,comment_content,comment_id')->limit(30)->select();
				$res[$i]['comment']= $resComment;
				$resMark = Db::name('s_record_mark')->join("s_user","s_user.uid = s_record_mark.teacher_id")->where('record_id', $res[$i]['record_id'])->field('user_logo,user_name,uid,mark_content,mark_id,score')->limit(30)->select();
				$res[$i]['mark']= $resMark;
			}
			return $res;
		}else{ return $res;}			
	}
	
	
	public function getInfo($uid,$token)
	{
         $res = Db::name('s_user')->where('uid', $uid)->where('token', $token)->find();
		 if($res){
			 $resIelts= Db::name('s_user_ielts')->where('uid', $uid)->where('state', 1)->select();//雅思英语
			 $resCourse= Db::name('s_user_course')->where('uid', $uid)->where('state', 1)->select();//情景英语
			 $res['useIelts']=count($resIelts);
			 $res['useCourse']=count($resCourse);
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
	
	public function delDiary($rid,$uid)
	{
		$resUser =  Db::name('s_user')->where('uid',$uid)->find();
		$res =  Db::name('s_record')->where('record_id',$rid)->find();
		if($res){
			if($res['uid']==$uid)
			{
				 $de=Db::name('s_record')->where('record_id',$rid)->delete();
			     return 1;
			}else if($resUser['isteacher']==1){
				 $de=Db::name('s_record')->where('record_id',$rid)->delete();
			     return 1;				
			}else{
				return 2;
			}
			
		}else{
			return 0;
		}
		
	}
	
	public function delMark($rid,$uid)
	{
		$resUser =  Db::name('s_user')->where('uid',$uid)->find();
		$res =  Db::name('s_record_mark')->where('mark_id',$rid)->find();
		if($res){
			if($res['teacher_id']==$uid)
			{
				 $de=Db::name('s_record_mark')->where('mark_id',$rid)->delete();
			     return 1;
			}else if($resUser['isteacher']==1){
				$de=Db::name('s_record_mark')->where('mark_id',$rid)->delete();
			     return 1;				
			}else{
				return 2;
			}
			
		}else{
			return 0;
		}
		
	}
	
	public function delComment($rid,$uid)
	{
		$resUser =  Db::name('s_user')->where('uid',$uid)->find();
		$res =  Db::name('s_record_comment')->where('comment_id',$rid)->find();
		if($res){
			if($res['comment_uid']==$uid)
			{
				 $de=Db::name('s_record_comment')->where('comment_id',$rid)->delete();
			     return 1;
			}else if($resUser['isteacher']==1){
				 $de=Db::name('s_record_comment')->where('comment_id',$rid)->delete();
			     return 1;				
			}else{
				return 2;
			}
			
		}else{
			return 0;
		}
		
	}	
	
	
	public function getCourseType()
	{
         return Db::name('s_type')->where('is_show',1)->select();
	
	}
	
	public function getCourseRecord($uid,$typeId,$typeCn)
	{
       if($typeCn=="course")
	   { 
           $card =  Db::name('s_user_course')->join("s_course","s_course.course_id =s_user_course.course_id")->where('uid',$uid)->where('state',1)->where("s_user_course.course_type",$typeId)->select();
	       return $card;
		   
	   }else if($typeCn=="ielts"){
           $card =  Db::name('s_user_ielts')->join("s_ielts","s_ielts.ielts_id =s_user_ielts.ielts_id")->where('uid',$uid)->where('state',1)->where("s_user_ielts.course_type",$typeId)->select();
	       return $card;		   
	   }
	   else{
		   $arr=[];
		   return $arr;
	   }
	
	}

	public function like($rid,$uid)
	{
		$res =  Db::name('s_record_like')->where('like_uid',$uid)->where('record_id',$rid)->find();
		if($res)
		{
			$res2 = Db::name('s_record_like')->where('like_id',$res['like_id'])->delete();
			$arr= ["isLike"=>0];
			return $arr;
		}else{
			$data=["like_uid"=>$uid,"record_id"=>$rid,"time"=>time()];
			$res2 = Db::name('s_record_like')->insertGetId($data);
			$arr= ["isLike"=>1];
			return $arr;
		}
	}
	
	public function comment($data)
	{
			$res2 = Db::name('s_record_comment')->insertGetId($data);
			$arr= ["isComment"=>1];
			return $arr;		
		
	}
	
	public function mark($data)
	{
			$res2 = Db::name('s_record_mark')->insertGetId($data);
			$arr= ["isMark"=>1];
			return $arr;		
		
	}
	
	public function diary($data,$id)
	{
	   $res2 = Db::name('s_record')->insertGetId($data);
	   if($data['type_id']==1)
	   {   $arr=["last_update"=>time()];
		   $res = Db::name('s_circle')->where("circle_id",$id)->update($arr);
	   }
	   $arr= ["isDo"=>1];
	   return $arr;		
	}
	
	public function bonus($uid,$type,$tid)
	{
		//$type 1 -主题打卡  2-阅读打卡  3-阅读90s
		
		// 1 -主题打卡  是否存在记录; 是 不执行操作; 否 新增记录 ,执行加分操作
		// 2 -阅读打卡  是否存在记录;是 不执行操作; 否 新增记录; 是否存在加分记录; 是,不执行操作 ; 否， 判断 3 阅读90s  两者同时存在 则 执行加分操作 新增记录	
		// 3 -阅读90s   是否存在记录;是 不执行操作; 否 新增记录; 是否存在加分记录; 是,不执行操作 ; 否， 判断 2 阅读打卡 两者同时存在 则 执行加分操作 新增记录
		
		if($type==1)
		{         
     	   $res =  Db::name('s_record_log')->where('uid',$uid)->where('tid',$tid)->where('type',$type)->find();
		   if(!$res){
			   $resv = Db::name('s_bonus_active')->where('bid',2)->find();
			   $data=["uid"=>$uid,"type"=>$type,"tid"=>$tid,"time"=>time(),"date"=>date("Y-m-d")] ;
			   $res2 = Db::name('s_record_log')->insertGetId($data);
			   $data=["uid"=>$uid,"cbonus"=>$resv['points'],"source"=>$resv['activeName'],"activeName"=>$resv['bonusName'],"time"=>time(),'ctype'=>2,"gid"=>$tid,"orderId"=>1] ;
			   $res3 = Db::name('s_bonus_log')->insertGetId($data);
			   $res4 =  Db::name('s_user')->where('uid',$uid)->find();
			   $bonus =$res4['bonus']+$resv['points'];
			   $data=['bonus'=>$bonus];
			   $res5 =  Db::name('s_user')->where('uid',$uid)->update($data);
		   }
		   return 1;
		 }else if($type==2){
			   $res =  Db::name('s_record_log')->where('uid',$uid)->where('tid',$tid)->where('type',2)->find();
			   if(!$res){
			      $data=["uid"=>$uid,"type"=>$type,"tid"=>$tid,"time"=>time(),"date"=>date("Y-m-d")] ;
			      $res2 = Db::name('s_record_log')->insertGetId($data);				 
				 
			   }
			   $res3 =  Db::name('s_record_log')->where('uid',$uid)->where('tid',$tid)->where('type',3)->find();
			   if($res3){
				   $res4 =  Db::name('s_bonus_log')->where('uid',$uid)->where('ctype',2)->where('gid',$tid)->where('orderId',2)->find();
				   if(!$res4){
			       $resv = Db::name('s_bonus_active')->where('bid',4)->find();
			       $data=["uid"=>$uid,"cbonus"=>$resv['points'],"source"=>$resv['activeName'],"activeName"=>$resv['bonusName'],"time"=>time(),'ctype'=>2,"gid"=>$tid,"orderId"=>2] ;
			       $res3 = Db::name('s_bonus_log')->insertGetId($data);
			       $res4 =  Db::name('s_user')->where('uid',$uid)->find();
			       $bonus =$res4['bonus']+$resv['points'];
			       $data=['bonus'=>$bonus];
			       $res5 =  Db::name('s_user')->where('uid',$uid)->update($data);
				   }
			   }
			  return 2;
		 }else if($type==3){
			   $res =  Db::name('s_record_log')->where('uid',$uid)->where('tid',$tid)->where('type',3)->find();
			   if(!$res){
			      $data=["uid"=>$uid,"type"=>$type,"tid"=>$tid,"time"=>time(),"date"=>date("Y-m-d")] ;
			      $res2 = Db::name('s_record_log')->insertGetId($data);				 
				 
			   }
			   $res3 =  Db::name('s_record_log')->where('uid',$uid)->where('tid',$tid)->where('type',2)->find();
			   if($res3){
				   $res4 =  Db::name('s_bonus_log')->where('uid',$uid)->where('ctype',2)->where('gid',$tid)->where('orderId',2)->find();
				   if(!$res4){
			       $resv = Db::name('s_bonus_active')->where('bid',4)->find();
			       $data=["uid"=>$uid,"cbonus"=>$resv['points'],"source"=>$resv['activeName'],"activeName"=>$resv['bonusName'],"time"=>time(),'ctype'=>2,"gid"=>$tid,"orderId"=>2] ;
			       $res3 = Db::name('s_bonus_log')->insertGetId($data);
			       $res4 =  Db::name('s_user')->where('uid',$uid)->find();
			       $bonus =$res4['bonus']+$resv['points'];
			       $data=['bonus'=>$bonus];
			       $res5 =  Db::name('s_user')->where('uid',$uid)->update($data);
				   }
			   }	
              return 3;			   
		 }else{
			  return 4;
		 }
	
		
	}

}
?>