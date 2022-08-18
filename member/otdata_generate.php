<?php
    include 'includes/session.php';
    include 'includes/functions.php';
    
    $otdata_id = $_GET["otdataid"];
    //$app_id = $_GET["appid"];
    
    
    $sql = "SELECT ot.year_id, ot.otdata_month, y.year_name
            FROM otdata ot, years y 
            WHERE ot.otdata_id =".$otdata_id."
            AND ot.year_id = y.year_id;";

    $query = $conn->query($sql);
    
    $row = $query->fetch_assoc();

    $year_id = $row["year_id"];
    $otdata_month = $row["otdata_month"];

    // $app_date = DateThai($row["app_date"]);
    // $app_month = MonthThai($row["app_month"])." ".$row["year_name"];
    $head_ot_month = MonthThai($row["otdata_month"])." พ.ศ. ".$row["year_name"];

    if($_SESSION["deptid"]=='99'){
        $app_type_name = "ทุกหน่วยงาน";
    }else{
        $sql2 = "SELECT aty.app_type_name, d.dept_name
                FROM approval a, app_type aty, department d
                WHERE a.year_id =".$year_id."
                AND a.app_month =".$otdata_month."
                AND a.app_type_id = aty.app_type_id
                AND a.dept_id = ".$_SESSION["deptid"]."
                AND a.dept_id = d.dept_id
                ";
        $query2 = $conn->query($sql2);
        $row2 = $query2->fetch_assoc();
        $app_type_name = $row2["app_type_name"];
        $dept_name = $row2["dept_name"];
    }    

    $today = date("YmdHis");

    $filename = "otdata_form_".$today.".pdf";

	// function generateRow($from, $to, $conn, $deduction){
	// 	$contents = '';
	 	
	// 	$sql = "SELECT *, sum(num_hr) AS total_hr, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

	// 	$query = $conn->query($sql);
	// 	$total = 0;
	// 	while($row = $query->fetch_assoc()){
	// 		$empid = $row['empid'];
                      
	//       	$casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
	      
	//       	$caquery = $conn->query($casql);
	//       	$carow = $caquery->fetch_assoc();
	//       	$cashadvance = $carow['cashamount'];

	// 		$gross = $row['rate'] * $row['total_hr'];
	// 		$total_deduction = $deduction + $cashadvance;
    //   		$net = $gross - $total_deduction;

	// 		$total += $net;
	// 		$contents .= '
	// 		<tr>
	// 			<td>'.$row['lastname'].', '.$row['firstname'].'</td>
	// 			<td>'.$row['employee_id'].'</td>
	// 			<td align="right">'.number_format($net, 2).'</td>
	// 		</tr>
	// 		';
	// 	}

	// 	$contents .= '
	// 		<tr>
	// 			<td colspan="2" align="right"><b>Total</b></td>
	// 			<td align="right"><b>'.number_format($total, 2).'</b></td>
	// 		</tr>
	// 	';
	// 	return $contents;
    // }
    
    function generateRow($id,$year_id,$otdata_month,$conn){
        $contents = '';
            
        if($_SESSION["deptid"]=='99'){
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                                   
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name ";
        }else{
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name                    
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                       
                    AND otdata_time_cal.app_id IN (SELECT DISTINCT a.app_id
                                                    FROM approval a                           
                                                    WHERE a.dept_id = '".$_SESSION["deptid"]."'
                                                    AND  a.year_id = '".$year_id."'
                                                    AND a.app_month = '".$otdata_month."'
                                                    AND a.app_status = '1' 
                                                    ORDER BY a.app_month DESC, a.app_type_id) 
                    AND approval_group.dept_id='".$_SESSION["deptid"]."'                     
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name";
        }

        // echo $sql."<br>";

        $query = $conn->query($sql);
        $i=1;
        while($row = $query->fetch_assoc()){
            //$timein = explode(":", $row["time_in"]);
            $sqltime = "SELECT time_in FROM approval_emp_ot 
                        WHERE app_id = '".$row["app_id"]."' 
                        AND emp_id = '".$row["emp_id"]."' 
                        AND ot_date = '".$row["ot_date"]."'";
            $querytime = $conn->query($sqltime); 
            $rowtime = $querytime->fetch_assoc();
            $timein = explode(":", $rowtime["time_in"]);

            if($timein[0]>=16){
                $contents .= '
                <tr>                
                    <td width="4%" align="center">'.$i.'</td>
                    <td width="15%">'.$row["titlename"].$row["firstname"].' '.$row["lastname"].'</td>                
                    <td width="8%" align="center">'.DateShortThai($row['ot_date']).'</td>
                    <td width="6%" align="center">-</td>
                    <td width="6%" align="center">-</td>
                    <td width="6%" align="center">-</td>
                    <td width="6%" align="center">-</td>
                    <td width="6%" align="center">'.substr($row["ot2_in"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_form_in"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_out"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_form_out"],0,5).'</td>
                    <td width="6%" align="center">'.$row["num_hr"].'</td>
                    <td width="6%" align="center">'.$row["num_min"].'</td>
                    <td width="7%" align="right">'.number_format($row["ot_amount"],2).'</td>
                    <td width="7%">&nbsp;</td>		
                </tr>
                ';
            }else{
                $contents .= '
                <tr>                
                    <td width="4%" align="center">'.$i.'</td>
                    <td width="15%">'.$row["titlename"].$row["firstname"].' '.$row["lastname"].'</td>                
                    <td width="8%" align="center">'.DateShortThai($row['ot_date']).'</td>
                    <td width="6%" align="center">'.substr($row["ot1_in"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot1_form_in"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot1_out"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot1_form_out"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_in"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_form_in"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_out"],0,5).'</td>
                    <td width="6%" align="center">'.substr($row["ot2_form_out"],0,5).'</td>
                    <td width="6%" align="center">'.$row["num_hr"].'</td>
                    <td width="6%" align="center">'.$row["num_min"].'</td>
                    <td width="7%" align="right">'.number_format($row["ot_amount"],2).'</td>
                    <td width="7%">&nbsp;</td>		
                </tr>
                ';
            }

            $i++;
        }
        return $contents;
    }
    
    function sumOTAmount($id,$year_id,$otdata_month,$conn){
        $sumamount = 0;
            
        if($_SESSION["deptid"]=='99'){
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name  
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                                   
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name ";
        }else{
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name  
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                       
                    AND otdata_time_cal.app_id IN (SELECT DISTINCT a.app_id
                                                    FROM approval a                           
                                                    WHERE a.dept_id = '".$_SESSION["deptid"]."'
                                                    AND  a.year_id = '".$year_id."'
                                                    AND a.app_month = '".$otdata_month."'
                                                    AND a.app_status = '1' 
                                                    ORDER BY a.app_month DESC, a.app_type_id) 
                    AND approval_group.dept_id='".$_SESSION["deptid"]."'                     
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name";
        }

        // echo $sql."<br>";

        $query = $conn->query($sql);
        $i=1;
        while($row = $query->fetch_assoc()){
            $sumamount += $row["ot_amount"];            
            $i++;
        }
        return $sumamount;
    }

    function sumOTHour($id,$year_id,$otdata_month,$conn){
        $sumhour = 0;
            
        if($_SESSION["deptid"]=='99'){
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name  
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                                   
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name ";
        }else{
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name  
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                       
                    AND otdata_time_cal.app_id IN (SELECT DISTINCT a.app_id
                                                    FROM approval a                           
                                                    WHERE a.dept_id = '".$_SESSION["deptid"]."'
                                                    AND  a.year_id = '".$year_id."'
                                                    AND a.app_month = '".$otdata_month."'
                                                    AND a.app_status = '1' 
                                                    ORDER BY a.app_month DESC, a.app_type_id) 
                    AND approval_group.dept_id='".$_SESSION["deptid"]."'                     
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name";
        }

        // echo $sql."<br>";

        $query = $conn->query($sql);
        $i=1;
        while($row = $query->fetch_assoc()){
            $sumhour += $row["num_hr"];            
            $i++;
        }
        return $sumhour;
    }

    function sumOTMin($id,$year_id,$otdata_month,$conn){
        $summin = 0;
            
        if($_SESSION["deptid"]=='99'){
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name  
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                                   
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name ";
        }else{
            $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    department.dept_name AS dept_name, otrate.otrate_name  
                    FROM otdata_time_cal
                    LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                    LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id
                    WHERE otdata_time_cal.otdata_id =".$id." AND otdata_time_cal.ot_amount > 0                       
                    AND otdata_time_cal.app_id IN (SELECT DISTINCT a.app_id
                                                    FROM approval a                           
                                                    WHERE a.dept_id = '".$_SESSION["deptid"]."'
                                                    AND  a.year_id = '".$year_id."'
                                                    AND a.app_month = '".$otdata_month."'
                                                    AND a.app_status = '1' 
                                                    ORDER BY a.app_month DESC, a.app_type_id) 
                    AND approval_group.dept_id='".$_SESSION["deptid"]."'                     
                    ORDER BY CONVERT(dept_name USING tis620), 
                    CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    otdata_time_cal.ot_date, otrate.otrate_name";
        }

        // echo $sql."<br>";

        $query = $conn->query($sql);
        $i=1;
        while($row = $query->fetch_assoc()){
            $summin += $row["num_min"];            
            $i++;
        }
        return $summin;
    }

       
	// $range = $_POST['date_range'];
	// $ex = explode(' - ', $range);
	// $from = date('Y-m-d', strtotime($ex[0]));
	// $to = date('Y-m-d', strtotime($ex[1]));

	// $sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    // $query = $conn->query($sql);
   	// $drow = $query->fetch_assoc();
    // $deduction = $drow['total_amount'];

	// $from_title = date('M d, Y', strtotime($ex[0]));
	// $to_title = date('M d, Y', strtotime($ex[1]));
    /////////////////////////////////////////////////////////////////////////////////////////
	require_once('../tcpdf/tcpdf.php');  
    // $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    // $pdf->SetTitle('Approval Form: '.$from_title.' - '.$to_title);  
    $pdf->SetTitle('OT Calculate Form: '.$otdata_month);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('thsarabun');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('thsarabun', '', 13);  
    $pdf->AddPage();  
    ////////////////////////////////////////////////////////////////////////////////////////
    
    $content = '';  
    // $content .= '
    //   	<h2 align="center">แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลาราชการปกติ</h2>
    //   	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
    //   	<table border="1" cellspacing="0" cellpadding="3">  
    //        <tr>  
    //        		<th width="40%" align="center"><b>Employee Name</b></th>
    //             <th width="30%" align="center"><b>Employee ID</b></th>
    // 			<th width="30%" align="center"><b>Net Pay</b></th> 
    //        </tr>  
    //   ';

    // $content .= '
    // <h2 align="center">บัญชีลงเวลาปฏิบัติงานนอกเวลาราชการ</h2>
    // <h3 align="center">('.$app_type_name.')</h3>    
    // ';

    $content .= '
    <h2 align="center">หลักฐานการเบิกจ่ายเงินตอบแทนการปฏิบัติงานนอกเวลาราชการ</h2>
    <h3 align="center">ส่วนราชการ '.$dept_name.' ประจำเดือน '.$head_ot_month.' </h3>    
    ';     
    
    // $content .= '
    //     <table border="1" cellspacing="0" cellpadding="3">
            // <tr>
            //     <th width="5%">#</th>
            //     <th width="15%">Name</th>
            //     <th width="15%">Position</th>
            //     <th width="20%">Date</th>                  
            //     <th width="25%">Reponsibility</th>                 
            // <tr>
    //         ';    
    // $content .= generateRow($app_id, $conn);

    // $content .= '      
    // <table border="1" cellspacing="0" cellpadding="3">
    // <thead>  
    // <tr>         
    //     <th width="4%" align="center" bgcolor="#c9c9c9"><b>ลำดับ</b></th>    
    //     <th width="13%" align="center" bgcolor="#c9c9c9"><b>ชื่อ – สกุล</b></th>
    //     <th width="12%" align="center" bgcolor="#c9c9c9"><b>หน่วยงาน</b></th>
    //     <th width="8%" align="center" bgcolor="#c9c9c9"><b>วันที่ปฏิบัติงาน</b></th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>เข้า (เช้า)</br></th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>เข้า (เช้า)</b></th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>ออก</b> (เช้า)</th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>ออก</b> (เช้า)</th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>เข้า (บ่าย)</b></th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>เข้า (บ่าย)</b></th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>ออก</b> (บ่าย)</th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>ออก</b> (บ่าย)</th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>จำนวน (ชั่วโมง)</b></th>
    //     <th width="5%" align="center" bgcolor="#c9c9c9"><b>จำนวน (นาที)</b></th>
    //     <th width="7%" align="center" bgcolor="#c9c9c9"><b>ค่าล่วงเวลา<br>(บาท)</b></th>
    //     <th width="6%" align="center" bgcolor="#c9c9c9"><b>ลายมือชื่อผู้รับเงิน</b></th>   
    // </tr>
    // </thead>
    // <tbody>      
    // ';

    $content .= '      
    <table border="1" cellspacing="0" cellpadding="3">
    <thead>  
    <tr>         
        <th width="4%" align="center" bgcolor="#c9c9c9"><b>ลำดับ</b></th>    
        <th width="15%" align="center" bgcolor="#c9c9c9"><b>ชื่อ – สกุล</b></th>        
        <th width="8%" align="center" bgcolor="#c9c9c9"><b>วันที่ปฏิบัติงาน</b></th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>เข้า (เช้า)</br></th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>เข้า (เช้า)</b></th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>ออก</b> (เช้า)</th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>ออก</b> (เช้า)</th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>เข้า (บ่าย)</b></th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>เข้า (บ่าย)</b></th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>สแกน<br>ออก</b> (บ่าย)</th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>อนุมัติ<br>ออก</b> (บ่าย)</th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>จำนวน (ชั่วโมง)</b></th>
        <th width="6%" align="center" bgcolor="#c9c9c9"><b>จำนวน (นาที)</b></th>
        <th width="7%" align="center" bgcolor="#c9c9c9"><b>ค่าล่วงเวลา<br>(บาท)</b></th>
        <th width="7%" align="center" bgcolor="#c9c9c9"><b>ลายมือชื่อ<br>ผู้รับเงิน</b></th>   
    </tr>
    </thead>
    <tbody>      
    ';

    $content .= generateRow($otdata_id,$year_id,$otdata_month,$conn);

    $sumamount = sumOTAmount($otdata_id,$year_id,$otdata_month,$conn);

    $sumhour = sumOTHour($otdata_id,$year_id,$otdata_month,$conn);

    $summin = sumOTMin($otdata_id,$year_id,$otdata_month,$conn);
    
    $footer = '<tr>                
            <td colspan="11" align="center"><b>รวม</b></td>            
            <td width="6%" align="center">'.$sumhour.'</td>
            <td width="6%" align="center">'.$summin.'</td>
            <td width="7%" align="right">'.number_format($sumamount,2).'</td>
            <td width="7%">&nbsp;</td>		
        </tr>
    ';
    $content .= $footer.'</tbody></table><br><br>';

    // $content .= '</tbody></table><br><br>';

    $pdf->writeHTML($content);

    $strSumAmount = num2wordsThai(sumOTAmount($otdata_id,$year_id,$otdata_month,$conn));

    $y = $pdf->GetY();

    if($y > 150){
        $pdf->AddPage();
        $y = 10;    
    }

    $content2 = '';
    $content2 .= '
    <h4>รวมเงินจ่ายทั้งสิ้น (ตัวอักษร) <u>'.$strSumAmount.'บาทถ้วน</u></h4>
    <h4>ขอรับรองว่า ผู้มีรายชื่อข้างต้นปฏิบัติงานนอกเวลาจริง</h4>     
    <h4></h4>';  

    $otsignature = '
    <table border="0" cellspacing="0" cellpadding="3">
        <tr>
            <td width="10%" align="right">ลงชื่อ </td>    
            <td width="20%" align="center"> ____________________________  </td>
            <td width="10%">หัวหน้าผู้ควบคุม</td>
            <td width="20%"></td>
            <td width="10%" align="right">ลงชื่อ </td>    
            <td width="20%" align="center"> ____________________________  </td>
            <td width="10%">ผู้จ่ายเงิน</td>                       
        </tr>    
        <tr>
            <td width="10%"></td>
            <td width="20%" align="center">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
            <td width="10%"></td>
            <td width="20%"></td>
            <td width="10%" align="center"></td>
            <td width="20%" align="center"></td>
            <td width="10%" align="center"></td>            
        </tr>           
    </table>
    ';

    $content2 .= $otsignature;


    
    $pdf->writeHTML($content2);
    
    $pdf->Output($filename, 'I');    
?>