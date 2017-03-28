<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
	include '/Test1.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload</title>
<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

<?php
if (isset($_POST) && count ($_POST) > 0){
	$poster_id = stripslashes($_POST["PosterID"]);
	$title = stripslashes($_POST["TaskTitle"]);
	$description = stripslashes($_POST["TaskDescription"]);
	$type = stripslashes($_POST["type"]);
	$pages =stripslashes($_POST["Pages"]);
	$words = stripslashes($_POST["words"]);
	$format = stripslashes($_POST["format"]);
	$tag1 = stripslashes($_POST["tag1"]);
	$tag2 = stripslashes($_POST["tag2"]);
	$tag3 = stripslashes($_POST["tag3"]);
	$tag4 = stripslashes($_POST["tag4"]);
	$create_date = date("Y-m-d H:i:s");
	$due_date= stripslashes($_POST["dueDate"]);
	
	$db_request = new DBController();

		
		
		/*echo("INSERT INTO tasks (poster_id,title, type, description, pages, words, format, tag1,tag2,tag3,tag4,create_date,due_date)VALUES ('$poster_id','$title', '$type', '$description', '$pages',
		'$words','$format' ,'$tag1','$tag2','$tag3','$tag4', '$create_date','$due_date');");*/
		
		//TESTING FILE UPLOAD TO A FOLDER BELOW
		
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["File"]["name"]);
		$uploadOk = 1;
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["File"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($fileType != "doc" && $fileType != "docx" && $fileType != "pdf") {
			echo "Sorry, only doc, docx & pdf files are allowed.";
			$uploadOk = 0;
		}
		
		if($uploadOk == 0){
			echo "File upload failed!";
		} else{
			if (move_uploaded_file($_FILES["File"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["File"]["name"]). " has been uploaded.";
				$query = "INSERT INTO tasks (poster_id,title, type, description, pages, words, format, tag1,tag2,tag3,tag4,create_date,due_date)VALUES ('$poster_id','$title', '$type', '$description', '$pages',
				'$words','$format' ,'$tag1','$tag2','$tag3','$tag4', '$create_date','$due_date');";
				$db_request->insertQuery($query);
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}

?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<section id= "header">
		<div class = "inner">
			<span class ="icon major fa-cloud"></span>
			<h1> This where you post your work for review.</h1>
			<ul class ="actions">
				<li><a href= "ReviewR.php" class="button scrolly">Homepage</a><li>
				<br>
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
	
	<section id ="one" class ="main style1">
	<div class ="container">
		<header class = "major special">
			<h1>Upload A Task<br /></h1>
		</header>
		<form method="post" enctype="multipart/form-data">
			<div class ="row uniform 50%">
				<div class = "6u 12u$(small)">
					<input type = "text" name = "TaskTitle" placeholder="Title" required/>
				</div>
				<div class = "6u 12u$(small)">
					<input type = "text" name = "PosterID" placeholder="Id" required/>
				</div>
				<div class = "12u$">
					<textarea rows = "6" name = "TaskDescription"></textarea>
				</div>
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
				<div class = "6u 12u$(small)">
					<input type = "text" name = "type" placeholder="Type" required/>
				</div>
				<div class = "6u 12u$(small)">
					<input type = "text" name = "format" placeholder="Format" required/>
				</div>
				<div class = "6u 12u$(small)">
					<input type = "text" name = "Pages" placeholder="No. of Pages" required/>
				</div>
				<div class = "6u 12u$(small)">
					<input type = "text" name = "words" placeholder="No. of Words" required/>
				</div>	
				<div class = "6u 12u$(small)">	
					<input type = "date" name = "dueDate" placeholder="date" required/>
				</div>
				<div class = "12u$">
					<input type = "file" name = "File" placeholder="file">
				</div>
				<div class = "12u$">
					<ul class ="actions">
						<li><input type = "submit" name = "submit" value="Upload" class = "special"></li>
						<li><input type = "reset" value = "Reset"></li>
					</ul>
				</div>
			</div>
		</form>
		<script>
	var tagArray = <?php echo json_encode($result); ?>;
	var count = <?php echo $countArray; ?>;
		(function() {
			var elm = document.getElementById('tag'),
				df = document.createDocumentFragment();
			for (var i = 0; i < count; i++) {
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
			for (var i = 0; i < count; i++) {
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
			for (var i = 0; i < count; i++) {
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
			for (var i = 0; i < count; i++) {
				var option = document.createElement('option');
				option.value = tagArray[i]["tag_id"];
				option.appendChild(document.createTextNode(tagArray[i]["value"]));
				df.appendChild(option);
			}
			elm.appendChild(df);
		}());
	</script>
		</div>
	</section>
</div><?php }
?>
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