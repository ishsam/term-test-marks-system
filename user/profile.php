<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

//Get teacher id
$teacher_id_select_query = mysqli_query($db_con, "SELECT `teacher_id`, `registration_number` FROM `tbl_teacher` WHERE `username`= '$user';");
$teacher_tbl_row = mysqli_fetch_assoc($teacher_id_select_query);
$teacher_id = $teacher_tbl_row['teacher_id'];
$teacher_reg_no = $teacher_tbl_row['registration_number'];

if (isset($_POST['update-profile'])) {
  $class_name = $_POST['teacher-own-class'];
  $subject_ids = $_POST['teacher-subjects'];
  $other_classes = $_POST['teacher-other-classes'];
  $reg_no = $_POST['teacher-reg-no'];

  // Update teacher table
  $teacher_update_query = mysqli_query($db_con, "UPDATE `tbl_teacher` SET `registration_number`='$reg_no' WHERE `username`= '$user';");

  //if (mysqli_num_rows($teacher_update_query) > 0){
  //  $teacher_reg_no = $reg_no;
  //}
  // Add or replace class teacher data
  $teacher_class_update_query = mysqli_query($db_con, "REPLACE INTO `tbl_class_teacher` (`class_id`, `teacher_id`, `is_class_teacher`) VALUES ('$class_name', '$teacher_id', 1)");


  //Add/ Update subjects of the teacher
  mysqli_query($db_con, "DELETE FROM `tbl_teacher_subject` WHERE `teacher_id`= '$teacher_id';");
  foreach ($subject_ids as $subject_id) {
    mysqli_query($db_con, "INSERT INTO `tbl_teacher_subject`(`teacher_id`, `subject_id`) VALUES ('$teacher_id', '$subject_id')");
  }

  //Add/ Update other classes of the teacher
  mysqli_query($db_con, "DELETE FROM `tbl_class_teacher` WHERE `teacher_id`= '$teacher_id' AND `is_class_teacher` = 0;");
  foreach ($other_classes as $other_class) {
    mysqli_query($db_con, "INSERT INTO `tbl_class_teacher`(`class_id`, `teacher_id`, `is_class_teacher`) VALUES ('$other_class', '$teacher_id', 0)");
  }
}

?>

<?php include 'header.php'; ?>

<body>
  <?php include 'navbar.php'; ?>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Profile</h2>

    <form method="POST" action="">
      <div class="mb-3 row">
        <label for="teacher-own-class" class="col-sm-2 col-form-label">My Class</label>
        <select class="selectpicker" id="teacher-own-class" name="teacher-own-class">
          <?php
          $class_query = mysqli_query($db_con, 'SELECT * FROM `tbl_class`;');
          $class_teacher_query = mysqli_query($db_con, "SELECT * FROM `tbl_class_teacher` WHERE `teacher_id` = '$teacher_id';");
          $class_teacher_tbl_row = mysqli_fetch_assoc($class_teacher_query);

          $selected_class = $class_teacher_tbl_row['class_id'];


          while ($class_result = mysqli_fetch_array($class_query)) {
            if ($selected_class == $class_result['class_id']) {
              echo '<option value=' . $class_result['class_id'] . ' selected>' . $class_result['class_id'] . '</option>';
            } else {
              echo '<option value=' . $class_result['class_id'] . '>' . $class_result['class_id'] . '</option>';
            }
          }
          ?>
        </select>
      </div>

      <div class="mb-3 row">
        <label for="teacher-subjects" class="col-sm-2 col-form-label">Subjects</label>
        <select class="selectpicker" multiple id="teacher-subjects" data-live-search="true" name="teacher-subjects[]">
          <?php
          $subject_query = mysqli_query($db_con, 'SELECT * FROM `tbl_subject`;');
          $subject_teacher_query = mysqli_query($db_con, "SELECT * FROM `tbl_teacher_subject` WHERE `teacher_id` = '$teacher_id';");


          $selected_subjects = array();
          while ($subject_teacher_result = mysqli_fetch_array($subject_teacher_query)) {
            array_push($selected_subjects, $subject_teacher_result['subject_id']);
          }

          $ignore = 0;
          while ($subject_result = mysqli_fetch_array($subject_query)) {

            foreach ($selected_subjects as $selected_subject) {
              if ($selected_subject == $subject_result['id']) {
                echo '<option value=' . $subject_result['id']  . ' selected>' . $subject_result['name'] . '</option>';
                $ignore = $subject_result['id'];
              }
            }

            if ($subject_result['id'] != $ignore)
              echo '<option value=' . $subject_result['id'] . ' . .>' . $subject_result['name'] . '</option>';
          }

          ?>
        </select>
        <?php
        //print_r($subject_teacher_result[1]);
        //print_r( $other_classes);
        ?>
      </div>

      <div class="mb-3 row">
        <label for="teacher-other-classes" class="col-sm-2 col-form-label">My Other Classes</label>
        <select class="selectpicker" multiple id="teacher-other-classes" data-live-search="true" name="teacher-other-classes[]">
          <?php
          $other_class_query = mysqli_query($db_con, 'SELECT * FROM `tbl_class`;');
          $class_teacher_query = mysqli_query($db_con, "SELECT * FROM `tbl_class_teacher` WHERE `teacher_id` = '$teacher_id' AND `is_class_teacher` = 0;");

          $selected_classes = array();
          while ($class_teacher_result = mysqli_fetch_array($class_teacher_query)) {
            array_push($selected_classes, $class_teacher_result['class_id']);
          }

          $ignore = 0;
          while ($other_class_result = mysqli_fetch_array($other_class_query)) {

            foreach ($selected_classes as $selected_class) {
              if ($selected_class == $other_class_result['class_id']) {
                echo '<option value=' . $other_class_result['class_id']  . ' selected>' . $other_class_result['class_id'] . '</option>';
                $ignore = $other_class_result['class_id'];
              }
            }

            if ($other_class_result['class_id'] != $ignore)
              echo '<option value=' . $other_class_result['class_id'] . ' . .>' . $other_class_result['class_id'] . '</option>';
          }


          //while ($other_class_result = mysqli_fetch_array($other_class_query)) {
          //  echo '<option value=' . $other_class_result['class_id'] . '>' . $other_class_result['class_id'] . '</option>';
          //}
          ?>
        </select>
      </div>
      <div class="mb-3 row">
        <label for="reg-no" class="col-sm-2 col-form-label">Registration number</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="teacher-reg-no" name="teacher-reg-no" value="<?php echo $teacher_reg_no; ?>" placeholder="Registration No">
        </div>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-outline-secondary btn-sm" name="update-profile">Update My Profile</button>
      </div>
    </form>
  </main>


  </div>
  </div>

  <?php include 'footer.php'; ?>