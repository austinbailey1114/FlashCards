<?php

require '../core/init.php';

//if inserting a user
if (isset($_POST['email'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	$result = $query->table('users')->insert(array('username', 'password', 'email'), array($username, md5($password), $email))->execute();

	if ($result) {
		$user = $query->table('users')->select(array('id'))->where('username', '=', $username)->and_where('password', '=', md5($password))->execute();
	} else {
		echo "Failed to create user";
	}

	$_SESSION['id'] = $user[0]['id'];
	$_SESSION['created'] = time();

	header("Location: ../index.php");

} else { // if retrieving id from a user
	$username = $_POST['username'];
	$password = $_POST['password'];

	$user = $query->table('users')
				  ->select(array('id'))
				  ->where('username', '=', $username)
				  ->and_where('password', '=', md5($password))
				  ->limit(1)
				  ->execute();

	if (count($user) > 0) {
		$_SESSION['id'] = $user[0]['id'];
		$_SESSION['created'] = time();
		header('Location: ../index.php');
	} else {
		header('Location: ../login.php?message=failed');
	}
}