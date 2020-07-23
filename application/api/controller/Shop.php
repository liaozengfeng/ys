<?php 
namespace app\api\controller;
use think\Request;
use think\Db;
use app\api\model\Users as UserModel;
header('Content-type:text/json;charset=utf-8');
/**
 * 
 */
class Shop extends CheckLogin
{
	//获取礼物
	public function getGift(){
		if (isset($_GET['uid'])) {
			//查询用户积分
			$gi=model('Users')->getOne($_GET['uid']);
			//查询上架的商品
			$info=model('gift')->getGift();
			if (!empty($gi)) {
				$json['code']=200;
				$json['msg']='获取成功';
				$json['data']=$info;
				$json['bonus']=$gi['bonus'];
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}else{
				$arr=array(
					'uid'=>$_GET['uid'],
				);
				$user=new UserModel();
				$u=$user->save($arr);
				$json['code']=200;
				$json['msg']='获取成功';
				$json['data']=$info;
				$json['bonus']=0;
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
			
		}else{
			$json['code']=404;
			$json['msg']='缺少参数';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}

	}
	//查询地址
	public function getAddress(){
		$uid=$_GET['uid'];
		$res=model('UserAddress')->getList($uid);
		// dump($res);die;
		if ($res) {
			// foreach ($res as $k => $v) {
			// 	if ($v['age']==1) {
			// 		$res[$k]['age']='男士';
			// 	}else{
			// 		$res[$k]['age']='女士';
			// 	}
			// }
			$json['code']=200;
			$json['msg']='获取成功';
			$json['data']=$res;
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}else{
			$json['code']=200;
			$json['msg']='地址为空';
			$json['data']=$res;
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}

	//添加地址
	public function newAddress(Request $request){
		$data=$request->param();
		if (isset($data['uid'])) {
			
			$arr=array(
					'uid'=>$data['uid'],
					'name'=>$data['name'],
					'address'=>$data['address'],
					'tel'=>$data['tel'],
					'isDefault'=>$data['isDefault'],
				);
			if ($data['isDefault']==0) {

				$check=model('UserAddress')->newAddres($arr);
				if ($check) {
					$json['code']=200;
					$json['msg']='添加成功';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}else{
					$json['code']=404;
					$json['msg']='添加失败';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}
				
			}else{
				model('UserAddress')->modaddress($data['uid']);
				$check=model('UserAddress')->newAddres($arr);
				if ($check) {
					$json['code']=200;
					$json['msg']='添加成功';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}else{
					$json['code']=404;
					$json['msg']='添加失败';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}
			}
		}else{
			$json['code']=404;
			$json['msg']='缺少参数';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}
	
	//查询单个商品
	public function commodity(){
		$gid=$_GET['gid'];
		$res=model('Gift')->getOne($gid);
		$gi=model('Users')->getOne($_GET['uid']);
		if ($res) {
			$json['code']=200;
			$json['msg']='查询成功';
			$json['data']=$res;
			$json['bonus']=$gi['bonus'];
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}else{
			$json['code']=404;
			$json['msg']='商品不存在';
			$json['bonus']=$gi['bonus'];
			$json['data']=$res;
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}

	//地址修改
	public function modAddress(){
		if (isset($_GET['aid'])) {
			$arr=array(
				'aid'=>$_GET['aid'],
				'uid'=>$_GET['uid'],
			);
			$check=model('UserAddress')->getOne($arr);
			if ($check) {
				if ($_GET['isDefault']==1) {
					model('UserAddress')->modaddress($_GET['uid']);
				}
				$data=array(
					'address'=>$_GET['address'],
					'tel'=>$_GET['tel'],
					'name'=>$_GET['name'],
					'isDefault'=>$_GET['isDefault'],
				);
				$res=model('UserAddress')->modress($arr,$data);
				if ($res) {
					$json['code']=200;
					$json['msg']='修改成功';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;	
				}else{
					$json['code']=200;
					$json['msg']='修改失败';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}
			}else{
				$json['code']=200;
				$json['msg']='地址不存在';
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
		}else{
			$json['code']=404;
			$json['msg']='缺少参数';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}

	//地址删除
	public function delAddress(){
		if (isset($_GET['aid'])) {
			$arr=array(
				'aid'=>$_GET['aid'],
				'uid'=>$_GET['uid'],
			);
			$check=model('UserAddress')->getOne($arr);
			if ($check) {
				$res=model('UserAddress')->delAddress($arr);
				if ($res) {
					$json['code']=200;
					$json['msg']='删除成功';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;	
				}else{
					$json['code']=200;
					$json['msg']='地址已删除';
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}
			}else{
				$json['code']=200;
				$json['msg']='地址不存在';
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
		}else{
			$json['code']=404;
			$json['msg']='缺少参数';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}

	//获取默认地址接口
	public function getDefault(){
		$uid=$_GET['uid'];
		$info=model('UserAddress')->getDefault($uid);
		if ($info) {
			$json['code']=200;
			$json['data']=$info;
			$json['msg']='获取成功';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;	
		}else{
			$json['code']=200;
			$json['data']=$info;
			$json['msg']='暂无地址';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;	
		}
	}
	//获取单个地址接口
	public function getOneaddress(){
		$uid=$_GET['uid'];
		$aid=$_GET['aid'];
		$arr=array(
			'aid'=>$aid,
			'uid'=>$uid,
		);
		$info=model('UserAddress')->getOne($arr);
		if ($info) {
			$json['code']=200;
			$json['data']=$info;
			$json['msg']='获取成功';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;	
		}else{
			$json['code']=200;
			$json['data']=$info;
			$json['msg']='暂无地址';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;	
		}
	}
	
}