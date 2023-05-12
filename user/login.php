<?php require_once 'db_con.php'; 
session_start();
$title="Login";
if(isset($_SESSION['user_login'])){
	header('Location: home.php');
}
	if (isset($_POST['login'])) {
		$username= $_POST['username'];
		$password= $_POST['password'];


		$input_arr = array();

		if (empty($username)) {
			$input_arr['input_user_error']= "Username Is Required!";
		}

		if (empty($password)) {
			$input_arr['input_pass_error']= "Password Is Required!";
		}

		if(count($input_arr)==0){
			$query = "SELECT * FROM `tbl_teacher` WHERE `username` = '$username';";
			$result = mysqli_query($db_con, $query);
			//error_log(mysqli_num_rows($result));
			if (mysqli_num_rows($result)==1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['password']==sha1(md5($password))) {
					$_SESSION['user_login']=$username;
					header('Location: home.php');
					
				}else{
					$worngpass= "This password Wrong!";	
				}
			}else{
				$usernameerr= "Username Not Found!";
			}
		}
		
	}
?>
<?php include 'header.php';?>
    <div class="container text-center" style="margin-top: 10em;">
      <div class="row row-cols-3">
        <div class="col"></div>
        <div class="col">
          <main class="form-signin">
            <form method="POST" action="">
              <img class="mb-4" src="../resources/images/person-circle.svg" alt="" width="72" height="57">
              <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
			<div >
				<?php if(isset($usernameerr)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true"  class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $usernameerr; ?></div><?php };?>
				<?php if(isset($worngpass)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true"  class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $worngpass; ?></div><?php };?>
					
			</div>
              <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username">
				<?php echo isset($input_arr['input_user_error'])? '<label>'.$input_arr['input_user_error'].'</label>':''; ?>
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
				<label><?php echo isset($input_arr['input_pass_error'])? '<label>'.$input_arr['input_pass_error'].'</label>':''; ?>
                <label for="floatingPassword">Password</label>
              </div>

			  
              <div class="mb-3">
              <div>No account yet? <a href="register.php">Register</a> Here</div>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
             
            </form>
          </main>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
<?php include 'footer.php';?>