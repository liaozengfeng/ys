<?php 
namespace app\api\model;
use think\Model;
use think\Db;
/**
 * 
 */
class UserOrder extends Model
{
	public function addrec($arr){
		$check=Db::name('s_user_order')->insertGetId($arr);
		return $check;

	} 
	
	public function updateOne($where,$arr){
		$check=Db::name('s_user_order')->where($where)->update($arr);
		return $check;

	}
	public function getOne($where){
		$check=Db::name('s_user_order')->where($where)->find();
		return $check;
	}

	
}