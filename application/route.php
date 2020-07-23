<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
Route::resource('user','api/user'); 
Route::rule('user/getUserInfo','api/user/getUserInfo');
Route::rule('user/getCourseType','api/user/getCourseType');
Route::rule('user/getCourseRecord','api/user/getCourseRecord');
Route::rule('user/getRule','api/user/getRule');
Route::rule('user/getCourseRule','api/user/getCourseRule');
Route::rule('user/getIeltsRule','api/user/getIeltsRule');
Route::rule('user/getShopRule','api/user/getShopRule');
Route::rule('user/form','api/user/form');   //formId uid token

Route::resource('timetable','api/timeTable'); 
Route::rule('timetable/getList','api/timeTable/getList');                  //uid token
Route::rule('timetable/getTcList','api/timeTable/getTcList');              //uid token
Route::rule('timetable/getCourseList','api/timeTable/getCourseList');      //uid token time 时间戳
Route::rule('timetable/getDayList','api/timeTable/getDayList');            //uid token time 时间戳
Route::rule('timetable/getDayTcList','api/timeTable/getDayTcList');        //uid token time 时间戳
Route::rule('timetable/getAttenceList','api/timeTable/getAttenceList');    //uid token type  id
Route::rule('timetable/saveAttenceList','api/timeTable/saveAttenceList');  //uid token type  id  sign absent


Route::resource('banner','api/banner'); 
Route::rule('banner/getBannerList','api/banner/getBannerList');
Route::rule('banner/getBannerInfo','api/banner/getBannerInfo');
Route::rule('banner/getGiftBannerList','api/banner/getGiftBannerList');

Route::resource('event','api/event'); 
Route::rule('event/eventList','api/event/eventList');
Route::rule('event/eventInfo','api/event/getEventInfo');//getUserEvent

Route::resource('course','api/course'); 
Route::rule('course/getCourseList','api/course/getCourseList');
Route::rule('course/getCourseListV2','api/timeTable/getCourseList');
Route::rule('course/getCourseInfo','api/course/getCourseInfo');
Route::rule('course/enroll','api/course/enroll');
Route::rule('course/cancel','api/course/cancel');

Route::resource('ielts','api/ielts'); 
Route::rule('ielts/getCourseList','api/ielts/getCourseList');
Route::rule('ielts/getCourseInfo','api/ielts/getCourseInfo');
Route::rule('ielts/enroll','api/ielts/enroll');
Route::rule('ielts/cancel','api/ielts/cancel');

Route::resource('learn','api/learn'); 
Route::rule('learn/getCircle','api/learn/getCircle');
Route::rule('learn/getCircleV2','api/learn/getCircleV2');
Route::rule('learn/getCircleV3','api/learn/getCircleV3');
Route::rule('learn/getCircleList','api/learn/getCircleList');
Route::rule('learn/getCircleListV2','api/learn/getCircleListV2');
Route::rule('learn/getLastTheme','api/learn/getLastTheme');
Route::rule('learn/getThemeList','api/learn/getThemeList');
Route::rule('learn/getThemeInfo','api/learn/getThemeInfo');
Route::rule('learn/getDairyList','api/learn/getDairyList');
Route::rule('learn/like','api/learn/like');
Route::rule('learn/comment','api/learn/comment');
Route::rule('learn/diary','api/learn/diary');
Route::rule('learn/delDiary','api/learn/delDiary'); // uid token rid
Route::rule('learn/delMark','api/learn/delMark'); // uid token mid
Route::rule('learn/delComment','api/learn/delComment'); // uid token cid
Route::rule('learn/audio','api/learn/audio');
Route::rule('learn/image','api/learn/image');
Route::rule('learn/remark','api/learn/remark');

Route::rule('learn/getBookDairyList','api/learn/getBookDairyList');
Route::rule('learn/bookDiary','api/learn/bookDiary');

Route::resource('book','api/book'); 
Route::rule('book/getBookList','api/book/getBookList');
Route::rule('book/getBookSection','api/book/getBookSection');
Route::rule('book/getSectionList','api/book/getSectionList');
Route::rule('book/getSectionInfo','api/book/getSectionInfo');
Route::rule('book/updateRead','api/learn/updateRead');

Route::resource('event','api/event'); 
Route::rule('event/getEventList','api/event/getEventList');
Route::rule('event/getEventInfo','api/event/getEventInfo');
Route::rule('event/enroll','api/event/enroll');


Route::resource('game','api/game'); 
Route::rule('game/uploadSelf','api/game/uploadSelf');


Route::rule('wx/getIp','api/wx/getIp');
Route::rule('login/wxLogin','api/login/wxLogin');
//--------------------------------------------------------------

Route::resource('classv','api/classv'); 
Route::rule('classv/add','api/classv/add');
Route::rule('classv/edit','api/classv/edit');
Route::rule('classv/del','api/classv/del');

Route::resource('room','api/room'); 
Route::rule('room/add','api/room/add');
Route::rule('room/edit','api/room/edit');
Route::rule('room/del','api/room/del');

Route::resource('times','api/times'); 
Route::rule('times/add','api/times/add');
Route::rule('times/edit','api/times/edit');
Route::rule('times/del','api/times/del');
Route::rule('times/roomAdd','api/times/roomAdd');
Route::rule('times/roomEdit','api/times/roomEdit');
Route::rule('times/roomDel','api/times/roomDel');
Route::rule('times/orderAdd','api/times/orderAdd');
Route::rule('times/orderEdit','api/times/orderEdit');
Route::rule('times/check','api/times/check');
Route::rule('times/setHide','api/times/setHide');
Route::rule('times/setShow','api/times/setShow');

