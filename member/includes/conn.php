<?php
	$conn = new mysqli('localhost', 'root', '', 'taform');
	// $conn = new mysqli('localhost', 'oteng', 'p@ssword1234', 'oteng');

	$cs1 = "SET character_set_results=utf8";
	$query = $conn->query($cs1);

	$cs2 = "SET character_set_client = utf8";
	$query = $conn->query($cs2);

	$cs3 = "SET character_set_connection = utf8";
	$query = $conn->query($cs3);

	$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>