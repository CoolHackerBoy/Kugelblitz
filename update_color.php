<?php
	session_start();
	require_once('show_php_errors.php');
	require_once('../db_con.php');

	$db_con = mysqli_connect($db_host, $db_user, $db_pass, 'cc4k__hackerboy');

	$username = $_SESSION['username'];
	$color = substr($_POST['player_color'],1);
	$_SESSION['player_color'] = $color;
	$stmt = 'UPDATE KB_users SET player_color = "'.$color.'" WHERE username ="'.$username.'"';

	mysqli_query($db_con, $stmt);

	mysqli_close($db_con);

	header('Location: index.php');
