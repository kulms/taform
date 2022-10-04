<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
    $app_id = $_GET["appid"];
    $sql = "SELECT a.*, DATE_FORMAT(a.create_date, '%c') AS aMonth, DATE_FORMAT(a.create_date, '%Y') AS aYear, f.fiscal_name, d.dept_name, f.fiscal_name, s.sem_name 
            FROM approval a
            LEFT JOIN ta_dept d ON d.dept_id=a.dept_id 
            LEFT JOIN fiscal f ON f.fiscal_id=a.fiscal_id 
            LEFT JOIN ta_sem s ON s.sem_id=a.sem_id
            WHERE a.app_id = '$app_id'
            ;";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $aYear = $row["aYear"]+543;
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
      กำหนดชื่อนิสิต
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="propose_form.php"> แบบฟอร์มขอเงินทุน</a></li>
        <li class="active">กำหนดชื่อนิสิต</li>
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
                  <td width="12%" class="th-left-color">ปีการศึกษา</td>
                  <td width="38%"><?php echo $row["fiscal_name"];?></td>                  
                  <td width="12%" class="th-left-color">ภาคการศึกษา</td>
                  <td width="38%"><?php echo $row["sem_name"];?></td>
                </tr>                                                
                <tr>
                  <td class="th-left-color">ครั้งที่</td>
                  <td><?php echo $row["app_times"];?></td>                                  
                  <td class="th-left-color">หน่วยงาน</td>
                  <td><?php echo $row["dept_name"];?></td>                  
                </tr> 
                <tr>
                  <td class="th-left-color">เดือนที่ขออนุมัติ</td>
                  <td><?php echo MonthThai($row["aMonth"])." ".$aYear;?></td>                    
                  <td class="th-left-color">วันที่สร้างเอกสาร</td>
                  <td><?php echo DateThai($row["create_date"]);?></td>                                    
                </tr>                
                               
                <!--
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
                            // if($row['app_status']==0){
                            //     $strStatus = "<font color='#f39c12'>รอการตรวจสอบ</font>";
                            // }else{
                            //     $strStatus = "<font color='#00a65a'>ผ่านการตรวจสอบ</font>";
                            // }
                            // echo $strStatus;
                        ?>
                    </td>                                  
                </tr> -->
                <tbody>
              </table>              
              <hr>
              <?php 
                // if($row['app_status']==0){
              ?>    
                <div class="box-header with-border">
                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                </div>
              <?php
                // }
                // $app_status = $row['app_status'];
              ?>        
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>
                  <th width="20%">ชื่อ-นามสกุล</th>
                  <th width="15%">รหัสประจำตัวนิสิต</th>
                  <th width="10%">ระดับปริญญา</th>
                  <th width="5%">ชั้นปี</th>                  
                  <th width="15%">จำนวนเงิน (บาท)</th>
                  <th width="35%">ดำเนินการ</th>
                </thead>
                
                <tbody>
                  <?php                    
                    // $sql = "SELECT *, employees.id AS empid, approval_emp.app_emp_id AS appeid
                    //         FROM approval_emp
                    //         LEFT JOIN employees ON employees.id=approval_emp.emp_id
                    //         LEFT JOIN position ON position.id=employees.position_id
                    //         WHERE approval_emp.app_id=$app_id
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
                       
                    //   if($app_status==0){        
                    //     echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>".$i."</td>
                    //         <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //         <td>".$row['description']."</td>                          
                    //         <td>".$strOT."</td>
                    //         <td>".$row['reponsibility']."</td>
                    //         <td>
                    //           <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval_ot.php?appeid=".$row['appeid']."&appid=$app_id&empid=".$row['empid']."\"' ><i class='fa fa-clock-o'></i> เพิ่มเวลาการทำงาน</button>
                    //           <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['appeid']."'><i class='fa fa-edit'></i> แก้ไขชื่อเจ้าหน้าที่</button>
                    //           <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appeid']."'><i class='fa fa-trash'></i> ลบชื่อเจ้าหน้าที่</button>
                    //         </td>
                    //       </tr>
                    //     ";
                    //   }else{
                    //     echo "
                    //       <tr>
                    //         <td class='hidden'></td>
                    //         <td>".$i."</td>
                    //         <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>
                    //         <td>".$row['description']."</td>                          
                    //         <td>".$strOT."</td>
                    //         <td>".$row['reponsibility']."</td>
                    //         <td>
                    //           <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval_ot.php?appeid=".$row['appeid']."&appid=$app_id&empid=".$row['empid']."\"' ><i class='fa fa-clock-o'></i> เพิ่มเวลาการทำงาน</button>
                    //         </td>
                    //       </tr>
                    //     ";
                    //   }
                    //   $i++;
                    // }
                    $sql = "SELECT *, approval_std.app_std_id AS appsid
                            FROM approval_std                            
                            WHERE approval_std.app_id=$app_id
                            ;";
                    $query = $conn->query($sql);
                    $i=1;
                    while($row = $query->fetch_assoc()){
                      echo "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$i."</td>
                            <td>".$row['std_title_name'].$row['std_name']."</td>
                            <td>".$row['std_id']."</td>                          
                            <td>".$row['std_degree']."</td>
                            <td>".$row['std_class']."</td>
                            <td>".$row['std_amount']."</td>
                            <td>
                              <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"propose_std.php?appsid=".$row['appsid']."&appid=".$row['app_id']."\"' ><i class='fa fa-file-text-o'></i> ข้อมูลรายวิชาที่ช่วยสอน</button>
                              <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['appsid']."'><i class='fa fa-edit'></i> แก้ไขชื่อนิสิต</button>
                              <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['appsid']."'><i class='fa fa-trash'></i> ลบชื่อนิสิต</button>
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
  <?php include 'includes/propose_modal.php'; ?>
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
    url: 'propose_row.php',
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
      $('#app_std_id').val(response.app_std_id);
      $('#edit_std_id').val(response.std_id);
      $('#edit_std_title_name').val(response.std_title_name);   
      $('#edit_std_name').val(response.std_name);   
      $('#edit_std_degree').val(response.std_degree);   
      $('#edit_std_class').val(response.std_class);   
      $('#edit_std_subject').val(response.std_subject);   
      $('#edit_std_section').val(response.std_section);   
      $('#edit_std_number').val(response.std_number);   
      $('#edit_std_amount').val(response.std_amount);   
      $('#edit_std_gpa').val(response.std_gpa);   
      $('#edit_std_score').val(response.std_score);   
      $('#edit_std_bankno').val(response.std_bankno);   
      $('#edit_std_bankname').val(response.std_bankname);   
      $('#edit_std_phone').val(response.std_phone);   

      $('#del_app_std_id').val(response.app_std_id);
      $('#del_std_id').val(response.std_id);
      $('#del_std_title_name').val(response.std_title_name);
      $('#del_std_name').val(response.std_name);   
      $('#del_std_degree').val(response.std_degree);   
      $('#del_std_class').val(response.std_class);   
      $('#del_std_subject').val(response.std_subject);   
      $('#del_std_section').val(response.std_section);   
      $('#del_std_number').val(response.std_number);   
      $('#del_std_amount').val(response.std_amount);   
      $('#del_std_gpa').val(response.std_gpa);   
      $('#del_std_score').val(response.std_score);   
      $('#del_std_bankno').val(response.std_bankno);   
      $('#del_std_bankname').val(response.std_bankname);   
      $('#del_std_phone').val(response.std_phone);
      // $('#del_appe_id').val(response.app_emp_id);
      // $('#del_employee_name').html(response.titlename+response.firstname+' '+response.lastname);

    }
  });
}
</script>
</body>
</html>
