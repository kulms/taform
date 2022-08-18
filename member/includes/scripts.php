<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<?php
  error_reporting(0);
  if (isset($cal)) {
    $cal = $cal;
  }else{
    $cal = 0;
  }

  if (isset($otdata_id)) {
    $otdata_id = $otdata_id;
  }else{
    $otdata_id = 0;
  }

  if($otdata_id!="" && $_SESSION["deptid"]=='99' && $cal==0){
    $sql = "SELECT otdata_time.*, employees.titlename, employees.firstname, employees.lastname, 
            department.dept_name AS dept_name
            FROM otdata_time
            LEFT JOIN department ON department.dept_id=otdata_time.dept_id                             
            LEFT JOIN employees ON employees.id=otdata_time.emp_id                             
            WHERE otdata_time.otdata_id =".$otdata_id." 
            ORDER BY CONVERT(dept_name USING tis620), 
            CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
            otdata_time.ot_date
            ";
  }else{
    $sql = "SELECT DISTINCT otdata_time.*, employees.titlename, employees.firstname, employees.lastname, 
            department.dept_name AS dept_name
            FROM otdata_time
            LEFT JOIN department ON department.dept_id=otdata_time.dept_id                             
            LEFT JOIN employees ON employees.id=otdata_time.emp_id     
            LEFT JOIN approval_group ON approval_group.emp_id=otdata_time.emp_id                        
            WHERE otdata_time.otdata_id =".$otdata_id."                             
            AND otdata_time.emp_id IN (SELECT emp_id FROM approval_group WHERE dept_id = '".$_SESSION["deptid"]."')
            ORDER BY CONVERT(dept_name USING tis620), 
            CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
            otdata_time.ot_date
            ";
  }
  
  
  if($cal==1 && $_SESSION["deptid"]=='99'){
    // $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
    //         department.dept_name AS dept_name, otrate.otrate_name  
    //         FROM otdata_time_cal
    //         LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
    //         LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
    //         LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
    //         LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
    //                   AND approval_emp_ot.emp_id=otdata_time_cal.emp_id    
    //         LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id                                              
    //         WHERE otdata_time_cal.otdata_id =".$otdata_id." AND otdata_time_cal.ot_amount > 0                             
    //         ORDER BY CONVERT(dept_name USING tis620), 
    //         CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
    //         otdata_time_cal.ot_date, otrate.otrate_name  ";
    $sql = "SELECT DISTINCT otdata_time_cal.*, employees.titlename, employees.firstname, employees.lastname, 
            department.dept_name AS dept_name, otrate.otrate_name  
            FROM otdata_time_cal
            LEFT JOIN department ON department.dept_id=otdata_time_cal.dept_id                             
            LEFT JOIN employees ON employees.id=otdata_time_cal.emp_id 
            LEFT JOIN otrate ON otrate.otrate_id=otdata_time_cal.otrate_id
            LEFT JOIN approval_emp_ot ON approval_emp_ot.app_id=otdata_time_cal.app_id 
                      AND approval_emp_ot.emp_id=otdata_time_cal.emp_id    
            LEFT JOIN approval_group ON approval_group.emp_id=otdata_time_cal.emp_id                                              
            WHERE otdata_time_cal.otdata_id =".$otdata_id."
            ORDER BY CONVERT(dept_name USING tis620), 
            CONVERT(employees.firstname USING tis620), CONVERT(employees.lastname USING tis620),
            otdata_time_cal.ot_date, otrate.otrate_name  ";        
  }else{

  }

  $query = $conn->query($sql);
  // echo $sql."<br>"; 
  $i=1;
  $today = date('Y-m-d');
  // echo $sql;

?>                    

