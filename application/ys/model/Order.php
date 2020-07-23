<?php 
namespace app\ys\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Order extends Model
{
    public function makeOrder($data)
   {
		return  Db::name('y_user_order')->insertGetId($data);
		  
   }

    public function updateOrder($orderID,$data)
   {
		  
		return  Db::name('y_user_order')->where("orderId",$orderID)->update($data);  
   }
   
}
?>