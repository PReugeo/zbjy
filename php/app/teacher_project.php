<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/28
 * Time: 22:38
 */
//老师查询课程
require __DIR__.'/lib/fun.php';
$con = mysqlInit();
$phone = trim($_POST['phoneNumber']);
//使用手机号查询用户
$sql = "SELECT * FROM `zbjy_teacher` WHERE `phone` = '{$phone}' LIMIT 1";

$obj = mysqli_query($con, $sql);
if($obj){
    $res = mysqli_fetch_assoc($obj);
    $id = $res['id'];
    unset($sql,$obj,$res);
    $sql = "SELECT * FROM `teacher_subject` WHERE `teacher_id` = '{$id}' and `section_number` = 1";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $result = null;
        while($res = mysqli_fetch_assoc($obj)){
            $result[] = $res;
        }
        $json = json_encode($result);
        echo $json;
    }
}
