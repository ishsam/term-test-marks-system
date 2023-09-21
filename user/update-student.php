<?php require_once 'db_con.php'; 
	session_start();
	$title="Student Term Marks System";

  $user = $_SESSION['user_login'];

  $student_id = $_GET['id'];


  $student_select_query = mysqli_query($db_con, "SELECT `first_name`,`last_name`,`registration_number`,`class_id` FROM `tbl_student` WHERE `id`= '$student_id';");
  $student_tbl_row = mysqli_fetch_assoc($student_select_query);

  $selected_class = $student_tbl_row['class_id'];


  $success = false;
  $reg_no = 0;



  if (isset($_POST['update-student'])) {
    $first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
    $reg_no = $_POST['regno'];
    $subject_ids = $_POST['student-subjects'];

    // Add or replace class student data
    $teacher_class_update_query = mysqli_query($db_con, "REPLACE INTO `tbl_student` (`id`, `first_name`, `last_name`, `registration_number`, `class_id`) VALUES ('$student_id', '$first_name', '$last_name', '$reg_no', '$selected_class')");

    if($teacher_class_update_query){
      $success = true;
    }

    //Add/ Update subjects of the student
    mysqli_query($db_con, "DELETE FROM `tbl_student_subject` WHERE `student_id`= '$student_id';");
    foreach ($subject_ids as $subject_id){
      mysqli_query($db_con, "INSERT INTO `tbl_student_subject`(`student_id`, `subject_id`) VALUES ('$student_id', '$subject_id')");
    }
    
  }


?>


<?php include 'header.php';$title="Student Term Marks System";?>
  <body>
      <?php include 'navbar.php';?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2>Update Student</h2>
      
      <form method="POST" action="">
      
        <div class="mb-3 row">
        <label for="fname" class="col-sm-2 col-form-label">First Name</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $student_tbl_row['first_name'];?>">
          </div>
        </div>
        <div class="mb-3 row">
        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $student_tbl_row['last_name'];?>"/>
          </div>
        </div>
        <div class="mb-3 row">
        <label for="reg-no" class="col-sm-2 col-form-label">Registration number</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="reg-no" name="regno" placeholder="Registration No" value="<?php echo $student_tbl_row['registration_number'];?>">
          </div>
        </div>
        <div class="mb-3 row">
        <label for="student-subjects" class="col-sm-2 col-form-label">Subjects</label>
        <select class="selectpicker" multiple id="student-subjects" data-live-search="true" name="student-subjects[]">
          <?php
          $subject_query = mysqli_query($db_con, 'SELECT * FROM `tbl_subject`;');
          $student_subject_query = mysqli_query($db_con, "SELECT * FROM `tbl_student_subject` WHERE `student_id` = '$student_id';");


          $selected_subjects = array();
          while ($student_subject_result = mysqli_fetch_array($student_subject_query)) {   
            array_push($selected_subjects, $student_subject_result['subject_id']);
          }

          $ignore = 0;
          while ($subject_result = mysqli_fetch_array($subject_query)) { 

            foreach($selected_subjects as $selected_subject){
              if($selected_subject == $subject_result['id']){
                echo '<option value=' . $subject_result['id']  . ' selected>' . $subject_result['name'] . '</option>';
                $ignore = $subject_result['id'];
              }
            }

            if($subject_result['id'] != $ignore)
              echo '<option value=' . $subject_result['id']. ' . .>' . $subject_result['name'] . '</option>';
         
          }

          ?>
        </select>
        <?php 
        //print_r($subject_teacher_result[1]);
        //print_r( $other_classes);
        ?>
      </div>

        <div class="mb-3 row">
          <div class="col-sm-3">
          <?php 
          echo $success ? "<div class='alert alert-info ' role='alert'> Student with registration no: $reg_no added ! </div>" : "<div></div>" 
          ?>
          </div>
        </div>
        
        <button type="submit" class="btn btn-outline-secondary btn-sm" name="update-student">Update Student</button>
      </form>
      </main>

    
      </div>
      </div>
      <?php include 'footer.php';?>
