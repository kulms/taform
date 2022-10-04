<?php   
function num2wordsThai($num){   
    $num=str_replace(",","",$num);
    $num_decimal=explode(".",$num);
    $num=$num_decimal[0];
    $returnNumWord="";   
    $lenNumber=strlen($num);   
    $lenNumber2=$lenNumber-1;   
    $kaGroup=array("","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน");   
    $kaDigit=array("","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");   
    $kaDigitDecimal=array("ศูนย์","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");   
    $ii=0;   
    for($i=$lenNumber2;$i>=0;$i--){   
        $kaNumWord[$i]=substr($num,$ii,1);   
        $ii++;   
    }   
    $ii=0;   
    for($i=$lenNumber2;$i>=0;$i--){   
        if(($kaNumWord[$i]==2 && $i==1) || ($kaNumWord[$i]==2 && $i==7)){   
            $kaDigit[$kaNumWord[$i]]="ยี่";   
        }else{   
            if($kaNumWord[$i]==2){   
                $kaDigit[$kaNumWord[$i]]="สอง";        
            }   
            if(($kaNumWord[$i]==1 && $i<=2 && $i==0) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==6)){   
                if($kaNumWord[$i+1]==0){   
                    $kaDigit[$kaNumWord[$i]]="หนึ่ง";      
                }else{   
                    $kaDigit[$kaNumWord[$i]]="เอ็ด";       
                }   
            }elseif(($kaNumWord[$i]==1 && $i<=2 && $i==1) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==7)){   
                $kaDigit[$kaNumWord[$i]]="";   
            }else{   
                if($kaNumWord[$i]==1){   
                    $kaDigit[$kaNumWord[$i]]="หนึ่ง";   
                }   
            }   
        }   
        if($kaNumWord[$i]==0){   
            if($i!=6){
                $kaGroup[$i]="";   
            }
        }   
        $kaNumWord[$i]=substr($num,$ii,1);   
        $ii++;   
        $returnNumWord.=$kaDigit[$kaNumWord[$i]].$kaGroup[$i];   
    }      
    if(isset($num_decimal[1])){
        $returnNumWord.="จุด";
        for($i=0;$i<strlen($num_decimal[1]);$i++){
                $returnNumWord.=$kaDigitDecimal[substr($num_decimal[1],$i,1)];  
        }
    }       
    return $returnNumWord;   
} 

function DateThai($strDate)
{

    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    // $strHour= date("H",strtotime($strDate));
    // $strMinute= date("i",strtotime($strDate));
    // $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

    $strMonthThai=$strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";
}

function DateShortThai($strDate)
{

    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("m",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    // $strHour= date("H",strtotime($strDate));
    // $strMinute= date("i",strtotime($strDate));
    // $strSeconds= date("s",strtotime($strDate));
    //$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

    //$strMonthThai=$strMonthCut[$strMonth];

    return "$strYear-$strMonth-$strDay";
}

function MonthThai($strMonth)
{
    $strMonthCut = Array("ทั้งหมด","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];

    return "$strMonthThai";
}

function getYearNamefromYearId($conn,$yearid) {
    $sql = "SELECT year_name
            FROM years
            WHERE year_id = '".$yearid."'                          
            ;";
    
    // echo $sql;        
    
    $query = $conn->query($sql);

    $row = $query->fetch_assoc();

    $year_name = $row["year_name"]; 

    $query->free();
  
    return $year_name;
  }

function compareDate($date1,$date2) {
    $arrDate1 = explode("-",$date1);
    $arrDate2 = explode("-",$date2);
    
    $timStmp1 = mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]);
    $timStmp2 = mktime(0,0,0,$arrDate2[1],$arrDate2[2],$arrDate2[0]);
    
    if ($timStmp1 == $timStmp2) {   
        //echo "\$date = \$date2"; 
        return 1;
    } else if ($timStmp1 > $timStmp2) {
        //echo "\$date > \$date2";
        return 0;
    } else if ($timStmp1 < $timStmp2) {
        //echo "\$date < \$date2";
        return 1;
    }
    
}

function base64url_encode($data) { 
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
} 

