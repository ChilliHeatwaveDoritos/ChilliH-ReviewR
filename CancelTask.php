<?php
		require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>
<?php
	$id = $_SESSION['user'];
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$task_id = stripslashes($_POST["task_id"]);
			
			$cancelQuery= "DELETE FROM `claimed_tasks` WHERE task_id = '$task_id'";
			$db_request->insertQuery($cancelQuery);
			
			$statusQuery = "UPDATE tasks SET status='4' WHERE task_id = '$task_id'";
			$db_request->insertQuery($statusQuery);
			//Lost 15 points for cancelling
			$userScoreQuery = "Select score from users WHERE user_id = $id";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] - 15);
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = $id";
			$db_request->insertQuery($scoreQuery);
			header("Location: ./Profile.php#two");
		}
?>
