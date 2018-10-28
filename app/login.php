<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/13
 * Time: 12:19
 */
require "lib/fun.php";
if(!empty($_POST['phoneNumber'])){
    $phone = trim($_POST['phoneNumber']);
    $pwd = trim($_POST['pwd']);

    $con = mysqlInit('139.129.240.196','root','root','zbjy');
    //根据手机号查询用户
    $sql = "SELECT * FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}' LIMIT 1";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $res = mysqli_fetch_assoc($obj);
        //判断密码是否正确
        if(is_array($res) && !empty($res)){
            if(createPassword($pwd) === $res['pwd']){
                echo json(1);
            }else {
                echo json(0);
            }
        }else {
           echo mysqli_error($con);
        }
    }else {
      echo '未知错误';
    }
}