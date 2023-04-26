<?php

 class baseView
 {

 	protected $_data = array();
 	
 	function __construct()
 	{
 	}

 	function loadView($viewName)
 	{
 		require "Views/header.php";
 		require "Views/".$viewName.".php";
		require "Views/footer.php";
 	}

 	public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

 	public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
    }
 }

?>