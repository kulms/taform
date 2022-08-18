<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/functions.php'; ?>

<?php
    $otdata_id = $_GET["otdataid"];
    
    $sql = "SELECT a.*, y.year_name 
            FROM otdata a                           
            LEFT JOIN years y ON y.year_id=a.year_id                          
            WHERE a.otdata_id = '".$otdata_id."'
            ORDER BY a.otdata_month DESC";  
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $otdata_month = $thaimonth[$row['otdata_month']-1]." ".$row['year_name'];                       
    $otdata_name = $row['otdata_name'];
    $create_date = DateShortThai(date('Y-m-d',strtotime($row['create_date'])));
    
    if($row['otdata_status']==0){
        $strStatus = "<font color='#f39c12'>ยังไม่คำนวณ</font>";
    }else{
        $strStatus = "<font color='#00a65a'>คำนวณค่าล่วงเวลาแล้ว</font>";
    }  
?>                    

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      รายละเอียดข้อมูลจากเครื่องสแกน
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="otscan.php">ข้อมูลจากเครื่องสแกน</a></li>
        <li class="active">รายละเอียดข้อมูลจากเครื่องสแกน</li>
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
                <h3 class="box-title">ข้อมูลจากเครื่องสแกน</h3>
              </div>              
              <table id="example5" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th width="5%">#</th>
                  <th width="15%">เดือน</th>
                  <th width="45%">ชื่อเอกสาร</th>
                  <th width="20%">สถานะ</th>                  
                  <th width="15%">วันที่นำเข้า</th>
                  <!-- <th width="20%">Tools</th> -->
                </thead>        
                <tbody>
                  <?php                    
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td align='center'>&#9658;</td>
                          <td>".$otdata_month."</td>
                          <td>".$otdata_name."</td>                          
                          <td>".$strStatus."</td>
                          <td>".$create_date."</td>                          
                        </tr>
                      ";                     
                  ?>
                </tbody>
              </table>
              <hr>              
              <table id="example11" class="table table-bordered table-striped table-hover" width="180%">
                <thead>
                  <th class="hidden"></th>
                  <th width="1%">#</th>
                  <th width="1%">หน่วยงาน</th>
                  <th width="22%">ชื่อ-นามสกุล</th>
                  <th width="8%">วันที่</th>
                  <th width="5%">เวลา<br>(1)</th>
                  <th width="5%">เวลา<br>(2)</th>
                  <th width="5%">เวลา<br>(3)</th>
                  <th width="5%">เวลา<br>(4)</th>
                  <th width="5%">เวลา<br>(5)</th>
                  <th width="5%">เวลา<br>(6)</th>
                  <th width="5%">เวลา<br>(7)</th>
                  <th width="5%">เวลา<br>(8)</th>
                  <th width="5%">เวลา<br>(9)</th>
                  <th width="5%">เวลา<br>(10)</th>
                  <th width="5%">เวลา<br>(11)</th>
                  <th width="5%">เวลา<br>(12)</th>
                  <th width="5%">เวลา<br>(13)</th>
                  <th width="5%">เวลา<br>(14)</th>
                  <th width="5%">เวลา<br>(15)</th>
                  <th width="5%">เวลา<br>(16)</th>
                  <th width="5%">เวลา<br>(17)</th>
                  <th width="5%">เวลา<br>(18)</th>
                  <th width="5%">เวลา<br>(19)</th>
                  <th width="5%">เวลา<br>(20)</th>
                  <th width="8%">สแกนเข้า <br>(เช้า)</th>                  
                  <th width="8%">สแกนออก <br>(เช้า)</th>
                  <th width="8%">สแกนเข้า <br>(บ่าย)</th>
                  <th width="8%">สแกนออก <br>(บ่าย)</th>                  
                </thead>
                
                <!-- <tbody>
                  <?php
                    if($_SESSION["deptid"]=='99'){
                        $sql = "SELECT otdata_time.*, employees.titlename, employees.firstname, employees.lastname, 
                            department.dept_name AS dept_name
                            FROM otdata_time
                            LEFT JOIN department ON department.dept_id=otdata_time.dept_id                             
                            LEFT JOIN employees ON employees.id=otdata_time.emp_id                             
                            WHERE otdata_time.otdata_id =".$otdata_id." 
                            ORDER BY CONVERT(dept_name USING tis620), 
                            CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                            otdata_time.ot_date
                            ";
                    }else{
                        $sql = "SELECT DISTINCT otdata_time.*, employees.titlename, employees.firstname, employees.lastname, 
                            department.dept_name AS dept_name
                            FROM otdata_time
                            LEFT JOIN department ON department.dept_id=otdata_time.dept_id                             
                            LEFT JOIN employees ON employees.id=otdata_time.emp_id     
                            LEFT JOIN approval_group ON approval_group.emp_id=otdata_time.emp_id                        
                            WHERE otdata_time.otdata_id =".$otdata_id."                             
                            AND otdata_time.emp_id IN (SELECT emp_id FROM approval_group WHERE dept_id = '".$_SESSION["deptid"]."')
                            ORDER BY CONVERT(dept_name USING tis620), 
                            CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                            otdata_time.ot_date
                            ";
                    }        
                    $query = $conn->query($sql);
                    // echo $sql."<br>"; 
                    $i=1;

                    $today = date('Y-m-d'); 
                    //echo $today;
                    while($row = $query->fetch_assoc()){
                      //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                     
                        echo "
                            <tr>
                            <td class='hidden'></td>
                            <td></td>
                            <td>".$row['dept_name']."</td>
                            <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>                            
                            <td>".DateShortThai($row['ot_date'])."</td>                          
                            <td>".($row['time01'] != '00:00:00' ? $row['time01'] : '-')."</td>
                            <td>".($row['time02'] != '00:00:00' ? $row['time02'] : '-')."</td>
                            <td>".($row['time03'] != '00:00:00' ? $row['time03'] : '-')."</td>
                            <td>".($row['time04'] != '00:00:00' ? $row['time04'] : '-')."</td>
                            <td>".($row['time05'] != '00:00:00' ? $row['time05'] : '-')."</td>
                            <td>".($row['time06'] != '00:00:00' ? $row['time06'] : '-')."</td>
                            <td>".($row['time07'] != '00:00:00' ? $row['time07'] : '-')."</td>
                            <td>".($row['time08'] != '00:00:00' ? $row['time08'] : '-')."</td>
                            <td>".($row['time09'] != '00:00:00' ? $row['time09'] : '-')."</td>
                            <td>".($row['time10'] != '00:00:00' ? $row['time10'] : '-')."</td>
                            <td>".($row['time11'] != '00:00:00' ? $row['time11'] : '-')."</td>
                            <td>".($row['time12'] != '00:00:00' ? $row['time12'] : '-')."</td>
                            <td>".($row['time13'] != '00:00:00' ? $row['time13'] : '-')."</td>
                            <td>".($row['time14'] != '00:00:00' ? $row['time14'] : '-')."</td>
                            <td>".($row['time15'] != '00:00:00' ? $row['time15'] : '-')."</td>
                            <td>".($row['time16'] != '00:00:00' ? $row['time16'] : '-')."</td>
                            <td>".($row['time17'] != '00:00:00' ? $row['time17'] : '-')."</td>
                            <td>".($row['time18'] != '00:00:00' ? $row['time18'] : '-')."</td>
                            <td>".($row['time19'] != '00:00:00' ? $row['time19'] : '-')."</td>
                            <td>".($row['time20'] != '00:00:00' ? $row['time20'] : '-')."</td>
                            <td>".$row['ot1_in']."</td>
                            <td>".$row['ot1_out']."</td>
                            <td>".$row['ot2_in']."</td>
                            <td>".$row['ot2_out']."</td>                            
                            </tr>
                        ";                      
                      $i++;
                    }
                  ?>
                </tbody>                              -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
