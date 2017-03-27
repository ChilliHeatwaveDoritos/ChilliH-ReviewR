<?php 
	require('dbcontroller.class.php');
	if(isset($_POST['search']))
	{
		
		$search = htmlspecialchars($_REQUEST['search']);
		$search = stripslashes($search);
		$query = "SELECT tag_id FROM tags WHERE value = '$search'"; 

		
		$db_request = new DBController();
		$val =0;
		$results =$db_request->runQuery($query);
		if (empty($results)) echo "search term returned no results";
		
		else
		{
			$category = $results[0]["tag_id"];
			$query2 = "SELECT title,description FROM tasks 
			WHERE '$category'=tag1 OR '$category'=tag2 OR '$category'=tag3 OR '$category'=tag4";
			$results =$db_request->runQuery($query2);
			
			$rowlen = count($results);
			echo "Search results for ".$search.":"."<br>";
			
			
			for($row =0;$row<$rowlen;$row++)
			{
				echo "Title"."<br>";
				echo $results[$row]["title"];
				echo "<br>";
				echo "Description:"."<br>";
				echo $results[$row]["description"];
				echo "<br>"."<br>"."<br>";
			}
			
		}
		
		
		
	}//by zach fuck you all
?>
	
	
<form action="" method="post">
	<input type="search" name="search" placeholder="search term" required/>
	
</form>