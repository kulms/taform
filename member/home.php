<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $curYear = date('Y')+543;
  $curMonth = date('n');

  // echo $curYear." ".$curMonth;
  // if(isset($_GET['year'])){
  //   $year = $_GET['year'];
  // }
  $sql = "select fiscal_id, fiscal_name from fiscal where fiscal_name = '".$curYear."'  order by fiscal_name DESC;";
  $query = $conn->query($sql);
  $yrow = $query->fetch_assoc();
  $fiscal_id = $yrow["fiscal_id"];

  $sem1 = array(6,7,8,9,10,11);
  $sem2 = array(1,2,3,4,5,12);

  if (in_array($curMonth, $sem1))
  {
    $sem_id = 1;
  }

  if (in_array($curMonth, $sem2))
  {
    $sem_id = 2;
  }

  $month_id = $curMonth;

  // echo $fiscal_id." ".$sem_id." ".$curMonth;
  $sqlCondition = "";
  if($_SESSION["deptid"]=='99'){
    $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' ";
  }else{
    $sqlCondition.=" WHERE a.fiscal_id='".$fiscal_id."' AND a.sem_id='".$sem_id."' AND a.dept_id='".$_SESSION["deptid"]."' ";
  }

?>
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
      // if($_SESSION["deptid"]=='99' || $_SESSION["deptid"]=='11'){
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">รายชื่อนิสิตเบิกเงินทุนผู้ช่วยสอน (เดือน<?php echo MonthThai($month_id);?>)</h3>
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
              <table id="propose" class="table table-bordered" width="100%">
                <thead>
                  <th class="hidden"></th>
                  <th width="3%">#</th>                  
                  <th width="1%">เดือน</th>
                  <th width="1%"></th>
                  <th width="29%">หน่วยงาน</th>
                  <!-- <th>Name</th> -->
                  <!-- <th width="8%">แหล่งเงิน</th>
                  <th width="8%">สถานะ</th> -->
                  <th width="9%">วันที่สร้างเอกสาร</th>
                  <!-- <th>Time Out</th> -->
                  <th width="30%">ดำเนินการ</th>
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
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Late',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $late; ?>
      },
      {
        label               : 'Ontime',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $ontime; ?>
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
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
