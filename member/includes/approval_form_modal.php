<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Approval Form</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="approval_form_add.php">  
				<div class="modal-body">            	
					<div class="form-group">
						<label for="year_id" class="col-sm-3 control-label">ปี</label>
						<div class="col-sm-9">
						<select class="form-control" name="year_id" id="year_id" required>
							<option value="" selected>- Select -</option>
							<?php
							$sql = "SELECT * FROM years";
							$query = $conn->query($sql);
							$curYear = date('Y')+543;							
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
							?>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label for="app_month" class="col-sm-3 control-label">เดือน</label>
						<div class="col-sm-9">
						<select class="form-control" name="app_month" id="app_month" required>
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
					<div class="form-group">
						<label for="dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
						<div class="col-sm-9">
						<select class="form-control" name="dept_id" id="dept_id" required>							
							<?php
							if($_SESSION["deptid"]=='99'){
								echo "
								<option value='' selected>- Select -</option>
								";
								$sql = "SELECT * FROM department ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."'>".$drow['dept_name']."</option>
									";
									$dept_head = "";
									$dept_position = "";
									$dept_part = "";
									$dept_bookno = "";
								}
							}else{
								echo "
								<option value=''>- Select -</option>
								";
								$sql = "SELECT * FROM department WHERE dept_id = '".$_SESSION["deptid"]."' ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."' selected>".$drow['dept_name']."</option>
									";
									$dept_head = $drow['dept_head'];
									$dept_position = $drow['dept_position'];
									$dept_part = $drow['dept_part'];
									$dept_bookno = $drow['dept_bookno'];
								}
							}							
							?>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label for="app_name" class="col-sm-3 control-label">ชื่อเอกสาร</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="app_name" name="app_name" value="แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลา" required readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="app_type_id" class="col-sm-3 control-label">แหล่งเงิน</label>
						<div class="col-sm-9">
						<select class="form-control" name="app_type_id" id="app_type_id" required>
							<option value="" selected>- Select -</option>
							<?php
							$sql = "SELECT * FROM app_type ORDER BY CONVERT (app_type_name USING tis620)";
							$query = $conn->query($sql);
							while($atrow = $query->fetch_assoc()){
								echo "
								<option value='".$atrow['app_type_id']."'>".$atrow['app_type_name']."</option>
								";
							}
							?>
						</select>
						</div>
					</div>
					

					<div class="form-group">
						<label for="app_detail" class="col-sm-3 control-label">ส่วนงาน</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="app_detail" name="app_detail" value="<?php echo $dept_part;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="app_doc_no" class="col-sm-3 control-label">เลขที่หนังสือ</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="app_doc_no" name="app_doc_no" value="<?php echo $dept_bookno;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="datepicker_approval_add" class="col-sm-3 control-label">วันที่เอกสาร</label>

						<div class="col-sm-9"> 
						<div class="date">
							<input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" value="<?php echo date("Y-m-d");?>" required readonly>
						</div>
						</div>
					</div>
					<div class="form-group">
						<label for="app_head" class="col-sm-3 control-label">ชื่อหัวหน้างาน</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="app_head" name="app_head" value="<?php echo $dept_head;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="app_head_position" class="col-sm-3 control-label">ตำแหน่ง</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="app_head_position" name="app_head_position" value="<?php echo $dept_position;?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="budget" class="col-sm-3 control-label">วงเงิน (ตัวเลข) บาท</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="budget" name="budget" required>
						</div>
					</div>


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
            	<!-- <h4 class="modal-title"><b><span id="employee_name"></span></b></h4> -->
				<h4 class="modal-title"><b>Edit Approval Form</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_form_edit.php">
            		<input type="hidden" id="app_id" name="app_id">
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
					<label for="year_id" class="col-sm-3 control-label">ปี</label>
					<div class="col-sm-9">
					<select class="form-control" name="edit_year_id" id="edit_year_id" required>
						<option value="" selected>- Select -</option>
						<?php
						$sql = "SELECT * FROM years";
						$query = $conn->query($sql);
						while($yrow = $query->fetch_assoc()){
							echo "
							<option value='".$yrow['year_id']."'>".$yrow['year_name']."</option>
							";
						}
						?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label for="app_month" class="col-sm-3 control-label">เดือน</label>
					<div class="col-sm-9">
					<select class="form-control" name="edit_app_month" id="edit_app_month" required>
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
				<div class="form-group">
					<label for="dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
					<div class="col-sm-9">
					<select class="form-control" name="edit_dept_id" id="edit_dept_id" required>
						<?php
							if($_SESSION["deptid"]=='99'){
								echo "
								<option value='' selected>- Select -</option>
								";
								$sql = "SELECT * FROM department ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."'>".$drow['dept_name']."</option>
									";
									$dept_head2 = "";
									$dept_position2 = "";
									$dept_part2 = "";
									$dept_bookno2 = "";
								}
							}else{
								echo "
								<option value=''>- Select -</option>
								";
								$sql = "SELECT * FROM department WHERE dept_id = '".$_SESSION["deptid"]."' ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."' selected>".$drow['dept_name']."</option>
									";
									$dept_head2 = $drow['dept_head'];
									$dept_position2 = $drow['dept_position'];
									$dept_part2 = $drow['dept_part'];
									$dept_bookno2 = $drow['dept_bookno'];
								}
							}							
							?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label for="app_name" class="col-sm-3 control-label">ชื่อเอกสาร</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_app_name" name="edit_app_name" value="แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลา" required readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="app_type_id" class="col-sm-3 control-label">แหล่งเงิน</label>
					<div class="col-sm-9">
					<select class="form-control" name="edit_app_type_id" id="edit_app_type_id" required>
						<option value="" selected>- Select -</option>
						<?php
						$sql = "SELECT * FROM app_type ORDER BY CONVERT (app_type_name USING tis620)";
						$query = $conn->query($sql);
						while($atrow = $query->fetch_assoc()){
							echo "
							<option value='".$atrow['app_type_id']."'>".$atrow['app_type_name']."</option>
							";
						}
						?>
					</select>
					</div>
				</div>

				<div class="form-group">
					<label for="edit_app_detail" class="col-sm-3 control-label">ส่วนงาน</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_app_detail" name="edit_app_detail" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_app_doc_no" class="col-sm-3 control-label">เลขที่หนังสือ</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_app_doc_no" name="edit_app_doc_no" value="<?php echo $dept_bookno2;?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="datepicker_approval_edit" class="col-sm-3 control-label">วันที่เอกสาร</label>

					<div class="col-sm-9"> 
					<div class="date">
						<input type="text" class="form-control" id="datepicker_edit" name="datepicker_edit" required readonly>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_app_head" class="col-sm-3 control-label">ชื่อหัวหน้างาน</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_app_head" name="edit_app_head" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_app_head_position" class="col-sm-3 control-label">ตำแหน่ง</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_app_head_position" name="edit_app_head_position" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_budget" class="col-sm-3 control-label">วงเงิน (ตัวเลข) บาท</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" id="edit_budget" name="edit_budget" required>
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
				<h4 class="modal-title"><b>Delete Approval Form</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_form_delete.php">
            		<input type="hidden" id="del_app_id" name="del_app_id">
            		<div class="form-group">
					<label for="year_id" class="col-sm-3 control-label">ปี</label>
					<div class="col-sm-9">
					<select class="form-control" name="del_year_id" id="del_year_id" required readonly>
						<option value="" selected>- Select -</option>
						<?php
						$sql = "SELECT * FROM years";
						$query = $conn->query($sql);
						while($yrow = $query->fetch_assoc()){
							echo "
							<option value='".$yrow['year_id']."'>".$yrow['year_name']."</option>
							";
						}
						?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label for="app_month" class="col-sm-3 control-label">เดือน</label>
					<div class="col-sm-9">
					<select class="form-control" name="del_app_month" id="del_app_month" required readonly>
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
				<div class="form-group">
					<label for="dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
					<div class="col-sm-9">
					<select class="form-control" name="del_dept_id" id="del_dept_id" required readonly>
						<?php
							if($_SESSION["deptid"]=='99'){
								echo "
								<option value='' selected>- Select -</option>
								";
								$sql = "SELECT * FROM department ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."'>".$drow['dept_name']."</option>
									";
								}
							}else{
								echo "
								<option value=''>- Select -</option>
								";
								$sql = "SELECT * FROM department WHERE dept_id = '".$_SESSION["deptid"]."' ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."' selected>".$drow['dept_name']."</option>
									";
								}
							}							
							?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label for="app_name" class="col-sm-3 control-label">ชื่อเอกสาร</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_app_name" name="del_app_name" value="แบบขออนุมัติในหลักการปฏิบัติราชการนอกเวลา" required readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="app_type_id" class="col-sm-3 control-label">แหล่งเงิน</label>
					<div class="col-sm-9">
					<select class="form-control" name="del_app_type_id" id="del_app_type_id" required readonly>
						<option value="" selected>- Select -</option>
						<?php
						$sql = "SELECT * FROM app_type ORDER BY CONVERT (app_type_name USING tis620)";
						$query = $conn->query($sql);
						while($atrow = $query->fetch_assoc()){
							echo "
							<option value='".$atrow['app_type_id']."'>".$atrow['app_type_name']."</option>
							";
						}
						?>
					</select>
					</div>
				</div>

				<div class="form-group">
					<label for="del_app_detail" class="col-sm-3 control-label">ส่วนงาน</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_app_detail" name="del_app_detail" value="" required>
					</div>
				</div>
				<div class="form-group">
					<label for="del_app_doc_no" class="col-sm-3 control-label">เลขที่หนังสือ</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_app_doc_no" name="del_app_doc_no" value="ศธ.0513.10801/" required>
					</div>
				</div>
				<div class="form-group">
					<label for="datepicker_approval_del" class="col-sm-3 control-label">วันที่เอกสาร</label>

					<div class="col-sm-9"> 
					<div class="date">
						<input type="text" class="form-control" id="datepicker_del" name="datepicker_del" required>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label for="del_app_head" class="col-sm-3 control-label">ชื่อหัวหน้างาน</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_app_head" name="del_app_head" required>
					</div>
				</div>
				<div class="form-group">
					<label for="del_app_head_position" class="col-sm-3 control-label">ตำแหน่ง</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_app_head_position" name="del_app_head_position" required>
					</div>
				</div>
				<div class="form-group">
					<label for="del_budget" class="col-sm-3 control-label">วงเงิน (ตัวเลข) บาท</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" id="del_budget" name="del_budget" required>
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


     