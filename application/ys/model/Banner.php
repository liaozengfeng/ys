<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Banner extends Model
{
   

	
	public function getBannerList()
	{
        $res = Db::name('y_banner')->select();
        return $res;		
		
	}

	public function getBannerInfo($id)
	{
        $res = Db::name('y_banner')->where('bannerId', $id)->find();
        return $res;		
		
	}
	


}
?>