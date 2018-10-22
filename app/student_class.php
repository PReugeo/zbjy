<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/21
 * Time: 0:48
 */
//学生录入课程
require 'lib/fun.php';
session_start();
if(!empty($_POST['phoneNumber'])){
    $con = mysqlInit();
    $phone = $_POST['phoneNumber'];
    $sql = "SELECT `id` AS total FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}'";
    $obj = mysqli_query($con,$sql);

    if($obj){
        $res = mysqli_fetch_assoc($obj);
        unset($obj,$sql);
        //通过session是num自动递增来取随机url
        if(!$_SESSION['num']){
            $_SESSION['num'] = 1;
        }else {
            $_SESSION['num']++;
        }
        //获取课程变量将其插入数据库
        $id = $res['total'];
        $classTime = $_POST['class_time'];
        $url = $_POST['class_url'].$_SESSION['num'];
        $subject = $_POST['subject'];
        $classWeek = $_POST['class_week'];
        $sql = "INSERT `zbjy_student_subject`(`user_id`,`create_time`,`subject`,`class_time`,`class_url`,`class_week`) values('{$id}','{$_SERVER['REQUEST_TIME']}','{$subject}','{$classTime}','{$url}','{$classWeek}')";
        $obj = mysqli_query($con,$sql);
        if($obj){
            echo '插入成功';
        }else {
            echo mysqli_error($con);
        }
    }else {
        echo mysqli_error($con);
    }
}else {
    echo '请求非法';
}