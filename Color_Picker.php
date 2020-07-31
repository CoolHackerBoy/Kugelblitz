<form action="update_color.php" method="post">
	<input type="color" name="player_color"
	value="#<?php echo $_SESSION['player_color']; ?>">
	<button type="sumit">Save color</button>
</form>