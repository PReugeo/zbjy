<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/13
 * Time: 12:21
 */
/**
 * 密码加密函数
 * @param $pwd
 * @return string
 */
function createPassword($pwd){
    return md5(md5($pwd).'yyf');
}

/**
 * 进入数据库函数
 * @param $host
 * @param $user
 * @param $pwd
 * @param $dbName
 * @param string $charset
 * @return bool|mysqli
 */
function mysqlInit($host='139.129.240.196',$user='root',$pwd='root',$dbName='zbjy',$charset='utf-8'){
    $con = mysqli_connect($host,$user,$pwd);
    if(!$con){
        return false;
    }
    mysqli_select_db($con,$dbName);
    mysqli_set_charset($con,$charset);
    return $con;
}

/**
 * 创建老师直播地址
 * @return string
 */
function urlMake(){
    $url = "rtmp://119.23.24.229/vod/video".$_SERVER['REQUEST_TIME'].'-'.date('Y-m-d').'.flv';
    return $url;
}