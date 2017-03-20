<?php
	require_once __DIR__.'/dbcontroller.class.php';
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style.css" />
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
	/*$check = "SELECT * FROM `users` WHERE `email` = '$email'";
	/*$rows = $db_request->numRows($check);
	if($rows > 0){
		print("<h2> This email already exists! Please log in </h2>");
	}
	if ($password1 != $password2){
        printf("<h2> Passwords do not match. </h2>");
	}
	else{*/
		$query = "INSERT INTO tasks (poster_id,title, type, description, pages, words, format, tag1,tag2,tag3,tag4,create_date,due_date)VALUES ('$poster_id','$title', '$type', '$description', '$pages',
		'$words','$format' ,'$tag1','$tag2','$tag3','$tag4', '$create_date','$due_date');";
		$db_request->insertQuery($query);
		/*echo("INSERT INTO tasks (poster_id,title, type, description, pages, words, format, tag1,tag2,tag3,tag4,create_date,due_date)VALUES ('$poster_id','$title', '$type', '$description', '$pages',
		'$words','$format' ,'$tag1','$tag2','$tag3','$tag4', '$create_date','$due_date');");*/
	}

?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
	<div class="form">
	<h1>Upload</h1>
	<form name="Upload" action="" method="post">
	<input type="text" name="TaskTitle" placeholder="Title" required />
	<input type="text" name="PosterID" placeholder="Id" required />
	<textarea rows ="10" cols="50" name = "TaskDescription"></textarea>
	<input type="text" name="type" placeholder="Type" required />
	<input type="text" name="Pages" placeholder="Pages" required />
	<input type="text" name="words" placeholder="word count" required />
	<select name ="format">
				  <option value="pdf">pdf</option>
				  <option value="doc">doc</option>
				  <option value="pptx">pptx</option>
				  <option value="xml">xml</option>
				</select>
	<select name ="tag1">
				  <option value="1">Literature</option>
				  <option value="2">Article</option>
				  <option value="3">essay</option>
				  <option value="4">Computer Science</option>
				</select>
	<select name ="tag2">
				  <option value="1">Literature</option>
				  <option value="2">Article</option>
				  <option value="3">essay</option>
				  <option value="4">Computer Science</option>
				</select>
	<select name ="tag3">
				  <option value="1">Literature</option>
				  <option value="2">Article</option>
				  <option value="3">essay</option>
				  <option value="4">Computer Science</option>
				</select>			
	<select name ="tag4">
				  <option value="1">Literature</option>
				  <option value="2">Article</option>
				  <option value="3">essay</option>
				  <option value="4">Computer Science</option>
				</select>
	<input type="date" name="dueDate" placeholder="date" required />
	<input type="submit" name="submit" value="Upload" />
	</form>
</div><?php }?>

</body>
</html>