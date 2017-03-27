<?php
	require_once __DIR__.'/dbcontroller.class.php';
?>
<?php
	$db_request = new DBController();

		$getTags = "Select * from tags";
		$result = $db_request->runQuery($getTags);
		$countArray = count($result);
		$getTasks = "Select * from tasks";
		$result1 = $db_request->runQuery($getTasks);
		$countTask = count($result1);
?>
