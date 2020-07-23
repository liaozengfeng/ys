<?php 
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cookie;
use think\Session;

//登录权限验证
//星钻处理

class Book extends Model
{
   
    public function getBookList($uid)
	{

        //$resBook = Db::name('s_book')->where('is_show',1)->order('book_id desc')->select();
		//$resBook = Db::name('s_student_book')->where('b_uid',$uid)->join("s_book","s_book.book_id = s_student_book.b_bookid")->where('s_book.is_show',1)->select();
		
		if($uid){
		$resBook = Db::name('s_student_book')->where('b_uid',$uid)->join("s_book","s_book.book_id = s_student_book.b_bookid")->where('s_book.is_show',1)->select();
		 if(!$resBook){
			 $resBook = Db::name('s_book')->where('is_show',1)->where('book_id',6)->select();	 
		 }
		}
		else{
		 $resBook = Db::name('s_book')->where('is_show',1)->where('book_id',6)->select();	
		}
		//$resBook = Db::name('s_book')->where('is_show',1)->order('book_id desc')->select();
		return $resBook;
	}
	
	public function getBookSection($id)
	{
        $res = Db::name('s_section')->where('book_id',$id)->order('section_id asc')->select();
		if($res){
			$id =$res[0]['section_id'];
			$res = Db::name('s_section')->join("s_book","s_book.book_id = s_section.book_id")->where('section_id',$id)->find();
		}
		return $res;		
	}
   
	public function getSectionList($id,$uid)
	{  
	  if($id==12){
		 $res = Db::name('s_section')->join("s_book","s_book.book_id = s_section.book_id")->where('s_section.book_id',$id)->order('section_num asc')->order('section_sequence asc')->field("section_id,section_name,section_num,s_book.book_cover")->select();
	   
	  }else if($id==10){
	   $res = Db::name('s_section')->join("s_book","s_book.book_id = s_section.book_id")->where('s_section.book_id',$id)->order('section_num asc')->order('section_sequence asc')->field("section_id,section_name,section_num,s_book.book_cover")->select();
	   	  
	  }
	  else{
        $res = Db::name('s_section')->join("s_book","s_book.book_id = s_section.book_id")->where('s_section.book_id',$id)->order('section_num asc')->order('section_sequence asc')->field("section_id,section_name,section_num,s_book.book_cover")->select();
	  }//isread = 1/0
		$all = count($res);
		for($i=0;$i<$all;$i++)
		{
			$c = Db::name("s_record")->where("uid",$uid)->where("type_id",2)->where("theme_id",$res[$i]['section_id'])->find();
			if($c){
				$res[$i]['is_read']=1;
			}else{
				$res[$i]['is_read']=0;
			}
			
		}
		return $res;		
	}
	
	public function getSectionInfo($id)
	{
        $res = Db::name('s_section')->join("s_book","s_book.book_id = s_section.book_id")->where('section_id',$id)->find();
		if($res)
		{
			$res['is_cover'] = 0;
		}
		return $res;		
	}

}
?>