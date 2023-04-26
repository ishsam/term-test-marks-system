<?php

class Session
{

	static function init()
	{
		@session_start();
	}

	static function get($key)
	{
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
	}

	static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	static function destroy()
	{
		session_destroy();
	}

}

?>