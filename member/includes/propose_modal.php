<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>เพิ่มรายชื่อผู้ช่วยสอน</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="approval_add.php">
				<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">  
				<div class="modal-body">            	
					<!-- <div class="form-group">
						<label for="emp_id" class="col-sm-3 control-label">เจ้าหน้าที่</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<select class="form-control" name="emp_id" id="emp_id" required>
							<option value="" selected>- Select -</option>
							<?php
							if($_SESSION['deptid']==99){
								$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
										FROM approval_group
										LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1 
										LEFT JOIN department ON department.dept_id=approval_group.dept_id 
										WHERE approval_group.emp_id NOT IN (SELECT DISTINCT emp_id FROM approval_emp WHERE app_id = '".$app_id."')
										ORDER BY CONVERT(employees.firstname USING tis620)
										;";
							}else{
								$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
										FROM approval_group
										LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
										LEFT JOIN department ON department.dept_id=approval_group.dept_id 								
										WHERE approval_group.dept_id = '".$_SESSION['deptid']."'
										AND approval_group.emp_id NOT IN (SELECT DISTINCT emp_id FROM approval_emp WHERE app_id = '".$app_id."')
										ORDER BY CONVERT(employees.firstname USING tis620)
										;";	
							}
							$query = $conn->query($sql);
							while($yrow = $query->fetch_assoc()){
								echo "
								<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
								";
							}
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
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
				<!-- <h4 class="modal-title"><b>Edit Approval Form</b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_edit.php">
					<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">
					<input type="hidden" id="appe_id" name="appe_id">
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
					<label for="edit_emp_id" class="col-sm-3 control-label">ผู้ช่วยสอน</label>
					<div class="col-sm-9">
					<?php //echo $_SESSION['deptid']." ".$app_id;?>
					<select class="form-control" name="edit_emp_id" id="edit_emp_id" required>
						<option value="" selected>- Select -</option>
						<?php
						if($_SESSION['deptid']==99){
							$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
									FROM approval_group
									LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
									LEFT JOIN department ON department.dept_id=approval_group.dept_id 
									ORDER BY CONVERT(employees.firstname USING tis620)
									;";
						}else{
							$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname 
									FROM approval_group
									LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
									LEFT JOIN department ON department.dept_id=approval_group.dept_id 
									WHERE approval_group.dept_id = '".$_SESSION['deptid']."'
									ORDER BY CONVERT(employees.firstname USING tis620)
									;";	
						}
						$query = $conn->query($sql);
						while($yrow = $query->fetch_assoc()){
							echo "
							<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
							";
						}
						?>
					</select>
					</div>
				</div>					

				<div class="form-group">
					<label for="edit_reponsibility" class="col-sm-3 control-label">งานที่ปฏิบัติ</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_reponsibility" name="edit_reponsibility" value="" required>
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
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="attendance_date"></span></b></h4> -->				
				<!-- <h4 class="modal-title"><b>Delete Approval Form</b></h4> -->
				<h4 class="modal-title"><b><span id="del_employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_delete.php">
					<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">
					<input type="hidden" id="del_appe_id" name="del_app_eid">
            		<div class="form-group">
					<label for="del_emp_id" class="col-sm-3 control-label">ผู้ช่วยสอน</label>
					<div class="col-sm-9">
					<?php //echo $_SESSION['deptid']." ".$app_id;?>
					<select class="form-control" name="del_emp_id" id="del_emp_id" required readonly>
						<option value="" selected>- Select -</option>
						<?php
						if($_SESSION['deptid']==99){
							$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
									FROM approval_group
									LEFT JOIN employees  ON employees.id=approval_group.emp_id 
									LEFT JOIN department ON department.dept_id=approval_group.dept_id 
									ORDER BY CONVERT(employees.firstname USING tis620)
									;";
						}else{
							$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
									FROM approval_group
									LEFT JOIN employees  ON employees.id=approval_group.emp_id 
									LEFT JOIN department ON department.dept_id=approval_group.dept_id 
									WHERE approval_group.dept_id = '".$_SESSION['deptid']."'
									ORDER BY CONVERT(employees.firstname USING tis620)
									;";	
						}
						$query = $conn->query($sql);
						while($yrow = $query->fetch_assoc()){
							echo "
							<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
							";
						}
						?>
					</select>
					</div>
				</div>					

				<div class="form-group">
					<label for="del_reponsibility" class="col-sm-3 control-label">งานที่ปฏิบัติ</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_reponsibility" name="del_reponsibility" value="" required readonly>
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


     