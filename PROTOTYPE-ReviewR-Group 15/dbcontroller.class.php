<?php
class DBController {
	private $host = "localhost";
	private $user = "group15";
	private $password = "powerade";
	private $database = "group15";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		if (!$conn) {
			echo "Unable to connect to database - " . date('H:i:s');
        }
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	
	function updateQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error($conn));
		} else {
			return $result;
		}
	}
	
	function insertQuery($query) {
		if (mysqli_query($this->conn, $query)) {
			return true;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	
	function getConn() {
      return $this->conn;
    }
	
	function deleteQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error($this->conn));
		} else {
			return $result;
		}
	}
}
?>