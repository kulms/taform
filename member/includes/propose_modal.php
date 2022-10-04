<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>เพิ่มรายชื่อผู้ช่วยสอน</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="propose_add.php" enctype="multipart/form-data">
				<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">  
				<div class="modal-body">            	
					<!-- <div class="form-group">
						<label for="emp_id" class="col-sm-3 control-label">เจ้าหน้าที่</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<select class="form-control" name="emp_id" id="emp_id" required>
							<option value="" selected>- Select -</option>
							<?php
							// if($_SESSION['deptid']==99){
							// 	$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
							// 			FROM approval_group
							// 			LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1 
							// 			LEFT JOIN department ON department.dept_id=approval_group.dept_id 
							// 			WHERE approval_group.emp_id NOT IN (SELECT DISTINCT emp_id FROM approval_emp WHERE app_id = '".$app_id."')
							// 			ORDER BY CONVERT(employees.firstname USING tis620)
							// 			;";
							// }else{
							// 	$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
							// 			FROM approval_group
							// 			LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
							// 			LEFT JOIN department ON department.dept_id=approval_group.dept_id 								
							// 			WHERE approval_group.dept_id = '".$_SESSION['deptid']."'
							// 			AND approval_group.emp_id NOT IN (SELECT DISTINCT emp_id FROM approval_emp WHERE app_id = '".$app_id."')
							// 			ORDER BY CONVERT(employees.firstname USING tis620)
							// 			;";	
							// }
							// $query = $conn->query($sql);
							// while($yrow = $query->fetch_assoc()){
							// 	echo "
							// 	<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
							// 	";
							// }
							?>
						</select>
						</div>
					</div>					 -->

					<!-- <div class="form-group">
						<label for="reponsibility" class="col-sm-3 control-label">งานที่ปฏิบัติ</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="reponsibility" name="reponsibility" value="" required>
						</div>
					</div> -->
					<!--
					<div class="form-group">
						<label for="time_in" class="col-sm-3 control-label">Time In</label>

						<div class="col-sm-9">
							<div class="bootstrap-timepicker">
								<input type="text" class="form-control timepicker" id="time_in" name="time_in">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="time_out" class="col-sm-3 control-label">Time Out</label>

						<div class="col-sm-9">
							<div class="bootstrap-timepicker">
								<input type="text" class="form-control timepicker" id="time_out" name="time_out">
							</div>
						</div>
					</div> -->
                    <div class="form-group">
						<label for="app_head_position" class="col-sm-3 control-label">File รายชื่อผู้ช่วยสอน</label>
						<div class="col-sm-9">
                        <input type="file" class="form-control col-sm-8" id="finger_file" name="finger_file" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="app_head_position" class="col-sm-3 control-label">Example File</label>
						<div class="col-sm-9">
                        <!-- <input type="file" class="form-control col-sm-8" id="finger_file" name="finger_file" required> -->
                        <a href="../files/template/template_ta_import.xlsx">Download</a>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
				</div>
			</form>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
	<!-- <div class="modal-dialog"> -->
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
				<h4 class="modal-title"><b>แก้ไขชื่อนิสิต</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="propose_edit.php" onSubmit="return confirm('Do you want to update ?')">
					<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">
					<input type="hidden" id="app_std_id" name="app_std_id">
					<!-- <input type="hidden" id="app_std_rec_id" name="app_std_rec_id" value="<?php // echo $app_std_rec_id;?>"> -->
                <!-- <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="edit_date">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_in" class="col-sm-3 control-label">Time In</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_in" name="edit_time_in">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_out" class="col-sm-3 control-label">Time Out</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_out" name="edit_time_out">
                    	</div>
                  	</div>
                </div> -->
				<div class="form-group">
					<label for="edit_std_id" class="col-sm-2 control-label">รหัสประจำตัวนิสิต</label>
					<div class="col-sm-4">					
						<input type="text" class="form-control" id="edit_std_id" name="edit_std_id" value="" >
					</div>
				</div>					

				<div class="form-group">
					<label for="edit_std_title_name" class="col-sm-2 control-label">คำนำหน้าชื่อ</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_title_name" name="edit_std_title_name" value="" required>
					</div>
					<!-- <label for="edit_std_name" class="col-sm-2 control-label">ชื่อ – สกุล</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_name" name="edit_std_name" value="" required>
					</div> -->
				</div>
				<div class="form-group">
					<label for="edit_std_name" class="col-sm-2 control-label">ชื่อ – สกุล</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="edit_std_name" name="edit_std_name" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_std_degree" class="col-sm-2 control-label">นิสิตระดับ</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_degree" name="edit_std_degree" value="" required>
					</div>
					<label for="edit_std_class" class="col-sm-2 control-label">ชั้นปีที่</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_class" name="edit_std_class" value="" required>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="edit_std_class" class="col-sm-2 control-label">ชั้นปีที่</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_class" name="edit_std_class" value="" required>
					</div>
				</div> -->
				<div class="form-group">
					<label for="edit_std_subject" class="col-sm-2 control-label">รายวิชาที่ช่วยสอน</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_subject" name="edit_std_subject" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_std_section" class="col-sm-2 control-label">หมู่เรียน</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_section" name="edit_std_section" value="" required>
					</div>
					<label for="edit_std_number" class="col-sm-2 control-label">จำนวนนิสิต</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_number" name="edit_std_number" value="" required>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="edit_std_number" class="col-sm-2 control-label">จำนวนนิสิต</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_number" name="edit_std_number" value="" required>
					</div>
				</div> -->
				<div class="form-group">
					<label for="edit_std_amount" class="col-sm-2 control-label">อัตราค่าสอนต่อเดือน (บาท)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="edit_std_amount" name="edit_std_amount" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_std_gpa" class="col-sm-2 control-label">GPA</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_gpa" name="edit_std_gpa" value="" >
					</div>
					<label for="edit_std_score" class="col-sm-2 control-label">คะแนนวิชาที่ช่วยสอน</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="edit_std_score" name="edit_std_score" value="" >
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="edit_std_score" class="col-sm-4 control-label">คะแนนวิชาที่ช่วยสอน</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="edit_std_score" name="edit_std_score" value="" >
					</div>
				</div> -->
				<div class="form-group">
					<label for="edit_std_bankno" class="col-sm-2 control-label">เลขบัญชี</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="edit_std_bankno" name="edit_std_bankno" value="" >
					</div>
				</div>
				<div class="form-group">
					<label for="edit_std_bankname" class="col-sm-2 control-label">ชื่อธนาคาร</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="edit_std_bankname" name="edit_std_bankname" value="" >
					</div>
				</div>
				<div class="form-group">
					<label for="edit_std_phone" class="col-sm-2 control-label">เบอร์โทร</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="edit_std_phone" name="edit_std_phone" value="" >
					</div>
				</div>		

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-lg">
	<!-- <div class="modal-dialog"> -->
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="attendance_date"></span></b></h4> -->				
				<h4 class="modal-title"><b>ลบชื่อนิสิต</b></h4>
				<!-- <h4 class="modal-title"><b><span id="del_employee_name"></span></b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="propose_delete.php" onSubmit="return confirm('Do you want to delete ?')">
					<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">
					<input type="hidden" id="del_app_std_id" name="del_app_std_id">
					
					<div class="form-group">
						<label for="del_std_id" class="col-sm-2 control-label">รหัสประจำตัวนิสิต</label>
						<div class="col-sm-4">					
							<input type="text" class="form-control" id="del_std_id" name="del_std_id" value="" disabled>
						</div>
					</div>					

					<div class="form-group">
						<label for="del_std_title_name" class="col-sm-2 control-label">คำนำหน้าชื่อ</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_title_name" name="del_std_title_name" value="" required disabled>
						</div>
						<!-- <label for="del_std_name" class="col-sm-2 control-label">ชื่อ – สกุล</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_name" name="del_std_name" value="" required>
						</div> -->
					</div>
					<div class="form-group">
						<label for="del_std_name" class="col-sm-2 control-label">ชื่อ – สกุล</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="del_std_name" name="del_std_name" value="" required disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="del_std_degree" class="col-sm-2 control-label">นิสิตระดับ</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_degree" name="del_std_degree" value="" required disabled>
						</div>
						<label for="del_std_class" class="col-sm-2 control-label">ชั้นปีที่</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_class" name="del_std_class" value="" required disabled>
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="del_std_class" class="col-sm-2 control-label">ชั้นปีที่</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_class" name="del_std_class" value="" required>
						</div>
					</div> -->
					<div class="form-group">
						<label for="del_std_subject" class="col-sm-2 control-label">รายวิชาที่ช่วยสอน</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_subject" name="del_std_subject" value="" required disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="del_std_section" class="col-sm-2 control-label">หมู่เรียน</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_section" name="del_std_section" value="" required disabled>
						</div>
						<label for="del_std_number" class="col-sm-2 control-label">จำนวนนิสิต</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_number" name="del_std_number" value="" required disabled>
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="del_std_number" class="col-sm-2 control-label">จำนวนนิสิต</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_number" name="del_std_number" value="" required>
						</div>
					</div> -->
					<div class="form-group">
						<label for="del_std_amount" class="col-sm-2 control-label">อัตราค่าสอนต่อเดือน (บาท)</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="del_std_amount" name="del_std_amount" value="" required disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="del_std_gpa" class="col-sm-2 control-label">GPA</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_gpa" name="del_std_gpa" value="" disabled>
						</div>
						<label for="del_std_score" class="col-sm-2 control-label">คะแนนวิชาที่ช่วยสอน</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="del_std_score" name="del_std_score" value="" disabled>
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="del_std_score" class="col-sm-4 control-label">คะแนนวิชาที่ช่วยสอน</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="del_std_score" name="del_std_score" value="" >
						</div>
					</div> -->
					<div class="form-group">
						<label for="del_std_bankno" class="col-sm-2 control-label">เลขบัญชี</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="del_std_bankno" name="del_std_bankno" value="" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="del_std_bankname" class="col-sm-2 control-label">ชื่อธนาคาร</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="del_std_bankname" name="del_std_bankname" value="" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="del_std_phone" class="col-sm-2 control-label">เบอร์โทร</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="del_std_phone" name="del_std_phone" value="" disabled>
						</div>
					</div>
							

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     