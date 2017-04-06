<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
	include '/Test1.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Profile</title>
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
					<a href="filterPage.php" class="button">Search</a>
					<a href="logout.php" class="button">Logout</a>
					<br>
					<br>
					<p><?php include(__DIR__.'/modauth.php'); ?></p>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="main style1">
				<div class="container">
					<div class="row 150%">
						<div class="6u 12u$(medium)">
							<header class="major">
							
								<h2 class = "status"><strong>Details</strong></h2>
							</header>
								<section id = "ProfileStream">
								</section>
						</div>
						<br>
						<br>
						<br>
						<br>
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
									<a href='' class="button scrolly profile">View Tasks Being Reviewed</a>
								</li>
								<li>
									<a href='EditProfile.php' class="button scrolly profile">Edit Profile Details</a>
								</li>
								<li>
									<a href='UserTags.php' class="button scrolly profile">Edit Tags</a>
								</li>
					     </ul>
						</div>
					</div>
				</div>
			</section>

        <!--two -->
		 <section id="two" class="main style2">
				<div class="container">
						<div>
						   <header class="major special">
						  <h2><strong>Your Claimed Tasks</strong></h2>
						  </header>
						  <?php
							$DB_request = new DBController();
							$id = $_SESSION['user'];	
							$DBQuery = "SELECT tasks.task_id, tasks.poster_id, title, description, due_date FROM tasks, claimed_tasks WHERE tasks.task_id=claimed_tasks.task_id AND claimant_id ='$id'";
							$claimed =  $DB_request->runQuery($DBQuery);
						 ?>
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('two'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
	                    			var description = document.createElement("P");
	                    			var buttonSubmit = document.createElement("input");
	                      			var poster_id = document.createElement("input");
									var task_id = document.createElement("input");
									var poster_id2 = document.createElement("input");
									var task_id2 = document.createElement("input");
									var moreDetailsButton = document.createElement("input");
									var claimForm = document.createElement("form");
									//claimForm.method="POST";
									claimForm.action="SendReview.php";
									var moreDetails = document.createElement("form");
									moreDetails.method="POST";
									moreDetails.action="CancelTask.php";
				
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("(Post) User ID: "+claimed[i]["poster_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
								//	description.appendChild(document.createTextNode("___________________________________________________________________________________________________"));
									div.appendChild(description);
									df.appendChild(div);
				               	
								    //Review Form	
									poster_id.type  ="hidden";
									poster_id.name= "poster_id";
									poster_id.id = claimed[i]['poster_id'];
									poster_id.value=claimed[i]['poster_id'];
									claimForm.appendChild(poster_id);
						
									task_id.type = "hidden";
									task_id.name= "task_id";
									task_id.id= "task_id";
									task_id.value=claimed[i]['task_id'];
									claimForm.appendChild(task_id);
						
									buttonSubmit.setAttribute("type","submit");
									buttonSubmit.value = "Review";
									buttonSubmit.className ="uniform row";
									claimForm.appendChild(buttonSubmit);

									div2.appendChild(claimForm);
									div2.appendChild(moreDetails);
 				
				                   //cancel
									moreDetailsButton.setAttribute("type","submit");
									moreDetailsButton.value="Cancel";				
									moreDetailsButton.className ="uniform row";				
									moreDetails.appendChild(moreDetailsButton);	

									poster_id2.type  ="hidden";
									poster_id2.name= "poster_id";
									poster_id2.id = claimed[i]['poster_id'];
									poster_id2.value=claimed[i]['poster_id'];

									moreDetails.appendChild(poster_id2);
				
									task_id2.type = "hidden";
									task_id2.name= "task_id";
									task_id2.id= "task_id";
									task_id2.value=claimed[i]['task_id'];
				
									.appendChild(document.createTextNode("___________________________________________________________________________________________________"))
									moreDetails.appendChild(task_id2); 
									df.appendChild(div);
									df.appendChild(div2);
								 }
								
			                 elm.appendChild(df);
							}());
				
			/*More Details form
				moreDetailsButton.setAttribute("type","submit");
				moreDetailsButton.value="More Details";				
				moreDetailsButton.className ="uniform row";				
				moreDetails.appendChild(moreDetailsButton);
				

				poster_id2.type  ="hidden";
				poster_id2.name= "poster_id";
				poster_id2.id = claimed[i]['poster_id'];
				poster_id2.value=claimed[i]['poster_id'];

				moreDetails.appendChild(poster_id2);
				
				task_id2.type = "hidden";
				task_id2.name= "task_id";
				task_id2.id= "task_id";
				task_id2.value=claimed[i]['task_id'];
				
				moreDetails.appendChild(task_id2);
				
				//Claim Form	
				poster_id.type  ="hidden";
				poster_id.name= "poster_id";
				poster_id.id = claimed[i]['poster_id'];
				poster_id.value=claimed[i]['poster_id'];
					claimForm.appendChild(poster_id);
					
				task_id.type = "hidden";
				task_id.name= "task_id";
				task_id.id= "task_id";
				task_id.value=claimed[i]['task_id'];
					claimForm.appendChild(task_id);
					
					
				buttonSubmit.setAttribute("type","submit");
				buttonSubmit.value = "Claim";
				buttonSubmit.className ="uniform row";
				claimForm.appendChild(buttonSubmit);

				div2.appendChild(claimForm);
				div2.appendChild(moreDetails);
					
				df.appendChild(div);
				df.appendChild(div2);*/
						  </script>
					</div>
				</div>
		 </section>
		<!--three-->
        <section id="three" class="main style1">
				<div class="container">
						<div>
						   <header class="major special">
						  <h2><strong>Your Tasks Under Review</strong></h2>
						  </header>					
			    <?php
			    $DB_request = new DBController();
				$id = $_SESSION['user'];		
				$DBQuery = "SELECT tasks.task_id, claimed_tasks.claimant_id, title, description, due_date FROM tasks, claimed_tasks WHERE tasks.task_id=claimed_tasks.task_id AND claimed_tasks.poster_id = '$id'";
				$claimed =  $DB_request->runQuery($DBQuery);
			   ?>
				<script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('three'),
								df = document.createDocumentFragment();
								for (var i = 0; i < claimed.length; i++)
								{
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="container";
                       				var title = document.createElement('h3');
	                    			var description = document.createElement("P");
	                    			var buttonSubmit = document.createElement("input");
	                      			var poster_id = document.createElement("input");
									var task_id = document.createElement("input");
									var poster_id2 = document.createElement("input");
									var task_id2 = document.createElement("input");
									var moreDetailsButton = document.createElement("input");
									var claimForm = document.createElement("form");
									claimForm.method="POST";
									claimForm.action="claim.php";
									var moreDetails = document.createElement("form");
									moreDetails.method="POST";
									moreDetails.action="MoreDetails.php";
				
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("(Post) User ID: "+claimed[i]["claimant_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("___________________________________________________________________________________________________"));
									description.appendChild(document.createElement("br"));
									div.appendChild(description);
									df.appendChild(div);
				               	}
			                 elm.appendChild(df);
							}());
						</script>
					</div>
				</div>
		 </section>			  
					<script>
					var userArray = <?php echo json_encode($userArray); ?>;
						var elm = document.getElementById('ProfileStream');
						var df = document.createDocumentFragment();
						var title= document.createElement('p');
						title.appendChild(document.createTextNode("Username:\t\t\t"+userArray[0]["fname"] + " " + userArray[0]["sname"]));
						df.appendChild(title);
						var userID = document.createElement("p");
						userID.appendChild(document.createTextNode("User ID:\t\t\t"+userArray[0]["user_id"]));
						df.appendChild(userID);
						var sID = document.createElement("p");
						sID.appendChild(document.createTextNode("Student ID:\t\t\t"+userArray[0]["sid"]));
						df.appendChild(sID);
						var email = document.createElement("p");
						email.appendChild(document.createTextNode("User email:\t\t\t"+userArray[0]["email"]));
						df.appendChild(email);
						var major = document.createElement("p");
						major.appendChild(document.createTextNode("User Major:\t\t\t"+userArray[0]["major"]));
						df.appendChild(major);
						var score = document.createElement("p");
						score.appendChild(document.createTextNode("User score:\t\t\t"+userArray[0]["score"]));
						df.appendChild(score);
						var userStatus = document.createElement("p");
						userStatus.appendChild(document.createTextNode("User status:\t\t\t"+userArray[0]["staus"]));
						df.appendChild(userStatus);
						elm.appendChild(df);

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