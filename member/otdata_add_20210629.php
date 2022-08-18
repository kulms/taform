<?php
    include 'includes/session.php';
    include 'includes/functions.php';
    
    /** PHPExcel */
    require_once '../PHPExcel/Classes/PHPExcel.php';

    /** PHPExcel_IOFactory - Reader */
    include '../PHPExcel/Classes/PHPExcel/IOFactory.php';


	if(isset($_POST['add'])){
		// $employee = $_POST['employee'];
		// $date = $_POST['date'];
		// $time_in = $_POST['time_in'];
		// $time_in = date('H:i:s', strtotime($time_in));
		// $time_out = $_POST['time_out'];
        // $time_out = date('H:i:s', strtotime($time_out));
        $year_id = $_POST['year_id'];
        $otdata_month = $_POST['otdata_month'];        
        $otdata_name = $_POST['otdata_name'];
        $otdata_type = $_POST['otdata_type'];
		

		
		
		// $sql = "SELECT * FROM approval WHERE year_id = '$year_id' AND dept_id = '$dept_id' AND app_type_id = '$app_type_id' AND app_month = '$app_month';";
        // $query = $conn->query($sql);

        // if($query->num_rows > 0){
        //     $_SESSION['error'] = 'Approval form for the month exist';
        // }else{
        if($otdata_type == 1){
            $userid = $_SESSION['member'];
            $sql = "INSERT INTO otdata 
                    (year_id, 					
                    otdata_month, 
                    otdata_name, 
                    otdata_detail,
                    otdata_status,					
                    create_by, 
                    create_date, 
                    lupdate_by, 
                    lupdate_date) 
                    VALUES 
                    ('$year_id',					
                    '$otdata_month', 
                    '$otdata_name', 
                    '',					
                    '0',
                    '$userid', 
                    now(), 
                    '$userid', 
                    now());";
            // echo $sql;
            if($conn->query($sql)){
                $_SESSION['success'] = 'Fingerprint Scan Data added successfully';
            }else{
                $_SESSION['error'] = $conn->error;
            }        

            $last_id = $conn->insert_id;
            // $last_id = 1;

            $finger_filename = $_FILES["finger_file"]["name"];
            $finger_tmpfilename = $_FILES['finger_file']['tmp_name'];

            // echo $finger_filename." ".$finger_tmpfilename."<br>";
            
            $inputFileName = $finger_tmpfilename; 

            //$inputFileName = "examform_course.xlsx";  
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);  
            $objReader->setReadDataOnly(true);  
            $objPHPExcel = $objReader->load($inputFileName);  

            // for No header
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();

            // echo $highestRow." first-time <br>";

            for ($row = 2; $row <= $highestRow; $row++) {
                
                $arrTime = array();

                $scanid = $objWorksheet->getCell('A'.$row)->getValue();
                $idcard = trim($objWorksheet->getCell('B'.$row)->getValue());
                $dept_id = getDeptIdfromIdCard($conn,$idcard); 
                $emp_id = getEmpIdfromIdCard($conn,$idcard);
                $scandate = explode("/",$objWorksheet->getCell('E'.$row)->getValue());
                //01/08/18
                //$scandate=explode("/", $scandate);		
                $scanday = $scandate[0];
                $scanmonth = $scandate[1];
                // $scanyear = $scandate[2]+2000;
                $scanyear = $scandate[2];
                $ot_date = $scanyear."-".$scanmonth."-".$scanday;   

                // echo $ot_date."<br>";
                $otrate_id = getOtRateIdfromEmpDate($conn,$emp_id,$ot_date);
                // echo $otrate_id."<br>";
                
                $isHoliday = checkHolidayfromOtRateId($conn,$otrate_id);
                // echo $isHoliday."<br>";

                $calNoon = checkNoonfromOtRateId($conn,$otrate_id);
                // echo $isNoon."<br>";

                $otperday = countEmpOtperDay($conn,$emp_id,$ot_date);


                $time01 = $objWorksheet->getCell('F'.$row)->getValue();
                if(strlen($time01)>0) array_push($arrTime,$time01);

                $time02 = $objWorksheet->getCell('G'.$row)->getValue();
                if(strlen($time02)>0) array_push($arrTime,$time02);

                $time03 = $objWorksheet->getCell('H'.$row)->getValue();
                if(strlen($time03)>0) array_push($arrTime,$time03);

                $time04 = $objWorksheet->getCell('I'.$row)->getValue();
                if(strlen($time04)>0) array_push($arrTime,$time04);

                $time05 = $objWorksheet->getCell('J'.$row)->getValue();
                if(strlen($time05)>0) array_push($arrTime,$time05);

                $time06 = $objWorksheet->getCell('K'.$row)->getValue();
                if(strlen($time06)>0) array_push($arrTime,$time06);

                $time07 = $objWorksheet->getCell('L'.$row)->getValue();
                if(strlen($time07)>0) array_push($arrTime,$time07);

                $time08 = $objWorksheet->getCell('M'.$row)->getValue();
                if(strlen($time08)>0) array_push($arrTime,$time08);

                $time09 = $objWorksheet->getCell('N'.$row)->getValue();
                if(strlen($time09)>0) array_push($arrTime,$time09);

                $time10 = $objWorksheet->getCell('O'.$row)->getValue();
                if(strlen($time10)>0) array_push($arrTime,$time10);

                $time11 = $objWorksheet->getCell('P'.$row)->getValue();
                if(strlen($time11)>0) array_push($arrTime,$time11);

                $time12 = $objWorksheet->getCell('Q'.$row)->getValue();
                if(strlen($time12)>0) array_push($arrTime,$time12);

                $time13 = $objWorksheet->getCell('R'.$row)->getValue();
                if(strlen($time13)>0) array_push($arrTime,$time13);

                $time14 = $objWorksheet->getCell('S'.$row)->getValue();
                if(strlen($time14)>0) array_push($arrTime,$time14);

                $time15 = $objWorksheet->getCell('T'.$row)->getValue();
                if(strlen($time15)>0) array_push($arrTime,$time15);

                $time16 = $objWorksheet->getCell('U'.$row)->getValue();
                if(strlen($time16)>0) array_push($arrTime,$time16);

                $time17 = $objWorksheet->getCell('V'.$row)->getValue();
                if(strlen($time17)>0) array_push($arrTime,$time17);

                $time18 = $objWorksheet->getCell('W'.$row)->getValue();
                if(strlen($time18)>0) array_push($arrTime,$time18);

                $time19 = $objWorksheet->getCell('X'.$row)->getValue();
                if(strlen($time19)>0) array_push($arrTime,$time19);

                $time20 = $objWorksheet->getCell('Y'.$row)->getValue();
                if(strlen($time20)>0) array_push($arrTime,$time20);

                //print_r($arrTime);            

                if(strlen($time01)>0){
                    // insert otdata_time
                    $carrTime = count($arrTime);
                    $lastarrTime = $carrTime-1;

                    $ot1_in = $arrTime[0];
                                    
                    if($isHoliday==1){                    
                        if($calNoon==1){
                            $ot1_out = "12:30";
                        }else{
                            $chkot1_out = $arrTime[$lastarrTime];
                            $timeout1 = explode(":", $chkot1_out);
                            if($carrTime>1){
                                if($timeout1[0]<12){
                                    $ot1_out = $chkot1_out;
                                }else{
                                    $ot1_out = "12:00";
                                }
                            }else{
                                $ot1_out = "12:00";
                            }    

                        }
                        $ot2_in = "13:00";
                        
                    }else{
                        
                        $ot2_in = "";

                        for($i=0;$i<$carrTime;$i++){
                            $timein = explode(":", $arrTime[$i]);
                            if($timein[0]>=14){
                                $ot2_in = $arrTime[$i];
                                break;  
                            }                        
                        }

                        if($ot2_in==""){
                            $ot2_in = $arrTime[$lastarrTime];
                        }

                        // check otrate_id is that for driver weekday? 
                        // otrate_id = 91 = driver weekday rate
                       

                        if($otrate_id==91){
                            $ot2_in = "16:30";
                        }                        

                        // echo "1. ".$ot_date." ".$otrate_id." ".$ot2_in."<br>"; 

                        if($otperday>1){
                            $ot1_out = "8:30";
                            //$ot2_in = "16:30";                        
                        }else{
                            //$ot1_out = "7:00";
                            $ot1_out = "8:30";
                            //$ot2_in = "16:30";
                        }
                    }
                    
                    $ot2_out = $arrTime[$lastarrTime];

                    //  echo $ot1_in." ".$ot1_out." ".$ot2_in." ".$ot2_out."<br>";

                    $sql = "INSERT INTO otdata_time (
                        otdata_id,
                        dept_id,
                        emp_id,
                        ot_date,
                        time01,
                        time02,
                        time03,
                        time04,
                        time05,
                        time06,
                        time07,
                        time08,
                        time09,
                        time10,
                        time11,
                        time12,
                        time13,
                        time14,
                        time15,
                        time16,
                        time17,
                        time18,
                        time19,
                        time20,
                        ot1_in,
                        ot1_out,
                        ot2_in,
                        ot2_out,			                
                        create_by, 
                        create_date, 
                        lupdate_by, 
                        lupdate_date
                        )
                        VALUES (
                        '".$last_id."',
                        '".$dept_id."',
                        '".$emp_id."',
                        '".$ot_date."',
                        '".$time01."',
                        '".$time02."',
                        '".$time03."',
                        '".$time04."',
                        '".$time05."',
                        '".$time06."',
                        '".$time07."',
                        '".$time08."',
                        '".$time09."',
                        '".$time10."',
                        '".$time11."',
                        '".$time12."',
                        '".$time13."',
                        '".$time14."',
                        '".$time15."',
                        '".$time16."',
                        '".$time17."',
                        '".$time18."',
                        '".$time19."',
                        '".$time20."',
                        '".$ot1_in."',
                        '".$ot1_out."',
                        '".$ot2_in."',
                        '".$ot2_out."',
                        '".$userid."',
                        now(),
                        '".$userid."',
                        now()
                        );
                        ";
                    // echo $sql." end first-time <br>"; 
                    if($conn->query($sql)){
                        $_SESSION['success'] = 'Fingerprint Scan Data added successfully';
                    }else{
                        $_SESSION['error'] = $conn->error;
                    }
                }                                 
            }
        // end $otdata_type == 1    
        }elseif($otdata_type == 2){
            $sql = "SELECT * FROM otdata  
                    WHERE year_id = '$year_id' AND otdata_month = '$otdata_month';";
            $query = $conn->query($sql);

            if($query->num_rows == 1){
                // append data
                $userid = $_SESSION['member'];
                $rowot = $query->fetch_assoc();
                $otdata_id = $rowot["otdata_id"];
                
                $finger_filename = $_FILES["finger_file"]["name"];
                $finger_tmpfilename = $_FILES['finger_file']['tmp_name'];

                // echo $finger_filename." ".$finger_tmpfilename."<br>";
                
                $inputFileName = $finger_tmpfilename; 

                //$inputFileName = "examform_course.xlsx";  
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);  
                $objReader->setReadDataOnly(true);  
                $objPHPExcel = $objReader->load($inputFileName);  

                // for No header
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                $highestColumn = $objWorksheet->getHighestColumn();

                // echo $highestRow."else new format "."<br>";

                $arrTime = array();

                // for ($row = 2; $row <= $highestRow; $row++) {
                for ($row = 2; $row < $highestRow; $row++) {
                    
                    // $arrTime = array();
                    // echo $row."<br>";
                    
                    $otrate_id=0;

                    if($row==2){
                        $scanid = $objWorksheet->getCell('A'.$row)->getValue();
                        $idcard = trim($objWorksheet->getCell('B'.$row)->getValue());                                        
                        $dept_id = getDeptIdfromIdCard($conn,$idcard); 
                        $emp_id = getEmpIdfromIdCard($conn,$idcard);
                        $scandate = explode("/",$objWorksheet->getCell('I'.$row)->getValue());                    

                        //01/08/18
                        //$scandate=explode("/", $scandate);		
                        $scanday = $scandate[0];
                        $scanmonth = $scandate[1];
                        // $scanyear = $scandate[2]+2000;
                        $scanyear = $scandate[2];
                        $ot_date = $scanyear."-".$scanmonth."-".$scanday;   

                        $idcardCurrent = $idcard;
                        $ot_dateCurrent = $ot_date;
                        $dept_idCurrent = $dept_id;
                        $emp_idCurrent = $emp_id;

                        // echo "1. ".$ot_date."<br>";
                        $otrate_id = getOtRateIdfromEmpDate($conn,$emp_id,$ot_date);
                        // echo "1. ".$otrate_id."<br>";

                        $otrate_idCurrent = $otrate_id;
                        
                        $isHoliday = checkHolidayfromOtRateId($conn,$otrate_id);
                        // echo $isHoliday."<br>";

                        $calNoon = checkNoonfromOtRateId($conn,$otrate_id);
                        // echo $isNoon."<br>";

                        $otperday = countEmpOtperDay($conn,$emp_id,$ot_date);

                        $isHolidayCurrent = $isHoliday;


                        $time = $objWorksheet->getCell('J'.$row)->getValue();
                        // echo $time."<br>";
                        if(strlen($time)>0) array_push($arrTime,$time);

                    }else{
                        // print_r($arrTime);
                        // echo "<br>";
                        $scanid = $objWorksheet->getCell('A'.$row)->getValue();
                        $idcard = trim($objWorksheet->getCell('B'.$row)->getValue());
                        $dept_id = getDeptIdfromIdCard($conn,$idcard); 
                        $emp_id = getEmpIdfromIdCard($conn,$idcard);
                        $scandate = explode("/",$objWorksheet->getCell('I'.$row)->getValue());
                        
                        $scanday = $scandate[0];
                        $scanmonth = @$scandate[1];
                        // $scanyear = $scandate[2]+2000;
                        $scanyear = @$scandate[2];
                        $ot_date = $scanyear."-".$scanmonth."-".$scanday;

                        // echo "2. ".$ot_date."<br>";
                        $otrate_id = getOtRateIdfromEmpDate($conn,$emp_id,$ot_date);
                        // echo "2. ".$otrate_id."<br>";

                        $isHoliday = checkHolidayfromOtRateId($conn,$otrate_id);

                        $calNoon = checkNoonfromOtRateId($conn,$otrate_id);

                        $otperday = countEmpOtperDay($conn,$emp_id,$ot_date);

                        if(($idcard==$idcardCurrent)&&($ot_date==$ot_dateCurrent)&&($otrate_id==$otrate_idCurrent)){
                            $time = $objWorksheet->getCell('J'.$row)->getValue();
                            // echo $time."<br>";
                            if(strlen($time)>0) array_push($arrTime,$time);
                            if($row==$highestRow){
                                // print_r($arrTime);
                                // echo "bbb<br>";

                                // echo $idcardCurrent." ";
                                // echo $ot_dateCurrent." ";
                                // echo $dept_idCurrent." ";
                                // echo $emp_idCurrent."<br>";
                                // echo $isHolidayCurrent."<br>"; 
                                
                                // $carrTime = count($arrTime);
                                // $lastarrTime = $carrTime-1;

                                // $ot1_in = $arrTime[0];
                                                
                                // if($isHolidayCurrent==1){                    
                                //     if($calNoon==1){
                                //         $ot1_out = "12:30";
                                //     }else{
                                //         $chkot1_out = $arrTime[$lastarrTime];
                                //         $timeout1 = explode(":", $chkot1_out);
                                //         if($timeout1[0]<12){
                                //             $ot1_out = $chkot1_out;
                                //         }else{
                                //             $ot1_out = "12:00";
                                //         }                             
                                //     }
                                //     $ot2_in = "13:00";
                                // }else{
                                    
                                //     $ot2_in = "";

                                //     for($i=0;$i<$carrTime;$i++){
                                //         $timein = explode(":", $arrTime[$i]);
                                //         if($timein[0]>=14){
                                //             $ot2_in = $arrTime[$i];
                                //             break;  
                                //         }                        
                                //     }

                                //     if($ot2_in==""){
                                //         $ot2_in = $arrTime[$lastarrTime];
                                //     }

                                //     if($otperday>1){
                                //         $ot1_out = "8:30";
                                //         //$ot2_in = "16:30";                        
                                //     }else{
                                //         //$ot1_out = "7:00";
                                //         $ot1_out = "8:30";
                                //         //$ot2_in = "16:30";
                                //     }
                                // }
                                
                                // $ot2_out = $arrTime[$lastarrTime];
                                
                                // insert to db

                                // $sql = "INSERT INTO otdata_time (
                                //     otdata_id,
                                //     dept_id,
                                //     emp_id,
                                //     ot_date,
                                //     time01,
                                //     time02,
                                //     time03,
                                //     time04,
                                //     time05,
                                //     time06,
                                //     time07,
                                //     time08,
                                //     time09,
                                //     time10,
                                //     time11,
                                //     time12,
                                //     time13,
                                //     time14,
                                //     time15,
                                //     time16,
                                //     time17,
                                //     time18,
                                //     time19,
                                //     time20,
                                //     ot1_in,
                                //     ot1_out,
                                //     ot2_in,
                                //     ot2_out,			                
                                //     create_by, 
                                //     create_date, 
                                //     lupdate_by, 
                                //     lupdate_date
                                //     )
                                //     VALUES (
                                //     '".$otdata_id."',
                                //     '".$dept_idCurrent."',
                                //     '".$emp_idCurrent."',
                                //     '".$ot_dateCurrent."',
                                //     '".$arrTime[0]."',
                                //     '".@$arrTime[1]."',
                                //     '".@$arrTime[2]."',
                                //     '".@$arrTime[3]."',
                                //     '".@$arrTime[4]."',
                                //     '".@$arrTime[5]."',
                                //     '".@$arrTime[6]."',
                                //     '".@$arrTime[7]."',
                                //     '".@$arrTime[8]."',
                                //     '".@$arrTime[9]."',
                                //     '".@$arrTime[10]."',
                                //     '".@$arrTime[11]."',
                                //     '".@$arrTime[12]."',
                                //     '".@$arrTime[13]."',
                                //     '".@$arrTime[14]."',
                                //     '".@$arrTime[15]."',
                                //     '".@$arrTime[16]."',
                                //     '".@$arrTime[17]."',
                                //     '".@$arrTime[18]."',
                                //     '".@$arrTime[19]."',
                                //     '".$ot1_in."',
                                //     '".$ot1_out."',
                                //     '".$ot2_in."',
                                //     '".$ot2_out."',
                                //     '".$userid."',
                                //     now(),
                                //     '".$userid."',
                                //     now()
                                //     );
                                //     ";
                                // echo $sql."<br>"; 
                                //
                                // if($conn->query($sql)){
                                //     $_SESSION['success'] = 'Fingerprint Scan Data added successfully';
                                // }else{
                                //     $_SESSION['error'] = $conn->error;
                                // }

                                $carrTime = count($arrTime);
                                $lastarrTime = $carrTime-1;

                                $ot1_in = $arrTime[0];
                                                
                                if($isHolidayCurrent==1){                    
                                    if($calNoon==1){
                                        $ot1_out = "12:30";
                                    }else{
                                        $chkot1_out = $arrTime[$lastarrTime];
                                        $timeout1 = explode(":", $chkot1_out);
                                        if($carrTime>1){
                                            if($timeout1[0]<12){
                                                $ot1_out = $chkot1_out;
                                            }else{
                                                $ot1_out = "12:00";
                                            }
                                        }else{
                                            $ot1_out = "12:00";
                                        }                                                                 
                                    }
                                    $ot2_in = "13:00";
                                }else{
                                    
                                    $ot2_in = "";

                                    for($i=0;$i<$carrTime;$i++){
                                        $timein = explode(":", $arrTime[$i]);
                                        if($timein[0]>=14){
                                            $ot2_in = $arrTime[$i];
                                            break;  
                                        }                        
                                    }

                                    if($ot2_in==""){
                                        $ot2_in = $arrTime[$lastarrTime];
                                    }

                                    // check otrate_id is that for driver weekday? 
                                    // otrate_id = 91 = driver weekday rate
                                    if($otrate_idCurrent==91){
                                        $ot2_in = "16:30";
                                    }

                                    // echo "2. ".$ot_date." ".$otrate_id." ".$ot2_in."<br>"; 

                                    if($otperday>1){
                                        $ot1_out = "8:30";
                                        //$ot2_in = "16:30";                        
                                    }else{
                                        //$ot1_out = "7:00";
                                        $ot1_out = "8:30";
                                        //$ot2_in = "16:30";
                                    }
                                }
                                
                                $ot2_out = $arrTime[$lastarrTime];
                                
                                // insert to db

                                $sql = "INSERT INTO otdata_time (
                                    otdata_id,
                                    dept_id,
                                    emp_id,
                                    ot_date,
                                    time01,
                                    time02,
                                    time03,
                                    time04,
                                    time05,
                                    time06,
                                    time07,
                                    time08,
                                    time09,
                                    time10,
                                    time11,
                                    time12,
                                    time13,
                                    time14,
                                    time15,
                                    time16,
                                    time17,
                                    time18,
                                    time19,
                                    time20,
                                    ot1_in,
                                    ot1_out,
                                    ot2_in,
                                    ot2_out,			                
                                    create_by, 
                                    create_date, 
                                    lupdate_by, 
                                    lupdate_date
                                    )
                                    VALUES (
                                    '".$otdata_id."',
                                    '".$dept_idCurrent."',
                                    '".$emp_idCurrent."',
                                    '".$ot_dateCurrent."',
                                    '".$arrTime[0]."',
                                    '".@$arrTime[1]."',
                                    '".@$arrTime[2]."',
                                    '".@$arrTime[3]."',
                                    '".@$arrTime[4]."',
                                    '".@$arrTime[5]."',
                                    '".@$arrTime[6]."',
                                    '".@$arrTime[7]."',
                                    '".@$arrTime[8]."',
                                    '".@$arrTime[9]."',
                                    '".@$arrTime[10]."',
                                    '".@$arrTime[11]."',
                                    '".@$arrTime[12]."',
                                    '".@$arrTime[13]."',
                                    '".@$arrTime[14]."',
                                    '".@$arrTime[15]."',
                                    '".@$arrTime[16]."',
                                    '".@$arrTime[17]."',
                                    '".@$arrTime[18]."',
                                    '".@$arrTime[19]."',
                                    '".$ot1_in."',
                                    '".$ot1_out."',
                                    '".$ot2_in."',
                                    '".$ot2_out."',
                                    '".$userid."',
                                    now(),
                                    '".$userid."',
                                    now()
                                    );
                                    ";
                                // echo $sql." 6666<br>"; 
                                //
                                if($conn->query($sql)){
                                    $_SESSION['success'] = 'Fingerprint Scan Data added successfully';
                                }else{
                                    $_SESSION['error'] = $conn->error;
                                }
                                
                                unset($arrTime);

                            }        
                            
                        }else{
                            
                            // print_r($arrTime);
                            // echo "aaa<br>";

                            // echo $idcardCurrent." ";
                            // echo $ot_dateCurrent." ";
                            // echo $dept_idCurrent." ";
                            // echo $emp_idCurrent."<br>";
                            // $isHolidayCurrent = $isHoliday;

                            // echo $isHolidayCurrent."<br>"; 

                            $carrTime = count($arrTime);
                            $lastarrTime = $carrTime-1;

                            $ot1_in = $arrTime[0];
                                            
                            if($isHolidayCurrent==1){                    
                                if($calNoon==1){
                                    $ot1_out = "12:30";
                                }else{
                                    $chkot1_out = $arrTime[$lastarrTime];
                                    $timeout1 = explode(":", $chkot1_out);
                                    if($carrTime>1){
                                        if($timeout1[0]<12){
                                            $ot1_out = $chkot1_out;
                                        }else{
                                            $ot1_out = "12:00";
                                        }
                                    }else{
                                        $ot1_out = "12:00";
                                    }                                                                 
                                }
                                $ot2_in = "13:00";
                            }else{
                                
                                $ot2_in = "";

                                for($i=0;$i<$carrTime;$i++){
                                    $timein = explode(":", $arrTime[$i]);
                                    if($timein[0]>=14){
                                        $ot2_in = $arrTime[$i];
                                        break;  
                                    }                        
                                }

                                if($ot2_in==""){
                                    $ot2_in = $arrTime[$lastarrTime];
                                }

                                // check otrate_id is that for driver weekday? 
                                // otrate_id = 91 = driver weekday rate
                                if($otrate_idCurrent==91){
                                    $ot2_in = "16:30";
                                }

                                // echo "2. ".$ot_date." ".$otrate_id." ".$ot2_in."<br>"; 

                                if($otperday>1){
                                    $ot1_out = "8:30";
                                    //$ot2_in = "16:30";                        
                                }else{
                                    //$ot1_out = "7:00";
                                    $ot1_out = "8:30";
                                    //$ot2_in = "16:30";
                                }
                            }
                            
                            $ot2_out = $arrTime[$lastarrTime];
                            
                            // insert to db

                            $sql = "INSERT INTO otdata_time (
                                otdata_id,
                                dept_id,
                                emp_id,
                                ot_date,
                                time01,
                                time02,
                                time03,
                                time04,
                                time05,
                                time06,
                                time07,
                                time08,
                                time09,
                                time10,
                                time11,
                                time12,
                                time13,
                                time14,
                                time15,
                                time16,
                                time17,
                                time18,
                                time19,
                                time20,
                                ot1_in,
                                ot1_out,
                                ot2_in,
                                ot2_out,			                
                                create_by, 
                                create_date, 
                                lupdate_by, 
                                lupdate_date
                                )
                                VALUES (
                                '".$otdata_id."',
                                '".$dept_idCurrent."',
                                '".$emp_idCurrent."',
                                '".$ot_dateCurrent."',
                                '".$arrTime[0]."',
                                '".@$arrTime[1]."',
                                '".@$arrTime[2]."',
                                '".@$arrTime[3]."',
                                '".@$arrTime[4]."',
                                '".@$arrTime[5]."',
                                '".@$arrTime[6]."',
                                '".@$arrTime[7]."',
                                '".@$arrTime[8]."',
                                '".@$arrTime[9]."',
                                '".@$arrTime[10]."',
                                '".@$arrTime[11]."',
                                '".@$arrTime[12]."',
                                '".@$arrTime[13]."',
                                '".@$arrTime[14]."',
                                '".@$arrTime[15]."',
                                '".@$arrTime[16]."',
                                '".@$arrTime[17]."',
                                '".@$arrTime[18]."',
                                '".@$arrTime[19]."',
                                '".$ot1_in."',
                                '".$ot1_out."',
                                '".$ot2_in."',
                                '".$ot2_out."',
                                '".$userid."',
                                now(),
                                '".$userid."',
                                now()
                                );
                                ";
                            // echo $sql." 5555<br>"; 
                            //
                            if($conn->query($sql)){
                                $_SESSION['success'] = 'Fingerprint Scan Data added successfully';
                            }else{
                                $_SESSION['error'] = $conn->error;
                            }
                            
                            unset($arrTime);
                            $arrTime = array();

                            $scanid = $objWorksheet->getCell('A'.$row)->getValue();
                            $idcard = trim($objWorksheet->getCell('B'.$row)->getValue());                                        
                            $dept_id = getDeptIdfromIdCard($conn,$idcard); 
                            $emp_id = getEmpIdfromIdCard($conn,$idcard);
                            $scandate = explode("/",$objWorksheet->getCell('I'.$row)->getValue());                    

                            //01/08/18
                            //$scandate=explode("/", $scandate);		
                            $scanday = $scandate[0];
                            $scanmonth = @$scandate[1];
                            // $scanyear = $scandate[2]+2000;
                            $scanyear = @$scandate[2];
                            $ot_date = $scanyear."-".$scanmonth."-".$scanday;   

                            $idcardCurrent = $idcard;
                            $ot_dateCurrent = $ot_date;
                            $dept_idCurrent = $dept_id;
                            $emp_idCurrent = $emp_id;
                            $otrate_idCurrent = $otrate_id;

                            // $otrate_id = getOtRateIdfromEmpDate($conn,$emp_id,$ot_date);
                            // echo $otrate_id."<br>";
                            
                            $isHoliday = checkHolidayfromOtRateId($conn,$otrate_id);
                            // echo $isHoliday."<br>";

                            // $calNoon = checkNoonfromOtRateId($conn,$otrate_id);
                            // echo $isNoon."<br>";

                            $otperday = countEmpOtperDay($conn,$emp_id,$ot_date);
                            
                            $isHolidayCurrent = $isHoliday;

                            $time = $objWorksheet->getCell('J'.$row)->getValue();
                            // echo $time."ccc<br>";
                            if(strlen($time)>0) array_push($arrTime,$time);
                            

                        }
                    }    
                }    
                    $_SESSION['success'] = 'Fingerprint Scan Data added successfully';
                }else{
                    $_SESSION['error'] = 'Fingerprint Scan Data was not found. Please import the old data first.';
                }
            }
        // end $otdata_type == 2
	}else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: otdata.php');

?>