function base64url_decode($data) { 
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 

function sendRegisterEmail($appid,$data,$inputEmail3, $inputFirstname,$inputLastname){  
    // Send Mail to Applicant
    date_default_timezone_set('Asia/Bangkok');

    //require '../PHPMailerAutoload.php';
    require '../PHPMailer/PHPMailerAutoload.php';
    
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    
    $mail->CharSet="UTF-8";
    
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    
    //Set the hostname of the mail server
    //$mail->Host = 'smtp.gmail.com';
    $mail->Host = 'nontri.ku.ac.th';
    //$mail->Host = '158.108.216.19';
    //$mail->Host = gethostbyname('smtp.gmail.com');
    
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    //$mail->Port = 587;
    $mail->Port = 25;
    //$mail->Port = 993;
          
    //Set the encryption system to use - ssl (deprecated) or tls
    //$mail->SMTPSecure = 'tls';
    //$mail->SMTPSecure = 'ssl';
    
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    
    //Username to use for SMTP authentication - use full email address for gmail
    //$mail->Username = "nbtcacademy2017@gmail.com";
    $mail->Username = "fengstj@ku.ac.th";
    //$mail->Username = "suthee.j@ku.th";

    //Password to use for SMTP authentication
    //$mail->Password = "2951pupthirada";
    $mail->Password = "386Superm@n";
    
          //Set who the message is to be sent from
    //$mail->setFrom('nbtcacademy2017@gmail.com', 'NBTC Academy');
    $mail->setFrom('fengstj@ku.ac.th', 'OT-ENGINEERING');
          
    //Set an alternative reply-to address
    $mail->addReplyTo('suthee.j@ku.th', 'Suthee SaeJia');
    
    //Set who the message is to be sent to
    // $mail->addAddress($inputEmail3, $inputFirstname." ".$inputLastname);
    $mail->addAddress('suthee386@gmail.com', $inputFirstname." ".$inputLastname);
    
    //Set the subject line
    $mail->Subject = 'OT Request Undo Confirmation';
    
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    $mail->Body = "<div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;'>";
    $mail->Body .= "<h3>OT Request Undo Confirmation from ".$inputEmail3."</h3>";
    //$mail->Body .= "<p>Project Tracking System send a verification link to your email address.</p>";
    $mail->Body .= "<p>Please click the link below to unconfirm Approval Form.</p>";
    // $mail->Body .= "<div align='left'>
    //                 <a href='http://127.0.0.1/apsystem/unconfirm.php?confirm=1&appid=".$appid."'>Click here.</a>
    //                 </div>
    //                 ";
    $mail->Body .= "<div align='left'>
                    <a href='http://158.108.215.134/otsystem/unconfirm.php?confirm=1&appid=".$appid."'>Click here.</a>
                    </div>
                    ";
    $mail->Body .= "</div>";
    
    
    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
    
    //Attach an image file
    //$mail->addAttachment('images/logo_style1.png');
    
    //send the message, check for errors
    if (!$mail->send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return 0;
    } else {
        //echo "Message sent!";
        return 1;
    }
  }

  function getDeptIdfromIdCard($conn,$idcard) {
    $sql = "SELECT dept_id
            FROM employees
            WHERE employee_id = '".$idcard."'                          
            ;";
    
    // echo $sql;        
    
    $query = $conn->query($sql);

    $row = $query->fetch_assoc();

    $deptid = $row["dept_id"]; 

    $query->free();
  
    return $deptid;
  }
  
  function getEmpIdfromIdCard($conn,$idcard) {
    $sql = "SELECT id
            FROM employees
            WHERE employee_id = '".$idcard."' AND active = 1                   
            ;";
    
    // echo $sql;    
    
    $query = $conn->query($sql);
    
    $row = $query->fetch_assoc();

    $empid = $row["id"];

    $query->free();
  
    return $empid;
  }

  function getOtRateIdfromEmpDate($conn,$emp_id,$ot_date) {
    $sql = "SELECT otrate_id
            FROM approval_emp_ot
            WHERE emp_id = '".$emp_id."' AND ot_date = '".$ot_date."'                        
            ;";
    
    // echo $sql;    
    
    $query = $conn->query($sql);
    
    $row = $query->fetch_assoc();

    $otrate_id = $row["otrate_id"];

    $query->free();
  
    return $otrate_id;
  }

  function checkHolidayfromOtRateId($conn,$otrate_id) {
    $sql = "SELECT is_holiday
            FROM otrate
            WHERE otrate_id = '".$otrate_id."'                   
            ;";
    
    // echo $sql;    
    
    $query = $conn->query($sql);
    
    $row = $query->fetch_assoc();

    $is_holiday = $row["is_holiday"];

    $query->free();
  
    return $is_holiday;
  }

  function checkNoonfromOtRateId($conn,$otrate_id) {
    $sql = "SELECT cal_noon
            FROM otrate
            WHERE otrate_id = '".$otrate_id."'                   
            ;";
    
    // echo $sql;    
    
    $query = $conn->query($sql);
    
    $row = $query->fetch_assoc();

    $cal_noon = $row["cal_noon"];

    $query->free();
  
    return $cal_noon;
  }

  function countEmpOtperDay($conn,$emp_id,$ot_date) {
    $sql = "SELECT count(app_emp_ot_id) AS otperday
            FROM approval_emp_ot
            WHERE emp_id = '".$emp_id."' AND ot_date = '".$ot_date."'                
            ;";
    
    // echo $sql;    
    
    $query = $conn->query($sql);
    
    $row = $query->fetch_assoc();

    $otperday = $row["otperday"];

    $query->free();
  
    return $otperday;
  }
  
  
?>