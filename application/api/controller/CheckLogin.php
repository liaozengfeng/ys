<?php 
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\api\model\Users as UserModel;

/**
 * 
 */
class CheckLogin extends Controller
{
	//检查是否登录
    public function _initialize()
    {
        // $data=input();

         parent::_initialize();
         $data=$this->request->param();
         
        if (isset($data['uid']) and isset($data['token'])) {
            $arr=array(
                'uid'=>$data['uid'],
                'token'=>$data['token'],
            );
           $check=UserModel::where($arr)->find();
           if (!$check) {
               $json['code']=404;
                $json['msg']='token错误';
                echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
           }
        }else{
            $json['code']=404;
            $json['msg']='缺少uid或token';
            echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
        }
    }
}