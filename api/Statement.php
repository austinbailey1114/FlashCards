<?php

class Statement {
	/*
	* select data from any table using only its id
	*/
	function getData($mysqli, $sql, $id) {
		//create and execute statement
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();

		//build array with generic data
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		//return the array
		return $data;
	}
	/*
	* delete a row in any table using its id
	*/
	function deleteData($mysqli, $sql, $id) {
		//create and execute statement
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i', $id);
		$result = $stmt->execute();
		//return true if the statement was successful
		return $result;
	}
}