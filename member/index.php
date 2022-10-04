<?php 
session_start();
if(isset($_SESSION['member'])){
  header('location:home.php');
}
include 'includes/conn.php';
?>
<?php 
  include '../timezone.php'; 
  // $today = date('Y-m-d');
  // $year = date('Y');
  // if(isset($_GET['year'])){
  //   $year = $_GET['year'];
  // }
  $sqlCondition = "";
  if(isset($_POST['fiscal_id']) && isset($_POST['sem_id']) && isset($_POST['month_id']) && isset($_POST['dept_id'])){
    $fiscal_id = $_POST['fiscal_id'];
    $sem_id = $_POST['sem_id'];
    $month_id = $_POST['month_id'];
    $dept_id = $_POST['dept_id'];

    $sqlCurrYear = "SELECT fiscal_id, fiscal_name FROM fiscal WHERE fiscal_id = '".$_POST['fiscal_id']."'";
    $qCurrYear = $conn->query($sqlCurrYear);
    $rowCurrYear = $qCurrYear->fetch_assoc();
    $fiscal_name = $rowCurrYear["fiscal_name"];

    $sqlCurrSem = "SELECT sem_id, sem_name FROM ta_sem WHERE sem_id = '".$_POST['sem_id']."'";
    $qCurrSem = $conn->query($sqlCurrSem);
    $rowCurrSem = $qCurrSem->fetch_assoc();
    $sem_name = $rowCurrSem["sem_name"];  
    
    $sqlCurrDept = "SELECT dept_id, dept_name FROM ta_dept WHERE dept_id = '".$_POST['dept_id']."'";
    $qCurrDept = $conn->query($sqlCurrDept);
    $rowCurrDept = $qCurrDept->fetch_assoc();
    $dept_name = $rowCurrDept["dept_name"];  

    // if($_SESSION["deptid"]=='99'){
    //   $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' ";
    // }else{
      $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' AND a.dept_id='".$dept_id."' ";
    // }

  }else{
    $fiscal_id = 0;
    $sem_id = 0;
    $month_id = 0;
    $dept_id = 0;
    $sem_name = "-";

    // if($_SESSION["deptid"]=='99'){
    //   $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' ";
    // }else{
      $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' AND a.dept_id='".$dept_id."' ";
    // }
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  	<?php include 'includes/navbar_index.php'; ?>
  	<?php include 'includes/menubar_index.php'; ?>
    <?php include 'includes/functions.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        หน้าหลัก
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="active">Dashboard</li> -->
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
      <!-- Small boxes (Stat box) -->

      <!-- /.row -->
      <?php
      // if($_SESSION["deptid"]=='99'){
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลสถานะการเบิกเงินทุนผู้ช่วยสอน</h3>
              <div class="box-tools pull-right">
                <!-- <form class="form-inline">
                  <div class="form-group">
                    <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                      <?php
                        // for($i=2015; $i<=2065; $i++){
                        //   $selected = ($i==$year)?'selected':'';
                        //   echo "
                        //     <option value='".$i."' ".$selected.">".$i."</option>
                        //   ";
                        // }
                      ?>
                    </select>
                  </div>
                </form> -->
              </div>
            </div>
            <div class="box-body">
              <!-- <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div> -->
              <div class="box-header with-border">
                <h3 class="box-title">ค้นหาข้อมูลการเบิกจ่าย</h3>                    
              </div>
              
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="box-body">
                <span style="color:red;">* ต้องระบุข้อมูล</span>
                  <div class="form-group">
                    <label for="fiscal_id" class="col-sm-2 control-label">ปีการศึกษา <span style="color:red;">*</span></label>
                    <div class="col-sm-2">
                      <?php						  
                      $sql = "select fiscal_id, fiscal_name from fiscal order by fiscal_name DESC;";
                      // $query = mysqli_query($conn,$sql);
                      $query = $conn->query($sql);
                      $curYear = date('Y')+543;	
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
                          $query->free();
                          ?>
                        </select>                            
                    </div>
                    <label for="sem_id" class="col-sm-1 control-label">ภาคการศึกษา <span style="color:red;">*</span></label>
                    <div class="col-sm-2">
                      <?php						  
                      $sql = "select sem_id, sem_name from ta_sem order by sem_id;";
                      // $query = mysqli_query($conn,$sql);
                      $query = $conn->query($sql);
                      ?>
                        <select class="form-control" id="sem_id" name="sem_id" required>
                          <option value="0">Not Selected</option>
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
                          $query->free();
                          ?>
                        </select>
                    </div>
                    <label for="month_id" class="col-sm-1 control-label">เดือน <span style="color:red;">*</span></label>
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
                  <div class="form-group">                    
                    <label for="dept_id" class="col-sm-2 control-label">หน่วยงาน <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                      <?php						  
                      $sql = "select dept_id, dept_name from ta_dept order by CONVERT(dept_name USING tis620);";
                      // $query = mysqli_query($conn,$sql);
                      $query = $conn->query($sql);
                      ?>
                        <select class="form-control" id="dept_id" name="dept_id">
                          <option value="">Not Selected</option>
                          <?php
                          // while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                          while($row = $query->fetch_assoc()){
                          ?>
                            <option value="<?php echo $row["dept_id"];?>">
                              <?php echo $row["dept_name"];?>
                            </option>
                            <?php
                          }
                          // mysqli_free_result($query);
                          $query->free();
                      ?>
                        </select>                            
                    </div>                        
                  </div>                      
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary" name="search" value="1">Search</button>
                </div>
                <!-- /.box-footer -->
              </form>                  
              <hr>
              <table id="example6" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>                  
                  <th width="1%">เดือน</th>
                  <th width="1%"></th>
                  <th width="10%">รหัสนิสิต</th>
                  <th width="15%">ชื่อ – สกุล</th>
                  <th width="15%">อัตราค่าสอนต่อเดือน (บาท)</th>                  
                  <th width="20%">หน่วยงาน</th>
                  <th width="10%">สถานะการเบิกเงิน</th>
                  <th width="10%">ดำเนินการ</th>
                  <!-- <th>Name</th> -->
                  <!-- <th width="8%">แหล่งเงิน</th>
                  <th width="8%">สถานะ</th> -->
                  <th width="9%">วันที่ปรับปรุง</th>
                  <!-- <th>Time Out</th> -->
                  <!-- <th width="30%">ดำเนินการ</th> -->
                </thead>
                <tbody>
                  <?php                    
                    // if($_SESSION["deptid"]=='99'){
                    //   $sql = "SELECT a.*, d.dept_name, y.year_name, at.app_type_name 
                    //           FROM approval a 
                    //               LEFT JOIN department d ON d.dept_id=a.dept_id 
                    //               LEFT JOIN years y ON y.year_id=a.year_id
                    //               LEFT JOIN app_type at ON at.app_type_id=a.app_type_id
                    //           WHERE a.app_status = 0    
                    //           ORDER BY a.app_month DESC, CONVERT(dept_name USING tis620), a.app_type_id";
                    // }else{
                    //   $sql = "SELECT a.*, d.dept_name, y.year_name, at.app_type_name 
                    //   FROM approval a 
                    //       LEFT JOIN department d ON d.dept_id=a.dept_id 
                    //       LEFT JOIN years y ON y.year_id=a.year_id
                    //       LEFT JOIN app_type at ON at.app_type_id=a.app_type_id
                    //   WHERE a.dept_id = '".$_SESSION["deptid"]."' AND a.app_status = 0
                    //   ORDER BY a.app_month DESC, CONVERT(dept_name USING tis620), a.app_type_id";
                    // }
                    // $query = $conn->query($sql);
                    // $i=1;
                    // while($row = $query->fetch_assoc()){                      
                    //   if($row['app_status']==0){
                    //     $strStatus = "<font color='#f39c12'>รอการอนุมัติ</font>";
                    //   }else{
                    //     $strStatus = "<font color='#00a65a'>ผ่านการอนุมัติ</font>";
                    //   }
                    //   if($_SESSION["deptid"]=='99'){
                    //     echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>".$row['year_name']."</td>                          
                    //         <td>".$thaimonth[$row['app_month']-1]." ".$row['year_name']."</td>                          
                    //         <td>".$row['dept_name']."</td>                          
                    //         <td>".$row['app_type_name']."</td>
                    //         <td>".$strStatus."</td>
                    //         <td>".DateShortThai($row['create_date'])."</td>                          
                    //         <td>
                    //           <button class='btn btn-info btn-sm btn-flat' onclick='location.href=\"approval_view.php?appid=".$row['app_id']."\"' ><i class='fa fa-thumbs-up'></i> ยืนยันแบบฟอร์ม</button>
                    //           <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$row['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>
                    //           <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['app_id']."'><i class='fa fa-edit'></i> แก้ไขแบบฟอร์ม</button>
                    //           <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['app_id']."'><i class='fa fa-trash'></i> ลบแบบฟอร์ม</button>
                    //         </td>
                    //       </tr>
                    //     ";
                    //   }else{
                    //     if($row['app_status']==0){
                    //       echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>".$row['year_name']."</td>                          
                    //         <td>".$thaimonth[$row['app_month']-1]." ".$row['year_name']."</td>                          
                    //         <td>".$row['dept_name']."</td>                          
                    //         <td>".$row['app_type_name']."</td>
                    //         <td>".$strStatus."</td>
                    //         <td>".DateShortThai($row['create_date'])."</td>                          
                    //         <td>                        
                    //           <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$row['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>
                    //           <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['app_id']."'><i class='fa fa-edit'></i> แก้ไขแบบฟอร์ม</button>
                    //           <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['app_id']."'><i class='fa fa-trash'></i> ลบแบบฟอร์ม</button>
                    //         </td>
                    //       </tr>
                    //       ";
                    //     }else{
                    //       echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>".$row['year_name']."</td>                          
                    //         <td>".$thaimonth[$row['app_month']-1]." ".$row['year_name']."</td>                          
                    //         <td>".$row['dept_name']."</td>                          
                    //         <td>".$row['app_type_name']."</td>
                    //         <td>".$strStatus."</td>
                    //         <td>".DateShortThai($row['create_date'])."</td>                          
                    //         <td>
                    //         <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval_view.php?appid=".$row['app_id']."\"' ><i class='fa fa-users'></i> ดูชื่อเจ้าหน้าที่</button>
                    //         </td>
                    //       </tr>
                    //       ";
                    //     }
                    //   }

                    //   $i++;
                    // }   
                    $sql = "SELECT a.app_id, DATE_FORMAT(a.create_date, '%Y') AS aYear
                            FROM approval a 
                                LEFT JOIN ta_dept d ON d.dept_id=a.dept_id 
                                LEFT JOIN fiscal f ON f.fiscal_id=a.fiscal_id
                                LEFT JOIN ta_sem s ON s.sem_id=a.sem_id
                          ".$sqlCondition."
                            ORDER BY a.app_times ASC, CONVERT(dept_name USING tis620)";
                    // echo $sql; 
                    $query = $conn->query($sql);  
                    if($query->num_rows > 0){
                      $row = $query->fetch_assoc();
                      $app_id = $row['app_id'];
                      $aYear = $row["aYear"]+543;
                      
                      $sqlAppRec = "SELECT *
                              FROM approval_std_rec                            
                              WHERE app_id=$app_id AND month_id=$month_id
                              ;";
                      $qAppRec = $conn->query($sqlAppRec);
                      $i=1;
                      while($rowAppRec = $qAppRec->fetch_assoc()){   
                        switch($rowAppRec["app_rec_status"]){
                          case 0:
                            $strRecStatus = "รอการเบิกจ่าย";
                            break;
                          case 1:
                            $strRecStatus = "เบิกจ่ายแล้ว";
                            break;
                        }                   
                        echo "
                            <tr>
                              <td class='hidden'></td>
                              <td>".$aYear."</td>                          
                              <td>".$thaimonth[$month_id]." 2565</td>        
                              <td></td>  
                              <td>".$rowAppRec["std_id"]."</td>                                 
                              <td>".$rowAppRec["std_title_name"].$rowAppRec["std_name"]."</td>     
                              <td>".$rowAppRec["std_amount"]."</td>                                 
                              <td>".$dept_name."</td>                          
                              <td>".$strRecStatus."</td>                          
                              <td> 
                              <button class='btn btn-success btn-sm btn-flat' onclick='location.href=\"receipt_std_generate.php?appsid=".$rowAppRec['app_std_id']."&appid=".$app_id."&month=".$month_id."\"' ><i class='fa fa-download'></i> Download ใบสำคัญรับเงิน</button>
                              </td>
                              <td>".DateShortThai($rowAppRec["lupdate_date"])."</td>                                   
                            </tr>
                            ";
                        $i++;
                      }
                      $qAppRec->free_result();
                    }
                    
                    // echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>2565</td>                          
                    //         <td>".$thaimonth[8]." 2565</td>        
                    //         <td></td>  
                    //         <td>6410545819</td>                                 
                    //         <td>นายคู่บุญ ยะใหม่วงศ์</td>     
                    //         <td>2,505.00</td>                                 
                    //         <td>ส่วนกลางคณะฯ</td>                          
                    //         <td>รอการเบิกจ่าย</td>                          
                    //         <td> 
                    //         <button class='btn btn-success btn-sm btn-flat' onclick='location.href=\"approval.php?appid=1\"' ><i class='fa fa-download'></i> Download ใบสำคัญรับเงิน</button>
                    //         </td>
                    //         <td>".DateShortThai('2022-09-13')."</td>                                   
                    //       </tr>
                    //       ";
                    // echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>2565</td>                          
                    //         <td>".$thaimonth[8]." 2565</td>        
                    //         <td></td>  
                    //         <td>6210502172</td>                                 
                    //         <td>นายวัชรวิชญ์ ศรีวัฒนะธรรมา</td>     
                    //         <td>2,505.00</td>                                 
                    //         <td>ส่วนกลางคณะฯ</td>                          
                    //         <td>รอการเบิกจ่าย</td>                          
                    //         <td> 
                    //         <button class='btn btn-success btn-sm btn-flat' onclick='location.href=\"approval.php?appid=1\"' ><i class='fa fa-download'></i> Download ใบสำคัญรับเงิน</button>
                    //         </td>
                    //         <td>".DateShortThai('2022-09-13')."</td>                                   
                    //       </tr>
                    //       ";                       
                  ?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php
      // }
      ?>
      </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- Chart Data -->
