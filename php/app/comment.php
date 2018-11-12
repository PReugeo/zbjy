<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 22:31
 */
require __DIR__.'/lib/fun.php';
$con = mysqlInit();
$phone = trim($_POST['phoneNumber']);
$sql = "SELECT * FROM `zbjy_teacher` WHERE `phone` = '{$phone}' LIMIT 1";
$obj = mysqli_query($con, $sql);
if($obj){
    $res = mysqli_fetch_assoc($obj);
    $id = $res['id'];
    unset($sql,$obj,$res);
    $sql = "SELECT * FROM `student_comment` WHERE `teacher_id` = '{$id}'";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $result = null;
        while($res = mysqli_fetch_assoc($obj)){
            $result[] = $res;
        }
        $json = json_encode($result);
        echo $json;
    }else {
        echo mysqli_error($con);
    }
}else {
    echo mysqli_error($con);
}