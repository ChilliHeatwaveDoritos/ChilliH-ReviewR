<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
	include '/Test1.php';
	include '/expired.php';
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Profile</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
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
					<a href='ReviewR.php#five' class="button">Claim A Task</a>
				    <a href='EditProfile.php' class="button">Edit Profile Details</a>
					<a href='Upload.php' class="button">Submit a Task</a>
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
									<a href='#two' class="button scrolly profile">Claimed Tasks</a>
								</li>
								<li>
									<a href='#three' class="button scrolly profile">Tasks Being Reviewed</a>
								</li>
								<li>
									<a href='#four' class="button scrolly profile">Uploaded Tasks</a>
								</li>
								<li>
									<a href='#five' class="button scrolly profile">Cancelled Tasks</a>
								</li>
								<li>
									<a href='#six' class="button scrolly profile">Completed Tasks</a>
								</li>
								<li>
									<a href='#seven' class="button scrolly profile">Expired Unclaimed Tasks</a>
								</li>
								<li>
									<a href='TaskPage.php#1' class="button scrolly profile">Suggested Tasks</a>
								</li>
								<li>
									<a href='deleteAccount.php' class="button scrolly profile">Delete Profile</a>
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
							$DBQuery = "SELECT tasks.task_id, tasks.poster_id, email, title, description, tasks.status, due_date FROM tasks, claimed_tasks, users WHERE tasks.task_id=claimed_tasks.task_id AND users.user_id = tasks.poster_id AND claimant_id ='$id' AND tasks.status = '1' ORDER BY due_date ASC";
							$claimed =  $DB_request->runQuery($DBQuery);
						 if(empty($claimed))
							{
								$claimed[]="No Tasks To Display";
							}
						?>
						 <!-- Script for section 4 printing the tasks and holding the Delete form -->
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('two'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			if(claimed[0] == "No Tasks To Display")
									{
										var div = document.createElement("div");
										div.className="align-center";
										var title = document.createElement('h3');
										title.appendChild(document.createTextNode(claimed[i]));
										div.appendChild(title);
										df.appendChild(div);
									}
									else
									{
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
	                    			var description = document.createElement("P");
	                    			var buttonSubmit = document.createElement("input");
	                      			var poster_id = document.createElement("input");
									var email = document.createElement("input");
									var task_id = document.createElement("input");
									var poster_id2 = document.createElement("input");
									var task_id2 = document.createElement("input");
									var task_id8 = document.createElement("input");
									var poster_id8 = document.createElement("input");
									var moreDetailsButton = document.createElement("input");
									var cancelButton = document.createElement("input");
									var claimForm = document.createElement("form");
									claimForm.method="POST";
									claimForm.action="SendReview.php";
									var moreDetails = document.createElement("form");
									moreDetails.method="POST";
									moreDetails.action="Email.php";
									var cancelTask = document.createElement("form");
									cancelTask.method="POST";
									cancelTask.action="CancelTask.php";
				
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
									div.appendChild(description);
									df.appendChild(div);
				               	
								    //More Details form
									poster_id8.type  ="hidden";
									poster_id8.name= "poster_id";
									poster_id8.id = claimed[i]['poster_id'];
									poster_id8.value=claimed[i]['poster_id'];
									moreDetails.appendChild(poster_id8);
									
									task_id8.type = "hidden";
									task_id8.name= "task_id";
									task_id8.id= "task_id";
									task_id8.value=claimed[i]['task_id'];
									moreDetails.appendChild(task_id8);
									
									moreDetailsButton.setAttribute("type","submit");
									moreDetailsButton.value="Request Full File";				
									moreDetailsButton.className ="uniform row";				
									moreDetails.appendChild(moreDetailsButton);
									
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
									buttonSubmit.value = "Review";
									buttonSubmit.className ="uniform row";
									claimForm.appendChild(buttonSubmit);

									
										
 				
				                   //cancel
									cancelButton.setAttribute("type","submit");
									cancelButton.value="Cancel";				
									cancelButton.className ="uniform row";				
									cancelTask.appendChild(cancelButton);	

									poster_id2.type  ="hidden";
									poster_id2.name= "poster_id";
									poster_id2.id = claimed[i]['poster_id'];
									poster_id2.value=claimed[i]['poster_id'];
									cancelTask.appendChild(poster_id2);
				
									task_id2.type = "hidden";
									task_id2.name= "task_id";
									task_id2.id= "task_id";
									task_id2.value=claimed[i]['task_id'];
									cancelTask.appendChild(task_id2); 
									
									div2.appendChild(claimForm);
									div2.appendChild(moreDetails);
									div2.appendChild(cancelTask);
									
									df.appendChild(div);
									df.appendChild(div2);
									}
								 }
			                 elm.appendChild(df);
							}());
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
				$DBQuery = "SELECT tasks.task_id, claimed_tasks.claimant_id, title, description, email, fname, sname, due_date, tasks.status FROM tasks, claimed_tasks,users WHERE tasks.task_id=claimed_tasks.task_id AND users.user_id = claimed_tasks.claimant_id AND claimed_tasks.poster_id = '$id' AND tasks.status = '1' ORDER BY due_date ASC";
				$claimed =  $DB_request->runQuery($DBQuery);
			   if(empty($claimed))
							{
								$claimed[]="No Tasks To Display";
							}
						?>
						 <!-- Script for section 4 printing the tasks and holding the Delete form -->
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('three'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			if(claimed[0]== "No Tasks To Display")
									{
										var div = document.createElement("div");
										div.className="align-center";
										var title = document.createElement('h3');
										title.appendChild(document.createTextNode(claimed[i]));
										div.appendChild(title);
										df.appendChild(div);
									}
									else
									{
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
	                    			var description = document.createElement("P");
	                    			var EvaluateSubmit = document.createElement("input");
	                                var email = document.createElement("input");
									var poster_id3 = document.createElement("input");
									var task_id3 = document.createElement("input");
									var evaluateForm = document.createElement("form");
									evaluateForm.method="POST";
									evaluateForm.action="deleteWholeTask.php";
									
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Claimant Name: "+claimed[i]["fname"]+ " "+claimed[i]["sname"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("email: "+claimed[i]["email"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("(Claimer) User ID: "+claimed[i]["claimant_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
									div.appendChild(description);
									df.appendChild(div);

									div2.appendChild(evaluateForm);
									df.appendChild(div2);

									poster_id3.type  ="hidden";
									poster_id3.name= "poster_id";
									poster_id3.id = claimed[i]['poster_id'];
									poster_id3.value=claimed[i]['poster_id'];
									evaluateForm.appendChild(poster_id3);
						
									task_id3.type = "hidden";
									task_id3.name= "task_id";
									task_id3.id= "task_id";
									task_id3.value=claimed[i]['task_id'];
									evaluateForm.appendChild(task_id3);
						
									EvaluateSubmit.setAttribute("type","submit");
									EvaluateSubmit.value = "Delete";
									EvaluateSubmit.className ="uniform row";
									evaluateForm.appendChild(EvaluateSubmit);

									div2.appendChild(evaluateForm);
									df.appendChild(div2);
									}
								}
			                 elm.appendChild(df);
							}());
						</script>
					</div>
				</div>
		 </section>	
		 <section id="four" class="main style1">
				<div class="container">
						<div>
						   <header class="major special">
						  <h2><strong>Your Uploaded Tasks</strong></h2>
						  </header>
						  <?php
							$DB_request = new DBController();
							$id = $_SESSION['user'];	
							$DBQuery = "SELECT tasks.task_id, title, description, due_date FROM tasks WHERE poster_id ='$id' AND tasks.status = '0' ORDER BY due_date ASC";
							$claimed =  $DB_request->runQuery($DBQuery);
						 if(empty($claimed))
							{
								$claimed[]="No Tasks To Display";
							}
						?>
						 <!-- Script for section 4 printing the tasks and holding the Delete form -->
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('four'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			if(claimed[0] == "No Tasks To Display")
									{
										var div = document.createElement("div");
										div.className="align-center";
										var title = document.createElement('h3');
										title.appendChild(document.createTextNode(claimed[i]));
										div.appendChild(title);
										df.appendChild(div);
									}
									else
									{
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
									var description = document.createElement("P");
	                    		    var Delete = document.createElement("input");
									var poster_id4 = document.createElement("input");
									var task_id4 = document.createElement("input");
							
									var deleteForm = document.createElement("form");
									deleteForm.method="POST";
									deleteForm.action="deleteWholeTask.php";
				
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
									div.appendChild(description);
									df.appendChild(div);
				               	
							     	poster_id4.type  ="hidden";
									poster_id4.name= "poster_id";
									poster_id4.id = claimed[i]['poster_id'];
									poster_id4.value=claimed[i]['poster_id'];
									deleteForm.appendChild(poster_id4);
						
									task_id4.type = "hidden";
									task_id4.name= "task_id";
									task_id4.id= "task_id";
									task_id4.value=claimed[i]['task_id'];
									deleteForm.appendChild(task_id4);
						
									Delete.setAttribute("type","submit");
									Delete.value = "Delete";
									Delete.className ="uniform row";
									deleteForm.appendChild(Delete);

									div2.appendChild(deleteForm);
									df.appendChild(div2);
									}
								 }
			                 elm.appendChild(df);
							}());
						  </script>
					</div>
				</div>
		 </section>	
		 <section id="five" class="main style1">
				<div class="container">
						<div>
						   <header class="major special">
						  <h2><strong>Your Cancelled Tasks</strong></h2>
						  </header>
						  <?php
							$DB_request = new DBController();
							$id = $_SESSION['user'];	
							$DBQuery = "SELECT tasks.task_id, title, description, due_date FROM tasks WHERE poster_id ='$id' AND status = '4' ORDER BY due_date ASC";
							$claimed =  $DB_request->runQuery($DBQuery);
						 if(empty($claimed))
							{
								$claimed[]="No Tasks To Display";
							}
						?>
						 <!-- Script for section 4 printing the tasks and holding the Delete form -->
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('five'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			if(claimed[0] == "No Tasks To Display")
									{
										var div = document.createElement("div");
										div.className="align-center";
										var title = document.createElement('h3');
										title.appendChild(document.createTextNode(claimed[i]));
										div.appendChild(title);
										df.appendChild(div);
									}
									else
									{
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
	                    			var email = document.createElement("input");
									var description = document.createElement("P");
	                    		    var Cancel = document.createElement("input");
									var poster_id5 = document.createElement("input");
									var task_id5 = document.createElement("input");
							
									var cancelForm = document.createElement("form");
									cancelForm.method="POST";
									cancelForm.action="deleteWholeTask.php";
				
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
									div.appendChild(description);
									df.appendChild(div);
				               	
							     	poster_id5.type  ="hidden";
									poster_id5.name= "poster_id";
									poster_id5.id = claimed[i]['poster_id'];
									poster_id5.value=claimed[i]['poster_id'];
								    cancelForm.appendChild(poster_id5);
						
									task_id5.type = "hidden";
									task_id5.name= "task_id";
									task_id5.id= "task_id";
									task_id5.value=claimed[i]['task_id'];
									cancelForm.appendChild(task_id5);
						
									Cancel.setAttribute("type","submit");
									Cancel.value = "Delete";
									Cancel.className ="uniform row";
									cancelForm.appendChild(Cancel);

									div2.appendChild(cancelForm);
									df.appendChild(div2);
								    }
								 }
			                 elm.appendChild(df);
							}());
						  </script>
					</div>
				</div>
		 </section>	

		 <section id="six" class="main style2">
				<div class="container">
						<div>
						   <header class="major special">
						  <h2><strong>Your Reviewed Tasks</strong></h2>
						  </header>
						  <?php
							$DB_request = new DBController();
							$id = $_SESSION['user'];	
							$DBQuery = "SELECT tasks.task_id, tasks.poster_id,email, claimed_tasks.claimant_id, title, description, tasks.status due_date FROM tasks, claimed_tasks, users WHERE tasks.task_id=claimed_tasks.task_id AND users.user_id = tasks.poster_id AND claimed_tasks.poster_id ='$id' AND tasks.status = '3' ORDER BY due_date ASC";
							$claimed =  $DB_request->runQuery($DBQuery);
						 if(empty($claimed))
							{
								$claimed[]="No Tasks To Display";
							}
						?>
						 <!-- Script for section 4 printing the tasks and holding the Delete form -->
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('six'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			if(claimed[0]== "No Tasks To Display")
									{
										var div = document.createElement("div");
										div.className="align-center";
										var title = document.createElement('h3');
										title.appendChild(document.createTextNode(claimed[i]));
										div.appendChild(title);
										df.appendChild(div);
									}
									else
									{
	                    			var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
	                    			var email = document.createElement("input");
									var description = document.createElement("P");
	                    		    var Evaluate= document.createElement("input");
									var poster_id6 = document.createElement("input");
									var task_id6 = document.createElement("input");
							
									var evaluateForm = document.createElement("form");
									evaluateForm.method="POST";
									evaluateForm.action="ReviewRating.php";
				
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("(Claimer)User ID: "+claimed[i]["claimant_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
									div.appendChild(description);
									df.appendChild(div);
				               	
							     	poster_id6.type  ="hidden";
									poster_id6.name= "poster_id";
									poster_id6.id = claimed[i]['poster_id'];
									poster_id6.value=claimed[i]['poster_id'];
								    evaluateForm.appendChild(poster_id6);
						
									task_id6.type = "hidden";
									task_id6.name= "task_id";
									task_id6.id= "task_id";
									task_id6.value=claimed[i]['task_id'];
									evaluateForm.appendChild(task_id6);
						
									Evaluate.setAttribute("type","submit");
									Evaluate.value = "Evaluate Review";
									Evaluate.className ="uniform row";
									evaluateForm.appendChild(Evaluate);

									div2.appendChild(evaluateForm);
									df.appendChild(div2);
									}
								 }
			                 elm.appendChild(df);
							}());
						  </script>
					</div>
				</div>
		 </section>		

		 <section id="seven" class="main style1">
				<div class="container">
						<div>
						   <header class="major special">
						  <h2><strong>Your Expired Unclaimed Tasks</strong></h2>
						  </header>
						  <?php
							$DB_request = new DBController();
							$id = $_SESSION['user'];	
							$DBQuery = "SELECT tasks.task_id, title, description, due_date FROM tasks WHERE poster_id ='$id' AND status = '6'";
							$claimed =  $DB_request->runQuery($DBQuery);
						    if(empty($claimed))
							{
								$claimed[]="No Tasks To Display";
							}
						?>
						 <!-- Script for section 4 printing the tasks and holding the Delete form -->
						  <script>
						   var claimed = <?php echo json_encode($claimed); ?>;
  	                    	(function() 
							{
								var elm = document.getElementById('seven'),
								df = document.createDocumentFragment();
								 for (var i = 0; i < claimed.length; i++)
								 {
	                    			if(claimed[0] == "No Tasks To Display")
									{
										var div = document.createElement("div");
										div.className="align-center";
										var title = document.createElement('h3');
										title.appendChild(document.createTextNode(claimed[i]));
										div.appendChild(title);
										df.appendChild(div);
									}
									else
									{
									var div = document.createElement("div");
	                    			var div2 = document.createElement("div");
	                     			div.className="align-center";
	                      			div2.className="align-center";
                       				var title = document.createElement('h3');
	                    			var description = document.createElement("P");
	                    		    var Unclaimed = document.createElement("input");
									var poster_id7 = document.createElement("input");
									var task_id7 = document.createElement("input");
							
									var unclaimedForm = document.createElement("form");
									unclaimedForm.method="POST";
									unclaimedForm.action="deleteWholeTask.php";
				
									title.appendChild(document.createTextNode(claimed[i]["title"]));
									div.appendChild(title);
									df.appendChild(div);
									description.appendChild(document.createTextNode("Descriptions: "+claimed[i]["description"]));
				
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Task ID: "+claimed[i]["task_id"]));
									description.appendChild(document.createElement("br"));
									description.appendChild(document.createTextNode("Expiration Date: "+claimed[i]["due_date"]));
									description.appendChild(document.createElement("br"));
									div.appendChild(description);
									df.appendChild(div);
				               	
							     	poster_id7.type  ="hidden";
									poster_id7.name= "poster_id";
									poster_id7.id = claimed[i]['poster_id'];
									poster_id7.value=claimed[i]['poster_id'];
								    unclaimedForm.appendChild(poster_id7);
						
									task_id7.type = "hidden";
									task_id7.name= "task_id";
									task_id7.id= "task_id";
									task_id7.value=claimed[i]['task_id'];
									unclaimedForm.appendChild(task_id7);
						
									Unclaimed.setAttribute("type","submit");
									Unclaimed.value = "Delete";
									Unclaimed.className ="uniform row";
									unclaimedForm.appendChild(Unclaimed);

									div2.appendChild(unclaimedForm);
									df.appendChild(div2); 
									}
								 }
			                 elm.appendChild(df);
							}());
						  </script>
					</div>
				</div>
		 </section>		 
		 <!-- Script for the Profile Stream dynamically printing the users information they provided when registering-->
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