<?php
	// $conn = new mysqli('localhost', 'root', '', 'apsystem');
	// $conn = new mysqli('localhost', 'root', '', 'apsystem_server');
	$conn = new mysqli('localhost', 'root', '', 'taform');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>