<?php
  // $and = 'AND YEAR(date) = '.$year;
  // $months = array();
  // $ontime = array();
  // $late = array();
  // for( $m = 1; $m <= 12; $m++ ) {
  //   $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 1 $and";
  //   $oquery = $conn->query($sql);
  //   array_push($ontime, $oquery->num_rows);

  //   $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 0 $and";
  //   $lquery = $conn->query($sql);
  //   array_push($late, $lquery->num_rows);

  //   $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
  //   $month =  date('M', mktime(0, 0, 0, $m, 1));
  //   array_push($months, $month);
  // }

  // $months = json_encode($months);
  // $late = json_encode($late);
  // $ontime = json_encode($ontime);

?>
<!-- End Chart Data -->
<?php include 'includes/scripts.php'; ?>
<script>
    function validateForm() {
														
      // var a = document.forms["reservation"]["room_reserve_name"].value;
      // if (a == "") {
      //   alert("โปรดระบุ ชื่อผู้ขอใช้ห้อง");
      //   document.getElementById("room_reserve_name").focus();
      //   return false;
      // }

      var b = document.getElementById("fiscal_id");
      var strRoom = b.options[b.selectedIndex].value;
      if(strRoom==0 || strRoom=="")
      {
        alert("โปรดระบุ ปีการศึกษา");
        b.focus();
        return false;
      }

      var c = document.getElementById("sem_id");
      var strSem = c.options[c.selectedIndex].value;
      if(strSem==0 || strSem=="")
      {
        alert("โปรดระบุ ภาคการศึกษา");
        c.focus();
        return false;
      }

      var d = document.getElementById("month_id");
      var strMonth = d.options[d.selectedIndex].value;
      if(strMonth==0 || strMonth=="")
      {
        alert("โปรดระบุ เดือน");
        d.focus();
        return false;
      }

      var e = document.getElementById("dept_id");
      var strDept = e.options[e.selectedIndex].value;
      if(strDept==0 || strDept=="")
      {
        alert("โปรดระบุ หน่วยงาน");
        e.focus();
        return false;
      }

      // var c = document.forms["reservation"]["datepicker"].value;
      // if (c == "") {
      //   alert("โปรดระบุ วันที่ใช้ห้อง");
      //   document.getElementById("datepicker").focus();
      //   return false;
      // }
      // var d = document.forms["reservation"]["s_htime"].value;
      // if (d == "") {
      //   alert("โปรดระบุ เวลาเริ่มต้น");
      //   document.getElementById("s_htime").focus();
      //   return false;
      // }
      // var e = document.forms["reservation"]["e_htime"].value;
      // if (e == "") {
      //   alert("โปรดระบุ เวลาสิ้นสุด");
      //   document.getElementById("e_htime").focus();
      //   return false;
      // }
      // var f = document.forms["reservation"]["room_subject"].value;
      // if (f == "") {
      //   alert("โปรดระบุ ชื่องาน");
      //   document.getElementById("room_subject").focus();
      //   return false;
      // }
                
    }
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>
</body>
</html>
