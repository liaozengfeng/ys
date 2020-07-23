<?php
/**
 * 连接数据库
 * @author Shann Huang <851188611@qq.com>
 * @param string $username 数据库用户名
 * @param string $password 数据库密码
 * @param string $dbname 选择连接的数据库名称
 * @param string $localhost 主机名，默认值是"localhost"
 */
function connect($username,$password,$dbname, $localhost='127.0.0.1'){
    // 连接数据库
    mysql_connect($localhost, $username, $password) or die('连接数据库失败');
    
    // 设置通信编码
    mysql_query('set names utf8') or die('设置编码出错');
    
    // 选择数据库
    mysql_select_db($dbname) or die('你选择的数据库不存在');
}

/**
 * 获取多行记录
 * @author Shann Huang <851188611@qq.com>
 * @param string $sql 查询语句
 * @return array 如果查询结果不为空，则返回有数据的数组，反之返回空数组
 */
function selectAll($sql){
    $result=mysql_query($sql);
    $data=array();
    if( $result && mysql_num_rows($result) ){
        while( $row=mysql_fetch_assoc($result) ){
            $data[]=$row;
        }
    }
    
    return $data;
}

function selectRow($sql){
    /*
        方案一：
        $result=mysql_query($sql);
        $data=array();
        if($result && mysql_num_rows($result)){
            $data=mysql_fetch_assoc($result);
        }
        return $data;
    */
    
    /* 方案二 */
    return current( selectAll($sql) );
}

function insert($sql){
    // 执行传进来的sql语句
    mysql_query($sql);
    // 如果通过mysql_insert_id()能获取到插入id，则返回true，反之返回false
    if( mysql_insert_id() ){
        return true;
    }else{
        return false;
    }
}

function add($tablename, $data){
    $fields=implode(',', array_keys($data)); // 组装字段
    $values="'".implode("','", array_values($data))."'"; // 组装值
    // 整合sql语句
    $sql="INSERT INTO {$tablename}({$fields}) VALUES({$values})";
    // 调用insert()继续执行插入
    return insert($sql);
}

// $sql="UPDATE 表名 SET 字段1=字段1值，字段2=字段2值";
function update($sql){

    mysql_query($sql);
    // -1 0 1 2 3
    if( mysql_affected_rows() > 0){
        return true;
    }else{
        return false;
    }
}

function edit($tablename, $data, $conditions){
    $temp=array(); // 临时变量
    /*
        $data=array(
            'k1'=>'v1',
            'k2'=>'v2'
        );
    */
    foreach($data as $k=>$v){
        // 1> $temp[0]=k1='v1';
        // 2> $temp[1]=k2='v2';
        $temp[]=$k."='".$v."'";
    }
    // $data=" k1='v1',k2='v2' ";
    $data=implode(',', $temp); // 得到转换后的数据格式

    $sql="UPDATE {$tablename} SET {$data} WHERE {$conditions}";
    
    return update($sql);
}

function delete($tablename, $condition){
    $sql="DELETE FROM {$tablename} WHERE {$condition}";
    
    mysql_query($sql);
    
    if( mysql_affected_rows() ){
        return true;
    }else{
        return false;
    }
}



?>