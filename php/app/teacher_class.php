<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 11:09
 */
//老师发布课程
require 'lib/fun.php';
if(!empty($_POST['phone'])){
    //连接数据库做登陆处理
    $con = mysqlInit();
    $phone = $_POST['phone'];
    $sql = "SELECT `id` AS total FROM `zbjy_teacher` WHERE `phone` = '{$phone}'";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $res = mysqli_fetch_assoc($obj);
        unset($sql,$obj);
        $teacherId = $res['total'];
    }
}else {
    echo '请求错误';
}