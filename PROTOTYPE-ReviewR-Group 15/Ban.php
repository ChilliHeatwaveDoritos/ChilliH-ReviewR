<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
?>


<!DOCTYPE html>
<html>
<head>
		<title>ReviweR</title>
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
	$name = stripslashes($_POST["name"]);
	$create_date = date("Y-m-d H:i:s");
	$reason= stripslashes($_POST["reason"]);
	
	$db_request = new DBController();
	
	$getId = "Select email,sid from users where fname ='$name'";
	
	$conn =$db_request->getConn();
	$result = $db_request->runQuery($getId);
	//echo $result[0]['sid'];
	$ban_id = $result[0]["sid"];
	$ban_email = $result[0]["email"];
	$ban_query = "INSERT INTO banned_users(user_id,email,date,reason)VALUES('$ban_id','$ban_email','$create_date','$reason');";
	//echo $ban_query;
	$db_request->insertQuery($ban_query);
	$delete_query = "DELETE FROM users WHERE sid = '$ban_id'";
	$db_request->insertQuery($delete_query);
	}

?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1> Hi, We are <strong>ReviewR</strong> we help you</h1>
			<p> stuff about stuff</p>
			<ul class ="actions">
				<li><a href= "Upload.php" class="button scrolly">Discover</a><li>
				<br>
			 </ul>
		</div>
	</section>
	<div class="container">
	<header class = "major special">
			<h1><br>Ban</h1>
		</header>
	<form name="Ban action="" method="post">
		<div class = "6u 12u$">
					Name<input type = "text" name = "name" placeholder=" Name" required/>
				</div>
		<div class = "12u$">
					Reason
					<textarea rows = "6" name = "reason" placeholder = "Reason"></textarea>
		</div>
			<div class = "12u$">
					<ul class ="actions">
						<li><input type = "submit" name = "submit" value="Upload" class = "special"></li>
						<li><input type = "reset" value = "Reset"></li>
					</ul>
			</div>
	</form>
</div><?php }
?>

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