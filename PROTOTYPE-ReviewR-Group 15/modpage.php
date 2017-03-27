<?php
include(__DIR__.'/auth.php');
require_once __DIR__.'/dbcontroller.class.php';

$id = $_SESSION['user'];
$check = "SELECT * FROM users WHERE user_id = '$id' AND score >= 40";

$db_request = new DBController();
$rows = $db_request->numRows($check);

if($rows == 0){
	header("Location: ReviewR.php");
}



?>