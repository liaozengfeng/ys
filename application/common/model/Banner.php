<?php 
namespace app\common\model;

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
        $res = Db::name('s_banner')->select();
        return $res;		
		
	}

	public function getBannerInfo($id)
	{
        $res = Db::name('s_banner')->where('bannder_id', $id)->find();
        return $res;		
		
	}
	

	public function getGiftBannerList()
	{
        $res = Db::name('s_giftbanner')->where('gbIsShow', 1)->select();
        return $res;		
		
	}

}
?>