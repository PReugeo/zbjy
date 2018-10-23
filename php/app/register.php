<?php
/**
 * Created by PhpStorm.
 * User: eugeoyan
 * Date: 2018/9/28
 * Time: 10:16
 */
require 'lib/fun.php';
$con = mysqli_connect('139.129.240.196','root','root');
if(!$con){
    return false;
}
mysqli_select_db($con,'zbjy');
mysqli_set_charset($con,'utf-8');

if(!empty($_POST['phoneNumber'])){
    $phone = trim($_POST['phoneNumber']);
    $pwd = trim($_POST['pwd']);
    $sql = "SELECT COUNT(`id`) AS total FROM `zbjy_Student`  WHERE `phoneNumber` = '{$phone}'";
    $obj = mysqli_query($con,$sql);
    $result = mysqli_fetch_assoc($obj);
    if(isset($result['total']) && $result['total'] > 0 ){
        echo '该手机已被注册';
        exit();
    }
    unset($obj,$sql,$result);
    $pwd = createPassword($pwd);
    $sql = "INSERT `zbjy_Student`(`phoneNumber`,`pwd`,`create_time`) values('{$phone}','{$pwd}','{$_SERVER['REQUEST_TIME']}')";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $arr = [
            'resCode' => '1',
            'resMessage' => '登录成功',
            'userType' => 'student',
        ];
        $json = json_encode($arr);
        echo $json;
    }else {
        mysqli_error($con);
        exit();
    }
}