<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];
$selected_class = $_SESSION['class'];

$student_id = $_GET['id'];


//Get teacher id
$teacher_id_select_query = mysqli_query($db_con, "SELECT `teacher_id` FROM `tbl_teacher` WHERE `username`= '$user';");
$teacher_tbl_row = mysqli_fetch_assoc($teacher_id_select_query);
$teacher_id = $teacher_tbl_row['teacher_id'];

$result = mysqli_query($db_con, "DELETE FROM `tbl_student_subject` WHERE `student_id` = '$student_id';");
$result = mysqli_query($db_con, "DELETE FROM `tbl_marks` WHERE `student_id` = '$student_id';");
$result2 = mysqli_query($db_con, "DELETE FROM `tbl_student` WHERE `id` = '$student_id' AND `class_id` = '$selected_class';");


var_dump($result);
header("Location:myclass-students.php");
?>