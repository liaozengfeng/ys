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
class Videos extends Controller
{
    protected $err =[
        'code'=>1,
        'msg'=>'SUCCESS',
        'data'=>[]
    ];

    /**首页视频列表
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getPublicList()
    {

        $tag = input('tag')?input('tag'):'good';//good,video,short,collect
        $leavel = input('leavel');//-1 表示自动，0-4 表示 intro-Lv.4。默认 -1
        $id = input('id');//分享id
        $keywords = trim(input('keywords'));
        $p = input('p') ? input('p') : 1;
        $data=array();
        $where=array();
        if($tag=='collect'){  //收藏
            $uid = input('uid');
            $token = input('token');
            $user = new checkToken($uid, $token);
            $isCheck = $user->check();
            if($isCheck){
                if($id){
                    $where['m.move_id']=$id;
                }
                if($keywords){
                    $where['m.move_name'] = array('like', "%{$keywords}%");
                }
                $where['mu.uid'] = $uid;
                if(!isset($leavel) || $leavel<0){
                    $arr = Db::table('s_move_user')
                        ->alias('mu')
                        ->join('s_move m', 'mu.move_id=m.move_id', 'LEFT')
                        ->field('m.move_id,m.move_name,m.move_video,m.move_cover,m.move_time,m.move_leav,m.move_play,mu.uid as uid')
                        ->where($where)->orderRaw('rand()')->limit(10)->page($p)->select();
                }else{

                    $where['m.move_leav']=$leavel;
                    $arr = Db::table('s_move_user')
                        ->alias('mu')
                        ->join('s_move m', 'mu.move_id=m.move_id', 'LEFT')
                        ->field('m.move_id,m.move_name,m.move_video,m.move_time,m.move_cover,m.move_leav,m.move_play,mu.uid as uid')
                        ->where($where)->limit(10)->page($p)->select();
                }
                if(!$arr || empty($arr)){
                    $data = array(
                        'code' => 200,
                        'data' => [],
                        'msg' => "No Data!!"
                    );
                }else{
                    $data = array(
                        'code' => 200,
                        'data' => $arr,
                        'msg' => "success"
                    );
                }

            }else{
                $data = [
                    'code' => 404,
                    'data' => [],
                    'msg' => "Invaild Token"
                ];
            }
        }
        elseif($tag=='good'){   //推荐视频
            if($id){
                $where['move_id']=$id;
            }
            if($keywords){
                $where['move_name'] = array('like', "%{$keywords}%");
            }
            $where['good']=1;

            if(!isset($leavel) || $leavel<0){

                $arr = Db::table('s_move')
                    ->field('move_id,move_name,move_video,move_time,move_cover,move_leav,move_play')
                    ->where($where)->orderRaw('rand()')->limit(10)->page($p)->select();

             }else{
                $where['move_leav']=$leavel;
                $arr = Db::table('s_move')
                    ->field('move_id,move_name,move_video,move_time,move_cover,move_leav,move_play')
                    ->where($where)->limit(10)->page($p)->select();
             }
            if(!$arr || empty($arr)){
                $data = array(
                    'code' => 200,
                    'data' => [],
                    'msg' => "No Data"
                );
            }else{
                $data = array(
                    'code' => 200,
                    'data' => $arr,
                    'msg' => "success"
                );
            }

        }
        elseif($tag=='video'){   //视频合集

            if($keywords){
                $where['group_title'] = ['like', "%{$keywords}%"];
            }

            if(isset($leavel) && $leavel > -1){
                $where['level']=$leavel;
            }
            $arr = MoveGroup::withCount('moves')
                ->where($where)
                ->paginate(5,true,['var_page'=>"p"])
                ->each(function($item){
                $item['paly_total'] = Db::table('s_move')->where('group_id',$item['group_id'])->sum('move_play');
                $item['group'] = 1;
                return $item;
                });
            if($arr->isEmpty()){
                $data = array(
                    'code' => 200,
                    'data' => [],
                    'msg' => "No Data"
                );
            }else{
                $data = array(
                    'code' => 200,
                    'data' => $arr->items(),
                    'msg' => "success"
                );
            }

        }else{   //短片和电影区
            if($id){
                $where['move_id']=$id;
            }
            if($keywords){
                $where['move_name'] = array('like', "%{$keywords}%");
            }
            if($id){
                $where['move_id']=$id;
            }
            $where['move_flag']=$tag;

            if(!isset($leavel) || $leavel<0){
                $arr = Db::table('s_move')
                    ->field('move_id,move_name,move_video,move_time,move_cover,move_leav,move_play')
                    ->where($where)->orderRaw('rand()')->limit(10)->page($p)->select();

            }else{
               $where['move_leav']=$leavel;
                $arr = Db::table('s_move')
                    ->field('move_id,move_name,move_video,move_time,move_cover,move_leav,move_play')
                    ->where($where)->limit(10)->page($p)->select();
            }

            if(!$arr || empty($arr)){
                $data = array(
                    'code' => 200,
                    'data' => [],
                    'msg' => "No Data"
                );
            }else{
                $data = array(
                    'code' => 200,
                    'data' => $arr,
                    'msg' => "success"
                );
            }
        }
        return json($data);
    }


    /**
     *单个视频信息
     */
    public function getPublicOne()
    {
        $dataId = input('dataId');
        $uid = input('uid');
        $token = input('token');

        $user = new checkToken($uid, $token);
        $isCheck = $user->check();

        if ($isCheck) {  //已登录状态
            $find= Db::table('s_move')
                ->alias('m')
                ->join('s_user_study mu','mu.course_id=m.move_id and type=1 and mu.uid='.$uid,"LEFT")
                ->field('m.*,mu.id status')
                ->where('m.move_id',$dataId)
                ->find();

            $data = array(
                'code' => 200,
                'data' => $find,
                'msg' => "success"
            );
        }else{  //未登录状态
            $find = Db::table('s_move')->where('move_id',$dataId)->find();
            $data = array(
                'code' => 200,
                'data' => $find,
                'msg' => "success"
            );
        }
        return json($data);
    }

