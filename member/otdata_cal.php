<?php
    include 'includes/session.php';
    
    // $employee = $_POST['employee'];
    // $date = $_POST['date'];
    // $time_in = $_POST['time_in'];
    // $time_in = date('H:i:s', strtotime($time_in));
    // $time_out = $_POST['time_out'];
    // $time_out = date('H:i:s', strtotime($time_out));
    
    $otdata_id = $_GET['otdataid'];
    $sql = "SELECT dept_id,emp_id,ot_date,ot1_in,ot1_out,ot2_in,ot2_out FROM otdata_time WHERE otdata_id = '$otdata_id';";
    //echo $sql."<br>"; 
    $query = $conn->query($sql);
    // $i=1;
    while($row = $query->fetch_assoc()){

        $sqlchk = "SELECT a.time_in,a.time_out,a.otrate_id,a.app_id, ap.dept_id, a.app_emp_ot_id 
                FROM approval_emp_ot a, approval_emp ae, approval ap                 
                WHERE a.emp_id = '".$row["emp_id"]."'
                AND a.ot_date = '".$row["ot_date"]."'                
                AND a.app_emp_id = ae.app_emp_id
                AND a.app_id = ae.app_id
                AND a.app_id = ap.app_id
                AND ae.app_id = ap.app_id
                ;";        
        // echo $sqlchk."<br>";
        $querychk = $conn->query($sqlchk);

        $rowcount = $querychk->num_rows;
        

        if($rowcount==1){
            
            $rowchk = $querychk->fetch_assoc();
            
            $sql2 = "SELECT a.time_in,a.time_out,a.otrate_id,a.app_id 
                    FROM approval_emp_ot a, approval_emp ae, approval ap                 
                    WHERE a.emp_id = '".$row["emp_id"]."'
                    AND a.ot_date = '".$row["ot_date"]."'                    
                    AND a.app_emp_id = ae.app_emp_id
                    AND a.app_id = ae.app_id
                    AND a.app_id = ap.app_id
                    AND ae.app_id = ap.app_id
                    ;";        
            // echo $sql2."<br>";
            $query2 = $conn->query($sql2);

            //=====================================================================
            $row_cnt = $query2->num_rows;
            if($row_cnt>1){
                
                $row2 = $query2->fetch_assoc();
                $otrate_id = $row2["otrate_id"];
                $app_id = $row2["app_id"];

                $query2->data_seek(0);

                while($row3 = $query2->fetch_assoc())
                {
                    $time_ins[] = $row3["time_in"];
                    $time_outs[] = $row3["time_out"];
                    
                }
                $crows3 = count($time_ins);
                $time_in = $time_ins[0];
                $time_out = $time_outs[$crows3-1];

                unset($time_ins);
                unset($time_outs);
                
            }else{
                $row2 = $query2->fetch_assoc();
                $time_in = $row2["time_in"];
                $time_out = $row2["time_out"];
                $otrate_id = $row2["otrate_id"];
                $app_id = $row2["app_id"];
            }

            // echo $time_in ." ".$time_out."<br>";
            
            if($time_in!="" && $time_out!=""){
                $userid = $_SESSION['member'];
                $sql3 = "INSERT INTO otdata_time_cal 
                        (otdata_id,
                        dept_id,
                        app_id, 
                        emp_id, 
                        otrate_id, 
                        ot_date, 
                        ot1_in, 
                        ot1_form_in,
                        ot1_out,
                        ot1_form_out,
                        ot2_in,
                        ot2_form_in,
                        ot2_out,
                        ot2_form_out,
                        num_hr,
                        num_min,
                        ot_amount,
                        create_by, 
                        create_date, 
                        lupdate_by, 
                        lupdate_date) 
                        VALUES 
                        ('$otdata_id',
                        '".$rowchk["dept_id"]."', 
                        '".$app_id."',
                        '".$row["emp_id"]."', 
                        '$otrate_id', 
                        '".$row["ot_date"]."', 
                        '".$row["ot1_in"]."', 
                        '$time_in',
                        '".$row["ot1_out"]."',
                        '$time_out',
                        '".$row["ot2_in"]."',
                        '$time_in',
                        '".$row["ot2_out"]."',
                        '$time_out',
                        '0',
                        '0',
                        '0',
                        '$userid', 
                        now(), 
                        '$userid', 
                        now());";
                
                // echo $sql3."<br>";

                if($conn->query($sql3)){
                    $_SESSION['success'] = 'OT Data Calculated successfully';
                }else{
                    $_SESSION['error'] = $conn->error;
                }

                $newid = $conn->insert_id;

                $sql4 = "SELECT * FROM otdata_time_cal WHERE otdata_time_cal_id = '$newid';";
                //echo $sql4."<br>"; 
                $query4 = $conn->query($sql4);
                $row4 = $query4->fetch_assoc();

                $otrate_id = $row4["otrate_id"];
                
                $a = $row4["ot1_in"];
                $aTime = strtotime($a);
                $b = $row4["ot1_form_in"];
                $bTime = strtotime($b);
                $c = $row4["ot1_out"];
                $cTime = strtotime($c);
                $d = $row4["ot1_form_out"];
                $dTime = strtotime($d);

                $f = $row4["ot2_in"];
                $fTime = strtotime($f);
                $g = $row4["ot2_form_in"];
                $gTime = strtotime($g);
                $h = $row4["ot2_out"];
                $hTime = strtotime($h);
                $i = $row4["ot2_form_out"];
                $iTime = strtotime($i);

                // echo $a." ".$b." ".$c." ".$d." ".$f." ".$g." ".$h." ".$i."<br>";

                if($aTime<=$bTime){
                    $starttime1 = $bTime; 
                }else{
                    $starttime1 = $aTime;
                }
                if($cTime>=$dTime){
                    $endtime1 = $dTime; 
                }else{
                    $endtime1 = $cTime;
                }

                $diff1=0;
                $diff2=0;

                $hr1=0;
                $min1=0;
                $hr2=0;
                $min2=0;

                $sumHr=0;
                $sumMin=0;

                // echo date("H:i:s",$endtime1)."-".date("H:i:s",$starttime1)."<br>";

                $diff1 = $endtime1-$starttime1;
                if($diff1>0){
                    // echo round(abs($endtime1 - $starttime1) / 60 / 60,0). " hour <br>";
                    // $hr1 = floor(round(abs($endtime1 - $starttime1) / 60,2)/60). " hour <br>";
                    // $min1 = (round(abs($endtime1 - $starttime1) / 60,2) % 60). " minute <br>";
                    $hr1 = floor(round(abs($endtime1 - $starttime1) / 60,2)/60);
                    $min1 = (round(abs($endtime1 - $starttime1) / 60,2) % 60);
                }


                if($fTime<=$gTime){
                    $starttime2 = $gTime; 
                }else{
                    $starttime2 = $fTime;
                }
                if($hTime>=$iTime){
                    $endtime2 = $iTime; 
                }else{
                    $endtime2 = $hTime;
                }
                
                // echo date("H:i:s",$endtime2)."-".date("H:i:s",$starttime2)."<br>";

                $diff2 = $endtime2-$starttime2;
                if($diff2>0){
                    // echo round(abs($endtime2 - $starttime2) / 60 / 60,0). " hour <br>";
                    // $hr2 = floor(round(abs($endtime2 - $starttime2) / 60,2)/60). " hour <br>";
                    // $min2 = (round(abs($endtime2 - $starttime2) / 60,2) % 60). " minute <br>";
                    $hr2 = floor(round(abs($endtime2 - $starttime2) / 60,2)/60);
                    $min2 = (round(abs($endtime2 - $starttime2) / 60,2) % 60);
                }

                $sumHr = $hr1+$hr2;
                $sumMin = $min1+$min2;

                if($sumMin>=60){
                    $sumMin = $sumMin-60;
                    $sumHr = $sumHr+1;    
                }

                // echo "sumHr: ".$sumHr." sumMin: ".$sumMin."<br>";

                $sql5 = "UPDATE otdata_time_cal 
                        SET num_hr = '".$sumHr."',
                        num_min = '".$sumMin."'
                        WHERE otdata_time_cal_id = '$newid';";
                //echo $sql5."<br>"; 
                $query5 = $conn->query($sql5);

                $sql6 = "SELECT cal_half, cal_quarter FROM otrate WHERE otrate_id = '$otrate_id';";
                // echo $sql6."<br>"; 

                $query6 = $conn->query($sql6);
                $row6 = $query6->fetch_assoc();

                $cal_half = $row6["cal_half"];
                $cal_quarter = $row6["cal_quarter"];

                $totalMin = 0;

                $totalMin=$sumHr*60;

                if($cal_half==1){                
                    if($sumMin>=30){
                        $totalMin=$totalMin+30;
                    }
                }

                if($cal_quarter==1){
                    if($sumMin>=15){
                        $totalMin=$totalMin+15;
                    }
                }

                // echo $totalMin."<br>";

                $sql7 = "SELECT no_min,no_rate FROM otrate_table WHERE otrate_id = '$otrate_id' ORDER BY no_min;";
                // echo $sql7."<br>"; 
                
                $query7 = $conn->query($sql7);

                $ot_amount=0;

                while($row7 = $query7->fetch_assoc()){
                    // if($totalMin==$row7["no_min"]){
                    if($totalMin>=$row7["no_min"]){
                        $ot_amount=$row7["no_rate"];
                    }
                    // echo $ot_amount."<br>";    
                }
                
                // echo $ot_amount."<br>";

                $sql8 = "UPDATE otdata_time_cal 
                        SET ot_amount = '".$ot_amount."'
                        WHERE otdata_time_cal_id = '$newid';";
                // echo $sql8."<br>"; 
                $query8 = $conn->query($sql8);

            } 
            //=====================================================================

            
        }else{
            while($rowchk = $querychk->fetch_assoc()){
                
                $sql2 = "SELECT a.time_in,a.time_out,a.otrate_id,a.app_id 
                        FROM approval_emp_ot a, approval_emp ae, approval ap                 
                        WHERE a.emp_id = '".$row["emp_id"]."'
                        AND a.ot_date = '".$row["ot_date"]."'
                        AND ap.dept_id = '".$rowchk["dept_id"]."'
                        AND a.app_emp_ot_id = '".$rowchk["app_emp_ot_id"]."'
                        AND a.app_emp_id = ae.app_emp_id
                        AND a.app_id = ae.app_id
                        AND a.app_id = ap.app_id
                        AND ae.app_id = ap.app_id
                        ;";   
                //  echo $sql2."<br>";
                 $query2 = $conn->query($sql2);

                //=====================================================================
                $row_cnt = $query2->num_rows;
                if($row_cnt>1){
                    
                    $row2 = $query2->fetch_assoc();
                    $otrate_id = $row2["otrate_id"];
                    $app_id = $row2["app_id"];

                    $query2->data_seek(0);

                    while($row3 = $query2->fetch_assoc())
                    {
                        $time_ins[] = $row3["time_in"];
                        $time_outs[] = $row3["time_out"];
                        
                    }
                    $crows3 = count($time_ins);
                    $time_in = $time_ins[0];
                    $time_out = $time_outs[$crows3-1];

                    unset($time_ins);
                    unset($time_outs);
                    
                }else{
                    $row2 = $query2->fetch_assoc();
                    $time_in = $row2["time_in"];
                    $time_out = $row2["time_out"];
                    $otrate_id = $row2["otrate_id"];
                    $app_id = $row2["app_id"];
                }

                // echo $time_in ." ".$time_out."<br>";
                
                if($time_in!="" && $time_out!=""){
                    $userid = $_SESSION['member'];
                    $sql3 = "INSERT INTO otdata_time_cal 
                            (otdata_id,
                            dept_id,
                            app_id, 
                            emp_id, 
                            otrate_id, 
                            ot_date, 
                            ot1_in, 
                            ot1_form_in,
                            ot1_out,
                            ot1_form_out,
                            ot2_in,
                            ot2_form_in,
                            ot2_out,
                            ot2_form_out,
                            num_hr,
                            num_min,
                            ot_amount,
                            create_by, 
                            create_date, 
                            lupdate_by, 
                            lupdate_date) 
                            VALUES 
                            ('$otdata_id',
                            '".$rowchk["dept_id"]."', 
                            '".$app_id."',
                            '".$row["emp_id"]."', 
                            '$otrate_id', 
                            '".$row["ot_date"]."', 
                            '".$row["ot1_in"]."', 
                            '$time_in',
                            '".$row["ot1_out"]."',
                            '$time_out',
                            '".$row["ot2_in"]."',
                            '$time_in',
                            '".$row["ot2_out"]."',
                            '$time_out',
                            '0',
                            '0',
                            '0',
                            '$userid', 
                            now(), 
                            '$userid', 
                            now());";
                    
                    // echo $sql3."<br>";

                    if($conn->query($sql3)){
                        $_SESSION['success'] = 'OT Data Calculated successfully';
                    }else{
                        $_SESSION['error'] = $conn->error;
                    }

                    $newid = $conn->insert_id;

                    $sql4 = "SELECT * FROM otdata_time_cal WHERE otdata_time_cal_id = '$newid';";
                    //echo $sql4."<br>"; 
                    $query4 = $conn->query($sql4);
                    $row4 = $query4->fetch_assoc();

                    $otrate_id = $row4["otrate_id"];
                    
                    $a = $row4["ot1_in"];
                    $aTime = strtotime($a);
                    $b = $row4["ot1_form_in"];
                    $bTime = strtotime($b);
                    $c = $row4["ot1_out"];
                    $cTime = strtotime($c);
                    $d = $row4["ot1_form_out"];
                    $dTime = strtotime($d);

                    $f = $row4["ot2_in"];
                    $fTime = strtotime($f);
                    $g = $row4["ot2_form_in"];
                    $gTime = strtotime($g);
                    $h = $row4["ot2_out"];
                    $hTime = strtotime($h);
                    $i = $row4["ot2_form_out"];
                    $iTime = strtotime($i);

                    // echo $a." ".$b." ".$c." ".$d." ".$f." ".$g." ".$h." ".$i."<br>";

                    if($aTime<=$bTime){
                        $starttime1 = $bTime; 
                    }else{
                        $starttime1 = $aTime;
                    }
                    if($cTime>=$dTime){
                        $endtime1 = $dTime; 
                    }else{
                        $endtime1 = $cTime;
                    }

                    $diff1=0;
                    $diff2=0;

                    $hr1=0;
                    $min1=0;
                    $hr2=0;
                    $min2=0;

                    $sumHr=0;
                    $sumMin=0;

                    // echo date("H:i:s",$endtime1)."-".date("H:i:s",$starttime1)."<br>";

                    $diff1 = $endtime1-$starttime1;
                    if($diff1>0){
                        // echo round(abs($endtime1 - $starttime1) / 60 / 60,0). " hour <br>";
                        // $hr1 = floor(round(abs($endtime1 - $starttime1) / 60,2)/60). " hour <br>";
                        // $min1 = (round(abs($endtime1 - $starttime1) / 60,2) % 60). " minute <br>";
                        $hr1 = floor(round(abs($endtime1 - $starttime1) / 60,2)/60);
                        $min1 = (round(abs($endtime1 - $starttime1) / 60,2) % 60);
                    }


                    if($fTime<=$gTime){
                        $starttime2 = $gTime; 
                    }else{
                        $starttime2 = $fTime;
                    }
                    if($hTime>=$iTime){
                        $endtime2 = $iTime; 
                    }else{
                        $endtime2 = $hTime;
                    }
                    
                    // echo date("H:i:s",$endtime2)."-".date("H:i:s",$starttime2)."<br>";

                    $diff2 = $endtime2-$starttime2;
                    if($diff2>0){
                        // echo round(abs($endtime2 - $starttime2) / 60 / 60,0). " hour <br>";
                        // $hr2 = floor(round(abs($endtime2 - $starttime2) / 60,2)/60). " hour <br>";
                        // $min2 = (round(abs($endtime2 - $starttime2) / 60,2) % 60). " minute <br>";
                        $hr2 = floor(round(abs($endtime2 - $starttime2) / 60,2)/60);
                        $min2 = (round(abs($endtime2 - $starttime2) / 60,2) % 60);
                    }

                    $sumHr = $hr1+$hr2;
                    $sumMin = $min1+$min2;

                    if($sumMin>=60){
                        $sumMin = $sumMin-60;
                        $sumHr = $sumHr+1;    
                    }

                    // echo "sumHr: ".$sumHr." sumMin: ".$sumMin."<br>";

                    $sql5 = "UPDATE otdata_time_cal 
                            SET num_hr = '".$sumHr."',
                            num_min = '".$sumMin."'
                            WHERE otdata_time_cal_id = '$newid';";
                    //echo $sql5."<br>"; 
                    $query5 = $conn->query($sql5);

                    $sql6 = "SELECT cal_half, cal_quarter FROM otrate WHERE otrate_id = '$otrate_id';";
                    // echo $sql6."<br>"; 

                    $query6 = $conn->query($sql6);
                    $row6 = $query6->fetch_assoc();

                    $cal_half = $row6["cal_half"];
                    $cal_quarter = $row6["cal_quarter"];

                    $totalMin = 0;

                    $totalMin=$sumHr*60;

                    if($cal_half==1){                
                        if($sumMin>=30){
                            $totalMin=$totalMin+30;
                        }
                    }

                    if($cal_quarter==1){
                        if($sumMin>=15){
                            $totalMin=$totalMin+15;
                        }
                    }

                    // echo $totalMin."<br>";

                    $sql7 = "SELECT no_min,no_rate FROM otrate_table WHERE otrate_id = '$otrate_id' ORDER BY no_min;";
                    // echo $sql7."<br>"; 
                    
                    $query7 = $conn->query($sql7);

                    $ot_amount=0;

                    while($row7 = $query7->fetch_assoc()){
                        // if($totalMin==$row7["no_min"]){
                        if($totalMin>=$row7["no_min"]){
                            $ot_amount=$row7["no_rate"];
                        }
                        // echo $ot_amount."<br>";    
                    }
                    
                    // echo $ot_amount."<br>";

                    $sql8 = "UPDATE otdata_time_cal 
                            SET ot_amount = '".$ot_amount."'
                            WHERE otdata_time_cal_id = '$newid';";
                    // echo $sql8."<br>"; 
                    $query8 = $conn->query($sql8);

                } 
                //=====================================================================                 
                 
            }                                 
        }                       
    
    }  // end while
    
    $sql9 = "UPDATE otdata
             SET otdata_status = '1'
             WHERE otdata_id = '$otdata_id';";
    //echo $sql9."<br>"; 
    $query9 = $conn->query($sql9);
    

    // $sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
    // $query = $conn->query($sql);

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
    
       
	
	header('location: otdata_calculate.php');

?>