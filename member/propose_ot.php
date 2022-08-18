<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
    $app_emp_id = $_GET["appeid"];
    $app_id = $_GET["appid"];
    $emp_id = $_GET["empid"];
    
    $sql = "SELECT a.*, y.year_name 
            FROM approval a
            LEFT JOIN years y ON y.year_id=a.year_id 
            WHERE app_id = '$app_id'
            ;";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    // print_r($_SESSION);

?>                    

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <?php include 'includes/functions.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      กำหนดรายวิชา
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="propose_form.php"> แบบฟอร์มขอเงินทุน</a></li>
        <li><a href="propose.php?appid=<?php echo $app_id;?>"> กำหนดนิสิต</a></li>
        <li class="active">กำหนดรายวิชา</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
          <!-- <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Warning!</h4>
              ไม่สามารถบันทึกข้อมูลวันที่ 2562-10-15 ได้ <br>
              เนื่องจากเจ้าหน้าที่ได้ขออนุมัติหลักการในวันดังกล่าวไปแล้วกับหน่วยงาน โครงการเปิดสอนหลักสูตรระดับปริญญาตรีนานาชาติ
          </div> -->
      <?php
        if(isset($_SESSION['warning'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Warning!</h4>
              ".$_SESSION['warning']."
            </div>
          ";
          unset($_SESSION['warning']);
        }
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div> -->
            <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title">ข้อมูลแบบฟอร์มขออนุมัติ</h3>
              </div>
              <table id="example0" class="table table-bordered table-striped table-hover">                
                <thead>
                	<th>หัวข้อ</th>
                    <th>รายละเอียด</th>
                    <th>หัวข้อ</th>
                    <th>รายละเอียด</th>
                </thead>
                <tbody>
                <tr>
                  <td width="12%" class="th-left-color">หน่วยงาน</td>
                  <td width="38%">
                  <?php 
                      switch($app_id){
                        case "1":
                            echo "ภาควิชาวิศวกรรมการบินและอวกาศ";
                          break;
                        case "2":
                            echo "ภาควิชาวิศวกรรมเครื่องกล";
                          break;
                        case "3":
                            echo "ภาควิชาวิศวกรรมเคมี";
                          break;
                        case "4":
                            echo "ภาควิชาวิศวกรรมคอมพิวเตอร์";
                          break;
                        case "5":
                            echo "ภาควิชาวิศวกรรมไฟฟ้า";
                          break;
                        case "6":
                            echo "ภาควิชาวิศวกรรมทรัพยากรน้ำ";
                          break;
                        case "7":
                            echo "ภาควิชาวิศวกรรมโยธา";
                          break;
                        case "8":
                            echo "ภาควิชาวิศวกรรมสิ่งแวดล้อม";
                          break;
                        case "9":
                            echo "ภาควิชาวิศวกรรมอุตสาหการ";
                          break;
                        case "10":
                            echo "ภาควิชาวิศวกรรมวัสดุ";
                          break;
                        case "11":
                            echo "ส่วนกลางคณะฯ";
                          break;
                        case "12":
                            echo "ภาควิชาวิศวกรรมการบินและอวกาศ";
                          break;
                        case "13":
                            echo "ภาควิชาวิศวกรรมเครื่องกล";
                          break;
                        case "14":
                            echo "ภาควิชาวิศวกรรมเคมี";
                          break;
                        case "15":
                            echo "ภาควิชาวิศวกรรมคอมพิวเตอร์";
                          break;
                        case "16":
                            echo "ภาควิชาวิศวกรรมไฟฟ้า";
                          break;
                        case "17":
                            echo "ภาควิชาวิศวกรรมทรัพยากรน้ำ";
                          break;
                        case "18":
                            echo "ภาควิชาวิศวกรรมโยธา";
                          break;
                        case "19":
                            echo "ภาควิชาวิศวกรรมสิ่งแวดล้อม";
                          break;
                        case "20":
                            echo "ภาควิชาวิศวกรรมอุตสาหการ";
                          break;
                        case "21":
                            echo "ภาควิชาวิศวกรรมวัสดุ";
                          break;
                        case "22":
                            echo "ส่วนกลางคณะฯ";
                          break;
                      }
                      
                    ?>
                  </td>                  
                  <td width="12%" >&nbsp;</td>
                  <td width="38%"><?php // echo $row["app_doc_no"];?></td>
                </tr>                                                
                <tr>
                  <td class="th-left-color">วันที่สร้างเอกสาร</td>
                  <td><?php echo DateThai('2022-06-13');?></td>                  
                  <td class="th-left-color">เดือนที่ขออนุมัติ</td>
                  <td><?php echo MonthThai(6)." 2565";?></td>                  
                </tr>                
                <!-- <tr>
                  <td class="th-left-color">ชื่อหัวหน้างาน</td>
                  <td>(<?php echo $row["app_head"];?>)</td>                                  
                  <td class="th-left-color">ตำแหน่งหัวหน้างาน</td>
                  <td>ตำแหน่ง <?php echo $row["app_head_position"];?></td>                  
                </tr>                
                <tr>
                  <td class="th-left-color">วงเงิน (ตัวเลข)</td>
                  <td><?php echo number_format($row["budget"],2);?> บาท</td>                                  
                  <td class="th-left-color">วงเงิน (ตัวอักษร)</td>
                  <td>( <?php echo num2wordsThai(substr($row["budget"],0,strlen($row["budget"])-3));?>บาทถ้วน )</td>                  
                </tr>
                <tr>
                    <td class="th-left-color">สถานะ</td>
                    <td>
                        <?php 
                            $app_status = $row['app_status'];
                            if($app_status==0){
                                $strStatus = "<font color='#f39c12'>รอการอนุมัติ</font>";
                            }else{
                                $strStatus = "<font color='#00a65a'>ผ่านการอนุมัติ</font>";
                            }
                            echo $strStatus;
                        ?>
                    </td>                                  
                </tr> -->
                <tbody>
              </table>              
              <hr>
              <table id="example5" class="table table-bordered">
              <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>
                  <th width="15%">ชื่อ-นามสกุล</th>
                  <th width="15%">รหัสประจำตัวนิสิต</th>
                  <th width="10%">ระดับปริญญา</th>
                  <th width="5%">ชั้นปี</th>   
                  <th width="10%">เลขบัญชี</th>
                  <th width="15%">ชื่อธนาคาร</th>
                </thead>
                
                <tbody>
                  <?php                   
                    // $sql = "SELECT *, employees.id AS empid, approval_emp.app_emp_id AS appeid
                    //         FROM approval_emp
                    //         LEFT JOIN employees ON employees.id=approval_emp.emp_id
                    //         LEFT JOIN position ON position.id=employees.position_id
                    //         WHERE approval_emp.app_id=$app_id AND approval_emp.emp_id=$emp_id
                    //         ;";
                    // $query = $conn->query($sql);
                    // $i=1;
                    // while($row = $query->fetch_assoc()){
                    //   //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                    //   $sqlot = "SELECT DAY(ot_date) AS otDay, MONTH(ot_date) AS otMonth, YEAR(ot_date) AS otYear 
                    //             FROM approval_emp_ot, approval_emp                                                                
                    //             WHERE approval_emp_ot.app_emp_id=".$row['appeid']."
                    //             AND approval_emp_ot.app_id=$app_id
                    //             AND approval_emp_ot.emp_id=".$row['empid']."
                    //             AND approval_emp_ot.app_emp_id=approval_emp.app_emp_id
                    //             ORDER BY ot_date
                    //             ;";

                    //   $qot = $conn->query($sqlot);         
                    //   // echo $sqlot."<br>";
                    //   $strOT="";
                    //   $strDay="";
                    //   $strMonth="";
                    //   $strYear="";
                      
                    //   if($qot->num_rows > 0){                      
                    //     while($rowot = $qot->fetch_assoc()){
                    //       $strDay.=$rowot['otDay'].", ";
                    //       $strMonth = $rowot['otMonth'];
                    //       $strYear = $rowot['otYear'];
                    //     }

                    //     $strDay = substr($strDay,0,strlen($strDay)-2);
                    //     $strMonth = MonthThai($strMonth);
                    //     $strYear = $strYear+543;

                    //     $strOT = $strDay." ".$strMonth." ".$strYear; 
                    //   }else{
                    //     $strOT="<font color='#a6a6a6'>ยังไม่ระบุวัน</font>";
                    //   }

                    //   echo "
                    //     <tr>
                    //       <td class='hidden'></td>
                    //       <td>".$i."</td>
                    //       <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //       <td>".$row['description']."</td>                          
                    //       <td>".$strOT."</td>
                    //       <td>".$row['reponsibility']."</td>                          
                    //     </tr>
                    //   ";
                    //   $i++;
                    // }
                    switch($app_emp_id){
                        case "1":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายกิตติภณ ฝ่ายเดช</td>
                                <td></td>                          
                                <td>ปริญญาตรี</td>
                                <td>3</td>                        
                                <td>069-2-76971-4</td>                        
                                <td>ธนาคารทหารไทย จำกัด (มหาชน)</td>                        
                            </tr>
                            ";
                            break;
                        case "2":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นางสาวสโรชา เจตะวัฒนะ</td>
                                <td></td>                          
                                <td>ปริญญาตรี</td>
                                <td>3</td>                        
                                <td>276-2-180947</td>                        
                                <td>ธนาคารทหารไทย จำกัด (มหาชน)</td>                        
                            </tr>
                            ";
                            break;
                        case "3":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นางสาวนวลพรรณ ชัยศร</td>
                                <td></td>                          
                                <td>ปริญญาตรี</td>
                                <td>4</td>                        
                                <td>359-2-723104</td>                        
                                <td>ธนาคารทหารไทย จำกัด (มหาชน)</td>                        
                            </tr>
                            ";
                            break;
                        case "4":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายปิติพล เกื้อกูล</td>
                                <td></td>                          
                                <td>ปริญญาตรี</td>
                                <td>4</td>                        
                                <td>069-2-71711-9</td>                        
                                <td>ธนาคารทหารไทย จำกัด (มหาชน)</td>                        
                            </tr>
                            ";
                            break;
                        case "5":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายโชติพัชร กสิกรรม</td>
                                <td></td>                          
                                <td>ปริญญาตรี</td>
                                <td>4</td>                        
                                <td>215-2-63405-7</td>                        
                                <td>ธนาคารทหารไทย จำกัด (มหาชน)</td>                        
                            </tr>
                            ";
                            break;
                          case "6":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายพลาวัสถ์ ส่งพันธ์นธีกูร</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>4</td>                        
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "7":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายสุรงค์กร  เพชรรักษ์</td>
                                <td></td>                          
                                <td>ปริญญาเอก</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "8":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นางสาววาริณีย์  สุวรรณรักษ์</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "9":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายวุส  ทาแก้ว</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "10":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายภคนันท์  วัฒนสินบำรุง</td>
                                <td></td>                          
                                <td>ปริญญาเอก</td>
                                <td>1</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "11":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายฐิติศักดิ์  อัศวรางกูร</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>3</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "12":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายเอื้ออังกูร  มูลรังษี</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "13":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายกฤษฎิ์  ใหม่เอี่ยม</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "14":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายพัชรากร  ศิริโยทัย</td>
                                <td></td>                          
                                <td>ปริญญาเอก</td>
                                <td>1</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "15":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นางสาวศนทกานต์  เหลืองวิเศษ</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>3</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "16":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายณัฐพงษ์  พรมพิทักษ์</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "17":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นางสาวฑิฆันพร  จิตภักดี</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>4</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "18":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นางสาวพิมพ์นิภา  อุมัยชัย</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>1</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "19":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายอาณกร  ทองบาง</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>1</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "20":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายสิทธ์ชัย  ปัทมารัตน์</td>
                                <td></td>                          
                                <td>ปริญญาตรี</td>
                                <td>4</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;
                          case "21":
                            echo "
                            <tr>
                                <td class='hidden'></td>
                                <td>1</td>
                                <td>นายจิระศักดิ์  แซ่ตัน</td>
                                <td></td>                          
                                <td>ปริญญาโท</td>
                                <td>2</td>
                                <td></td>                        
                                <td></td>                        
                            </tr>
                            ";
                            break;

                    }
                    
                  ?>

                </tbody>
              </table>
              <hr>
              <?php 
              // if($app_status==0){
              ?>  
              <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div>
              <?php
              // }
              ?>
              <br>
              <table id="example4" class="table table-bordered table-striped table-hover">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>
                  <!-- <th width="15%">ชื่อ-นามสกุล</th> -->
                  <th width="8%">รายวิชา</th>
                  <th width="8%">หมู่การเรียน</th>
                  <th width="10%">จำนวนนิสิต (คน)</th>
                  <th width="10%">ค่าตอบแทน (บาท)</th>
                  <th width="10%">เกรดเฉลี่ย (GPA)</th>
                  <th width="10%">ผลการเรียน</th>
                  <th width="20%">ดำเนินการ</th>
                </thead>
                
                <tbody>
                  <?php
                    // $sql = "SELECT *, employees.id AS empid, approval_emp_ot.app_emp_ot_id AS appeotid, approval_emp_ot.reponsibility AS otreponsibility
                    //         FROM approval_emp_ot
                    //         LEFT JOIN approval ON approval.app_id=approval_emp_ot.app_id 
                    //         LEFT JOIN approval_emp ON approval_emp.app_emp_id=approval_emp_ot.app_emp_id 
                    //         LEFT JOIN employees ON employees.id=approval_emp_ot.emp_id 
                    //         LEFT JOIN otrate ON otrate.otrate_id=approval_emp_ot.otrate_id
                    //         WHERE approval_emp_ot.emp_id =".$emp_id."
                    //         AND approval_emp_ot.app_id = ".$app_id."
                    //         ORDER BY approval_emp_ot.ot_date, approval_emp_ot.time_in DESC";
                    // $query = $conn->query($sql);
                    // //echo $sql; 
                    // $i=1;

                    // $today = date('Y-m-d'); 
                    // //echo $today;
                    // while($row = $query->fetch_assoc()){
                    //   //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                    //   if($_SESSION['is_admin'] == 1 && $_SESSION['is_edit'] == 1){
                    //     echo "
                    //           <tr>
                    //           <td class='hidden'></td>
                    //           <td>".$i."</td>
                    //           <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //           <td>".DateShortThai($row['ot_date'])."</td>                          
                    //           <td>".date('h:i A', strtotime($row['time_in']))."</td>
                    //           <td>".date('h:i A', strtotime($row['time_out']))."</td>
                    //           <td>".$row['otreponsibility']."</td>
                    //           <td>".$row['otrate_name']."</td>
                    //           <td>
                    //               <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['appeotid']."'><i class='fa fa-edit'></i> แก้ไขเวลาการทำงาน</button>
                    //               <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeotid']."'><i class='fa fa-trash'></i> ลบเวลาการทำงาน</button>
                    //           </td>
                    //           </tr>
                    //       ";
                    //   }else{
                    //     if(compareDate($today,$row['ot_date'])==1){
                    //       if($app_status==0){
                    //         echo "
                    //             <tr>
                    //             <td class='hidden'></td>
                    //             <td>".$i."</td>
                    //             <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //             <td>".DateShortThai($row['ot_date'])."</td>                          
                    //             <td>".date('h:i A', strtotime($row['time_in']))."</td>
                    //             <td>".date('h:i A', strtotime($row['time_out']))."</td>
                    //             <td>".$row['otreponsibility']."</td>
                    //             <td>".$row['otrate_name']."</td>
                    //             <td>
                    //                 <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['appeotid']."'><i class='fa fa-edit'></i> แก้ไขเวลาการทำงาน</button>
                    //                 <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeotid']."'><i class='fa fa-trash'></i> ลบเวลาการทำงาน</button>
                    //             </td>
                    //             </tr>
                    //         ";
                    //       }else{
                    //         echo "
                    //           <tr>
                    //           <td class='hidden'></td>
                    //           <td>".$i."</td>
                    //           <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //           <td>".DateShortThai($row['ot_date'])."</td>                          
                    //           <td>".date('h:i A', strtotime($row['time_in']))."</td>
                    //           <td>".date('h:i A', strtotime($row['time_out']))."</td>
                    //           <td>".$row['otreponsibility']."</td>
                    //           <td>".$row['otrate_name']."</td>
                    //           <td>
                    //             &nbsp;
                    //           </td>
                    //           </tr>
                    //       ";
                    //       }
                    //     }else{
                    //       if($app_status==0){
                    //         echo "
                    //             <tr>
                    //             <td class='hidden'></td>
                    //             <td>".$i."</td>
                    //             <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //             <td>".DateShortThai($row['ot_date'])."</td>                          
                    //             <td>".date('h:i A', strtotime($row['time_in']))."</td>
                    //             <td>".date('h:i A', strtotime($row['time_out']))."</td>
                    //             <td>".$row['otreponsibility']."</td>
                    //             <td>".$row['otrate_name']."</td>
                    //             <td>
                    //                 <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeotid']."'><i class='fa fa-trash'></i> ลบเวลาการทำงาน</button>
                    //             </td>
                    //             </tr>
                    //         ";
                    //       }else{
                    //         echo "
                    //             <tr>
                    //             <td class='hidden'></td>
                    //             <td>".$i."</td>
                    //             <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //             <td>".DateShortThai($row['ot_date'])."</td>                          
                    //             <td>".date('h:i A', strtotime($row['time_in']))."</td>
                    //             <td>".date('h:i A', strtotime($row['time_out']))."</td>
                    //             <td>".$row['otreponsibility']."</td>
                    //             <td>".$row['otrate_name']."</td>
                    //             <td>
                    //               &nbsp;
                    //             </td>
                    //             </tr>
                    //         ";  
                    //       }
                    //     }
                    //   }
                    //   $i++;
                    // }
                    switch($app_emp_id){
                        case "1":
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>1</td>                        
                                <td>01215241</td>                          
                                <td>1</td>
                                <td>35</td>
                                <td>2,505</td>
                                <td>3.7</td>
                                <td>A</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                                </td>
                                </tr>
                            ";
                            break;
                        case "2":
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>1</td>                        
                                <td>01215231</td>                          
                                <td>1</td>
                                <td>35</td>
                                <td>2,505</td>
                                <td>3.66</td>
                                <td>B+</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                                </td>
                                </tr>
                            ";
                            break;
                        case "3":
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>1</td>                        
                                <td>01215251</td>                          
                                <td>1</td>
                                <td>35</td>
                                <td>2,505</td>
                                <td>3.74</td>
                                <td>A</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                                </td>
                                </tr>
                            ";
                            break;
                        case "4":
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>1</td>                        
                                <td>01215323</td>                          
                                <td>1</td>
                                <td>24</td>
                                <td>2,505</td>
                                <td>3.97</td>
                                <td>B+</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                                </td>
                                </tr>
                            ";
                            break;
                        case "5":
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>1</td>                        
                                <td>01215351</td>                          
                                <td>1</td>
                                <td>28</td>
                                <td>2,505</td>
                                <td>3.56</td>
                                <td>B+</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                                </td>
                                </tr>
                            ";
                            break;
                        case "6":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208111</td>                          
                              <td>5</td>
                              <td>43</td>
                              <td>3,340</td>
                              <td>3.60</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "7":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208426</td>                          
                              <td>1, 250</td>
                              <td>23, 10</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "8":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208322</td>                          
                              <td>2, 251</td>
                              <td>35, 22</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "9":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208201, 01208577</td>                          
                              <td>1</td>
                              <td>60</td>
                              <td>3,340</td>
                              <td>3.58</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "10":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211331</td>                          
                              <td>1, 250</td>
                              <td>33, 25</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "11":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208499</td>                          
                              <td>1, 250</td>
                              <td>28</td>
                              <td>3,340</td>
                              <td>3.86</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "12":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211499</td>                          
                              <td>1, 250</td>
                              <td>28</td>
                              <td>3,340</td>
                              <td>3.41</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "13":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208111</td>                          
                              <td>4, 14</td>
                              <td>60</td>
                              <td>3,340</td>
                              <td>3.86</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "14":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208351</td>                          
                              <td>1, 2, 250, 251</td>
                              <td>38, 55, 50, 28</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "15":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208111</td>                          
                              <td>1</td>
                              <td>60</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "16":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211322</td>                          
                              <td>1, 250</td>
                              <td>34, 9</td>
                              <td>3,340</td>
                              <td>3.60</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "17":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211322</td>                          
                              <td>1, 250</td>
                              <td>34, 9</td>
                              <td>3,340</td>
                              <td>3.20</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "18":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211497</td>                          
                              <td>1, 250</td>
                              <td>36, 32</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "19":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211497</td>                          
                              <td>1, 250</td>
                              <td>36, 32</td>
                              <td>3,340</td>
                              <td>4.00</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "20":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01211311</td>                          
                              <td>1, 250</td>
                              <td>40, 40</td>
                              <td>3,340</td>
                              <td>2.87</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                        case "21":
                          echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>1</td>                        
                              <td>01208322</td>                          
                              <td>1, 250</td>
                              <td>24, 27</td>
                              <td>3,340</td>
                              <td>3.86</td>
                              <td></td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> แก้ไขรายวิชา</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> ลบรายวิชา</button>
                              </td>
                              </tr>
                          ";
                          break;
                    }
                  ?>
                </tbody>                             
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/approval_ot_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

window.setTimeout(function() {
  $(".alert").fadeTo(800, 0).slideUp(800, function(){
      $(this).remove(); 
  });
}, 9000);

$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'approval_ot_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.ot_date);
      //$('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#edit_reponsibility').val(response.reponsibility);
      $('#edit_otrate_id').val(response.otrate_id);
      $('#appeotid').val(response.app_emp_ot_id);
      //$('#employee_name').html(response.firstname+' '+response.lastname);
      $('#datepicker_del').val(response.ot_date);
      $('#del_time_in').val(response.time_in);
      $('#del_time_out').val(response.time_out);
      $('#del_reponsibility').val(response.reponsibility);
      $('#del_otrate_id').val(response.otrate_id);
      $('#del_appeotid').val(response.app_emp_ot_id);
      //$('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
