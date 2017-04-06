<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	include '/Test1.php';
	
?>
<?php
	$db_request = new DBController();
	$id = $_SESSION['user'];
	if (isset($_POST) && count ($_POST) > 0)
	{
			$task_id = stripslashes($_POST["task_id"]);
			$taskQuery = "Select * from tasks where task_id = $task_id";
			$db_request->insertQuery($taskQuery);
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Read Review</title>
<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1> Hi, We are <strong>ReviewR</strong> we help you</h1>
			<p> stuff about other stuff</p>
		</div>
	</section>
	<section id ="one" class ="main style1 special">
		<h2>Review</h2>
		<div id = "review"></div>
		<form method = "post" action = "">
			<input  type = "image" src = "images/Happy.png" alt = "submit">
			<input  type = "image" src = "images/sad.jpg">
			
		</form>
	</section>
	<script>
	
	</script>
	<section id="footer">
				<ul class="icons">
					<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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