<?php
	include 'includes/session.php';
	
    $id= $_POST['id'];
    $employee_id = $_POST['edit_employee_id'];
    $titlename = $_POST['edit_titlename'];
    $firstname = $_POST['edit_firstname'];
    $lastname = $_POST['edit_lastname'];
    $gender = $_POST['edit_gender'];
    $dept_id = $_POST['edit_dept_id'];
    $position_id = $_POST['edit_position_id'];
    $bank_account = $_POST['edit_bank_account'];

	if(isset($_POST['edit'])){
		
		$userid = $_SESSION['member'];
		$sql = "UPDATE employees 
                SET                     
                    employee_id = '$employee_id',
                    titlename = '$titlename',
                    firstname = '$firstname',
                    lastname = '$lastname',
                    gender = '$gender',
                    dept_id = '$dept_id',
                    position_id = '$position_id',
                    bank_account = '$bank_account'                    
                WHERE id = '$id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Employee updated successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:approval_emp.php');

?>