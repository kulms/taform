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
      ข้อมูลจากเครื่องสแกน
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ข้อมูลจากเครื่องสแกน</li>
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
                <h3 class="box-title">ค้นหาข้อมูลจากเครื่องสแกน</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- <form id="frmMain" class="form-horizontal" action="approval_form.php" method="post" enctype="multipart/form-data"> -->
              <form class="form-horizontal" method="POST" action="otscan.php">  
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
                      <select class="form-control" name="otdata_month" id="otdata_month">
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
            if($_SESSION["deptid"]=='99'){
              $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
            }else{
              $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
            } 
            $curMonth = 0; 
          }else{
            $year_id = $_POST['year_id'];
            $otdata_month = $_POST['otdata_month'];               
            if($_SESSION["deptid"]=='99'){
              $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.otdata_month = '".$otdata_month."' ";
            }else{
              $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.otdata_month = '".$otdata_month."' ";
            } 
            $curMonth = $_POST['otdata_month'];      
          }
        }else{
          $sqlCurrYear = "SELECT year_id FROM years WHERE year_name LIKE '".$curYear."'";
          $qCurrYear = $conn->query($sqlCurrYear);
          $rowCurrYear = $qCurrYear->fetch_assoc();

          $curMonth = date('n');	

          if($_SESSION["deptid"]=='99'){
            $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.otdata_month='".$curMonth."' ";
          }else{
            $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.otdata_month='".$curMonth."' ";
          }
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
              แสดงผลข้อมูลจากเครื่องสแกน ปี พ.ศ.<?php echo $curYear;?> เดือน <?php echo MonthThai($curMonth);?>
              </h4>
              <table id="example3" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>                  
                  <th width="1%">เดือน</th>
                  <!-- <th width="29%">หน่วยงาน</th> -->
                  <!-- <th>Name</th> -->
                  <th width="20%">ชื่อเอกสาร</th>
                  <th width="10%">สถานะ</th>
                  <th width="10%">วันที่นำเข้า</th>
                  <!-- <th width="10%">วงเงินค่าตอบแทน (บาท)</th> -->
                  <!-- <th>Time Out</th> -->
                  <th width="15%">ดำเนินการ</th>
                </thead>
                <tbody>
                  <?php
                    // $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";                                      
                    
                    if($_SESSION["deptid"]=='99'){                      
                      $sqlm = "SELECT a.*, y.year_name 
                          FROM otdata a                           
                          LEFT JOIN years y ON y.year_id=a.year_id                          
                          ".$sqlCondition."
                          ORDER BY a.otdata_month DESC";        
                    }else{
                        $sqlm = "SELECT a.*, y.year_name 
                          FROM otdata a                           
                          LEFT JOIN years y ON y.year_id=a.year_id                          
                          ".$sqlCondition."
                          ORDER BY a.otdata_month DESC";
                    }

                    // echo $sqlm;

                    $querym = $conn->query($sqlm);
                    $i=0;
                    
                    while($rowm = $querym->fetch_assoc()){
                      if($rowm['otdata_status']==0){
                        $strStatus = "<font color='#f39c12'>ยังไม่คำนวณ</font>";
                      }else{
                        $strStatus = "<font color='#00a65a'>คำนวณค่าล่วงเวลาแล้ว</font>";
                      }  
                      //if($_SESSION["deptid"]=='99'){
                        echo "
                          <tr>
                            <td class='hidden'></td>
                            <td align='center'>&#9658;</td>                          
                            <td>(".$rowm['otdata_month'].") ".$thaimonth[$rowm['otdata_month']-1]." ".$rowm['year_name']."</td>                          
                            <td>".$rowm['otdata_name']."</td>                                                      
                            <td>".$strStatus."</td>
                            <td>".DateShortThai(date('Y-m-d',strtotime($rowm['create_date'])))."</td>                                                      
                            <td>
                              <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"otscan_view.php?otdataid=".$rowm['otdata_id']."\"' ><i class='fa fa-eye'></i> ดูข้อมูลจากเครื่องสแกน</button>
                            </td>
                          </tr>
                        ";                                               
                      //}                                                 
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
  <?php include 'includes/otdata_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

window.setTimeout(function() {
  $(".alert").fadeTo(300, 0).slideUp(300, function(){
      $(this).remove(); 
  });
}, 2000);

$(function(){
  // $('.edit').click(function(e){
  //   e.preventDefault();
  //   $('#edit').modal('show');
  //   var id = $(this).data('id');
  //   //alert(id);
  //   getRow(id);
  // });

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
    url: 'otdata_row.php',
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
      // alert(response.dept_id);
      // $('#edit_year_id').val(response.year_id);
      // $('#edit_app_month').val(response.app_month);
      // $('#edit_dept_id').val(response.dept_id);
      // $('#edit_app_type_id').val(response.app_type_id);
      // $('#edit_app_name').val(response.app_name);
      // $('#app_id').val(response.app_id);
      // $('#edit_app_detail').val(response.app_detail);
      // $('#edit_app_doc_no').val(response.app_doc_no);
      // $('#datepicker_edit').val(response.app_date);
      // $('#edit_app_head').val(response.app_head);
      // $('#edit_app_head_position').val(response.app_head_position);
      // $('#edit_budget').val(response.budget);

      $('#del_year_id').val(response.year_id);
      $('#del_otdata_month').val(response.otdata_month);
      $('#del_otdata_name').val(response.otdata_name);
      $('#del_otdata_id').val(response.otdata_id);

    }
  });
}
</script>
</body>
</html>
