<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$app_std_id = $_POST['id'];
		$sql = "SELECT * FROM approval_std WHERE app_std_id = '$app_std_id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>