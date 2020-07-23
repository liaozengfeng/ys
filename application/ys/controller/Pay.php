<?php
namespace app\ys\controller;
use think\Controller;
use app\ys\controller\CheckToken as checkToken;
require_once '/extend/WxPay/WxPay.Api.php';


class Pay extends Controller
{
    public function read()
    {   
        $data = [
            'code' => 404,
            'data' => [],
			'msg'  => "Invaild Request"
        ];
        return json($data);
    }
	
	public function index()
	{
        $data = [
            'code' => 404,
            'data' => [],
			'msg'  => "Invaild Request"
        ];
        return json($data);
	}
	
	public function save()
	{
        $data = [
            'code' => 404,
            'data' => [],
			'msg'  => "Invaild Request"
        ];
        return json($data);		
	}
	
   public function getPayOrder()
    {
        // 根据订单ID 查到订单下对应商品
        // 对商品库存检测等操作
        // Todo ... 
		$uid = input('uid');
		$token = input('token');
		$lessonId = input('id');
	   $user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){	
		  $model = model('User');
          $openid = $model->getOpenid($uid);
		  $repeat = $model->getRepeat($uid,$lessonId);
		  if($lessonId==1){
		  if(!$repeat){
          $data = [
            'code' => 404,
            'data' => [] ,
			'msg' =>  "不能重复购买"
          ];	
           return json($data);		  
		  }}
		  $lessonid =$lessonId;
		  
		  //1 - 199  不能重复购买
		  //2 - 29.9 重复购买 则 88 
		  //if(){}
		  if($lessonid==1){
		     $totalPrice = 199;
		  }else{
			 if($repeat==0){
				  $totalPrice = 29.9; 
			 }else{
				  $totalPrice = 88;
			 }
		  }
		  $orderNo =$this->makeOrderNum();
		  $modelv = model('Order');
		  $datav=[
		   "uid"=>$uid,
		   "openId"=>$openid,
		   "lessonId"=>$lessonid,
		   "state"=>0,
		   "orderNo"=>$orderNo
		  ];
          $orderID = $modelv->makeOrder($datav);
          $dataI = $this->makeWxPreOrder($openid,$orderNo,$totalPrice,$orderID);
          $data = [
            'code' => 200,
            'data' => $dataI ,
			'msg' =>  "success"
          ];	

		}else{
         $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild token"
          ];				
		}
		
		 return json($data);			
    }
	
	public static function notify()
	{
		
		
	}
	
	
    public static function makeOrderNum()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn = $yCode[intval(date('Y') - 2018)] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }
	
    // 构建微信支付订单信息
    private function makeWxPreOrder($openid,$orderNo,$totalPrice,$orderID)
    {
        //获得当前用户 openid
  
        //创建订单信息
        $wxOrderData = new \WxPayUnifiedOrder();        //需要引入微信提供的SDK
        $wxOrderData->SetOut_trade_no($orderNo);      //订单编号，第三方自定义
        $wxOrderData->SetTrade_type('JSAPI');               //交易类型，一般是JSAPI
        $wxOrderData->SetTotal_fee($totalPrice * 100);      //设置总金额，单位为0.01元
        $wxOrderData->SetBody('山姆雅思自学');                  //设置展示信息
        $wxOrderData->SetOpenid($openid);                   //openid
		$wxOrderData->SetAttach($orderNo);                  //
        $wxOrderData->SetNotify_url('https://sam.xinglufamily.com/public/samWx/notify.php'); //回调地址

        return $this->getPaySignature($wxOrderData,$orderID);
    }

    /**
     * 向微信请求订单号并生成签名
     */
    private function getPaySignature($wxOrderData,$orderID)
    {

        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        //返回结果中包含 prepay_id ，此ID作为用户拉起支付时凭证，
        //同时此ID作为将来服务器向客户端推送消息的标识，因此需要保存在数据库订单表中
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
           // Log::record($wxOrder,'error');
           // Log::record('获取预支付订单失败','error');
        }
        //
        $this->recordPreOrder($wxOrder,$orderID);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    private function recordPreOrder($wxOrder,$orderID){
        // 将 prepay_id 保存在数据库中 生成订单
        //OrderModel::where('id', '=', $this->orderID)
        //    ->update(['prepay_id' => $wxOrder['prepay_id']]);
		  $data=[
			"prepay_id"=>$wxOrder['prepay_id']
		  ];
		  $model = model('Order');
          $openid = $model->updateOrder($orderID,$data);
		
    }

    /**
     * 签名
     * @return [array]   [返回数组中要包含小程序发起支付请求的所有参数  包含：小程序ID、时间戳、随机串、数据包(prepay_id)、签名方式、签名 6个参数]
     * 
     */
    private function sign($wxOrder)
    {
        //调用SDK 生成签名
        $jsApiPayData = new \WxPayJsApiPay();
        //Appid
        $jsApiPayData->SetAppid('wxb29d76b81b81d197');
        //timeStamp
        $jsApiPayData->SetTimeStamp((string)time());
        //nonceStr
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        //package
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        //signType
        $jsApiPayData->SetSignType('MD5');
        //生成签名
        $sign = $jsApiPayData->MakeSign();
        //获取数组
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        return $rawValues;
    }

	
}
