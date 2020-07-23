<?php 
namespace app\api\model;
use think\Model;
use think\Db;
/**
 * 
 */
class BonusLog extends Model
{
	protected $table = 's_bonus_log';
	public function add($data){
		$res=Db::name('s_bonus_log')->insertGetId($data);
		return $res;
	}
	public function GetoneLIst($uid){
		$check=Db::name('s_bonus_log')->where('uid',$uid)->order('time desc')->select();
		return $check;
	} 
	public function getOneRecord($data){
		$res=Db::name('s_bonus_log')->where($data)->find();
		return $res;
	}
	public function updateByWhere($where,$data)
    {
    	$result = Db::table('s_bonus_log')
		->alias('bl')
		->join('s_gift gi','bl.gid=gi.gid')
		->where($where)
		->update($data);
        
        if($result===false){
            return false;
        } else{
            return true;
        }
 
    }
    public function getLogRecord($data){
		$res=Db::table('s_bonus_log')->where($data)->find();
		// ->alias('bl')
		// ->join('s_gift gi','bl.gid=gi.gid')
		// ->where($data)
		// ->find();
		return $res;
	}
}