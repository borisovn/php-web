<?php
	/*
	 * dbConn - dabase class
	 * allocates new connection
	 * shall allow only one connection
	 */
	class dbConn {

		// local variables to connect to db
		private $servername = "mashadb.cnqw72qqqiox.us-west-2.rds.amazonaws.com";
		private $username = "mashadb";
		private $password = "mashadb10";
		private $dbname = "CSV_DB";
		private $connection;

		private static $_instance; //The single instance

		// accessor method
		// retrieve the connection
		public static function getInstance() {
			if(!self::$_instance) { // If no instance then make one
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		// Constructor
		private function __construct() {
			$this->connection = new mysqli($this->servername, $this->username,
				$this->password, $this->dbname);

			// Error handling
			if(mysqli_connect_error()) {
				trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
					E_USER_ERROR);
			}
		}
		// Magic method clone is empty to prevent duplication of connection
		private function __clone() { }

		// Get mysqli connection
		public function getConnection() {
			return $this->connection;
		}

        // close mysqli connection
		public  function dropConnection () {
			mysqli_close($this->connection);
		}

		// returns  list of teams
		public function returnAllTeams() {
			$getAllTemas = "SELECT `Team` FROM `Basketball`";
			return $result = mysqli_query ( $this->connection, $getAllTemas );


		}

		// return list of players with all info
		public function retrivePlayers($input) {
			$sql = "SELECT * FROM `Basketball` WHERE `Name` LIKE '%".$input."%'";
			return $result = mysqli_query ( $this->connection, $sql );
		}


		//  return possible correct misspelled name
		public  function getLevinshtein($input) {

			//get all names from the db
			$retrieveAllnames = "SELECT `Name` FROM `Basketball` ";
			$result1 = mysqli_query ( $this->connection, $retrieveAllnames );

			$shortest = -1;
			while($row = mysqli_fetch_array($result1)) {

				// get the name and compere
				// with the user input
				$word = $row['Name'];
				$lev = levenshtein ( $input, $word );

				// check for an exact match
				if ( $lev == 0 ) {
					// closest word is this one (exact match)
					$closest = $word;
					$shortest = 0;

					// break out of the loop; we've found an exact match
					break;
				}

				// if this distance is less than the next found shortest
				// distance, OR if a next shortest word has not yet been found
				if ( $lev <= $shortest || $shortest < 0 ) {
					// set the closest match, and shortest distance
					$closest = $word;
					$shortest = $lev;
				}
			}

			//  could not find appropriate name
			// give a suggestion to user
			if( $shortest !== 0)  {
				echo '<p>Did you mean: ';
				echo '<a href="index.html?name='.urlencode($closest).'">'.$closest.'?</a></p></br>';
				return $closest;
			} else {
				return false;
			}
		}

	}

?>