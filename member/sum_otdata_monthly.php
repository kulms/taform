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
      สรุปการจ่ายเงินแต่ละเดือน
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">สรุปการจ่ายเงินแต่ละเดือน</li>
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
                <h3 class="box-title">ระบุเวลาปฏิบัติงาน</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- <form id="frmMain" class="form-horizontal" action="approval_form.php" method="post" enctype="multipart/form-data"> -->
              <form class="form-horizontal" method="POST" action="sum_otdata_monthly.php">  
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
                              <option value='".$yrow['year_name']."' selected>".$yrow['year_name']."</option>
                              ";
                            }else{
                              echo "
                              <option value='".$yrow['year_name']."'>".$yrow['year_name']."</option>
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
            $curYear = $year_id;
            $year_id = $year_id-543;
            if($_SESSION["deptid"]=='99'){
              // $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
              $sqlCondition.=" WHERE YEAR(ot_date)='".$year_id."' ";
              // WHERE YEAR(ot_date) = '2018' AND  MONTH(ot_date) = '8'
            } 
            $curMonth = 0; 
          }else{
            $year_id = $_POST['year_id'];
            $curYear = $year_id;
            $year_id = $year_id-543;
            $otdata_month = $_POST['otdata_month'];               
            if($_SESSION["deptid"]=='99'){
              // $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.otdata_month = '".$otdata_month."' ";
              $sqlCondition.=" WHERE YEAR(ot_date)='".$year_id."' AND MONTH(ot_date)='".$otdata_month."' ";
            } 
            $curMonth = $_POST['otdata_month'];      
          }
        }else{
          $sqlCurrYear = "SELECT year_id FROM years WHERE year_name LIKE '".$curYear."'";
          $qCurrYear = $conn->query($sqlCurrYear);
          $rowCurrYear = $qCurrYear->fetch_assoc();

          $curMonth = date('n');	

          if($_SESSION["deptid"]=='99'){
            // $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.otdata_month='".$curMonth."' ";
            $sqlCondition.=" WHERE YEAR(ot_date)='".$rowCurrYear["year_id"]."' AND MONTH(ot_date)='".$curMonth."' ";
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
              แสดงผลข้อมูลสรุปการจ่ายเงินแต่ละเดือน ปี พ.ศ.<?php echo $curYear;?> เดือน <?php echo MonthThai($curMonth);?>
              </h4>
                <?php 
                // echo $_POST['year_id']." - ".$_POST['otdata_month'];
                $data_otmonth = array();	
                $data_sumhr = array();	
                $data_sumot = array();	
                $strMonth = "";

                if(isset($_POST['year_id'])&&isset($_POST['otdata_month'])){
                   if($_POST['otdata_month']==""){

                    if($_SESSION["deptid"]=='99'){                                                       
                       $sqlg = "SELECT    
                                YEAR(ot_date) AS otyear,
                                MONTH(ot_date) AS otmonth,
                                SUM(num_hr) AS sumhr, 
                                SUM(num_min) AS summin,
                                SUM(ot_amount) AS sumot
                                FROM
                                    otdata_time_cal
                                    ".$sqlCondition."                      
                                GROUP BY otyear,otmonth
                                ORDER BY otyear,otmonth LIMIT 0,12";
                        // echo $sqlg;

                        $queryg = $conn->query($sqlg);
                        $i=0;                                                

                        while($rowg = $queryg->fetch_assoc()){
                          $data_otmonth[] = $thaimonth[$rowg['otmonth']-1];
                          $strMonth .= '"' . $thaimonth[$rowg['otmonth']-1] . '",'; 
                          $data_sumhr[] = $rowg['sumhr'];
                          $data_sumot[] = $rowg['sumot'];                                                                          
                          $i++;                      
                        } 

                    }

                    // $strMonth = join($data_otmonth, ',');
                    $strSumOT = join($data_sumot, ',');
                    // echo $strMonth."<br>".$strSumOT;
                ?>
                <div class="col-md-12">
									<div id="container2" style="min-width: 310px; max-width: 99%; height: 550px; margin: 0 auto"></div>
							  </div>
                <div class="col-md-12">
                  <!-- /.row -->
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text"><?php echo $data_otmonth[0];?></span>
                          <span class="info-box-number"><?php echo number_format($data_sumhr[0]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo number_format($data_sumot[0]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[1];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[1]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[1]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[2];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[2]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[2]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[3];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[3]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[3]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->                    
                  </div>
                  <!-- /.row -->
                    <!-- /.row -->
                    <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[4];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[4]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[4]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[5];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[5]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[5]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[6];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[6]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[6]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[7];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[7]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[7]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->                    
                  </div>
                  <!-- /.row -->   
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[8];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[8]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[8]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[9];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[9]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[9]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[10];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[10]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[10]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text"><?php echo @$data_otmonth[11];?></span>
                          <span class="info-box-number"><?php echo @number_format($data_sumhr[11]);?> ชั่วโมง</span>
                          <span class="info-box-number"><?php echo @number_format($data_sumot[11]);?> บาท</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->                    
                  </div>
                  <!-- /.row -->                
                </div>
                <?php
                   }
                }
                ?>


              </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-upload"></i> Import Data</a>
            </div> -->
            <div class="box-body">
              <h4 class="box-title"> 
              แสดงผลข้อมูลสรุปการจ่ายเงินแต่ละเดือน ปี พ.ศ.<?php echo $curYear;?> เดือน <?php echo MonthThai($curMonth);?>
              </h4>
              <table id="example4" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <!-- <th width="3%">#</th>                   -->
                  <th width="15%">เดือน</th>
                  <!-- <th width="29%">หน่วยงาน</th> -->
                  <!-- <th>Name</th> -->
                  <th width="15%">จำนวน (ชั่วโมง)</th>
                  <th width="15%">จำนวน (นาที)</th>
                  <th width="15%">จำนวนเงินค่าล่วงเวลา (บาท)</th>
                  <!-- <th width="10%">วงเงินค่าตอบแทน (บาท)</th> -->
                  <!-- <th>Time Out</th> -->
                  <!-- <th width="15%">ดำเนินการ</th> -->
                </thead>
                <tbody>
                  <?php
                    // $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";                                      
                    
                    if($_SESSION["deptid"]=='99'){                      
                      // $sqlm = "SELECT a.*, y.year_name 
                      //     FROM otdata a                           
                      //     LEFT JOIN years y ON y.year_id=a.year_id                          
                      //     ".$sqlCondition."
                      //     ORDER BY a.otdata_month DESC";        
                      // $sqlm = "SELECT    
                      //     YEAR(ot_date) AS otyear,
                      //     MONTH(ot_date) AS otmonth,
                      //     FORMAT(SUM(num_hr),0) AS sumhr, 
                      //     FORMAT(SUM(num_min),0) AS summin,
                      //     FORMAT(SUM(ot_amount),2) AS sumot
                      // FROM
                      //     otdata_time_cal
                      //     ".$sqlCondition."                      
                      // GROUP BY otyear,otmonth
                      // ORDER BY otyear,otmonth";
                      $sqlm = "SELECT    
                           YEAR(ot_date) AS otyear,
                           MONTH(ot_date) AS otmonth,
                           SUM(num_hr) AS sumhr, 
                           SUM(num_min) AS summin,
                           SUM(ot_amount) AS sumot
                       FROM
                           otdata_time_cal
                           ".$sqlCondition."                      
                       GROUP BY otyear,otmonth
                       ORDER BY otyear,otmonth";
                    }

                    // echo $sqlm;
                    $sum_all_hr = 0;
                    $sum_all_min = 0;
                    $sum_all_ot = 0;

                    $querym = $conn->query($sqlm);
                    $i=0;
                    
                    while($rowm = $querym->fetch_assoc()){
                      // if($rowm['otdata_status']==0){
                      //   $strStatus = "<font color='#f39c12'>ยังไม่คำนวณ</font>";
                      // }else{
                      //   $strStatus = "<font color='#00a65a'>คำนวณค่าล่วงเวลาแล้ว</font>";
                      // }  
                      $year_ot = $rowm['otyear']+543;
                      if($_SESSION["deptid"]=='99'){
                        echo "
                          <tr>
                            <td class='hidden'></td>                            
                            <td>(".$rowm['otmonth'].") ".$thaimonth[$rowm['otmonth']-1]." ".$year_ot."</td>                          
                            <td>".number_format($rowm['sumhr'])."</td>                                                      
                            <td>".number_format($rowm['summin'])."</td>
                            <td>".number_format($rowm['sumot'],2)."</td>                                                        
                          </tr>
                        ";               
                        $sum_all_hr += $rowm['sumhr'];
                        $sum_all_min += $rowm['summin'];
                        $sum_all_ot += $rowm['sumot'];                              
                      }                                                 
                    $i++;                      
                    }
                    if($_SESSION["deptid"]=='99'){
                      echo "
                        <tr>
                          <td bgcolor='#ecf0f5' class='hidden'></td>
                          <td bgcolor='#ecf0f5' align='center'><b>รวมทั้งสิ้น</b></td>                                                        
                          <td bgcolor='#ecf0f5'><b>".number_format($sum_all_hr)."</b></td>                                                      
                          <td bgcolor='#ecf0f5'><b>".number_format($sum_all_min)."</b></td>                                                        
                          <td bgcolor='#ecf0f5'><b>".number_format($sum_all_ot,2)."</b></td>                                                        
                        </tr>
                      ";                                               
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
<!-- highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
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
<script type="text/javascript">
$(function () {
		Highcharts.chart('container2', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'จำนวนเงินเบิกค่าล่วงเวลาแต่ละเดือน'
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				// categories: ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"],
        categories: [<?php echo $strMonth;?>],				
        title: {
					text: null
				},
				labels: {
					style: {						
						fontSize:'14px'
					}
            	}
			},
			yAxis: {
				min: 0,
				allowDecimals: false,
				title: {
					text: 'ค่าล่วงเวลา (บาท)',
					align: 'high'
				},
				labels: {
					overflow: 'justify'
				}
			},
			tooltip: {
				valueSuffix: ' บาท'
			},
			plotOptions: {
				bar: {
					dataLabels: {
						enabled: true
					}
				}
			},
			legend: {
				reversed: false
			},
			credits: {
				enabled: false
			},
			series: [{
				name: 'จำนวนค่าล่วงเวลา ',
				data: [<?php echo $strSumOT;?>],
				// color: '#ff6b5e'
			}]
		});
	});
</script>
</body>
</html>
