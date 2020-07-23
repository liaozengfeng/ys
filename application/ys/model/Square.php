<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Square extends Model
{
   

	

	
	public function getList($type,$uid)
	{
		if($type==0){
			$resv = Db::name('y_square')->join("y_user","y_user.uid = y_square.uid")->where("isShow",1)->order('isTop desc')->order('updateTime desc')->select();
				
		}else{
		     $resv = Db::name('y_square')->join("y_user","y_user.uid = y_square.uid")->where("isShow",1)->where('type',"like","%{$type}%")->order('isTop desc')->order('updateTime desc')->select();}
				if($resv){
					 for($i=0;$i<count($resv);$i++){
						  if($uid){
				         $isLike =Db::name('y_square_like')->where("likeUid",$uid)->where("sid",$resv[$i]['sid'])->find();
					     if($isLike){ $resv[$i]['islike']= 1;}else{ $resv[$i]['islike']=0;}
						  }else{
				           $resv[$i]['islike']=0;	 
				             }
					 }
				}
        return $resv;		
	}
	
	public function getInfo($uid,$id)
	{
        $res = Db::name('y_square')->join("y_user","y_user.uid = y_square.uid")->where('sid', $id)->find();
		if($res){
            $resLike = Db::name('y_square_like')->join("y_user","y_user.uid = y_square_like.likeUid")->where('sid', $res['sid'])->field('logo,uid')->select();
			    $res['likeNum'] =count($resLike);
				$res['like']= $resLike;
				 if($uid){
				$isLike =Db::name('y_square_like')->where("likeUid",$uid)->where("sid",$res['sid'])->find();
				if($isLike){ $res['islike']= 1;}else{ $res['islike']=0;}
				 }else{
				    $res['islike']=0;	 
				 }
				$resComment = Db::name('y_square_comment')->join("y_user","y_user.uid = y_square_comment.commentUid")->where('sid', $res['sid'])->field('logo,nickName,uid,commentContent,commentId')->limit(30)->select();
				$res['comment']= $resComment;			
		}
        return $res;		
		
	}
	
	public function searchList($key,$uid)
	{
		$resv = Db::name('y_square')->join("y_user","y_user.uid = y_square.uid")->where('title',"like","%{$key}%")->select();
				if($resv){
					 for($i=0;$i<count($resv);$i++){
						  if($uid){
				         $isLike =Db::name('y_square_like')->where("likeUid",$uid)->where("sid",$resv[$i]['sid'])->find();
					     if($isLike){ $resv[$i]['islike']= 1;}else{ $resv[$i]['islike']=0;}
						  }else{
				           $resv[$i]['islike']=0;	 
				             }
					 }
				}
        return $resv;			
	}
	


	
	
	public function delTopic($sid,$uid)
	{
		$resUser =  Db::name('y_user')->where('uid',$uid)->find();
		$res =  Db::name('y_square')->where('sid',$sid)->find();
		if($res){
			if($res['uid']==$uid)
			{
				 $de=Db::name('y_square')->where('sid',$sid)->delete();
			     return 1;
			}else if($resUser['isTeacher']==1){
				 $de=Db::name('y_square')->where('sid',$sid)->delete();
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
		$res =  Db::name('y_square_comment')->where('commentId',$rid)->find();
		if($res){
			if($res['commentUid']==$uid)
			{
				 $de=Db::name('y_square_comment')->where('commentId',$rid)->delete();
			     return 1;
			}else if($resUser['isTeacher']==1){
				 $de=Db::name('y_square_comment')->where('commentId',$rid)->delete();
			     return 1;				
			}else{
				return 2;
			}
			
		}else{
			return 0;
		}
		
	}	
	
	

	public function like($sid,$uid)
	{
		$res =  Db::name('y_square_like')->where('likeUid',$uid)->where('sid',$sid)->find();
		if($res)
		{
			$res2 = Db::name('y_square_like')->where('likeId',$res['likeId'])->delete();
			$arr= ["isLike"=>0];
			return $arr;
		}else{
			$data=["likeUid"=>$uid,"sid"=>$sid,"time"=>time()];
			$res2 = Db::name('y_square_like')->insertGetId($data);
			$arr= ["isLike"=>1];
			return $arr;
		}
	}
	
	public function setTop($sid,$uid)
	{   $resUser =  Db::name('y_user')->where('uid',$uid)->find();
		$res =  Db::name('y_square')->where('sid',$sid)->find();
		if($resUser['isTeacher']==1){
		if($res)
		{    if($res['isTop']==1){
			   $arr= ["isTop"=>1,"updateTime"=>time()];
		    }else{
			   $arr= ["isTop"=>1,"updateTime"=>time()];
			}
			$res2 = Db::name('y_square')->where('sid',$sid)->update($arr);
			
			return  $arr;
		}else{
			return 0;
		}
		}else{
			return 2;
		}
	}
	
	public function comment($data)
	{
			$res2 = Db::name('y_square_comment')->insertGetId($data);
			$arr= ["isComment"=>1];
			return $arr;		
		
	}
	

	
	public function diary($data)
	{
	   $res2 = Db::name('y_square')->insertGetId($data);
	   $arr= ["isDo"=>1];
	   return $arr;		
	}

}
?>