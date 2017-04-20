<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	include '/Test1.php';
	
	$removeUser = "DELETE FROM users WHERE user_id = $id";
	$postedTasks = "DELETE FROM tasks WHERE poster_id = $id";
	$claimedTasks = "UPDATE tasks, claimed_tasks SET status = 4 WHERE tasks.task_id = claimed_tasks.task_id AND claimed_tasks.claimant_id = $id";
	$deleteClaimed = "DELETE FROM claimed_tasks WHERE claimant_id = $id;";
	$takenTasks = "UPDATE claimed_tasks SET resolved = 2 WHERE poster_id = $id";
	
	$getEmail = "SELECT email FROM users WHERE user_id = $id";
	$emailArr = $db_request->runQuery($getEmail);
	$email = $emailArr[0]['email'];
	$date = date("Y-m-d H:i:s");
	$reason = "User deleted account.";
	$ban = "INSERT INTO banned_users (user_id, email, date, reason) VALUES('$id', '$email', '$date', '$reason')";
	
	
	$db_request->insertQuery($ban);
	$db_request->deleteQuery($removeUser);
	$db_request->deleteQuery($postedTasks);
	$db_request->updateQuery($claimedTasks);
	$db_request->deleteQuery($deleteClaimed);
	$db_request->updateQuery($takenTasks);
	
	unset($_SESSION['user']);
	header("Location: landing-login.php");
?>