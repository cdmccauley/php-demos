<?php # mysqli_oop_connect.php

// Set the database access information as constants:
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'gitgudgames');

// Make the connection:
$mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verify the connection:
if ($mysqli->connect_error) {
	echo $mysqli->connect_error;
	unset($mysqli);
} else { // Establish the encoding.
	$mysqli->set_charset('utf8');
}