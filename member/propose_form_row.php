<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$app_id = $_POST['id'];
		$sql = "SELECT approval.*, ta_dept.dept_name FROM approval, ta_dept WHERE approval.app_id = '$app_id' AND approval.dept_id = ta_dept.dept_id";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>