<?php
//header("Content-Type:text/html; charset=UTF-8");

/**
 * 分页函数
 * @author Shann Huang <851188611@qq.com>
 * @param  int $total_record 分页总记录数
 * @param  int $per_record   每页记录数
 * @param  string $class_name   样式名称， 可选值[digg|yahoo|flickr|sabrosus|scott|quotes|black2|grayr|yellow|jogger|starcraft2|tres|megas512|technorati|youtube|msdn|badoo|manu|viciao|yahoo2]
 * @return string               分页HTML
 */
function paging($total_record, $per_record, $class_name){

    $total_page=ceil( $total_record / $per_record ); // 分页总页数
    $offset=isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // 查询偏移量

    // 解决多参数问题
    unset($_GET['offset']);
    $param="";
    foreach ($_GET as $key => $value) {
        $param.=$key."=".$value."&";
    }

    // 分页HTML开始
    $html="<div class='{$class_name}'>"; 

    // 上一页
    if($offset > 0){
        $prev=$offset-$per_record;
        $html.="<a href='?{$param}offset={$prev}'>上一页</a>";
    }else{
        $html.="<span class='disabled'>上一页</span>";
    }
    //当前页面$now_page=(int)$offset/$per_record+1;
	//$now_record=(int)($now_page-1)*$per_record;
    // 页码
    for ($i=1, $j=0; $i <= $total_page; $i++, $j+=$per_record) { 

        if($j==$offset){
            $html.="<span class='current'>{$i}</span>";
        }else{
            $html.="<a href='?{$param}offset={$j}'>{$i}</a>";
        }
        
    }

    // 下一页
    $maxOffset=($total_page-1)*$per_record;
    if ($offset < $maxOffset) {
        $next=$offset+$per_record;
        $html.="<a href='?{$param}offset={$next}'>下一页</a>";
    }else{
        $html.="<span class='disabled'>下一页</span>";
    }

    // 分页HTML结束
    $html.="</div><style>{$GLOBALS['style']}</style>";

    return $html;
}

