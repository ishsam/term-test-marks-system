<?php require_once 'db_con.php'; 


if(!empty($_GET['teacherId'])){ 
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        $class = $_POST['class'];
        $teacher_id = $_GET['teacherId'];
    
        mysqli_query($db_con, "INSERT INTO `tbl_class_subject`(`class_id`, `subject_id`,`teach_by`) VALUES ('$class', '$subject', '$teacher_id')");
    
    }
}

echo "<div class='form-floating mb-3'>
        <select class='form-control' id='subject' name='subject'>";

        $subject_query = mysqli_query($db_con, 'SELECT * FROM `tbl_subject`;');

        while ($subject_result = mysqli_fetch_array($subject_query)) { 
          echo '<option value=' . $subject_result['id']. ' . .>' . $subject_result['name'] . '</option>';
        }
        echo "</select>
        <label for='subject'>Subject</label>
    </div>
    <div class='form-floating mb-3'>
        <select class='form-control' id='class' name='class'>";
        $class_query = mysqli_query($db_con, 'SELECT * FROM `tbl_class`;');

        while ($class_result = mysqli_fetch_array($class_query)) {
            echo '<option value=' . $class_result['class_id'] . '>' . $class_result['class_id'] . '</option>';
        }
        
        echo "</select>
        <label for='class'>Class</label>
    </div>";
?>