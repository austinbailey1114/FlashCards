<?php

require '../core/init.php';

if (isset($_GET['id'])) {

	$id = $_GET['id'];
	$topics = $query->table('topics')->where('user_id', '=', $id)->execute();
	echo json_encode($topics);

} else if (isset($_POST['newTopicInput'])) {

	$title = $_POST['newTopicInput'];

	$result = $query->table('topics')->insert(array('user_id', 'name'), array($_SESSION['id'], $title))->execute();
	var_dump($result);
	header('Location: ../index.php');
}