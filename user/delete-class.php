<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

$class = $_GET['class'];
$subject = $_GET['subject'];

$subject_id_select_query = mysqli_query($db_con, "SELECT `id` FROM `tbl_subject` WHERE `name`= '$subject';");
$subject_tbl_row = mysqli_fetch_assoc($subject_id_select_query);
$subject_id = $subject_tbl_row['id'];

//Get teacher id
$teacher_id_select_query = mysqli_query($db_con, "SELECT `teacher_id` FROM `tbl_teacher` WHERE `username`= '$user';");
$teacher_tbl_row = mysqli_fetch_assoc($teacher_id_select_query);
$teacher_id = $teacher_tbl_row['teacher_id'];

$result = mysqli_query($db_con, "DELETE FROM `tbl_teacher_subject` WHERE `subject_id` = '$subject_id' AND `teacher_id` = '$teacher_id';");
$result2 = mysqli_query($db_con, "DELETE FROM `tbl_class_subject` WHERE `subject_id` = '$subject_id' AND `teach_by` = '$teacher_id';");


header("Location:my-other-classes.php");
?>