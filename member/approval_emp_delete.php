<?php
	include 'includes/session.php';

	$id = $_POST['del_id'];

	if(isset($_POST['delete'])){		
        // $sql = "DELETE FROM approval_group WHERE app_group_id = '$id'";
        $sql = "UPDATE employees 
                SET                     
                    active = 0
                WHERE id = '$id'";
        
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee inactived successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:approval_emp.php');
	
?>