<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Room extends Model
{
   
	public function addRoom($data)
	{
		
		 $res=Db::name('s_room')->where('roomName',$data['roomName'])->find();
		 if($res){
		     return 0;
		 }else{
			return  Db::name('s_room')->insertGetId($data);
		 }		 		
		
	}

	
	public function editRoom($data,$id)
	{
		
		 $res=Db::name('s_room')->where('rid',$id)->find();
		 if($res){
		     return Db::name('s_room')->where('rid',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
		
	}
	
	public function delRoom($id)
	{
		$res=Db::name('s_room')->where('rid',$id)->find();
		if($res){
			$de=Db::name('s_room')->where('rid',$id)->delete();
			return 1;
		}else{
			return 0;
		}
		
	}


}
?>