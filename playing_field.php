<?php
	require_once('show_php_errors.php');
	require_once('../db_con.php');
	
	if(!isset($_SESSION)){
		session_start(); 
	}
	
	function rollTurn(){
		$roll = rand(1,100);
		$db_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		$select_stmt = 'UPDATE `kb_users` SET `roll`='.$roll.' WHERE `username`=`'.$_SESSION['username'].'`';
		mysqli_query($db_con, $stmt);
	}
	
	rollTurn();
	
	function getAllPlayers(){
		include('../db_con.php');
		
		$db_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		$select_stmt = 'SELECT * FROM KB_users';
		
		$result = mysqli_query($db_con, $select_stmt);
		
		$all_players = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		$sorted_players = [];
		
		foreach($all_players as $player){
			$y = $player['y_pos'];
			$x = $player['x_pos'];
			$sorted_players[$y][$x] = $player;
		}
		
		return ['count'=>count($all_players), 'players'=>$sorted_players];	
	}

	function generateField(){
		$squares_per_player = 25;
		$all_players = getAllPlayers();
		$total_players = $all_players['count'];
		$fieldsize = ceil( sqrt( $squares_per_player*$total_players) );
		
		echo '<table>';
		for($y = 1; $y<=$fieldsize; $y++){
					
			echo '<tr>';
					
			for($x = 1; $x<$fieldsize; $x++){
					
				echo '<td>';
				if ( isset($all_players['players'][$y][$x]) ){
					$color = $all_players['players'][$y][$x]['player_color'];
					$title = $all_players['players'][$y][$x]['username'];
					echo '<div class="player"';
					if($title == $_SESSION['username']){
						echo 'id="current_user" ';
					}
					
					echo 'title="'.$title.'"style="background-color: #'.$color.';"></div>';
				}
				echo '</td>';
					
			}
			echo '</tr>';
		}
		echo '</table>';
	}
	
	
generateField();
?>


