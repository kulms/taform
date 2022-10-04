<?php
	include 'includes/session.php';

	// if(isset($_POST['edit'])){
	// 	$id = $_POST['id'];
	// 	$date = $_POST['edit_date'];
	// 	$time_in = $_POST['edit_time_in'];
	// 	$time_in = date('H:i:s', strtotime($time_in));
	// 	$time_out = $_POST['edit_time_out'];
	// 	$time_out = date('H:i:s', strtotime($time_out));

	// 	$sql = "UPDATE attendance SET date = '$date', time_in = '$time_in', time_out = '$time_out' WHERE id = '$id'";
	// 	if($conn->query($sql)){
	// 		$_SESSION['success'] = 'Attendance updated successfully';

	// 		$sql = "SELECT * FROM attendance WHERE id = '$id'";
	// 		$query = $conn->query($sql);
	// 		$row = $query->fetch_assoc();
	// 		$emp = $row['employee_id'];

	// 		$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
	// 		$query = $conn->query($sql);
	// 		$srow = $query->fetch_assoc();

	// 		//updates
	// 		$logstatus = ($time_in > $srow['time_in']) ? 0 : 1;
	// 		//

	// 		if($srow['time_in'] > $time_in){
	// 			$time_in = $srow['time_in'];
	// 		}

	// 		if($srow['time_out'] < $time_out){
	// 			$time_out = $srow['time_out'];
	// 		}

	// 		$time_in = new DateTime($time_in);
	// 		$time_out = new DateTime($time_out);
	// 		$interval = $time_in->diff($time_out);
	// 		$hrs = $interval->format('%h');
	// 		$mins = $interval->format('%i');
	// 		$mins = $mins/60;
	// 		$int = $hrs + $mins;
	// 		if($int > 4){
	// 			$int = $int - 1;
	// 		}

	// 		$sql = "UPDATE attendance SET num_hr = '$int', status = '$logstatus' WHERE id = '$id'";
	// 		$conn->query($sql);
	// 	}
	// 	else{
	// 		$_SESSION['error'] = $conn->error;
	// 	}
	// }
	// else{
	// 	$_SESSION['error'] = 'Fill up edit form first';
    // }
    
    if(isset($_POST['edit'])){
        $app_id = $_POST['app_id'];
        $fiscal_id = $_POST['edit_fiscal_id'];
        $sem_id = $_POST['edit_sem_id'];
        $app_times = $_POST['edit_app_times'];
        $start_date = $_POST['datepicker_edit'];
        $expire_date = $_POST['datepicker_edit2'];
		$start_month = $_POST['edit_start_month'];
		$end_month = $_POST['edit_end_month'];
		$userid = $_SESSION['member'];

        $sql = "UPDATE approval 
                SET 
                    fiscal_id = '$fiscal_id', 
                    sem_id = '$sem_id', 
                    app_times = '$app_times',
                    start_date = '$start_date',
                    expire_date = '$expire_date',
					start_month = '$start_month',
					end_month = '$end_month',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_id = '$app_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Propose form updated successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
    }
	else{
		$_SESSION['error'] = 'Fill up edit form first';
    }    

	header('location: propose_form.php?fid='.$fiscal_id.'&sid='.$sem_id);

?>