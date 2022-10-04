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
        $app_id = $_POST['app_id'];
        $userid = $_SESSION['member'];

        // $otdata_month = $_POST['otdata_month'];        
        // $otdata_name = $_POST['otdata_name'];
        // $otdata_type = $_POST['otdata_type'];
		
		
		$sql = "SELECT * FROM approval WHERE app_id = '$app_id';";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $start_month = $row["start_month"];
        $end_month = $row["end_month"];

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
        // $highestColumn = $objWorksheet->getHighestColumn();

        // echo $highestRow." first-time <br>";

        for ($row = 6; $row <= $highestRow; $row++) {                        

            $std_id = $objWorksheet->getCell('B'.$row)->getValue();
            $std_title_name = trim($objWorksheet->getCell('C'.$row)->getValue());
            $std_name = trim($objWorksheet->getCell('D'.$row)->getValue());
            $std_degree = trim($objWorksheet->getCell('E'.$row)->getValue());
            $std_class = trim($objWorksheet->getCell('F'.$row)->getValue());
            $std_subject = trim($objWorksheet->getCell('G'.$row)->getValue());
            $std_section = trim($objWorksheet->getCell('H'.$row)->getValue());
            $std_number = trim($objWorksheet->getCell('I'.$row)->getValue());
            $std_amount = trim($objWorksheet->getCell('J'.$row)->getValue());
            $std_gpa = trim($objWorksheet->getCell('K'.$row)->getValue());
            $std_score = trim($objWorksheet->getCell('L'.$row)->getValue());
            $std_bankno = trim($objWorksheet->getCell('M'.$row)->getValue());
            $std_bankname = trim($objWorksheet->getCell('N'.$row)->getValue());
            $std_phone = trim($objWorksheet->getCell('O'.$row)->getValue());

            if($std_title_name != "" && $std_name != "" && $std_amount != ""){
                $sql = "INSERT INTO approval_std 
                        (app_id, 					
                        std_id, 
                        std_title_name, 
                        std_name,
                        std_degree,					
                        std_class,					
                        std_subject,					
                        std_section,					
                        std_number,					
                        std_amount,					
                        std_gpa,					
                        std_score,					
                        std_bankno,					
                        std_bankname,					
                        std_phone,
                        create_by, 
                        create_date, 
                        lupdate_by, 
                        lupdate_date) 
                        VALUES 
                        ('$app_id',					
                        '$std_id', 
                        '$std_title_name', 
                        '$std_name', 
                        '$std_degree', 
                        '$std_class', 
                        '$std_subject', 
                        '$std_section', 
                        '$std_number', 
                        '$std_amount', 
                        '$std_gpa', 
                        '$std_score', 
                        '$std_bankno', 
                        '$std_bankname', 
                        '$std_phone', 
                        '$userid', 
                        now(), 
                        '$userid', 
                        now());";
                // echo $sql."<br>";
                if($conn->query($sql)){
                    $_SESSION['success'] = 'Data approval std added successfully';
                }else{
                    $_SESSION['error'] = $conn->error;
                }        

                $last_id = $conn->insert_id;

                for ($row2 = $start_month; $row2 <= $end_month; $row2++) {
                    $sql = "INSERT INTO approval_std_rec 
                            (app_id, 
                            app_std_id,
                            month_id,					
                            std_id, 
                            std_title_name, 
                            std_name,
                            std_degree,					
                            std_class,					                        
                            std_amount,					                        
                            std_phone,
                            app_rec_status,
                            create_by, 
                            create_date, 
                            lupdate_by, 
                            lupdate_date) 
                            VALUES 
                            ('$app_id',					
                            '$last_id', 
                            '$row2', 
                            '$std_id', 
                            '$std_title_name', 
                            '$std_name', 
                            '$std_degree', 
                            '$std_class', 
                            '$std_amount',                         
                            '$std_phone', 
                            '0', 
                            '$userid', 
                            now(), 
                            '$userid', 
                            now());";
                    // echo $sql;
                    if($conn->query($sql)){
                        $_SESSION['success'] = 'Data approval std rec added successfully';
                    }else{
                        $_SESSION['error'] = $conn->error;
                    } 
                }
            }

        }

        // $query->num_rows > 0
                
	}else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: propose.php?appid='.$app_id);

?>