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
</head>
<body>
	<h2>Your topics</h2>
	<div>
		<?php 
		foreach ($topics as $topic) {
			echo "<div>";
			echo "Topic name: " . $topic['name'];
			echo "<button>View topic</button>";
			echo "</div>";
		}

		?>
	</div>
</body>
</html>