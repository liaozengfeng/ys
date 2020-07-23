<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Ieltsv extends Model
{
   
	public function upload($data)
	{	
	    return  Db::name('s_ielts_info')->insertGetId($data);
	 				
	}

	public function check($id)
	{
		
		return Db::name('s_ielts')->where('ielts_id',$id)->find();
	}

	public function checkv($id)
	{
		
		return Db::name('s_ielts_info')->where('info_id',$id)->find();
	}

	public function checkRoom($id)
	{
		
		return Db::name('s_room')->where('rid',$id)->find();
	}
	
	public function edit($data,$id)
	{
		 $res=Db::name('s_ielts_info')->where('info_id',$id)->find();
		 if($res){
		     return Db::name('s_ielts_info')->where('info_id',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
		
	}
	
	public function delCourse($id)
	{
		$res=Db::name('s_ielts_info')->where('info_id',$id)->find();
		if($res){
			$de=Db::name('s_ielts_info')->where('info_id',$id)->delete();
			return 1;
		}else{
			return 0;
		}
		
	}
	
	public function change($id,$attence)
	{    
	     $data=["attence"=>$attence];
		 $res=Db::name('s_ielts_info')->where('info_id',$id)->find();
		 if($res){
		     return Db::name('s_ielts_info')->where('info_id',$id)->update($data);
		 }else{
			 return $res;
		 }		 		
	}


}
?>