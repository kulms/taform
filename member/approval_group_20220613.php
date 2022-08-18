<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>
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
      เจ้าหน้าที่ในหน่วยงาน
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">เจ้าหน้าที่ในหน่วยงาน</li>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
          
            <div class="box-body">
              <!-- <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div> -->
              <table id="example7" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>
                  <th width="15%">หน่วยงาน</th>
                  <th width="15%">ชื่อ-นามสกุล</th>
                  <!-- <th width="10%">Date</th>
                  <th width="10%">From</th>
                  <th width="10%">To</th>
                  <th width="35%">Reponsibility</th> -->
                  <th width="15%">ตำแหน่ง</th>
                  <!-- <th width="15%">วันหยุด</th> -->
                  <th width="15%">Tools</th>
                </thead>
                
                <tbody>
                  <?php
                    $today = date('Y-m-d'); 

                    if($_SESSION["deptid"]=='99'){
                      $sql = "SELECT *, employees.id AS empid
                            FROM approval_group
                            LEFT JOIN employees ON employees.id=approval_group.emp_id                             
                            LEFT JOIN department ON department.dept_id=approval_group.dept_id  
                            LEFT JOIN position ON position.id=employees.position_id                            
                            ORDER BY CONVERT(department.dept_name USING tis620), CONVERT(employees.firstname USING tis620)";

                          
                    }else{
                      $sql = "SELECT *, employees.id AS empid
                            FROM approval_group
                            LEFT JOIN employees ON employees.id=approval_group.emp_id                             
                            LEFT JOIN department ON department.dept_id=approval_group.dept_id 
                            LEFT JOIN position ON position.id=employees.position_id
                            WHERE approval_group.dept_id = '".$_SESSION["deptid"]."'
                            ORDER BY CONVERT(department.dept_name USING tis620), CONVERT(employees.firstname USING tis620)";
                    }
                    //echo $sql; 
                    $query = $conn->query($sql);
                    $i=1;

                    $today = date('Y-m-d'); 
                    //echo $today;
                    while($row = $query->fetch_assoc()){
                      //$status = ($row['status'])?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';                     
                        echo "
                            <tr>
                            <td class='hidden'></td>
                            <td>".$i."</td>
                            <td>".$row['dept_name']."</td>
                            <td>".$row['titlename'].$row['firstname'].' '.$row['lastname']."</td>  
                            <td>".$row['description']."</td>                            
                            <td>                            
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['app_group_id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['app_group_id']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>                                                   
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
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/approval_group_modal.php'; ?>

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
// $(function(){
//   var barChartCanvas = $('#barChart').get(0).getContext('2d')
//   var barChart = new Chart(barChartCanvas)
//   var barChartData = {
//     labels  : <?php echo $months; ?>,
//     datasets: [
//       {
//         label               : 'Late',
//         fillColor           : 'rgba(210, 214, 222, 1)',
//         strokeColor         : 'rgba(210, 214, 222, 1)',
//         pointColor          : 'rgba(210, 214, 222, 1)',
//         pointStrokeColor    : '#c1c7d1',
//         pointHighlightFill  : '#fff',
//         pointHighlightStroke: 'rgba(220,220,220,1)',
//         data                : <?php echo $late; ?>
//       },
//       {
//         label               : 'Ontime',
//         fillColor           : 'rgba(60,141,188,0.9)',
//         strokeColor         : 'rgba(60,141,188,0.8)',
//         pointColor          : '#3b8bba',
//         pointStrokeColor    : 'rgba(60,141,188,1)',
//         pointHighlightFill  : '#fff',
//         pointHighlightStroke: 'rgba(60,141,188,1)',
//         data                : <?php echo $ontime; ?>
//       }
//     ]
//   }
//   barChartData.datasets[1].fillColor   = '#00a65a'
//   barChartData.datasets[1].strokeColor = '#00a65a'
//   barChartData.datasets[1].pointColor  = '#00a65a'
//   var barChartOptions                  = {
//     //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
//     scaleBeginAtZero        : true,
//     //Boolean - Whether grid lines are shown across the chart
//     scaleShowGridLines      : true,
//     //String - Colour of the grid lines
//     scaleGridLineColor      : 'rgba(0,0,0,.05)',
//     //Number - Width of the grid lines
//     scaleGridLineWidth      : 1,
//     //Boolean - Whether to show horizontal lines (except X axis)
//     scaleShowHorizontalLines: true,
//     //Boolean - Whether to show vertical lines (except Y axis)
//     scaleShowVerticalLines  : true,
//     //Boolean - If there is a stroke on each bar
//     barShowStroke           : true,
//     //Number - Pixel width of the bar stroke
//     barStrokeWidth          : 2,
//     //Number - Spacing between each of the X value sets
//     barValueSpacing         : 5,
//     //Number - Spacing between data sets within X values
//     barDatasetSpacing       : 1,
//     //String - A legend template
//     legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
//     //Boolean - whether to make the chart responsive
//     responsive              : true,
//     maintainAspectRatio     : true
//   }

//   barChartOptions.datasetFill = false
//   var myChart = barChart.Bar(barChartData, barChartOptions)
//   document.getElementById('legend').innerHTML = myChart.generateLegend();
// });
</script>
<script>
// $(function(){
//   $('#select_year').change(function(){
//     window.location.href = 'home.php?year='+$(this).val();
//   });
// });
</script>
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
    url: 'approval_group_row.php',
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
      //alert(response.dept_id);
      //alert(response.emp_id);
      $('#edit_dept_id').val(response.dept_id);
      $('#edit_emp_id').val(response.emp_id);      
      $('#appg_id').val(response.app_group_id);
      
      $('#del_dept_id').val(response.dept_id);
      $('#del_emp_id').val(response.emp_id);
      $('#del_appg_id').val(response.app_group_id);
    

    }
  });
}
</script>
</body>
</html>
