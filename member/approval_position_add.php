<?php
	include 'includes/session.php';
	
	$description = $_POST['description'];    	

	if(isset($_POST['add'])){
		$sql = "SELECT * FROM position WHERE description = '$description';";
		$query = $conn->query($sql);

        //echo $sql; 

		if($query->num_rows > 1){
			$_SESSION['error'] = 'This position already exists in this system.';
		}
		else{			
            $userid = $_SESSION['member'];
            // $sql = "INSERT INTO position
            //         (description, 
            //         create_by, 
            //         create_date, 
            //         lupdate_by, 
            //         lupdate_date) 
            //         VALUES 
            //         ('$description', 
            //         '$userid', 
            //         now(), 
            //         '$userid', 
            //         now());";
            $sql = "INSERT INTO position
                    (description, 
                    rate) 
                    VALUES 
                    ('$description', 
                    '100' 
                    );";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Position added successfully';
            }else{
                $_SESSION['error'] = $conn->error;
            }
        }
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: approval_position.php');

?>