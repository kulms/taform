<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Approval Member</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="approval_group_add.php">
				<!-- <input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">   -->
				<div class="modal-body">            	
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
						<label for="emp_id" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<select class="form-control" name="emp_id" id="emp_id" required>
							<option value="" selected>- Select -</option>
							<?php
							// if($_SESSION['deptid']==99){
								// $sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname  
								// 		FROM approval_group
								// 		LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
								// 		LEFT JOIN department ON department.dept_id=approval_group.dept_id 
								// 		ORDER BY CONVERT(employees.firstname USING tis620)
								// 		;";
								$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname  
										FROM employees										
										LEFT JOIN department ON department.dept_id=employees.dept_id 
										WHERE employees.active = 1
										ORDER BY CONVERT(employees.firstname USING tis620)
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
								<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
								";
							}
							?>
						</select>
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
				    <h4 class="modal-title"><b>Edit Approval Member</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_group_edit.php">
					<!-- <input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>"> -->
					<input type="hidden" id="appg_id" name="appg_id">
                
				    <div class="form-group">
						<label for="edit_dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
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
						<label for="edit_emp_id" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<select class="form-control" name="edit_emp_id" id="edit_emp_id" required>
							<option value="" selected>- Select -</option>
							<?php
							// if($_SESSION['deptid']==99){
								$sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
										FROM approval_group
										LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
										LEFT JOIN department ON department.dept_id=approval_group.dept_id 
										ORDER BY CONVERT(employees.firstname USING tis620)
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
								<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
								";
							}
							?>
						</select>
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
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="attendance_date"></span></b></h4> -->				
				<h4 class="modal-title"><b>Delete Approval Memeber</b></h4>
				<!-- <h4 class="modal-title"><b><span id="del_employee_name"></span></b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_group_delete.php">
                <input type="hidden" id="del_appg_id" name="del_appg_id">
                
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
                    <label for="del_emp_id" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-9">
                    <?php //echo $_SESSION['deptid']." ".$app_id;?>
                    <select class="form-control" name="del_emp_id" id="del_emp_id" required disabled>
                        <option value="" selected>- Select -</option>
                        <?php
                        // if($_SESSION['deptid']==99){
                            $sql = "SELECT DISTINCT employees.id AS empid, employees.titlename, employees.firstname, employees.lastname
                                    FROM approval_group
                                    LEFT JOIN employees  ON employees.id=approval_group.emp_id AND employees.active = 1
                                    LEFT JOIN department ON department.dept_id=approval_group.dept_id 
                                    ORDER BY CONVERT(employees.firstname USING tis620)
                                    ;";
                        // }else{
                        //     $sql = "SELECT *, employees.id AS empid 
                        //             FROM approval_group
                        //             LEFT JOIN employees  ON employees.id=approval_group.emp_id 
                        //             LEFT JOIN department ON department.dept_id=approval_group.dept_id 
                        //             WHERE approval_group.dept_id = '".$_SESSION['deptid']."'
                        //             ORDER BY CONVERT(employees.firstname USING tis620)
                        //             ;";	
                        // }
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

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     