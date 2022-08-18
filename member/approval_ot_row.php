<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * 
				FROM approval_emp_ot 
				LEFT JOIN employees ON employees.id=approval_emp_ot.emp_id
				WHERE approval_emp_ot.app_emp_ot_id = '$id'";
		$query = $conn->query($sql);

		//echo $sql;

		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>