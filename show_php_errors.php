<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	function log_variable($input, $exit = false){
		echo '<pre>';
		echo nl2br( print_r($input,1) );
		echo '</pre>';
		
		if ($exit){
			exit();
		}
		
	}
