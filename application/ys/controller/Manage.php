<?php
namespace app\ys\controller;
use think\Controller;
use app\ys\controller\CheckToken as checkToken;

class Manage extends Controller
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
	
	
	public function reportAdd()
	{
	   $title=input('title');
	   $order=input('order');
	   $content=input('content');
	   if($title){
	   $etype= 1;
	   $isShow= 1;
	   $arrayData=[
	      "title"=>$title,
		  "order"=>$order,
		  "content"=>$content,
		  "etype"=>$etype,
		  "isShow"=>$isShow
	   ];
	   $model = model('Manage');
	   $rdata = $model->reportAdd($arrayData,$title);// 查询数据
	   if($rdata){
       $code = 200;
	   $msg = "success";
	   }else{
       $code = 404;
	   $msg = "repeat_Title";		   
	   }
	   }else{
       $code = 404;
	   $msg = "empty_Title";
       $rdata=[];	   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
	}

	public function reportEdit()
	{  $id=input('id');
	   $title=input('title');
	   $order=input('order');
	   $content=input('content');
	   if($title){
	   $etype= 1;
	   $isShow= 1;
	   $arrayData=[
	      "title"=>$title,
		  "order"=>$order,
		  "content"=>$content,
		  "etype"=>$etype,
		  "isShow"=>$isShow
	   ];
	   $model = model('Manage');
	   $rdata = $model->reportEdit($arrayData,$id);// 查询数据
	   if($rdata){
       $code = 200;
	   $msg = "success";
	   }else{
       $code = 404;
	   $msg = "repeat_Title";		   
	   }
	   }else{
       $code = 404;
	   $msg = "empty_Title";
       $rdata=[];	   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
	}
	
	public function reportDelete()
	{
	   $id=input('id');
	   if($id){
	   $model = model('Manage');
	   $rdata = $model->reportDelete($id);// 查询数据
	   if($rdata){
         $code = 200;
	     $msg = "success";
	     }else{
         $code = 404;
	     $msg = "repeat_delete";		   
	     }
	   }else{
         $code = 404;
	     $rdata=[];
	     $msg = "empty_info";			   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
		
	}
	
	public function reportAdd2()
	{
	   $title=input('title');
	   $order=input('order');
	   $content=input('content');
	   if($title){
	   $etype= 2;
	   $isShow= 1;
	   $arrayData=[
	      "title"=>$title,
		  "order"=>$order,
		  "content"=>$content,
		  "etype"=>$etype,
		  "isShow"=>$isShow
	   ];
	   $model = model('Manage');
	   $rdata = $model->reportAdd($arrayData,$title);// 查询数据
	   if($rdata){
       $code = 200;
	   $msg = "success";
	   }else{
       $code = 404;
	   $msg = "repeat_Title";		   
	   }
	   }else{
       $code = 404;
	   $msg = "empty_Title";
       $rdata=[];	   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
	}

	public function reportEdit2()
	{  $id=input('id');
	   $title=input('title');
	   $order=input('order');
	   $content=input('content');
	   if($title){
	   $etype= 2;
	   $isShow= 1;
	   $arrayData=[
	      "title"=>$title,
		  "order"=>$order,
		  "content"=>$content,
		  "etype"=>$etype,
		  "isShow"=>$isShow
	   ];
	   $model = model('Manage');
	   $rdata = $model->reportEdit($arrayData,$id);// 查询数据
	   if($rdata){
       $code = 200;
	   $msg = "success";
	   }else{
       $code = 404;
	   $msg = "repeat_Title";		   
	   }
	   }else{
       $code = 404;
	   $msg = "empty_Title";
       $rdata=[];	   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
	}
	
	public function speakAdd()
	{ 
	   $title=input('title');
	   $order=input('order');
	   $file01=input('file01');
	   $file02=input('file02');
	   $file03=input('file03');
	   $file04=input('file04');
	   $file05=input('file05');
	   $file06=input('file06');
	   $file07=input('file07');
	   $file08=input('file08');
	   $file09=input('file09');
	   $s01=input('s01');
	   $s02=input('s02');
	   $s03=input('s03');
	   $s04=input('s04');
	   $s05=input('s05');
	   $s06=input('s06');
	   $s07=input('s07');
	   $s08=input('s08');
	   $s09=input('s09');
	   $t01=input('t01');
	   $t02=input('t02');
	   $t03=input('t03');
	   $t04=input('t04');
	   $t05=input('t05');
	   $t06=input('t06');
	   $t07=input('t07');
	   $t08=input('t08');
	   $t09=input('t09');
	   if($title&&$file01&&$file09){
	   $etype= 3;
	   $isShow= 1;
	   $p1='{"speak":[{"audio":"'.$file01.'","script":"'.$s01.'","tips":"'.$t01.'"},{"audio":"'.$file02.'","script":"'.$s02.'","tips":"'.$t02.'"},{"audio":"'.$file03.'","script":"'.$s03.'","tips":"'.$t03.'"},{"audio":"'.$file04.'","script":"'.$s04.'","tips":"'.$t04.'"}]}';
	   //1-4
	   $p2='{"speak":[{"audio":"'.$file05.'","script":"'.$s05.'","tips":"'.$t05.'"}]}';
	   //5
	   $p3='{"speak":[{"audio":"'.$file06.'","script":"'.$s06.'","tips":"'.$t06.'"},{"audio":"'.$file07.'","script":"'.$s07.'","tips":"'.$t07.'"},{"audio":"'.$file08.'","script":"'.$s08.'","tips":"'.$t08.'"},{"audio":"'.$file09.'","script":"'.$s09.'","tips":"'.$t09.'"}]}';//6-9
	   $arrayData=[
	      "title"=>$title,
		  "order"=>$order,
		  "content"=>'',
		  "part1"=>$p1,
		  "part2"=>$p2,
		  "part3"=>$p3,
		  "etype"=>$etype,
		  "isShow"=>$isShow
	   ];
	   $model = model('Manage');
	   $rdata = $model->reportAdd($arrayData,$title);// 查询数据
	   if($rdata){
       $code = 200;
	   $msg = "success";
	   }else{
       $code = 404;
	   $msg = "repeat_Title";		   
	   }
	   }else{
       $code = 404;
	   $msg = "empty_Title";
       $rdata=[];	   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
	}

	public function speakEdit()
	{  $id=input('id');
	   $title=input('title');
	   $order=input('order');
	   $file01=input('file01');
	   $file02=input('file02');
	   $file03=input('file03');
	   $file04=input('file04');
	   $file05=input('file05');
	   $file06=input('file06');
	   $file07=input('file07');
	   $file08=input('file08');
	   $file09=input('file09');
	   $s01=input('s01');
	   $s02=input('s02');
	   $s03=input('s03');
	   $s04=input('s04');
	   $s05=input('s05');
	   $s06=input('s06');
	   $s07=input('s07');
	   $s08=input('s08');
	   $s09=input('s09');
	   $t01=input('t01');
	   $t02=input('t02');
	   $t03=input('t03');
	   $t04=input('t04');
	   $t05=input('t05');
	   $t06=input('t06');
	   $t07=input('t07');
	   $t08=input('t08');
	   $t09=input('t09');
	   if($title&&$file01&&$file09){
	   $etype= 3;
	   $isShow= 1;
	   $p1='{"speak":[{"audio":"'.$file01.'","script":"'.$s01.'","tips":"'.$t01.'"},{"audio":"'.$file02.'","script":"'.$s02.'","tips":"'.$t02.'"},{"audio":"'.$file03.'","script":"'.$s03.'","tips":"'.$t03.'"},{"audio":"'.$file04.'","script":"'.$s04.'","tips":"'.$t04.'"}]}';
	   //1-4
	   $p2='{"speak":[{"audio":"'.$file05.'","script":"'.$s05.'","tips":"'.$t05.'"}]}';
	   //5
	   $p3='{"speak":[{"audio":"'.$file06.'","script":"'.$s06.'","tips":"'.$t06.'"},{"audio":"'.$file07.'","script":"'.$s07.'","tips":"'.$t07.'"},{"audio":"'.$file08.'","script":"'.$s08.'","tips":"'.$t08.'"},{"audio":"'.$file09.'","script":"'.$s09.'","tips":"'.$t09.'"}]}';//6-9
	   $arrayData=[
	      "title"=>$title,
		  "order"=>$order,
		  "content"=>'',
		  "part1"=>$p1,
		  "part2"=>$p2,
		  "part3"=>$p3,
		  "etype"=>$etype,
		  "isShow"=>$isShow
	   ];
	   $model = model('Manage');
	   $rdata = $model->reportEdit($arrayData,$id);// 查询数据
	   if($rdata){
       $code = 200;
	   $msg = "success";
	   }else{
       $code = 404;
	   $msg = "repeat_Title";		   
	   }
	   }else{
       $code = 404;
	   $msg = "empty_Title";
       $rdata=[];	   
	   }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);			
	}
	
	public function correctReport()
	{
       $id=input('id');
	   $allScore=input('allScore');
	   $trScore=input('trScore');
	   $lrScore=input('lrScore');
	   $ccScore=input('ccScore');
	   $graScore=input('graScore');
	   $otherScore=input('otherScore');	
       $tr01=input('tr01');	
       $tr02=input('tr02');
       $tr03=input('tr03');
       $tr04=input('tr04');
       $tr05=input('tr05');
       $tr06=input('tr06');
       $tr07=input('tr07');	 
       $cc01=input('cc01');	
       $cc02=input('cc02');
       $cc03=input('cc03');
       $cc04=input('cc04');	   
       $lr01=input('lr01');	
       $lr02=input('lr02');
       $lr03=input('lr03');
   
       $gra01=input('gra01');	
       $gra02=input('gra02');
       $gra03=input('gra03');
       $gra04=input('gra04');	
       $other01=input('other01');	
       $other02=input('other02');
       $other03=input('other03');
       $other04=input('other04');	
	   $result=input('result');
	   $point = input('point');
       //$r01=input('r01');	
       //$r02=input('r02');
       //$r03=input('r03');
       //$r04=input('r04');
       //$p01=input('p01');	
       //$p02=input('p02');
       //$p03=input('p03');
       //$p04=input('p04');
	   $imagev=input('image');
	   $Ajson='{"TR":[{"title":"1.强调主要内容","content":"'.$tr01.'"},{"title":"2.概括整体信息","content":"'.$tr02.'"},{"title":"3.趋势的描述","content":"'.$tr03.'"},{"title":"4.数据的支持","content":"'.$tr04.'"},{"title":"5.报告相同点","content":"'.$tr05.'"},{"title":"6.对比不同点","content":"'.$tr06.'"},{"title":"7.全文清晰","content":"'.$tr07.'"}]}';
	   $Bjson='{"TR":[{"title":"1.段落逻辑清晰","content":"'.$cc01.'"},{"title":"2.句子间逻辑","content":"'.$cc02.'"},{"title":"3.指代使用","content":"'.$cc03.'"},{"title":"4.逻辑关系词","content":"'.$cc04.'"}]}';
	   $Cjson='{"TR":[{"title":"1.无多次重复","content":"'.$lr01.'"},{"title":"2.用词充分灵活","content":"'.$lr02.'"},{"title":"3.词汇搭配地道","content":"'.$lr03.'"}]}';
	   $Djson='{"TR":[{"title":"1.语法准确性","content":"'.$gra01.'"},{"title":"2.语法多样性","content":"'.$gra02.'"},{"title":"3.从句使用","content":"'.$gra03.'"},{"title":"4.标点准确","content":"'.$gra04.'"}]}';
	   $Ejson='{"TR":[{"title":"1.字数满足","content":"'.$other01.'"},{"title":"2.是否偏题","content":"'.$other02.'"},{"title":"3.生硬背诵","content":"'.$other03.'"},{"title":"4.字迹书写","content":"'.$other04.'"}]}';
	  // $resultJson='{"result":[{"title":"任务与回应(TR):","content":"'.$r01.'"},{"title":"一致与连接(CC):","content":"'.$r02.'"},{"title":"词汇资源(LR):","content":"'.$r03.'"},{"title":"语法范围与正确性(GRA):","content":"'.$r04.'"}]}';
	   //$pointJson='{"point":[{"title":"任务与回应(TR):","content":"'.$p01.'"},{"title":"一致与连接(CC):","content":"'.$p02.'"},{"title":"词汇资源(LR):","content":"'.$p03.'"},{"title":"语法范围与正确性(GRA):","content":"'.$p04.'"}]}';
	  $resultJson = $result;
	  $pointJson = $point;
	  if(isset($_FILES['image']))
	  {
		//echo isset($_FILES);
		 $urlDisk = "C:/sam/public/ys";
	     $urlConfig = "https://sam.xinglufamily.com/public/ys";
		$banner_path = $urlDisk."/upload/banner/";//上传路径
	    $banner_web = $urlConfig."/upload/banner/";//保存路径
		$name = $_FILES['image']['name'];
		$name_tmp = $_FILES['image']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//图片名称
        $pic_url = $banner_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $banner_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$fcname = $pic_web_url;
		}else{
			$fcname ='';
		}

      }else{
		  $fcname ='';
	  }
	  if($gra01&&$cc01)
	  {
		  if($fcname==''){
			  
			  $array=["hwid"=>$id,"type"=>1,"allScore"=>$allScore,"AScore"=>$trScore,"AJson"=>$Ajson,"BScore"=>$ccScore,"BJson"=>$Bjson,"CScore"=>$lrScore,"CJson"=>$Cjson,"DScore"=>$graScore,"DJson"=>$Djson,"EScore"=>$otherScore,"EJson"=>$Ejson,"resultJson"=>$resultJson,"EpointJson"=>$pointJson];
	     
		  }else{
		 $array=["hwid"=>$id,"homePic"=>$fcname,"type"=>1,"allScore"=>$allScore,"AScore"=>$trScore,"AJson"=>$Ajson,"BScore"=>$ccScore,"BJson"=>$Bjson,"CScore"=>$lrScore,"CJson"=>$Cjson,"DScore"=>$graScore,"DJson"=>$Djson,"EScore"=>$otherScore,"EJson"=>$Ejson,"resultJson"=>$resultJson,"EpointJson"=>$pointJson];
	      }$model = model('Manage');
	     $rdata = $model->correctReport($array,$id);// 查询数据
         $code = 200;
	     $msg = "success";
         $rdata=[];		  
	  }else{
       $code = 404;
	   $msg = "empty_Content";
       $rdata=[];	 		  
	  }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);	
	}
	
	public function correctReport2()
	{
       $id=input('id');
	   $allScore=input('allScore');
	   $trScore=input('trScore');
	   $lrScore=input('lrScore');
	   $ccScore=input('ccScore');
	   $graScore=input('graScore');
	   $otherScore=input('otherScore');	
       $tr01=input('tr01');	
       $tr02=input('tr02');
       $tr03=input('tr03');
       $tr04=input('tr04');
       $tr05=input('tr05');
       $tr06=input('tr06');
       $tr07=input('tr07');	 
       $cc01=input('cc01');	
       $cc02=input('cc02');
       $cc03=input('cc03');
       $cc04=input('cc04');	   
       $lr01=input('lr01');	
       $lr02=input('lr02');
       $lr03=input('lr03');
   
       $gra01=input('gra01');	
       $gra02=input('gra02');
       $gra03=input('gra03');
       $gra04=input('gra04');	
       $other01=input('other01');	
       $other02=input('other02');
       $other03=input('other03');
       $other04=input('other04');	
	   $result=input('result');
	   $point = input('point');
       //$r01=input('r01');	
       //$r02=input('r02');
       //$r03=input('r03');
       //$r04=input('r04');
       //$p01=input('p01');	
       //$p02=input('p02');
       //$p03=input('p03');
       //$p04=input('p04');
	   $imagev=input('image');
	   $Ajson='{"TR":[{"title":"1.切题","content":"'.$tr01.'"},{"title":"2.完整回应题目","content":"'.$tr02.'"},{"title":"3.立场贯穿一致","content":"'.$tr03.'"},{"title":"4.论点重心平衡","content":"'.$tr04.'"},{"title":"5.细节论证充分","content":"'.$tr05.'"},{"title":"6.中文思想准确","content":"'.$tr06.'"},{"title":"7.结论段水平","content":"'.$tr07.'"}]}';
	   $Bjson='{"TR":[{"title":"1.段落逻辑清晰","content":"'.$cc01.'"},{"title":"2.句子间逻辑","content":"'.$cc02.'"},{"title":"3.指代使用","content":"'.$cc03.'"},{"title":"4.逻辑关系词","content":"'.$cc04.'"}]}';
	   $Cjson='{"TR":[{"title":"1.无多次重复","content":"'.$lr01.'"},{"title":"2.用词充分灵活","content":"'.$lr02.'"},{"title":"3.词汇搭配地道","content":"'.$lr03.'"}]}';
	   $Djson='{"TR":[{"title":"1.语法准确性","content":"'.$gra01.'"},{"title":"2.语法多样性","content":"'.$gra02.'"},{"title":"3.从句使用","content":"'.$gra03.'"},{"title":"4.标点准确","content":"'.$gra04.'"}]}';
	   $Ejson='{"TR":[{"title":"1.字数满足","content":"'.$other01.'"},{"title":"2.是否偏题","content":"'.$other02.'"},{"title":"3.生硬背诵","content":"'.$other03.'"},{"title":"4.字迹书写","content":"'.$other04.'"}]}';
	  // $resultJson='{"result":[{"title":"任务与回应(TR):","content":"'.$r01.'"},{"title":"一致与连接(CC):","content":"'.$r02.'"},{"title":"词汇资源(LR):","content":"'.$r03.'"},{"title":"语法范围与正确性(GRA):","content":"'.$r04.'"}]}';
	   //$pointJson='{"point":[{"title":"任务与回应(TR):","content":"'.$p01.'"},{"title":"一致与连接(CC):","content":"'.$p02.'"},{"title":"词汇资源(LR):","content":"'.$p03.'"},{"title":"语法范围与正确性(GRA):","content":"'.$p04.'"}]}';
	  $resultJson = $result;
	  $pointJson = $point;
	  if(isset($_FILES['image']))
	  {
		//echo isset($_FILES);
		 $urlDisk = "C:/sam/public/ys";
	     $urlConfig = "https://sam.xinglufamily.com/public/ys";
		$banner_path = $urlDisk."/upload/banner/";//上传路径
	    $banner_web = $urlConfig."/upload/banner/";//保存路径
		$name = $_FILES['image']['name'];
		$name_tmp = $_FILES['image']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//图片名称
        $pic_url = $banner_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $banner_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$fcname = $pic_web_url;
		}else{
			$fcname ='';
		}

      }else{
		  $fcname ='';
	  }
	  if($gra01&&$cc01)
	  {
		  if($fcname==''){
			  
			  $array=["hwid"=>$id,"type"=>1,"allScore"=>$allScore,"AScore"=>$trScore,"AJson"=>$Ajson,"BScore"=>$ccScore,"BJson"=>$Bjson,"CScore"=>$lrScore,"CJson"=>$Cjson,"DScore"=>$graScore,"DJson"=>$Djson,"EScore"=>$otherScore,"EJson"=>$Ejson,"resultJson"=>$resultJson,"EpointJson"=>$pointJson];
	     
		  }else{
		 $array=["hwid"=>$id,"homePic"=>$fcname,"type"=>1,"allScore"=>$allScore,"AScore"=>$trScore,"AJson"=>$Ajson,"BScore"=>$ccScore,"BJson"=>$Bjson,"CScore"=>$lrScore,"CJson"=>$Cjson,"DScore"=>$graScore,"DJson"=>$Djson,"EScore"=>$otherScore,"EJson"=>$Ejson,"resultJson"=>$resultJson,"EpointJson"=>$pointJson];
	      }$model = model('Manage');
	     $rdata = $model->correctReport($array,$id);// 查询数据
         $code = 200;
	     $msg = "success";
         $rdata=[];		  
	  }else{
       $code = 404;
	   $msg = "empty_Content";
       $rdata=[];	 		  
	  }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);	
	}
	
	public function correctReport3()
	{
       $id=input('id');
	   $allScore=input('allScore');
	   $trScore=input('trScore');
	   $lrScore=input('lrScore');
	   $ccScore=input('ccScore');
	   $graScore=input('graScore');
	   $otherScore=input('otherScore');	
       $tr01=input('tr01');	
       $tr02=input('tr02');
       $tr03=input('tr03');
       $tr04=input('tr04');
       $tr05=input('tr05');
       $tr06=input('tr06');
       	 
       $cc01=input('cc01');	
       $cc02=input('cc02');
       $cc03=input('cc03');
       $cc04=input('cc04');	   
       $lr01=input('lr01');	
       $lr02=input('lr02');
       $lr03=input('lr03');
	   $lr04=input('lr04');
   
       $gra01=input('gra01');	
       $gra02=input('gra02');
       $gra03=input('gra03');
 
       $other01=input('other01');	
       $other02=input('other02');
       $other03=input('other03');
       $other04=input('other04');	
	   $result=input('result');
	   $point = input('point');
       //$r01=input('r01');	
       //$r02=input('r02');
       //$r03=input('r03');
       //$r04=input('r04');
       //$p01=input('p01');	
       //$p02=input('p02');
       //$p03=input('p03');
       //$p04=input('p04');
	   $imagev=input('image');
	   $Ajson='{"TR":[{"title":"1.恰当的展开话题","content":"'.$tr01.'"},{"title":"2.表达详尽","content":"'.$tr02.'"},{"title":"3.表达连贯程度,衔接语句使用","content":"'.$tr03.'"},{"title":"4.表达流利度","content":"'.$tr04.'"},{"title":"5.自我纠正的情况","content":"'.$tr05.'"},{"title":"6.正确的使用词句","content":"'.$tr06.'"}]}';
	   $Bjson='{"TR":[{"title":"1.发音特点","content":"'.$cc01.'"},{"title":"2.口音对听者理解的影响","content":"'.$cc02.'"},{"title":"3.发音的清晰度","content":"'.$cc03.'"},{"title":"4.发音的准确性","content":"'.$cc04.'"}]}';
	   $Cjson='{"TR":[{"title":"1.无多次重复","content":"'.$lr01.'"},{"title":"2.用词充分灵活","content":"'.$lr02.'"},{"title":"3.词汇搭配地道","content":"'.$lr03.'"},{"title":"4.改诉的有效性","content":"'.$lr04.'"}]}';
	   $Djson='{"TR":[{"title":"1.语法准确性","content":"'.$gra01.'"},{"title":"2.语法多样性","content":"'.$gra02.'"},{"title":"3.从句使用","content":"'.$gra03.'"}]}';
	   $Ejson='{"TR":[{"title":"1.内容逻辑","content":"'.$other01.'"},{"title":"2.是否偏题","content":"'.$other02.'"},{"title":"3.生硬背诵","content":"'.$other03.'"},{"title":"4.表达理解","content":"'.$other04.'"}]}';
	  // $resultJson='{"result":[{"title":"任务与回应(TR):","content":"'.$r01.'"},{"title":"一致与连接(CC):","content":"'.$r02.'"},{"title":"词汇资源(LR):","content":"'.$r03.'"},{"title":"语法范围与正确性(GRA):","content":"'.$r04.'"}]}';
	   //$pointJson='{"point":[{"title":"任务与回应(TR):","content":"'.$p01.'"},{"title":"一致与连接(CC):","content":"'.$p02.'"},{"title":"词汇资源(LR):","content":"'.$p03.'"},{"title":"语法范围与正确性(GRA):","content":"'.$p04.'"}]}';
	  $resultJson = $result;
	  $pointJson = $point;
	  if(isset($_FILES['image']))
	  {
		//echo isset($_FILES);
		 $urlDisk = "C:/sam/public/ys";
	     $urlConfig = "https://sam.xinglufamily.com/public/ys";
		$banner_path = $urlDisk."/upload/banner/";//上传路径
	    $banner_web = $urlConfig."/upload/banner/";//保存路径
		$name = $_FILES['image']['name'];
		$name_tmp = $_FILES['image']['tmp_name'];
		$type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		$num= time() . rand(1000, 9999);
		$pic_name = $num . "." . $type;//图片名称
        $pic_url = $banner_path . $pic_name;//上传后图片路径+名称
		$pic_web_url = $banner_web . $pic_name;//上传后保存图片路径+名称
        if (move_uploaded_file($name_tmp, $pic_url)){
			$fcname = $pic_web_url;
		}else{
			$fcname ='';
		}

      }else{
		  $fcname ='';
	  }
	  if($gra01&&$cc01)
	  {
		  if($fcname==''){
			  
			  $array=["hwid"=>$id,"type"=>2,"allScore"=>$allScore,"AScore"=>$trScore,"AJson"=>$Ajson,"BScore"=>$ccScore,"BJson"=>$Bjson,"CScore"=>$lrScore,"CJson"=>$Cjson,"DScore"=>$graScore,"DJson"=>$Djson,"EScore"=>$otherScore,"EJson"=>$Ejson,"resultJson"=>$resultJson,"EpointJson"=>$pointJson];
	     
		  }else{
		 $array=["hwid"=>$id,"homePic"=>$fcname,"type"=>2,"allScore"=>$allScore,"AScore"=>$trScore,"AJson"=>$Ajson,"BScore"=>$ccScore,"BJson"=>$Bjson,"CScore"=>$lrScore,"CJson"=>$Cjson,"DScore"=>$graScore,"DJson"=>$Djson,"EScore"=>$otherScore,"EJson"=>$Ejson,"resultJson"=>$resultJson,"EpointJson"=>$pointJson];
	      }$model = model('Manage');
	     $rdata = $model->correctReport($array,$id);// 查询数据
         $code = 200;
	     $msg = "success";
         $rdata=[];		  
	  }else{
       $code = 404;
	   $msg = "empty_Content";
       $rdata=[];	 		  
	  }
       $data = [
            'code' => $code,
            'data' => $rdata,
			'msg' =>  $msg
        ];
		
        return json($data);	
	}
	
	public function uploadAudio()
	{
        $file =request()->file('sound');
        if($file){
            //将传入的图片移动到框架应用根目录/public/uploads/ 目录下，ROOT_PATH是根目录下，DS是代表斜杠 / 
			//
			 $date=date("Ymd",time());
			 $dir=ROOT_PATH.'public'.DS.'uploads'.DS.$date;
		     if(!is_dir($dir)){mkdir($dir,0777);};

            $info = $file->move(ROOT_PATH . 'public' . DS . 'audio'. DS );
            if($info){
                //return $info->getSaveName();
				
             $name=$info->getSaveName();;
             $date=date("Ymd",time());
		     $co='/public/audio/'.$name;
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
					
             $name=$info->getSaveName();;
             $date=date("Ymd",time());
		     $co='/public/uploads/'.$name;
		     $con="https://sam.xinglufamily.com".str_replace('\\',"/",$co);
             return $con;
            }else{
                // 上传失败获取错误信息
                echo $file->getError();die;
            }
        }
    }
	
}
