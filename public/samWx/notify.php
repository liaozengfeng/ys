<?php
require('./include/init.php');
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "./lib/WxPay.Api.php";
require_once './lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("./logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{   protected $para = array('code'=>0,'data'=>'');
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			$this->para['code'] = 0;
            $this->para['data'] = '';
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			$this->para['code'] = 0;
            $this->para['data'] = '';
            return false;
		}
		$this->para['code'] = 1;
        $this->para['data'] = $data;
		return true;
	}
	
	 public function IsSuccess(){
      return $this->para;
    }

}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
$is_success = $notify->IsSuccess(); 
$bdata = $is_success['data']; 
 //支付success
 if($is_success['code'] == 1){ 
    $Info=$bdata['attach'];
    $orderSql="SELECT * FROM y_user_order WHERE orderNo = '".$Info."'";
    $order = selectRow($orderSql);
    //$paySql="SELECT * FROM xl_wxchagre WHERE chagreCode = '".$code."'";
   //$pay=selectRow($paySql);  
   //$points=$pay['chagrePoint'];	
	Log::DEBUG("begin notify".json_encode($order));
	//$point=$users['fansPoint']+$points;
	$JSON=json_encode($is_success,JSON_UNESCAPED_UNICODE);
	$data=array("state"=>2,"buyTime"=>time(),"payJson"=>$JSON,"money"=>$bdata['cash_fee']);
	edit("y_user_order",$data, "orderId =".$order['orderId']);
	/**
    $data=array(
	             "bank_type"=>$bdata['bank_type'],
	             "attach"=>$bdata['attach'],
				 "cash_fee"=>$bdata['cash_fee'],
				 "is_subscribe"=>$bdata['is_subscribe'],
				 "openid"=>$bdata['openid'],
				 "out_trade_no"=>$bdata['out_trade_no'],
				 "time_end"=>$bdata['time_end'],
				 "total_fee"=>$bdata['total_fee'],
				 "trade_type"=>$bdata['trade_type'],
				 "fee_type"=>$bdata['fee_type'],
				 "fansId"=>$uid,
				 "fansPoint"=>$points
				 );
	add("xl_wxchargelog",$data);
	**/
 }else{//支付失败
 
 }


?>
