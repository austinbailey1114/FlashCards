<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
	<link rel="stylesheet" type="text/css" href="./css/newUser.css">
</head>
<body>
	<div id="centerDiv">
		<div id="colorDiv"></div>
		<form action="./api/users.php" method="post">
			<input type="text" name="username" id="usernameInput" placeholder="Username">
			<input type="password" name="password" id="passwordInput" placeholder="Password">
			<input type="text" name="email" id="emailInput" placeholder="Email">
			<button id="submit">Sumbit</button>
	</form>
	</div>
</body>
</html>