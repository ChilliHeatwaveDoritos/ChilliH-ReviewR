<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	include '/Test1.php';
	
?>
<?php
	$db_request = new DBController();
	$id = $_SESSION['user'];
	if (isset($_POST) && count ($_POST) > 0){
			$tag1 = stripslashes($_POST["tag1"]);
			$tag2 = stripslashes($_POST["tag2"]);
			$tag3 = stripslashes($_POST["tag3"]);
			$tag4 = stripslashes($_POST["tag4"]);
		$updateTags = "INSERT INTO `user_tags`(`user_id`, `tag1`, `tag2`, `tag3`, `tag4`) VALUES ($id,$tag1,$tag2,$tag3,$tag4)";
		$db_request->insertQuery($updateTags);
		//echo $updateTags;
		header("Location:Profile.php");
	}
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
			<h1> Hi, We are <strong>ReviewR</strong> we help you</h1>
			<p> stuff about other stuff</p>
		</div>
	</section>
	<section id ="one" class ="main style1 special">
		<div class = "container">
				<header class = "major special">
			<h1>Edit Tags<br/></h1>
		</header>
		<form method="post" enctype="multipart/form-data">
			<div class ="row uniform 50%">
				
				<div class = "6u 12u$(small)">	
					<div class ="select-wrapper">
						<select name = "tag1" id = "tag"> </select>
					</div>
				</div>
				<div class = "6u 12u$(small)">	
					<div class ="select-wrapper">
						<select name = "tag2" id = "tag2"> </select>
					</div>
				</div>
				<div class = "6u 12u$(small)">	
					<div class ="select-wrapper">
						<select name = "tag3" id = "tag3"> </select>
					</div>
				</div>
				<div class = "6u 12u$(small)">	
					<div class ="select-wrapper">
						<select name = "tag4" id = "tag4"> </select>
					</div>
				</div>
				<div>
					<ul class ="actions">
						<li><input type = "submit" value="Change"></li>
						<li><input type = "reset" value = "Reset"></li>
					</ul>
				</div>
			</div>
		</form>		
		</div>
	</section>
		<script>
		var tagArray = <?php echo json_encode($result); ?>;
		(function() {
			var elm = document.getElementById('tag'),
				df = document.createDocumentFragment();
			for (var i = 0; i < tagArray.length; i++) {
				var option = document.createElement('option');
				option.value = tagArray[i]["tag_id"];
				option.appendChild(document.createTextNode(tagArray[i]["value"]));
				df.appendChild(option);
			}
			elm.appendChild(df);
		}());
		</script>
		<script>
	(function() {
			var elm = document.getElementById('tag2'),
				df = document.createDocumentFragment();
			for (var i = 0; i < tagArray.length; i++) {
				var option = document.createElement('option');
				option.value = tagArray[i]["tag_id"];
				option.appendChild(document.createTextNode(tagArray[i]["value"]));
				df.appendChild(option);
			}
			elm.appendChild(df);
		}());
	</script>
	<script>
	(function() {
			var elm = document.getElementById('tag3'),
				df = document.createDocumentFragment();
			for (var i = 0; i < tagArray.length; i++) {
				var option = document.createElement('option');
				option.value = tagArray[i]["tag_id"];
				option.appendChild(document.createTextNode(tagArray[i]["value"]));
				df.appendChild(option);
			}
			elm.appendChild(df);
		}());
	</script>
	<script>
	(function() {
			var elm = document.getElementById('tag4'),
				df = document.createDocumentFragment();
			for (var i = 0; i < tagArray.length; i++) {
				var option = document.createElement('option');
				option.value = tagArray[i]["tag_id"];
				option.appendChild(document.createTextNode(tagArray[i]["value"]));
				df.appendChild(option);
			}
			elm.appendChild(df);
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
</body>
</html>