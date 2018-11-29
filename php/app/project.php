<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 16:40
 */
//查询学生课表
require "lib/fun.php";
$con = mysqlInit();

if(!empty($_POST['phoneNumber'])) {
    $phone = trim($_POST['phoneNumber']);
    //使用手机号查询用户
    $sql = "SELECT * FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}' LIMIT 1";
    $obj = mysqli_query($con, $sql);
    if($obj){
        $res = mysqli_fetch_assoc($obj);
        //获取学生的id
        $id = $res['id'];
        //清除变量
        unset($sql,$obj,$res);
        $sql = "SELECT * FROM `zbjy_student_subject` WHERE `user_id` = '{$id}'";
        $class = 0;//计数课时数
        $obj = mysqli_query($con,$sql);
        $arr = null;
        while($row = mysqli_fetch_assoc($obj)){
            $arr[] = $row;
            $class++;
        }
        $json = json_encode($arr);
        echo $json;
    }
}