<?php
		require_once __DIR__.'/dbcontroller.class.php';
		require_once(__DIR__.'/auth.php');
?>
<?php
	$id = $_SESSION['user'];
	$db_request = new DBController();

		if (isset($_POST) && count ($_POST) > 0){
			$check = stripslashes($_POST["format"]);
			$claimant = stripslashes($_POST["claimant"]);
			$task_id = stripslashes($_POST["task_ID"]);
			//Changes the status of the task to 5 which is finished.
			$finishTask = "UPDATE tasks SET status='5' WHERE task_id = '$task_id'";
			$db_request->insertQuery($finishTask);
			if($check == 2)
			{	
			//Claimant loses 5 for a bad review
			$userScoreQuery = "Select score from users WHERE user_id = $claimant";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] - 5);
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = $claimant";
			$db_request->insertQuery($scoreQuery);
			header("Location: ./Profile.php#two");
			}
			//Claimant gains 5 points for a good review
			else if ($check == 1 )
			{
			$userScoreQuery = "Select score from users WHERE user_id = $claimant";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] +5);
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = $claimant";
			$db_request->insertQuery($scoreQuery);
			header("Location: ./Profile.php#two");
			}
			
		}
		
?>
