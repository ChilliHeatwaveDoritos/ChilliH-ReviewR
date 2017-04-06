<?php
require_once(__DIR__.'/auth.php');
require_once __DIR__.'/dbcontroller.class.php';
include '/Test1.php';

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
		<link rel="stylesheet" href="assets/css/main.css" />
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
					<a href="search.php" class="button">Search</a>
					<a href="logout.php" class="button">Logout</a>
					<br>
					<br>
					<?php include(__DIR__.'/modauth.php'); ?>
				</div>
			</section>
		
		<section id="one" class="main style1">
				<div class="align-center">
					<h2>Flagged Tasks</h2>
				
				</div>
		</section>
			
		 <section id="two" class="mainstyle1">
				<div class="container">
					<div class="align-center">
						<div id = "tasks">
						</div>
					</div>
				</div>
		 </section>
		 <script>
			var flagArray= <?php echo json_encode($result1); ?>;
			var flagged= <?php echo json_encode($flaggedTasks); ?>;
				(function() {
			var elm = document.getElementById('tasks'),
				df = document.createDocumentFragment();
				for (var i = 0; i < flagArray.length; i++) {
				if(flagArray[i]["status"] == "2")
						{		
							var div = document.createElement("div");
							var div2 = document.createElement("div");
							var title = document.createElement('h3');
							var description = document.createElement("P");
							//More Details
							var poster_id = document.createElement("input");
							var task_id = document.createElement("input");
							var moreDetailsButton = document.createElement("input");
							var moreDetails = document.createElement("form");
								moreDetails.method="POST";
								moreDetails.action="MoreDetails.php";
							//Delete Tasks
							var deleteForm = document.createElement("form");
							var banned_id = document.createElement("input");
							var deleteButton = document.createElement("input");
								deleteForm.method= "post";
								deleteForm.action= "Delete.php";
							//Unflag Task
							var unFlagForm = document.createElement("form");
							var flag_id = document.createElement("input");
							var unFlagButton = document.createElement("input");
								unFlagForm.method= "post";
								unFlagForm.action= "UnFlag.php";	
							
							title.appendChild(document.createTextNode(flagArray[i]["title"]));
							div.appendChild(title);
							df.appendChild(div);
							description.appendChild(document.createTextNode("Descriptions: "+flagArray[i]["description"]));
							
								description.appendChild(document.createElement("br"));
							description.appendChild(document.createTextNode("Pages: "+flagArray[i]["pages"]));
								description.appendChild(document.createElement("br"));
							description.appendChild(document.createTextNode("Word Count: "+flagArray[i]["words"]));
								description.appendChild(document.createElement("br"));
							description.appendChild(document.createTextNode("Format: "+flagArray[i]["format"]));
								description.appendChild(document.createElement("br"));
							description.appendChild(document.createTextNode("Expiration Date: "+flagArray[i]["due_date"]));
								description.appendChild(document.createElement("br"));
							div.appendChild(description);
							df.appendChild(div);
							
							//Delete Form
							banned_id.type = "hidden";
							banned_id.name = "ban_id";
							banned_id.value = flagArray[i]['task_id'];
							deleteForm.appendChild(banned_id);
							deleteButton.type = "submit";
							deleteButton.value = "Delete";
							deleteButton.className="uniform row";
							deleteForm.appendChild(deleteButton);
							
							div2.appendChild(deleteForm);
							
							//Unflag
							flag_id.type = "hidden";
							flag_id.name = "ban_id";
							flag_id.value = flagArray[i]["task_id"];
							unFlagForm.appendChild(flag_id);
							unFlagButton.type = "submit";
							unFlagButton.value = "unFlag";
							unFlagButton.className="uniform row";
							unFlagForm.appendChild(unFlagButton);
							
							div2.appendChild(unFlagForm);
							
							//MoreDetails
							moreDetailsButton.setAttribute("type","submit");
							moreDetailsButton.value="More Details";				
							moreDetailsButton.className ="uniform row";				
							moreDetails.appendChild(moreDetailsButton);
							

							poster_id.type  ="hidden";
							poster_id.name= "poster_id";
							poster_id.id = flagArray[i]['poster_id'];
							poster_id.value=flagArray[i]['poster_id'];

							moreDetails.appendChild(poster_id);
							
							task_id.type = "hidden";
							task_id.name= "task_id";
							task_id.id= "task_id";
							task_id.value=flagArray[i]['task_id'];
							
							moreDetails.appendChild(task_id);
							div2.appendChild(moreDetails);
							df.appendChild(div2);
						}
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