<?php
    /** Error reporting */
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    date_default_timezone_set('Asia/Bangkok');

    include 'includes/session.php';
    include 'includes/functions.php';
    
    $otdata_id = $_GET["otdataid"];
    
    $sql = "SELECT a.*, y.year_name 
            FROM otdata a                           
            LEFT JOIN years y ON y.year_id=a.year_id                          
            WHERE a.otdata_id = '".$otdata_id."'
            ORDER BY a.otdata_month DESC";  
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $otdata_year_id = $row['year_id'];
    $otdata_month_id = $row['otdata_month'];

    $otdata_month = $thaimonth[$row['otdata_month']-1]." ".$row['year_name'];                       
    $otdata_name = $row['otdata_name'];
    $create_date = DateShortThai(date('Y-m-d',strtotime($row['create_date'])));

    if($_SESSION["deptid"]=='99' || $_SESSION["deptid"]=='100'){                      
        $app_id = 0; 
    }else{
        $sqlm = "SELECT DISTINCT a.app_id
                    FROM approval a                           
                    WHERE a.dept_id = '".$_SESSION["deptid"]."'
                    AND  a.year_id = '".$otdata_year_id."'
                    AND a.app_month = '".$otdata_month_id."'
                    ORDER BY a.app_month DESC, a.app_type_id";  

        $querym = $conn->query($sqlm);
        $rowm = $querym->fetch_assoc();
        $app_id = $rowm["app_id"];  
    }

    if($_SESSION["deptid"]=='99' || $_SESSION["deptid"]=='100'){
        $sql = "SELECT DISTINCT otdata_time_cal.emp_id,otdata_time_cal.otdata_id,
                employees.titlename, employees.firstname, employees.lastname, employees.bank_account, 
                department.dept_name AS dept_name, employees.email
                FROM otdata_time_cal
                LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id                                       
                WHERE otdata_time_cal.otdata_id =".$otdata_id." AND otdata_time_cal.ot_amount > 0
                AND employees.bank_account <> ''                                   
                ORDER BY CONVERT(dept_name USING tis620), 
                CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                otdata_time_cal.ot_date, otrate.otrate_name "; 
    }

    $query = $conn->query($sql);
    // echo $sql."<br>"; 
    
    // date_default_timezone_set("Asia/Bangkok");

    /** PHPExcel_IOFactory */
    require_once dirname(__FILE__) . '/../PHPExcel/Classes/PHPExcel/IOFactory.php';

    echo date('H:i:s') , " Load from Excel2007 template" , EOL;
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');

    $objPHPExcel = $objReader->load("../files/templates/TMB_ENGR.xlsx");

    echo date('H:i:s') , " Add new data to the template" , EOL;

    // $datefile = date("Ymd_His");

    // $dir = "../files/";						
	// $fileName = $dir."bankfile_".$datefile.".txt";

    // $myfile = fopen($fileName, "w") or die("Unable to open file!");
    //$txt = "John Doe\n";
    //fwrite($myfile, $txt);
    //$txt = "Jane Doe\n";
    //fwrite($myfile, $txt);
    

    // $i=1;

    // $ku="TXNคณะวิศวกรรมศาสตร์";
    // $space00 = str_repeat(' ',103);

    // $kuaccount="00692582802";

    // $today = date('dmY'); 
    //echo $today;
    $rownum = 5;

    while($row = $query->fetch_assoc()){
        //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
        
        $sqlAmount =  "SELECT SUM(ot_amount) AS otamount  FROM otdata_time_cal 
                        WHERE emp_id = '".$row['emp_id']."' AND otdata_id = '".$row['otdata_id']."';";

        $qAmount = $conn->query($sqlAmount);
        // echo $sqlAmount."<br>"; 
        
        $rowAmount = $qAmount->fetch_assoc();
        $ot_amount = $rowAmount["otamount"];

        $empname=$row['titlename'].$row['firstname']." ".$row['lastname'];
        $subject = "ค่าล่วงเวลาเดือน".$otdata_month;
        $empaccount = $row['bank_account'];
        $payeebank = "011: TMB Bank";
        $advisemode = "EMAIL";
        $empemail = $row['email'];
        $txtben = "BEN";


        $objPHPExcel->getActiveSheet()->setCellValue('B'.$rownum, $empname);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$rownum, $ot_amount);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$rownum, $subject);
        $objPHPExcel->getActiveSheet()->setCellValue('O'.$rownum, $empaccount);
        $objPHPExcel->getActiveSheet()->setCellValue('P'.$rownum, $payeebank);
        $objPHPExcel->getActiveSheet()->setCellValue('U'.$rownum, $advisemode);
        $objPHPExcel->getActiveSheet()->setCellValue('W'.$rownum, $empemail);
        $objPHPExcel->getActiveSheet()->setCellValue('Y'.$rownum, $txtben);
        
        $rownum++;
    }

    echo date('H:i:s') , " Write to Excel2007 format" , EOL;

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    $datefile = date("Ymd_His");

    $dir = "../files/output/";						
    $dataOutput = $dir."bankfile_".$datefile.".xlsx";
    // $dataOutput   = "output/2011_4120001.xlsx";
    $objWriter->save($dataOutput);


    // set_time_limit(0); 
    // $file = file_get_contents($fileName);
    // file_put_contents('Bankfile.txt', $file);

    // $file = 'monkey.gif';

    if (file_exists($dataOutput)) {
        // header('Content-Description: File Transfer');
        // header('Content-Type: application/octet-stream');
        // header('Content-Disposition: attachment; filename="'.basename($dataOutput).'"');
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate');
        // header('Pragma: public');
        // header('Content-Length: ' . filesize($dataOutput));
        // readfile($dataOutput);
        // exit;
        header('Content-Description: File Transfer');
        header('Content-disposition: attachment; filename='.basename($dataOutput));
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($dataOutput));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        flush(); 
        readfile($dataOutput);
        unlink($dataOutput);
        exit;
    }

     

    header('location: bank_cal_print.php?otdataid='.$otdata_id);

?>    