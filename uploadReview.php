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
			//Changes the resolved status 1 showing it is finished and inserts the review into the review column
			$resolveQuery= "UPDATE claimed_tasks SET`Resolved`=1,`Review`='$TaskReview' WHERE task_id = $TaskId";
			$db_request->insertQuery($resolveQuery);
			//Changes the status to 3 showing it is be evaluated
			$statusQuery = "UPDATE tasks SET status='3' WHERE task_id = '$TaskId'";
			$db_request->insertQuery($statusQuery);
			
			header("Location: ./Profile.php");
		}
?>
