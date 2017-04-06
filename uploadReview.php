<?php
		require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>
<?php
	$id = $_SESSION['user'];
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$TaskId = stripslashes($_POST["TaskId"]);
			$TaskReview = stripslashes($_POST["TaskReview"]);
			
			$resolveQuery= "UPDATE claimed_tasks SET`Resolved`=1,`Review`='$TaskReview' WHERE task_id = $TaskId";
			$db_request->insertQuery($resolveQuery);
			
			$statusQuery = "UPDATE tasks SET status='3' WHERE task_id = '$TaskId'";
			$db_request->insertQuery($statusQuery);
			
		
			header("Location: ./ReviewR.php");
		}
?>