<script>
  $(function () {
    var ot_data_view = [];
    var ot_data_cal_view = [];
    <?php
      if($otdata_id!="" && $cal == 0){
        while($row = $query->fetch_assoc()){
    ?>
        ot_data_view.push( [ '','', 
							 '<?php echo $row["dept_name"];?>', 
							 '<?php echo $row["titlename"].$row["firstname"]." ".$row["lastname"];?>', 
							 '<?php echo DateShortThai($row["ot_date"]);?>',
               '<?php echo ($row["time01"] != "00:00:00" ? $row["time01"] : "-");?>',
               '<?php echo ($row["time02"] != "00:00:00" ? $row["time02"] : "-");?>',
               '<?php echo ($row["time03"] != "00:00:00" ? $row["time03"] : "-");?>',
               '<?php echo ($row["time04"] != "00:00:00" ? $row["time04"] : "-");?>',
               '<?php echo ($row["time05"] != "00:00:00" ? $row["time05"] : "-");?>',
               '<?php echo ($row["time06"] != "00:00:00" ? $row["time06"] : "-");?>',
               '<?php echo ($row["time07"] != "00:00:00" ? $row["time07"] : "-");?>',
               '<?php echo ($row["time08"] != "00:00:00" ? $row["time08"] : "-");?>',
               '<?php echo ($row["time09"] != "00:00:00" ? $row["time09"] : "-");?>',
               '<?php echo ($row["time10"] != "00:00:00" ? $row["time10"] : "-");?>',
               '<?php echo ($row["time11"] != "00:00:00" ? $row["time11"] : "-");?>',
               '<?php echo ($row["time12"] != "00:00:00" ? $row["time12"] : "-");?>',
               '<?php echo ($row["time13"] != "00:00:00" ? $row["time13"] : "-");?>',
               '<?php echo ($row["time14"] != "00:00:00" ? $row["time14"] : "-");?>',
               '<?php echo ($row["time15"] != "00:00:00" ? $row["time15"] : "-");?>',
               '<?php echo ($row["time16"] != "00:00:00" ? $row["time16"] : "-");?>',
               '<?php echo ($row["time17"] != "00:00:00" ? $row["time17"] : "-");?>',
               '<?php echo ($row["time18"] != "00:00:00" ? $row["time18"] : "-");?>',
               '<?php echo ($row["time19"] != "00:00:00" ? $row["time19"] : "-");?>',
               '<?php echo ($row["time20"] != "00:00:00" ? $row["time20"] : "-");?>',  
							 '<?php echo $row["ot1_in"];?>',
               '<?php echo $row["ot1_out"];?>',
               '<?php echo $row["ot2_in"];?>',  
							 '<?php echo $row["ot2_out"];?>'							  
							 ] );
    <?php    
        }
      }
    ?>
    <?php
      if($cal==1){
        while($row = $query->fetch_assoc()){
    ?>
        ot_data_cal_view.push( [ '','', 
							 '<?php echo $row["dept_name"];?>', 
							 '<?php echo $row["titlename"].$row["firstname"]." ".$row["lastname"];?>', 
							 '<?php echo DateShortThai($row["ot_date"]);?>',                 
							 '<?php echo $row["ot1_in"];?>',
               '<?php echo $row["ot1_form_in"];?>',
               '<?php echo $row["ot1_out"];?>', 
               '<?php echo $row["ot1_form_out"];?>',
               '<?php echo $row["ot2_in"];?>',
               '<?php echo $row["ot2_form_in"];?>', 
               '<?php echo $row["ot2_out"];?>',
               '<?php echo $row["ot2_form_out"];?>',
               '<?php echo $row["otrate_name"];?>', 
               '<?php echo $row["num_hr"];?>',
               '<?php echo $row["num_min"];?>',               
							 '<?php echo number_format($row["ot_amount"],2);?>'							  
							 ] );
    <?php    
        }
      }
    ?>

    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      "displayLength": -1,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
      }
    })

    $("#example3g").DataTable({
      "responsive": true,
      "autoWidth": true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2,3]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=9"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(3, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=9"><font style="font-size:15px;color:#b0081c">' + group + '</font></td></tr>'
            );

            last = group;
          }
        }); 

      }
    })

    $('#example0').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": true
    });
    $('#example4').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'displayLength': -1
    })
    $('#example5').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true,
      'displayLength': -1
    })
    $("#example6").DataTable({
      "responsive": true,
      "autoWidth": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "columnDefs": [{
        "visible": false,
        "targets": [0,1,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'desc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(1, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">ปี พ.ศ. ' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">เดือน ' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#propose").DataTable({
      "responsive": true,
      "autoWidth": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "columnDefs": [{
        "visible": false,
        "targets": [1,3]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'desc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(1, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(3, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });        
      }
    })
    //------------------------------------------------------
    $("#example7").DataTable({
      "responsive": true,
      "autoWidth": true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#example8").DataTable({
      "responsive": true,
      "autoWidth": true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2,3]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [2, 'desc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(3, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><font style="font-size:15px;color:#b0081c">' + group + '</font></td></tr>'
            );

            last = group;
          }
        });                        
      }      
    })
    //------------------------------------------------------
    $("#example9").DataTable({
      "responsive": true,
      "autoWidth": true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": 10,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#example10").DataTable({
      "responsive": true,
      "autoWidth": true,
      "scrollX" : true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": -1,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=15"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#example11").DataTable({
      <?php
      if($otdata_id!=""){
      ?>
      "data": ot_data_view,
      <?php
      }
      ?>
      "responsive": true,
      "autoWidth": true,
      "scrollX" : true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2,3]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": 50,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(3, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><b>' + group + '</b></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#example11_1").DataTable({
      <?php
      if($cal==1){
      ?>
      "data": ot_data_cal_view,
      <?php
      }
      ?>
      "responsive": true,
      "autoWidth": true,
      "scrollX" : true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2,3]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": 50,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(3, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><b>' + group + '</b></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#example12").DataTable({
      "responsive": true,
      "autoWidth": true,
      "scrollX" : true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": 50,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });        
      }
    })
    //------------------------------------------------------
    $("#example13").DataTable({
      
      "responsive": true,
      "autoWidth": true,
      "scrollX" : true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2,3]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [1, 'asc']
      ],
      "displayLength": 50,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });
        api.column(3, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><b>' + group + '</b></td></tr>'
            );

            last = group;
          }
        });
      }
    })
    //------------------------------------------------------
    $("#example14").DataTable({
      
      "responsive": true,
      "autoWidth": true,
      "scrollX" : true,
      "columnDefs": [{
        "visible": false,
        "targets": [0,2]
      }],
      //"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
      "order": [
        [0, 'asc']
      ],
      "displayLength": 25,
      "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
          page: 'current'
        }).nodes();
        var last = null;

        api.column(2, {
          page: 'current'
        }).data().each(function (group, i) {
          if (last !== group) {
            $(rows).eq(i).before(
              '<tr class="group"><td colspan=35"><h4 style="color:#b0081c">' + group + '</h4></td></tr>'
            );

            last = group;
          }
        });        
      }
    })
    //------------------------------------------------------
  })
