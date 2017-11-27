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
</head>
<body>
	<div id="container">
		<div id="card">
			<h2 id="cardDisplay"></h2>
		</div>
		<button id="nextCard">Next Card</button>
		<button id="previousCard">Previous Card</button>
	</div>

</body>
<script type="text/javascript">
	var counter = 0;
	var cards = <?php echo json_encode($cards); ?>;
	var card = document.getElementById('cardDisplay');
	card.innerHTML = cards[counter]['title'];

	var nextCard = document.getElementById('nextCard');
	var previousCard = document.getElementById('previousCard');

	nextCard.addEventListener('click', function() { incrementCard(); }, false);
	previousCard.addEventListener('click', function() { decrementCard(); }, false);

	function incrementCard() {
		counter++;
		try {
			card.innerHTML = cards[counter]['title'];
		} catch(err) {
			counter = 0;
			card.innerHTML = cards[counter]['title'];
		}	
	}

	function decrementCard() {
		counter--;
		try {
			card.innerHTML = cards[counter]['title'];
		} catch (err) {
			counter = cards.length - 1;
			card.innerHTML = cards[counter]['title'];
		}
	}


</script>
</html>
