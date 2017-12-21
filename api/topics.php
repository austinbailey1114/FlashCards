<?php

require '../core/init.php';
$id = $_GET['id'];

$topics = $query->table('topics')->where('user_id', '=', $id)->execute();

echo json_encode($topics);