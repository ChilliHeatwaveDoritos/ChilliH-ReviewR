<?php
	
	/*require('dbcontroller.class.php');
	
	
	
	if(isset($_POST['email'])&& isset($_POST['code']))
	{
		$email =  htmlspecialchars($_REQUEST['email']);
		$code =  htmlspecialchars($_REQUEST['code']);
	
		$db_request = new DBController();
	
		$query = "SELECT * FROM user_codes WHERE email = '$email' AND code = '$code'";
		$query2 = UPDATE users SET status = 'verified' where email = '$email';
	
		$result = $db_request->numRows($query);
		if ($results >0)
		{
			$result = $db_request->updateQuery($query2);
			echo "Your account has been verified";
			$query3 = "DELETE FROM user_codes WHERE email = '$email'";
			$result = $db_request->deleteQuery($query3);
		}
	
		else echo "Incorrect email, code pair";
	
	<form action = "" method = "post">
		<p>Please type your email address and code that you recieved on your specified email</p>
		<input type="text" name="email" placeholder="email address" required/>
		<input type = "text" name = "code" placeholder = "code" required/>
		
		
	</form>*/
		//ini_set('sendmail_from', 'RevieweR@domain.com');
		$to = "zachhyland08@gmail.com";
		$subject = "My subject";
		$txt = "Hello world!";
		$headers = "From: webmaster@example.com" . "\r\n" .
		"CC: somebodyelse@example.com";

		mail($to,$subject,$txt,$headers);

	
	
	
?>