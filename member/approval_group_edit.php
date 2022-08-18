<?php
	include 'includes/session.php';
	
    $appg_id= $_POST['appg_id'];
    $dept_id = $_POST['edit_dept_id'];
	$emp_id = $_POST['edit_emp_id'];

	if(isset($_POST['edit'])){
		
		$userid = $_SESSION['member'];
		$sql = "UPDATE approval_group 
                SET                     
                    dept_id = '$dept_id',
                    emp_id = '$emp_id',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_group_id = '$appg_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Approval Member updated successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:approval_group.php');

?>