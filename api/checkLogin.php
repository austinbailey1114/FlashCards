<?php

require "../core/init.php";

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
	header('Location: ../index.php');
} else {
	header('Location: ../login.php?message=failed');
}