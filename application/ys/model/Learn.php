<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Learn extends Model
{
   

	

	
	public function getThemeList($cid,$uid,$ysType)
	{
		$resv = Db::name('y_user_learn')->where('b_lid', $cid)->where('b_uid', $uid)->find();
		if($resv){
		$resu=  Db::name('y_user')->where('uid', $uid)->find();
		$lv=$resu['lv'];
		if($ysType==0){
        $res = Db::name('y_learn_theme')->where('cid', $cid)->where('lv', $lv)->order("tid asc")->field("tid,themeName,themeCover,themeCover2,ysType")->select();
		}else{
		 $res = Db::name('y_learn_theme')->where('cid', $cid)->where('lv', $lv)->where('ysType', $ysType)->order("tid asc")->field("tid,themeName,themeCover,themeCover2,ysType")->select();
			
		}
		////isread = 1/0
		$all = count($res);
		for($i=0;$i<$all;$i++)
		{
			$c = Db::name("y_record")->where("uid",$uid)->where("tid",$res[$i]['tid'])->find();
			if($c){
				$res[$i]['is_read']=1;
			}else{
				$res[$i]['is_read']=0;
			}
			
		}}else{
			$res=[];
		}
        return $res;		
		
	}
	
	public function getThemeInfo($id)
	{
        $res = Db::name('y_learn_theme')->where('tid', $id)->find();
        return $res;		
		
	}
	
	public function getDairyList($cid,$tid,$uid)
	{
        $res = Db::name('y_record')->where('cid', $cid)->where('tid', $tid)->join("y_user","y_user.uid = y_record.uid")->order("updateTime desc")->limit(30)->select();
		if($res)
		{   $all=count($res);
			for($i=0;$i<$all;$i++)
			{
				$resLike = Db::name('y_record_like')->join("y_user","y_user.uid = y_record_like.likeUid")->where('rid', $res[$i]['rid'])->field('logo,uid')->limit(30)->select();
				$res[$i]['like']= $resLike;
				$isLike =Db::name('y_record_like')->where("likeUid",$uid)->where("rid",$res[$i]['rid'])->find();
				if($isLike){ $res[$i]['islike']= 1;}else{ $res[$i]['islike']=0;}
				$resComment = Db::name('y_record_comment')->join("y_user","y_user.uid = y_record_comment.commentUid")->where('rid', $res[$i]['rid'])->field('logo,nickName,uid,commentContent,commentId')->limit(30)->select();
				$res[$i]['comment']= $resComment;
				$resMark = Db::name('y_record_mark')->join("y_user","y_user.uid = y_record_mark.teacherId")->where('rid', $res[$i]['rid'])->field('logo,nickName,uid,markContent,markId,score')->limit(30)->select();
				$res[$i]['mark']= $resMark;
			}
			return $res;
		}else{ return $res;}			
	}
	

	
	
	public function delDiary($rid,$uid)
	{
		$resUser =  Db::name('y_user')->where('uid',$uid)->find();
		$res =  Db::name('y_record')->where('rid',$rid)->find();
		if($res){
			if($res['uid']==$uid)
			{
				 $de=Db::name('y_record')->where('rid',$rid)->delete();
			     return 1;
			}else if($resUser['isTeacher']==1){
				 $de=Db::name('y_record')->where('rid',$rid)->delete();
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
		$resUser =  Db::name('y_user')->where('uid',$uid)->find();
		$res =  Db::name('y_record_mark')->where('markId',$rid)->find();
		if($res){
			if($res['teacherId']==$uid)
			{
				 $de=Db::name('y_record_mark')->where('markId',$rid)->delete();
			     return 1;
			}else if($resUser['isTeacher']==1){
				$de=Db::name('y_record_mark')->where('markId',$rid)->delete();
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
		$resUser =  Db::name('y_user')->where('uid',$uid)->find();
		$res =  Db::name('y_record_comment')->where('commentId',$rid)->find();
		if($res){
			if($res['commentUid']==$uid)
			{
				 $de=Db::name('y_record_comment')->where('commentId',$rid)->delete();
			     return 1;
			}else if($resUser['isTeacher']==1){
				 $de=Db::name('y_record_comment')->where('commentId',$rid)->delete();
			     return 1;				
			}else{
				return 2;
			}
			
		}else{
			return 0;
		}
		
	}	
	
	

	public function like($rid,$uid)
	{
		$res =  Db::name('y_record_like')->where('likeUid',$uid)->where('rid',$rid)->find();
		if($res)
		{
			$res2 = Db::name('y_record_like')->where('likeId',$res['likeId'])->delete();
			$arr= ["isLike"=>0];
			return $arr;
		}else{
			$data=["likeUid"=>$uid,"rid"=>$rid,"time"=>time()];
			$res2 = Db::name('y_record_like')->insertGetId($data);
			$arr= ["isLike"=>1];
			return $arr;
		}
	}
	
	public function comment($data)
	{
			$res2 = Db::name('y_record_comment')->insertGetId($data);
			$arr= ["isComment"=>1];
			return $arr;		
		
	}
	
	public function mark($data)
	{
			$res2 = Db::name('y_record_mark')->insertGetId($data);
			$arr= ["isMark"=>1];
			return $arr;		
		
	}
	
	public function diary($data)
	{
	   $res2 = Db::name('y_record')->insertGetId($data);
	   $arr= ["isDo"=>1];
	   return $arr;		
	}

}
?>