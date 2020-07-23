<?php 
namespace app\api\model;
use think\Model;
use think\Db;
/**
 * 
 */
class Gift extends Model
{
	public function getGift(){
		$info=Db::name('s_gift')->where('isShow',1)->select();
		return $info;
	}
	public function getOne($gid){
		$info=Db::name('s_gift')->where('gid',$gid)->where('isShow',1)->find();
		return $info;

	}
	public function getOnel($gid){
		$info=Db::name('s_gift')->where('gid',$gid)->find();
		return $info;

	}
	
}