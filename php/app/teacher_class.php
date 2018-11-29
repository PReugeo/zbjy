<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 11:09
 */
//老师发布课程
require 'lib/fun.php';
if(!empty($_POST['phoneNumber'])){
    //连接数据库获取教师id
    $con = mysqlInit();
    $phone = $_POST['phoneNumber'];
    $sql = "SELECT `id` AS total FROM `zbjy_teacher` WHERE `phoneNumber` = '{$phone}'";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $res = mysqli_fetch_assoc($obj);
        unset($sql,$obj);
        $teacherId = $res['total'];
        $teacherSubject = mysqli_real_escape_string($con,$_POST['subject']);
        $broadcastUrl = urlMake();
        $classTime = mysqli_real_escape_string($con,$_POST['class_time']);
        $res = mysqli_real_escape_string($con,$_POST['intro']);
        $suitPeople = mysqli_real_escape_string($con,$_POST['suit_people']);
        $sectionNumber = 0;
        $sql2 = "select * from `teacher_subject` where `teacher_id` = '{$teacherId}' and `subject` = '{$teacherSubject}' order by `section_number`";
        $obj2 = mysqli_query($con, $sql2);
        if($obj2){
            while($res = mysqli_fetch_assoc($obj2)){
                $sectionNumber = max($sectionNumber,$res['section_number']);
            }
        }
        $sectionNumber ++;
        $sql = "INSERT `teacher_subject`(`subject`,`class_url`,`teacher_id`,`class_time`,`intro`,`suit_people`,`is_del`,`section_number`) VALUES('{$teacherSubject}','{$broadcastUrl}','{$teacherId}','{$classTime}','{$res}','{$suitPeople}',0, '{$sectionNumber}')";
        $obj = mysqli_query($con,$sql);
        if($obj){
            echo '插入成功';
        }else {
            echo mysqli_error($con);
        }
    }
}else {
    echo '请求错误';
}