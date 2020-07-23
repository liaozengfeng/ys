<?php
namespace app\api\controller;
use think\Controller;
use app\api\controller\CheckToken as checkToken;

class Learn extends Controller
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
	
	public function getCircle()
	{   

	    $uid = input('uid');
	    $token = input('token');
		$type = input('type');
		$lv = input('lv');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getCircle($uid,$type,$lv);// 查询数据
		if($data){
           $code = 200;
		   $arr =$data;
		   $msg = "success";
		}else{
           $code = 404;
		   $arr =[];
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $arr,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);	
	}
	
	public function getCircleV2()
	{   

	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check(); //$isCheck=1;	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getCircleV2($cid);// 查询数据
		if($data){
           $code = 200;
		   $arr =$data;
		   $msg = "success";
		}else{
           $code = 404;
		   $arr =[];
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $arr,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);	
	}
	
	public function getCircleList()
	{   

	    $uid = input('uid');
	    $token = input('token');
		$type = input('type');
		$lv = input('lv');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getCircleList($uid,$type,$lv);// 查询数据
		if($data){
           $code = 200;
		   $arr =$data;
		   $msg = "success";
		}else{
           $code = 404;
		   $arr =[];
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $arr,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);	
	}
	
	public function getCircleListV2()
	{   

	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getCircleListV2($uid,$id);// 查询数据
		if($data){
           $code = 200;
		   $arr =$data;
		   $msg = "success";
		}else{
           $code = 404;
		   $arr =[];
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $arr,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);	
	}
	
	public function getLastTheme()
	{
	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getLastTheme($cid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
	}
	
	public function getThemeList()
	{
	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getThemeList($cid,$uid);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
	}

	public function getThemeInfo()
	{
	    $uid = input('uid');
	    $token = input('token');
		$id = input('id');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->getThemeInfo($id);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "Invaild Request";			
		}
        $data = [
            'code' => $code,
            'data' => $data,
			'msg' =>  $msg
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
	}

	public function getDairyList()
	{
	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');
		$tid = input('tid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		$isCheck =1;
		if($isCheck){
        $model = model('Learn');
        $data = $model->getDairyList($cid,$tid,$uid);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
	}
	
	public function getBookDairyList()
	{
	    $uid = input('uid');
	    $token = input('token');
		$bid = input('bid');
		$sid = input('sid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		$isCheck =1;
		if($isCheck){
        $model = model('Learn');
        $data = $model->getBookDairyList($bid,$sid,$uid);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);			
	}
	
	public function delDiary()
	{
	    $uid = input('uid');
	    $token = input('token');
		$rid = input('rid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $rdata = $model->delDiary($rid,$uid);// 查询数据
       if($rdata==1){
        $data = [
            'code' => 200,
            'data' => $rdata,
			'msg' =>  "success"
	   ];}
	   else if($rdata==2){
        $data = [
            'code' => 404,
            'data' => $rdata,
			'msg' =>  "没有权限删除该日记"
	   ];		   
	   }else{
        $data = [
            'code' => 404,
            'data' => $rdata,
			'msg' =>  "该日记已经删除了"
	   ];			   
	   }
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);					
	}
	
	public function delMark()
	{
	    $uid = input('uid');
	    $token = input('token');
		$mid = input('mid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $rdata = $model->delMark($mid,$uid);// 查询数据
       if($rdata==1){
        $data = [
            'code' => 200,
            'data' => $rdata,
			'msg' =>  "success"
	   ];}
	   else if($rdata==2){
        $data = [
            'code' => 404,
            'data' => $rdata,
			'msg' =>  "没有权限删除该评分"
	   ];		   
	   }else{
        $data = [
            'code' => 404,
            'data' => $rdata,
			'msg' =>  "该评分已经删除了"
	   ];			   
	   }
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);					
	}
	
	public function delComment()
	{
	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $rdata = $model->delComment($cid,$uid);// 查询数据
       if($rdata==1){
        $data = [
            'code' => 200,
            'data' => $rdata,
			'msg' =>  "success"
	   ];}
	   else if($rdata==2){
        $data = [
            'code' => 404,
            'data' => $rdata,
			'msg' =>  "没有权限删除该评论"
	   ];		   
	   }else{
        $data = [
            'code' => 404,
            'data' => $rdata,
			'msg' =>  "该评论已经删除了"
	   ];			   
	   }
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);					
	}
	
	public function like()
	{
	    $uid = input('uid');
	    $token = input('token');
		$rid = input('rid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->like($rid,$uid);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
		
	}
	
	public function  comment()
	{
	    $uid = input('uid');
	    $token = input('token');
		$rid = input('rid');
		$content = input('content');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
		$array= ["comment_uid"=>$uid,"record_id"=>$rid,"comment_content"=>$content,"time"=>time()];
        $data = $model->comment($array);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
	}
	
	public function  diary()
	{
	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');//圈子id
		$tid = input('tid');//主题id
		$content = input('content');
		$sound = input('sound');
		$second = input('second');
		$image =  request()->post('image/a');//input('image');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
		if(is_array($image))
		{   $json ="";
	        $datas =[];
			if(count($image)){
			for($i=0;$i<count($image);$i++)
			{
				$datas[$i]['picture']=$image[$i];
			}
			$dataPic = ["data"=>$datas];
			$json =json_encode($dataPic);}
			else{ $json ="";}
		}else{
			$json ="";
		}
		$model = model('Learn');
		$array= ["uid"=>$uid,"content"=>$content,"sound"=>$sound,"picture"=>$json,"circle_id"=>$cid,"theme_id"=>$tid,"second"=>$second,"type_id"=>1,"update_time"=>time()];
        $data = $model->diary($array,$cid);// 查询数据
        $datav = $model->bonus($uid,1,$tid);
        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
	}
	
	public function  bookDiary()
	{
	    $uid = input('uid');
	    $token = input('token');
		$bid = input('bid');//书籍id
		$sid = input('sid');//章节id
		$content = input('content');
		$sound = input('sound');
		$second = input('second');
		$image =  request()->post('image/a');//input('image');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
		if(is_array($image))
		{   $json ="";
	        $datas =[];
			if(count($image)){
			for($i=0;$i<count($image);$i++)
			{
				$datas[$i]['picture']=$image[$i];
			}
			$dataPic = ["data"=>$datas];
			$json =json_encode($dataPic);}
			else{ $json ="";}
		}else{
			$json ="";
		}
		$model = model('Learn');
		$array= ["uid"=>$uid,"content"=>$content,"sound"=>$sound,"picture"=>$json,"circle_id"=>$bid,"theme_id"=>$sid,"second"=>$second,"type_id"=>2,"update_time"=>time()];
        $data = $model->diary($array,$bid);// 查询数据
         $datav = $model->bonus($uid,2,$sid);
        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);				
	}
	
    public function upload(){
        // 获取表单上传的文件，例如上传了一张图片
        $file =request()->file('image');
        if($file){
            //将传入的图片移动到框架应用根目录/public/uploads/ 目录下，ROOT_PATH是根目录下，DS是代表斜杠 / 
			//
			 $date=date("Ymd",time());
			 $dir=ROOT_PATH.'public'.DS.'uploads'.DS.$date;
		     if(!is_dir($dir)){mkdir($dir,0777);};

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS );
            if($info){
                return $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
    }
	
	public function  audio()
	{
        $file =request()->file('sound');
        if($file){
            //将传入的图片移动到框架应用根目录/public/uploads/ 目录下，ROOT_PATH是根目录下，DS是代表斜杠 / 
			//
			 $date=date("Ymd",time());
			 $dir=ROOT_PATH.'public'.DS.'uploads'.DS.$date;
		     if(!is_dir($dir)){mkdir($dir,0777);};

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS );
            if($info){
                //return $info->getSaveName();
				
             $name=$info->getSaveName();;
             $date=date("Ymd",time());
		     $co='/public/uploads/'.$name;
		     $con="https://sam.xinglufamily.com".str_replace('\\',"/",$co);
             $data = [
               'code' => 2000,
               'data' => $con,
			   'msg' =>  "success"
             ];			
             return json($data);	
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }		
		
	}
	
	public function  image()
	{
        $file =request()->file('image');
        if($file){
            //将传入的图片移动到框架应用根目录/public/uploads/ 目录下，ROOT_PATH是根目录下，DS是代表斜杠 / 
			//
			 $date=date("Ymd",time());
			 $dir=ROOT_PATH.'public'.DS.'uploads'.DS.$date;
		     if(!is_dir($dir)){mkdir($dir,0777);};

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS );
            if($info){
                //return $info->getSaveName();
				
             $name=$info->getSaveName();;
             $date=date("Ymd",time());
		     $co='/public/uploads/'.$name;
		     $con="https://sam.xinglufamily.com".str_replace('\\',"/",$co);
             $data = [
               'code' => 2000,
               'data' => $con,
			   'msg' =>  "success"
             ];			
             return json($data);	
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }		
		
	}
	
	public function remark()
	{
	    $uid = input('uid');
	    $token = input('token');
		$rid = input('rid');
		$score = input('score');
		$content = input('content');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
		$array= ["teacher_id"=>$uid,"record_id"=>$rid,"mark_content"=>$content,"score"=>$score,"update_time"=>time()];
        $data = $model->mark($array);// 查询数据

        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
        $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
        ];			
		}
        return json($data);						
		
		
	}
	
	public function updateRead()
	{
       $uid = input('uid');
	    $token = input('token');
		$tid = input('tid');
        $sid = input('sid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	
		if($isCheck){
        $model = model('Learn');
        $data = $model->bonus($uid,3,$sid);// 查询数据
        $data = [
            'code' => 200,
            'data' => $data,
			'msg' =>  "success"
        ];
		}else{
         $data = [
            'code' => 404,
            'data' => [],
			'msg' =>  "Invaild Token"
         ];			
		}
        return json($data);				
	}

	
}
