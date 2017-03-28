<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
	include '/Test1.php';
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
					<h1>Welcome, This is <strong>ReviewR</strong>, a place<br />
					designed for you and your studies.</h1>
					<p>Post your assignments, projects, essays, articles, computer code here<br />
					and other users across the globe will help you.</p>
					<p><?php include(__DIR__.'/online.php'); ?></p>
					<ul class="actions">
						<li><a href="Upload.php" class="button scrolly">Upload</a></li>
					</ul>
				</div>
			</section>
			
			<section>
				<div class="align-center">
					<br>
					<a href="Profile.php" class="button">Profile</a>
					<a href="search.php" class="button">Search</a>
					<a href="logout.php" class="button">Logout</a>
					<br>
					<br>
					<?php include(__DIR__.'/modauth.php'); ?>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="main style1">
				<div class="container">
					<div class="row 150%">
						<div class="6u 12u$(medium)">
							<header class="major">
								<h2>Check out other people posts <br />
								here.</h2>
							</header>
							<p>All these posts are tasks waiting to be claimed by a user 
							who wishes to review the post and offer effective and diligent advice. 
							Would you like to claim a task?</p> 
						</div>
						<div class="6u$ 12u$(medium) important(medium)">
							<span class="image fit"><img src="images/pic01.jpg" alt="" /></span>
						</div>
					</div>
				</div>
			</section>
			
	<!--		<section id="five" class="main style1">
				<div class="container">
					<header class="major special">
						<h2 style="background-color: #555; color: white;">Here are the tasks ready to be claimed</h2>
					</header>
					
				</div>
			</section>-->
			<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<section id="five" class="main style2 special">
				<div class="container">
					<header class="major special">
						<h2>Tasks</h2>
					</header>
					<section id = "TaskStream">
					
					</section>
				</div>
	</section>
	
	<script>
	var tagArray = <?php echo json_encode($result1); ?>;
	var count = <?php echo $countArray; ?>;
		(function() {
			var elm = document.getElementById('TaskStream'),

				df = document.createDocumentFragment();
			for (var i = 0; i < tagArray.length; i++) {
				if(tagArray[i]["status"] == "0")
				{
				var title = document.createElement('h3');
				var description = document.createElement("P");
				var buttonSubmit = document.createElement("input");
				var poster_id = document.createElement("input");
				var task_id = document.createElement("input");
				var moreDetailsButton = document.createElement("input");
				var claimForm = document.createElement("form");
					claimForm.method="POST";
					claimForm.action="claim.php";
				var moreDetails = document.createElement("form");
					moreDetails.method="POST";
					moreDetails.action="MoreDetails.php";
				title.appendChild(document.createTextNode(tagArray[i]["title"]));

				df.appendChild(title);
				description.appendChild(document.createTextNode("Descriptions: "+tagArray[i]["description"]));
				
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Pages: "+tagArray[i]["pages"]));
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Word Count: "+tagArray[i]["words"]));
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Format: "+tagArray[i]["format"]));
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Expiration Date: "+tagArray[i]["due_date"]));
					
				df.appendChild(description);
	//More Details form
					moreDetailsButton.setAttribute("type","submit");
					moreDetailsButton.value="More Details";				
					moreDetails.appendChild(moreDetailsButton);
							
				//Claim Form	
				poster_id.type  ="hidden";
				poster_id.name= "poster_id";
				poster_id.id = tagArray[i]['poster_id'];
				poster_id.value=tagArray[i]['poster_id'];
					claimForm.appendChild(poster_id);
					
				task_id.type = "hidden";
				task_id.name= "task_id";
				task_id.id= "task_id";
				task_id.value=tagArray[i]['task_id'];
					claimForm.appendChild(task_id);
					
				buttonSubmit.setAttribute("type","submit");
				buttonSubmit.value = "Claim";
				buttonSubmit.class ="special";
					claimForm.appendChild(buttonSubmit);
					
					moreDetails.appendChild(poster_id);
					moreDetails.appendChild(task_id);
				df.appendChild(moreDetails);	
				df.appendChild(claimForm);		
				}
			}
			elm.appendChild(df);
		}());
		
	</script>
	
<?php }
?>
		

		<!-- Footer -->
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