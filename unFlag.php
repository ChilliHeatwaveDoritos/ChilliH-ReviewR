<?php
	require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>
<?php
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$FlagId = stripslashes($_POST["ban_id"]);
			
			$updateQuery= "UPDATE `tasks` SET status = 0 WHERE task_id = $FlagId";
			$db_request->insertQuery($updateQuery);

			$FlagQuery= "UPDATE `flagged_tasks` SET resolved =1 WHERE task_id = $FlagId";
			$db_request->insertQuery($FlagQuery);

			header("Location: ./ReviewR.php");

		}
?>
