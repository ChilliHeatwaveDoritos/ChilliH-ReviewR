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
$db_request = new DBController();
	
		if (isset($_POST) && count ($_POST) > 0){
			$poster_id = stripslashes($_POST["poster_id"]);
			$task_id = stripslashes($_POST["task_id"]);
			if($poster_id == null)
				header("Location: profile.php#two");
			
			$getPEmail = "SELECT email FROM users WHERE user_id = $poster_id";
			$posterEmail = $db_request->runQuery($getPEmail);
			$getSEmail = "SELECT email FROM users WHERE user_id = $id";
			$senderEmail = $db_request->runQuery($getSEmail);
			
			$getRName = "SELECT fname FROM users WHERE user_id = $id";
			$rName = $db_request->runQuery($getRName);
			$getFname = "SELECT fname FROM users WHERE user_id = $poster_id";
			$getSname = "SELECT sname FROM users WHERE user_id = $poster_id";
			$fname = $db_request->runQuery($getFname);
			$sname = $db_request->runQuery($getSname);
			
			$getTitle = "SELECT title FROM tasks WHERE task_id = $task_id";
			$title = $db_request->runQuery($getTitle);
		}
?>

	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1>Document Request</h1>
		</div>
	</section>
	<section>
		<div class="align-center">
			<br>
			<a href="ReviewR.php" class="button">Homepage</a>
			<a href="filterPage.php" class="button">Search</a>
			<a href="logout.php" class="button">Logout</a>
			<br>
			<br>
			<?php include(__DIR__.'/modauth.php'); ?>
		</div>
	</section>
	<header class = "major special">
			<br><br>
			<h1>Full Document Request</h1>
		</header>
	<div class="container">
		<?php echo "To: <strong>", $posterEmail[0]['email'],"</strong><br> From: <strong>", $senderEmail[0]['email'], "</strong><br>Re: <strong>[ReviewR] Requesting Full Document for '", $title[0]['title'], "'</strong>";?>
		<form name="Ban action" method="post">
				<br><strong>Template</strong><textarea rows="6" name ="reason" value="" maxlength="300"><?php echo "Hi ", $fname[0]['fname'], ",\n\nI took an interest in your post '", $title[0]['title'], "' and would like to request the full to file to provide my input on your work.\n\n Thank you,\nKind regards,\n", $rName[0]['fname'];?></textarea>
				<ul class ="actions">
						<br><li><input type = "submit" name = "submit" value="Request File" class = "button fit special" action="profile.php"></li>
				</ul>
		</form>
	</div>

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