<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	
?>
<?php
	$db_request = new DBController();
	$id = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1>Make changes to your profile</h1>
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
		
	<section id ="one" class ="main style1 special">
		<div class = "container">
				<header class = "major special">
			<h1>Edit Profile<br /></h1>
		</header>
		<!-- Form Editing Profile -->
		<form method="post" enctype="multipart/form-data" action ="Edit.php">
			<div class='container'>	
				<div class ="row uniform 50%">
					<div class = "6u 12u$(small)">	
							<select name = "format">
										  <option value="fname">First Name</option>
										  <option value="sname">Surname</option>
										  <option value="email">Email</option>
										  <option value="password">Password</option>
										</select>
						</div>
					<div class = "6u 12u$(small)">
						<input type = "text" name = "new" placeholder="New Entry" required/>
					</div>
					<div>
						<ul class ="actions">
							<li><input type = "submit" value="Change" class="button fit special"></li>
							<li><input type = "reset" value = "Reset" class="button fit special"></li>
						</ul>
					</div>
				</div>
			</div>
		</form>		
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