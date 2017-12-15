<?php

require './core/init.php';

$id = 1;

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
</head>
<body>
	<div id="topContainer">
		<div id="colorBar"></div>
		<h2 id="title">Flash Cards</h2>
		<a href="./study.php" id="newTopic">+ Create New</a>
	</div>
	<input type="text" name="searchBar" id="searchBarInput" placeholder="Search Topics">
	<div id="topicsDiv">
		<?php 
		echo "<div class='containers'>";
		$counter = 0;
		foreach ($topics as $topic) {
			if ($counter < 3) {
				echo "<div class='topics' onclick=location.href='./study.php?topic_id=" . $topic['id'] . "&title=" .  urlencode($topic['name']) . "'>";
				echo "<div class='color" . $counter . "'></div>";
				echo "<h3>" . $topic['name'] . "</h3>";
				echo "</div>";
				$counter++;
			} else {
				echo "</div>";
				echo "<div class='containers'>";
				echo "<div class='topics' onclick=location.href='./study.php?topic_id=" . $topic['id'] . "&title=" .  urlencode($topic['name']) . "'>";
				echo "<div class='color0'></div>";
				echo "<h3>" . $topic['name'] . "</h3>";
				echo "</div>";
				$counter = 1;

			}
		}
		if ($counter != 0) {
			echo "</div>";
		}

		?>
	</div>
</body>
</html>