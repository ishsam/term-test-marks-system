<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

$class = $_GET['class'];
$subject = $_GET['subject'];




?>

<?php include 'header.php';
$title = "Student Term Marks System"; ?>

<body>
    <?php include 'navbar.php'; ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2>Add Marks for <?php echo $class; ?>  <?php echo $subject?> Class </h2>


      <form method="POST" action="">
        
          <?php
          $student_query = mysqli_query($db_con, "SELECT `first_name`,`last_name` FROM `tbl_student` WHERE `class_id` = '$class';");

                while ($student_result = mysqli_fetch_array($student_query)) {
                  echo '<div class="mb-3 row"><label for="fname" class="col-sm-2 col-form-label">'.$student_result['first_name'] . ' '.$student_result['last_name'].'</label>
                  <div class="col-sm-3">
                  <input type="number" class="form-control" id="marks" name="marks" placeholder="Marks">
                  </div>
                  </div>';
                }

                ?>
          
        <?php if(mysqli_num_rows($student_query) != 0) echo '<button type="submit" class="btn btn-outline-secondary btn-sm" name="add-marks">Add Marks</button>' ?>
      </form>

     

    </main>

</div>
</div>
<?php include 'footer.php'; ?>