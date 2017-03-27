<?php
require_once __DIR__.'/dbcontroller.class.php';

$timeoutseconds = 600;
$timestamp = time();
$timeout = $timestamp - $timeoutseconds;

$db_request = new DBController();
$ip = $_SERVER['REMOTE_ADDR'];
$file = $_SERVER['PHP_SELF'];
$exists = "SELECT ip FROM online_users WHERE ip = '$ip'";
$num = $db_request->numRows($exists);
if($num > 0){
	$sql = "UPDATE online_users SET timestamp='$timestamp' WHERE ip = '$ip'";
	$db_request->updateQuery($sql);
}
else{
	$insert = "INSERT INTO online_users VALUES ('$ip', '$timestamp', '$file')";
	$db_request->insertQuery($insert);
}


$delete = "DELETE FROM online_users WHERE timestamp < '$timeout'";
$db_request->deleteQuery($delete);


$check = "SELECT DISTINCT ip FROM online_users WHERE file = '$file'";
$rows = $db_request->numRows($check);

if($rows == 1){
	print("$rows user online.\n");
} else{
	print("$rows users online.\n");
}
?>
