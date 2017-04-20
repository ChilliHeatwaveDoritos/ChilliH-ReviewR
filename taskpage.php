<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
	include '/Test1.php';
	include '/favTags.php';
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
					<h1>This is your personalised <strong>TaskStream</strong></h1>
					<p><strong>These are the tasks chosen for you based on your previous activity. If you stream is empty, don't worry! you just need to start exploring.....</strong></p>
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
				</div>
			</section>
			
			<section class="container">
			<br>
				<h2>Filters</h2>
				<form name="filter" method="post" enctype="multipart/form-data" action ="filterPage.php">
					<div class ="row uniform 50%">
						<div class = "6u 12u$(small)">	
							<div class ="select-wrapper">
								<select name = "type">
								  <option value="tag">Tag</option>
								  <option value="title">Title</option>
								  <option value="type">Type</option>
								  <option value="poster">Poster ID</option>
								</select>
							</div>
						</div>
						<div class = "6u 12u$(small)">
							<input type = "text" name = "filterValue" placeholder="Filter" required/>
						</div>
						<div>
							<br><input type = "submit" value="Change Filter" class="button fit special">
						</div>
					</div>
				</form>		
			</section>

		<!-- One -->
			<section id="one" class="main style1">
				<div class="container">
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
				<div id='1' class="container">
					<header class="major special">
						<h2>Tasks suggested for you...</h2>
					</header>
					<section id = "TaskStream">
					
					</section>
				</div>
	</section>
	
	<script>
	var tagArray = <?php if(empty($suggestedTasks))echo json_encode($result1);
						else echo json_encode($suggestedTasks);?>;
	var count = <?php echo $countArray; ?>;
		(function() {
			var elm = document.getElementById('TaskStream'),

				df = document.createDocumentFragment();
			for (var i = 0; i < tagArray.length; i++) {
				if(tagArray[i]["status"] == "0" || tagArray[i]["status"] == "4")
				{
				var div = document.createElement("div");
				var div2 = document.createElement("div");
				div.className="align-center";
				div2.className="12u$";
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
				var  ul = document.createElement("ul");
				ul.className="actions uniform";
				var  li = document.createElement("li");
				
				
				title.appendChild(document.createTextNode(tagArray[i]["title"]));
				div.appendChild(title);
				df.appendChild(div);
				description.appendChild(document.createTextNode("Description: "+tagArray[i]["description"]));
				
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Pages: "+tagArray[i]["pages"]));
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Word Count: "+tagArray[i]["words"]));
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Format: "+tagArray[i]["format"]));
					description.appendChild(document.createElement("br"));
				description.appendChild(document.createTextNode("Expiration Date: "+tagArray[i]["due_date"]));
					description.appendChild(document.createElement("br"));
				div.appendChild(description);
				df.appendChild(div);
				
				
			///More Details form
				moreDetailsButton.setAttribute("type","submit");
				moreDetailsButton.value="More Details";				
				moreDetailsButton.className ="uniform row";				
				moreDetails.appendChild(moreDetailsButton);
				
				poster_id2.type  ="hidden";
				poster_id2.name= "poster_id";
				poster_id2.id = tagArray[i]['poster_id'];
				poster_id2.value=tagArray[i]['poster_id'];

				moreDetails.appendChild(poster_id2);
				
				task_id2.type = "hidden";
				task_id2.name= "task_id";
				task_id2.id= "task_id";
				task_id2.value=tagArray[i]['task_id'];
				
				moreDetails.appendChild(task_id2)
				
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
				buttonSubmit.className ="uniform row";
				claimForm.appendChild(buttonSubmit);

				div2.appendChild(claimForm);
				div2.appendChild(moreDetails);
					
				df.appendChild(div);
				df.appendChild(div2);
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