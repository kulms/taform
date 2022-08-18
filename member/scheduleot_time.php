<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedule Overtime Timetable
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="scheduleot.php"> Schedule Overtime</a></li>
        <li class="active">Schedule Overtime Timetable</li>
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
            <div class="box-header with-border">
                <h3 class="box-title">Timetable Information</h3>
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
                  <td width="38%"><?php //echo $proj_no;?>งานอาคารสถานที่และยานพาหนะ  คณะวิศวกรรมศาสตร์ โทร. 02-797-0999 ต่อ 2031</td>                  
                  <td width="12%" class="th-left-color">เดือนที่ขออนุมัติ</td>
                  <td width="38%"><?php //echo $proj_name;?>กรกฎาคม 2561</td>
                </tr>                
                <tbody>
              </table>              
              <hr>
              <table id="example4" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>#</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Reponsibility</th>
                  <th>Tools</th>
                </thead>
                <!--
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".date('M d, Y', strtotime($row['date']))."</td>
                          <td>".$row['empid']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
                          <td>".date('h:i A', strtotime($row['time_out']))."</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['attid']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['attid']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
                -->
                <tbody>
                    <tr>
                      <td class='hidden'></td>
                      <td>1</td>
                      <td>นายเวียงชัย  ชัยสิริชยานันท์</td>
                      <td>07/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ทิ้งขยะ</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>2</td>
                      <td>นายเวียงชัย  ชัยสิริชยานันท์</td>
                      <td>14/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ทิ้งขยะ</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>3</td>
                      <td>นายเวียงชัย  ชัยสิริชยานันท์</td>
                      <td>21/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ทิ้งขยะ</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>4</td>
                      <td>นายเวียงชัย  ชัยสิริชยานันท์</td>
                      <td>28/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ทิ้งขยะ</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>5</td>
                      <td>นายอภิชาติ  พึ่งอยู่</td>
                      <td>07/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>6</td>
                      <td>นายอภิชาติ  พึ่งอยู่</td>
                      <td>14/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>7</td>
                      <td>นายอภิชาติ  พึ่งอยู่</td>
                      <td>21/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>8</td>
                      <td>นายอภิชาติ  พึ่งอยู่</td>
                      <td>28/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>9</td>
                      <td>นายอภิชัย  มากมี</td>
                      <td>07/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>10</td>
                      <td>นายอภิชัย  มากมี</td>
                      <td>14/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>11</td>
                      <td>นายอภิชัย  มากมี</td>
                      <td>21/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>12</td>
                      <td>นายอภิชัย  มากมี</td>
                      <td>28/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>13</td>
                      <td>นายทวิเดช  เอี่ยมอำนวย</td>
                      <td>03/07/18</td>
                      <td>17:30</td>
                      <td>18:00</td>
                      <td>โสตฯ ห้องเรียนอาคาร 3</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>14</td>
                      <td>นายทวิเดช  เอี่ยมอำนวย</td>
                      <td>07/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>15</td>
                      <td>นายทวิเดช  เอี่ยมอำนวย</td>
                      <td>14/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>16</td>
                      <td>นายทวิเดช  เอี่ยมอำนวย</td>
                      <td>21/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>17</td>
                      <td>นายทวิเดช  เอี่ยมอำนวย</td>
                      <td>28/07/18</td>
                      <td>8:30</td>
                      <td>16:30</td>
                      <td>ปรับปรุงห้องเรียนและโรงอาหาร</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>18</td>
                      <td>นายธนพล  แก้วงาม</td>
                      <td>03/07/18</td>
                      <td>17:30</td>
                      <td>18:00</td>
                      <td>เวรอาคาร 3</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                    <tr>
                      <td class='hidden'></td>
                      <td>19</td>
                      <td>นายสมบัติ วิลัย</td>
                      <td>03/07/18</td>
                      <td>17:30</td>
                      <td>18:00</td>
                      <td>เวรอาคาร 3</td>
                      <td>
                        <button class='btn btn-success btn-sm btn-flat edit' data-id='1'><i class='fa fa-edit'></i> Edit</button>
                        <button class='btn btn-danger btn-sm btn-flat delete' data-id='1'><i class='fa fa-trash'></i> Delete</button>
                      </td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
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
  $.ajax({
    type: 'POST',
    url: 'approval_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
