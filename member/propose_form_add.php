<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		// $employee = $_POST['employee'];
		// $date = $_POST['date'];
		// $time_in = $_POST['time_in'];
		// $time_in = date('H:i:s', strtotime($time_in));
		// $time_out = $_POST['time_out'];
        // $time_out = date('H:i:s', strtotime($time_out));
        $fiscal_id = $_POST['fiscal_id'];
        $sem_id = $_POST['sem_id'];
        $app_times = $_POST['app_times'];
        $start_date = $_POST['datepicker_add'];
        $expire_date = $_POST['datepicker_add2'];
		$start_month = $_POST['start_month'];
		$end_month = $_POST['end_month'];
		


		$sql = "SELECT * FROM ta_dept";
		$query = $conn->query($sql);

		// if($query->num_rows < 1){
		// 	$_SESSION['error'] = 'Employee not found';
		// }
		// else{
		// 	$row = $query->fetch_assoc();
		// 	$emp = $row['id'];

		// 	$sql = "SELECT * FROM attendance WHERE employee_id = '$emp' AND date = '$date'";
		// 	$query = $conn->query($sql);

		// 	if($query->num_rows > 0){
		// 		$_SESSION['error'] = 'Employee attendance for the day exist';
		// 	}
		// 	else{
		// 		//updates
		// 		$sched = $row['schedule_id'];
		// 		$sql = "SELECT * FROM schedules WHERE id = '$sched'";
		// 		$squery = $conn->query($sql);
		// 		$scherow = $squery->fetch_assoc();
		// 		$logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
		// 		//
		// 		$sql = "INSERT INTO attendance (employee_id, date, time_in, time_out, status) VALUES ('$emp', '$date', '$time_in', '$time_out', '$logstatus')";
		// 		if($conn->query($sql)){
		// 			$_SESSION['success'] = 'Attendance added successfully';
		// 			$id = $conn->insert_id;

		// 			$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
		// 			$query = $conn->query($sql);
		// 			$srow = $query->fetch_assoc();

		// 			if($srow['time_in'] > $time_in){
		// 				$time_in = $srow['time_in'];
		// 			}

		// 			if($srow['time_out'] < $time_out){
		// 				$time_out = $srow['time_out'];
		// 			}

		// 			$time_in = new DateTime($time_in);
		// 			$time_out = new DateTime($time_out);
		// 			$interval = $time_in->diff($time_out);
		// 			$hrs = $interval->format('%h');
		// 			$mins = $interval->format('%i');
		// 			$mins = $mins/60;
		// 			$int = $hrs + $mins;
		// 			if($int > 4){
		// 				$int = $int - 1;
		// 			}

		// 			$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '$id'";
		// 			$conn->query($sql);

		// 		}
		// 		else{
		// 			$_SESSION['error'] = $conn->error;
		// 		}
		// 	}
        // }
		
		// $sql = "SELECT * FROM approval WHERE year_id = '$year_id' AND dept_id = '$dept_id' AND app_type_id = '$app_type_id' AND app_month = '$app_month';";
        // $query = $conn->query($sql);

        // if($query->num_rows > 0){
        //     $_SESSION['error'] = 'Approval form for the month exist';
        // }else{

		$userid = $_SESSION['member'];
        while($row = $query->fetch_assoc()){
			$sql = "INSERT INTO approval 
					(fiscal_id, 
					sem_id, 
					dept_id, 
					app_times, 
					start_date, 
					expire_date,
					start_month,
					end_month,					
					create_by, 
					create_date, 
					lupdate_by, 
					lupdate_date) 
					VALUES 
					('$fiscal_id', 
					'$sem_id', 
					'".$row["dept_id"]."', 
					'$app_times', 
					'$start_date', 
					'$expire_date',
					'$start_month',
					'$end_month',
					'$userid', 
					now(), 
					'$userid', 
					now());";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Propose form added successfully';
			}else{
				$_SESSION['error'] = $conn->error;
			}
        }
        $query->free_result();
        
	}else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: propose_form.php');

?>