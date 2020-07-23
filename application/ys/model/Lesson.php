<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Lesson extends Model
{
   

	
	public function getLessonList()
	{
        $res = Db::name('y_lesson')->where("isShow",1)->select();
        return $res;		
		
	}



}
?>