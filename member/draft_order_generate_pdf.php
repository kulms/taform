<?php
    include 'includes/session.php';
    include 'includes/functions.php';
    
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
    
    $sql = "SELECT a.*, DATE_FORMAT(a.create_date, '%c') AS aMonth, DATE_FORMAT(a.create_date, '%Y') AS aYear, f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name 
            FROM approval a
            LEFT JOIN ta_dept d ON d.dept_id=a.dept_id 
            LEFT JOIN fiscal f ON f.fiscal_id=a.fiscal_id 
            LEFT JOIN ta_sem s ON s.sem_id=a.sem_id
            WHERE a.fiscal_id = '$fiscal_id'
            AND a.sem_id = '$sem_id'
            AND a.app_times = '$app_times'
            ;";

    $query = $conn->query($sql);
    // $row = $query->fetch_assoc();

    // $app_date = DateThai($row["app_date"]);
    // $app_month = MonthThai($row["app_month"])." ".$row["year_name"];
    
    // $aYear = $row["aYear"]+543;
    
    $today = date("YmdHis");

    $filename = "draft_order_".$today.".pdf";

    // $app_type_name = $row["app_type_name"];

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
            
    //     $sql = "SELECT *, employees.id AS empid, approval_emp.app_emp_id AS appeid
    //             FROM approval_emp
    //             LEFT JOIN employees ON employees.id=approval_emp.emp_id
    //             LEFT JOIN position ON position.id=employees.position_id
    //             WHERE approval_emp.app_id=$id
    //             ;";
    //     $query = $conn->query($sql);
    //     $i=1;
    //     while($row = $query->fetch_assoc()){
    //         $sqlot = "SELECT DAY(ot_date) AS otDay, MONTH(ot_date) AS otMonth, YEAR(ot_date) AS otYear 
    //                 FROM approval_emp_ot, approval_emp                                                                
    //                 WHERE approval_emp_ot.app_emp_id=".$row['appeid']."
    //                 AND approval_emp_ot.app_id=$id
    //                 AND approval_emp_ot.emp_id=".$row['empid']."
    //                 AND approval_emp_ot.app_emp_id=approval_emp.app_emp_id
    //                 ;";

    //         $qot = $conn->query($sqlot);         
           
    //         $strOT="";
    //         $strDay="";
    //         $strMonth="";
    //         $strYear="";

    //         if($qot->num_rows > 0){                      
    //         while($rowot = $qot->fetch_assoc()){
    //             $strDay.=$rowot['otDay'].", ";
    //             $strMonth = $rowot['otMonth'];
    //             $strYear = $rowot['otYear'];
    //         }

    //         $strDay = substr($strDay,0,strlen($strDay)-2);
    //         $strMonth = MonthThai($strMonth);
    //         $strYear = $strYear+543;

    //         $strOT = $strDay." ".$strMonth." ".$strYear; 
    //         }else{
    //         $strOT="<font color='#a6a6a6'>ยังไม่ระบุวัน</font>";
    //         }

    //         $contents .= '
    //         <tr>                
    //             <td align="center">'.$i.'</td>
    //             <td>'.$row["titlename"].$row["firstname"].' '.$row["lastname"].'</td>
    //             <td>'.$row["description"].'</td>                          
    //             <td>'.$strOT.'</td>
    //             <td>'.$row["reponsibility"].'</td>				
	// 		</tr>
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
    
    function _conversion($val,$unitCV){
        $unitCV=strtolower($unitCV);
        $arrFactor=array(
        "px-cm"=>0.02645833,"px-mm"=>0.264583,"px-in"=>0.01041667,"px-pt"=>0.75,
        "cm-px"=>37.795276,"cm-mm"=>10,"cm-in"=>0.393701,"cm-pt"=>28.346457,
        "mm-cm"=>0.1,"mm-px"=>3.779528,"mm-in"=>0.03937008,"mm-pt"=>2.834646,
        "in-cm"=>2.54,"in-mm"=>25.4,"in-px"=>96,"in-pt"=>72,
        "pt-cm"=>0.03527778,"pt-mm"=>0.352778,"pt-in"=>0.01388889,"pt-px"=>1.333333,
        );
        return $val * $arrFactor[$unitCV];
    }

    // $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    // $pdf->SetCreator(PDF_CREATOR);  
    // // $pdf->SetTitle('Approval Form: '.$from_title.' - '.$to_title);  
    // // $pdf->SetTitle('Approval Form: '.$app_month);  
    // $pdf->SetTitle('Approval Form: '.$today);    
    // $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    // $pdf->SetDefaultMonospacedFont('thsarabun');  
    // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    // $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    // $pdf->setPrintHeader(false);  
    // $pdf->setPrintFooter(false);  
    // // $pdf->SetAutoPageBreak(TRUE, 10);  
    // // กำหนดตัวแปรค่าคงที่การชิดขอบด้านล่างของเนื้อหา
    // define('MYPDF_MARGIN_BOTTOM',_conversion(0.25,'cm-mm'));
    // // กำหนดแบ่่งหน้าอัตโนมัติ
    // $pdf->SetAutoPageBreak(TRUE, MYPDF_MARGIN_BOTTOM);
    // // $pdf->SetAutoPageBreak(TRUE, 10); 
    // $pdf->SetFont('thsarabun', '', 13);  
    // $pdf->AddPage();  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    // $pdf->SetTitle('Approval Form: '.$from_title.' - '.$to_title);  
    // $pdf->SetTitle('Approval Form: '.$app_month);  
    $pdf->SetTitle('Request Form: '.$today);  
    
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('thsarabun');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    // $pdf->SetAutoPageBreak(TRUE, 10);  
    // กำหนดตัวแปรค่าคงที่การชิดขอบด้านล่างของเนื้อหา
    define('MYPDF_MARGIN_BOTTOM',_conversion(0.25,'cm-mm'));
    // กำหนดแบ่่งหน้าอัตโนมัติ
    $pdf->SetAutoPageBreak(TRUE, MYPDF_MARGIN_BOTTOM);
    // $pdf->SetAutoPageBreak(TRUE, 10); 
    $pdf->SetFont('thsarabun', '', 13);  
    $pdf->AddPage(); 
    
    // if(countRow($app_id,$conn)>12){
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
        // $content .= '<table border="0" cellspacing="0" cellpadding="0">  
        // <tr>  
        //     <td width="100%" align="right" style="font-size:10px;">บันทึกแบบขออนุมัติโดย: '.$row["firstname"].' '.$row["lastname"].'</td>
        // </tr>
        // </table>
        // ';

        $content .= '<table border="0" cellspacing="0" cellpadding="0">  
        <tr>  
            <td width="100%" align="center"><img src="../images/logo_ku_resize.jpg" height="60" width="60"></td>            
        </tr>
        <tr>              
            <td width="100%" align="center"><h4 align="center">คำสั่งคณะวิศวกรรมศาสตร์</h4></td>
        </tr>
        <tr>              
            <td width="100%" align="center"><h4 align="center">ที่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/'.$fiscal_name.' </h4></td>
        </tr>
        <tr>              
            <td width="100%" align="center"><h4 align="center">เรื่อง แต่งตั้งผู้ช่วยสอนประจำ'.$sem_name.' ปีการศึกษา '.$fiscal_name.'</h4></td>
        </tr>
        <tr>              
            <td width="100%" align="center">................................</td>
        </tr>
        </table>
        <br>
        ';
        
        $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $content .= 'เพื่อให้การเรียนการสอนของคณะวิศวกรรมศาสตร์ ดำเนินไปด้วยความเรียบร้อย และบรรลุวัตถุประสงค์ ที่ได้วางไว้ คณะวิศวกรรมศาสตร์<br>';
        $content .= 'จึงแต่งตั้งผู้ช่วยสอนของภาควิชาต่างๆ ประจำ'.$sem_name.' ปีการศึกษา '.$fiscal_name.' ดังนี้<br>';

        // $content .= '
        // <table border="0" cellspacing="0" cellpadding="3">  
        // <tr>  
        //     <td width="12%" class="th-left-color"><b>ส่วนงาน</b></td>
        //     <td colspan="3">'.$row["app_detail"].'</td>
        // </tr>  
        // <tr>  
        //     <td width="12%" class="th-left-color"><b>ที่</b></td>
        //     <td width="38%">'.$row["app_doc_no"].'</td>
        //     <td width="12%" class="th-left-color"><b>วันที่</b></td>
        //     <td width="38%">'.$app_date.'</td>  
        // </tr>
        // <tr>  
        //     <td class="th-left-color"><b>เรื่อง</b></td>
        //     <td colspan="3">'.$row["app_name"].'</td>        
        // </tr>
        // <tr>  
        //     <td class="th-left-color"><b>เรียน</b></td>
        //     <td colspan="3">หัวหน้าสำนักงานเลขานุการ</td>        
        // </tr>
        // ';    
        // //$content .= generateRow($from, $to, $conn, $deduction);  
        // $content .= '</table>';  

        // $content .= '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย'.$row["dept_name"].' มีความจำเป็นต้องให้พนักงานปฏิบัติงานนอกเวลาราชการ ในเดือน'.$app_month.' ดังรายนามต่อไปนี้ <br><br>';    

        // // $content .= '
        // //     <table border="1" cellspacing="0" cellpadding="3">
        //         // <tr>
        //         //     <th width="5%">#</th>
        //         //     <th width="15%">Name</th>
        //         //     <th width="15%">Position</th>
        //         //     <th width="20%">Date</th>                  
        //         //     <th width="25%">Reponsibility</th>                 
        //         // <tr>
        // //         ';    
        // // $content .= generateRow($app_id, $conn);
        // $content .= '      
        // <table border="1" cellspacing="0" cellpadding="3">  
        // <tr>  
        //     <td width="5%" align="center" bgcolor="#c9c9c9"><b>ที่</b></td>
        //     <td width="25%" align="center" bgcolor="#c9c9c9"><b>ชื่อ – สกุล</b></td>
        //     <td width="20%" align="center" bgcolor="#c9c9c9"><b>ตำแหน่ง</b></td>
        //     <td width="20%" align="center" bgcolor="#c9c9c9"><b>วันที่</b></td>
        //     <td width="30%" align="center" bgcolor="#c9c9c9"><b>งานที่ปฏิบัติ</b></td>
        // </tr>      
        // '; 
        // $content .= generateRow($app_id, $conn);
        // $content .= '</table>';

        // // if(countRow($app_id,$conn)>8){
        // //     $pdf->AddPage();
        // // }
        
        $pdf->writeHTML($content);

        $content2 = '';
        $content2 .= '      
        <table border="1" cellspacing="0" cellpadding="3" style="font-size:14px;">  
        <tr>  
            <td width="5%" align="center">ลำดับ</td>
            <td width="20%" align="center">ชื่อ–สกุล</td>
            <td width="10%" align="center">นิสิตระดับ</td>
            <td width="10%" align="center">ชั้นปีที่</td>
            <td width="15%" align="center">รายวิชา</td>
            <td width="15%" align="center">หมู่เรียน</td>
            <td width="15%" align="center">จำนวนนิสิต</td>
            <td width="10%" align="center">อัตราค่าสอนบาท/เดือน</td>
        </tr>      
        '; 
        
        $content2 .= '      
        <tr>  
            <td colspan="8">ส่วนกลางคณะฯ</td>
        </tr>      
        ';

        $content2 .= '      
        <tr>  
            <td>1</td>
            <td>นายคู่บุญ ยะใหม่วงศ์</td>
            <td align="center">ปริญญาตรี</td>
            <td align="center">2</td>
            <td align="center">01200101</td>
            <td align="center">480</td>
            <td align="center">13</td>
            <td align="center">2,505</td>
        </tr>      
        ';

        $content2 .= '</table>';

        $pdf->writeHTML($content2);

        $y = $pdf->GetY();

        // if($y > 150){
        if($y > 200){    
            $pdf->AddPage();
            $y = 10;    
        }

        // $pdf->AddPage();
        // $content2 = '';
        // $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการนี้ขอเบิกค่าตอบแทนการปฏิบัติงานนอกเวลาราชการจากเงินงบประมาณหมวดค่าตอบแทนเงินรายได้<br>';    
        // $content2 .= 'คณะวิศวกรรมศาสตร์ วงเงินไม่เกิน '.number_format($row["budget"],2).' บาท ('.num2wordsThai(substr($row["budget"],0,strlen($row["budget"])-3)).'บาทถ้วน)<br><br>';
        // $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบโปรดเสนอคณบดีอนุมัติหลักการต่อไป<br><br>';

        // $content2 .= '      
        // <table border="0" cellspacing="0" cellpadding="3">  
        // <tr>  
        //     <td width="45%">                
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
        //          อนุมัติ <br><br><br> (รศ.ดร.พีรยุทธ์ ชาญเศรษฐิกุล) <br> คณบดีคณะวิศวกรรมศาสตร์ <br> วันที่....................................... 
        //     </td>
        //     <td></td>
        //     <td>            
        //     กันเงินเลขที่ ....................................... <br>&nbsp; หมวด ค่าตอบแทนเงินรายได้คณะ <br>&nbsp; หน่วยงาน  คณะวิศวกรรมศาสตร์ <br> &nbsp;จำนวนเงิน ....................................... <br> จนท. การเงินคณะ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  หัวหน้าสำนักงานเลขานุการ  <br>
        //     วันที่..........................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่..........................
        //     </td>        
        // </tr> 
        // <table>       
        // '; 
         
        // $pdf->writeHTML($content2);

    // }else{
    //     $content = '';  
    //     // $content .= '
    //     //   	<h2 align="center">แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลาราชการปกติ</h2>
    //     //   	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
    //     //   	<table border="1" cellspacing="0" cellpadding="3">  
    //     //        <tr>  
    //     //        		<th width="40%" align="center"><b>Employee Name</b></th>
    //     //             <th width="30%" align="center"><b>Employee ID</b></th>
    //     // 			<th width="30%" align="center"><b>Net Pay</b></th> 
    //     //        </tr>  
    //     //   '; 
    //     $content .= '<table border="0" cellspacing="0" cellpadding="0">  
    //     <tr>  
    //         <td width="100%" align="right" style="font-size:10px;">บันทึกแบบขออนุมัติโดย: '.$row["firstname"].' '.$row["lastname"].'</td>
    //     </tr>
    //     </table>
    //     ';

    //     $content .= '<table border="0" cellspacing="0" cellpadding="0">  
    //     <tr>  
    //         <td width="10%" rowspan="2" align="left"><img src="../images/logo_ku_resize.jpg" height="60" width="60"></td>
    //         <td width="90%" align="center"><h2 align="center">แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลาราชการ</h2></td>
    //     </tr>
    //     <tr>              
    //         <td width="90%" align="center"><h3 align="center">('.$app_type_name.')</h3></td>
    //     </tr>
    //     </table>
    //     ';

    //     $content .= '
    //     <table border="0" cellspacing="0" cellpadding="3">  
    //     <tr>  
    //         <td width="12%" class="th-left-color"><b>ส่วนงาน</b></td>
    //         <td colspan="3">'.$row["app_detail"].'</td>
    //     </tr>  
    //     <tr>  
    //         <td width="12%" class="th-left-color"><b>ที่</b></td>
    //         <td width="38%">'.$row["app_doc_no"].'</td>
    //         <td width="12%" class="th-left-color"><b>วันที่</b></td>
    //         <td width="38%">'.$app_date.'</td>  
    //     </tr>
    //     <tr>  
    //         <td class="th-left-color"><b>เรื่อง</b></td>
    //         <td colspan="3">'.$row["app_name"].'</td>        
    //     </tr>
    //     <tr>  
    //         <td class="th-left-color"><b>เรียน</b></td>
    //         <td colspan="3">หัวหน้าสำนักงานเลขานุการ</td>        
    //     </tr>
    //     ';    
    //     //$content .= generateRow($from, $to, $conn, $deduction);  
    //     $content .= '</table>';  

    //     $content .= '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย'.$row["dept_name"].' มีความจำเป็นต้องให้พนักงานปฏิบัติงานนอกเวลาราชการ ในเดือน'.$app_month.' ดังรายนามต่อไปนี้ <br><br>';    

    //     // $content .= '
    //     //     <table border="1" cellspacing="0" cellpadding="3">
    //             // <tr>
    //             //     <th width="5%">#</th>
    //             //     <th width="15%">Name</th>
    //             //     <th width="15%">Position</th>
    //             //     <th width="20%">Date</th>                  
    //             //     <th width="25%">Reponsibility</th>                 
    //             // <tr>
    //     //         ';    
    //     // $content .= generateRow($app_id, $conn);
    //     $content .= '      
    //     <table border="1" cellspacing="0" cellpadding="3">  
    //     <tr>  
    //         <td width="5%" align="center" bgcolor="#c9c9c9"><b>ที่</b></td>
    //         <td width="25%" align="center" bgcolor="#c9c9c9"><b>ชื่อ – สกุล</b></td>
    //         <td width="20%" align="center" bgcolor="#c9c9c9"><b>ตำแหน่ง</b></td>
    //         <td width="20%" align="center" bgcolor="#c9c9c9"><b>วันที่</b></td>
    //         <td width="30%" align="center" bgcolor="#c9c9c9"><b>งานที่ปฏิบัติ</b></td>
    //     </tr>      
    //     '; 
    //     $content .= generateRow($app_id, $conn);
    //     $content .= '</table>';

    //     // if(countRow($app_id,$conn)>8){
    //     //     $pdf->AddPage();
    //     // }

    //     $pdf->writeHTML($content);

    //     $y = $pdf->GetY();

    //     // if($y > 150){
    //     if($y > 200){
    //         $pdf->AddPage();
    //         $y = 10;    
    //     }    

    //     $content2 = '';
    //     $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการนี้ขอเบิกค่าตอบแทนการปฏิบัติงานนอกเวลาราชการจากเงินงบประมาณหมวดค่าตอบแทนเงินรายได้<br>';    
    //     $content2 .= 'คณะวิศวกรรมศาสตร์ วงเงินไม่เกิน '.number_format($row["budget"],2).' บาท ('.num2wordsThai(substr($row["budget"],0,strlen($row["budget"])-3)).'บาทถ้วน)<br><br>';
    //     $content2 .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบโปรดเสนอคณบดีอนุมัติหลักการต่อไป<br><br>';

    //     $content2 .= '      
    //     <table border="0" cellspacing="0" cellpadding="3">  
    //     <tr>  
    //         <td width="45%">                
    //             <table border="1" cellspacing="0" cellpadding="3">
    //             <tr>
    //             <td>
    //              เห็นชอบ/มอบงานคลังฯ <br><br><br> ลงนาม.................................... <br> ตำแหน่ง หัวหน้าสำนักงานเลขานุการ <br> วันที่....................................
    //             </td>
    //             </tr>
    //             </table>
    //         </td>
    //         <td width="10%"></td>
    //         <td width="45%" align="center">
    //         <br><br><br> ลงนาม.................................... <br> ('.$row["app_head"].') <br> ตำแหน่ง '.$row["app_head_position"].'
    //         </td>        
    //     </tr>
    //     <tr>
    //         <td>&nbsp;</td>
    //         <td>&nbsp;</td>
    //         <td>&nbsp;</td>
    //     </tr> 
    //     <tr>  
    //         <td>            
    //              อนุมัติ <br><br><br> (รศ.ดร.พีรยุทธ์ ชาญเศรษฐิกุล) <br> คณบดีคณะวิศวกรรมศาสตร์ <br> วันที่....................................... 
    //         </td>
    //         <td></td>
    //         <td>            
    //         กันเงินเลขที่ ....................................... <br>&nbsp; หมวด ค่าตอบแทนเงินรายได้คณะ <br>&nbsp; หน่วยงาน  คณะวิศวกรรมศาสตร์ <br> &nbsp;จำนวนเงิน ....................................... <br> จนท. การเงินคณะ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  หัวหน้าสำนักงานเลขานุการ  <br>
    //         วันที่..........................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่..........................
    //         </td>        
    //     </tr> 
    //     <table>       
    //     ';
    //     $pdf->writeHTML($content2);
    // }

    
    //$pdf->Output('approval_form.pdf', 'I');
    $pdf->Output($filename, 'I');    
?>