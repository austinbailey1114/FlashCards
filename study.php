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
		<a id="topics">Back to Topics</a>
	</div>
	<div id="sideDiv">
		<p id="displayCount"></p>
		<div id="options">
			<button id="shuffle">Shuffle</button>
			<button id="studyOppositeSide">Definition First</button>
		</div>
	</div>
	<div id="container">
		<div id="card">
			<h2 id="cardDisplay"></h2>
		</div>
		<div id="cardInteract">
			<button id="nextCard" class="arrow">></button>
			<button id="previousCard" class="arrow"><</button>
			<button id="flipCard">Flip</button>
		</div>
	</div>
	<form action="./api/insertCard.php" method="post" style="display: none;">
		<input type="text" name="title" id="titleInput">
		<input type="text" name="definition" id="definitionInput">
		<input type="text" name="topic_id" value=<?php echo $topic_id; ?> style="display: none;">
		<input type="text" name="topic_title" value=<?php echo $title; ?> style="display: none;">
		<button>Add Card</button>
	</form>
</body>

<script type="text/javascript">
	var counter = 0;
	var cards = <?php echo json_encode($cards); ?>;
	var card = document.getElementById('cardDisplay');
	var displayCount = document.getElementById('displayCount');
	displayCount.innerHTML = counter + 1 + "/" + cards.length;
	var startWithSide = 'title';
	card.innerHTML = cards[counter][startWithSide];

	$('#nextCard').click(function() {
		try {
			card.innerHTML = cards[++counter][startWithSide];
		} catch(err) {
			counter = 0;
			card.innerHTML = cards[counter][startWithSide];
		}
		displayCount.innerHTML = counter + 1 + "/" + cards.length;	
	});

	$('#previousCard').click(function() {
		try {
			card.innerHTML = cards[--counter][startWithSide];
		} catch (err) {
			counter = cards.length - 1;
			card.innerHTML = cards[counter][startWithSide];
		}
		displayCount.innerHTML = counter + 1 + "/" + cards.length;
	});
		
	$('#flipCard').click(function() {
		if (card.innerHTML == cards[counter]['title']) {
			card.innerHTML = cards[counter]['definition'];
		} else {
			card.innerHTML = cards[counter]['title'];
		}
	});

	$('#shuffle').click(function() {
		var backIndex = cards.length-1;
		while (backIndex > 0) {
			var randomIndex = Math.floor(Math.random() * backIndex);
			var temp = cards[backIndex];
			cards[backIndex] = cards[randomIndex];
			cards[randomIndex] = temp;
			backIndex--;
		}
		counter = 0;
		card.innerHTML = cards[counter][startWithSide];
		displayCount.innerHTML = counter + 1 + "/" + cards.length;
	});

	$('#studyOppositeSide').click(function() {
		if (startWithSide == 'title') {
			startWithSide = 'definition';
		} else {
			startWithSide = 'title';
		}
		card.innerHTML = cards[counter][startWithSide];
	});
	

</script>
</html>
















