<?php
namespace app\ys\controller;
use think\Controller;
use app\ys\controller\CheckToken as checkToken;

class User extends Controller
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
	
	
	public function getInfo()
	{
	   $uid = input('uid');
	   $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){	
	   $model = model('User');
	   $rdata = $model->getUser($uid);// 查询数据
       $code = 200;
	   $msg = "success";
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
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
	
	public function getConcact()
	{   $model = model('User');
	    $rdata = $model->getRule(3);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
        return json($data);		
	}
	
	public function getHelp()
	{   $model = model('User');
	   $rdata = $model->getRule(2);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
        return json($data);				
	}

	public function getRule()
	{  
	    $id = input('id');
		if($id){
	   $model = model('User');
	   $rdata = $model->getRule($id);// 查询数据
		
        $code = 200;
		$msg = "success";
        $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild id"
        ];			
		}
        return json($data);				
	}	
	
	public function getDays()
	{
	   $uid = input('uid');
	   $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){	
	   $model = model('User');
	   $rdata = $model->getDays($uid);// 查询数据
       $code = 200;
	   $msg = "success";
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
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
	
	public function getYsTest()
	{  
	   $uid = input('uid');
	   $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){	
	   $model = model('User');
	   $rdata = $model->getYsTest($uid);// 查询数据
       $code = 200;
	   $msg = "success";
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
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
	
	 public function uploadTestInfo()
	{  
	   $uid = input('uid');
	   $token = input('token');
	   $name= input('name');
	   $tel= input('tel');
	   $isYs= input('isYs');
	   $pTime= input('pTime');
	   $tScore= input('tScore');
	   $ysScore= input('ysScore');
	   $exScore= input('exScore');
	   $current= input('current');
	   $user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){	
	   $model = model('User');
	   $tsScore = $isYs*30+$current*10;
	   $array=["userName"=>$name,"isYsTest"=>$isYs,"ysScore"=>$ysScore,"prepareTime"=>$pTime,"targetScore"=>$tScore,"extraScore"=>$exScore,"testJson"=>$current,"testScore"=>$tsScore];
	   $rdata = $model->updateInfo($array,$uid);// 查询数据
       $code = 200;
	   $msg = "success";
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
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
	
	
	public function getYsScore()
	{
	   $uid = input('uid');
	   $token = input('token');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){	
	   $model = model('User');
	   $rdata = $model->getYsScore($uid);// 查询数据
       $code = 200;
	   $msg = "success";
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
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
	
     public function wxlogin(){
 		$get = input('post.');
		if(isset($get['code'])){
 		$param['appid'] = 'wxb29d76b81b81d197';    //小程序id
 		$param['secret'] = '38980362941b01a136fed12bc672b898';    //小程序密钥
 		$param['js_code'] = $this->define_str_replace($get['code']);
 		$param['grant_type'] = 'authorization_code';
        $http_key = $this-> httpCurl('https://api.weixin.qq.com/sns/jscode2session', $param, 'GET');
		
        $session_key = json_decode($http_key,true);

        if (!empty($session_key['session_key'])) {
    	$appid = $param['appid'];
    	$encrypteData = $get['encryptedData'];
    	$iv = $this-> define_str_replace($get['iv']);
    	$errCode = $this->decryptData($appid, $session_key['session_key'], $encrypteData, $iv);
    	//把appid写入到数据库中
		//return json($errCode);exit;

		$str = time(). $errCode['openId'];
    	$data['openId'] = $errCode['openId'];
    	$data['nickName'] = $errCode['nickName'];
    	$data['logo'] =  $errCode['avatarUrl'];
		//$data['province'] = $province;
		//$data['city'] = $city;
		$data['token'] = md5($str);
		$data['createTime'] = time()+7200;
		
		$model = model('User');
        $user = $model->getUserInfo($data['openId']);
		if($user){
			$res = $model->updateInfo($data,$user['uid']);
		}else{
			$res = $model->addUser($data);
		}
		
		$user = $model->getUserInfo($data['openId']);
		$data['uid']=$user['uid'];
		$jsonArr=[
            'code' => 200,
            'data' => '',
            'msg'=> "success"			
		];
		$jsonArr['data']=$user;
    	return json($jsonArr);
      }else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg'=> '获取session_key失败！'
        ];
        return json($data);	
      }
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg'=> '获取code失败！'
        ];
        return json($data);				
		}
 	}
	
	
	 public function bindTel()
	{
		
        $get = input('post.');
		$uid = $get['uid'];
		$token = $get['token'];
 		$param['appid'] = 'wxb29d76b81b81d197';    //小程序id
 		$param['secret'] = '38980362941b01a136fed12bc672b898';    //小程序密钥
 		$param['js_code'] = $this->define_str_replace($get['code']);
 		$param['grant_type'] = 'authorization_code';
        $http_key = $this-> httpCurl('https://api.weixin.qq.com/sns/jscode2session', $param, 'GET');
		
        $session_key = json_decode($http_key,true);

        if (!empty($session_key['session_key'])) {
    	$appid = $param['appid'];
    	$encrypteData = $get['encryptedData'];
    	$iv = $this-> define_str_replace($get['iv']);
    	$errCode = $this->decryptData($appid, $session_key['session_key'], $encrypteData, $iv);
		//var_dump($errCode);exit;
		if($errCode== -41003){
		$jsonArr=[
            'code' => 41003,
            'data' => [],
            'msg'=> "解密错误"			
		];			
		}else{
        //$data['bind_time']  = time();
    	$data['tel'] = $errCode['phoneNumber'];
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
		$model = model('User');
        $res = $model->updateInfo($data,$uid);
		$jsonArr=[
            'code' => 200,
            'data' => $errCode,
            'msg'=> "success"			
		];
		}else{
		$jsonArr=[
            'code' => 401,
            'data' => [],
            'msg'=> "Invaid Token"			
		];			
		}
		}
		}else{
		$jsonArr=[
            'code' => 41003,
            'data' => $session_key,
            'msg'=> "session_key Error"			
		];				
		}
		return json($jsonArr);
 
	}
	
  public function sendRequest($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
/**
 * 发送HTTP请求方法
 * @param  string $url    请求URL
 * @param  array  $params 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $data   响应数据
 */
   public function httpCurl($url, $params, $method = 'POST', $header = array(), $multi = false){
    date_default_timezone_set('PRC');
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER     => $header,
        CURLOPT_COOKIESESSION  => true,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_COOKIE         =>session_name().'='.session_id(),
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            // $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            // 链接后拼接参数  &  非？
            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            break;
        case 'POST':
            //判断是否传输文件
            $params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if($error) throw new Exception('请求发生错误：' . $error);
    return  $data;
   }
/**
 * 微信信息解密
 * @param  string  $appid  小程序id
 * @param  string  $sessionKey 小程序密钥
 * @param  string  $encryptedData 在小程序中获取的encryptedData
 * @param  string  $iv 在小程序中获取的iv
 * @return array 解密后的数组
 */
    public  function decryptData( $appid , $sessionKey, $encryptedData, $iv ){
      $OK = 0;
      $IllegalAesKey = -41001;
      $IllegalIv = -41002;
      $IllegalBuffer = -41003;
      $DecodeBase64Error = -41004;
 
      if (strlen($sessionKey) != 24) {
        return $IllegalAesKey;
      }
      $aesKey=base64_decode($sessionKey);
  
      if (strlen($iv) != 24) {
           return $IllegalIv;
      }
      $aesIV=base64_decode($iv);
 
      $aesCipher=base64_decode($encryptedData);
   
      $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
      $dataObj=json_decode( $result );
      if( $dataObj  == NULL )
      {
          return $IllegalBuffer;
      }
      if( $dataObj->watermark->appid != $appid )
      {
          return $DecodeBase64Error;
      }
      $data = json_decode($result,true);
 
      return $data;
  }
 
/**
 * 请求过程中因为编码原因+号变成了空格
 * 需要用下面的方法转换回来
 */
  public function define_str_replace($data)
  {
     return str_replace(' ','+',$data);
  } 
}