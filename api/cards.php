<?php

require '../core/init.php';

$id = $_GET['id'];

//grab card data

$cards = $query->table('cards')->where('topic_id', '=', $id)->execute();
echo json_encode($cards);