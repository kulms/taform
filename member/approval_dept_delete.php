<?php
	include 'includes/session.php';

	$dept_id = $_POST['del_dept_id'];

	if(isset($_POST['delete'])){		
		$sql = "DELETE FROM department WHERE dept_id = '$dept_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Department deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:approval_dept.php');
	
?>