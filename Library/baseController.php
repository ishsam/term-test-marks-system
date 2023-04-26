<?php

/**
* 
*/
class baseController
{
	
	function __construct()
	{
		$this->view = new baseView();
	}

	function loadModel($name)
	{
		$path = "Models/".$name."Model.php";
	
		if(file_exists($path))
		{
			require_once $path;

			$modelName = $name."Model";
			$this->model = new $modelName();
		}
	}
}

?>