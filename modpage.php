<?php
require_once(__DIR__.'/auth.php');
require_once __DIR__.'/dbcontroller.class.php';

$id = $_SESSION['user'];
$check = "SELECT * FROM users WHERE user_id = '$id' AND score >= 40";

$db_request = new DBController();
$rows = $db_request->numRows($check);

if($rows == 0){
	header("Location: ReviewR.php");
}
?>

<!DOCTYPE HTML>
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

		<!-- Header -->
			<section id="header">
				<div class="inner">
					<span class="icon major fa-cloud"></span>
					<h1><strong>MODERATOR AREA</strong></h1>
					
				</div>
			</section>
			<section>
				<div class="align-center">
					<br>
					<a href="ReviewR.php" class="button">Homepage</a>
					<a href="filterPage.php" class="button">Search</a>
					<a href="logout.php" class="button">Logout</a>
				</div>
			</section>
		
		<section id="one" class="main style1">
				<div class="align-center">
					<a href='FlaggedTasks.php' class="button modpage">View Flagged Tasks</a>
					<br>
					<a href='Ban.php' class="button modpage">Ban User</a>
					<br>
					<a href='deleteTask.php' class="button modpage">Remove Task</a>
				
				</div>
		</section>
			
		 <section id="two" class="mainstyle1">
				<div class="container">
					<div class="row 150%">
						<div>
						</div>
					</div>
				</div>
		 </section>
		 
		 <section id="footer">
				<ul class="icons">
					<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
				</ul>

			</section>

		<!-- Scripts from the CSS-->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>