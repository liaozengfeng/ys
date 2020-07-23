<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class News extends Model
{
   

	
	public function getNewsList($type)
	{
        $res = Db::name('y_news')->where("newsType",$type)->field("newsId,newsTitle,newsType,newsCover,author,isWx")->select();
        return $res;		
		
	}

	public function getNewsInfo($id)
	{
        $res = Db::name('y_news')->where('newsId', $id)->find();
        return $res;		
		
	}
	
	public function searchList($key)
	{
        $res = Db::name('y_news')->where('newsTitle','like',"%{$key}%")->field("newsId,newsTitle,newsType,newsCover,author,isWx")->select();
        return $res;		
		
	}
	

}
?>