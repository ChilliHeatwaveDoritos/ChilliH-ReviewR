<?php
require_once __DIR__.'/dbcontroller.class.php';

if (isset($_POST) && count ($_POST) > 0){
	$email = stripslashes($_REQUEST['email']);
	$password = stripslashes($_REQUEST['password']);
	$siteSalt  = "group15";
    $saltedHash = hash('sha256', $password.$siteSalt);
	
	$isbanned = "SELECT * FROM banned_users WHERE email = '$email'";
    $query = "SELECT * FROM users WHERE email='$email'and password='$saltedHash'";
	$db_request = new DBController();
	$rows = $db_request->numRows($query);
	$banned = $db_request->numRows($isbanned);
	if($banned > 0){
		$get = "SELECT reason from banned_users WHERE email = '$email'";
		$result = $db_request->runQuery($get);
		$reason = $result[0]['reason'];
		echo "<div style='color:white;' class='form'>
		<br><br>
		<h2>This account has been banned.<br> Reason: '$reason'</h2></div>";
	}
	else if($rows==1){
		session_start();
		$getId = "Select user_id FROM `users` WHERE email = '$email'";
		$result = $db_request->runQuery($getId);
			$userId = $result[0]["user_id"];
			$_SESSION['user'] = $userId;
			$date = date("Y-m-d H:i:s");
			header("Location: ./ReviewR.php");
    }
	else{
		echo "<div style='color:white;' class='form'>
		<br><br><br>
		<h3>Email/password is incorrect.</h3>
		<br/>Click here to <a href='landing-login.php'>Login</a></div>";
	}
}
?>
</body>
</html>