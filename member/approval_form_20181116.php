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
      แบบฟอร์มขออนุมัติ
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">แบบฟอร์มขออนุมัติ</li>
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
                <h3 class="box-title">ค้นหาแบบฟอร์มขออนุมัติ</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- <form id="frmMain" class="form-horizontal" action="approval_form.php" method="post" enctype="multipart/form-data"> -->
              <form class="form-horizontal" method="POST" action="approval_form.php">  
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
                  
                    <label for="app_month" class="col-sm-1 control-label">เดือน</label>
                    <div class="col-sm-2">                      
                      <select class="form-control" name="app_month" id="app_month">
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
          if($_POST['app_month']==""){
            $year_id = $_POST['year_id'];
            if($_SESSION["deptid"]=='99'){
              $sqlCondition.=" WHERE a.year_id='".$year_id."' ";
            }else{
              $sqlCondition.=" AND a.year_id='".$year_id."' ";
            } 
            $curMonth = 0; 
          }else{
            $year_id = $_POST['year_id'];
            $app_month = $_POST['app_month'];               
            if($_SESSION["deptid"]=='99'){
              $sqlCondition.=" WHERE a.year_id='".$year_id."' AND a.app_month = '".$app_month."' ";
            }else{
              $sqlCondition.=" AND a.year_id='".$year_id."' AND a.app_month = '".$app_month."' ";
            } 
            $curMonth = $_POST['app_month'];      
          }
        }else{
          $sqlCurrYear = "SELECT year_id FROM years WHERE year_name LIKE '".$curYear."'";
          $qCurrYear = $conn->query($sqlCurrYear);
          $rowCurrYear = $qCurrYear->fetch_assoc();

          $curMonth = date('n');	

          if($_SESSION["deptid"]=='99'){
            $sqlCondition.=" WHERE a.year_id='".$rowCurrYear["year_id"]."' AND a.app_month='".$curMonth."' ";
          }else{
            $sqlCondition.=" AND a.year_id='".$rowCurrYear["year_id"]."' AND a.app_month='".$curMonth."' ";
          }
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <h4 class="box-title"> 
              แสดงผลแบบฟอร์มขออนุมัติ ปี พ.ศ.<?php echo $curYear;?> เดือน <?php echo MonthThai($curMonth);?>
              </h4>
              <table id="example8" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>                  
                  <th width="1%">เดือน</th>
                  <th width="29%">หน่วยงาน</th>
                  <!-- <th>Name</th> -->
                  <th width="12%">แหล่งเงิน</th>
                  <th width="10%">สถานะ</th>
                  <th width="10%">วันที่เอกสาร</th>
                  <th width="10%">วงเงินค่าตอบแทน (บาท)</th>
                  <!-- <th>Time Out</th> -->
                  <th width="25%">ดำเนินการ</th>
                </thead>
                <tbody>
                  <?php
                    // $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";                                      
                    
                    if($_SESSION["deptid"]=='99'){
                      $sqlm = "SELECT DISTINCT a.app_month, a.year_id
                              FROM approval a
                              ".$sqlCondition."                                   
                              ORDER BY a.app_month DESC, a.app_type_id";
                      // $sql = "SELECT DISTINCT a.dept_id, d.dept_name FROM approval a, department d 
                      //         WHERE a.dept_id = d.dept_id 
                      //         ORDER BY CONVERT(d.dept_name USING tis620);";
                    }else{
                      $sqlm = "SELECT DISTINCT a.app_month, a.year_id
                      FROM approval a                           
                      WHERE a.dept_id = '".$_SESSION["deptid"]."'
                      ".$sqlCondition." 
                      ORDER BY a.app_month DESC, a.app_type_id";  
                      // $sql = "SELECT DISTINCT a.dept_id, d.dept_name FROM approval a, department d 
                      //         WHERE a.dept_id = d.dept_id AND a.dept_id = '".$_SESSION["deptid"]."'
                      //         ORDER BY CONVERT(d.dept_name USING tis620);";
                    }

                    // echo $sqlm;

                    $querym = $conn->query($sqlm);
                    $k=0;
                    $sumAllBudget = 0;
                    while($rowm = $querym->fetch_assoc()){                     
                      $sumAllBudget = 0;
                      if($_SESSION["deptid"]=='99'){
                        $sql = "SELECT DISTINCT a.dept_id, d.dept_name,a.app_month, a.year_id 
                                FROM approval a 
                                    LEFT JOIN department d ON d.dept_id=a.dept_id 
                                    LEFT JOIN years y ON y.year_id=a.year_id
                                    LEFT JOIN app_type at ON at.app_type_id=a.app_type_id
                                WHERE a.app_month = '".$rowm["app_month"]."' AND a.year_id = '".$rowm["year_id"]."'    
                                ORDER BY a.app_month DESC, CONVERT(dept_name USING tis620), a.app_type_id";
                        // $sql = "SELECT DISTINCT a.dept_id, d.dept_name FROM approval a, department d 
                        //         WHERE a.dept_id = d.dept_id 
                        //         ORDER BY CONVERT(d.dept_name USING tis620);";
                      }else{
                        $sql = "SELECT DISTINCT a.dept_id, d.dept_name,a.app_month, a.year_id
                        FROM approval a 
                            LEFT JOIN department d ON d.dept_id=a.dept_id 
                            LEFT JOIN years y ON y.year_id=a.year_id
                            LEFT JOIN app_type at ON at.app_type_id=a.app_type_id
                        WHERE a.dept_id = '".$_SESSION["deptid"]."' AND a.app_month = '".$rowm["app_month"]."' AND a.year_id = '".$rowm["year_id"]."'
                        ORDER BY a.app_month DESC, CONVERT(dept_name USING tis620), a.app_type_id";  
                        // $sql = "SELECT DISTINCT a.dept_id, d.dept_name FROM approval a, department d 
                        //         WHERE a.dept_id = d.dept_id AND a.dept_id = '".$_SESSION["deptid"]."'
                        //         ORDER BY CONVERT(d.dept_name USING tis620);";
                      }
                      $query = $conn->query($sql);
                      $i=1;
                      
                      while($row = $query->fetch_assoc()){                      
                        //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';
                        // echo "
                        //   <tr>
                        //     <td class='hidden'></td>
                        //     <td>".$i."</td>                          
                        //     <td>".$thaimonth[$row['app_month']-1]." ".$row['year_name']."</td>                          
                        //     <td>".$row['dept_name']."</td>
                        //     <td>".$row['app_name']."</td>
                        //     <td>".$row['app_type_name']."</td>
                        //     <td>".$row['create_date']."</td>                          
                        //     <td>
                        //       <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$row['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>
                        //       <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['app_id']."'><i class='fa fa-edit'></i> Edit</button>
                        //       <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['app_id']."'><i class='fa fa-trash'></i> ลบแบบฟอร์ม</button>
                        //     </td>
                        //   </tr>
                        // ";
                        if($_SESSION["deptid"]=='99'){
                          $sqla = "SELECT a.*, d.dept_name, y.year_name, at.app_type_name 
                                  FROM approval a 
                                      LEFT JOIN department d ON d.dept_id=a.dept_id 
                                      LEFT JOIN years y ON y.year_id=a.year_id
                                      LEFT JOIN app_type at ON at.app_type_id=a.app_type_id
                                  WHERE a.dept_id = '".$row["dept_id"]."' AND a.app_month = '".$row["app_month"]."' AND a.year_id = '".$row["year_id"]."'    
                                  ORDER BY a.app_month DESC, CONVERT(dept_name USING tis620), a.app_type_id";
                        }else{
                          $sqla = "SELECT a.*, d.dept_name, y.year_name, at.app_type_name 
                          FROM approval a 
                              LEFT JOIN department d ON d.dept_id=a.dept_id 
                              LEFT JOIN years y ON y.year_id=a.year_id
                              LEFT JOIN app_type at ON at.app_type_id=a.app_type_id
                          WHERE a.dept_id = '".$_SESSION["deptid"]."' AND a.app_month = '".$row["app_month"]."' AND a.year_id = '".$row["year_id"]."'    
                          ORDER BY a.app_month DESC, CONVERT(dept_name USING tis620), a.app_type_id";  
                        }
                        $querya = $conn->query($sqla);                      

                        $j=1;
                        $sumBudget = 0;
                        $lastmonth = "";
                        $lastdept = "";

                        while($rowa = $querya->fetch_assoc()){       
                          $sumBudget+=$rowa['budget'];                          
                          $lastmonth = "(".$rowa['app_month'].") ".$thaimonth[$rowa['app_month']-1]." ".$rowa['year_name'];
                          $lastdept = $rowa['dept_name'];

                          if($rowa['app_status']==0){
                            $strStatus = "<font color='#f39c12'>รอการอนุมัติ</font>";
                          }else{
                            $strStatus = "<font color='#00a65a'>ผ่านการอนุมัติ</font>";
                          }
                          if($_SESSION["deptid"]=='99'){
                            echo "
                              <tr>
                                <td class='hidden'></td>
                                <td align='center'>&#9658;</td>                          
                                <td>(".$rowa['app_month'].") ".$thaimonth[$rowa['app_month']-1]." ".$rowa['year_name']."</td>                          
                                <td>".$rowa['dept_name']."</td>                          
                                <td>".$rowa['app_type_name']."</td>
                                <td>".$strStatus."</td>
                                <td>".DateShortThai(date('Y-m-d',strtotime($rowa['app_date'])))."</td>                          
                                <td align='right'>".number_format($rowa['budget'],2)."</td>
                                <td>
                                  <button class='btn btn-info btn-sm btn-flat' onclick='location.href=\"approval_view.php?appid=".$rowa['app_id']."\"' ><i class='fa fa-thumbs-up'></i> ยืนยันแบบฟอร์ม</button>
                                  <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$rowa['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='".$rowa['app_id']."'><i class='fa fa-edit'></i> แก้ไขแบบฟอร์ม</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$rowa['app_id']."'><i class='fa fa-trash'></i> ลบแบบฟอร์ม</button>
                                </td>
                              </tr>
                            ";                                               
                          }else{
                            if($rowa['app_status']==0){
                              echo "
                              <tr>
                                <td class='hidden'></td>
                                <td align='center'>&#9658;</td>                          
                                <td>(".$rowa['app_month'].") ".$thaimonth[$rowa['app_month']-1]." ".$rowa['year_name']."</td>                          
                                <td>".$rowa['dept_name']."</td>                          
                                <td>".$rowa['app_type_name']."</td>
                                <td>".$strStatus."</td>
                                <td>".DateShortThai(date('Y-m-d',strtotime($rowa['app_date'])))."</td>                          
                                <td align='right'>".number_format($rowa['budget'],2)."</td>
                                <td>
                                  <button class='btn btn-info btn-sm btn-flat' onclick='location.href=\"approval_view.php?appid=".$rowa['app_id']."\"' ><i class='fa fa-thumbs-up'></i> ยืนยันแบบฟอร์ม</button>
                                  <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$rowa['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>
                                  <button class='btn btn-success btn-sm btn-flat edit' data-id='".$rowa['app_id']."'><i class='fa fa-edit'></i> แก้ไขแบบฟอร์ม</button>
                                  <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$rowa['app_id']."'><i class='fa fa-trash'></i> ลบแบบฟอร์ม</button>
                                </td>
                              </tr>
                              ";
                            }else{
                              // echo "
                              // <tr>
                              //   <td class='hidden'></td>
                              //   <td>&#9658;</td>                          
                              //   <td>(".$rowa['app_month'].") ".$thaimonth[$rowa['app_month']-1]." ".$rowa['year_name']."</td>                          
                              //   <td>".$rowa['dept_name']."</td>                          
                              //   <td>".$rowa['app_type_name']."</td>
                              //   <td>".$strStatus."</td>
                              //   <td>".DateShortThai(date('Y-m-d',strtotime($rowa['create_date'])))."</td>  
                              //   <td></td>                        
                              //   <td>
                              //   <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$rowa['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>
                              //   <button class='btn btn-danger btn-sm btn-flat' onclick='location.href=\"approval_cancel.php?appid=".$rowa['app_id']."\"'><i class='fa fa-undo'></i> ขอยกเลิกยืนยันแบบฟอร์ม</button>
                              //   </td>
                              // </tr>
                              // ";
                              echo "
                              <tr>
                                <td class='hidden'></td>
                                <td>&#9658;</td>                          
                                <td>(".$rowa['app_month'].") ".$thaimonth[$rowa['app_month']-1]." ".$rowa['year_name']."</td>                          
                                <td>".$rowa['dept_name']."</td>                          
                                <td>".$rowa['app_type_name']."</td>
                                <td>".$strStatus."</td>
                                <td>".DateShortThai(date('Y-m-d',strtotime($rowa['create_date'])))."</td>  
                                <td></td>                        
                                <td>
                                <button class='btn btn-warning btn-sm btn-flat' onclick='location.href=\"approval.php?appid=".$rowa['app_id']."\"' ><i class='fa fa-users'></i> เพิ่มชื่อเจ้าหน้าที่</button>                                
                                </td>
                              </tr>
                              ";
                            }
                          }                        
                          $j++;
                        } 

                        echo "
                              <tr>
                                <td class='hidden'></td>
                                <td align='center'></td>                          
                                <td>".$lastmonth."</td>                          
                                <td>".$lastdept."</td>                          
                                <td></td>
                                <td></td>
                                <td><b>รวมต่อหน่วยงาน</b></td>                          
                                <td align='right'><b>".number_format($sumBudget,2)."</b></td>
                                <td></td>
                              </tr>
                            ";                     
                            $sumAllBudget+=$sumBudget;
                        $i++;
                      }
                      echo "
                              <tr>
                                <td class='hidden'></td>
                                <td align='center'></td>                          
                                <td>".$lastmonth."</td>                          
                                <td></td>                          
                                <td></td>
                                <td></td>
                                <td><b>รวมทุกหน่วยงาน (เดือน)</b></td>                          
                                <td align='right'><b>".number_format($sumAllBudget,2)."</b></td>
                                <td></td>
                              </tr>
                            "; 
                      $k++;
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
