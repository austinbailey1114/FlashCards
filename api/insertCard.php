<?php

require '../core/init.php';

//topic_id and topic_title hidden on study/php
$topic_id = $_POST['topic_id'];
$topic_title = $_POST['topic_title'];
$title = $_POST['titleCopy'];
$def = $_POST['definition'];

$sql = "INSERT INTO cards (topic_id, title, definition) 
VALUES (?, ?, ?)";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("iss", $topic_id, $title, $def);

if ($stmt->execute()) {
	//card added successfully
} else {
	//card not added
}

header("Location: ../study.php?topic_id=" . $topic_id . "&title=" . $topic_title);


