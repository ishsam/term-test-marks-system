<?php require_once 'db_con.php'; 
	session_start();
	$title="Register";
	if (isset($_POST['register'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$regno = $_POST['regno'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$role = $_POST['role'];

		error_log($role." - ".$firstname." - ".$lastname." - ".$regno." - ".$password." - ".$repassword);

		$input_error = array();
		if (empty($firstname)) {
			$input_error['firstname'] = "The First Name is Required";
		}
		if (empty($lastname)) {
			$input_error['lastname'] = "The Last Name is Required";
		}
		if (empty($regno)) {
			$input_error['regno'] = "The Registration Number is Required";
		}
		if (empty($username)) {
			$input_error['username'] = "The UserName is Required";
		}
		if (empty($password)) {
			$input_error['password'] = "The Password is Required";
		}
	

		if (!empty($password)) {
			if ($repassword!==$password) {
				$input_error['notmatch']="Passwords not match!";
			}
		}

		if (count($input_error)==0) {
			$check_username= mysqli_query($db_con,"SELECT * FROM `tbl_teacher` WHERE `username`='$username';");

			if (mysqli_num_rows($check_username)==0) {
				if (strlen($username)>7) {
					if (strlen($password)>7) {
							$password = sha1(md5($password));
							$teacherid = gen_uuid();

							error_log($teacherid);
						$query = "INSERT INTO `tbl_teacher`(`teacher_id`, `first_name`, `last_name`, `user_role`, `registration_number`, `password`, `username`) VALUES ('$teacherid', '$firstname', '$lastname', '$role', '$regno','$password', '$username');";

						error_log($query);
								$result = mysqli_query($db_con,$query);
								error_log($result);
							if ($result) {
								header('Location: login.php');
							}else{
								header('Location: register.php?insert=error');
							}
					}else{
						$passlan="This password more than 8 charset";
					}
				}else{
					$usernamelan= 'This username more than 8 charset';
				}
				
			}else{
				$email_error= "This email already exists";
			}
			
		}
		
	}

	function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	
			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),
	
			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,
	
			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,
	
			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
	

?>

<?php include 'header.php';?>
    <div class="container text-center" style="margin-top: 10em;">
      <div class="row row-cols-3">
        <div class="col">
        </div>
        <div class="col">
          <main class="form-signup">
            <form method="POST" action="">
              <img class="mb-4" src="../resources/images/person-plus.svg" alt="" width="72" height="57">
              <h1 class="h3 mb-3 fw-normal">Register</h1>
			
              <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="Email" name="username">
				<?php echo isset($input_arr['username'])? '<label>'.$input_arr['username'].'</label>':''; ?>
                <label for="email">Email address</label>
              </div>
			  <div class="form-floating">
                <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname">
				<?php echo isset($input_arr['firstname'])? '<label>'.$input_arr['firstname'].'</label>':''; ?>
                <label for="firstname">First Name</label>
              </div>
			  <div class="form-floating">
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname">
				<?php echo isset($input_arr['lastname'])? '<label>'.$input_arr['lastname'].'</label>':''; ?>
                <label for="lastname">Last Name</label>
              </div>
			  <div class="form-floating">
				<select class="form-control" id="role" name="role">
				<option selected>Role</option>
				<option value="1">Class Teacher</option>
				<option value="2">Subject Teacher</option>
				</select>
			</div>
			  <div class="form-floating">
                <input type="text" class="form-control" id="regno" placeholder="Registration Number" name="regno">
				<?php echo isset($input_arr['regno'])? '<label>'.$input_arr['regno'].'</label>':''; ?>
                <label for="regno">Registration Number</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="pw" placeholder="Password" name="password">
				<?= isset($input_error['password'])? '<label class="error">'.$input_error['password'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>
                <label for="pw">Password</label>
              </div>
			  <div class="form-floating">
                <input type="password" class="form-control" id="repw" placeholder="Confirm Password" name="repassword">
				<?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>
                <label for="repw">Retype Password</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit" name="register">Register</button>
            </form>
          </main>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
<?php include 'footer.php';?>