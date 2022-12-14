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
      กำหนดเวลาการทำงาน
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="approval_form.php"> แบบฟอร์มขออนุมัติ</a></li>
        <li><a href="approval.php?appid=<?php echo $app_id;?>"> กำหนดเจ้าหน้าที่</a></li>
        <li class="active">กำหนดเวลาการทำงาน</li>
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
                  <td width="12%" class="th-left-color">ส่วนงาน</td>
                  <td width="38%"><?php echo $row["app_detail"];?></td>                  
                  <td width="12%" class="th-left-color">เลขที่หนังสือ</td>
                  <td width="38%"><?php echo $row["app_doc_no"];?></td>
                </tr>                                                
                <tr>
                  <td class="th-left-color">วันที่สร้างเอกสาร</td>
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
                            $app_status = $row['app_status'];
                            if($app_status==0){
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
              <table id="example5" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th width="5%">#</th>
                  <th width="15%">ชื่อ-นามสกุล</th>
                  <th width="15%">ตำแหน่ง</th>
                  <th width="20%">วันที่</th>                  
                  <th width="45%">งานที่ปฏิบัติ</th>
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
                            WHERE approval_emp.app_id=$app_id AND approval_emp.emp_id=$emp_id
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
                                ORDER BY ot_date
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
              <hr>
              <?php 
              if($app_status==0){
              ?>  
              <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div>
              <?php
              }
              ?>
              <br>
              <table id="example4" class="table table-bordered table-striped table-hover">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>
                  <th width="15%">ชื่อ-นามสกุล</th>
                  <th width="8%">วันที่</th>
                  <th width="8%">เวลาเริ่มต้น</th>
                  <th width="8%">เวลาสิ้นสุด</th>
                  <th width="20%">งานที่ปฏิบัติ</th>
                  <th width="15%">อัตราค่าล่วงเวลา</th>
                  <th width="20%">ดำเนินการ</th>
                </thead>
                
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.id AS empid, approval_emp_ot.app_emp_ot_id AS appeotid, approval_emp_ot.reponsibility AS otreponsibility
                            FROM approval_emp_ot
                            LEFT JOIN approval ON approval.app_id=approval_emp_ot.app_id 
                            LEFT JOIN approval_emp ON approval_emp.app_emp_id=approval_emp_ot.app_emp_id 
                            LEFT JOIN employees ON employees.id=approval_emp_ot.emp_id 
                            LEFT JOIN otrate ON otrate.otrate_id=approval_emp_ot.otrate_id
                            WHERE approval_emp_ot.emp_id =".$emp_id."
                            AND approval_emp_ot.app_id = ".$app_id."
                            ORDER BY approval_emp_ot.ot_date, approval_emp_ot.time_in DESC";
                    $query = $conn->query($sql);
                    //echo $sql; 
                    $i=1;

                    $today = date('Y-m-d'); 
                    //echo $today;
                    while($row = $query->fetch_assoc()){
                      //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      if($_SESSION['is_admin'] == 1 && $_SESSION['is_edit'] == 1){
                        echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>".$i."</td>
                              <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                              <td>".DateShortThai($row['ot_date'])."</td>                          
                              <td>".date('h:i A', strtotime($row['time_in']))."</td>
                              <td>".date('h:i A', strtotime($row['time_out']))."</td>
                              <td>".$row['otreponsibility']."</td>
                              <td>".$row['otrate_name']."</td>
                              <td>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['appeotid']."'><i class='fa fa-edit'></i> แก้ไขเวลาการทำงาน</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeotid']."'><i class='fa fa-trash'></i> ลบเวลาการทำงาน</button>
                              </td>
                              </tr>
                          ";
                      }else{
                        if(compareDate($today,$row['ot_date'])==1){
                          if($app_status==0){
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>".$i."</td>
                                <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                                <td>".DateShortThai($row['ot_date'])."</td>                          
                                <td>".date('h:i A', strtotime($row['time_in']))."</td>
                                <td>".date('h:i A', strtotime($row['time_out']))."</td>
                                <td>".$row['otreponsibility']."</td>
                                <td>".$row['otrate_name']."</td>
                                <td>
                                    <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['appeotid']."'><i class='fa fa-edit'></i> แก้ไขเวลาการทำงาน</button>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeotid']."'><i class='fa fa-trash'></i> ลบเวลาการทำงาน</button>
                                </td>
                                </tr>
                            ";
                          }else{
                            echo "
                              <tr>
                              <td class='hidden'></td>
                              <td>".$i."</td>
                              <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                              <td>".DateShortThai($row['ot_date'])."</td>                          
                              <td>".date('h:i A', strtotime($row['time_in']))."</td>
                              <td>".date('h:i A', strtotime($row['time_out']))."</td>
                              <td>".$row['otreponsibility']."</td>
                              <td>".$row['otrate_name']."</td>
                              <td>
                                &nbsp;
                              </td>
                              </tr>
                          ";
                          }
                        }else{
                          if($app_status==0){
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>".$i."</td>
                                <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                                <td>".DateShortThai($row['ot_date'])."</td>                          
                                <td>".date('h:i A', strtotime($row['time_in']))."</td>
                                <td>".date('h:i A', strtotime($row['time_out']))."</td>
                                <td>".$row['otreponsibility']."</td>
                                <td>".$row['otrate_name']."</td>
                                <td>
                                    <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeotid']."'><i class='fa fa-trash'></i> ลบเวลาการทำงาน</button>
                                </td>
                                </tr>
                            ";
                          }else{
                            echo "
                                <tr>
                                <td class='hidden'></td>
                                <td>".$i."</td>
                                <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                                <td>".DateShortThai($row['ot_date'])."</td>                          
                                <td>".date('h:i A', strtotime($row['time_in']))."</td>
                                <td>".date('h:i A', strtotime($row['time_out']))."</td>
                                <td>".$row['otreponsibility']."</td>
                                <td>".$row['otrate_name']."</td>
                                <td>
                                  &nbsp;
                                </td>
                                </tr>
                            ";  
                          }
                        }
                      }
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
