<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 22:46
 */
require 'lib/fun.php';
if(!empty($_POST['id'])){
    $con = mysqlInit();
    $id = $_POST['id'];
    $sql = "select * from `teacher_subject` where `id` = '{$id}' LIMIT 1";
    $obj = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($obj);

    $sql = "UPDATE `teacher_subject` SET `is_del` = 0 WHERE `subject` = '{$result['subject']}' AND `teacher_id` = '{$result['teacher_id']}'";
    $obj = mysqli_query($con, $sql);
    if($obj){
        echo "删除成功";
    }
}