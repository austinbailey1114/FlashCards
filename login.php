<?php

require './core/init.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form action="./api/checklogin.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="password">
		<button></button>
	</form>
</body>
</html>