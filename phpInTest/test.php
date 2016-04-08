
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title></title>
</head>
<body>
<h1>Hey Maria search for some name!</h1>
<form action="" method="post">
	Search For Name: <input type="text" name="name" /> Search For Team: <input type="text" name="team" /><br />
	<input type="submit" value="Search" />
</form>


<?php

	include "dbConn.php";

	// Create connection
	$db = Database::getInstance();
	$mysqli = $db->getConnection();
	// Check connection


	// check if any input has been given from the clinet
	if (!empty($_REQUEST['name']) || !empty($_REQUEST['team'])) {

		//  retrive the input
		$term = mysql_real_escape_string($_REQUEST['name']);
		$term1 = mysql_real_escape_string($_REQUEST['team']);

		// run sql based on input
		$sql = "SELECT `Name`,`Team` FROM `Basketball` WHERE `Name` LIKE '%".$term."%' AND `Team` LIKE '%".$term1."%'";
		$result = mysqli_query ( $mysqli, $sql );

        // print out the result
		if ( mysqli_num_rows ( $result ) > 0 ) {
			// output data of each row
			while ( $row = mysqli_fetch_assoc ( $result ) ) {
				echo "Name: " . $row[ "Name" ] . " - Team: " . $row[ "Team" ] . "<br>";
			}
		}
		else {
			echo "0 results";
		}
	}
	//mysqli_close($conn);
?>

</body>
</html>
