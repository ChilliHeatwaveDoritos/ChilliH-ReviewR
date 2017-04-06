<?php
	
	$db_request = new DBController();
	$today = getdate();
	$date = $today["year"]."-".$today["mon"]."-".$today["mday"];
	
	$query2 = "SELECT task_id FROM tasks WHERE due_date<='$date'";
	$expiredIDs = $db_request->runQuery($query2);
	
	
	$numrows = $db_request-> numRows($query2);
	
	$sqlFailed = "SELECT claimed_tasks.claimant_id FROM tasks, claimed_tasks WHERE tasks.task_id = claimed_tasks.task_id AND tasks.due_date<='$date'";
	$tResult = $db_request->runQuery($sqlFailed);
	if(!empty($tResult)){
		foreach($tResult as $tValue){
			$userScoreQuery = "Select score from users WHERE user_id = '$tValue[user_id]'";
			$score = $db_request->runQuery($userScoreQuery);
			$newScore = ($score[0]["score"] - 30);
			$scoreQuery = "UPDATE users SET score =$newScore WHERE user_id = '$tValue[user_id]'";
			$db_request->insertQuery($scoreQuery);
		}
	}
	
	// code that deletes expired items from task table
	
	$query = "DELETE FROM tasks WHERE due_date<='$date'";
	
	$result = $db_request->deleteQuery($query);
	
	
	//code that delete expired items from flagged and claimed
	
	for($ref =0;$ref<$numrows;$ref++)
	{
		$currentID = $expiredIDs[$ref]['task_id'];
		$query4 = "DELETE FROM claimed_tasks WHERE task_id='$currentID'";
		$query3 = "DELETE FROM flagged_tasks WHERE task_id='$currentID'";
		$result = $db_request->deleteQuery($query3);
		$result = $db_request->deleteQuery($query4);
	}
	
	
	
	
	
	
	
	
	
	
?>