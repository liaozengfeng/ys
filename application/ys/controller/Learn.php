<?php
namespace app\ys\controller;
use think\Controller;
use app\ys\controller\CheckToken as checkToken;

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
	

	

	

	
	public function getThemeList()
	{
	    $uid = input('uid');
	    $token = input('token');
		$cid = input('cid');
		$ysType = input('ysType');
		if(!$ysType){ $ysType = 0;}
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	$isCheck=1;
		if($isCheck){
        $model = model('Learn');
        $data = $model->getThemeList($cid,$uid,$ysType);// 查询数据
		if($data){
           $code = 200;
		   $msg = "success";
		}else{
           $code = 404;
		   $msg = "联系客服老师，开通自学备考规划";			
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
		$id = input('tid');
		$user =  new checkToken($uid,$token);
		$isCheck= $user->check();	 $isCheck=1;
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
		$cid = input('id');
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
		$array= ["commentUid"=>$uid,"rid"=>$rid,"commentContent"=>$content,"time"=>time()];
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
		$array= ["uid"=>$uid,"content"=>$content,"sound"=>$sound,"picture"=>$json,"cid"=>$cid,"tid"=>$tid,"second"=>$second,"updateTime"=>time()];
        $data = $model->diary($array);// 查询数据

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
		$array= ["teacherId"=>$uid,"rid"=>$rid,"markContent"=>$content,"score"=>$score,"updateTime"=>time()];
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

	
}
