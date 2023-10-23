<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

//Get teacher id
$teacher_id_select_query = mysqli_query($db_con, "SELECT `teacher_id` FROM `tbl_teacher` WHERE `username`= '$user';");
$teacher_tbl_row = mysqli_fetch_assoc($teacher_id_select_query);
$teacher_id = $teacher_tbl_row['teacher_id'];

$selected_class = $_SESSION['class'];



$success = false;
$reg_no = 0;

if (isset($_POST['add-students'])) {
  $first_name = $_POST['fname'];
  $last_name = $_POST['lname'];
  $reg_no = $_POST['regno'];

  // Add or replace class student data
  $teacher_class_update_query = mysqli_query($db_con, "REPLACE INTO `tbl_student` (`first_name`, `last_name`, `registration_number`, `class_id`) VALUES ('$first_name', '$last_name', '$reg_no', '$selected_class')");

  if ($teacher_class_update_query) {
    $success = true;
  }
}


?>


<?php include 'header.php';
$title = "Student Term Marks System"; ?>

<body>
  <?php include 'navbar.php'; ?>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 2%;">

    <div class="card text-white bg-secondary mb-3 " style="opacity: 0.8;">
      <div class="card-header" style="background-color: #563d7c; font-size: large;">
        <h5 class="card-title">Add Students</h5>
      </div>
      <div class="card-body" style="font-size: large;">
        <form method="POST" action="">

          <div class="mb-3 row">
            <label for="fname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="reg-no" class="col-sm-2 col-form-label">Registration number</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="reg-no" name="regno" placeholder="Registration No">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="student-class" class="col-sm-2 col-form-label">My Class</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="student-class" readonly placeholder="Class" value="<?php echo $selected_class ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-sm-3">
              <?php
              echo $success ? "<div class='alert alert-info ' role='alert'> Student with registration no: $reg_no added ! </div>" : "<div></div>"
              ?>
            </div>
          </div>

          <button type="submit" class="btn btn-primary" name="add-students">Add Student</button>
        </form>
      </div>

    </div>



  </main>


  </div>
  </div>
  <?php include 'footer.php'; ?>