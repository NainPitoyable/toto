<?php

class FrontController
{
	function view($param)
	{
		include "Language/".Tools::language("fr").".php";
		
		$base_dir =  __DIR__ ."/";
		
		$file = $base_dir . str_replace('\\', '/', $param) . '.Controller.php';
		
		if (file_exists($file)) 
		{
			require_once $file;
			$obj = new $param;
			echo $obj->get();
		}
		else
		{
			$error = new Error;
			$display['title'] 	=  	$errorPage['title'];
			$display['error'] 	= 	$errorPage['page']. " " .$param. " ".$errorPage['not-exist'];
			$display['return'] 	= 	$errorPage['return'];

			$error->display($display);
		}
	}
}
?>