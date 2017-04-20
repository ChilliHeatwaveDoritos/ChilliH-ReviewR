<?php
	require_once __DIR__.'/dbcontroller.class.php';
	require_once(__DIR__.'/auth.php');
	
	$db_request = new DBController();
	$id = $_SESSION['user'];
	
	
	$fav = "SELECT tag1, tag2, tag3, tag4 FROM viewed_task WHERE user_id = '$id'";
	$viewed = $db_request->runQuery($fav);
	$numRows = $db_request->numRows($fav);
	if($numRows == 0){
		echo "No records";
	}
	else{
		$col1 = array_column($viewed, 'tag1');
		$col2 = array_column($viewed, 'tag2');
		$col3 = array_column($viewed, 'tag3');
		$col4 = array_column($viewed, 'tag4');
		
		$allCols = array_merge($col1, $col2, $col3, $col4);
		$resArray = array_count_values($allCols);
			
		$max = 0; $maxKey=0;
		$favTag1=0;
		$favTag2=0;
		$favTag3=0;
		$favTag4=0;

		
		foreach ($resArray as $key => $value) {
			if($max == 0){
				$max = $value;
				$maxKey = $key;
			}else if($value > $max){
				$max = $value;
				$maxKey = $key;
			}
			$favTag1 = $maxKey;
		}
		$max=0;
		$maxKey=0;
		foreach ($resArray as $key => $value) {
			if($key != $favTag1){	
				if($max == 0){
					$max = $value;
					$maxKey = $key;
				}else if($value > $max){
					$max = $value;
					$maxKey = $key;
				}
			}
			$favTag2 = $maxKey;
		}
		$max=0;
		$maxKey=0;
		foreach ($resArray as $key => $value) {
			if($key != $favTag1 && $key != $favTag2){	
				if($max == 0){
					$max = $value;
					$maxKey = $key;
				}else if($value > $max){
					$max = $value;
					$maxKey = $key;
				}
			}
			$favTag3 = $maxKey;
		}
		$max=0;
		$maxKey=0;
		foreach ($resArray as $key => $value) {
			if($key != $favTag1 && $key != $favTag2 && $key != $favTag3){	
				if($max == 0){
					$max = $value;
					$maxKey = $key;
				}else if($value > $max){
					$max = $value;
					$maxKey = $key;
				}
			}
			$favTag4 = $maxKey;
		}
		
		$checkTags = "SELECT * FROM user_tags WHERE user_id = '$id'";
		$areTagsSet = $db_request->numRows($checkTags);
		if($areTagsSet == 0){
			$add = "INSERT INTO user_tags (user_id, tag1, tag2, tag3, tag4) VALUES('$id', '$favTag1', '$favTag2', '$favTag3', '$favTag4')";
			$db_request->insertQuery($add);
		}else{
			$update= "UPDATE user_tags SET tag1='$favTag1', tag2='$favTag2', tag3='$favTag3', tag4='$favTag4' WHERE user_id='$id'";
			$db_request->updateQuery($update);
		}
		
		$getTasks = "SELECT * FROM tasks WHERE (status = 0 or status = 4) AND (tag1='$favTag1' OR tag1='$favTag1' OR tag1='$favTag1' OR tag1='$favTag1' OR tag2='$favTag2' OR tag2='$favTag2' OR tag2='$favTag2' OR tag2='$favTag2' OR tag3='$favTag3' OR tag3='$favTag3' OR tag3='$favTag3' OR tag3='$favTag3' OR tag4='$favTag4' OR tag4='$favTag4' OR tag4='$favTag4' OR tag4='$favTag4') AND status = 0 AND (poster_id < '$id' OR poster_id > '$id') ORDER BY due_date ASC";
		$suggestedTasks = $db_request->runQuery($getTasks);
	}
?>