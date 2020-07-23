<?php 
namespace app\common\model;

use think\Model;
use think\Db;

//登录权限验证
//星钻处理

class News extends Model
{

    public function getNews($id)
    {
        $res = Db::name('un_news')->where('news_id', $id)->find();
		//星钻获取
        return $res;
    }

    public function getIndexNewsList()
    {
        $res = Db::name('un_news')->field(['news_id','news_type','news_title','news_time','news_cover'])->select();
        return $res;
    }
	
    public function getEventNewsList()
    {
        $res = Db::name('un_news')->where('news_type', 2)->field(['news_id','news_type','news_title','news_cover'])->select();
        return $res;
    }
	
    public function getOfficalNewsList()
    {
        $res = Db::name('un_news')->where('news_type', 1)->field(['news_id','news_type','news_title','news_cover'])->select();
        return $res;
    }
	
    public function getUserNewsList($uid)
    {  

		$res = Db::table('un_user_news')->where('uid', $uid )->alias('a')->join('un_news w','a.news_id = w.news_id')->field(['a.uid','w.news_id','w.news_type','w.news_title','w.news_cover'])->select();   
	    return $res;
    }
	
	
	public function getBannerNews()
	{
        $res = Db::name('un_banner')->field(['banner_id','banner_title','banner_cover'])->select();
        return $res;		
		
	}
	
	public function getBannerDetail($id)
	{
	     $res = Db::name('un_banner')->where('banner_id',$id)->find();
        return $res;		
	}
	
	public function userFocus($uid,$id)
	{  
	  
	   $res = Db::name('un_user_news')->where('news_id', $id)->where('uid', $uid)->find();
	   if(!$res){
	   $time= time();
	   $data = ['uid' => $uid,'news_id' => $id,'focus_time'=>$time];
       Db::name('un_user_news')->insert($data);
	    return 'follow_success';
	   }else{
		Db::table('un_user_news')->where('id',$res['id'])->delete();
		return 'unfollow_success';
	   }
	}
}
?>