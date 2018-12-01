<?php
/**
 * 老师修改课程
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 20:18
 */
require 'lib/fun.php';
if(!empty($_POST['id'])){
    $con = mysqlInit();
    $phone = $_POST['phoneNumber'];
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $classTime = $_POST['class_time'];
    $intro = $_POST['intro'];
    $suitPeople = $_POST['suit_people'];
    $sql2 = "select * from `teacher_subject` where `id` = '{$id}'";
    $obj2 = mysqli_query($con, $sql2);
    while ($result = mysqli_fetch_assoc($obj2)){
        $nowSubject = $result['subject'];
        $sql = "update `teacher_subject` set `subject` = '{$subject}', `intro` = '{$intro}', `class_time` = '{$classTime}', `suit_people` = '{$suitPeople}' where `subject` = '{$nowSubject}'";
        $obj = mysqli_query($con, $sql);
        if($obj){
            echo "修改成功";
        }else {
            echo mysqli_error($con);
        }
    }
}
