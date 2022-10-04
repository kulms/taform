<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$app_id = $_POST['app_id'];
        $app_std_id = $_POST['del_app_std_id'];

		// $sqlempot = "DELETE FROM approval_emp_ot WHERE app_id = '$app_id'";
		// if($conn->query($sqlempot)){
		// 	$_SESSION['success'] = 'Approval form deleted successfully';
		// }
		// else{
		// 	$_SESSION['error'] = $conn->error;
		// }

		// $sqlemp = "DELETE FROM approval_emp WHERE app_id = '$app_id'";
		// if($conn->query($sqlemp)){
		// 	$_SESSION['success'] = 'Approval form deleted successfully';
		// }
		// else{
		// 	$_SESSION['error'] = $conn->error;
		// }

		$sql = "DELETE FROM approval_std WHERE app_std_id = '$app_std_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Approval std deleted successfully';
            $sql = "DELETE FROM approval_std_rec WHERE app_std_id = '$app_std_id'";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Approval std rec deleted successfully';
            }else{
                $_SESSION['error'] = $conn->error;    
            }
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: propose.php?appid='.$app_id);
	
?>