    /**
     * 视频播放量
     * @return \think\response\Json
     */
    public function sendMovePlay()
    {
        $dataId = input('dataId');
        $uid = input('uid');
        $token = input('token');
        if(!$dataId){
            $data = array(
                'code' => 404,
                'data' => [],
                'msg' => "No Resource"
            );
        }

        $user = new checkToken($uid, $token);
        $isCheck = $user->check();

        if ($isCheck) {
            $ModelMove=new Move();
            $res=$ModelMove->updatePlay($dataId);

            if (!$res || empty($res)) {
                $data = array(
                    'code' => 404,
                    'data' => [],
                    'msg' => "No Data"
                );
            } else {
                $data = array(
                    'code' => 200,
                    'data' => $res,
                    'msg' => "success"
                );
            }

        } else {
            $data = [
                'code' => 404,
                'data' => [],
                'msg' => "Invaild Token"
            ];
        }
        return json($data);
    }

    /**
     * 视频收藏与取消
     * @return \think\response\Json
     */
    public function sendMovCollection()
    {
        $dataId = input('dataId');
        $uid = input('uid');
        $token = input('token');
        $user = new checkToken($uid, $token);
        $isCheck = $user->check();

        if ($isCheck) {

            $isCollect=Db::table('s_collect')->where(['course_id'=>$dataId,'uid'=>$uid,'type'=>1])->find();

            if($isCollect){ //已收藏
                $ModelMove=new Move();
                $ModelMove->delCollection($dataId);
                Db::table('s_collect')->where(array('uid'=>$uid,'course_id'=>$dataId))->delete();
                $re=Db::table('s_move')->field('move_collection,move_forward')->where(array('move_id'=>$dataId))->find();
                $data = array(
                    'code' => 200,
                    'data' => [
                        'collection'=>$re['move_collection'],
                        'forward'=>$re['move_forward']
                    ],
                    'msg' => "已取消收藏",
                );

            }else{

                $ModelMove=new Move();
                $ModelMove->updateCollection($dataId);
                Db::table('s_collect')->insert(['course_id'=>$dataId,'uid'=>$uid,'create_time'=>time()]);
                $re=Db::table('s_move')->field('move_collection,move_forward')->where(array('move_id'=>$dataId))->find();
                $data = array(
                    'code' => 200,
                    'data' => array(
                        'collection'=>$re['move_collection'],
                        'forward'=>$re['move_forward']
                    ),
                    'msg' => "收藏成功"
                );

            }

        } else {
            $data = [
                'code' => 404,
                'data' => [],
                'msg' => "Invaild Token"
            ];
        }
        return json($data);
    }


