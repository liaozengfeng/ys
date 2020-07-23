<?php
namespace app\api\controller;
use app\api\model\MoveGroup;
use think\console\command\make\Model;
use think\Controller;
use app\api\controller\CheckToken as checkToken;
use think\Db;
use app\api\model\Move;
use think\Exception;
use think\Request;

/**
 * 教育小程序首页视频接口类
 * Class Videos
 * @package app\api\controller
 */
class Cihui extends Controller
{


     /* 获取合集视频列表
     * group_id     合集id
     * */
    public function change(){
        return 'ERROR';
        $nt = time();
        $data = Db::table('lj_liuji')->select();
        $save = [];
        $keys = ['A','B','C','D'];
        foreach ($data as $k=>$val){
            $selctAnswer = [];
            $options =[$val['sy']];
            $selctSubject = '';
            while(count($options) < 4){
                $key = array_rand($data);
                if($k !== $key){
                    $options[] = $data[$key]['sy'];
                }
            }
            //打乱数组
            shuffle($options);
            foreach ($options as $ke=>$v){
                $selctAnswer[$keys[$ke]]=$v;
                if($v == $val['sy']){
                    $selctSubject = $keys[$ke];
                }
            }
            $save[] = [
                "cihui_name"=>$val['word'],
                'allAnswer'=>serialize($selctAnswer),
                "date"=>$nt,
                'tag'=>1,
                'level'=>4,
                'answer'=>$selctSubject,
            ];
        }
        Db::table('s_cihui')->insertAll($save);

        echo 'SUCCESS';
    }



}