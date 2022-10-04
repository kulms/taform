<?php
include ('includes/db.php');
include ('includes/extra_mysqli.php');
include ('includes/functions.php');

if(!isset($_POST['fiscal_id']) && !isset($_POST['sem_id'])){
  

}else{
  $fiscal_id = $_POST['fiscal_id'];
  $sem_id = $_POST['sem_id'];
  $dept_id = $_POST['dept_id'];
  $type_id = $_POST['type_id'];
  // echo $dept_id;
  //echo $type_id;

  if($type_id==0){
    if($dept_id==0){    
      $sqlCourse = "SELECT c.course_id, c.fiscal_id, c.sem_id, c.dept_id, c.course_name, c.course_desc, f.fiscal_name, s.sem_name, d.dept_name,
                    CASE
                        WHEN c.type_id = 1 THEN 'สอบกลางภาค'
                        WHEN c.type_id = 2 THEN 'สอบปลายภาค'                        
                    END AS 'type_name'
              FROM exam_course c, fiscal f, exam_sem s, exam_dept d
              WHERE c.fiscal_id  = '".$fiscal_id."' 
              AND c.sem_id = '".$sem_id."' 
              AND c.fiscal_id = f.fiscal_id AND c.sem_id = s.sem_id AND c.dept_id = d.dept_id;";
      // echo $sqlCourse;        
      $qCourse = mysqli_query($conn,$sqlCourse);
    }else{    
      $sqlCourse = "SELECT c.course_id, c.fiscal_id, c.sem_id, c.dept_id, c.course_name, c.course_desc, f.fiscal_name, s.sem_name, d.dept_name,
                    CASE
                        WHEN c.type_id = 1 THEN 'สอบกลางภาค'
                        WHEN c.type_id = 2 THEN 'สอบปลายภาค'                        
                    END AS 'type_name'
              FROM exam_course c, fiscal f, exam_sem s, exam_dept d 
              WHERE c.fiscal_id  = '".$fiscal_id."' 
              AND c.sem_id = '".$sem_id."' 
              AND c.dept_id = '".$dept_id."' 
              AND c.fiscal_id = f.fiscal_id AND c.sem_id = s.sem_id AND c.dept_id = d.dept_id;";
      // echo $sqlCourse;        
      $qCourse = mysqli_query($conn,$sqlCourse);
    }
  }else{
    if($dept_id==0){    
      $sqlCourse = "SELECT c.course_id, c.fiscal_id, c.sem_id, c.dept_id, c.course_name, c.course_desc, f.fiscal_name, s.sem_name, d.dept_name,
                    CASE
                        WHEN c.type_id = 1 THEN 'สอบกลางภาค'
                        WHEN c.type_id = 2 THEN 'สอบปลายภาค'                        
                    END AS 'type_name'
              FROM exam_course c, fiscal f, exam_sem s, exam_dept d, exam_type t 
              WHERE c.fiscal_id  = '".$fiscal_id."' 
              AND c.sem_id = '".$sem_id."' 
              AND c.type_id = '".$type_id."' 
              AND c.fiscal_id = f.fiscal_id AND c.sem_id = s.sem_id AND c.dept_id = d.dept_id AND c.type_id = t.type_id;";
      // echo $sqlCourse;        
      $qCourse = mysqli_query($conn,$sqlCourse);
    }else{    
      $sqlCourse = "SELECT c.course_id, c.fiscal_id, c.sem_id, c.dept_id, c.course_name, c.course_desc, f.fiscal_name, s.sem_name, d.dept_name,
                    CASE
                        WHEN c.type_id = 1 THEN 'สอบกลางภาค'
                        WHEN c.type_id = 2 THEN 'สอบปลายภาค'                        
                    END AS 'type_name'
              FROM exam_course c, fiscal f, exam_sem s, exam_dept d, exam_type t
              WHERE c.fiscal_id  = '".$fiscal_id."' 
              AND c.sem_id = '".$sem_id."' 
              AND c.dept_id = '".$dept_id."'
              AND c.type_id = '".$type_id."' 
              AND c.fiscal_id = f.fiscal_id AND c.sem_id = s.sem_id AND c.dept_id = d.dept_id AND c.type_id = t.type_id;";
      //  echo $sqlCourse;        
      $qCourse = mysqli_query($conn,$sqlCourse);
    }
  }  
  //mysqli_free_result($query);
}

