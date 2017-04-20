<?php
		require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>

<?php
if (isset($_POST) && count ($_POST) > 0){
	$id = $_SESSION['user'];
	$new = stripslashes($_POST["new"]);
	$choice = stripslashes($_POST["format"]);

	$db_request = new DBController();

	$update_query = "UPDATE users SET $choice = '$new' WHERE user_id = '$id'";
	 $db_request->insertQuery($update_query);
	 header("Location:Profile.php");
	
	}
?>