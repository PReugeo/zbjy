<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/21
 * Time: 0:48
 */
//学生录入课程
require 'lib/fun.php';
if(!empty($_POST['phoneNumber'])){
    $con = mysqlInit();
    $phone = $_POST['phoneNumber'];
    $sql = "SELECT `id` AS total FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}'";
    $obj = mysqli_query($con,$sql);
    $res = mysqli_fetch_assoc($obj);
        //获取课程变量将其插入数据库
    $id = $res['total'];
    $teacher_id = $_POST['teacher_id'];
    $subject = $_POST['subject'];
    $sql = "select * from `teacher_subject` where `teacher_id` = '{$teacher_id}' and `subject` = '{$subject}'";
    $obj = mysqli_query($con,$sql);
    if($obj){
        //数组计数器
        $i = 0;
        $val = '';
        unset($sql);
        while($result = mysqli_fetch_assoc($obj)){
            $res[$i] = $result;
            $classTime = $res[$i]['class_time'];
            $url = $res[$i]['class_url'];
            $classWeek = $res[$i]['class_week'];
            $intro = $res[$i]['intro'];
            $suit_people = $res[$i]['suit_people'];
            $img_url = $res[$i]['imt_url'];
            $updated = $res[$i]['section_number'];
            $i++;
            $val .= "('".{$updated}."',".{$img_url}.",".{$teacher_id}.",".{$suit_people}.",".{$intro}.",".{$user_id}.",".{$_SERVER['REQUEST_TIME']}.",".{$subject}.",".{$classTime}.",".{$url}.",".{$classWeek}.",)";
        }
        $val = rtrim($val,',');
        $sql = "INSERT `zbjy_student_subject`(`updated`,`img_url`,`teacher_id`,`suit_people`,`intro`,`user_id`,`create_time`,`subject`,`class_time`,`class_url`,`class_week`) values $val";
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