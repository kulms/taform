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
      ใบสำคัญรับเงิน (รายเดือน)
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ใบสำคัญรับเงิน (รายเดือน)</li>
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
            <div class='alert alert-danger alert-dismissible' id='error-alert' role='alert' data-auto-dismiss='500'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible' id='success-alert' role='alert' data-auto-dismiss='500'>
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
                <h3 class="box-title">ค้นหาใบสำคัญรับเงิน (รายเดือน)</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- <form id="frmMain" class="form-horizontal" action="approval_form.php" method="post" enctype="multipart/form-data"> -->
              <form class="form-horizontal" method="POST" action="receipt_form.php">  
                <div class="box-body">                                        
                  <div class="form-group">
                    <label for="year_id" class="col-sm-1 control-label">ปีการศึกษา <span style="color:red;">*</span></label>
                    <div class="col-sm-2">
                      <?php						  
                        $sql = "select fiscal_id, fiscal_name from fiscal order by fiscal_name DESC;";
                        $query = $conn->query($sql);
                        // if(isset($_SESSION["apyear_id"])){
                        //   $oldcurYearId = $_SESSION["apyear_id"];
                        //   $curYear = getYearNamefromYearId($conn,$oldcurYearId);
                        // }else{
                        //   $curYear = date('Y')+543;	
                        // }                        
                        $curYear = date('Y')+543;	
                        // echo $curYear;
                      ?>
                      <select class="form-control" id="fiscal_id" name="fiscal_id" required>
                          <option value="">Not Selected</option>                            
                          <?php
                          while($yrow = $query->fetch_assoc()){
                            if($yrow["fiscal_name"]==$curYear){
                              echo "
                              <option value='".$yrow['fiscal_id']."' selected>".$yrow['fiscal_name']."</option>
                              ";
                            }else{
                              echo "
                              <option value='".$yrow['fiscal_id']."'>".$yrow['fiscal_name']."</option>
                              ";	
                            }
                          }
                          $query->free_result();
                          ?>                          
                      </select>  
                    </div>
                    <?php 
                    // if(!isset($_POST['year_id'])){                      
                    //   if(isset($_SESSION['apcurMonth'])){                    
                    //     $curMonth =  $_SESSION["apcurMonth"];
                    //   }else{
                    //     $curMonth = date('n');
                    //   }  
                    // }else{
                    //   $curMonth = $_POST['app_month'];
                    // }
                    // if(isset($_SESSION['apcurMonth'])){                    
                    //   $curMonth =  $_SESSION["apcurMonth"];
                    // }  
                    ?>
                    <label for="sem_id" class="col-sm-2 control-label">ภาคการศึกษา <span style="color:red;">*</span></label>
                    <div class="col-sm-2">                      
                    <?php						  
                      $sql = "select sem_id, sem_name from ta_sem order by sem_id;";
                      // $query = mysqli_query($conn,$sql);
                      $query = $conn->query($sql);
                      ?>
                        <select class="form-control" id="sem_id" name="sem_id" required>
                          <option value="">Not Selected</option>
                          <?php
                          // while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                          while($row = $query->fetch_assoc()){
                          ?>
                            <option value="<?php echo $row["sem_id"];?>">
                              <?php echo $row["sem_name"];?>
                            </option>
                          <?php
                          }
                          // mysqli_free_result($query);
                          $query->free_result();
                          ?>
                        </select>
                    </div>

                    <label for="month_id" class="col-sm-2 control-label">เดือน <span style="color:red;">*</span></label>
                    <div class="col-sm-2">
                      <?php						  
                      if(!isset($_POST['fiscal_id'])){                      
                        // if(isset($_SESSION['apcurMonth'])){                    
                        //   $curMonth =  $_SESSION["apcurMonth"];
                        // }else{
                          $curMonth = date('n');
                        // }  
                      }else{
                        $curMonth = $_POST['month_id'];
                      }
                      ?>
                        <select class="form-control" id="month_id" name="month_id" required>
                          <option value="">Not Selected</option>
                          <option value="1" <?php if($curMonth==1) echo "selected";?>>มกราคม</option>
                          <option value="2" <?php if($curMonth==2) echo "selected";?>>กุมภาพันธ์</option>
                          <option value="3" <?php if($curMonth==3) echo "selected";?>>มีนาคม</option>
                          <option value="4" <?php if($curMonth==4) echo "selected";?>>เมษายน</option>
                          <option value="5" <?php if($curMonth==5) echo "selected";?>>พฤษภาคม</option>
                          <option value="6" <?php if($curMonth==6) echo "selected";?>>มิถุนายน</option>
                          <option value="7" <?php if($curMonth==7) echo "selected";?>>กรกฎาคม</option>
                          <option value="8" <?php if($curMonth==8) echo "selected";?>>สิงหาคม</option>
                          <option value="9" <?php if($curMonth==9) echo "selected";?>>กันยายน</option>
                          <option value="10" <?php if($curMonth==10) echo "selected";?>>ตุลาคม</option>
                          <option value="11" <?php if($curMonth==11) echo "selected";?>>พฤศจิกายน</option>
                          <option value="12" <?php if($curMonth==12) echo "selected";?>>ธันวาคม</option>
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
        
        if(isset($_POST['fiscal_id']) && isset($_POST['sem_id']) && isset($_POST['month_id'])){
          $fiscal_id = $_POST['fiscal_id'];
          $sem_id = $_POST['sem_id'];
          $month_id = $_POST['month_id'];

          $sqlCurrYear = "SELECT fiscal_id, fiscal_name FROM fiscal WHERE fiscal_id = '".$_POST['fiscal_id']."'";
          $qCurrYear = $conn->query($sqlCurrYear);
          $rowCurrYear = $qCurrYear->fetch_assoc();
          $fiscal_name = $rowCurrYear["fiscal_name"];

          $sqlCurrSem = "SELECT sem_id, sem_name FROM ta_sem WHERE sem_id = '".$_POST['sem_id']."'";
          $qCurrSem = $conn->query($sqlCurrSem);
          $rowCurrSem = $qCurrSem->fetch_assoc();
          $sem_name = $rowCurrSem["sem_name"];          

          if($_SESSION["deptid"]=='99'){
            $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' ";
          }else{
            $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' AND a.dept_id='".$_SESSION["deptid"]."' ";
          }

        }else{
          $fiscal_id = 0;
          $sem_id = 0;
          $month_id = 0;
          $sem_name = "-";

          if($_SESSION["deptid"]=='99'){
            $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' ";
          }else{
            $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' AND a.dept_id='".$_SESSION["deptid"]."' ";
          }
        }
        // if(isset($_POST['year_id'])){
        //   $sqlCurrYear = "SELECT year_id, year_name FROM years WHERE year_id = '".$_POST['year_id']."'";
        //   $qCurrYear = $conn->query($sqlCurrYear);
        //   $rowCurrYear = $qCurrYear->fetch_assoc();
        //   $year_name = $rowCurrYear["year_name"];

        //   if($_POST['app_month']==""){
        //     $year_id = $_POST['year_id'];
        //     if($_SESSION["deptid"]=='99'){
        //       $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
        //     }else{
        //       $sqlCondition.=" AND a.year_id='".$year_id."' ";
        //     } 
        //     $curMonth = 0; 
            
        //     if(isset($_SESSION['apyear_id'])){
        //       unset($_SESSION['apyear_id']);
        //     }
        //     if(isset($_SESSION['apcurMonth'])){
        //         unset($_SESSION['apcurMonth']);
        //     }
        //     $_SESSION["apyear_id"]=$year_id;
        //     $_SESSION["apcurMonth"]=$curMonth;

        //   }else{
        //     $year_id = $_POST['year_id'];
        //     $app_month = $_POST['app_month'];               
        //     if($_SESSION["deptid"]=='99'){
        //       $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.app_month = '".$app_month."' ";
        //     }else{
        //       $sqlCondition.=" AND a.year_id='".$year_id."' AND a.app_month = '".$app_month."' ";
        //     } 
        //     $curMonth = $_POST['app_month'];   
            
        //     if(isset($_SESSION['apyear_id'])){
        //       unset($_SESSION['apyear_id']);
        //     }
        //     if(isset($_SESSION['apcurMonth'])){
        //         unset($_SESSION['apcurMonth']);
        //     }
        //     $_SESSION["apyear_id"]=$year_id;
        //     $_SESSION["apcurMonth"]=$curMonth;

        //   }
        // }else{
        //   if(isset($_SESSION['apyear_id'])){
        //     $curYearId = $_SESSION['apyear_id'];
        //     $curMonth =  $_SESSION["apcurMonth"];
        //     $sqlCurrYear = "SELECT year_id, year_name FROM years WHERE year_id = '".$curYearId."'";
        //     $qCurrYear = $conn->query($sqlCurrYear);
        //     $rowCurrYear = $qCurrYear->fetch_assoc();
        //     $curYear = $rowCurrYear["year_name"];
        //     $year_name = $rowCurrYear["year_name"];
        //     // $curMonth = date('n');	
        //     //echo $curMonth;

        //     if($_SESSION["deptid"]=='99'){
        //       $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.app_month='".$curMonth."' ";
        //     }else{
        //       $sqlCondition.=" AND a.year_id='".$rowCurrYear["year_id"]."' AND a.app_month='".$curMonth."' ";
        //     }
        //   }else{
        //     $sqlCurrYear = "SELECT year_id, year_name FROM years WHERE year_name LIKE '".$curYear."'";
        //     $qCurrYear = $conn->query($sqlCurrYear);
        //     $rowCurrYear = $qCurrYear->fetch_assoc();

        //     $year_name = $rowCurrYear["year_name"];

        //     // $curMonth = date('n');	
        //     //echo $curMonth;

        //     if($_SESSION["deptid"]=='99'){
        //       $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.app_month='".$curMonth."' ";
        //     }else{
        //       $sqlCondition.=" AND a.year_id='".$rowCurrYear["year_id"]."' AND a.app_month='".$curMonth."' ";
        //     }
        //   }


        // }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <?php
            if($_SESSION["is_admin"]=='1'){
            ?>
            <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div> -->
            <?php
            }
            ?>
            <div class="box-body">
              <!-- <h4 class="box-title"> 
              แสดงผลแบบฟอร์มขออนุมัติ ปี พ.ศ.<?php echo $curYear;?> เดือน <?php echo MonthThai($curMonth);?>
              </h4> -->
              <h4 class="box-title"> 
              <!-- แสดงผลแบบฟอร์มขออนุมัติเบิกเงินทุนผู้ช่วยสอน (รายเดือน) ปี พ.ศ.<?php echo $year_name;?> เดือน <?php echo MonthThai($curMonth);?> -->
              แสดงผลใบสำคัญรับเงิน (รายเดือน) ปีการศึกษา <?php echo $curYear;?> ภาคการศึกษา <?php echo $sem_name;?> เดือน <?php echo MonthThai($month_id);?>
              </h4>
              <table id="propose" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>                  
                  <!-- <th width="1%">เดือน</th> -->
                  <th width="1%"></th>
                  <th width="5%">ครั้งที่</th>                  
                  <th width="29%">หน่วยงาน</th>
                  <!-- <th>Name</th> -->
                  <!-- <th width="8%">แหล่งเงิน</th>
                  <th width="8%">สถานะ</th> -->
                  <th width="9%">วันที่สร้างเอกสาร</th>
                  <!-- <th width="9%">วันที่สิ้นสุด</th> -->
                  <!-- <th>Time Out</th> -->
                  <th width="30%">ดำเนินการ</th>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT a.*, d.dept_name, f.fiscal_name, s.sem_name
                              FROM approval a 
                                  LEFT JOIN ta_dept d ON d.dept_id=a.dept_id 
                                  LEFT JOIN fiscal f ON f.fiscal_id=a.fiscal_id
                                  LEFT JOIN ta_sem s ON s.sem_id=a.sem_id
                            ".$sqlCondition."
                              ORDER BY a.app_times ASC, CONVERT(dept_name USING tis620)";
                    // echo $sql; 
                    $query = $conn->query($sql);
                    $i=1;
                    while($row = $query->fetch_assoc()){
                      echo "
                      <tr>
                        <td class='hidden'></td>
                        <td>ปีการศึกษา ".$row['fiscal_name']." ".$row['sem_name']."</td>                                                      
                        <td></td>         
                        <td style='text-align:center'>ครั้งที่ ".$row['app_times']." เดือน ".MonthThai($month_id)."</td>         
                        <td>".$row['dept_name']."</td>                          
                        <td>".DateShortThai($row['start_date'])."</td>                                                  
                        <td>                        
                          <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"receipt.php?appid=".$row['app_id']."&month=".$month_id."\"' ><i class='fa fa-users'></i> ดูรายชื่อนิสิต</button>                                                    
                        </td>
                      </tr>
                      ";                                        
                      $i++;
                    }
                    $query->free_result();
                                        
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
  <?php include 'includes/approval_form_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