    /**
     * 转发
     * 转发视频id  $dataId
     */

    public function sendMovForward()
    {
        $dataId = input('dataId');
        $ModelMove=new Move();
        $res=$ModelMove->updateForward($dataId);
        if (!$res || empty($res)) {
            $data = array(
                'code' => 200,
                'data' => [],
                'msg' => "No Data"
            );
        } else {
            Db::table('s_move_user')->insert(array('move_id'=>$dataId));

            $re=Db::table('s_move')->field('move_collection,move_forward')->where(array('move_id'=>$dataId))->find();
            $res=array(
                'collection'=>$re['move_collection'],
                'forward'=>$re['move_forward']
            );
            $data = array(
                'code' => 200,
                'data' => $res,
                'msg' => "success"
            );
        }
        return json($data);
    }

    /**
     * 开放视频字幕文件
     */
    public function getZimu()
    {
        $dataId = input('dataId');
        $res=Db::table('s_move')->field('move_id,move_zimu')->where(array('move_id'=>$dataId))->find();

        if (!$res || empty($res)) {
            $data = array(
                'code' => 200,
                'data' => [],
                'msg' => "No Data"
            );
        } else {

            $zimu=file_get_contents('.'.$res['move_zimu']);

//            $str =iconv("UTF-16LE", "utf-8//IGNORE",$zimu);
            $str =iconv("UTF-8", "utf-8//IGNORE",$zimu);

            $data = array(
                'code' => 200,
                'data' => $str,
                'msg' => "success"
            );

        }
        return json($data);
        //return json(['code'=>3]);
    }


    /*
    * 词汇查询
    * type  查询关联：1查询关联词汇，0不查询关联词汇。默认0
    * words     查询的词汇，多个词汇英文逗号分割
    * */
    public function words(){
        $type = input('type',0);
        $words = input('words','');
        try{
            if(!$words){
                throw new Exception('参数错误！');
            }
            $words = explode(',',$words);
            $word_arr = [];
            foreach ($words as $w){
                if($type){
                    $temp = $this->getRelation($w);
                }else{
                    $temp = [$w];
                }
                $word_arr = array_merge($word_arr,$temp);
            }
            $word_arr = array_unique($word_arr);
            $this->err['data'] = Db::table("s_words")->whereIn("word_name",$word_arr)->select();
            $this->err['code'] = 200;
        }catch (Exception $e){
            $this->err['msg'] = $e->getMessage();
        }
        return json($this->err);
    }

    //获取关联词汇
    private function getRelation($word){
        $relation = Db::table("s_words")->where('word_name',$word)->value('relation');
        $data = [$word];
        if($relation){
            $word_arr = explode(',',$relation);
            $data = array_merge($data,$word_arr);
        }
        $data = array_unique($data);
        return $data;
    }

    /*
     * 获取合集视频列表
     * group_id     合集id
     * */
    public function getGroupMove(){
        $group_id = input("group_id/d",0);
        $data = Db::table('s_move')
            ->field('move_id,move_name,move_video,move_time,move_cover,move_leav,move_play')
            ->where('group_id',$group_id)
            ->where('move_flag','video')
            ->select();
        $this->err['data']  = $data;
        $this->err['code'] = 200;
        return json($this->err);
    }



}