<?php
/**
 * 初始化文件
 */
// 网站根目录
define('ROOT_PATH', str_replace('\\', '/', dirname( dirname(__FILE__) ) ) ); 
 
// 设置页面显示编码
header('Content-Type:text/html;charset=utf-8');

// 时区设置
date_default_timezone_set('Asia/Shanghai');

// 错误报告(开发环境:E_ALL ^ E_NOTICE;生产环境:0)
error_reporting(E_ALL ^ E_NOTICE);

// 包含文件
require(ROOT_PATH.'/include/database.lib.php');
require(ROOT_PATH.'/include/function.lib.php');
require(ROOT_PATH.'/include/paging.php');

connect('root','Xinglu2017','sam');
?>