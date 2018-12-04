<?php
//课程选课主菜单
require __DIR__.'/lib/fun.php';
$con = mysqlInit();
$sql = "SELECT * FROM `teacher_subject` WHERE `section_number` = 1 and `is_del` = 1";
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
