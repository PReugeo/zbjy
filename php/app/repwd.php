<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/13
 * Time: 13:23
 */
require 'lib/fun.php';

$con = mysqlInit('139.129.240.196','root','root','zbjy');

if(!empty($_POST['phoneNumber'])){
    $phone = trim($_POST['phoneNumber']);
    //使用手机号查询用户
    $sql = "SELECT * FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}' LIMIT 1";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $res = mysqli_fetch_assoc($obj);
        if(isset($res) && $res>0){
            echo json(1);
        }else {
            echo json(0);
        }
    }else {
        echo "未知错误";
    }
}