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
		<h2>This is top container</h2>
	</div>
	<div id="sideDiv">
		<h2>this is in sideDiv</h2>
	</div>
	<div id="topicsDiv">
		<input type="text" name="searchTopics">
		<?php 
		foreach ($topics as $topic) {
			echo "<div onclick=location.href='./study.php?topic_id=" . $topic['id'] . "&title=" .  urlencode($topic['name']) . "'>";
			echo "<h3>" . $topic['name'] . "</h3>";
			echo "</div>";
		}

		?>
	</div>
</body>
</html>