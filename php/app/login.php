<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/13
 * Time: 12:19
 */
require "lib/fun.php";
if(!empty($_POST['phoneNumber'])){
    $phone = trim($_POST['phoneNumber']);
    $pwd = trim($_POST['pwd']);

    $con = mysqlInit('139.129.240.196','root','root','zbjy');
    //根据手机号查询用户
    $sql = "SELECT * FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}' LIMIT 1";
    $obj = mysqli_query($con,$sql);
    if($obj -> num_rows){
        $res = mysqli_fetch_assoc($obj);
        //判断密码是否正确
        if(is_array($res) && !empty($res)){
            if(createPassword($pwd) === $res['pwd']){
                echo json(1);
            }else {
                echo json(0);
            }
        }
    }else {
        unset($sql,$obj,$res);
        $sql = "SELECT * FROM `zbjy_teacher` WHERE `phone` = '{$phone}' LIMIT 1";
        $obj = mysqli_query($con,$sql);
        if($obj){
            $res = mysqli_fetch_assoc($obj);
            //判断密码是否正确
            if(is_array($res) && !empty($res)){
                if(createPassword($pwd) === $res['pwd']){
                    $arr = [
                        'resCode' => '1',
                        'resMessage' => '登陆成功',
                        'userType' => 'teacher'
                    ];
                    $json = json_encode($arr);
                    echo $json;
                }else {
                    $arr = [
                        'resCode' => '0',
                        'resMessage' => '登陆失败',
                        'userType' => 'teacher'
                    ];
                    $json = json_encode($arr);
                    echo $json;
                }
            }
        }else {
                echo mysqli_error($con);
            }
    }
}