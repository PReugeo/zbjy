<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 18:13
 */
require __DIR__.'/lib/fun.php';
if(!empty($_POST['learned'])){
    $con = mysqlInit();
    $classId = $_POST['class_id'];
    $sql = "SELECT * FROM `zbjy_student_subject` WHERE `class_id` = '{$classId}'";
    $obj = mysqli_query($con, $sql);
    if($obj){
        $res = mysqli_fetch_assoc($obj);
        if($res['learned'] !== 1) {
            $sqlToClass = "UPDATE `zbjy_student_subject` SET `learned` = 1 WHERE `class_id` = '{$classId}'";
            $obj1 = mysqli_query($con, $sqlToClass);
            $sqlToSubject = "UPDATE `zbjy_student_subject_index` SET `learned` = `learned` + 1  WHERE `subject` = '{$res['subject']}' AND `student_id` = '{$res['student_id']}'";
            if(!$obj2 = mysqli_query($con, $sqlToSubject)){
                echo mysqli_error($con);
            }
        }
    }else {
        echo mysqli_error($con);
    }
}else {
    echo "请求非法";
}