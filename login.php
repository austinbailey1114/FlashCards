<?php

require './core/init.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
	<div>
	<div id="centerDiv">
		<div id="colorDiv"></div>
		<form action="./api/checklogin.php" method="post" id="form">
			<p></p>
			<input type="text" name="username" placeholder="Username" id="usernameInput">
			<input type="password" name="password" placeholder="password" id="passwordInput">
			<button id="login">Log In</button>
		</form>
	</div>
	<a href="./newUser.php" id="newUser">New User</a>
	</div>
</body>
</html>