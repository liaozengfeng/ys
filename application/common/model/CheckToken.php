<?php
// +----------------------------------------------------------------------
// | ThinkPHP 5 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.zzstudio.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Byron Sampson <xiaobo.sun@gzzstudio.net>
// +----------------------------------------------------------------------
namespace app\common\model;
use think\Db;
use think\Request;
use think\Loader;

class CheckToken extends Controller 
{

    /**
     * 当前请求实例
     * @var Request
     */
    protected $uid;
	protected $token;

    /**
     * 类架构函数
     * Auth constructor.
     */
    public function __construct($uid,$token)
    { 
        $this->uid = $uid;
        $this->token = $token;
    }
    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return \think\Request
     */
    public static function check()
    {
      $user =$this->getUserInfo();
	  if(!$user)
	  {
		  $this->error("token 错误!");
	  }
  
    }

	 //获取用户信息
    protected function getUserInfo()
    {     
           return Db::name('s_user')->where('uid', $this->uid)->where('token', $this->token)->find();
    }
    
	
	
}