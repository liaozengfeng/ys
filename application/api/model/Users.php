<?php 
namespace app\api\model;
use think\Model;
use think\Db;
/**
 * 
 */
class Users extends Model
{
	protected $table = 's_user';
	public function getOne($uid){
		$info=Db::name('s_user')->where('uid',$uid)->find();
		return $info;

	}
	public function degral($uid,$bonus){
		$info=Db::name('s_user')->where('uid',$uid)->setDec('bonus',$bonus);
		return $info;

	}
	
}