Route::resource('coursev','api/coursev'); 
Route::rule('coursev/upload','api/coursev/upload');
Route::rule('coursev/uploadAll','api/coursev/uploadAll');
Route::rule('coursev/edit','api/coursev/edit');
Route::rule('coursev/del','api/coursev/del');
Route::rule('coursev/change','api/coursev/change');
Route::rule('coursev/autov','api/coursev/autov');

Route::resource('ieltsv','api/ieltsv'); 
Route::rule('ieltsv/upload','api/ieltsv/upload');
Route::rule('ieltsv/uploadAll','api/ieltsv/uploadAll');
Route::rule('ieltsv/edit','api/ieltsv/edit');
Route::rule('ieltsv/del','api/ieltsv/del');
Route::rule('ieltsv/change','api/ieltsv/change');
Route::rule('ieltsv/autov','api/coursev/autov');
//--------------------------------------------------------------
Route::resource('ysBanner','ys/banner'); 
Route::rule('ysBanner/getList','ys/banner/getBannerList');
Route::rule('ysBanner/getInfo','ys/banner/getBannerInfo');

Route::resource('ysNews','ys/news'); 
Route::rule('ysNews/getList','ys/news/getNewsList');
Route::rule('ysNews/getInfo','ys/news/getNewsInfo');
Route::rule('ysNews/searchList','ys/news/searchList');

Route::resource('ysLesson','ys/lesson'); 
Route::rule('ysLesson/getList','ys/lesson/getLessonsList');

Route::resource('ysUser','ys/user'); 
Route::rule('ysUser/getYsTest','ys/user/getYsTest');
Route::rule('ysUser/getRule','ys/user/getRule');
Route::rule('ysUser/uploadInfo','ys/user/uploadTestInfo');
Route::rule('ysUser/getYsInfo','ys/user/getYsScore');
Route::rule('ysUser/getDays','ys/user/getDays');   //uid token
Route::rule('ysUser/wxlogin','ys/user/wxlogin');  //bindTel
Route::rule('ysUser/bindTel','ys/user/bindTel'); 
Route::rule('ysUser/getInfo','ys/user/getInfo'); 
 
Route::resource('ysLearn','ys/learn');         //  cid -对应  1- 雅思听力  2-雅思口语 3-雅思阅读 4-雅思写作  tid 对应打卡主题
Route::rule('ysLearn/getThemeList','ys/learn/getThemeList'); //GET  cid  ysType 1- 雅思听力  2-雅思口语 3-雅思阅读 4-雅思写作
Route::rule('ysLearn/getThemeInfo','ys/learn/getThemeInfo'); //GET  tid  
Route::rule('ysLearn/getDairyList','ys/learn/getDairyList'); //GET  cid tid   
Route::rule('ysLearn/delDiary','ys/learn/delDiary');         //GET   uid token rid   //rid 对应打卡记录rid
Route::rule('ysLearn/delMark','ys/learn/delMark');           //GET   uid token mid   //mid 对应评分打卡记录mid
Route::rule('ysLearn/delComment','ys/learn/delComment');     //GET   uid token id    //id 对应评论打卡记录id
Route::rule('ysLearn/like','ys/learn/like');                 //GET   uid token rid   
Route::rule('ysLearn/comment','ys/learn/comment');           //POST   uid token rid  content 
Route::rule('ysLearn/remark','ys/learn/remark');             //POST   uid token rid score content
Route::rule('ysLearn/diary','ys/learn/diary');               //POST   uid token cid tid image second  sound content  
Route::rule('ysLearn/audio','ys/learn/audio');               //POST   sound
Route::rule('ysLearn/image','ys/learn/image');               //POST   image

Route::resource('ysTask','ys/task');  
Route::rule('ysTask/getUserTask','ys/task/getUserTaskList');  //GET   uid token type    //getUserCorrect 
Route::rule('ysTask/getUserCorrect','ys/task/getUserCorrect');  //GET   uid token hid 
Route::rule('ysTask/getHomeWorkList','ys/task/getHomeWorkList');   //getHomeWorkList
Route::rule('ysTask/getHomeWorkInfo','ys/task/getHomeWorkInfo'); 
Route::rule('ysTask/uploadHomeWork','ys/task/uploadHomeWork'); 
Route::rule('ysTask/uploadSpeak','ys/task/uploadSpeak'); 
Route::rule('ysTask/readSpeak','ys/task/readSpeak');  //GET   uid token hid 

Route::resource('ysSquare','ys/square');  
Route::rule('ysSquare/getList','ys/square/getList'); //GET   type
Route::rule('ysSquare/searchList','ys/square/searchList');   //GET  key
Route::rule('ysSquare/getInfo','ys/square/getInfo'); //GET  sid
Route::rule('ysSquare/delTopic','ys/square/delTopic');         //GET   uid token sid   
Route::rule('ysSquare/delComment','ys/square/delComment');     //GET   uid token id    
Route::rule('ysSquare/like','ys/square/like');                 //GET   uid token sid   
Route::rule('ysSquare/comment','ys/square/comment');           //POST   uid token sid  content 
Route::rule('ysSquare/sendTopic','ys/square/sendTopic');       //POST   uid token  image title type content  //setTop
Route::rule('ysSquare/setTop','ys/square/setTop');    //GET uid token sid

Route::resource('ysPay','ys/pay'); 
Route::rule('ysPay/getPayOrder','ys/pay/getPayOrder');  //GET uid token
Route::rule('ysPay/notify','ys/pay/notify');  

 
return [
    '__pattern__' => [
        'name' => '\w+',
    ],   
];
