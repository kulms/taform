<?php
	include 'includes/session.php';
	
	$dept_id = $_POST['dept_id'];
	$emp_id = $_POST['emp_id'];	

	if(isset($_POST['add'])){
		$sql = "SELECT * FROM approval_group WHERE dept_id = '$dept_id' AND emp_id = '$emp_id';";
		$query = $conn->query($sql);

        //echo $sql; 

		if($query->num_rows > 1){
			$_SESSION['error'] = 'This employee already exists in this group.';
		}
		else{			
            $userid = $_SESSION['member'];
            $sql = "INSERT INTO approval_group
                    (dept_id, 
                    emp_id,                     
                    create_by, 
                    create_date, 
                    lupdate_by, 
                    lupdate_date) 
                    VALUES 
                    ('$dept_id', 
                    '$emp_id',                     
                    '$userid', 
                    now(), 
                    '$userid', 
                    now());";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Approval Member added successfully';
            }else{
                $_SESSION['error'] = $conn->error;
            }
        }
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: approval_group.php');

?>