<?php

require './core/init.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css" src="./css/loginStyle.css"></style>
</head>
<body>
	<form action="./api/checklogin.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="password">
		<button></button>
	</form>
	<a href="./newUser.php">New User</a>
</body>
</html>