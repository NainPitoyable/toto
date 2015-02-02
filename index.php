<?php

require_once 'Libs/tools/include.php';

	$controller = new FrontController();

	if(isset($_GET['view']))
	{
		$controller->view($_GET['view']);
	}
?>