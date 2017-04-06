<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tags</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
			include 'Test1.php';
			//echo $countArray,"<br>";
			
			//print_r ($result);
			if (isset($_POST) && count ($_POST) > 0){
			$tag1 = stripslashes($_POST["tag1"]);
			$tag2 = stripslashes($_POST["tag2"]);
			$tag3 = stripslashes($_POST["tag3"]);
			$tag4 = stripslashes($_POST["tag4"]);
			
			$query = "INSERT INTO user_tags(`user_id`, `tag1`, `tag2`, `tag3`, `tag4`) VALUES ('29','$tag1','$tag2','$tag3','$tag4'); ";
			//echo $query;
			$db_request->insertQuery($query);
			}
?>
<?php
if (!isset($_POST) || count($_POST) == 0){?>
<div class ="form">	
<h1>Welcome to my home page!</h1>
<form name ="Test2" method = "POST">
<select name = "tag1" id ="tag"></select>
<br>
<br>
<select name ="tag2"id ="tag2"></select>
<br>
<br>
<select name ="tag3"id ="tag3"></select>
<br>
<br>
<select name ="tag4"id ="tag4"></select>
<br>
<input type="submit" name="submit" value="Submit" />
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
<?php }
?>
</body>
</html>