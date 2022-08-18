<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$app_id = $_POST['id'];
		$sql = "SELECT * FROM approval WHERE app_id = '$app_id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>