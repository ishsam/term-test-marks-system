<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";


$teacher_id = $_GET['id'];

$result0 = mysqli_query($db_con, "DELETE FROM `tbl_class_teacher` WHERE `teacher_id` = '$teacher_id';");
$result1 = mysqli_query($db_con, "DELETE FROM `tbl_class_subject` WHERE `teach_by` = '$teacher_id';");
$result2 = mysqli_query($db_con, "DELETE FROM `tbl_teacher_subject` WHERE `teacher_id` = '$teacher_id';");
$result3 = mysqli_query($db_con, "DELETE FROM `tbl_teacher` WHERE `teacher_id` = '$teacher_id';");

header("Location:viewteachers.php");
?>