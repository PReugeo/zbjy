<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/22
 * Time: 23:08
 */
require __DIR__."/lib/fun.php";
if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $con = mysqlInit();
    $sql = "SELECT * FROM `teacher_subject` WHERE `id` = '{$id}' LIMIT 1";
    $obj = mysqli_query($con,$sql);
    if($obj){
        $result = mysqli_fetch_assoc($obj);
        $sql2 = "SELECT * FROM `teacher_subject` WHERE `subject` = '{$result['subject']}' and `teacher_id` = '{$result['teacher_id']}' ORDER BY section_number";
        $obj2 = mysqli_query($con,$sql2);
        if($obj2){
            $arr = null;
            while($res = mysqli_fetch_assoc($obj2)){
                $arr[] = $res;
            }
            $json = json_encode($arr);
            echo $json;
        }else {
//            echo mysqli_error($con);
            echo 'error';
        }
    }else {
//        echo mysqli_error($con);
        echo ' error';
    }
}