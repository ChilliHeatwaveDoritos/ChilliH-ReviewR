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
	$task_id = stripslashes($_POST["ID"]);
	
	$db_request = new DBController();
	$checkTask = "SELECT * FROM tasks WHERE task_id = $task_id";
	$result = $db_request->numRows($checkTask);
	
	if($result > 0){
		$delete_query = "DELETE FROM tasks WHERE task_id = '$task_id'";
		$db_request->insertQuery($delete_query);
		header("Location: modpage.php");
	}
	else{
		echo "<br>Error. Task may not exist! <a href='ban.php' class='button'>return</a><br><br>";
	}
}?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1>Remove Task</h1>
		</div>
	</section>
	<section class="container">
		<div class="align-center">
			<br>
			<a href="ReviewR.php" class="button">Homepage</a>
			<a href="filterPage.php" class="button">Search</a>
			<a href="logout.php" class="button">Logout</a>
			<br>
			<br>
			<?php include(__DIR__.'/modauth.php'); ?>
			<br>
		</div>
		<br>
		
		<div class="container">
		<form name="remove task" method="post">
				Task ID<input type="text" name="ID" placeholder="ID" required/>
				<ul class ="actions">
						<br><li><input type = "submit" name = "submit" value="Remove Task" class = "button fit special"></li>
				</ul>
		</form>
	</section>
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