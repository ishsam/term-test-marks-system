<?php

class ErrorController extends baseController
{
	
	function __construct()
	{
		parent::__construct();
	}

	function error($message, $code)
	{
		$this->view->loadView('error/index');
		$this->view->__set('message', $message);
		$this->view->__set('code', $code);
	}
}
?>