<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * 
				FROM position 				
				WHERE position.id = '$id'";
		$query = $conn->query($sql);

		//echo $sql;

		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>