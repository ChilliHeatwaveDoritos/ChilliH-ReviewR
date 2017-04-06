<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	
	$id = $_SESSION['user'];
	$check = "SELECT * FROM users WHERE user_id = '$id' AND score >= 40";

	$db_request = new DBController();
	$rows = $db_request->numRows($check);

	if($rows == 0){
		header("Location: ReviewR.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
		<title>ReviewR</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
</head>
<body>

<?php
if (isset($_POST) && count ($_POST) > 0){
	$id = stripslashes($_POST["ID"]);
	$create_date = date("Y-m-d H:i:s");
	$reason= stripslashes($_POST["reason"]);
	
	$db_request = new DBController();
	
	$getEmail = "Select email from users where user_id ='$id'";
	
	$conn =$db_request->getConn();
	$result = $db_request->runQuery($getEmail);
	
	if($result){
		$ban_email = $result[0]["email"];
		$ban_query = "INSERT INTO banned_users(user_id,email,date,reason)VALUES('$id','$ban_email','$create_date','$reason');";
		$db_request->insertQuery($ban_query);
		$delete_query = "DELETE FROM users WHERE user_id = '$id'";
		$db_request->insertQuery($delete_query);
		header("Location: modpage.php");
	}
	else{
		echo "<br>Error. User may not exist.<a href='ban.php' class='button'>return</a><br><br>";
	}
}?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1>BAN USER</h1>
		</div>
	</section>
	<section>
		<div class="align-center">
			<br>
			<a href="ReviewR.php" class="button">Homepage</a>
			<a href="search.php" class="button">Search</a>
			<a href="logout.php" class="button">Logout</a>
			<br>
			<br>
			<?php include(__DIR__.'/modauth.php'); ?>
		</div>
	</section>
	<header class = "major special">
			<h1><br>Ban</h1>
		</header>
	<div class="container">
		<form name="Ban action" method="post">
				User ID<input type="text" name="ID" placeholder="ID" required/>
				Reason<textarea rows="6" name ="reason" placeholder="Reason" maxlength="300"></textarea>
				<ul class ="actions">
						<li><input type = "submit" name = "submit" value="BAN USER" class = "button special"></li>
				</ul>
		</form>
	</div>
<?php }?>

	<section id="footer">
				<ul class="icons">
					<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
				</ul>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

</body>
</html>