<?php 
namespace app\api\controller;
use think\Request;
use think\Db;
use app\api\model\Users as UserModel;
header('Content-type:text/json;charset=utf-8');
/**
 * 
 */
class Order extends CheckLogin
{
	// 点击兑换
	public function exchange(){
		$info=input('post.');
		if (isset($info['gid']) and isset($info['uid'])) {
			//获取价格
			$gift=model('Gift')->getOne($info['gid']);
			if (!$gift) {
				$json['code']=404;
				$json['msg']='当前礼物没开放';
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
			
			if($info['type']==1)
			{
				$receiveType = 1; //快递
			}else{
				$receiveType = 2; //自提
			}
			//查询用户积分
			$gi=model('Users')->getOne($info['uid']);
			//判断够不够积分
			if ($gift['goodsPrice']<$gi['bonus']) {
				//判断是否为虚拟
				if ($gift['goodsType']==1) {
					//虚拟的
					$ordermun=time().rand(10000,99999);
					$arr=array(
						'receive'=>2,
						'uid'=>$info['uid'],
						'goodsId'=>$info['gid'],
						'payTime'=>time(),
						'orderCode'=>$ordermun,
						'state'=>1
					);
					$data=array(
						'uid'=>$info['uid'],
						'cbonus'=>'-'.$gift['goodsPrice'],
						'source'=>'Sam 小程序',
						'activeName'=>'兑换'.$gift['goodsName'],
						'time'=>time(),
						'ctype'=>5,
					);
					Db::startTrans();
					//兑换记录
					$check=model('UserOrder')->addrec($arr);
					$data['orderId']=$check;
					$data['gid']=$info['gid'];
					//减分
					$check2=model('Users')->degral($info['uid'],$gift['goodsPrice']);
					//添加记录
					$check3=model('BonusLog')->add($data);
					
					if ($check and $check2 and $check3) {
						Db::commit();
						$json['code']=200;
						$json['msg']='兑换成功';
						$json['bonus']=$gi['bonus']-$gift['goodsPrice'];
						$json['lid']=$check3;
						echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
					}else{
						Db::rollback();
						$json['error']=404;
						$json['msg']='兑换失败';
						$json['bonus']=$gi['bonus'];
						echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
					}
				}else
				{
					$ordermun=time().rand(10000,99999);
					//实物
					if ($info['type']==0) {
						$arr=array(
							'receive'=>2,
							'uid'=>$info['uid'],
							'goodsId'=>$info['gid'],
							'payTime'=>time(),
							'orderCode'=>$ordermun,
							'state'=>1
						);
					}else{
							$re=array(
								'address'=>$info['receive'],
								'uid'=>$info['uid'],
							);
							$address=model('UserAddress')->getOne($re);
							if (!$address) {
								$json['code']=404;
								$json['msg']='未填写地址';
								echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
							}
							$ordermun=time().rand(10000,99999);
							$arr=array(
								'receive'=>1,
								'uid'=>$info['uid'],
								'goodsId'=>$info['gid'],
								'payTime'=>time(),
								'r_address'=>$address['address'],
								'r_tel'=>$address['tel'],
								'r_name'=>$address['name'],
								'orderCode'=>$ordermun,
								'state'=>1
							);
						}
					}
				
				$data=array(
					'uid'=>$info['uid'],
					'cbonus'=>'-'.$gift['goodsPrice'],
					'source'=>'Sam 小程序',
					'activeName'=>'兑换'.$gift['goodsName'],
					'time'=>time(),
					'ctype'=>5,
				);
				Db::startTrans();
				//兑换记录
				$check=model('UserOrder')->addrec($arr);
				$data['orderId']=$check;
				$data['gid']=$info['gid'];
				//减分
				$check2=model('Users')->degral($info['uid'],$gift['goodsPrice']);
				//添加记录
				$check3=model('BonusLog')->add($data);
				
				if ($check and $check2 and $check3) {
					Db::commit();
					$json['code']=200;
					$json['msg']='兑换成功';
					$json['bonus']=$gi['bonus']-$gift['goodsPrice'];
					$json['lid']=$check3;
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}else{
					Db::rollback();
					$json['error']=404;
					$json['msg']='兑换失败';
					$json['bonus']=$gi['bonus'];
					echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
				}
			}else{
				$json['error']=200;
				$json['msg']='积分不足';
				$json['bonus']=$gi['bonus'];
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
		}else{
			$json['code']=404;
			$json['msg']='缺少参数';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}
	
	//查询单个积分使用记录
	public function getOneRecord(){
		if (isset($_GET['lid']) and isset($_GET['uid'])) {
			$lid=$_GET['lid'];
			$uid=$_GET['uid'];
			$data=array(
				'uid'=>$uid,
				'lid'=>$lid,
			);
			$info=model('BonusLog')->getLogRecord($data);
			if ($info) {
				if ($info['gid']!=0) {
					$result=model('Gift')->getOnel($info['gid']);
					$info['goodsCover']=$result['goodsCover'];
					$info['goodsType']=$result['goodsType'];
				}
				if ($info['orderId']!=0) {
					$arr=array('orderId'=>$info['orderId']);
					$res=model('UserOrder')->getOne($arr);
					$info['state']=$res['state'];
				}
				$json['code']=200;
				$json['msg']='查询成功';
				$json['data']=$info;
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}else{
				$json['code']=200;
				$json['msg']='记录不存在';
				$json['data']=$info;
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
		}else{
			$json['code']=404;
			$json['msg']='缺少参数';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
		
	}
	//积分明细
	public function detailed(){
		$uid=$_GET['uid'];
		//积分记录
		$res=model('BonusLog')->GetoneLIst($uid);
		
		//查询用户积分
		$gi=model('Users')->getOne($uid);
		if ($gi) {
			$json['code']=200;
			$json['msg']='查询成功';
			$json['data']=$res;
			$json['bonus']=$gi['bonus'];
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}else{
			$json['code']=404;
			$json['msg']='暂无个人信息';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}
	//确认兑换相当于核销
	public function ConeXchange(){
		$uid=input('uid');
		$lid=input('lid');
		$arr=array(
			'uid'=>$uid,
			'lid'=>$lid,
		);
		$info=model('BonusLog')->getOneRecord($arr);
		if ($info) {
			$res=array(
				'orderId'=>$info['orderId'],
				'uid'=>$uid,
			);
			$check=model('UserOrder')->updateOne($res,['state'=>3]);
			if ($check) {
				$json['code']=200;
				$json['msg']='兑换成功';
				$json['data']=array('state'=>1);
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}else{
				$json['code']=401;
				$json['msg']='兑换失败';
				$json['data']=array('state'=>2);
				echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
			}
		}else{
			$json['code']=404;
			$json['data']=array();
			$json['msg']='订单不存在';
			echo json_encode($json,JSON_UNESCAPED_UNICODE);die;
		}
	}
}