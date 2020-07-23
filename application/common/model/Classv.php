<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Classv extends Model
{
   
	public function addClass($data)
	{
		
		 $res=Db::name('s_vclass')->where('className',$data['className'])->find();
		 if($res){
		     return 0;
		 }else{
			return  Db::name('s_vclass')->insertGetId($data);
		 }		 		
		
	}

	
	public function editClass($data,$id)
	{
		
		 $res=Db::name('s_vclass')->where('vcId',$id)->find();
		 if($res){
		     return Db::name('s_vclass')->where('vcId',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
		
	}
	
	public function delClass($id)
	{
		$res=Db::name('s_vclass')->where('vcId',$id)->find();
		if($res){
			$de=Db::name('s_vclass')->where('vcId',$id)->delete();
			return 1;
		}else{
			return 0;
		}
		
	}


}
?>