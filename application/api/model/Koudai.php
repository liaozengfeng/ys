<?php
namespace app\api\model;

use think\Db;
use think\Model;

/**
 *
 */
class Koudai extends Model
{

    protected $table = "s_koudai";

    public function updatePlay($dataId)
    {
        $info=Db::name('s_koudai')->where('koudai_id',$dataId)->setInc('koudai_play');
        return $info;
    }

    /**
     * 收藏
     */
    public function updateCollection($dataId)
    {
        $info=Db::name('s_koudai')->where('koudai_id',$dataId)->setInc('koudai_collection');
        return $info;
    }

    /**
     * 取消收藏
     */
    public function delCollection($dataId)
    {
        $info=Db::name('s_koudai')->where('koudai_id',$dataId)->setDec('koudai_collection');
        return $info;
    }

    /**转发
     */
    public function updateForward($dataId)
    {

        $info=Db::name('s_koudai')->where('koudai_id',$dataId)->setInc('koudai_forward');
        return $info;
    }


    public function study(){
        return $this->hasMany("KoudaiUser","koudai_id","koudai_id");
    }

    public function user(){
        return $this->hasOne("KoudaiUser","koudai_id","koudai_id")->bind(['isStudy'=>"uid"]);
    }


}