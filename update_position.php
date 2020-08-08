<?php

	session_start();
	require_once('show_php_errors.php');
	require_once('db_con.php');
	
	$db_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	$username = $_SESSION['username'];
	
	
	
	$x_pos = intval ( $_POST['x_pos'] );
	$y_pos = intval ( $_POST['y_pos'] );
	
	$stmt = 'UPDATE KB_users SET x_pos = "'.$x_pos.'", y_pos="'.$y_pos.'" WHERE username ="'.$username.'"';

	mysqli_query($db_con, $stmt);

	mysqli_close($db_con);
