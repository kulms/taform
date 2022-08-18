<?php
    include 'includes/session.php';
    include 'includes/functions.php';
    
    $app_id = $_GET["appid"];
    $sql = "SELECT a.*, y.year_name, d.dept_name, appt.app_type_name 
            FROM approval a
            LEFT JOIN years y ON y.year_id=a.year_id 
            LEFT JOIN department d ON d.dept_id=a.dept_id 
            LEFT JOIN app_type appt ON appt.app_type_id=a.app_type_id 
            WHERE app_id = '$app_id'
            ;";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $app_date = DateThai($row["app_date"]);
    $app_month = MonthThai($row["app_month"])." ".$row["year_name"];

    $today = date("YmdHis");

    $filename = "approval_form_".$today.".pdf";

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
    function generateRow($id,$conn){
        $contents = '';
            
        $sql = "SELECT *, employees.id AS empid, approval_emp.app_emp_id AS appeid
                FROM approval_emp
                LEFT JOIN employees ON employees.id=approval_emp.emp_id
                LEFT JOIN position ON position.id=employees.position_id
                WHERE approval_emp.app_id=$id
                ;";
        $query = $conn->query($sql);
        $i=1;
        while($row = $query->fetch_assoc()){
            $sqlot = "SELECT DAY(ot_date) AS otDay, MONTH(ot_date) AS otMonth, YEAR(ot_date) AS otYear 
                    FROM approval_emp_ot, approval_emp                                                                
                    WHERE approval_emp_ot.app_emp_id=".$row['appeid']."
                    AND approval_emp_ot.app_id=$id
                    AND approval_emp_ot.emp_id=".$row['empid']."
                    AND approval_emp_ot.app_emp_id=approval_emp.app_emp_id
                    ;";

            $qot = $conn->query($sqlot);         
           
            $strOT="";
            $strDay="";
            $strMonth="";
            $strYear="";

            if($qot->num_rows > 0){                      
            while($rowot = $qot->fetch_assoc()){
                $strDay.=$rowot['otDay'].", ";
                $strMonth = $rowot['otMonth'];
                $strYear = $rowot['otYear'];
            }

            $strDay = substr($strDay,0,strlen($strDay)-2);
            $strMonth = MonthThai($strMonth);
            $strYear = $strYear+543;

            $strOT = $strDay." ".$strMonth." ".$strYear; 
            }else{
            $strOT="<font color='#a6a6a6'>ยังไม่ระบุวัน</font>";
            }

            $contents .= '
            <tr>                
                <td align="center">'.$i.'</td>
                <td>'.$row["titlename"].$row["firstname"].' '.$row["lastname"].'</td>
                <td>'.$row["description"].'</td>                          
                <td>'.$strOT.'</td>
                <td>'.$row["reponsibility"].'</td>				
			</tr>
            ';
            $i++;
        }
        return $contents;
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

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    // $pdf->SetTitle('Approval Form: '.$from_title.' - '.$to_title);  
    $pdf->SetTitle('Approval Form: '.$app_month);  
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
    $content .= '
      <h2 align="center">แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลาราชการ</h2>
      <h3 align="center">('.$row["app_type_name"].')</h3>
      <table border="0" cellspacing="0" cellpadding="3">  
       <tr>  
        <td width="12%" class="th-left-color"><b>ส่วนงาน</b></td>
        <td colspan="3">'.$row["app_detail"].'</td>
       </tr>  
       <tr>  
        <td width="12%" class="th-left-color"><b>เลขที่หนังสือ</b></td>
        <td width="38%">'.$row["app_doc_no"].'</td>
        <td width="12%" class="th-left-color"><b>วันที่เอกสาร</b></td>
        <td width="38%">'.$app_date.'</td>  
       </tr>
       <tr>  
        <td class="th-left-color"><b>เรื่อง</b></td>
        <td colspan="3">'.$row["app_name"].'</td>        
       </tr>
       <tr>  
        <td class="th-left-color"><img src="../images/number-one-md.png" height="12" width="12"> <b>เรียน</b></td>
        <td colspan="3">หัวหน้าสำนักงานเลขานุการ</td>        
       </tr>
    ';    
    //$content .= generateRow($from, $to, $conn, $deduction);  
    $content .= '</table>';  

    $content .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วย'.$row["dept_name"].' มีความจำเป็นต้องให้พนักงานปฏิบัติงานนอกเวลาราชการ ในเดือน'.$app_month.' ดังรายนามต่อไปนี้ <br><br>';    

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
    $content .= '      
      <table border="1" cellspacing="0" cellpadding="3">  
       <tr>  
        <td width="5%" align="center" bgcolor="#c9c9c9"><b>ที่</b></td>
        <td width="25%" align="center" bgcolor="#c9c9c9"><b>ชื่อ – สกุล</b></td>
        <td width="20%" align="center" bgcolor="#c9c9c9"><b>ตำแหน่ง</b></td>
        <td width="20%" align="center" bgcolor="#c9c9c9"><b>วันที่</b></td>
        <td width="30%" align="center" bgcolor="#c9c9c9"><b>งานที่ปฏิบัติ</b></td>
       </tr>      
    '; 
    $content .= generateRow($app_id, $conn);
    $content .= '</table><br><br>';

    $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการนี้ขอเบิกค่าตอบแทนการปฏิบัติงานนอกเวลาราชการจากเงินงบประมาณหมวดค่าตอบแทนเงินรายได้<br>';    
    $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คณะวิศวกรรมศาสตร์ วงเงินไม่เกิน '.number_format($row["budget"],2).' บาท ('.num2wordsThai(substr($row["budget"],0,strlen($row["budget"])-3)).'บาทถ้วน)<br><br>';
    $content .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นชอบโปรดเสนอคณบดีอนุมัติหลักการต่อไป<br><br>';

    $content .= '      
      <table border="0" cellspacing="0" cellpadding="3">  
       <tr>  
        <td width="45%">
            <img src="../images/number-two-md.png" height="12" width="12">
            <table border="1" cellspacing="0" cellpadding="3">
            <tr>
            <td>
             เห็นชอบ/มอบงานคลังฯ <br><br><br> ลงนาม.................................... <br> ตำแหน่ง หัวหน้าสำนักงานเลขานุการ <br> วันที่....................................
            </td>
            </tr>
            </table>
        </td>
        <td width="10%"></td>
        <td width="45%" align="center">
        <br><br><br> ลงนาม.................................... <br> ('.$row["app_head"].') <br> ตำแหน่ง '.$row["app_head_position"].'
        </td>        
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
       </tr> 
       <tr>  
        <td>
        <img src="../images/number-four-md.png" height="12" width="12"><br>
             อนุมัติ <br><br><br> (รศ.ดร.พัชราภรณ์ ญาณภิรัต) <br> รองคณบดีฝ่ายวางแผนพัฒนา ปฏิบัติหน้าที่แทน <br> รักษาการแทนคณบดีคณะวิศวกรรมศาสตร์ <br> วันที่....................................... 
        </td>
        <td></td>
        <td>
        <img src="../images/number-three-md.png" height="12" width="12"><br>
        กันเงินเลขที่ ....................................... <br>&nbsp; หมวด ค่าตอบแทนเงินรายได้คณะ <br>&nbsp; หน่วยงาน  คณะวิศวกรรมศาสตร์ <br> &nbsp;จำนวนเงิน ....................................... <br> จนท. การเงินคณะ  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  หัวหน้าสำนักงานเลขานุการ  <br>
        วันที่..........................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่..........................
        </td>        
       </tr> 
      <table>       
    '; 

    $pdf->writeHTML($content);  
    //$pdf->Output('approval_form.pdf', 'I');
    $pdf->Output($filename, 'I');    
?>