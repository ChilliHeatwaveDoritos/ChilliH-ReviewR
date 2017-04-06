<?php
		require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Change</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php
if (isset($_POST) && count ($_POST) > 0){
	$id = $_SESSION['user'];
	$new = stripslashes($_POST["new"]);
	$choice = stripslashes($_POST["format"]);

	$db_request = new DBController();

	$update_query = "UPDATE users SET $choice = '$new' WHERE user_id = '$id'";
	//echo $update_query;
	 $db_request->insertQuery($update_query);
	 header("Location:Profile.php");
	
	}
?>

</body>
</html>