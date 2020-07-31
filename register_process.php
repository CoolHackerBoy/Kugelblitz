<?php
	session_start();
	require_once('../../show_php_errors.php');
	require_once('../../db_con.php');
	
	function is_username_valid( $username, $db_con ){
		
		if (preg_match('/^[a-zA-Z0-9-_]*$/', $username) ){
			$select_stmt = 'SELECT * FROM KB_users WHERE username = "'.$username.'"';

			$result = mysqli_query($db_con, $select_stmt);

			if($result->num_rows){
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	
	function pick_new_player_position(){
		$squares_per_player = 25;
		$all_players = getAllPlayers();
		$player_count = $all_players['count']+1;
		$fieldsize = ceil( sqrt($player_count*$squares_per_player) );
			
		$x = rand(1,$fieldsize);
		$y = rand(1,$fieldsize);
		
		while(isset($all_players['players'][$y][$x] ) ){
			$x = rand(1,$fieldsize);
			$y = rand(1,$fieldsize);
		}
		return [$x,$y];
	}
	
	function getAllPlayers(){
		include('../../db_con.php');
		
		$db_con = mysqli_connect($db_host, $db_user, $db_pass, 'cc4k__hackerboy');
		
		$select_stmt = 'SELECT * FROM KB_users';
		
		$result = mysqli_query($db_con, $select_stmt);
		
		$all_players = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		$sorted_players = [];
		
		return ['count'=>count($all_players), 'players'=>$sorted_players];	
	}
	
	function generateRandomColor(){
		
		$r = dechex(rand(0,255));
		$g = dechex(rand(0,255));
		$b = dechex(rand(0,255));
		
		return $r.$g.$b;
	}

	 $db_con = mysqli_connect($db_host, $db_user, $db_pass, 'cc4k__hackerboy');
	 if (!$db_con) {
		echo 'ERROR NO NO NO';
	 }
	 
	 if (!empty($_POST)){

		$username = $_POST['new_user'];	
		
		if(is_username_valid( $username, $db_con) ){
			$hashed_password = hash('sha512',$_POST['new_pw'] );
			$pos = pick_new_player_position();
			$color = generateRandomColor();
			$stmt = 'INSERT INTO KB_users (
											username ,
											hashed_password ,
											x_pos ,
											y_pos,
											player_color
											) 
			VALUES (
				"'.$username.'" ,
				"'.$hashed_password.'" ,
				"'.$pos[0].'" ,
				"'.$pos[1].'",
				"'.$color.'"
				)';
			
			if (mysqli_query($db_con, $stmt) ) {
				$_SESSION['username'] = $username;
				$_SESSION['x_pos'] = $pos[0];
				$_SESSION['y_pos'] = $pos[1];
				$_SESSION['player_color'] = $color;
				
				header('Location: index.php');
			}
			else{
				echo 'ERROR, INVALID USERNAME';
			}
		}
		
	}
	 mysqli_close($db_con);
	 
