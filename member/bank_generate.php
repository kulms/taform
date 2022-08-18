<?php
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
        $sql = "SELECT DISTINCT DISTINCT otdata_time_cal.emp_id,otdata_time_cal.otdata_id,
                employees.titlename, employees.firstname, employees.lastname, employees.bank_account, 
                department.dept_name AS dept_name
                FROM otdata_time_cal
                LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    AND approval_emp_ot.emp_id=otdata_time_cal.emp_id
                LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id                                       
                WHERE otdata_time_cal.otdata_id =".$otdata_id." AND otdata_time_cal.ot_amount > 0                                   
                ORDER BY CONVERT(dept_name USING tis620), 
                CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                otdata_time_cal.ot_date, otrate.otrate_name "; 
    }

    $query = $conn->query($sql);
    // echo $sql."<br>"; 
    
    date_default_timezone_set("Asia/Bangkok");

    $datefile = date("Ymd_His");

    $dir = "../files/";						
	$fileName = $dir."bankfile_".$datefile.".txt";

    $myfile = fopen($fileName, "w") or die("Unable to open file!");
    //$txt = "John Doe\n";
    //fwrite($myfile, $txt);
    //$txt = "Jane Doe\n";
    //fwrite($myfile, $txt);
    

    $i=1;

    $ku="TXNมหาวิทยาลัยเกษตรศาสตร์";
    $space00 = str_repeat(' ',98);

    $kuaccount="00692582802";

    $today = date('dmY'); 
    //echo $today;
    
    while($row = $query->fetch_assoc()){
        //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
        
        $sqlAmount =  "SELECT SUM(ot_amount) AS otamount  FROM otdata_time_cal 
                        WHERE emp_id = '".$row['emp_id']."' AND otdata_id = '".$row['otdata_id']."';";

        $qAmount = $conn->query($sqlAmount);
        // echo $sqlAmount."<br>"; 
        
        $rowAmount = $qAmount->fetch_assoc();
        $ot_amount = $rowAmount["otamount"];

        $empname=$row['titlename'].$row['firstname']." ".$row['lastname'];
        $countemp = strlen($empname);
        $spaceemp = 356-$countemp;

        $space01 = str_repeat(' ',$spaceemp);

        // echo $spaceemp."<br>";

        $space02 = str_repeat(' ',50);
        $space03 = str_repeat(' ',9);

        $countAmount = strlen($ot_amount);
        switch($countAmount){
            case 2 :
                $txtAmount = "0000000000".$ot_amount.".000110069";
                break;
            case 3 :
                $txtAmount = "000000000".$ot_amount.".000110069";
                break;
            case 4 :
                $txtAmount = "00000000".$ot_amount.".000110069";
                break;
            case 5 :
                $txtAmount = "0000000".$ot_amount.".000110069";
                break;        
            case 6 :
                $txtAmount = "000000".$ot_amount.".000110069";
                break;
            case 7 :
                $txtAmount = "00000".$ot_amount.".000110069";
                break;
            case 8 :
                $txtAmount = "0000".$ot_amount.".000110069";
                break;
            case 9 :
                $txtAmount = "000".$ot_amount.".000110069";
                break;
            case 10 :
                $txtAmount = "00".$ot_amount.".000110069";
                break;    
            case 11 :
                $txtAmount = "0".$ot_amount.".000110069";
                break;
            case 12 :
                $txtAmount = $ot_amount.".000110069";
                break;        
        }
        $space04 = str_repeat(' ',9);

        $empaccount=$row['bank_account'];

        $space05 = str_repeat(' ',12);

        $txt00="00";

        $space06 = str_repeat(' ',77);

        $space07 = str_repeat(' ',100);  // email

        $txtben="BEN";

        $space08 = str_repeat(' ',10);

        $txtdcr="DCR";

        $space09 = str_repeat(' ',439);

        $txtend="END";

        $txt = $ku.$space00.$empname.$space01." ".$today.$today."THB".$space02.$kuaccount.$space03.$txtAmount.$space04.$empaccount.$space05.$txt00.$space06.$space07.$txtben.$space08.$txtdcr.$space09.$txtend.PHP_EOL;
                
        //===================================================

        $txtwht="WHT";

        $space10 = str_repeat(' ',13);

        $txt00_1="0000000000000";

        $space11 = str_repeat(' ',2);

        $txt00_2="000000000000.00";

        $space12 = str_repeat(' ',42);

        $txt00_3="000000000000.00000000000000.00";

        $space13 = str_repeat(' ',42);

        $txt00_4="000000000000.00";

        $space14 = str_repeat(' ',144);

        $txtku="มหาวิทยาลัยเกษตรศาสตร์                                                                                                  ";

        $txtaddress="ADDRESS";

        $txt .= $txtwht.$space10.$txt00_1.$space11.$txt00_2.$space12.$txt00_3.$space13.$txt00_4.$space14.$txtku.$txtaddress.PHP_EOL;

        fwrite($myfile, $txt);

        // echo $txt."<br>"; 

        $i++;
    }
    
    fclose($myfile);

    // set_time_limit(0); 
    // $file = file_get_contents($fileName);
    // file_put_contents('Bankfile.txt', $file);

    // $file = 'monkey.gif';

    if (file_exists($fileName)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        readfile($fileName);
        exit;
    }

    header('location: bank_cal_print.php?otdataid='.$otdata_id);

?>    