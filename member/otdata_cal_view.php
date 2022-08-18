<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/functions.php'; ?>

<?php
    $otdata_id = $_GET["otdataid"];
    $cal = $_GET["cal"];
    
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
      ผลการคำนวณเวลาทำงาน
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="otdata_calculate.php">คำนวณเวลาทำงาน</a></li>
        <li class="active">ผลการคำนวณเวลาทำงาน</li>
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
                <h3 class="box-title">ข้อมูลผลการคำนวณเวลาทำงาน</h3>
              </div>              
              <table id="example5" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th width="5%">#</th>
                  <th width="15%">เดือน</th>
                  <th width="30%">ชื่อเอกสาร</th>
                  <th width="15%">สถานะ</th>                  
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
              <table id="example11_1" class="table table-bordered table-striped table-hover" width="160%">
                <thead>
                  <th class="hidden"></th>
                  <th width="1%">#</th>
                  <th width="1%">หน่วยงาน</th>
                  <th width="1%">ชื่อ-นามสกุล</th>
                  <th width="4%">วันที่</th>
                  <th width="3%">สแกนเข้า <br>(1)</th>
                  <th width="3%">ขออนุมัติเข้า <br>(1)</th>
                  <th width="3%">สแกนออก <br>(1)</th>
                  <th width="3%">ขออนุมัติออก <br>(1)</th>
                  <th width="3%">สแกนเข้า <br>(2)</th>
                  <th width="3%">ขออนุมัติเข้า <br>(2)</th>
                  <th width="3%">สแกนออก <br>(2)</th>
                  <th width="3%">ขออนุมัติออก <br>(2)</th>
                  <th width="8%">อัตราค่าล่วงเวลา</th>
                  <th width="3%">จำนวน <br>(ชั่วโมง)</th>
                  <th width="3%">จำนวน <br>(นาที)</th>
                  <th width="3%">ค่าล่วงเวลา <br>(บาท)</th>                  
                </thead>
                
                <!-- <tbody>
                  <?php
                    // $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                    //         department.dept_name AS dept_name, otrate.otrate_name  
                    //         FROM otdata_time_cal
                    //         LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                    //         LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                    //         LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                    //         LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                    //                   AND approval_emp_ot.emp_id=otdata_time_cal.emp_id    
                    //         LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id                                              
                    //         WHERE otdata_time_cal.otdata_id =".$otdata_id." AND otdata_time_cal.ot_amount > 0                             
                    //         ORDER BY CONVERT(dept_name USING tis620), 
                    //         CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                    //         otdata_time_cal.ot_date, otrate.otrate_name  ";
                    $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
                            department.dept_name AS dept_name, otrate.otrate_name  
                            FROM otdata_time_cal
                            LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
                            LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
                            LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
                            LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                                      AND approval_emp_ot.emp_id=otdata_time_cal.emp_id    
                            LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id                                              
                            WHERE otdata_time_cal.otdata_id =".$otdata_id."                               
                            ORDER BY CONVERT(dept_name USING tis620), 
                            CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
                            otdata_time_cal.ot_date, otrate.otrate_name  ";        
                    $query = $conn->query($sql);
                     echo $sql."<br>"; 
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
                            <td>".$row['ot1_in']."</td>
                            <td>".$row['ot1_form_in']."</td>
                            <td>".$row['ot1_out']."</td>
                            <td>".$row['ot1_form_out']."</td>
                            <td>".$row['ot2_in']."</td>
                            <td>".$row['ot2_form_in']."</td>
                            <td>".$row['ot2_out']."</td>
                            <td>".$row['ot2_form_out']."</td>                            
                            <td>".$row['otrate_name']."</td>
                            <td>".$row['num_hr']."</td>
                            <td>".$row['num_min']."</td>
                            <td>".number_format($row['ot_amount'],2)."</td>                            
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
