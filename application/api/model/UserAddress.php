<?php 
namespace app\api\model;
use think\Model;
use think\Db;
/**
 * 
 */
class UserAddress extends Model
{
	public function newAddres($data){
		$res=Db::name('s_user_address')->insertGetId($data);
		return $res;
	}
	public function modaddress($uid){
		$res=Db::name('s_user_address')->where('uid',$uid)->update(['isDefault'=>0]);
		return $res;
	}
	public function getOne($data){
		$res=Db::name('s_user_address')->where($data)->find();
		return $res;
	}
	public function getList($uid){
		$res=Db::name('s_user_address')->where('uid',$uid)->order('isDefault desc')->order('aid desc')->select();
		return $res;
	}
	public function modress($arr,$data){
		$res=Db::name('s_user_address')->where($arr)->update($data);
		return $res;
	}
	
	public function delAddress($arr){
		$res=Db::name('s_user_address')->where($arr)->delete();
		return $res;
	}
	public function getDefault($uid){
		$res=Db::name('s_user_address')->order('isDefault desc')->order('aid desc')->where('uid',$uid)->find();
		return $res;
	}
}