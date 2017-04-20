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
			$taskQuery = "select * from tasks, claimed_tasks where tasks.task_id = claimed_tasks.task_id AND claimed_tasks.task_id = $task_id and resolved = 1";
			$taskArray = $db_request->runQuery($taskQuery);
			$finishTask = "UPDATE tasks SET status='5' WHERE task_id = '$task_id'";
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
			<h1><strong>Evaluate</strong></h1>
			<p>Evaluate the reivew sent to you</p>
		</div>
	</section>
		<section id ="one" class ="main style1 special">
		<div class = "container">
				<header class = "major special">
			<h1>Evaluate<br /></h1>
		</header>
		<div id = "review">
		</div>
		<form method="post" enctype="multipart/form-data" action ="Evaluate.php" id = "form">
			<div class ="row uniform 50%">
				
				<div class = "6u 12u$(small)">	
					<div class ="select-wrapper">
						<select name = "format" id = "check" name = "format">
									  <option value="1">Happy</option>
									  <option value="2">Sad</option>									 
						</select>
					</div>
				</div>
				<div class = "6u 12u$(small)">
					<input type = "submit" value="Change" class = "uniform row">
				</div>
				
			</div>
		</form>		
		</div>
	</section>
	<script>
			var taskArray= <?php echo json_encode($taskArray); ?>;
				(function() 
				{
					var  details = document.getElementById("review"),
					 form = document.getElementById("form"),
					df = document.createDocumentFragment();
					var df2 = document.createDocumentFragment();
					var title = document.createElement('h2');
					var review = document.createElement('p');
					var claimantID = document.createElement('input');
					var task_ID = document.createElement('input');
					claimantID.value = taskArray[0]["claimant_id"];
					task_ID.value = taskArray[0]["task_id"];
					claimantID.type = "hidden";
					task_ID.type = "hidden";
					claimantID.name = "claimant";
					task_ID.name = "task_ID";
					df2.appendChild(claimantID);
					df2.appendChild(task_ID);
					form.appendChild(df2);
					title.appendChild(document.createTextNode(taskArray[0]["title"]));
					df.appendChild(title);
		
					details.appendChild(df);
					review.appendChild(document.createTextNode(taskArray[0]["Review"]));
					df.appendChild(review);
					details.appendChild(df);
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