$style=<<<css
/*css digg style pagination*/
div.digg { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.digg a { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #aaaadd 1px solid;border-right: #aaaadd 1px solid; border-bottom: #aaaadd 1px solid; border-left: #aaaadd 1px solid; color: #000099; text-decoration: none;}
div.digg a:hover { border-top: #000099 1px solid;border-right: #000099 1px solid; border-bottom: #000099 1px solid; border-left: #000099 1px solid; color: #000;}
div.digg a:active { border-top: #000099 1px solid;border-right: #000099 1px solid; border-bottom: #000099 1px solid; border-left: #000099 1px solid; color: #000;}
div.digg span.current { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #000099 1px solid;border-right: #000099 1px solid; border-bottom: #000099 1px solid; border-left: #000099 1px solid; background-color: #000099; color: #fff; font-weight: bold;}
div.digg span.disabled {cursor:pointer; margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #eee 1px solid;border-right: #eee 1px solid; border-bottom: #eee 1px solid; border-left: #eee 1px solid; color: #ddd;}

/*css yahoo style pagination*/
div.yahoo { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.yahoo a { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #fff 1px solid;border-right: #fff 1px solid; border-bottom: #fff 1px solid; border-left: #fff 1px solid; color: #000099; text-decoration: underline;}
div.yahoo a:hover { border-top: #000099 1px solid;border-right: #000099 1px solid; border-bottom: #000099 1px solid; border-left: #000099 1px solid; color: #000;}
div.yahoo a:active { border-top: #000099 1px solid;border-right: #000099 1px solid; border-bottom: #000099 1px solid; border-left: #000099 1px solid; color: #f00;}
div.yahoo span.current { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #fff 1px solid;border-right: #fff 1px solid; border-bottom: #fff 1px solid; border-left: #fff 1px solid; background-color: #fff; color: #000; font-weight: bold;}
div.yahoo span.disabled {cursor:pointer; margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #eee 1px solid;border-right: #eee 1px solid; border-bottom: #eee 1px solid; border-left: #eee 1px solid; color: #ddd;}

/*css flickr style pagination*/
div.flickr { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.flickr a { margin-right: 3px; padding-top: 2px; padding-right: 6px; padding-bottom: 2px; padding-left: 6px; border-top: #dedfde 1px solid;border-right: #dedfde 1px solid; border-bottom: #dedfde 1px solid; border-left: #dedfde 1px solid; background-position: 50% bottom; color: #0061de; text-decoration: none;}
div.flickr a:hover { border-top: #000 1px solid;border-right: #000 1px solid; border-bottom: #000 1px solid; border-left: #000 1px solid; background-color: #0061de; background-image: none; color: #fff;}
div.meneame a:active { border-top: #000 1px solid;border-right: #000 1px solid; border-bottom: #000 1px solid; border-left: #000 1px solid; background-color: #0061de; background-image: none; color: #fff;}
div.flickr span.current { margin-right: 3px; padding-top: 2px;padding-right: 6px; padding-bottom: 2px; padding-left: 6px; color: #ff0084; font-weight: bold;}
div.flickr span.disabled {cursor:pointer; margin-right: 3px; padding-top: 2px;padding-right: 6px; padding-bottom: 2px; padding-left: 6px; color: #adaaad;}

/*css sabrosus style pagination*/
div.sabrosus { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.sabrosus a { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #9aafe5 1px solid;border-right: #9aafe5 1px solid; border-bottom: #9aafe5 1px solid; border-left: #9aafe5 1px solid; color: #2e6ab1; text-decoration: none;}
div.sabrosus a:hover { border-top: #2b66a5 1px solid;border-right: #2b66a5 1px solid; border-bottom: #2b66a5 1px solid; border-left: #2b66a5 1px solid; background-color: lightyellow; color: #000;}
div.pagination a:active { border-top: #2b66a5 1px solid;border-right: #2b66a5 1px solid; border-bottom: #2b66a5 1px solid; border-left: #2b66a5 1px solid; background-color: lightyellow; color: #000;}
div.sabrosus span.current { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: navy 1px solid;border-right: navy 1px solid; border-bottom: navy 1px solid; border-left: navy 1px solid; background-color: #2e6ab1; color: #fff; font-weight: bold;}
div.sabrosus span.disabled {cursor:pointer; margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #929292 1px solid;border-right: #929292 1px solid; border-bottom: #929292 1px solid; border-left: #929292 1px solid; color: #929292;}

/*css scott style pagination*/
div.scott { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.scott a { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #ddd 1px solid;border-right: #ddd 1px solid; border-bottom: #ddd 1px solid; border-left: #ddd 1px solid; color: #88af3f; text-decoration: none;}
div.scott a:hover { border-top: #85bd1e 1px solid;border-right: #85bd1e 1px solid; border-bottom: #85bd1e 1px solid; border-left: #85bd1e 1px solid; background-color: #f1ffd6; color: #638425;}
div.scott a:active { border-top: #85bd1e 1px solid;border-right: #85bd1e 1px solid; border-bottom: #85bd1e 1px solid; border-left: #85bd1e 1px solid; background-color: #f1ffd6; color: #638425;}
div.scott span.current { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #b2e05d 1px solid;border-right: #b2e05d 1px solid; border-bottom: #b2e05d 1px solid; border-left: #b2e05d 1px solid; background-color: #b2e05d; color: #fff; font-weight: bold;}
div.scott span.disabled {cursor:pointer; margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #f3f3f3 1px solid;border-right: #f3f3f3 1px solid; border-bottom: #f3f3f3 1px solid; border-left: #f3f3f3 1px solid; color: #ccc;}

/*css quotes style pagination*/

div.quotes { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.quotes a { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #ddd 1px solid;border-right: #ddd 1px solid; border-bottom: #ddd 1px solid; border-left: #ddd 1px solid; color: #aaa; text-decoration: none;}
div.quotes a:hover { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #a0a0a0 1px solid;border-right: #a0a0a0 1px solid; border-bottom: #a0a0a0 1px solid; border-left: #a0a0a0 1px solid;}
div.quotes a:active { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #a0a0a0 1px solid;border-right: #a0a0a0 1px solid; border-bottom: #a0a0a0 1px solid; border-left: #a0a0a0 1px solid;}
div.quotes span.current { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #e0e0e0 1px solid;border-right: #e0e0e0 1px solid; border-bottom: #e0e0e0 1px solid; border-left: #e0e0e0 1px solid; background-color: #f0f0f0; color: #aaa; font-weight: bold;}
div.quotes span.disabled {cursor:pointer; margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #f3f3f3 1px solid;border-right: #f3f3f3 1px solid; border-bottom: #f3f3f3 1px solid; border-left: #f3f3f3 1px solid; color: #ccc;}

/*css black2 style pagination*/

div.black2 { margin: 3px; padding-top: 7px;padding-right: 7px; padding-bottom: 7px; padding-left: 7px; text-align: center;}
div.black2 a { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #000000 1px solid;border-right: #000000 1px solid; border-bottom: #000000 1px solid; border-left: #000000 1px solid; color: #000000; text-decoration: none;}
div.black2 a:hover { border-top: #000000 1px solid;border-right: #000000 1px solid; border-bottom: #000000 1px solid; border-left: #000000 1px solid; background-color: #000; color: #fff;}
div.black2 a:active { border-top: #000000 1px solid;border-right: #000000 1px solid; border-bottom: #000000 1px solid; border-left: #000000 1px solid; background-color: #000; color: #fff;}
div.black2 span.current { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #000000 1px solid;border-right: #000000 1px solid; border-bottom: #000000 1px solid; border-left: #000000 1px solid; background-color: #000000; color: #fff; font-weight: bold;}
div.black2 span.disabled {cursor:pointer; margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #eee 1px solid;border-right: #eee 1px solid; border-bottom: #eee 1px solid; border-left: #eee 1px solid; color: #ddd;}

/*css grayr style pagination*/

div.grayr { padding-top: 2px;padding-right: 2px; padding-bottom: 2px; padding-left: 2px; background-color: #c1c1c1; font-size: 11px; font-family: tahoma, arial, helvetica, sans-serif;}
div.grayr a { margin: 2px; padding-top: 2px;padding-right: 5px; padding-bottom: 2px; padding-left: 5px; background-color: #c1c1c1; color: #000; text-decoration: none;}
div.grayr a:hover { background-color: #99ffff;color: #000;}
div.grayr a:active { background-color: #99ffff;color: #000;}
div.grayr span.current { margin: 2px; padding-top: 2px;padding-right: 5px; padding-bottom: 2px; padding-left: 5px; background-color: #fff; color: #303030; font-weight: bold;}
div.grayr span.disabled {cursor:pointer; margin: 2px; padding-top: 2px;padding-right: 5px; padding-bottom: 2px; padding-left: 5px; background-color: #c1c1c1; color: #797979;}




/*css yellow style pagination*/

div.yellow { margin: 3px; padding-top: 7px;padding-right: 7px; padding-bottom: 7px; padding-left: 7px; text-align: center;}
div.yellow a { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #ccc 1px solid;border-right: #ccc 1px solid; border-bottom: #ccc 1px solid; border-left: #ccc 1px solid; color: #000; text-decoration: none;}
div.yellow a:hover { border-top: #f0f0f0 1px solid;border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; border-left: #f0f0f0 1px solid; color: #000;}
div.yellow a:active { border-top: #f0f0f0 1px solid;border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; border-left: #f0f0f0 1px solid; color: #000;}
div.yellow span.current { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #d9d300 1px solid;border-right: #d9d300 1px solid; border-bottom: #d9d300 1px solid; border-left: #d9d300 1px solid; background-color: #d9d300; color: #fff; font-weight: bold;}
div.yellow span.disabled {cursor:pointer; margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #eee 1px solid;border-right: #eee 1px solid; border-bottom: #eee 1px solid; border-left: #eee 1px solid; color: #ddd;}



/*css jogger style pagination*/

div.jogger { margin: 7px; padding-top: 2px;padding-right: 2px; padding-bottom: 2px; padding-left: 2px; font-family: "lucida sans unicode", "lucida grande", lucidagrande, "lucida sans", geneva, verdana, sans-serif;}
div.jogger a { margin: 2px; padding-top: 0.5em;padding-right: 0.64em; padding-bottom: 0.43em; padding-left: 0.64em; background-color: #ee4e4e; color: #fff; text-decoration: none;}
div.jogger a:hover { margin: 2px; padding-top: 0.5em;padding-right: 0.64em; padding-bottom: 0.43em; padding-left: 0.64em; background-color: #de1818; color: #fff;}
div.jogger a:active { margin: 2px; padding-top: 0.5em;padding-right: 0.64em; padding-bottom: 0.43em; padding-left: 0.64em; background-color: #de1818; color: #fff;}
div.jogger span.current { margin: 2px; padding-top: 0.5em;padding-right: 0.64em; padding-bottom: 0.43em; padding-left: 0.64em; background-color: #f6efcc; color: #6d643c;}
div.jogger span.disabled {cursor:pointer;display: none;}



/*css starcraft2 style pagination*/

div.starcraft2 { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; background-color: #000; color: #fff; text-align: center; font-weight: bold; font-size: 13.5pt; font-family: arial;}
div.starcraft2 a {margin: 2px; background-color: #000; color: #fa0; text-decoration: none;}
div.starcraft2 a:hover { background-color: #000;color: #fff;}
div.starcraft2 a:active { background-color: #000;color: #fff;}
div.starcraft2 span.current { margin: 2px; background-color: #000; color: #fff;font-weight: bold;}
div.starcraft2 span.disabled {cursor:pointer;margin: 2px; background-color: #000; color: #444;}



/*css tres style pagination*/

div.tres { margin: 3px; padding-top: 7px;padding-right: 7px; padding-bottom: 7px; padding-left: 7px; text-align: center; font-weight: bold; font-size: 13.2pt; font-family: arial, helvetica, sans-serif;}
div.tres a { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #d9d300 2px solid;border-right: #d9d300 2px solid; border-bottom: #d9d300 2px solid; border-left: #d9d300 2px solid; background-color: #d90; color: #fff; text-decoration: none;}
div.tres a:hover { border-top: #ff0 2px solid;border-right: #ff0 2px solid; border-bottom: #ff0 2px solid; border-left: #ff0 2px solid; background-color: #ff0; color: #000;}
div.tres a:active { border-top: #ff0 2px solid;border-right: #ff0 2px solid; border-bottom: #ff0 2px solid; border-left: #ff0 2px solid; background-color: #ff0; color: #000;}
div.tres span.current { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #fff 2px solid;border-right: #fff 2px solid; border-bottom: #fff 2px solid; border-left: #fff 2px solid; color: #000; font-weight: bold;}
div.tres span.disabled {cursor:pointer;display: none;}



/*css megas512 style pagination*/

div.megas512 { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.megas512 a { margin-right: 3px; padding-top: 2px; padding-right: 6px; padding-bottom: 2px; padding-left: 6px; border-top: #dedfde 1px solid;border-right: #dedfde 1px solid; border-bottom: #dedfde 1px solid; border-left: #dedfde 1px solid; background-position: 50% bottom; color: #99210b; text-decoration: none;}
div.megas512 a:hover { border-top: #000 1px solid;border-right: #000 1px solid; border-bottom: #000 1px solid; border-left: #000 1px solid; background-color: #777777; background-image: none; color: #fff;}
div.megas512 a:active { border-top: #000 1px solid;border-right: #000 1px solid; border-bottom: #000 1px solid; border-left: #000 1px solid; background-color: #777777; background-image: none; color: #fff;}
div.megas512 span.current { margin-right: 3px; padding-top: 2px;padding-right: 6px; padding-bottom: 2px; padding-left: 6px; color: #99210b; font-weight: bold;}
div.megas512 span.disabled {cursor:pointer; margin-right: 3px; padding-top: 2px;padding-right: 6px; padding-bottom: 2px; padding-left: 6px; color: #adaaad;}



/*css technorati style pagination*/

div.technorati { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
div.technorati a { margin-right: 3px; padding-top: 2px; padding-right: 6px; padding-bottom: 2px; padding-left: 6px; border-top: #ccc 1px solid;border-right: #ccc 1px solid; border-bottom: #ccc 1px solid; border-left: #ccc 1px solid; background-position: 50% bottom; color: rgb(66,97,222); text-decoration: none; font-weight: bold;}
div.technorati a:hover { background-color: #4261df;background-image: none; color: #fff;}
div.technorati a:active { background-color: #4261df;background-image: none; color: #fff;}
div.technorati span.current { margin-right: 3px; padding-top: 2px;padding-right: 6px; padding-bottom: 2px; padding-left: 6px; color: #000; font-weight: bold;}
div.technorati span.disabled {cursor:pointer;display: none;}



/*css youtube style pagination*/

div.youtube { padding-top: 4px;padding-right: 6px; padding-bottom: 4px; padding-left: 0px; border-top: #9c9a9c 1px dotted; background-color: #cecfce; color: #313031; text-align: right; font-size: 13px; font-family: arial, helvetica, sans-serif;}
div.youtube a { margin: 0px 1px; padding-top: 1px;padding-right: 3px; padding-bottom: 1px; padding-left: 3px; color: #0030ce; text-decoration: underline; font-weight: bold;}
div.youtube a:hover { }
div.youtube a:active { }
div.youtube span.current { padding-top: 1px;padding-right: 2px; padding-bottom: 1px; padding-left: 2px; background-color: #fff; color: #000;}
div.youtube span.disabled {cursor:pointer;display: none;}




/*css msdn style pagination*/

div.msdn { padding-top: 4px;padding-right: 6px; padding-bottom: 4px; padding-left: 0px; background-color: #fff; color: #313031; text-align: right; font-size: 13px; font-family: verdana,tahoma,arial,helvetica,sans-serif;}
div.msdn a { margin: 0px 3px; padding-top: 5px; padding-right: 6px; padding-bottom: 4px; padding-left: 5px; border-top: #b7d8ee 1px solid;border-right: #b7d8ee 1px solid; border-bottom: #b7d8ee 1px solid; border-left: #b7d8ee 1px solid; color: #0030ce; text-decoration: none;}
div.msdn a:hover { border-top: #b7d8ee 1px solid;border-right: #b7d8ee 1px solid; border-bottom: #b7d8ee 1px solid; border-left: #b7d8ee 1px solid; background-color: #d2eaf6; color: #0066a7;}
div.pagination a:active { border-top: #b7d8ee 1px solid;border-right: #b7d8ee 1px solid; border-bottom: #b7d8ee 1px solid; border-left: #b7d8ee 1px solid; background-color: #d2eaf6; color: #0066a7;}
div.msdn span.current { margin: 0px 3px; padding-top: 5px; padding-right: 6px; padding-bottom: 4px; padding-left: 5px; border-top: #b7d8ee 1px solid;border-right: #b7d8ee 1px solid; border-bottom: #b7d8ee 1px solid; border-left: #b7d8ee 1px solid; background-color: #d2eaf6; color: #444444; font-weight: bold;}
div.msdn span.disabled {cursor:pointer;display: none;}




/*css badoo style pagination*/

div.badoo { padding-top: 10px;padding-right: 0px; padding-bottom: 10px; padding-left: 0px; background-color: #fff; color: #48b9ef; text-align: center; font-size: 13px; font-family: arial, helvetica, sans-serif;}
div.badoo a { margin: 0px 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #f0f0f0 2px solid;border-right: #f0f0f0 2px solid; border-bottom: #f0f0f0 2px solid; border-left: #f0f0f0 2px solid; color: #48b9ef; text-decoration: none;}
div.badoo a:hover { border-top: #ff5a00 2px solid;border-right: #ff5a00 2px solid; border-bottom: #ff5a00 2px solid; border-left: #ff5a00 2px solid; color: #ff5a00;}
div.badoo a:active { border-top: #ff5a00 2px solid;border-right: #ff5a00 2px solid; border-bottom: #ff5a00 2px solid; border-left: #ff5a00 2px solid; color: #ff5a00;}
div.badoo span.current { padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #ff5a00 2px solid;border-right: #ff5a00 2px solid; border-bottom: #ff5a00 2px solid; border-left: #ff5a00 2px solid; background-color: #ff6c16; color: #fff; font-weight: bold;}
div.badoo span.disabled {cursor:pointer;display: none;}





/*css manu style pagination*/

.manu { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center;}
.manu a { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #eee 1px solid;border-right: #eee 1px solid; border-bottom: #eee 1px solid; border-left: #eee 1px solid; color: #036cb4; text-decoration: none;}
.manu a:hover { border-top: #999 1px solid;border-right: #999 1px solid; border-bottom: #999 1px solid; border-left: #999 1px solid; color: #666;}
.manu a:active { border-top: #999 1px solid;border-right: #999 1px solid; border-bottom: #999 1px solid; border-left: #999 1px solid; color: #666;}
.manu .current { margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #036cb4 1px solid;border-right: #036cb4 1px solid; border-bottom: #036cb4 1px solid; border-left: #036cb4 1px solid; background-color: #036cb4; color: #fff; font-weight: bold;}
.manu .disabled {cursor:pointer; margin: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #eee 1px solid;border-right: #eee 1px solid; border-bottom: #eee 1px solid; border-left: #eee 1px solid; color: #ddd;}

/*css viciao style pagination*/

div.viciao {margin-top: 20px; margin-bottom: 10px;}
div.viciao a { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #8db5d7 1px solid;border-right: #8db5d7 1px solid; border-bottom: #8db5d7 1px solid; border-left: #8db5d7 1px solid; color: #000; text-decoration: none;}
div.viciao a:hover { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: red 1px solid;border-right: red 1px solid; border-bottom: red 1px solid; border-left: red 1px solid;}
div.viciao a:active { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: red 1px solid;border-right: red 1px solid; border-bottom: red 1px solid; border-left: red 1px solid;}
div.viciao span.current { margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #e89954 1px solid;border-right: #e89954 1px solid; border-bottom: #e89954 1px solid; border-left: #e89954 1px solid; background-color: #ffca7d; color: #000; font-weight: bold;}
div.viciao span.disabled {cursor:pointer; margin-right: 2px; padding-top: 2px; padding-right: 5px; padding-bottom: 2px; padding-left: 5px; border-top: #ccc 1px solid;border-right: #ccc 1px solid; border-bottom: #ccc 1px solid; border-left: #ccc 1px solid; color: #ccc;}





/*css yahoo2 style pagination*/

div.yahoo2 { margin: 3px; padding-top: 3px;padding-right: 3px; padding-bottom: 3px; padding-left: 3px; text-align: center; font-size: 0.85em; font-family: tahoma,helvetica,sans-serif;}
div.yahoo2 a { margin-right: 3px; padding-top: 2px; padding-right: 8px; padding-bottom: 2px; padding-left: 8px; border-top: #ccdbe4 1px solid;border-right: #ccdbe4 1px solid; border-bottom: #ccdbe4 1px solid; border-left: #ccdbe4 1px solid; background-position: 50% bottom; color: #0061de; text-decoration: none;}
div.yahoo2 a:hover { border-top: #2b55af 1px solid;border-right: #2b55af 1px solid; border-bottom: #2b55af 1px solid; border-left: #2b55af 1px solid; background-color: #3666d4; background-image: none; color: #fff;}
div.yahoo2 a:active { border-top: #2b55af 1px solid;border-right: #2b55af 1px solid; border-bottom: #2b55af 1px solid; border-left: #2b55af 1px solid; background-color: #3666d4; background-image: none; color: #fff;}
div.yahoo2 span.current { margin-right: 3px; padding-top: 2px;padding-right: 6px; padding-bottom: 2px; padding-left: 6px; color: #000; font-weight: bold;}
div.yahoo2 span.disabled {cursor:pointer;display: none;}
div.yahoo2 a.next { margin: 0px 0px 0px 10px; border-top: #ccdbe4 2px solid;border-right: #ccdbe4 2px solid; border-bottom: #ccdbe4 2px solid; border-left: #ccdbe4 2px solid;}
div.yahoo2 a.next:hover { border-top: #2b55af 2px solid;border-right: #2b55af 2px solid; border-bottom: #2b55af 2px solid; border-left: #2b55af 2px solid;}
div.yahoo2 a.prev { margin: 0px 10px 0px 0px; border-top: #ccdbe4 2px solid;border-right: #ccdbe4 2px solid; border-bottom: #ccdbe4 2px solid; border-left: #ccdbe4 2px solid;}
div.yahoo2 a.prev:hover { border-top: #2b55af 2px solid;border-right: #2b55af 2px solid; border-bottom: #2b55af 2px solid; border-left: #2b55af 2px solid;}
css;

