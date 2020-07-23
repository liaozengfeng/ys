<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class User extends Model
{
   public function getOpenid($uid)
   {
		$res=Db::name('y_user')->where('uid',$uid)->find();
		return $res['openId'];	 	   
   }

	
	public function getRule($id)
	{
		
		$res=Db::name('y_rule')->where('ruleId',$id)->find();
		return $res;	 		
	}	
	

    public function getUser($uid)
    {
        $res = Db::name('y_user')->where('uid', $uid)->find();
        return $res;       

    }
	

	public function addUser($data)
	{
        return  Db::name('y_user')->insertGetId($data);
         		
	}
	
	public function getUserInfo($openid)
	{
        $res = Db::name('y_user')->where('openId', $openid)->find();
        return $res;		
		
	}	
	
	public function getYsTest($uid)
	{
        $res = Db::name('y_revise')->where('isShow', 1)->order("num asc")->select();
        return $res;		
	}

    public function getYsScore($uid)
	{
		
	     $res = Db::name('y_user')->where('uid', $uid)->find();
		 $resR = Db::name('y_rule')->where('ruleId', 4)->find();
		 $resL = Db::name('y_rule')->where('ruleId', 5)->find();
		 if($res['isYsTest']==0){
			 $scv = explode(' ',$res['extraScore']);
			 if($scv[0]=="中考"){
				 if($scv[1]<90)
				 {
					  $sco = 3.5 ;
				 }else if($scv[1]<120){
					  $sco = 4 ;
				 }else{
					  $sco = 4.5 ; 
				 }
			 }else if($scv[0]=="高考"){
				 if($scv[1]<90)
				 {
					  $sco = 4.5 ;
				 }else if($scv[1]<110){
					  $sco = 5 ;
				 }else if($scv[1]<130){
					  $sco = 5.5 ;
				 }else{
					  $sco = 6 ; 
				 }				 
			 }else if($scv[0]=="四级"){
				 if($scv[1]<425)
				 {
					  $sco = 4.5 ;
				 }else if($scv[1]<480){
					  $sco = 5 ;
				 }else if($scv[1]<550){
					  $sco = 5.5 ;
				 }else if($scv[1]<600){
					  $sco = 6 ;
				 }else{
					  $sco = 6.5 ; 
				 }						 
			 }else if($scv[0]=="六级"){
				 if($scv[1]<425)
				 {
					  $sco = 5 ;
				 }else if($scv[1]<480){
					  $sco = 5.5 ;
				 }else if($scv[1]<550){
					  $sco = 6 ;
				 }else if($scv[1]<600){
					  $sco = 6.5 ;
				 }else{
					  $sco = 7 ; 
				 }						 
			 }else{
				  $sco = 5 ; 
			 }
		 }else{ 
		    $sco = $res['ysScore'];
		 }
		 if($res['testScore']<30)
		 {
			 $ti="outsider";
		 }else if($res['testScore']<50){
			 $ti="fresh";
		 }else if($res['testScore']<80){
			 $ti="junior";
		 }else{
			  $ti="senior";
		 }
		 
		  $resu = Db::name('y_user_order')->where('uid', $uid)->where('lessonId', 1)->where('state', 2)->find();
		  if($resu){
			  $isBuy = 1;
		  }else{
			  $isBuy = 0;
		  }
		   $resu2 = Db::name('y_user_order')->where('uid', $uid)->where('lessonId', 2)->where('state', 2)->find();
		   if($resu2){
			   $nowPrice2=88;
		   }else{
			   $nowPrice2=29.9;
		   }
		 $array =["know"=> $ti,"socre"=> $sco ,"item1"=>$resR['ruleContent'],"item2"=>$resL['ruleContent'],"isBuy"=>$isBuy ,"isBuy2"=>0,"OrginPirce"=>599 ,"nowPrice"=>199,"OrginPirce2"=>88,"nowPrice2"=>$nowPrice2];
        return  $array;			
	
	
	}
	
	public function  getRepeat($uid,$lessonId)
	{
		  $resu = Db::name('y_user_order')->where('uid', $uid)->where("lessonId",$lessonId)->where('state', 2)->find();
		  if($resu){
			  //if($lessonId==1){
			    $isBuy = 1;
			  //}else{
			  //$isBuy = 0;  
			 // }
		  }else{
			  $isBuy = 0;
		  }		
		  
		  return $isBuy;
	}
	
	public function getDays($uid)
	{
		$res = Db::name('y_user')->where('uid', $uid)->find();
		if(isset($res['sTime'])){
		$data['day'] = $res['sTime'];
		 $startdate=strtotime($res['sTime']);
         $enddate=time();
        $days=round(($enddate-$startdate)/3600/24) ;
		$data['day'] = $days;	
		}else{
		$data['day'] = 0;	
		}
		$data['targetScore'] = $res['targetScore'];
		$data['exDay']= $res['prepareTime']*30-$data['day'];
		if($res['testJson']){$data['isTest']= 1;}
		else{ $data['isTest']= 0;}
		return  $data;			
		
	}
	
	public function updateInfo($data,$uid)
	{
		
		 $res=Db::name('y_user')->where('uid',$uid)->find();
		 if($res){
		     return Db::name('y_user')->where('uid',$uid)->update($data);}
		 else{
			 return $res;
		 }		 		
		
	}
	
}
?>