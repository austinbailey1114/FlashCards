<?php

require '../core/init.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$cards = $query->table('cards')->where('topic_id', '=', $id)->execute();
	echo json_encode($cards);

} else if (isset($_POST['topic_id'])) {
	$topic_id = $_POST['topic_id'];
	$topic_title = $_POST['topic_title'];
	$title = $_POST['titleCopy'];
	$def = $_POST['definition'];

	$result = $query->table('cards')->insert(array('topic_id', 'title', 'definition'), array($topic_id, $title, $def))->execute();
	header("Location: ../study.php?topic_id=" . $topic_id . "&title=" . $topic_title);
}

//grab card data