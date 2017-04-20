<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
?>
<?php
	$db_request = new DBController();
		$id = $_SESSION['user'];
		if (isset($_POST) && count ($_POST) > 0){
			$poster_id = stripslashes($_POST["poster_id"]);
			$task_id = stripslashes($_POST["task_id"]);
			//Puts Claimant ID,Task id and poster id into the claimed_tasks table
			echo $task_id , '<br>' , $poster_id;
			$query  = "INSERT INTO claimed_tasks(`task_id`, `poster_id`, `claimant_id`) VALUES ('$task_id','$poster_id',$id)";
			$db_request->insertQuery($query);
			$updatequery  = "UPDATE `tasks` SET `status`=  '1' WHERE task_id = '$task_id'";
			$db_request->updateQuery($updatequery);
			//Get 10 points for claiming task
			$userScoreQuery = "Select score from users WHERE user_id = $id";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] + 10);
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = $id";
			$db_request->insertQuery($scoreQuery);
			header("Location: ./Profile.php#two");
		}
?>
