<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$order_id = $_POST['id'];
		$sql = "SELECT * FROM order_form WHERE order_id = '$order_id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>