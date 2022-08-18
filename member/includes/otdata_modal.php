<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Fingerprint Scan Data</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="otdata_add.php" enctype="multipart/form-data">  
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
						<label for="otdata_month" class="col-sm-3 control-label">เดือน</label>
						<div class="col-sm-9">
						<select class="form-control" name="otdata_month" id="otdata_month" required>
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
						<label for="otdata_type" class="col-sm-3 control-label">รูปแบบ File</label>

						<div class="col-sm-9">
						<input type="radio" name="otdata_type" id="otdata_type" value="1" checked> เครื่องรุ่นเก่า
						<input type="radio" name="otdata_type" id="otdata_type" value="2"> เครื่องรุ่นใหม่
						<input type="radio" name="otdata_type" id="otdata_type" value="3"> โครงการ Fit& Firm
						</div>
					</div>
					<div class="form-group">
						<label for="otdata_name" class="col-sm-3 control-label">ชื่อเอกสาร</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="otdata_name" name="otdata_name" value="ข้อมูลสแกนลายนิ้วมือประจำเดือน" required >
						</div>
					</div>
					
					<div class="form-group">
						<label for="app_head_position" class="col-sm-3 control-label">Fingerprint File</label>
						<div class="col-sm-9">
                        <input type="file" class="form-control col-sm-8" id="finger_file" name="finger_file" required>
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
<!-- <div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	
				<h4 class="modal-title"><b>Edit Approval Form</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_form_edit.php">
            		<input type="hidden" id="app_id" name="app_id">
                
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
						<input type="text" class="form-control" id="edit_app_doc_no" name="edit_app_doc_no" value="ศธ.0513.10801/" required>
					</div>
				</div>
				<div class="form-group">
					<label for="datepicker_approval_edit" class="col-sm-3 control-label">วันที่เอกสาร</label>

					<div class="col-sm-9"> 
					<div class="date">
						<input type="text" class="form-control" id="datepicker_edit" name="datepicker_edit" required>
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
</div> -->

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="attendance_date"></span></b></h4> -->
				<h4 class="modal-title"><b>Delete Fingerprint Scan Data</b></h4>
          	</div>
          	<div class="modal-body">
			  <form class="form-horizontal" method="POST" action="otdata_delete.php" enctype="multipart/form-data">  
			  	<input type="hidden" id="del_otdata_id" name="del_otdata_id">
				<div class="modal-body">            	
					<div class="form-group">
						<label for="del_year_id" class="col-sm-3 control-label">ปี</label>
						<div class="col-sm-9">
						<select class="form-control" name="del_year_id" id="del_year_id" required>
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
						<label for="del_otdata_month" class="col-sm-3 control-label">เดือน</label>
						<div class="col-sm-9">
						<select class="form-control" name="del_otdata_month" id="del_otdata_month" required>
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
						<label for="del_otdata_name" class="col-sm-3 control-label">ชื่อเอกสาร</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="del_otdata_name" name="del_otdata_name" value="" required>
						</div>
					</div>																				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
				</div>
			</form>				
        </div>
    </div>
</div>


     