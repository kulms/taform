<?php
	include 'includes/session.php';

	$id = $_POST['del_app_eid'];
	$app_id = $_POST['app_id'];
	$emp_id = $_POST['del_emp_id'];
	
	if(isset($_POST['delete'])){		
		// $sqlemp = "SELECT emp_id FROM approval_emp WHERE app_emp_id = '$id'";
		// $qemp = $conn->query($sqlemp);
		// $row = $qemp->fetch_assoc();
		// $emp_id = $row["emp_id"];

		$del_empot = "DELETE FROM approval_emp_ot WHERE app_id = '$app_id' AND emp_id = '$emp_id'";
		// echo $del_empot."<br>";
		if($conn->query($del_empot)){
			$_SESSION['success'] = 'Approval Member deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

		$sql = "DELETE FROM approval_emp WHERE app_emp_id = '$id'";
		// echo $sql; 
		if($conn->query($sql)){
			$_SESSION['success'] = 'Approval Member deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:approval.php?appid='.$app_id);
	
?>