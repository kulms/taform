<?php
	include 'includes/session.php';

	$id = $_POST['del_id'];

	if(isset($_POST['delete'])){		
		$sql = "DELETE FROM position WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location:approval_position.php');
	
?>