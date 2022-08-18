<?php
	include 'includes/session.php';
	
	$dept_name = $_POST['dept_name'];
    $dept_head = $_POST['dept_head'];
    $dept_position = $_POST['dept_position'];
    $dept_part = $_POST['dept_part'];
    $dept_bookno = $_POST['dept_bookno'];
    	

	if(isset($_POST['add'])){
		$sql = "SELECT * FROM department WHERE dept_name LIKE '$dept_name';";
		$query = $conn->query($sql);

        //echo $sql; 

		if($query->num_rows > 1){
			$_SESSION['error'] = 'This department already exists in this system.';
		}
		else{			
            $userid = $_SESSION['member'];
            $sql = "INSERT INTO department
                    (dept_name, 
                    dept_head,  
                    dept_position,
                    dept_part,
                    dept_bookno,
                    create_by, 
                    create_date, 
                    lupdate_by, 
                    lupdate_date) 
                    VALUES 
                    ('$dept_name', 
                    '$dept_head',
                    '$dept_position',
                    '$dept_part',
                    '$dept_bookno',  
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
	
	header('location: approval_dept.php');

?>