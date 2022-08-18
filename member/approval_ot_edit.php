<?php
    include 'includes/session.php';
    
    $appeotid = $_POST['appeotid'];
	$app_emp_id = $_POST['appeid'];
    $app_id = $_POST['appid'];
    $emp_id = $_POST['empid'];
    $ot_date = $_POST['datepicker_edit'];
    $time_in = $_POST['edit_time_in'];
    $time_out = $_POST['edit_time_out'];
    $reponsibility = $_POST['edit_reponsibility'];
    $otrate_id = $_POST['edit_otrate_id'];

	if(isset($_POST['edit'])){

        $sql = "SELECT * 
				FROM approval_emp_ot 
				WHERE app_id = '$app_id' 
				AND emp_id = '$emp_id' 
				AND ot_date = '$ot_date'
				AND (time_in = '$time_in' AND time_out = '$time_out')
                AND otrate_id = '$otrate_id'
                ;";
                
        // echo $sql."<br>"; 

        $query = $conn->query($sql);

        // $row = $query->fetch_assoc();

        $sql2 = "SELECT app_emp_id
				FROM approval_emp 
				WHERE app_id = '$app_id' 
				AND emp_id = '$emp_id'				
                ;";

        $query2 = $conn->query($sql2);

        $row2 = $query2->fetch_assoc();

        $app_emp_id = $row2["app_emp_id"];

        // echo $app_emp_id;        
        
        //echo $query->num_rows;

		if($query->num_rows >= 1){
            $_SESSION['error'] = 'Approval Member Time Table already exists';
            //echo "Approval Member Time Table already exists";
		}
		else{
            $userid = $_SESSION['member'];
            

            $sql = "UPDATE approval_emp_ot 
                    SET                     
                        app_emp_id = '$app_emp_id',
                        emp_id = '$emp_id',
                        ot_date = '$ot_date',
                        time_in = '$time_in',
                        time_out = '$time_out',
                        reponsibility = '$reponsibility',
                        otrate_id = '$otrate_id',					
                        lupdate_by = '$userid',
                        lupdate_date = now()
                    WHERE app_emp_ot_id = '$appeotid'";

            if($conn->query($sql)){
                $_SESSION['success'] = 'Approval Member Time Table updated successfully';
            }else{
                $_SESSION['error'] = $conn->error;
            }
        }

	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: approval_ot.php?appeid='.$app_emp_id.'&appid='.$app_id.'&empid='.$emp_id);

?>