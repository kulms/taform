<?php
    include 'includes/session.php';
    include 'includes/functions.php';
    
    $app_std_id = $_GET["appsid"];
    $app_id = $_GET["appid"];
    $month_id = $_GET["month"];

    $sql = "SELECT a.*, DATE_FORMAT(a.create_date, '%c') AS aMonth, DATE_FORMAT(a.create_date, '%Y') AS aYear, f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name 
        FROM approval a
        LEFT JOIN ta_dept d ON d.dept_id=a.dept_id 
        LEFT JOIN fiscal f ON f.fiscal_id=a.fiscal_id 
        LEFT JOIN ta_sem s ON s.sem_id=a.sem_id
        WHERE a.app_id = '$app_id'
        ;";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $fiscal_name = $row["fiscal_name"];
    $sem_name = $row["sem_name"];

    $aYear = $row["aYear"]+543;

    $app_month = MonthThai($month_id);

    $sql2 = "SELECT *
            FROM approval_std_rec                            
            WHERE app_id=$app_id AND app_std_id=$app_std_id AND month_id=$month_id
            ;";
    $query2 = $conn->query($sql2);
    $row2 = $query2->fetch_assoc();
    $std_title_name = $row2["std_title_name"];
    $std_name = $row2["std_name"];
    $budget_short = number_format($row2["std_amount"],2);
    $budget_long = num2wordsThai(substr($row2["std_amount"],0,strlen($row2["std_amount"])-3));

    // $sql = "SELECT a.*, y.year_name, d.dept_name, appt.app_type_name 
    //         FROM approval a
    //         LEFT JOIN years y ON y.year_id=a.year_id 
    //         LEFT JOIN department d ON d.dept_id=a.dept_id 
    //         LEFT JOIN app_type appt ON appt.app_type_id=a.app_type_id 
    //         WHERE app_id = '$app_id'
    //         ;";
    // $query = $conn->query($sql);
    // $row = $query->fetch_assoc();

    // $app_date = DateThai($row["app_date"]);
    // $app_month = MonthThai($row["app_month"])." ".$row["year_name"];

    $today = date("YmdHis");

    // $budget_short = number_format($row["budget"],2);
    // $budget_long = num2wordsThai(substr($row["budget"],0,strlen($row["budget"])-3));

    // $app_status = $row['app_status'];
    // if($app_status==0){
    //     $strStatus = "<font color='#f39c12'>รอการอนุมัติ</font>";
    // }else{
    //     $strStatus = "<font color='#00a65a'>ผ่านการอนุมัติ</font>";
    // }
    // //echo $strStatus;

    $filename = "student_receipt_".$today.".pdf";

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
    // function generateRow($id,$conn){
    //     $contents = '';
            
    //     $sql = "SELECT employees.id AS empid, 
    //                 approval_emp_ot.app_emp_ot_id AS appeotid, 
    //                 employees.titlename,
    //                 employees.firstname,
    //                 employees.lastname,
    //                 approval_emp_ot.ot_date,
    //                 approval_emp_ot.time_in,
    //                 approval_emp_ot.time_out,
    //                 approval_emp_ot.reponsibility AS otreponsibility
    //             FROM approval_emp_ot
    //             LEFT JOIN approval ON approval.app_id=approval_emp_ot.app_id 
    //             LEFT JOIN approval_emp ON approval_emp.app_emp_id=approval_emp_ot.app_emp_id 
    //             LEFT JOIN employees ON employees.id=approval_emp_ot.emp_id 
    //             LEFT JOIN otrate ON otrate.otrate_id=approval_emp_ot.otrate_id
    //             WHERE approval_emp_ot.app_id = '".$id."'
    //             ORDER BY approval_emp_ot.ot_date, CONVERT(employees.firstname USING tis620), approval_emp_ot.time_in DESC
    //             ;";
    //     $query = $conn->query($sql);
    //     $i=1;
    //     while($row = $query->fetch_assoc()){
    //         $emp_name = $row['titlename'].$row['firstname'].' '.$row['lastname'];
    //         $ot_date = DateShortThai($row['ot_date']);
    //         $time_in = date('h:i A', strtotime($row['time_in']));
    //         $time_out = date('h:i A', strtotime($row['time_out']));
    //         $otreponsibility = $row['otreponsibility'];
    //         $contents .= '
    //         <tr>
    //             <td width="5%" align="center">'.$i.'</td>
    //             <td width="30%">'.$emp_name.'</td>
    //             <td width="10%" align="center">'.$ot_date.'</td>
    //             <td width="10%" align="center">'.$time_in.'</td>
    //             <td width="10%" align="center">'.$time_out.'</td>
    //             <td width="35%">'.$otreponsibility.'</td>
    //         </tr>
    //         ';
    //         $i++;
    //     }
    //     return $contents;
    // }	

    // function countRow($id,$conn){        
            
    //     $sql = "SELECT *, employees.id AS empid, approval_emp.app_emp_id AS appeid
    //             FROM approval_emp
    //             LEFT JOIN employees ON employees.id=approval_emp.emp_id
    //             LEFT JOIN position ON position.id=employees.position_id
    //             WHERE approval_emp.app_id=$id
    //             ;";
    //     $query = $conn->query($sql);
        
    //     if($query->num_rows>0){
    //         $row_cnt = $query->num_rows;
    //     }else{
    //         $row_cnt = 0;
    //     }
    //     return $row_cnt;
    // }    
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

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    // $pdf->SetTitle('Approval Form: '.$from_title.' - '.$to_title);  
    $pdf->SetTitle('Receipt Form: '.$app_month);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('thsarabun');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('thsarabun', '', 16);  
    $pdf->AddPage();  
        
    

    $content = '';  
    $content .= '<table border="0" cellspacing="0" cellpadding="0">  
    <tr>  
        <td width="100%" align="right" style="font-size:16px;">เขียนที่ คณะวิศวกรรมศาสตร์</td>
    </tr>
    <tr>  
        <td width="100%" align="right" style="font-size:16px;">(ส่วนราชการเป็นผู้ให้)</td>
    </tr>
    </table>
    ';

    $content .= '<table border="0" cellspacing="0" cellpadding="0">  
    <tr>              
        <td width="100%" align="center"><h2 align="center">ใบสำคัญรับเงิน</h2></td>
    </tr>        
    </table>
    <br><br>
    ';

    $content .= '<table border="0" cellspacing="0" cellpadding="0">  
    <tr>              
        <td width="100%" align="right"><h4 align="right">วันที่...........เดือน............................... พ.ศ. ................</h4></td>
    </tr>        
    </table>
    <br><br>
    ';

    $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $content .= 'ข้าพเจ้า '.$std_title_name.$std_name.'&nbsp;&nbsp;อยู่บ้านเลขที่.................หมู่ที่................ ถนน............................................<br>';
    $content .= 'ตำบล.......................................................อำเภอ.......................................................จังหวัด.......................................................<br>';
    $content .= 'ได้รับเงินจาก คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเกษตรศาสตร์ ดังรายการต่อไปนี้ <br><br>';
    
    $content .= '
        <table border="1" cellspacing="0" cellpadding="3">
        <tr>
            <th width="10%" align="center"><b>ลำดับที่</b></th>
            <th width="70%" align="center"><b>รายการ</b></th>
            <th width="20%" align="center"><b>จำนวนเงิน (บาท)</b></th> 
        </tr>
        <tr>
            <td width="10%" align="center">1.</td>
            <td width="70%">ค่าตอบแทนผู้ช่วยสอนประจำ'.$sem_name.' ปีการศึกษา '.$fiscal_name.'<br>ประจำเดือน '.$app_month.' '.$aYear.'
            <br><br><br><br><br><br><br><br><br><br>
            </td>
            <td width="20%" align="right">'.$budget_short.'</td> 
        </tr>        
        <tr>
            <td width="80%" align="right">รวมเงิน</td>
            <td width="20%" align="right">'.$budget_short.'</td> 
        </tr>
        </table>
        <br><br>
    ';
    
    $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $content .= 'จำนวนเงิน (ตัวอักษร) ('.$budget_long.'บาทถ้วน)<br><br><br><br>';

    $content .= '
        <table border="0" cellspacing="0" cellpadding="3">
        <tr>
            <td width="50%" align="center"></td>
            <td width="50%" align="center">ลงชื่อ..................................................................ผู้รับเงิน<br>( '.$std_title_name.$std_name.' )</td>
        </tr>
        <tr>
            <td width="50%" align="center"></td>
            <td width="50%" align="center"></td>
        </tr>
        <tr>
            <td width="50%" align="center"></td>
            <td width="50%" align="center"></td>
        </tr>
        <tr>
            <td width="50%" align="center"></td>
            <td width="50%" align="center">ลงชื่อ................................................................ผู้จ่ายเงิน<br>(..................................................................)<br>เจ้าหน้าที่การเงินคณะวิศวกรรมศาสตร์</td>
        </tr>
        </table>
    ';

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
    // <h3 align="center">ตารางการปฏิบัติงานนอกเวลาทำการ</h3>
    // <h3 align="center">('.$row["app_type_name"].')</h3>
    // <table border="0" cellspacing="0" cellpadding="3">  
    // <tr>  
    //     <td width="12%" class="th-left-color"><b>ส่วนงาน</b></td>
    //     <td colspan="3">'.$row["app_detail"].'</td>
    // </tr>  
    // <tr>  
    //     <td width="12%" class="th-left-color"><b>เลขที่หนังสือ</b></td>
    //     <td width="38%">'.$row["app_doc_no"].'</td>
    //     <td width="12%" class="th-left-color"><b>วันที่เอกสาร</b></td>
    //     <td width="38%">'.$app_date.'</td>  
    // </tr>
    // <tr>  
    //     <td class="th-left-color"><b>เรื่อง</b></td>
    //     <td colspan="3">'.$row["app_name"].'</td>        
    // </tr>
    // <tr>  
    //     <td class="th-left-color"><img src="../images/number-one-md.png" height="12" width="12"> <b>เรียน</b></td>
    //     <td colspan="3">หัวหน้าสำนักงานเลขานุการ</td>        
    // </tr>
    // ';
    
    // $content .= '
    // <h3 align="center">ตารางการปฏิบัติงานนอกเวลาทำการ</h3>
    // <table border="0" cellspacing="0" cellpadding="3">  
    //     <tr>
    //         <td width="15%" class="th-left-color">ส่วนงาน</td>
    //         <td width="30%">'.$row["app_detail"].'</td>                  
    //         <td width="15%" class="th-left-color">เลขที่หนังสือ</td>
    //         <td width="40%">'.$row["app_doc_no"].'</td>
    //     </tr>                                                
    //     <tr>
    //         <td class="th-left-color">วันที่สร้างเอกสาร</td>
    //         <td>'.$app_date.'</td>                  
    //         <td class="th-left-color">เดือนที่ขออนุมัติ</td>
    //         <td>'.$app_month.'</td>                  
    //     </tr>                
    //     <tr>
    //         <td class="th-left-color">ชื่อหัวหน้างาน</td>
    //         <td>('.$row["app_head"].')</td>                                  
    //         <td class="th-left-color">ตำแหน่งหัวหน้างาน</td>
    //         <td>ตำแหน่ง '.$row["app_head_position"].'</td>                  
    //     </tr>                
    //     <tr>
    //         <td class="th-left-color">วงเงิน (ตัวเลข)</td>
    //         <td>'.$budget_short.' บาท</td>                                  
    //         <td class="th-left-color">วงเงิน (ตัวอักษร)</td>
    //         <td>( '.$budget_long.'บาทถ้วน )</td>                  
    //     </tr>
    //     <tr>
    //         <td class="th-left-color">สถานะ</td>
    //         <td>'.$strStatus.'</td>     
    //         <td></td>
    //         <td></td>                             
    //     </tr>
    // </table>
    // ';
    // // $content .= '
    // // <h3 align="center">ตารางการปฏิบัติงานนอกเวลาทำการ</h3>
    // // ';
    
    // //$content .= generateRow($from, $to, $conn, $deduction);  
    // //$content .= '</table>';  

    // $content .= '      
    // <table border="1" cellspacing="0" cellpadding="3">  
    //     <thead>
    //     <tr>  
    //         <th width="5%" align="center" bgcolor="#c9c9c9"><b>#</b></th>
    //         <th width="30%" align="center" bgcolor="#c9c9c9"><b>ชื่อ – สกุล</b></th>
    //         <th width="10%" align="center" bgcolor="#c9c9c9"><b>วันที่</b></th>
    //         <th width="10%" align="center" bgcolor="#c9c9c9"><b>เวลาเริ่มต้น</b></th>
    //         <th width="10%" align="center" bgcolor="#c9c9c9"><b>เวลาสิ้นสุด</b></th>
    //         <th width="35%" align="center" bgcolor="#c9c9c9"><b>งานที่ปฏิบัติ</b></th>
    //     </tr>
    //     </thead>
    //     <tbody>                    
    // '; 
    
    // $content .= generateRow($app_id, $conn);
    // $content .= '</tbody></table><br><br>';
    
    $pdf->writeHTML($content);

    // $y = $pdf->GetY();

    // if($y > 150){
    //     $pdf->AddPage();
    //     $y = 10;    
    // }

    // // $pdf->AddPage();
    // $content2 = '';
    // $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการนี้ขอเบิกค่าตอบแทนการปฏิบัติงานนอกเวลาราชการจากเงินงบประมาณหมวดค่าตอบแทนเงินรายได้<br>';    
    // $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คณะวิศวกรรมศาสตร์ วงเงินไม่เกิน '.number_format($row["budget"],2).' บาท ('.num2wordsThai(substr($row["budget"],0,strlen($row["budget"])-3)).'บาทถ้วน)<br><br>';
    // $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบโปรดเสนอคณบดีอนุมัติหลักการต่อไป<br><br>';

    // $content2 .= '      
    // <table border="0" cellspacing="0" cellpadding="3">  
    // <tr>  
    //     <td width="45%">
    //         <img src="../images/number-two-md.png" height="12" width="12">
    //         <table border="1" cellspacing="0" cellpadding="3">
    //         <tr>
    //         <td>
    //          เห็นชอบ/มอบงานคลังฯ <br><br><br> ลงนาม.................................... <br> ตำแหน่ง หัวหน้าสำนักงานเลขานุการ <br> วันที่....................................
    //         </td>
    //         </tr>
    //         </table>
    //     </td>
    //     <td width="10%"></td>
    //     <td width="45%" align="center">
    //     <br><br><br> ลงนาม.................................... <br> ('.$row["app_head"].') <br> ตำแหน่ง '.$row["app_head_position"].'
    //     </td>        
    // </tr>
    // <tr>
    //     <td>&nbsp;</td>
    //     <td>&nbsp;</td>
    //     <td>&nbsp;</td>
    // </tr> 
    // <tr>  
    //     <td>
    //     <img src="../images/number-four-md.png" height="12" width="12"><br>
    //          อนุมัติ <br><br><br> (รศ.ดร.พีรยุทธ์ ชาญเศรษฐิกุล) <br> คณบดีคณะวิศวกรรมศาสตร์ <br> วันที่....................................... 
    //     </td>
    //     <td></td>
    //     <td>
    //     <img src="../images/number-three-md.png" height="12" width="12"><br>
    //     กันเงินเลขที่ ....................................... <br>&nbsp; หมวด ค่าตอบแทนเงินรายได้คณะ <br>&nbsp; หน่วยงาน  คณะวิศวกรรมศาสตร์ <br> &nbsp;จำนวนเงิน ....................................... <br> จนท. การเงินคณะ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  หัวหน้าสำนักงานเลขานุการ  <br>
    //     วันที่..........................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่..........................
    //     </td>        
    // </tr> 
    // <table>       
    // '; 
        
    // $pdf->writeHTML($content2);
    
    //$pdf->Output('approval_form.pdf', 'I');
    $pdf->Output($filename, 'I');    
?>