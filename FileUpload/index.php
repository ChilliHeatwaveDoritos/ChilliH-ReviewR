<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Upload file</title>
</head>

<body>

<form action="uploadmanager.php" enctype="multipart/form-data" method="post">
    Last Name:<br /> 
    <input type="text" name="name" value="" /><br />
    Class Notes:<br /> 
    <input type="file" name="classnotes" value="" /><br />
    <p><input type="submit" name="submit" value="Submit Notes" /></p>
</form>

</body>

</html>