<?php

require './core/init.php';

$id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
	header('Location: ./login.php');
} else if (time() - $_SESSION['created'] > 1800) {
	session_unset();
	session_destroy();
	header("Location: ./login.php");
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . "/api/topics.php?id=" . $id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$topics = curl_exec($ch);
if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
}

$topics = json_decode(trim($topics), true);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Flash Cards</title>
	<link rel="stylesheet" type="text/css" href="./css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div id="bodyContainer">
	<div id="topContainer">
		<div id="colorBar"></div>
		<h2 id="title">Flash Cards</h2>
		<a id="newTopic">+ Create New</a>
	</div>
	<div id="clickOutOfModal">
		<input type="text" name="searchBar" id="searchBarInput" placeholder="Search Topics">
	<div id="topicsDiv">
		<?php 
		$counter = 0;
		$topicNames = array();
		echo "<div class='containers'>";

		if (count($topics) > 0) {
			foreach ($topics as $topic) {
				if ($counter < 3) {
					echo "<div class='topics' id='div" . $topic['id'] . "' onclick=location.href='./study.php?topic_id=" . $topic['id'] . "&title=" .  urlencode($topic['name']) . "'>";
					echo "<div class='color" . $counter . "'></div>";
					echo "<h3 id=" . $topic['id'] . ">" . $topic['name'] . "</h3>";
					echo "</div>";
					$counter++;
					$topicNames[] = $topic['id'];
				} else {
					echo "</div>";
					echo "<div class='containers'>";
					echo "<div class='topics' id='div" . $topic['id'] . "' onclick=location.href='./study.php?topic_id=" . $topic['id'] . "&title=" .  urlencode($topic['name']) . "'>";
					echo "<div class='color0'></div>";
					echo "<h3 id=" . $topic['id'] . ">" . $topic['name'] . "</h3>";
					echo "</div>";
					$counter = 1;
					$topicNames[] = $topic['id'];

				}
			}
			if ($counter != 0) {
				echo "</div>";
			}
		} else {
			echo "<div class='topics' id='noTopics'>";
			echo "<div class='color" . 0 . "'></div>";
			echo "<h3>" . "Create First Set" . "</h3>";
			echo "</div>";
			echo "</div>";
		}

		?>
	</div>
	</div>
	</div>
	<div id="newTopicModal" style="position: absolute;">
		<form action="./api/insertTopic.php" method="post">
			<h3>Enter a name for your topic:</h3>
			<input type="text" name="newTopicInput" id="newTopicInputId" placeholder="New Topic">
		</form>
		<button id="exit">Exit</button>
	</div>
</body>
<script type="text/javascript">

	//create array of Id's
	var topicId = <?php echo json_encode($topicNames); ?>;

	function newTopic() {
		$('#bodyContainer').css('opacity', '0.2');
		$('#newTopicModal').css('display', 'block');
		$('#newTopicModal').animate({
			top: '-=85%',
		}, 400, function() {
			$('#newTopicInputId').focus();
		})
	}

	$('#searchBarInput').on('input', function() {
		/*
		* On each update to input, check if any of the topic names contain the search string
		*/
		for (var i = 0; i < topicId.length; i++) {
			if (!($('#' + topicId[i]).html().indexOf($('#searchBarInput').val()) >= 0)) {
				// if the topic name contains the string
				$('#div' + topicId[i]).css('display', 'none');
			} else {
				$('#div' + topicId[i]).css('display', 'inline-block');
			}
		}
	});

	$('#newTopic').click(function() {
		newTopic();
	});

	$('#noTopics').click(function() {
		newTopic();
	})

	$('#exit').click(function() {
		$('#bodyContainer').css('opacity', '1');
		$('#newTopicModal').css('display', 'none');
		$('#newTopicModal').css('top', '100%');
	})

</script>
</html>












