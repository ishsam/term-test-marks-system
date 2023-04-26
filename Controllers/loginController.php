<?php


class LoginController extends baseController
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->loadView('login/index');
	}

	function run()
	{
		$this->model->fetchUser();
	}
}
?>