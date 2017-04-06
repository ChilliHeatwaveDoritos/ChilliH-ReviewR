<?php
require_once(__DIR__.'/auth.php');
$id = $_SESSION['user'];
$check = "SELECT * FROM users WHERE user_id = '$id' AND score >= 40";

$db_request = new DBController();
$rows = $db_request->numRows($check);

if($rows == 1){
	echo "<a href='modpage.php' class='button'>Moderator Area</a>";
}
?>