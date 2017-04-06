<?php
	require_once(__DIR__.'/auth.php');
	require_once __DIR__.'/dbcontroller.class.php';
?>
<?php
	$db_request = new DBController();
		$id = $_SESSION['user'];
		$getTags = "Select * from tags";
		$result = $db_request->runQuery($getTags);
		$countArray = count($result);
		$getTasks = "Select * from tasks";
		$result1 = $db_request->runQuery($getTasks);
		$countTask = count($result1);
		$userInfo= "Select * from users where user_id = '$id'";
		$userArray = $db_request->runQuery($userInfo);
		$userTagInfo = "Select * from user_tags where user_id = '$id'";
		$userTag = $db_request->runQuery($userTagInfo);
		$getFlaggedTasks = "Select * from flagged_tasks";
		$flaggedTasks = $db_request->runQuery($getFlaggedTasks);
?>
