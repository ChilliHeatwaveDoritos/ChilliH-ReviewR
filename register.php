<?php
	require_once __DIR__.'/dbcontroller.class.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style2.css" />
</head>
<body>

<?php
//this function generates the verification code
function generateRandomString($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) 
	{
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}




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
	$rows = $db_request->numRows($check);
	if($rows > 0){
		printf("<h2 class='err'> This email already exists! Please <a href='landing-login.php'> Log in!<a/></h2>");
	}
	else if ($password1 != $password2){
        printf("<h2 class='err'> Passwords do not match, please try<a href='register.php'> again.<a/></h2>");
	}
	/* email verification
	else if((mail($email,"test","test"))==0)
	{	 
		printf("<h2 class='err'> Email doesn't exist, please try<a href='register.php'> again with valid email.<a/></h2>");
	}*/
	else{
		$siteSalt  = "group15";
        $saltedHash = hash('sha256', $password1.$siteSalt);
		$query = "INSERT INTO users (fname, sname, sid, email, major, jdate, password) VALUES ('$fname', '$sname', '$sid', '$email',
		'$major', '$jdate', '$saltedHash')";
		$db_request->insertQuery($query);
		header("Location: landing-login.php");
		
		//verification code being sent to mail
		/*$code = generateRandomString();
		$msg = "Please enter the following code and your given email address on the verification page to verify your account:\n".$code;
		mail($email,"ReviewR Verification",$msg);
		$query2 = "INSERT INTO user_codes (email,code)VALUES($email,$code)";
		$result2 = $db_request->insertQuery($query2);*/
		
		
	}
}
?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<div class="header2"><img src="reviewr2.png"/></div>
	<br>
	<div class="form">
	<h2 class="title4">Registration</h2>
	<form name="registration" action="" onsubmit="Validate()" method="post">
	<input type="text" name="first_name" maxlength="32" placeholder="First Name" required />
	<input type="text" name="last_name" maxlength="32" placeholder="Last Name" required />
	<input type="email" name="email" maxlength="255" placeholder="Email" required />
	<input type="text" name="student/staff_id" maxlength="8" placeholder="Student/Staff ID" required />
	<input type="text" name="major" maxlength= "32" placeholder="Major Subject" required />
	<input type="password" name="password1" maxlength="32" placeholder="Password" required />
	<input type="password" name="password2" maxlength="32" placeholder="Please re-enter your password" required />
	<input type="submit" name="submit" value="Register" />
	</form>
	<br>
	<br>
	<h3 class="reg">Already a ReviewR member? <a href='landing-login.php'>Log in!</a></h3>
</div><?php }?>

</body>
</html>