</script>
<script>
$(function(){
  /** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
     return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
  
});
</script>
<script>
$(function(){
	//Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    multidate: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    enabled : false,
    maxDate: now,
    minDate: now
  })
  $('#datepicker_del').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_approval_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    enabled : false,
    maxDate: now,
    minDate: now
  })
  $('#datepicker_approval_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    // enabled : false,
    // maxDate: now,
    // minDate: now
  })
  $('#datepicker_approval_del').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    // enabled : false,
    // maxDate: now,
    // minDate: now
  })


  //Timepicker
  // $('.timepicker').timepicker({
  //   showInputs: false
  // })
  $('#time_in').timepicker({
    //showInputs: false
  });
  $('#time_out').timepicker({
    //showInputs: false
  });
  
  

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
  // $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
  //   $("#success-alert").slideUp(500);
  // });  

  // $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
  //   $("#error-alert").slideUp(500);
  // });

  // $("#success-alert").fadeTo(1000, 500).slideUp(500, function(){
  //   // $("#success-alert").alert('close');
  //   $("#success-alert").slideUp(500);
  // });
  // $("#error-alert").fadeTo(1000, 500).slideUp(500, function(){
  //   // $("#error-alert").alert('close');
  //   $("#error-alert").slideUp(500);
  // });

  // window.setTimeout(function() {
  //   $(".alert").fadeTo(500, 0).slideUp(500, function(){
  //       $(this).remove(); 
  //   });
  // }, 1000);
  // window.setTimeout(function() {
  //   $(".alert").fadeTo(1500, 0).slideUp(500, function(){
  //       $(this).remove(); 
  //   });
  // }, 5000);

});

</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#task_id').change(function() {
			      alert('555');
            // alert($(this).val());
            $.ajax({
                type: 'POST',
                // data: {task_id: $(this).val()},
                url: './select_task.php',
                success: function(data) {
                    // $('#subtask_id').html(data);
                    alert('finish');
                }
            });
            return false;
        });
    });
</script> -->
