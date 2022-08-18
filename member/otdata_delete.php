<?php
	include 'includes/session.php';

	$id = $_POST['del_otdata_id'];
	
	if(isset($_POST['delete'])){		
		$sql = "DELETE FROM otdata WHERE otdata_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'OT data deleted successfully<br>';
		}
		else{
			$_SESSION['error'] = $conn->error;
        }

        $sql = "DELETE FROM otdata_time WHERE otdata_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] .= 'OT data time deleted successfully<br>';
		}
		else{
			$_SESSION['error'] .= $conn->error;
        }
        
        $sql = "DELETE FROM otdata_time_cal WHERE otdata_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] .= 'OT data time calculate deleted successfully';
		}
		else{
			$_SESSION['error'] .= $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:otdata.php');
	
?>