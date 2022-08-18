<?php
	include 'includes/session.php';

	$appeotid = $_POST['del_appeotid'];
	$app_emp_id = $_POST['appeid'];
    $app_id = $_POST['appid'];
    $emp_id = $_POST['empid'];
    

	if(isset($_POST['delete'])){		
		$sql = "DELETE FROM approval_emp_ot WHERE app_emp_ot_id = '$appeotid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Approval Member Time Table deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: approval_ot.php?appeid='.$app_emp_id.'&appid='.$app_id.'&empid='.$emp_id);
	
?>