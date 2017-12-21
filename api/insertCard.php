<?php

require '../core/init.php';

//topic_id and topic_title hidden on study/php
$topic_id = $_POST['topic_id'];
$topic_title = $_POST['topic_title'];
$title = $_POST['titleCopy'];
$def = $_POST['definition'];

$result = $query->table('cards')->insert(array('topic_id', 'title', 'definition'), array($topic_id, $title, $def))->execute();

header("Location: ../study.php?topic_id=" . $topic_id . "&title=" . $topic_title);


