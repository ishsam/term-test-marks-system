<?php

class Bootstrap
{
	
	function __construct()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode("/", $url);

		$controllerStr = $url[0]."Controller";

		print("1. ------------ ".$controllerStr);

		if(is_null($url[0]) || empty($url[0]))
		{
			print("1. ------------");
			require_once "Controllers/index".$controllerStr.".php";
			$controller = new indexController();
			$controller->index();
		}
		else
		{	print("2. ------------");
			try {
			
				echo $controllerStr;
				$file = "Controllers/".$controllerStr.".php";
				$errorFileStr = "errorController";

				if (!file_exists($file))
				{
		 			throw new Exception ($file.' does not exist');
		 		}
		 		else
		 		{	
		 			require_once $file;
					$controller = new $controllerStr;
					$controller->loadModel($url[0]);

					if(isset($url[1]))
					{
						if(method_exists($controller, $url[1])) 
						{
							if(isset($url[2]))
							{
								$controller->$url[1]($url[2]);
							}
							else
							{
								$controller->$url[1]();
							}

						} 
						else {
							throw new Exception ('method does not exist');
						}
					}
					else
					{
						$controller->index();
					}	
				}

			} catch (Exception $e) {
				require_once "Controllers/".$errorFileStr.".php";
				$errcontroller = new $errorFileStr;
				$errcontroller->error($e->getMessage(), $e->getCode());
			}
		}
	}


}


?>