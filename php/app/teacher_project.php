<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/28
 * Time: 22:38
 */

require __DIR__.'lib/fun.php';
$con = mysqlInit();
$phone = trim($_POST['phoneNumber']);
//使用手机号查询用户
$sql = "SELECT * FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}' LIMIT 1";

$obj = mysqli_query($con, $sql);
if($obj){
    $res = mysqli_fetch_assoc($obj);
    $id = $res['id'];
    unset($sql,$obj,$res);
    $sql = "SELECT * FROM `teacher_subject` WHERE `user_id` = '{$id}'";
    $obj = mysqli_query($con,$sql);
    if($obj){
        while($res = mysqli_fetch_assoc($obj)){
            $result[] = $res;
        }
        $json = json_encode($result);
        echo $josn;
    }
}
