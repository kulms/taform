<?php
	include 'includes/session.php';
	
	function checkUnixTime($to, $from, $input) {
		if (strtotime($input) >= strtotime($from) && strtotime($input) <= strtotime($to)) {
			return 1;
		}else{
			return 0;
		}
	}

    $app_emp_id = $_POST['appeid'];
    $app_id = $_POST['appid'];
	// $emp_id = $_POST['empid'];
	$emp_id = $_POST['empid2'];
	$ot_date = $_POST['datepicker_add'];
	// echo $ot_date;
	$arr_ot_date=explode(",", $ot_date);
	// echo count($arr_ot_date)."<br>";

    $time_in = $_POST['time_in'];
	$time_out = $_POST['time_out'];
	$reponsibility = $_POST['reponsibility'];
	$otrate_id = $_POST['otrate_id'];

    $noon = strtotime("12:00");
    $onepm = strtotime("13:00");

    $time_out2 = strtotime($time_out);
    $time_in2 = strtotime($time_in);
    $diff_time = round(abs($time_out2 - $time_in2) / 60,2);

    $hours = floor($diff_time / 60);

    if(($noon > $time_in) && ($noon < $time_out)) {$check1 = 1;}else{$check1 = 0;}
    if(($onepm > $time_in) && ($onepm < $time_out)) {$check2 = 1;}else{$check2 = 0;}

    if(($check1)&&($check2)) $hours=$hours-1;

	for ($i=0;$i<count($arr_ot_date);$i++) {
		// echo $arr_ot_date[$i]."<br>";
		if(isset($_POST['add'])){
			// $sql = "SELECT * 
			// 		FROM approval_emp_ot 
			// 		WHERE app_id = '$app_id' 
			// 		AND emp_id = '$emp_id' 
			// 		AND ot_date = '$arr_ot_date[$i]'
			// 		AND (time_in = '$time_in' OR time_out = '$time_out') 
			// 		AND otrate_id = '$otrate_id'
			// 		;";

			$sql = "SELECT ae.*, a.dept_id, d.dept_name 
					FROM approval_emp_ot ae, approval a, department d 
					WHERE  ae.emp_id = '$emp_id' 
					AND ae.ot_date = '$arr_ot_date[$i]'
					AND ae.app_id = a.app_id
					AND a.dept_id = d.dept_id
					;";

			// echo $sql."<br>"; 		

			$query = $conn->query($sql);
			
			$error = 0;

			while($row = $query->fetch_assoc()){
				$dept_name = $row['dept_name'];				
				$chk_time_in = $row['time_in'];				
				$chk_time_out = $row['time_out'];

				// echo "From input ".$time_in." - ".$time_out."<br>";
				// echo "Check from db".$chk_time_in." - ".$chk_time_out."<br>";
				
				$checkin = checkUnixTime($chk_time_out, $chk_time_in, $time_in);
				// echo checkUnixTime($chk_time_out, $chk_time_in, $time_in)."<br>";
				if($checkin==1){
					// $error = $arr_ot_date[$i]." time ".$time_in." was duplicated with ".$dept_name;
					$_SESSION['warning'] = 'ไม่สามารถบันทึกข้อมูลวันที่ '.$arr_ot_date[$i].' เวลา '.$time_in.' ได้ <br>';
					$_SESSION['warning'] .= 'เนื่องจากเจ้าหน้าที่ได้ขออนุมัติหลักการในวันดังกล่าวไปแล้วกับหน่วยงาน '.$dept_name;					
					// echo $error;
					// echo $_SESSION['warning'];
					// unset($_SESSION['warning']);
					// exit;
					// header('location: approval_ot.php?appeid='.$app_emp_id.'&appid='.$app_id.'&empid='.$emp_id);
					$error = 1;
				}
				$checkout = checkUnixTime($chk_time_out, $chk_time_in, $time_out);
				// echo checkUnixTime($chk_time_out, $chk_time_in, $time_out)."<br>";
				if($checkout==1){
					// $error = $arr_ot_date[$i]." time ".$time_out." was duplicated with ".$dept_name;		
					$_SESSION['warning'] = 'ไม่สามารถบันทึกข้อมูลวันที่ '.$arr_ot_date[$i].' เวลา '.$time_out.' ได้ <br>';
					$_SESSION['warning'] .= 'เนื่องจากเจ้าหน้าที่ได้ขออนุมัติหลักการในวันดังกล่าวไปแล้วกับหน่วยงาน '.$dept_name;
					// echo $error;
					// echo $_SESSION['warning'];
					// unset($_SESSION['warning']);
					// exit;
					// header('location: approval_ot.php?appeid='.$app_emp_id.'&appid='.$app_id.'&empid='.$emp_id);
					$error = 1;
				}
			}
			// echo $query->num_rows;


			// echo checkUnixTime('13:00:00', '09:00:00', $time_in);

			if($error == 1){
				// $_SESSION['error'] = 'Approval Member Time Table already exists';
				header('location: approval_ot.php?appeid='.$app_emp_id.'&appid='.$app_id.'&empid='.$emp_id);
			}else{
				$userid = $_SESSION['member'];
				$sql = "INSERT INTO approval_emp_ot 
						(app_emp_id,
						app_id, 
						emp_id,
						ot_date,
						time_in,
						status,
						time_out,
						num_hr, 
						reponsibility,
						otrate_id,				
						create_by, 
						create_date, 
						lupdate_by, 
						lupdate_date) 
						VALUES 
						('$app_emp_id',
						'$app_id', 
						'$emp_id', 
						'$arr_ot_date[$i]', 
						'$time_in',
						'0',
						'$time_out',
						'$hours',
						'$reponsibility',	
						'$otrate_id',			
						'$userid', 
						now(), 
						'$userid', 
						now());";
				if($conn->query($sql)){
					$_SESSION['success'] = 'Approval Member Time Table added successfully';
				}else{
					$_SESSION['error'] = $conn->error;
				}
			}
		}
		else{
			$_SESSION['error'] = 'Fill up add form first';
		} // end if post add
	} // end for
	
	
	header('location: approval_ot.php?appeid='.$app_emp_id.'&appid='.$app_id.'&empid='.$emp_id);

?>