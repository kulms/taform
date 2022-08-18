<?php
	include 'includes/session.php';
	
    $dept_id = $_POST['dept_id'];
    $dept_name = $_POST['edit_dept_name'];    
    $dept_head = $_POST['edit_dept_head'];
    $dept_position = $_POST['edit_dept_position'];
    $dept_part = $_POST['edit_dept_part'];
    $dept_bookno = $_POST['edit_dept_bookno'];

	if(isset($_POST['edit'])){
		
		$userid = $_SESSION['member'];
		$sql = "UPDATE department 
                SET                     
                    dept_name = '$dept_name',
                    dept_head = '$dept_head',
                    dept_position = '$dept_position',
                    dept_part = '$dept_part',
                    dept_bookno = '$dept_bookno',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE dept_id = '$dept_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Department updated successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:approval_dept.php');

?>