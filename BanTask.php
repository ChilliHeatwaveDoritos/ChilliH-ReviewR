<?php
		require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>
<?php
	$id = $_SESSION['user'];
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$reporterId = stripslashes($_POST["reporterId"]);
			$task_id = stripslashes($_POST["banTaskId"]);
			
			$banQuery= "INSERT INTO `flagged_tasks`(`task_id`, `reporter_id`) VALUES ($task_id,$reporterId)";
			$db_request->insertQuery($banQuery);
			
			$statusQuery = "UPDATE tasks SET status='2' WHERE task_id = '$task_id'";
			$db_request->insertQuery($statusQuery);
			$userScoreQuery = "Select score from users WHERE user_id = $id";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] + 2);
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = $id";
			$db_request->insertQuery($scoreQuery);
			header("Location: ./ReviewR.php");
		}
?>
