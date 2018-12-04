<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/21
 * Time: 0:48
 */
//学生录入课程
require 'lib/fun.php';
if(!empty($_POST['phoneNumber'])){
    $con = mysqlInit();
    $phone = $_POST['phoneNumber'];
    //接受post过来的课程id
    $classId1 = $_POST['id'];
    $subjectSql = "select * from `teacher_subject` where `id` = '{$classId1}'";
    $query = mysqli_query($con, $subjectSql);
    if(!$query){
        echo '不存在该课程';
        exit();
    }
    $subjectRes = mysqli_fetch_assoc($query);
    $sql = "SELECT `id` AS total FROM `zbjy_Student` WHERE `phoneNumber` = '{$phone}'";
    $obj = mysqli_query($con,$sql);
    $res = mysqli_fetch_assoc($obj);
    //获取课程变量将其插入数据库
    $id = $res['total'];
    $subject = $subjectRes['subject'];
    $teacher_id = $subjectRes['teacher_id'];
    $sql = "select * from `teacher_subject` where `teacher_id` = '{$teacher_id}' and `subject` = '{$subject}'";
    $obj = mysqli_query($con,$sql);
    if($obj){
        //数组计数器
        $i = 0;
        $val = '';
        unset($sql);
        while($result = mysqli_fetch_assoc($obj)){
            $res[$i] = $result;
            $classTime = $res[$i]['class_time'];
            $url = $res[$i]['class_url'];
            $classWeek = $res[$i]['class_week'];
            $intro = $res[$i]['intro'];
            $classId = $res[$i]['id'];
            $subject = $res[$i]['subject'];
            $suit_people = $res[$i]['suit_people'];
            $img_url = $res[$i]['img_url'];
            $updated = $res[$i]['section_number'];
            $val .= "('".$updated."','".$img_url."','".$suit_people."','".$intro."','".$id."','".$_SERVER['REQUEST_TIME']."','".$subject."','".$classTime."','".$url."','".$classWeek."','".$classId."','.1.'),";
            $i++;
        }
        $val = rtrim($val,',');
        $sql = "INSERT `zbjy_student_subject`(`updated`,`img_url`,`suit_people`,`intro`,`student_id`,`create_time`,`subject`,`class_time`,`class_url`,`class_week`,`class_id`,`is_del`) values $val";

        $sql2 = "INSERT `zbjy_student_subject_index`(`updated`,`img_url`,`suit_people`,`intro`,`student_id`,`create_time`,`subject`,`class_time`,`class_url`,`class_week`,`class_id`,`is_del`) VALUES('{$res[$i]['section_number']}','{$res[0]['img_url']}','{$res[0]['suit_people']}','{$res[0]['intro']}','{$id}','{$_SERVER['REQUEST_TIME']}','{$res[0]['subject']}','{$res[0]['class_time']}','{$res[0]['class_url']}','{$res[0]['class_week']}','{$res[0]['id']}',1)";
        $obj = mysqli_query($con,$sql);
        $obj2 = mysqli_query($con, $sql2);
        if($obj && $obj2){
            echo '插入成功';
        }else {
            echo mysqli_error($con);
        }
    }else {
        echo mysqli_error($con);
    }
}else {
    echo '请求非法';
}
