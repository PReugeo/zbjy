<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/13
 * Time: 16:03
 */
require "lib/fun.php";

if(!empty($_POST['phoneNumber'])){
    $con = mysqlInit();

    $phone = trim($_POST['phoneNumber']);

    $pwd = trim($_POST['pwd']);

    $pwd = createPassword($pwd);

    $sql = "SELECT * FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}' LIMIT 1";

    $obj = mysqli_query($con,$sql);
//判断用户是否存在
    if($obj){
        unset($sql,$obj);
        //更新数据库密码
        $sql = "UPDATE `zbjy_student` SET `pwd` = '{$pwd}' WHERE `phoneNumber` = '{$phone}'";
        $obj = mysqli_query($con,$sql);
        if($obj){
            echo json(1);
        }else {
            echo mysqli_error($con);
        }
    }
}