<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$success = false;
$reg_no = 0;

if (isset($_POST['add-teacher'])) {
  $first_name = $_POST['fname'];
  $last_name = $_POST['lname'];
  $reg_no = $_POST['regno'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $username = $_POST['username'];

  $password = sha1(md5($password));
  $teacherid = gen_uuid();

  // Add or replace class student data
  $teacher_insert_query = mysqli_query($db_con, "INSERT INTO `tbl_teacher` (`teacher_id`, `first_name`, `last_name`,`user_role`, `registration_number`, `password`, `username`) VALUES ('$teacherid', '$first_name', '$last_name', '$role', '$reg_no', '$password', '$username')");

  if ($teacher_insert_query) {
    $success = true;
  }
}

function gen_uuid()
{
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    // 32 bits for "time_low"
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),

    // 16 bits for "time_mid"
    mt_rand(0, 0xffff),

    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand(0, 0x0fff) | 0x4000,

    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand(0, 0x3fff) | 0x8000,

    // 48 bits for "node"
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff)
  );
}


?>


<?php include 'header.php';
$title = "Student Term Marks System"; ?>

<body>
  <?php include 'navbar.php'; ?>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"  style="margin-top: 2%;">


    <div class="card text-white bg-secondary mb-3 ">
      <div class="card-header" style="background-color: #563d7c; font-size: large;">
        <h5 class="card-title">Add Teacher Profile</h5>
      </div>
      <div class="card-body" style="font-size: larAdd Teacherge;">
        <form method="POST" action="">

          <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">UserName</label>
            <div class="col-sm-3">
              <input type="email" class="form-control" id="email" placeholder="Email" name="username">
            </div>
          </div>
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
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-3">
              <input type="password" class="form-control" id="passwd" name="password">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-3">
              <select class="form-control" id="role" name="role">
                <option value="1">Class Teacher</option>
                <option value="2">Subject Teacher</option>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-sm-3">
              <?php
              echo $success ? "<div class='alert alert-info ' role='alert'> Teacher with registration no: $reg_no added ! </div>" : "<div></div>"
              ?>
            </div>
          </div>

          <button type="submit" class="btn btn-primary" name="add-teacher">Add Teacher</button>
        </form>
      </div>

    </div>


  </main>


  </div>
  </div>
  <?php include 'footer.php'; ?>