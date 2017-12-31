<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
</head>
<body>

	<form action="./api/insertUser.php" method="post">
		<input type="text" name="username">
		<input type="password" name="password">
		<input type="text" name="email">
		<button>Sumbit</button>
	</form>
	
</body>
</html>