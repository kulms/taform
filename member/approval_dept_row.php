<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * 
				FROM department 				
				WHERE department.dept_id = '$id'";
		$query = $conn->query($sql);

		//echo $sql;

		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>