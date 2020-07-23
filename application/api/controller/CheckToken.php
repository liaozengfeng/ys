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
namespace app\api\controller;
use think\Db;
use think\Request;
use think\Loader;
use think\Controller;

class CheckToken extends Controller
{

    /**
     * 当前请求实例
     * @var Request
     */
    protected $uid;
	protected $token;
	protected $isCheck;

    /**
     * 类架构函数
     * Auth constructor.
     */
    public function __construct($uid,$token)
    {   $this->isCheck = 1;
        $this->uid = $uid;
        $this->token = $token;
    }
    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return \think\Request
     */
    public  function check()
    {  if($this->isCheck){
        $user =$this->getUserInfo();
	    if(!$user){
			  return 0;
		 }else{
			 return $user;
		 }
	  }
    }

	 //获取用户信息
    protected function getUserInfo()
    {     
         return Db::name('s_user')->where('uid', $this->uid)->where('token', $this->token)->find();
    }
	
	protected function updateToken()
	{
		
		
	}
    
    public function return_msg($code, $msg = '', $data = []) {
    /*********** 组合数据  ***********/
    $return_data['code'] = $code;
    $return_data['msg']  = $msg;
    $return_data['data'] = $data;
    /*********** 返回信息并终止脚本  ***********/
    echo json_encode($return_data);die;
}	
	
}