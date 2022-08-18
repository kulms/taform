<?php
$conn = new mysqli('localhost', 'root', '', 'apsystem');

$cs1 = "SET character_set_results=utf8";
$query = $conn->query($cs1);

$cs2 = "SET character_set_client = utf8";
$query = $conn->query($cs2);

$cs3 = "SET character_set_connection = utf8";
$query = $conn->query($cs3);

$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

/** PHPExcel */
require_once '../PHPExcel/Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include '../PHPExcel/Classes/PHPExcel/IOFactory.php';

//if(isset($_SESSION['slogin']) && !empty($_SESSION['slogin'])) { 

    //$std_filename = $_FILES["ach_file"]["name"];
    //$std_tmpfilename = $_FILES['ach_file']['tmp_name'];
    //echo $std_filename." ".$std_tmpfilename."<br>";
	$std_tmpfilename = "ot_employees.xlsx";
    
    $inputFileName = $std_tmpfilename;  
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);  
    $objReader->setReadDataOnly(true);  
    $objPHPExcel = $objReader->load($inputFileName);  

    // for No header
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();

    // $r = -1;
    // $namedDataArray = array();
    // for ($row = 1; $row <= $highestRow; ++$row) {
    //     $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    //     if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
    //         ++$r;
    //         $namedDataArray[$r] = $dataRow[$row];
    //     }
    // }
    
    //$year_id = $_POST['year_id'];
    // $sem_id = $_POST['sem_id'];
    // $univ_id = 1;
    // $fac_id = 1;

    //$sqlChk = "SELECT year_id FROM qa_achieve WHERE year_id = '$year_id';";
    //$qChk = mysqli_query($conn,$sqlChk);

    //if(@mysqli_num_rows($qChk) > 0){
    //    $sqlDel = "DELETE FROM qa_achieve WHERE year_id = '$year_id';";
    //    $qDel = mysqli_query($conn,$sqlDel);
    //}

    for ($row = 2; $row <= $highestRow; $row++) {
        
        
        //$ins_title = $objWorksheet->getCell('A'.$row)->getValue();
        //$ins_fname = $objWorksheet->getCell('B'.$row)->getValue();
        //$ins_mname = $objWorksheet->getCell('C'.$row)->getValue();
        //$ins_lname = $objWorksheet->getCell('D'.$row)->getValue();        
        $employee_id = $objWorksheet->getCell('A'.$row)->getValue();
        $dept_id = $objWorksheet->getCell('B'.$row)->getValue();
		$titlename = $objWorksheet->getCell('C'.$row)->getValue();
		$firstname = $objWorksheet->getCell('D'.$row)->getValue();
		$lastname = $objWorksheet->getCell('E'.$row)->getValue();
		$address = $objWorksheet->getCell('F'.$row)->getValue();
		$birthdate = $objWorksheet->getCell('G'.$row)->getValue();
		$contact_info = $objWorksheet->getCell('H'.$row)->getValue();
		$gender = $objWorksheet->getCell('I'.$row)->getValue();
		$position_id = $objWorksheet->getCell('J'.$row)->getValue();
		$schedule_id = $objWorksheet->getCell('K'.$row)->getValue();
		$photo = $objWorksheet->getCell('L'.$row)->getValue();
		$created_on = $objWorksheet->getCell('M'.$row)->getValue();
		
		
        $sql = "INSERT INTO employees (
			employee_id,            
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
			created_on
			)
			VALUES (
			'$employee_id',            
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
			'$created_on'
			)
			";
        
        echo $sql."<br>"; 		
            
        //$query = mysqli_query($conn,$sql);
		$query = $conn->query($sql);
    }    

    // $objPHPExcel>disconnectWorksheets();
    unset($objPHPExcel);

    // $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    // $highestRow = $objWorksheet->getHighestRow();
    // $highestColumn = $objWorksheet->getHighestColumn();

    // $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
    // $headingsArray = $headingsArray[1];

    // $r = -1;
    // $namedDataArray = array();
    // for ($row = 2; $row <= $highestRow; ++$row) {
    //     $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    //     if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
    //         ++$r;
    //         foreach($headingsArray as $columnKey => $columnHeading) {
    //             $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
    //         }
    //     }
    // }

    // echo '<pre>';
    // var_dump($namedDataArray);
    // echo '</pre><hr />';

    
    


    // for($i=1;$i<count($namedDataArray);$i++) {
    //     echo $namedDataArray[$i]["A"]." ";
    //     echo $namedDataArray[$i]["B"]." ";
    //     echo $namedDataArray[$i]["C"]." ";
    //     echo $namedDataArray[$i]["D"]." ";
    //     //echo getPeriodId($conn,$namedDataArray[$i]["C"])." ";    
    //     echo $namedDataArray[$i]["E"]."<br>";
    //     //echo getDeptId($conn,$namedDataArray[$i]["D"])."<br>";

    //     // insert exam_course
        

    //     // insert exam_schedule

    // }

    //header("refresh:0;URL=course.php?fid=$fiscal_id&sid=$sem_id&typeid=$type_id");
//}
//=======================================================================



// if(isset($_SESSION['slogin']) && !empty($_SESSION['slogin'])) { 	
		
// 	$sql = "UPDATE exam_course SET 
// 			fiscal_id = '".$fiscal_id."',
// 			sem_id = '".$sem_id."',
// 			dept_id = '".$dept_id."',
// 			type_id = '".$type_id."',
// 			course_name = '".$course_name."',
// 			course_desc = '".$course_desc."',	
// 			expired_date = '".$expired_date."',			
// 			lupdate_by = '".$_SESSION["person_id"]."',
// 			lupdate_date = now()
// 			WHERE course_id = $course_id
// 			";
// 	//echo $sql; 
// 	$query = mysqli_query($conn,$sql);	
	
// 	header("refresh:0;URL=course.php?fid=$fiscal_id&sid=$sem_id&deptid=$dept_id&typeid=$type_id");
// }
    //header("refresh:0;URL=achieve.php?yid=$year_id");
?>