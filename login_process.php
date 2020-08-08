<?php
	
	session_start();
	require_once('show_php_errors.php');
	require_once('db_con.php');

	 if (!empty($_POST) ){
		
		 $db_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		 
		 $username = $_POST['username'];
		 $pw_hash = hash('sha512', $_POST['password']);
		
		if (preg_match('/^[a-zA-Z0-9-_]*$/', $username) ){
			$select_stmt = 'SELECT * FROM KB_users WHERE username = "'.$username.'" 
			AND hashed_password = "'.$pw_hash.'";';

			$result = mysqli_query($db_con, $select_stmt);
			
			
			
			if ($result->num_rows ){
				$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
				
				$_SESSION['username'] = $username;
				$_SESSION['x_pos'] = $user[0]['x_pos'];
				$_SESSION['y_pos'] = $user[0]['y_pos'];
				$_SESSION['player_color'] = $user[0]['player_color'];
			}
			
		}
		mysqli_close($db_con);
	}	
	
		header('Location: index.php');


