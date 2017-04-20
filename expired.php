<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	
	$db_request = new DBController();
	$today = getdate();
	$date = $today["year"]."-".$today["mon"]."-".$today["mday"];
	
	$query2 = "SELECT task_id FROM tasks WHERE due_date<='$date'";
	$expiredIDs = $db_request->runQuery($query2);
	
	
	$numrows = $db_request-> numRows($query2);
	
	$sqlFailed = "SELECT claimed_tasks.claimant_id FROM tasks, claimed_tasks WHERE tasks.task_id = claimed_tasks.task_id AND tasks.due_date<='$date' AND (status = 1)";
	$tResult = $db_request->runQuery($sqlFailed);
	if(!empty($tResult)){
		foreach($tResult as $tValue){
			$userScoreQuery = "Select score from users WHERE user_id = '$tValue[claimant_id]'";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] - 30);
			if($newScore < 0)
				$newScore = 0;
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = '$tValue[claimant_id]'";
			$db_request->insertQuery($scoreQuery);
		}
	}
	
	//code that updates expired items from flagged and claimed
	
	for($ref =0;$ref<$numrows;$ref++){
		$currentID = $expiredIDs[$ref]['task_id'];
		$query4 = "UPDATE tasks SET status = 6 WHERE task_id = '$currentID'";
		$result = $db_request->updateQuery($query4);
	}
	
	
	
	
	
	
	
	
	
	
?>