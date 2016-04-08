<?php
	/*
	 * Current php file exists only it testing purpose
	 * Main Files are dbConn and showtable
	 *  read README files for more information
	 */

	// defualt values for current page
	include("dbConn.php");
	$db = dbConn::getInstance();
	$conn = $db->getConnection();
?>
<p>
<form action="" method="post">
	Search For Name: <input type="text" name="name" />
	<?php
		$sql = "SELECT `Team` FROM `Basketball`";
		$result = mysqli_query ( $conn, $sql );

		echo "Select Team: ";
		echo "<select name='team'>";
		echo "<option value=''>Any</option>";
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<option value='" . $row['Team'] ."'>" . $row['Team'] ."</option>";
		}
		echo "</select>";
		?>
	<input type="submit" value="Search" />
</form>
</p>

<?php
	// check if any input has been given from the clinet
	if (!empty($_REQUEST['name']) || !empty($_REQUEST['team'])) {

		//  retrive the input
		$term = mysql_real_escape_string ( $_REQUEST[ 'name' ] );
		$term1 = mysql_real_escape_string ( $_REQUEST[ 'team' ] );

		// run sql based on input
		$sql = "SELECT `Name`,`Team` FROM `Basketball` WHERE `Name` LIKE '%" . $term . "%' AND `Team` LIKE '%" . $term1 . "%'";
		$result = mysqli_query ( $conn, $sql );

		if ( mysqli_num_rows ( $result ) > 0 ) {

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
			foreach ( $result as $player ) {
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
		}
		else {
			echo "<p>Nothing Found...</p></br>";
		}
	}
	$db->dropConnection();
?>
