<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * 
				FROM approval_group 				
				WHERE approval_group.app_group_id = '$id'";
		$query = $conn->query($sql);

		//echo $sql;

		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>