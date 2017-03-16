<?php
	require_once __DIR__.'/dbcontroller.class.php';
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php

if (isset($_POST) && count ($_POST) > 0){
	$fname = stripslashes($_POST["first_name"]);
	$sname = stripslashes($_POST["last_name"]);
	$email = stripslashes($_POST["email"]);
	$sid = stripslashes($_POST["student/staff_id"]);
	$major = stripslashes($_POST["major"]);
	$password1 = stripslashes($_POST["password1"]);
	$password2 = stripslashes($_POST["password2"]);
	$jdate = date("Y-m-d H:i:s");
	
	$db_request = new DBController();
	$check = "SELECT * FROM `users` WHERE `email` = '$email'";
	/*$rows = $db_request->numRows($check);
	if($rows > 0){
		print("<h2> This email already exists! Please log in </h2>");
	}*/
	if ($password1 != $password2){
        printf("<h2> Passwords do not match. </h2>");
	}
	else{
		$query = "INSERT INTO users (fname, sname, sid, email, major, jdate, password) VALUES ('$fname', '$sname', '$sid', '$email',
		'$major', '$jdate', '$password1')";
		$db_request->insertQuery($query);
	}
}
?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<div class="form">
	<h1>Registration</h1>
	<form name="registration" action="" method="post">
	<input type="text" name="first_name" placeholder="First Name" required />
	<input type="text" name="last_name" placeholder="Last Name" required />
	<input type="email" name="email" placeholder="Email" required />
	<input type="text" name="student/staff_id" placeholder="Student/Staff ID" required />
	<input type="text" name="major" placeholder="Major Subject" required />
	<input type="password" name="password1" placeholder="Password" required />
	<input type="password" name="password2" placeholder="Please re-enter your password" required />
	<input type="submit" name="submit" value="Register" />
	</form>
</div><?php }?>

</body>
</html>