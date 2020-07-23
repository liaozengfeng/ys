<?php 
namespace app\api\model;
use think\Model;
use think\Db;
/**
 * 
 */
class Move extends Model
{

    public function updatePlay($dataId)
    {
        $info=Db::name('s_move')->where('move_id',$dataId)->setInc('move_play');
        return $info;
    }

    /**
     * 收藏
     */
    public function updateCollection($dataId)
    {
       $info=Db::name('s_move')->where('move_id',$dataId)->setInc('move_collection');
        return $info;
    }

    /**
     * 取消收藏
     */
    public function delCollection($dataId)
    {
        $info=Db::name('s_move')->where('move_id',$dataId)->setDec('move_collection');
        return $info;
    }

    /**转发
     */
    public function updateForward($dataId)
    {

        $info=Db::name('s_move')->where('move_id',$dataId)->setInc('move_forward');
        return $info;
    }




/*	public function getOne($gid){
		$info=Db::name('s_gift')->where('gid',$gid)->where('isShow',1)->find();
		return $info;

	}
	public function getOnel($gid){
		$info=Db::name('s_gift')->where('gid',$gid)->find();
		return $info;

	}

*/


	
}