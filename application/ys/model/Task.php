<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Task extends Model
{
   

	

	
	public function getUserTaskList($uid,$type)
	{
		/**$res = Db::name('y_homework_list')->where('etype', $type)->where("isShow",1)->select();
		if($res)
		{
			  //$HWArr=[]; array_push($HWArr,$res[$i]['hid']);
			 $str ="";
			for($i=0;$i<count($res);$i++)
			{ if($i==0){
			      $str=$res[$i]['hid'];
			  }else{
				  $str=$str.",".$res[$i]['hid'];
			  }
			}
		}else{
			return 0;
		}
		
		$resv = Db::name('y_user_homework')->where('hid',"in", $str)->select();
		if($resv)
		{   //$HWArr=[];
	        $str ="";
            for($i=0;$i<count($resv)-1;$i++)
			{ 
              if($i==0){
			      $str=$res[$i]['hid'];
			  }else{
				  $str=$str.",".$res[$i]['hid'];
			  }
			}			
		}**/
		$reso = Db::name('y_homework_list')->where('etype', $type)->select();//->where('hid',"in", $str)
		//->join("y_homework_list","y_homework_list.hid = y_user_homework.hid")
		return $reso;
		
	}
	
	public function getUserCorrect($uid,$hid)
	{
		$res = Db::name('y_user_homework')->where('uid',$uid)->where("hid",$hid)->find();
		if($res){
			if($res['rsid'])
			{
				$res = Db::name('y_homework_correct')->join('y_correct','y_correct.cid=y_homework_correct.type')->where('hsid', $res['rsid'])->find();
				if($res)
				{
					return $res;
				}else{
					return 0;
				}	
			}else{
				return 0;
			}
			
		}else{
			return 0;
		}
		
	}
	
	public function getHomeWorkList($uid,$type)
	{
		$res = Db::name('y_homework_list')->where('etype',$type)->select();
		return $res;
		
	}
	public function uploadHomeWork($uid,$arr)
	{
		$res = Db::name('y_user_homework')->where('uid',$uid)->where('hid',$arr['hid'])->find();
		if(!$res){
			$resv = Db::name('y_user_homework')->insertGetId($arr);
		}else{
			
			$resv = Db::name('y_user_homework')->where("huid",$res['huid'])->update($arr);
		}
		return 1;		
	}
	
	public function getHomeWorkInfo($hid)
	{
		$res = Db::name('y_homework_list')->where('hid',$hid)->find();
		 return $res;
	}
	
	public function readSpeak($uid,$hid)
	{
	   $res = Db::name('y_user_homework')->where('uid',$uid)->where('hid',$hid)->find();
       return $res;	  
	}
	

}
?>