window.setTimeout(function() {
  $(".alert").fadeTo(300, 0).slideUp(300, function(){
      $(this).remove(); 
  });
}, 2000);

$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    //alert(id);
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
    url: 'approval_form_row.php',
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
      $('#edit_year_id').val(response.year_id);
      $('#edit_app_month').val(response.app_month);
      $('#edit_dept_id').val(response.dept_id);
      $('#edit_app_type_id').val(response.app_type_id);
      $('#edit_app_name').val(response.app_name);
      $('#app_id').val(response.app_id);
      $('#edit_app_detail').val(response.app_detail);
      $('#edit_app_doc_no').val(response.app_doc_no);
      $('#datepicker_edit').val(response.app_date);
      $('#edit_app_head').val(response.app_head);
      $('#edit_app_head_position').val(response.app_head_position);
      $('#edit_budget').val(response.budget);

      $('#del_year_id').val(response.year_id);
      $('#del_app_month').val(response.app_month);
      $('#del_dept_id').val(response.dept_id);
      $('#del_app_type_id').val(response.app_type_id);
      $('#del_app_name').val(response.app_name);
      $('#del_app_id').val(response.app_id);
      $('#del_app_detail').val(response.app_detail);
      $('#del_app_doc_no').val(response.app_doc_no);
      $('#datepicker_del').val(response.app_date);
      $('#del_app_head').val(response.app_head);
      $('#del_app_head_position').val(response.app_head_position);
      $('#del_budget').val(response.budget);

    }
  });
}
</script>
</body>
</html>
