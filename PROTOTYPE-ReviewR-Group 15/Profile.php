<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
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
					<h1>Welcome, This is <strong>Your Profile</strong>, you can<br />
					review everything that your currently doing.</h1>
					<p>Take a  look at your posts you have submitted, posts that people are reviewing for you<br />
					and posts that you are reviewing for others.</p>
				</div>
			</section>
			<section>
				<div class="align-center">
					<br>
					<a href="ReviewR.php" class="button">Homepage</a>
					<a href="search.php" class="button">Search</a>
					<a href="logout.php" class="button">Logout</a>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="main style1">
				<div class="container">
					<div class="row 150%">
						<div class="6u 12u$(medium)">
							<header class="major">
							<ul class="actions">
					         <li>
					              <a href='' class="button scrolly"> USERNAME</a>
					         </li>
					        </ul>	
								<h2>Current Status</h2>
							</header>
						</div>
						<div>
							<ul class="actionsProfile">
					         <li>
					              <a href='ReviewR.php#five' class="button scrolly profile">Claim A Task</a>
					         </li>
							 <li>
					              <a href='Upload.php' class="button scrolly profile">Submit a Task</a>
					         </li>
							 <li>
					              <a href='' class="button scrolly profile">View Claimed Tasks</a>
					         </li>
							 <li>
					              <a href='' class="button scrolly profile">View Tasks Being Reviewd</a>
					         </li>
							 <li>
					              <a href='' class="button scrolly profile">Edit Profile Details</a>
					         </li>
					        </ul>
						</div>
					</div>
				</div>
			</section>
        <!--two -->
		 <section id="two" class="mainstyle1">
				<div class="container">
					<div class="row 150%">
						<div>
						</div>
					</div>
				</div>
		 </section>
						<?php
						$db_request = new DBController();
						
						$id = $_SESSION['user'];
						$getTasks = "SELECT title, description, tasks.poster_id FROM tasks, claimed_tasks WHERE tasks.task_id = claimed_tasks.task_id AND claimant_id = '$id'";
		                $result1 = $db_request->runQuery($getTasks);
						echo $result1[0]["poster_id"];
						?>
						<script>
	                     var ClaimedArray = <?php echo json_encode($result1); ?>;
						 (function() {
			                 var elm = document.getElementById('two'),
				                  df = document.createDocumentFragment();
								  for (var i = 0; i < ClaimedArray.length; i++)
									  {
				                        var title = document.createElement('h3');
				                        var description = document.createElement("P");
										var poster_id = document.createElement("h4");
									    title.appendChild(document.createTextNode(ClaimedArray[i]["title"]));
				                        df.appendChild(title);
				                        description.appendChild(document.createTextNode("Descriptions: "+ClaimedArray[i]["description"]));
					                    description.appendChild(document.createElement("br"));
				                        poster_id.appendChild(document.createTextNode("User: "+ClaimedArray[i]["poster_id"]));
									    poster_id.appendChild(document.createElement("br"));
										
										df.appendChild(description);
										df.appendChild(poster_id);
										
									  }
									  elm.appendChild(df);
						 }());
						</script>
		<!-- Footer -->
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