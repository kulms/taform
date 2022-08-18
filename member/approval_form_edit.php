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
        $year_id = $_POST['edit_year_id'];
        $app_month = $_POST['edit_app_month'];
        $dept_id = $_POST['edit_dept_id'];
        $app_name = $_POST['edit_app_name'];
        $app_type_id = $_POST['edit_app_type_id'];
		$userid = $_SESSION['member'];
		$app_detail = $_POST['edit_app_detail'];
		$app_doc_no = $_POST['edit_app_doc_no'];
		$app_date = $_POST['datepicker_edit'];
		$app_head = $_POST['edit_app_head'];
		$app_head_position = $_POST['edit_app_head_position'];
		$budget = $_POST['edit_budget'];

        $sql = "UPDATE approval 
                SET 
                    year_id = '$year_id', 
                    app_month = '$app_month', 
                    dept_id = '$dept_id',
                    app_name = '$app_name',
                    app_type_id = '$app_type_id',
					app_detail = '$app_detail',
					app_doc_no = '$app_doc_no',
					app_date = '$app_date',
					app_head = '$app_head',
					app_head_position = '$app_head_position',
					budget = '$budget',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_id = '$app_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Approval form updated successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
    }
	else{
		$_SESSION['error'] = 'Fill up edit form first';
    }    

	header('location: approval_form.php');

?>