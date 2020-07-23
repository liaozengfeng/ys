<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Manage extends Model
{
   
    public function reportAdd($arr,$title)
	{
		$res =Db::name("y_homework_list")->where("title",$title)->find();
		if($res){
			$resv =Db::name("y_homework_list")->insertGetId($arr);
			return 1;
		}else{
			$resv =Db::name("y_homework_list")->insertGetId($arr);
			return 1;
		}
	
	}
	
    public function reportEdit($arr,$id)
	{
		$res =Db::name("y_homework_list")->where("hid",$id)->find();
		if($res){
			$resv =Db::name("y_homework_list")->where("hid",$id)->update($arr);
			return 1;
		}else{
			return 0;
		}
	
	}
	
	
	public function reportDelete($id)
	{  $res =Db::name("y_homework_list")->where("hid",$id)->find();
	   if($res){
		 $res =Db::name("y_homework_list")->where("hid",$id)->delete();
	     return 1;
		 }else{
		  return 1;
	     }
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
	
	public function correctReport($array,$id)
	{
		$res =Db::name('y_user_homework')->where('huid',$id)->find();
		if($res){
			if($res['rsid'])
			{   
		        // $revs =Db::name('y_homework_correct')->where("hsid",$res['rsid'])->find();
				 
				return Db::name('y_homework_correct')->where("hsid",$res['rsid'])->update($array);
			}else{			
				$v = Db::name('y_homework_correct')->insertGetId($array);
				$rs =["rsid"=>$v];
				$resv =Db::name('y_user_homework')->where('huid',$id)->update($rs);
				return 1;
			}
			
		}else{
			return 0;
		}
		
	}
	
}
?>