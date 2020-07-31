<?php

	$url_parts = explode('://', $_SERVER['SCRIPT_URI']);
	if ($url_parts[0] != 'https'){
		header('Location: https://'.$url_parts[1]);
	}
	
	session_start();
	
	echo '<link rel="stylesheet" type="text/css" href="style.css">';
	echo '<h1>Kugelblitz</h1>';
	
	
	if (isset($_SESSION['username']) ){
		
		echo 'Welcome , '.$_SESSION['username'];
		
		echo '<br><a href="logout.php">Logout</a>';
		
		include('Color_Picker.php');
		include('playing_field.php');
		include('js_vars.php');
		echo '<script src = "https://cc4k.co/jquery.js"></script>';
		echo '<script src = "script.js"></script>';
		
		
	}
	else{
		include('login.php');
	}