<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

$class = $_GET['class'];
$subject = $_GET['subject'];

$subject_id_select_query = mysqli_query($db_con, "SELECT `id` FROM `tbl_subject` WHERE `name`= '$subject';");
$subject_tbl_row = mysqli_fetch_assoc($subject_id_select_query);
$subject_id = $subject_tbl_row['id'];

$term = 1;

if (isset($_POST['add-marks'])) {

  $term = $_POST['term'];

  foreach (array_combine($_POST['student_id'], $_POST['marks']) as $student_id => $mark) {
    $student_marks_update_query = mysqli_query($db_con, "REPLACE INTO `tbl_marks` (`subject_id`, `student_id`, `term`, `marks`) VALUES ('$subject_id', '$student_id', '$term', '$mark')");
  }
}

$student_query = mysqli_query($db_con, "SELECT `tbl_student`.`id`, `tbl_student`.`first_name`,`tbl_student`.`last_name`, `tbl_marks`.`marks` FROM `tbl_student` INNER JOIN `tbl_student_subject` ON `tbl_student`.`class_id` = '$class' AND `tbl_student_subject`.`student_id` = `tbl_student`.`id` AND `tbl_student_subject`.`subject_id` = '$subject_id' LEFT OUTER JOIN `tbl_marks` ON `tbl_marks`.`student_id` = `tbl_student`.`id` AND `tbl_marks`.`subject_id`= '$subject_id' AND `tbl_marks`.`term` = '$term';");


?>

<?php include 'header.php';
$title = "Student Term Marks System"; ?>

<body>
  <?php include 'navbar.php'; ?>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Add Marks for <?php echo $class; ?> <?php echo $subject ?> Class </h2>
    <form method="POST" action="">
      <div class="mb-3 row">
        <div class="col-sm-3">
          <select class="form-select" id="term" name="term">
            <option selected>Select Term</option>
            <option value="1">Term 1</option>
            <option value="2">Term 2</option>
            <option value="3">Term 3</option>
          </select>
        </div>
      </div>

      <?php

      while ($student_result = mysqli_fetch_array($student_query)) {
        echo '<div class="mb-3 row"><label for="fname" class="col-sm-2 col-form-label">' . $student_result['first_name'] . ' ' . $student_result['last_name'] . '</label>
                  <div class="col-sm-3">
                  <input type="hidden" value="' . $student_result['id'] . '" name="student_id[]">
                  <input type="hidden" value="' . $class . '" name="class">
                  <input type="number" class="form-control" id="marks-' . $student_result['id'] . '" name="marks[]" value="' . $student_result['marks'] . '" placeholder="Marks">
                  </div>
                 
                  </div>';
      }

      ?>

      <?php if (mysqli_num_rows($student_query) != 0) echo '<button type="submit" class="btn btn-outline-secondary btn-sm" name="add-marks">Add Marks</button>' ?>
    </form>
  </main>

  </div>
  </div>
  <?php include 'footer.php'; ?>