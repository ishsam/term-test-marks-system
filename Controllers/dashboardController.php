<?php

class dashboardController extends baseController
{
	
	function __construct()
	{
		parent::__construct();
		Session::init();

		if(Session::get("isLoggedIn") == false)
		{
			echo Session::get("isLoggedIn");
			Session::destroy();
			header("location: ../login");
			exit;
		}
	}

	function index()
	{
		$this->view->loadView('dashboard/index');
	}

	function logout()
	{
		Session::destroy();
		header("location: ../login");
		exit;
	}
}

?>