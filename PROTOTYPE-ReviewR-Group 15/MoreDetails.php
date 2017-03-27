<?php
	require_once __DIR__.'/dbcontroller.class.php';
?>
<?php
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$poster_id = stripslashes($_POST["poster_id"]);
			$task_id = stripslashes($_POST["task_id"]);
			

			$query  = "Select * from tasks where task_id = '$task_id'";
			$result = $db_request->runQuery($query);
			$userName = "Select fname,sname from users where user_id = '$poster_id'";
			$userResult = $db_request->runQuery($userName);
		//	echo $userResult[0]["fname"];
		}
?>
<!DOCTYPE html>
<html>
<head>
<title>More Details</title>
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
			<header class = "major" id = "details">
			</header>
			<div id ='taskDescription'>
			</div>
			<div id ="form">
			</div>
		</div>
		<script>
			var taskArray= <?php echo json_encode($result); ?>;
			var nameArray = <?php echo json_encode($userResult); ?>;
		(function() {
			var  header = document.getElementById("details");
			var  body = document.getElementById("taskDescription");
			var  form = document.getElementById("form");
			df = document.createDocumentFragment();
			df2 = document.createDocumentFragment();
			df3 = document.createDocumentFragment();
			
			//Header
			var title = document.createElement('h2');
			var op = document.createElement('P');
			title.appendChild(document.createTextNode(taskArray[0]["title"]));
			op.appendChild(document.createTextNode("Posted by: "+nameArray[0]["fname"]+" "+nameArray[0]["sname"]));
			df.appendChild(title);
			df.appendChild(op);
			header.appendChild(df);
			
			//Body
			var dateMade = document.createElement('p');
				dateMade.appendChild(document.createTextNode("Created: "+taskArray[0]["create_date"]));
				df2.appendChild(dateMade);
			var taskType = document.createElement('p');
				taskType.appendChild(document.createTextNode("Type: "+taskArray[0]["type"]));
				df2.appendChild(taskType);
			var taskDesc = document.createElement('p');
				taskDesc.appendChild(document.createTextNode("Description: "+taskArray[0]["description"]));
				df2.appendChild(taskDesc);
			var taskPages = document.createElement('p');
				taskPages.appendChild(document.createTextNode("No. of pages: "+taskArray[0]["pages"]));
				df2.appendChild(taskPages);
			var taskWords = document.createElement('p');
				taskWords.appendChild(document.createTextNode("Word count: "+taskArray[0]["words"]));
				df2.appendChild(taskWords);
			var taskFormat = document.createElement('p');
				taskFormat.appendChild(document.createTextNode("Format type: "+taskArray[0]["format"]));
				df2.appendChild(taskFormat);
			var taskTags = document.createElement('p');
				taskTags.appendChild(document.createTextNode("Tags: "+taskArray[0]["tag1"]+taskArray[0]["tag2"]+taskArray[0]["tag3"]+taskArray[0]["tag4"]));
				df2.appendChild(taskTags);
			var expiration = document.createElement('p');
				expiration.appendChild(document.createTextNode("Finish Before: "+taskArray[0]["due_date"]));
				df2.appendChild(expiration);
			body.appendChild(df2);
			
			//Claim form
			 var claimForm = document.createElement("form");
					claimForm.method="POST";
					claimForm.action="claim.php";
			var buttonSubmit = document.createElement("input");
			var poster_id = document.createElement("input");
			var task_id = document.createElement("input");
					poster_id.type  ="hidden";
					poster_id.name= "poster_id";
					poster_id.id =taskArray[0]['poster_id'];
					poster_id.value=taskArray[0]['poster_id'];
						claimForm.appendChild(poster_id);
						
					task_id.type = "hidden";
					task_id.name= "task_id";
					task_id.id= "task_id";
					task_id.value=taskArray[0]['task_id'];
						claimForm.appendChild(task_id);
						
					buttonSubmit.setAttribute("type","submit");
					buttonSubmit.value = "Claim";
					buttonSubmit.class ="special";
						claimForm.appendChild(buttonSubmit);
					df3.appendChild(claimForm); 
					
					form.appendChild(df3);
			
		}());
		</script>
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
</body>
</html>