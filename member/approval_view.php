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
      อนุมัติแบบฟอร์ม
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="approval_form.php"> แบบฟอร์มขออนุมัติ</a></li>
        <li class="active">อนุมัติแบบฟอร์ม</li>
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
              <?php
              if($row['app_status']==0){
              ?>
              <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div>
              <?php
              }
              ?>
              <br>      
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <th class="hidden"></th>
                  <th width="5%">#</th>
                  <th width="15%">ชื่อ-นามสกุล</th>
                  <th width="15%">ตำแหน่ง</th>
                  <th width="20%">วันที่</th>                  
                  <th width="25%">งานที่ปฏิบัติ</th>
                  <th width="20%">ดำเนินการ</th>
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
                          <td>
                            <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval_ot_view.php?appeid=".$row['appeid']."&appid=$app_id&empid=".$row['empid']."\"' ><i class='fa fa-clock-o'></i> ดูเวลาการทำงาน</button>                            
                          </td>
                        </tr>
                      ";
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
              <?php
              if($_SESSION["deptid"]=='99'){
              ?>
              <div class="box-header with-border col-sm-offset-5">              
                <a href="javascript:iconfirmform('approval_confirm.php?confirm=1&appid=<?php echo $app_id;?>')" class="btn btn-info btn-sm btn-flat"><i class="fa fa-thumbs-up"></i> ยืนยันแบบฟอร์ม</a>
                <a  href="javascript:iunconfirmform('approval_unconfirm.php?confirm=1&appid=<?php echo $app_id;?>')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-thumbs-down"></i> ยกเลิกการยืนยันแบบฟอร์ม</a>
              </div>
              <?php
              }else{
                if($row['app_status']==0){
              ?>
              <div class="box-header with-border col-sm-offset-5">
                <a href="javascript:iconfirmform('approval_confirm.php?confirm=1&appid=<?php echo $app_id;?>')" class="btn btn-info btn-sm btn-flat"><i class="fa fa-thumbs-up"></i> ยืนยันแบบฟอร์ม</a>                
              </div>
              <?php    
                }
              }
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
<script language="JavaScript" type="text/javascript">
	function iconfirmform(in_url){
		if( confirm("Do you want to Confirm this form?") ){   
				document.location =in_url; 
			 }
	}
  function iunconfirmform(in_url){
		if( confirm("Do you want to UnConfirm this form?") ){   
				document.location =in_url; 
			 }
	}
</script>
</body>
</html>
