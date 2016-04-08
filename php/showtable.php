<?php
	/*
	 * Presentational php file: waits for user input and process it
	 */

	include ( "dbConn.php" );
	$db = dbConn::getInstance();
	$name = $_GET['q'];

	// retrieve possible corret misspelled name
	// or the closest match
	$db->getLevinshtein($name);

	// get all possible matches from db
	// based on the name
	$players = $db->retrivePlayers($name);

	// print if  found any match
	if( mysqli_num_rows($players) > 0) {

	echo "<table>
	<tr>
	<th>Player</th>
	<th>Team</th>
	<th>Games Played</th>
	<th>Minutes</th>
	<th>FG Made</th>
	<th>FG Attempts</th>
	<th>FG Percentage</th>
	<th>3PT Attempts</th>
	</tr>";
		 foreach($players as $player)
		 {
			 echo "<tr>";
			 echo "<td>" . $player[ 'Name' ] . "</td>";
			 echo "<td>" . $player[ 'Team' ] . "</td>";
			 echo "<td>" . $player[ 'GamesPlayed' ] . "</td>";
			 echo "<td>" . $player[ 'Minutes' ] . "</td>";
			 echo "<td>" . $player[ 'FG_Made' ] . "</td>";
			 echo "<td>" . $player[ 'FG_Attempts' ] . "</td>";
			 echo "<td>" . $player[ 'FG_Percentage' ] . "</td>";
			 echo "<td>" . $player[ '3PT_Attempts' ] . "</td>";
			 echo "</tr>";

		 }
		 echo "</table>";
	}	else {
		echo "<p>Nothing Found...</p></br>";
	}

	// close connection
	$db->dropConnection();
?>
</body>
</html>