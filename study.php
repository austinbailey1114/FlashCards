<?php

require './core/init.php';

$topic_id = $_GET['topic_id'];
$title = $_GET['title'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . "/api/cards.php?id=" . $topic_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$cards = curl_exec($ch);
if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
}

$cards = json_decode(trim($cards), true);

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/study.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="topContainer">
		<h2 id="title"><?php echo $title; ?></h2>
		<a id="topics" href="./index.php">Back to Topics</a>
	</div>
	<div id="sideDiv">
		<p id="displayCount"></p>
		<div id="options">
			<button id="shuffle">Shuffle</button>
			<button id="studyOppositeSide">Definition First</button>
		</div>
		<button id="newCard">+</button>
	</div>
	<div id="container">
		<div id="card">
			<h2 id="cardDisplay"></h2>
		</div>
		<div id="altCard">
			<h2 id="altCardDisplay"></h2>
		</div>
		<div id="newCardDiv" style="display:none;">
			<input type="text" name="title" id="titleInput" placeholder="Front Side">
			<form id="newCardForm" action="./api/insertCard.php" method="post" style="display: none;">
				<input type="text" name="titleCopy" id="titleInputCopy" style="display: none;">
				<input type="text" name="definition" id="definitionInput" placeholder="Back Side">
				<input type="text" name="topic_id" value=<?php echo $topic_id; ?> style="display: none;">
				<input type="text" name="topic_title" value=<?php echo urlencode($title); ?> style="display: none;">
				<button id="addCard">Add Card</button>
			</form>
		</div>
		<div id="cardInteract">
			<button id="nextCard" class="arrow">></button>
			<button id="previousCard" class="arrow"><</button>
			<button id="flipCard">Flip</button>
		</div>
	</div>
</body>
<script type="text/javascript">
	var cards = <?php echo json_encode($cards); ?>;
</script>
<script type="text/javascript" src="./js/study.js"></script>
</html>