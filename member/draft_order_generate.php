<?php
    include 'includes/session.php';
    include 'includes/functions.php';

    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    date_default_timezone_set('Asia/Bangkok');
    
    // $app_id = $_GET["appid"];
    // $sql = "SELECT a.*, y.year_name, d.dept_name, appt.app_type_name, m.firstname, m.lastname 
    //         FROM approval a
    //         LEFT JOIN years y ON y.year_id=a.year_id 
    //         LEFT JOIN department d ON d.dept_id=a.dept_id 
    //         LEFT JOIN app_type appt ON appt.app_type_id=a.app_type_id 
    //         LEFT JOIN member m on m.id = a.create_by 
    //         WHERE app_id = '$app_id'
    //         ;";
    $fiscal_id = $_GET["fid"];
    $sem_id = $_GET["sid"];
    $app_times = $_GET["atimes"];

    $sqlCurrYear = "SELECT fiscal_id, fiscal_name FROM fiscal WHERE fiscal_id = '".$_GET['fid']."'";
    $qCurrYear = $conn->query($sqlCurrYear);
    $rowCurrYear = $qCurrYear->fetch_assoc();
    $fiscal_name = $rowCurrYear["fiscal_name"];

    $sqlCurrSem = "SELECT sem_id, sem_name FROM ta_sem WHERE sem_id = '".$_GET['sid']."'";
    $qCurrSem = $conn->query($sqlCurrSem);
    $rowCurrSem = $qCurrSem->fetch_assoc();
    $sem_name = $rowCurrSem["sem_name"];
    
    // $sql = "SELECT a.*, DATE_FORMAT(a.create_date, '%c') AS aMonth, DATE_FORMAT(a.create_date, '%Y') AS aYear, f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name 
    //         FROM approval a
    //         LEFT JOIN ta_dept d ON d.dept_id=a.dept_id 
    //         LEFT JOIN fiscal f ON f.fiscal_id=a.fiscal_id 
    //         LEFT JOIN ta_sem s ON s.sem_id=a.sem_id
    //         WHERE a.fiscal_id = '$fiscal_id'
    //         AND a.sem_id = '$sem_id'
    //         AND a.app_times = '$app_times'            
    //         ;";

    // $query = $conn->query($sql);
    // $row = $query->fetch_assoc();

    // $app_date = DateThai($row["app_date"]);
    // $app_month = MonthThai($row["app_month"])." ".$row["year_name"];
    
    // $aYear = $row["aYear"]+543;
    
    $today = date("YmdHis");

    require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';

    echo date('H:i:s') , " Load from Excel2007 template" , EOL;
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');

    $objPHPExcel = $objReader->load("../files/template/template_orderfrom_all.xlsx");

    $startcolumn = 'A';
    $startrowtime = 14;

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 11            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);      
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);          
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 3            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);   
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);             
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 7            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);     
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);           
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 2            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);         
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);       
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 6            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);          
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);      
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 10            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);                
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 4            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);       
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);         
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 5            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);     
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);           
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 9            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);     
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);           
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 8            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]); 
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);               
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $sql = "SELECT a.app_id, 
            f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name,
            std.std_title_name, std.std_name, std.std_degree, std.std_class, std.std_subject, std.std_section, std.std_number, std.std_amount 
            FROM approval a, ta_dept d, fiscal f, ta_sem s, approval_std std            
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'            
            AND a.dept_id = 1            
            AND d.dept_id=a.dept_id 
            AND f.fiscal_id=a.fiscal_id 
            AND s.sem_id=a.sem_id
            AND std.app_id=a.app_id
            ;";

    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $i=1;
        while($row = $query->fetch_assoc()){
            if($i==1){
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $row["dept_name"]);              
                $objPHPExcel->getActiveSheet()
                            ->getStyle('A'.$startrowtime)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
                $startrowtime++;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }else{
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$startrowtime, $i);                
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$startrowtime, $row["std_title_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, $row["std_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$startrowtime, $row["std_degree"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$startrowtime, $row["std_class"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, $row["std_subject"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$startrowtime, $row["std_section"]);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$startrowtime, $row["std_number"]);
                $objPHPExcel->getActiveSheet()->setCellValue('I'.$startrowtime, $row["std_amount"]);
                $startrowtime++;
            }
            $i++;
        }
    }

    $startrowtime = $startrowtime+2;
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$startrowtime, "ทั้งนี้ ตั้งแต่วันที่ ");
    $startrowtime = $startrowtime+2;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, "สั่ง ณ วันที่ ");
    $startrowtime = $startrowtime+2;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, "(รองศาสตราจารย์ ดร.วชิระ จงบุรี)");
    $startrowtime++;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, "รองคณบดีฝ่ายวิชาการ รักษาการแทน");
    $startrowtime++;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$startrowtime, "คณบดีคณะวิศวกรรมศาสตร์");

    echo date('H:i:s') , " Write to Excel format" , EOL;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    $datefile = date("Ymd_His");

    $dir = "../files/draftall/";						
    $dataOutput = $dir."draft_order_all_".$datefile.".xlsx";
    // $dataOutput   = "output/2011_4120001.xlsx";
    $objWriter->save($dataOutput);

    if (file_exists($dataOutput)) {
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
    
?>