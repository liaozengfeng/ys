<?php 
namespace app\common\model;

use think\Model;
use think\Db;

//登录权限验证
//星钻处理

class Event extends Model
{

    public function getEventList()
    {

        $res = Db::name('s_event')->order('event_id desc')->select();

        return $res;
    }
	

	
	public function getEventInfo($id,$uid)
	{
	    
		$res = Db::name('s_event')->where('event_id',$id)->find();
		$res2 = Db::name('s_user_event')->where('event_id',$id)->where('uid',$uid)->find();
		if($res2)
		{
			$res['enroll']=1;
		}else{
			$res['enroll']=0;
		}
		
        return $res;	
	}
	
	public function enroll($data,$uid,$id)
	{
		$res = Db::name('s_user_event')->where('event_id',$id)->where('uid',$uid)->find();
		if(!$res)
		{
			$res2 = Db::name('s_user_event')->insertGetId($data);;
            return $res2;
		}else{
			$arr= [];
			return $arr;
		}
       
	}

	
}
?>