<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
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
      สรุปข้อมูลการขออนุมัติ
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">สรุปข้อมูลการขออนุมัติ</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
      //echo $_SESSION["member"]." ".$_SESSION["deptid"];
      ?>
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible' id='error-alert' data-auto-dismiss='500'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible' id='success-alert' data-auto-dismiss='500'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <!-- ****************************************** -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">            
            <div class="box-body">
              <div class="box-header with-border">
                <h3 class="box-title">ค้นหาข้อมูลการขออนุมัติ</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- <form id="frmMain" class="form-horizontal" action="approval_form.php" method="post" enctype="multipart/form-data"> -->
              <form class="form-horizontal" method="POST" action="sum_approval.php">  
                <div class="box-body">                                        
                  <div class="form-group">
                    <label for="year_id" class="col-sm-1 control-label">ปี</label>
                    <div class="col-sm-2">
                      <?php						  
                        $sql = "SELECT * FROM years ORDER BY CONVERT (year_name USING tis620)";
                        $query = $conn->query($sql);
                        $curYear = date('Y')+543;	
                      ?>
                      <select class="form-control" id="year_id" name="year_id" required>
                          <option value="">Not Selected</option>                            
                          <?php
                          while($yrow = $query->fetch_assoc()){
                            if($yrow["year_name"]==$curYear){
                              echo "
                              <option value='".$yrow['year_id']."' selected>".$yrow['year_name']."</option>
                              ";
                            }else{
                              echo "
                              <option value='".$yrow['year_id']."'>".$yrow['year_name']."</option>
                              ";	
                            }
                          }
                          $query->free();
                          ?>                          
                      </select>  
                    </div>
                  
                    <label for="otdata_month" class="col-sm-1 control-label">เดือน</label>
                    <div class="col-sm-2">                      
                      <select class="form-control" name="otdata_month" id="otdata_month" required>
                        <option value="" selected>- Select -</option>
                        <option value="1">มกราคม</option>
                        <option value="2">กุมภาพันธ์</option>
                        <option value="3">มีนาคม</option>
                        <option value="4">เมษายน</option>
                        <option value="5">พฤษภาคม</option>
                        <option value="6">มิถุนายน</option>
                        <option value="7">กรกฎาคม</option>
                        <option value="8">สิงหาคม</option>
                        <option value="9">กันยายน</option>
                        <option value="10">ตุลาคม</option>
                        <option value="11">พฤศจิกายน</option>
                        <option value="12">ธันวาคม</option>
                      </select>  
                    </div>
                  </div>
                                                                  
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info" name="search" value="1">Search</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>        
      <!-- ****************************************** -->
      <?php
        $sqlCondition = "";

        if(isset($_POST['year_id'])){
          if($_POST['otdata_month']==""){
            $year_id = $_POST['year_id'];
            // if($_SESSION["deptid"]=='99'){
            //   $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
            // }else{
            //   $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
            // } 
            $curMonth = 0; 
          }else{
            $year_id = $_POST['year_id'];
            $otdata_month = $_POST['otdata_month'];               
            // if($_SESSION["deptid"]=='99'){
            //   $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.otdata_month = '".$otdata_month."' ";
            // }else{
            //   $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.otdata_month = '".$otdata_month."' ";
            // } 
            $curMonth = $_POST['otdata_month'];      
          }
        }else{
          $sqlCurrYear = "SELECT year_id FROM years WHERE year_name LIKE '".$curYear."'";
          $qCurrYear = $conn->query($sqlCurrYear);
          $rowCurrYear = $qCurrYear->fetch_assoc();
          
          $year_id = $rowCurrYear["year_id"];
          $curMonth = date('n');	

        //   if($_SESSION["deptid"]=='99'){
        //     $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.otdata_month='".$curMonth."' ";
        //   }else{
        //     $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.otdata_month='".$curMonth."' ";
        //   }
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-upload"></i> Import Data</a>
            </div> -->
            <div class="box-body">
              <h4 class="box-title"> 
              แสดงผลสรุปข้อมูลการขออนุมัติ ปี พ.ศ.<?php echo $curYear;?> เดือน <?php echo MonthThai($curMonth);?>
              </h4>
              <table id="example3" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>                  
                  <th width="10%">ชื่อ-นามสกุล</th>                  
                  <th width="10%">วันที่</th>
                  <th width="10%">เวลาเริ่มต้น</th>
                  <th width="10%">เวลาสิ้นสุด</th>    
                  <th width="10%">อัตราค่าล่วงเวลา</th>                               
                </thead>
                <tbody>
                  <?php
                    // $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";                                      
                    
                    $sql = "SELECT *, employees.id AS empid, approval_emp_ot.app_emp_ot_id AS appeotid, 
                    approval_emp_ot.reponsibility AS otreponsibility, 
                    employees.titlename, employees.firstname, employees.lastname, otrate.otrate_name
                    FROM approval_emp_ot
                    LEFT JOIN approval ON approval.app_id=approval_emp_ot.app_id AND approval.year_id='".$year_id."' AND approval.app_month='".$curMonth."'   
                    LEFT JOIN approval_emp ON approval_emp.app_emp_id=approval_emp_ot.app_emp_id 
                    LEFT JOIN employees ON employees.id=approval_emp_ot.emp_id 
                    LEFT JOIN otrate ON otrate.otrate_id=approval_emp_ot.otrate_id
                    WHERE approval_emp_ot.emp_id IN (SELECT emp_id FROM approval_group WHERE dept_id = '".$_SESSION["deptid"]."')
                    AND MONTH(approval_emp_ot.ot_date)='".$curMonth."'                             
                    ORDER BY empid, approval_emp_ot.ot_date, approval_emp_ot.time_in";

                    // echo $sqlm;

                    $query = $conn->query($sql);
                    $i=0;
                    
                    while($row = $query->fetch_assoc()){
                        echo "
                          <tr>
                            <td class='hidden'></td>
                            <td align='center'>&#9658;</td>                          
                            <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                            <td>".DateShortThai(date('Y-m-d',strtotime($row['ot_date'])))."</td> 
                            <td>".$row['time_in']."</td>      
                            <td>".$row['time_out']."</td>                                                
                            <td>".$row['otrate_name']."</td>    
                          </tr>
                        ";                                                                     
                        $i++;                      
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
  <?php // include 'includes/otdata_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

window.setTimeout(function() {
  $(".alert").fadeTo(300, 0).slideUp(300, function(){
      $(this).remove(); 
    });
  }, 2000);
}
</script>
</body>
</html>
