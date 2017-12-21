<?php

require '../core/init.php';

$title = $_POST['newTopicInput'];

$result = $query->table('topics')->insert(array('user_id', 'name'), array($_SESSION['id'], $title))->execute();

var_dump($result);

header('Location: ../index.php');