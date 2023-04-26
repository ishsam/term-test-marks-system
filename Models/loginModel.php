<?php

class loginModel extends baseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function fetchUser()
	{
		$stmt = $this->db->prepare("SELECT * FROM tbl_user WHERE login= :login AND pw= md5(:password)");
		$stmt->execute(array(
			":login"=>$_POST['login'],
			":password"=>$_POST['password']));

		$count = $stmt->rowCount();

		if($count > 0)
		{
			Session::init();
			Session::set("isLoggedIn", true);

			header("location: ../dashboard");
		}
		else
		{
			header("location: ../login");
		}

	}
}

?>