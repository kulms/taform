<?php
	include 'includes/session.php';
	
    $id = $_POST['id'];
    $description = $_POST['edit_position_name'];    

	if(isset($_POST['edit'])){
		
		$userid = $_SESSION['member'];
		$sql = "UPDATE position 
                SET                     
                    description = '$description'
                WHERE id = '$id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Position updated successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:approval_position.php');

?>