//echo $fiscal_id."<br>";

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $appname;?> คณะวิศวกรรมศาสตร์ มก.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/red.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Fullcalendar-3.6.2 -->
    <link href="fullcalendar-3.6.2/fullcalendar.min.css" rel="stylesheet" />
    <link href="fullcalendar-3.6.2/fullcalendar.print.min.css" rel="stylesheet" media="print" />
    <!--fancybox -->
    <link rel="stylesheet" href="fancy/jquery.fancybox.css" type="text/css" media="screen" />
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="fancy/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />

    <style type="text/css">
      iframe {
        display: block;
        width: 95%;
        /* as desired */
        height: 80vh;
        /* as desired */
        border: none;
        margin: 0px auto
      }

      #calendar {
        max-width: 82%;
        margin: 0 auto;
      }
    </style>

    <style type="text/css">
      @media (min-width: 768px) {
        .modal-xl {
          width: 45%;
          max-width:1300px;
        }
      }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>

  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
            <img src="images/engr_logo.png" />
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
            <b>eXam</b> - Form</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- Notifications: style can be found in dropdown.less -->

              <!-- Tasks: style can be found in dropdown.less -->

              <!-- User Account: style can be found in dropdown.less -->

              <!-- Control Sidebar Toggle Button -->
              <!--
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!--
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      -->
          <!-- search form -->
          <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php
	  include("sidebar.php");
	  ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            <?php echo $appname;?>
          </h1>

          <ol class="breadcrumb">
            <li class="active">
              <a href="#">
                <i class="fa fa-home"></i> Home</a>
            </li>
            <!--<li class="active">Dashboard</li>-->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">

            <!-- Left col -->

            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->

              <!-- /.nav-tabs-custom -->

              <!-- Chat box -->

              <!-- /.box (chat box) -->

              <!-- TO DO List -->

              <!-- /.box -->

              <!-- quick email widget -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">ข้อมูลรายละเอียดการสอบ</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-danger btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" style="margin-right: 5px;">
                      <i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box-header with-border">
                    <h3 class="box-title">Search</h3>                    
                  </div>
                  
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal" action="index.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="box-body">
                    <span style="color:red;">* ต้องระบุข้อมูล</span>
                      <div class="form-group">
                        <label for="fiscal_id" class="col-sm-2 control-label">ปีการศึกษา <span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <?php						  
                          $sql = "select fiscal_id, fiscal_name from fiscal order by fiscal_name DESC;";
                          $query = mysqli_query($conn,$sql);
                        ?>
                            <select class="form-control" id="fiscal_id" name="fiscal_id">
                              <option value="0">Not Selected</option>
                              <?php
                            while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            ?>
                                <option value="<?php echo $row["fiscal_id"];?>">
                                  <?php echo $row["fiscal_name"];?>
                                </option>
                                <?php
                            }
                            mysqli_free_result($query);
                            ?>
                            </select>                            
                        </div>
                        <label for="sem_id" class="col-sm-2 control-label">ภาคการศึกษา <span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <?php						  
                          $sql = "select sem_id, sem_name from exam_sem order by sem_id;";
                          $query = mysqli_query($conn,$sql);
                          ?>
                            <select class="form-control" id="sem_id" name="sem_id">
                              <option value="0">Not Selected</option>
                              <?php
                            while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            ?>
                                <option value="<?php echo $row["sem_id"];?>">
                                  <?php echo $row["sem_name"];?>
                                </option>
                                <?php
                            }
                            mysqli_free_result($query);
                            ?>
                            </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="type_id" class="col-sm-2 control-label">ประเภทการสอบ</label>
                        <div class="col-sm-3">
                          <?php						  
                          $sql = "select type_id, type_name from exam_type order by CONVERT(type_name USING tis620);";
                          $query = mysqli_query($conn,$sql);
                        ?>
                            <select class="form-control" id="type_id" name="type_id">
                              <option value="0">Not Selected</option>
                              <?php
                            while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            ?>
                                <option value="<?php echo $row["type_id"];?>">
                                  <?php echo $row["type_name"];?>
                                </option>
                                <?php
                            }
                            mysqli_free_result($query);
                            ?>
                            </select>                            
                        </div>                        
                      </div>
                      <div class="form-group">
                        <label for="dept_id" class="col-sm-2 control-label">หน่วยงาน</label>
                        <div class="col-sm-8">
                          <?php						  
                          $sql = "select dept_id, dept_name from exam_dept order by CONVERT(dept_name USING tis620);";
                          $query = mysqli_query($conn,$sql);
                        ?>
                            <select class="form-control" id="dept_id" name="dept_id">
                              <option value="0">Not Selected</option>
                              <?php
                            while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            ?>
                                <option value="<?php echo $row["dept_id"];?>">
                                  <?php echo $row["dept_name"];?>
                                </option>
                                <?php
                            }
                            mysqli_free_result($query);
                            ?>
                            </select>                            
                        </div>                        
                      </div>                      
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="reset" class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-danger" name="search" value="1">Search</button>
                    </div>
                    <!-- /.box-footer -->
                  </form>                  
                  <hr>  
                  <table id="example1" class="table table-bordered table-striped table-hover table-responsive" width="100%">
                    <thead>
                      <tr>
                        <th width="1%">ปีการศึกษา</th>
                        <th width="47%">หน่วยงาน</th>                        
                        <th width="10%">รหัสวิชา</th>
                        <th width="24%">ชื่อวิชา</th>
                        <th width="10%">ประเภทการสอบ</th>
                        <th width="10%">รายละเอียดการสอบ</th>                  
                      </tr>
                    </thead>
                    <tbody>                      
                      <?php
                      $i=1;
                      while($row=@mysqli_fetch_array($qCourse,MYSQLI_ASSOC)){
                      ?>
                      <tr>
                        <td><?php echo $row["fiscal_name"]." ".$row["sem_name"];?></td>                                                
                        <td><?php echo $row["dept_name"];?></td>
                        <td><ul><li><?php echo $row["course_name"];?></li></ul></td>                        
                        <td><?php echo $row["course_desc"];?></td>
                        <td>
                          <?php echo $row["type_name"];?>
                        </td>
                        <td>
                          <a href="details.php?cid=<?php echo $row["course_id"];?>&fid=<?php echo $row["fiscal_id"];?>&sid=<?php echo $row["sem_id"];?>&deptid=<?php echo $row["dept_id"];?>">
                          <i class="fa fa-search"></i> ดูรายละเอียด</a>
                        </td>
                      </tr>
                      <?php
                          $i++;
                        }
                        @mysqli_free_result($qCourse);  
                      ?>                                          
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>

              <!--
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Calendar of room usage</h3>
            </div>
            <!-- /.box-header -->
              <!--
            <div class="box-body">           
                <div id='calendar'></div>
            </div>
          </div>  
          -->

            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->

        </section>

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Modal -->
      <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
      
          <!-- Modal content-->            
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>              
              <h4 class="modal-title">
                  <i class="glyphicon glyphicon-list-alt"></i> ข้อมูลรายละเอียดวิชาที่จัดสอบ
              </h4>
            </div>
            <div class="modal-body">
              <div id="modal-loader" style="display: none; text-align: center;">
                  <!-- ajax loader -->
                  <img src="ajax-loader.gif">
                  </div>
                                  
                <!-- mysql data will be load here -->                          
                <div id="dynamic-content"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
      </div>  

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <!--<b>Version</b> 2.3.11-->
        </div>
        <strong>Copyright &copy; 2018 Faculty of Engineering, Kasetsart University.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Fullcalendar-3.6.2 -->
    <script src="fullcalendar-3.6.2/lib/moment.min.js"></script>
    <script src="fullcalendar-3.6.2/fullcalendar.min.js"></script>
    <!-- Fancybox -->
    <script src="fancy/jquery.fancybox.pack.js"></script>
    <script src="fancy/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="fancy/helpers/jquery.fancybox-buttons.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true,
          "columnDefs": [{
            "visible": false,
            "targets": [0,1]
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

            api.column(0, {
              page: 'current'
            }).data().each(function (group, i) {
              if (last !== group) {
                $(rows).eq(i).before(
                  '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">ปีการศึกษา ' + group + '</h4></td></tr>'
                );

                last = group;
              }
            });

            api.column(1, {
              page: 'current'
            }).data().each(function (group, i) {
              if (last !== group) {
                $(rows).eq(i).before(
                  '<tr class="group"><td colspan=8"><h4 style="color:#b0081c">&nbsp;&nbsp; ' + group + '</h4></td></tr>'
                );

                last = group;
              }
            });

          },
        });
        $('#example2').DataTable({
          "responsive": true,
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script>
      /*
      	$(document).ready(function() {

      		$('#calendar').fullCalendar({
      			defaultDate: '2017-10-12',
      			editable: true,
      			eventLimit: true, // allow "more" link when too many events
      			
      			events: [
      				{
      					title: 'All Day Event',
      					start: '2017-10-01',
      				},
      				{
      					title: 'Long Event',
      					start: '2017-10-07',
      					end: '2017-10-10'
      				},
      				{
      					id: 999,
      					title: 'Repeating Event',
      					start: '2017-10-09T16:00:00'
      				},
      				{
      					id: 999,
      					title: 'Repeating Event',
      					start: '2017-10-16T16:00:00'
      				},
      				{
      					title: 'Conference',
      					start: '2017-10-11',
      					end: '2017-10-13'
      				},
      				{
      					title: 'Meeting',
      					start: '2017-10-12T10:30:00',
      					end: '2017-10-12T12:30:00'
      				},
      				{
      					title: 'Lunch',
      					start: '2017-10-12T12:00:00'
      				},
      				{
      					title: 'Meeting',
      					start: '2017-10-12T14:30:00'
      				},
      				{
      					title: 'Happy Hour',
      					start: '2017-10-12T17:30:00'
      				},
      				{
      					title: 'Dinner',
      					start: '2017-10-12T20:00:00'
      				},
      				{
      					title: 'Birthday Party',
      					start: '2017-10-13T07:00:00'
      				},
      				{
      					title: 'Click for Google',
      					url: 'http://google.com/',
      					start: '2017-10-28'
      				}
      			]
      		});
      		
      	});
      	*/
      $(document).ready(function () {
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          eventLimit: true, // allow "more" link when too many events
          defaultDate: new Date(),
          //lang: currentLangCode,
          timezone: 'Asia/Bangkok',
          events: {
            url: 'data_events.php',
          },
          loading: function (bool) {
            $('#loading').toggle(bool);
          },

          eventClick: function (event) {
            if (event.url) {
              $.fancybox({
                'href': event.url,
                //'width': 900,
                'type': 'iframe',
                'autoScale': false,
                'openEffect': 'elastic',
                'openSpeed': 'fast',
                'closeEffect': 'elastic',
                'closeSpeed': 'fast',
                'closeBtn': true,
                onClosed: function () {
                  parent.location.reload(true);
                },
                helpers: {
                  thumbs: {
                    width: 50,
                    height: 50
                  },

                  overlay: {
                    css: {
                      'background': 'rgba(49, 176, 213, 0.7)'
                    }
                  }
                }
              });
              return false;
            }
          },
        });
      });
    </script>
    
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
      if(strRoom==0)
      {
        alert("โปรดระบุ ปีการศึกษา");
        b.focus();
        return false;
      }

      var c = document.getElementById("sem_id");
      var strSem = c.options[c.selectedIndex].value;
      if(strSem==0)
      {
        alert("โปรดระบุ ภาคการศึกษา");
        c.focus();
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
    $(document).ready(function () {
      $(document).on('click', '#getExamDetail', function (e) {

        e.preventDefault();

        var eid = $(this).data('id'); // get id of clicked row

        $('#dynamic-content').html(''); // leave this div blank
        $('#modal-loader').show(); // load ajax loader on button click

        $.ajax({
            url: 'getExamDetail.php',
            type: 'POST',
            data: 'id=' + eid,
            dataType: 'html'
          })
          .done(function (data) {
            console.log(data);
            $('#dynamic-content').html(''); // blank before load.
            $('#dynamic-content').html(data); // load here
            $('#modal-loader').hide(); // hide loader  
          })
          .fail(function () {
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
          });
      });
    });

    </script>

  </body>

  </html>