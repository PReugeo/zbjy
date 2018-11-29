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
    $sql2 = "select * from `teacher_subject` where `id` = '{$id}'";
    $obj2 = mysqli_query($con, $sql2);
    while ($result = mysqli_fetch_assoc($obj2)){
        $nowSubject = $result['subject'];
        $sql = "update `teacher_subject` set `is_del` = 0";
    }
    $obj = mysqli_query($con, $sql);
    if($obj){
        echo "删除成功";
    }
}