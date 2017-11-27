<?php
// Report all PHP errors (see changelog)
error_reporting(E_ALL);

// Report all PHP errors
error_reporting(-1);

session_start();

//temporary, while on localhost
$url = 'localhost/flashcards';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashcards";

$mysqli = new mysqli($servername, $username, $password, $dbname);