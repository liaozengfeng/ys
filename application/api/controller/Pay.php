<?php
namespace app\api\controller;


use think\Controller;
use think\Db;
use wxpay\example\WxPayConfig;
use wxpay\lib\WxPayApi;
use wxpay\lib\WxPayNotifyResults;
use wxpay\lib\WxPayOrderQuery;


class Pay extends Controller
{
    //微信支付异步通知
    public function notify(){
        //返回微信接口初始数据
        $return_msg='Ok';
        $return_code='SUCCESS';

        if (!isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
            //如果没有数据，直接返回失败
            return  'ERROR';
        }
        //获取通知的数据返回数组
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $result = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        //$config=new WxPayConfig();
        //file_put_contents('2.txt',$xml.PHP_EOL,8);
        //file_put_contents('1.txt',json_encode($result).PHP_EOL,8);
        //$result = WxPayNotifyResults::Init($config, $xml);


        //file_put_contents('1.txt',$result.PHP_EOL,8);
        //商户业务逻辑
        if(isset($result['return_code']) && $result['return_code']=='SUCCESS' && $result['transaction_id']){
            //查询订单
            if($this->queryOrder($result['transaction_id'])){
                $order_no=$result['out_trade_no'];
                $order_info=Db::table('s_koudai_shopping')
                    ->where('order_no',$order_no)
                    ->where('status',0)
                    ->find();
                Db::startTrans();
                if($order_info){
                    try{
                        $nt = time();
                        //更改订单状态
                        $data = [
                            'status'=>1,
                            'pay_time'=>$nt
                        ];
                        if(!Db::table('s_koudai_shopping')->where('order_id',$order_info['order_id'])->update($data)){
                            throw new \Exception('订单状态修改失败！');
                        }
                        //添加用户购买记录
                        $data=[
                            'uid'=>$order_info['user_id'],
                            'koudai_cat_id'=>$order_info['koudai_cat_id'],
                            'create_time'=>$nt
                        ];
                        if(!Db::name('s_koudai_cat_shop')->insert($data)){
                            throw new \Exception('课程购买记录添加失败');
                        }
                        Db::commit();
                    }catch (\Exception $e){
                        Db::rollback();
                        file_put_contents('3.txt',$e->getMessage().PHP_EOL,8);
                    }

                }
            }
        }

        //返回success给微信支付接口
        $re_xml=xml(['return_code'=>$return_code,'return_msg'=>$return_msg]);
        return $re_xml;
    }

    //查询订单
    protected function queryOrder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);

        $config = new WxPayConfig();
        $result = WxPayApi::orderQuery($config, $input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }


}
