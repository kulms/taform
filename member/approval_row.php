<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * 
				FROM approval_emp 
				LEFT JOIN employees ON employees.id=approval_emp.emp_id
				WHERE approval_emp.app_emp_id = '$id'";
		$query = $conn->query($sql);

		//echo $sql;

		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>