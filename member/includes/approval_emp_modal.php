<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="approval_emp_add.php">
				<!-- <input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">   -->
				<div class="modal-body">            	
                    <div class="form-group">
						<label for="employee_id" class="col-sm-3 control-label">หมายเลขบัตรประชาชน</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="employee_id" name="employee_id" value="" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="titlename" class="col-sm-3 control-label">คำนำหน้าชื่อ</label>
						<div class="col-sm-9">						
						<select class="form-control" name="titlename" id="titlename" required>		
                            <option value='' selected>- Select -</option>
                            <option value='น.ส.'>น.ส.</option>
                            <option value='นาง'>นาง</option>
                            <option value='นางสาว'>นางสาว</option>
                            <option value='นาย'>นาย</option>
							<option value='ว่าที่ ร.ต.'>ว่าที่ ร.ต.</option>                            
							<option value='ว่าที่ ร.ต.หญิง'>ว่าที่ ร.ต.หญิง</option>                            
                            <option value='Mr.'>Mr.</option>
                            <option value='Mrs.'>Mrs.</option>
                            <option value='Ms.'>Ms.</option>
                        </select>
						</div>
					</div>
                    <div class="form-group">
						<label for="firstname" class="col-sm-3 control-label">ชื่อ</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="firstname" name="firstname" value="" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="lastname" name="lastname" value="" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="gender" class="col-sm-3 control-label">เพศ</label>
						<div class="col-sm-9">						
						<select class="form-control" name="gender" id="gender" required>		
                            <option value='' selected>- Select -</option>
                            <option value='Female'>Female</option>
                            <option value='Male'>Male</option>                            
                        </select>
						</div>
					</div>                    
                    <div class="form-group">
						<label for="dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
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
						<label for="position_id" class="col-sm-3 control-label">ตำแหน่ง</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<select class="form-control" name="position_id" id="position_id" required>
							<option value="" selected>- Select -</option>
							<?php
							// if($_SESSION['deptid']==99){
								$sql = "SELECT DISTINCT id, description
										FROM position
										ORDER BY CONVERT(description USING tis620)
										;";
							// }else{
							// 	$sql = "SELECT *, employees.id AS empid 
							// 			FROM approval_group
							// 			LEFT JOIN employees  ON employees.id=approval_group.emp_id 
							// 			LEFT JOIN department ON department.dept_id=approval_group.dept_id 
							// 			WHERE approval_group.dept_id = '".$_SESSION['deptid']."'
							// 			ORDER BY CONVERT(employees.firstname USING tis620)
							// 			;";	
							// }
							$query = $conn->query($sql);
							while($yrow = $query->fetch_assoc()){
								echo "
								<option value='".$yrow['id']."'>".$yrow['description']."</option>
								";
							}
							?>
						</select>
						</div>
					</div>	
                    <div class="form-group">
						<label for="bank_account" class="col-sm-3 control-label">บัญชีธนาคาร</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="bank_account" name="bank_account" value="">
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
            	<!-- <h4 class="modal-title"><b><span id="employee_name"></span></b></h4> -->
				    <h4 class="modal-title"><b>Edit Employee</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_emp_edit.php">
					<!-- <input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>"> -->
					<input type="hidden" id="id" name="id">
                    <div class="form-group">
						<label for="edit_employee_id" class="col-sm-3 control-label">หมายเลขบัตรประชาชน</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="edit_employee_id" name="edit_employee_id" value="" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="edit_titlename" class="col-sm-3 control-label">คำนำหน้าชื่อ</label>
						<div class="col-sm-9">						
						<select class="form-control" name="edit_titlename" id="edit_titlename" required>		
                            <option value='' selected>- Select -</option>
                            <option value='น.ส.'>น.ส.</option>
                            <option value='นาง'>นาง</option>
                            <option value='นางสาว'>นางสาว</option>
                            <option value='นาย'>นาย</option>  
							<option value='ว่าที่ ร.ต.'>ว่าที่ ร.ต.</option> 
							<option value='ว่าที่ ร.ต.หญิง'>ว่าที่ ร.ต.หญิง</option>                         
                            <option value='Mr.'>Mr.</option>
                            <option value='Mrs.'>Mrs.</option>
                            <option value='Ms.'>Ms.</option>
                        </select>
						</div>
					</div>
                    <div class="form-group">
						<label for="edit_firstname" class="col-sm-3 control-label">ชื่อ</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="edit_firstname" name="edit_firstname" value="" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="edit_lastname" class="col-sm-3 control-label">นามสกุล</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="edit_lastname" name="edit_lastname" value="" required>
						</div>
					</div>
                    <div class="form-group">
						<label for="edit_gender" class="col-sm-3 control-label">เพศ</label>
						<div class="col-sm-9">						
						<select class="form-control" name="edit_gender" id="edit_gender" required>		
                            <option value='' selected>- Select -</option>
                            <option value='Female'>Female</option>
                            <option value='Male'>Male</option>                            
                        </select>
						</div>
					</div>
				    <div class="form-group">
						<label for="edit_dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
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
						<label for="edit_position_id" class="col-sm-3 control-label">ตำแหน่ง</label>
						<div class="col-sm-9">
						
						<select class="form-control" name="edit_position_id" id="edit_position_id" required>
							<option value="" selected>- Select -</option>
							<?php							
								$sql = "SELECT DISTINCT id, description
										FROM position
										ORDER BY CONVERT(description USING tis620)
										;";							
							$query = $conn->query($sql);
							while($yrow = $query->fetch_assoc()){
								echo "
								<option value='".$yrow['id']."'>".$yrow['description']."</option>
								";
							}
							?>
						</select>
						</div>
					</div>	
                    <div class="form-group">
						<label for="edit_bank_account" class="col-sm-3 control-label">บัญชีธนาคาร</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="edit_bank_account" name="edit_bank_account" value="">
						</div>
					</div>
                </div>    											          	
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>                    
                </div>
            </form>            
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
				<h4 class="modal-title"><b>Delete Employee</b></h4>
				<!-- <h4 class="modal-title"><b><span id="del_employee_name"></span></b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_emp_delete.php">
                <input type="hidden" id="del_id" name="del_id">
                
                <div class="form-group">
						<label for="del_employee_id" class="col-sm-3 control-label">หมายเลขบัตรประชาชน</label>
						<div class="col-sm-9">						
						<input type="text" class="form-control" id="del_employee_id" name="del_employee_id" value="" required readonly>
						</div>
                </div>
                <div class="form-group">
                    <label for="del_titlename" class="col-sm-3 control-label">คำนำหน้าชื่อ</label>
                    <div class="col-sm-9">						
                    <select class="form-control" name="del_titlename" id="del_titlename" required readonly>		
                        <option value='' selected>- Select -</option>
                        <option value='น.ส.'>น.ส.</option>
                        <option value='นาง'>นาง</option>
                        <option value='นางสาว'>นางสาว</option>
                        <option value='นาย'>นาย</option>  
						<option value='ว่าที่ ร.ต.'>ว่าที่ ร.ต.</option>  
						<option value='ว่าที่ ร.ต.หญิง'>ว่าที่ ร.ต.หญิง</option>						                          
                        <option value='Mr.'>Mr.</option>
                        <option value='Mrs.'>Mrs.</option>
                        <option value='Ms.'>Ms.</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="del_firstname" class="col-sm-3 control-label">ชื่อ</label>
                    <div class="col-sm-9">						
                    <input type="text" class="form-control" id="del_firstname" name="del_firstname" value="" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="del_lastname" class="col-sm-3 control-label">นามสกุล</label>
                    <div class="col-sm-9">						
                    <input type="text" class="form-control" id="del_lastname" name="del_lastname" value="" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="del_gender" class="col-sm-3 control-label">เพศ</label>
                    <div class="col-sm-9">						
                    <select class="form-control" name="del_gender" id="del_gender" required readonly>		
                        <option value='' selected>- Select -</option>
                        <option value='Female'>Female</option>
                        <option value='Male'>Male</option>                            
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="del_dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
                    <div class="col-sm-9">
                    <?php //echo $_SESSION['deptid']." ".$app_id;?>
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
                    <label for="del_position_id" class="col-sm-3 control-label">ตำแหน่ง</label>
                    <div class="col-sm-9">
                    
                    <select class="form-control" name="del_position_id" id="del_position_id" required readonly>
                        <option value="" selected>- Select -</option>
                        <?php							
                            $sql = "SELECT DISTINCT id, description
                                    FROM position
                                    ORDER BY CONVERT(description USING tis620)
                                    ;";							
                        $query = $conn->query($sql);
                        while($yrow = $query->fetch_assoc()){
                            echo "
                            <option value='".$yrow['id']."'>".$yrow['description']."</option>
                            ";
                        }
                        ?>
                    </select>
                    </div>
                </div>	
                <div class="form-group">
                    <label for="del_bank_account" class="col-sm-3 control-label">บัญชีธนาคาร</label>
                    <div class="col-sm-9">						
                    <input type="text" class="form-control" id="del_bank_account" name="del_bank_account" value="" readonly>
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


     