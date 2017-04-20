<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	include '/Test1.php';
	
?>
<!-- PHP script that collects all the information from the task the claimant is reviewing -->
<?php
	$db_request = new DBController();
	$id = $_SESSION['user'];
	$userClaimQuery = "select title,claimed_tasks.task_id from tasks, claimed_tasks where tasks.task_id = claimed_tasks.task_id AND claimant_id = $id AND status = 1";
	$userClaimed = $db_request->runQuery($userClaimQuery);
?>
<!DOCTYPE html>
<html>
<head>
<title>Review</title>
<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
<!-- Header -->
			<section id="header">
				<div class="inner">
					<span class="icon major fa-cloud"></span>
					<h1>Review</h1>
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
					<a href="Profile.php" class="button">Return</a>
				</div>
			</section>	
	<section id ="one" class ="main style1">		
		
	<div class ="container">
		<header class = "major special">
			<h1>Review<br /></h1>
		</header>
		<form method="post" enctype="multipart/form-data" action = "uploadReview.php">
			<div class ="row uniform 50%">
					<div class = "6u 12u$(small)">	
					<div class ="select-wrapper">
						<select name = "TaskId" id = "TaskId" placeholder = "Claimed Tasks"> </select>
					</div>
				</div>
					<div class = "12u$">
					<textarea rows = "6" name = "TaskReview" placeholder = "Review" maxlength = "1000"></textarea>
				</div>
				<div class = "align-left">
					<ul class ="actions">
						<li><input type = "submit" name = "submit" value="Review" class = "special"></li>
					</ul>
				</div>
			</div>
		</form>
		</section>
		<script>
		<!-- JavaScript that prints all the information needed. -->
			var claimedArray = <?php echo json_encode($userClaimed); ?>;
			(function() {
				var  review = document.getElementById("TaskId");
				df = document.createDocumentFragment();
				for (var i = 0; i < claimedArray.length; i++) {
					var title = document.createElement('option');
					title.value = claimedArray[i]["task_id"];
					title.appendChild(document.createTextNode(claimedArray[i]["title"]));

					df.appendChild(title);
				}
				review.appendChild(df);
			}());
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

		<!-- Scripts from the CSS -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
</body>
</html>