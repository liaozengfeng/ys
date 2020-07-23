<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Game extends Model
{
   public function uploadSelf($arr,$uid)
   {
        $date=date("Y-m-d",time());	
		$res = Db::name('s_self')->insertGetId($arr);	
		/**
		if($res){
		$game=Db::name('c_game')->where('uid', $uid)->where('is_finish',0)->where("date",$date)->find();
		if($game)
		{
			$updateGame=["p2"=>0,"p2_detail"=>$res];
			$resv = Db::name('c_game')->where("game_id",$game['game_id'])->update($updateGame);
		}else{
			if($uid>0){
			$updateGame=["uid"=>$uid,"p2"=>0,"p2_detail"=>$res,"date"=>$date,"update_time"=>time()];
			$resv = Db::name('c_game')->insertGetId($updateGame);	
			}			
		}	
	   }**/	
		return $res;	   
   }


}
?>