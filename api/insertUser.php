<?php

require '../core/init.php';

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

?>