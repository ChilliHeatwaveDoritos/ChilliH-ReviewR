<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
?>
<?php
	$db_request = new DBController();
		if (isset($_POST) && count ($_POST) > 0){
			$task_id = stripslashes($_POST["task_id"]);
			$sql ="DELETE FROM claimed_tasks WHERE task_id='$task_id'";
			$db_request->deleteQuery($sql);
			$sql2="DELETE FROM tasks WHERE task_id='$task_id'";
			$db_request->deleteQuery($sql2);
			$sql3="DELETE FROM Flagged_tasks WHERE task_id='$task_id'";
			$db_request->deleteQuery($sql3);
			header("Location: ./Profile.php#two");
		}
?>
