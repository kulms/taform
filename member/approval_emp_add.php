<?php
	include 'includes/session.php';
	
	$employee_id = $_POST['employee_id'];
    $titlename = $_POST['titlename'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dept_id = $_POST['dept_id'];
    $position_id = $_POST['position_id'];
    $bank_account = $_POST['bank_account'];
    $address = "Faculty of Engineering, Kasetsart University";
    $birthdate = date("Y-m-d");
    $contact_info = "02-797-0999";
    $schedule_id = "5";
    $photo = "profile.jpg";
    $active = 1;
    $created_on = date("Y-m-d");

	if(isset($_POST['add'])){
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee_id';";
		$query = $conn->query($sql);

        //echo $sql; 

		if($query->num_rows > 1){
			$_SESSION['error'] = 'This employee already exists in system.';
		}
		else{			
            $userid = $_SESSION['member'];
            $sql = "INSERT INTO employees
                    (employee_id,
                    dept_id, 
                    titlename,                     
                    firstname, 
                    lastname, 
                    address, 
                    birthdate,
                    contact_info,
                    gender,
                    position_id,
                    schedule_id,
                    photo,
                    bank_account,
                    active,
                    created_on) 
                    VALUES 
                    ('$employee_id', 
                    '$dept_id', 
                    '$titlename',                     
                    '$firstname',
                    '$lastname',
                    '$address',
                    '$birthdate',
                    '$contact_info',
                    '$gender',
                    '$position_id',
                    '$schedule_id',
                    '$photo',
                    '$bank_account',
                    '$active',
                    '$created_on');";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Employee added successfully';
            }else{
                $_SESSION['error'] = $conn->error;
            }
        }
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: approval_emp.php');

?>