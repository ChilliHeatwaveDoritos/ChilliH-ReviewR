<?php
	require_once __DIR__.'/dbcontroller.class.php';
?>
<?php
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$poster_id = stripslashes($_POST["poster_id"]);
			$task_id = stripslashes($_POST["task_id"]);
			
			echo $task_id , '<br>' , $poster_id;
			$query  = "INSERT INTO claimed_tasks(`task_id`, `poster_id`, `claimant_id`) VALUES ('$task_id','$poster_id','10')";
			$db_request->insertQuery($query);
			$updatequery  = "UPDATE `tasks` SET `status`=  '1' WHERE task_id = '$task_id'";
			$db_request->updateQuery($updatequery);
			header("Location: ./ReviewR.php");
		}
?>
