<?php
	require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>
<?php
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$FlagId = stripslashes($_POST["ban_id"]);
			
			$deleteQuery= "DELETE FROM `tasks` WHERE  task_id = $FlagId";
			$db_request->insertQuery($deleteQuery);

			$deleteFlagQuery= "DELETE FROM `flagged_tasks` WHERE  task_id = $FlagId";
			$db_request->insertQuery($deleteFlagQuery);

			header("Location: ./ReviewR.php");

		}
?>
