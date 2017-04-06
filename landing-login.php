<?php
require_once __DIR__.'/login.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style2.css" type="text/css">
<title>Login Page</title>
</head>
<body>
	<div class="header"><img src="reviewr2.png" /></div>
	<?php
		if (!isset($_POST) || count($_POST) == 0){?>
		<div class="form">
		<h2 class="log">Log In</h2>
		<form action="" method="post" name="login">
		<input type="text" name="email" maxlength="255" placeholder="Email" required /><br>
		<input type="password" name="password" maxlength="32" placeholder="Password" required /><br>
		<input name="submit" type="submit" value="Login" />
		</form>
		<h3 class="reg">Not registered yet?<br> <a href='register.php'>Register Here</a></h3>
	<?php } ?>
		</div>
	<br>
	<!-- </div> -->
</body>
</html>