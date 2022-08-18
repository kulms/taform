<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php  
                if(!empty($user['photo'])){  
                  if(strlen($user['photo'])>70){
                    echo $user['photo'];
                  }else{
                    echo '../images/'.$user['photo'];
                  }  
                }else{  
                  echo '../images/profile.jpg';
                } 
                ?>
                " class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>หน้าหลัก</span></a></li>
        <?php
        if($_SESSION["deptid"]!='101'){
        ?>
        <li class="header">MANAGE</li>                
        <li><a href="propose_form.php"><i class="fa fa-calendar-check-o"></i> <span>แบบฟอร์มเสนอรายชื่อนิสิต</span></a></li>
        <li><a href="approval_form.php"><i class="fa fa-calendar-check-o"></i> <span>แบบฟอร์มขอเบิกทุน (รายเดือน)</span></a></li>
        <li><a href="approval_group.php"><i class="fa fa-users"></i> <span>นิสิตในหน่วยงาน</span></a></li>        
        <li><a href="approval_dept.php"><i class="fa fa-building-o"></i> <span>ข้อมูลหน่วยงาน</span></a></li>
        <?php
        }
        ?> 
        <?php
        if($_SESSION["deptid"]=='99'){
        ?>        
        <li><a href="approval_emp.php"><i class="fa fa-users"></i> <span>ข้อมูลนิสิต</span></a></li>
        <!-- <li><a href="approval_position.php"><i class="fa fa-star"></i> <span>ข้อมูลตำแหน่ง</span></a></li> -->
        <?php
        }
        ?>
        <?php
        if($_SESSION["deptid"]=='99'){
        ?>
        <li class="header">CALCULATE</li>        
        <!-- <li><a href="otdata.php"><i class="fa fa-upload"></i> <span>นำเข้าข้อมูล</span></a></li> -->
        <!-- <li><a href="otdata_calculate.php"><i class="fa fa-gears"></i> <span>คำนวณเวลาทำงาน</span></a></li> -->
        <?php
        }else{
          if($_SESSION["deptid"]!='101'){
        ?>
        <li class="header">SUMMARY</li>        
        <li><a href="sum_approval.php"><i class="fa fa-tasks"></i> <span>สรุปข้อมูลการขอทุน</span></a></li>   
        <!-- <li><a href="otdata_print.php"><i class="fa fa-hand-pointer-o"></i> <span>สรุปบัญชีลงเวลาปฏิบัติงาน</span></a></li>
        <li class="header">SCAN DATA</li>        
        <li><a href="otscan.php"><i class="fa fa-upload"></i> <span>ข้อมูลจากเครื่องสแกน</span></a></li>    -->
        <?php  
          }
        }
        ?>
        <?php
        if($_SESSION["deptid"]=='99' || $_SESSION["deptid"]=='101'){
        ?>
        <li class="header">REPORT</li>        
        <li><a href="sum_otdata_monthly.php"><i class="fa fa-bar-chart"></i> <span>สรุปการจ่ายเงินแต่ละเดือน</span></a></li>
        <li><a href="sum_otdata_dept.php"><i class="fa fa-bar-chart"></i> <span>สรุปการจ่ายเงินแต่ละหน่วยงาน</span></a></li>
        <li><a href="sum_otdata_fiscal.php"><i class="fa fa-bar-chart"></i> <span>สรุปการจ่ายเงินตามปีงบประมาณ</span></a></li>
        <!-- <li class="header">Data Studio</li>        
        <li><a href="https://datastudio.google.com/reporting/6cec3ef8-5e2c-4549-8407-731d8127a7fb/page/9JWtB" target="_blank"><i class="fa fa-bar-chart"></i> <span>สรุปการจ่ายเงินตามปีงบประมาณ</span></a></li> -->
        <?php  
        }
        if($_SESSION["deptid"]!='101'){
        ?>
        <li class="header">PRINTABLES</li>
        <!-- <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payroll</span></a></li> -->
        <li><a href="approval_form_print.php"><i class="fa fa-files-o"></i> <span>พิมพ์แบบฟอร์มขอทุน</span></a></li>
        <!-- <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Schedule</span></a></li> -->
        <!-- <li><a href="otdata_print.php"><i class="fa fa-money"></i> <span>พิมพ์บัญชีลงเวลาปฏิบัติงาน</span></a></li> -->
        <!-- <li><a href="otdata_print_2563.php"><i class="fa fa-money"></i> <span>พิมพ์บัญชีลงเวลาปฏิบัติงาน</span></a></li>
        <li><a href="otdata_work.php"><i class="fa fa-calendar"></i> <span>พิมพ์บัญชีการมาทำงาน</span></a></li> -->
        <?php
        }
        if($_SESSION["deptid"]=='99' || $_SESSION["deptid"]=='100'){
        ?>
        <!-- <li class="header">TRANSFER</li>        
        <li><a href="bank_print.php"><i class="fa fa-file-text-o"></i> <span>สร้าง Text File ส่งธนาคาร</span></a></li>         -->
        <?php
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>