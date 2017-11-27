<?php

require '../core/init.php';
require 'Statement.php';

$id = $_GET['id'];

$stmt = new Statement();
$topics = $stmt->getData($mysqli, "SELECT * FROM topics WHERE user_id = ?", $id);
echo json_encode($topics);