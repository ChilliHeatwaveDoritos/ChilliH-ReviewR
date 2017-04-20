<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
	include '/Test1.php';
	include '/favTags.php';
	$set = 0;
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
					<h1>SEARCH</h1>
				</div>
			</section>
			
			<section>
				<div class="align-center">
					<br>
					<a href="ReviewR.php" class="button">Homepage</a>
					<a href="taskpage.php" class="button">Suggested</a>
					<a href="logout.php" class="button">Logout</a>
					<br>
					<br>
				</div>
			</section>
			<section class="container">
			<br>
				<h2>Filters</h2>
					<form name="filter" method="post" enctype="multipart/form-data">
						<div class ="row uniform 50%">
							
							<div class = "6u 12u$(small)">	
								<div class ="select-wrapper">
									<select name = "type">
									  <option value="tag">Tag</option>
									  <option value="title">Title</option>
									  <option value="description">Description</option>
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
			
			<?php if (isset($_POST) && count ($_POST) > 0){
				$filter = "-";
				$id = $_SESSION['user'];
				$type = stripslashes($_POST["type"]);
				$val = stripslashes($_POST["filterValue"]);
				$getTagId = "SELECT tag_id FROM tags WHERE value='$val'";
				$returnSet = $db_request->runQuery($getTagId);
				if(!empty($returnSet)){
					$filter = $returnSet[0]['tag_id'];
				}
				
				if($type == "tag"){
					$sqlTag = "SELECT * FROM tasks WHERE (tag1='$filter' OR tag2='$filter' OR tag3='$filter' OR tag4='$filter') AND (status = 0 or status = 4) AND (poster_id < '$id' OR poster_id > '$id') ORDER BY due_date ASC";
					$tagResult = $db_request->runQuery($sqlTag);
					if(empty($tagResult)){
						$tagResult[]="0 Results To Display";
					}
				}
				else if($type == "title"){
					$sqlTitle = "SELECT * FROM tasks WHERE (status = 0 or status = 4) AND (poster_id < '$id' OR poster_id > '$id') ORDER BY due_date ASC";
					$tResult = $db_request->runQuery($sqlTitle);
					$titleResult = [];
					
					foreach($tResult as $tValue){
						if(!(strpos(strtolower($tValue['title']),strtolower($val)) === false)){
							array_push($titleResult, $tValue);
						}	
					}
					if(empty($titleResult)){
						$titleResult[]="0 Results To Display";
					}
				}
				else if($type == "type"){
					$sqlType = "SELECT * FROM tasks WHERE type ='$val' AND (status = 0 or status = 4) AND (poster_id < '$id' OR poster_id > '$id') ORDER BY due_date ASC";
					$typeResult = $db_request->runQuery($sqlType);
					if(empty($typeResult)){
						$typeResult[]="0 Results To Display";
					}
				}
				else if($type == "poster"){
					$sqlPoster = "SELECT * FROM tasks WHERE poster_id='$val' AND (status = 0 or status = 4) AND (poster_id < '$id' OR poster_id > '$id') ORDER BY due_date ASC";
					$posterResult = $db_request->runQuery($sqlPoster);
					if(empty($posterResult)){
						$posterResult[]="0 Results To Display";
					}
				}
				else if($type == "description"){
					$sqlDesc = "SELECT * FROM tasks WHERE (status = 0 or status = 4) AND (poster_id < '$id' OR poster_id > '$id') ORDER BY due_date ASC";
					$descResult = $db_request->runQuery($sqlDesc);
					$dResult = [];
				
					foreach($descResult as $tValue){
						if(!(strpos(strtolower($tValue['description']),strtolower($val)) === false)){
							array_push($dResult, $tValue);
						}	
					}
					if(empty($descResult)){
						$descResult[]="0 Results To Display";
					}
				}
				$set = 1;
			} ?>

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

	<section id="five" class="main style2 special">
				<div class="container">
					<section id = "TaskStream">
					
					</section>
				</div>
	</section>
	
	<script>
	var tagArray = <?php if (isset($_POST) && $set == 1){if($type == "tag")echo json_encode($tagResult);
						else if($type == "title") echo json_encode($titleResult);
						else if($type == "type") echo json_encode($typeResult);
						else if($type == "poster") echo json_encode($posterResult);
						else if($type == "description") echo json_encode($dResult);
						}?>;
		(function() {
			var elm = document.getElementById('five'),
			df = document.createDocumentFragment();
			
			for (var i = 0; i < tagArray.length; i++) {
				
				if(tagArray[0] == "0 Results To Display"){
					var div = document.createElement("div");
					div.className="align-center";
					var title = document.createElement('h3');
					title.appendChild(document.createTextNode(tagArray[i]));
					div.appendChild(title);
					df.appendChild(div);
				}
				else if(tagArray[i]["status"] == "0" || tagArray[i]["status"] == "4")
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
				
				moreDetails.appendChild(task_id2);
							
				//Claim Form	
				poster_id.type  ="hidden";
				poster_id.name= "poster_id";
				poster_id.id = tagArray[i]['poster_id'];
				poster_id.value=tagArray[i]['poster_id'];
					claimForm.appendChild(poster_id);
					//moreDetails.appendChild(poster_id);
					
				task_id.type = "hidden";
				task_id.name= "task_id";
				task_id.id= "task_id";
				task_id.value=tagArray[i]['task_id'];
					claimForm.appendChild(task_id);
					//moreDetails.appendChild(task_id);
					
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
	
<?php 
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