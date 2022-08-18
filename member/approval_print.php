<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
    $app_id = $_GET["appid"];
    $sql = "SELECT a.*, y.year_name 
            FROM approval a
            LEFT JOIN years y ON y.year_id=a.year_id 
            WHERE app_id = '$app_id'
            ;";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $app_type_id = $row["app_type_id"];
    $app_dept_id = $row["dept_id"];
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
      พิมพ์แบบฟอร์ม
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="approval_form_print.php"> พิมพ์แบบฟอร์มขออนุมัติ</a></li>
        <li class="active">พิมพ์แบบฟอร์ม</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
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
                  <td width="12%" class="th-left-color">ส่วนงาน</td>
                  <td width="38%"><?php echo $row["app_detail"];?></td>                  
                  <td width="12%" class="th-left-color">เลขที่หนังสือ</td>
                  <td width="38%"><?php echo $row["app_doc_no"];?></td>
                </tr>                                                
                <tr>
                  <td class="th-left-color">วันที่เอกสาร</td>
                  <td><?php echo DateThai($row["app_date"]);?></td>                  
                  <td class="th-left-color">เดือนที่ขออนุมัติ</td>
                  <td><?php echo MonthThai($row["app_month"])." ".$row["year_name"];?></td>                  
                </tr>                
                <tr>
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
                            if($row['app_status']==0){
                                $strStatus = "<font color='#f39c12'>รอการอนุมัติ</font>";
                            }else{
                                $strStatus = "<font color='#00a65a'>ผ่านการอนุมัติ</font>";
                            }
                            echo $strStatus;
                        ?>
                    </td>                                  
                </tr>
                <tbody>
              </table>              
              <hr>
              <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div> -->
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th width="5%">#</th>
                  <th width="15%">ชื่อ-นามสกุล</th>
                  <th width="15%">ตำแหน่ง</th>
                  <th width="20%">วันที่</th>                  
                  <th width="25%">งานที่ปฏิบัติ</th>
                  <!-- <th width="20%">Tools</th> -->
                </thead>
                
                <tbody>
                  <?php
                    // $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid 
                    //           FROM attendance 
                    //           LEFT JOIN employees ON employees.id=attendance.employee_id 
                    //           ORDER BY attendance.date DESC, attendance.time_in DESC";
                    $sql = "SELECT *, employees.id AS empid, approval_emp.app_emp_id AS appeid
                            FROM approval_emp
                            LEFT JOIN employees ON employees.id=approval_emp.emp_id
                            LEFT JOIN position ON position.id=employees.position_id
                            WHERE approval_emp.app_id=$app_id
                            ;";
                    $query = $conn->query($sql);
                    $i=1;
                    while($row = $query->fetch_assoc()){
                      //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      $sqlot = "SELECT DAY(ot_date) AS otDay, MONTH(ot_date) AS otMonth, YEAR(ot_date) AS otYear 
                                FROM approval_emp_ot, approval_emp                                                                
                                WHERE approval_emp_ot.app_emp_id=".$row['appeid']."
                                AND approval_emp_ot.app_id=$app_id
                                AND approval_emp_ot.emp_id=".$row['empid']."
                                AND approval_emp_ot.app_emp_id=approval_emp.app_emp_id
                                ;";

                      $qot = $conn->query($sqlot);         
                      // echo $sqlot."<br>";
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
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$i."</td>
                          <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                          <td>".$row['description']."</td>                          
                          <td>".$strOT."</td>
                          <td>".$row['reponsibility']."</td>                          
                        </tr>
                      ";
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
              <?php
                switch($app_dept_id){
                    case 1:                    
                    case 42:
                    case 43:
                    case 44:
                    case 45:
                    case 46:
                    case 47:
                    case 48:
                    case 49:                    
                    case 51:
                    case 52:
                    case 53:
                    case 54:
                    case 55:
                    case 56:
                    case 57:
                      if($app_type_id==1 || $app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }
                      break; 
                    // 5 = งานบริการการศึกษา
                    case 2:
                    case 3:
                    case 4:                    
                    case 5:
                    case 6:
                    case 7:                    
                        if($app_type_id==1){
                          echo "
                          <div class='box-header with-border col-sm-offset-5'>
                          <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                          <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                          </div>
                          ";  
                        }elseif($app_type_id==6){
                          echo "
                          <div class='box-header with-border col-sm-offset-5'>
                          <a href='approval06_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                          <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                          </div>
                          ";
                        }else{
                          echo "
                          <div class='box-header with-border col-sm-offset-5'>
                          <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                          <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                          </div>
                          ";    
                        }
                        break;
                    case 9:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval06_09_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }
                      break;  
                    case 50:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 17 = ภาค วศ.เครื่องกล
                    case 17:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_17_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 13 = ภาค วศ.คอมพิวเตอร์
                    case 13:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_13_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 15 = ภาค วศ.เคมี
                    case 15:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_15_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 20 = ภาค วศ.การบินและอวกาศ
                    case 20:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_20_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 23 = ภาค วศ.ทรัพยากรน้ำ
                    case 23:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_23_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 25 = ภาค วศ.ไฟฟ้า
                    case 25:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_25_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 27 = ภาค วศ.โยธา
                    case 27:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_27_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 30 = ภาค วศ.สิ่งแวดล้อม
                    case 30:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_30_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 32 = ภาค วศ.อุตสาหการ
                    case 32:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_32_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;
                    // 35 = ภาค วศ.วัสดุ
                    case 35:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";  
                      }elseif($app_type_id==3){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval03_35_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }elseif($app_type_id==6){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval04_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>                
                        </div>
                        ";
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";    
                      }                    
                      break;                                                                              
                    default:
                      if($app_type_id==1){
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval01_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>                
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>
                        </div>
                        ";  
                      }else{
                        echo "
                        <div class='box-header with-border col-sm-offset-5'>
                        <a href='approval02_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์แบบฟอร์มนี้</a>    
                        <a href='approval_ot_generate.php?appid=".$app_id."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-print'></i> พิมพ์ตารางเวลาทำงาน</a>            
                        </div>
                        ";    
                      }
                      break;

                }
                //echo $app_type_id;
                //if($app_type_id==1 || $app_type_id==6){
              ?>
              <!-- <div class="box-header with-border col-sm-offset-5">
                <a href="approval01_generate.php?appid=<?php echo $app_id;?>" class="btn btn-info btn-sm btn-flat"><i class="fa fa-print"></i> พิมพ์แบบฟอร์มนี้</a>                
              </div> -->
              <?php
                //}else{
              ?>
              <!-- <div class="box-header with-border col-sm-offset-5">
                <a href="approval02_generate.php?appid=<?php echo $app_id;?>" class="btn btn-info btn-sm btn-flat"><i class="fa fa-print"></i> พิมพ์แบบฟอร์มนี้</a>                
              </div> -->
              <?php
                //}
              ?>      
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/approval_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
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
  //alert(id);
  $.ajax({
    type: 'POST',
    url: 'approval_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      // $('#datepicker_edit').val(response.date);
      // $('#attendance_date').html(response.date);
      // $('#edit_time_in').val(response.time_in);
      // $('#edit_time_out').val(response.time_out);
      // $('#attid').val(response.attid);
      // $('#employee_name').html(response.firstname+' '+response.lastname);
      // $('#del_attid').val(response.attid);
      // $('#del_employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_emp_id').val(response.emp_id);
      $('#edit_reponsibility').val(response.reponsibility);
      $('#appe_id').val(response.app_emp_id);
      $('#employee_name').html(response.titlename+response.firstname+' '+response.lastname);

      $('#del_emp_id').val(response.emp_id);
      $('#del_reponsibility').val(response.reponsibility);
      $('#del_appe_id').val(response.app_emp_id);
      $('#del_employee_name').html(response.titlename+response.firstname+' '+response.lastname);

    }
  });
}
</script>
</body>
</html>
