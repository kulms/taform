<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Propose Form</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="propose_form_add.php">  
				<div class="modal-body">            	
					<div class="form-group">
                        <label for="fiscal_id" class="col-sm-3 control-label">ปีการศึกษา <span style="color:red;">*</span></label>
						<div class="col-sm-9">
						<select class="form-control" name="fiscal_id" id="fiscal_id" required>
							<option value="" selected>- Select -</option>
							<?php
							$sql = "select fiscal_id, fiscal_name from fiscal order by fiscal_name DESC;";
							$query = $conn->query($sql);
							$curYear = date('Y')+543;							
							while($yrow = $query->fetch_assoc()){
								if($yrow["year_name"]==$curYear){
									echo "
									<option value='".$yrow['fiscal_id']."' selected>".$yrow['fiscal_name']."</option>
									";
								}else{
									echo "
									<option value='".$yrow['fiscal_id']."'>".$yrow['fiscal_name']."</option>
									";	
								}
							}
							?>
						</select>
						</div>
					</div>
                    <div class="form-group">
                        <label for="sem_id" class="col-sm-3 control-label">ภาคการศึกษา <span style="color:red;">*</span></label>
                        <div class="col-sm-9">                      
                        <?php						  
                        $sql = "select sem_id, sem_name from ta_sem order by sem_id;";
                        // $query = mysqli_query($conn,$sql);
                        $query = $conn->query($sql);
                        ?>
                            <select class="form-control" id="sem_id" name="sem_id" required>
                            <option value="">Not Selected</option>
                            <?php
                            // while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            while($row = $query->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row["sem_id"];?>">
                                <?php echo $row["sem_name"];?>
                                </option>
                            <?php
                            }
                            // mysqli_free_result($query);
                            $query->free_result();
                            ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
						<label for="dept_id" class="col-sm-3 control-label">หน่วยงาน</label>
						<div class="col-sm-9">
						<select class="form-control" name="dept_id" id="dept_id" required>							
							<?php
							if($_SESSION["deptid"]=='99'){
								echo "
								<option value='' selected>- Select -</option>
								";
								$sql = "SELECT * FROM ta_dept ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."'>".$drow['dept_name']."</option>
									";
									// $dept_head = "";
									// $dept_position = "";
									// $dept_part = "";
									// $dept_bookno = "";
								}
							}else{
								echo "
								<option value=''>- Select -</option>
								";
								$sql = "SELECT * FROM ta_dept WHERE dept_id = '".$_SESSION["deptid"]."' ORDER BY CONVERT (dept_name USING tis620)";
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['dept_id']."' selected>".$drow['dept_name']."</option>
									";
									// $dept_head = $drow['dept_head'];
									// $dept_position = $drow['dept_position'];
									// $dept_part = $drow['dept_part'];
									// $dept_bookno = $drow['dept_bookno'];
								}
							}							
							?>
						</select>
						</div>
					</div> -->

                    <div class="form-group">
						<label for="app_name" class="col-sm-3 control-label">ครั้งที่</label>

						<div class="col-sm-9">
                            <select class="form-control" name="app_times" id="app_times" required>
                                <option value="" selected>- Select -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>                                
                            </select>
						</div>
					</div>														
					<div class="form-group">
						<label for="datepicker_add" class="col-sm-3 control-label">วันที่เริ่มต้น</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" required> -->
                            <input type="text" class="form-control" id="datepicker_add" name="datepicker_add" value="<?php echo date("Y-m-d");?>" required>
						</div>
						</div>
					</div>

                    <div class="form-group">
						<label for="datepicker_add2" class="col-sm-3 control-label">วันที่สิ้นสุด</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add2" name="datepicker_approval_add2" value="<?php // echo date("Y-m-d");?>" required> -->
                            <input type="text" class="form-control" id="datepicker_add2" name="datepicker_add2" value="<?php echo date("Y-m-d");?>" required>
						</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="start_month" class="col-sm-3 control-label">เดือนที่เริ่มต้น</label>
						<div class="col-sm-9">
						<select class="form-control" name="start_month" id="start_month" required>
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
						<label for="start_month" class="col-sm-3 control-label">เดือนที่สิ้นสุด</label>
						<div class="col-sm-9">
						<select class="form-control" name="end_month" id="end_month" required>
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
    <!-- <div class="modal-dialog modal-lg"> -->
	<div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="dept_name"></span></b></h4>
				<!-- <h4 class="modal-title"><b>Edit Propose Form</b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="propose_form_edit.php">
            		<input type="hidden" id="app_id" name="app_id">
					<div class="form-group">
                        <label for="fiscal_id" class="col-sm-3 control-label">ปีการศึกษา <span style="color:red;">*</span></label>
						<div class="col-sm-9">
						<select class="form-control" name="edit_fiscal_id" id="edit_fiscal_id" required>
							<option value="" selected>- Select -</option>
							<?php
							$sql = "select fiscal_id, fiscal_name from fiscal order by fiscal_name DESC;";
							$query = $conn->query($sql);
							$curYear = date('Y')+543;							
							while($yrow = $query->fetch_assoc()){
								if($yrow["year_name"]==$curYear){
									echo "
									<option value='".$yrow['fiscal_id']."' selected>".$yrow['fiscal_name']."</option>
									";
								}else{
									echo "
									<option value='".$yrow['fiscal_id']."'>".$yrow['fiscal_name']."</option>
									";	
								}
							}
							?>
						</select>
						</div>
					</div>
                    <div class="form-group">
                        <label for="sem_id" class="col-sm-3 control-label">ภาคการศึกษา <span style="color:red;">*</span></label>
                        <div class="col-sm-9">                      
                        <?php						  
                        $sql = "select sem_id, sem_name from ta_sem order by sem_id;";
                        // $query = mysqli_query($conn,$sql);
                        $query = $conn->query($sql);
                        ?>
                            <select class="form-control" id="edit_sem_id" name="edit_sem_id" required>
                            <option value="">Not Selected</option>
                            <?php
                            // while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            while($row = $query->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row["sem_id"];?>">
                                <?php echo $row["sem_name"];?>
                                </option>
                            <?php
                            }
                            // mysqli_free_result($query);
                            $query->free_result();
                            ?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="app_name" class="col-sm-3 control-label">ครั้งที่</label>

						<div class="col-sm-9">
                            <select class="form-control" name="edit_app_times" id="edit_app_times" required>
                                <option value="" selected>- Select -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>                                
                            </select>
						</div>
					</div>														
					<div class="form-group">
						<label for="datepicker_add" class="col-sm-3 control-label">วันที่เริ่มต้น</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" required> -->
                            <input type="text" class="form-control" id="datepicker_edit" name="datepicker_edit" required>
						</div>
						</div>
					</div>

                    <div class="form-group">
						<label for="datepicker_add2" class="col-sm-3 control-label">วันที่สิ้นสุด</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add2" name="datepicker_approval_add2" value="<?php // echo date("Y-m-d");?>" required> -->
                            <input type="text" class="form-control" id="datepicker_edit2" name="datepicker_edit2" required>
						</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="start_month" class="col-sm-3 control-label">เดือนที่เริ่มต้น</label>
						<div class="col-sm-9">
						<select class="form-control" name="edit_start_month" id="edit_start_month" required>
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
						<label for="start_month" class="col-sm-3 control-label">เดือนที่สิ้นสุด</label>
						<div class="col-sm-9">
						<select class="form-control" name="edit_end_month" id="edit_end_month" required>
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
				<!-- <div class="form-group">
					<label for="year_id" class="col-sm-3 control-label">ปี</label>
					<div class="col-sm-9">
					<select class="form-control" name="edit_year_id" id="edit_year_id" required>
						<option value="" selected>- Select -</option>
						<?php
						// $sql = "SELECT * FROM years";
						// $query = $conn->query($sql);
						// while($yrow = $query->fetch_assoc()){
						// 	echo "
						// 	<option value='".$yrow['year_id']."'>".$yrow['year_name']."</option>
						// 	";
						// }
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
							// if($_SESSION["deptid"]=='99'){
							// 	echo "
							// 	<option value='' selected>- Select -</option>
							// 	";
							// 	$sql = "SELECT * FROM department ORDER BY CONVERT (dept_name USING tis620)";
							// 	$query = $conn->query($sql);
							// 	while($drow = $query->fetch_assoc()){
							// 		echo "
							// 		<option value='".$drow['dept_id']."'>".$drow['dept_name']."</option>
							// 		";
							// 		$dept_head2 = "";
							// 		$dept_position2 = "";
							// 		$dept_part2 = "";
							// 		$dept_bookno2 = "";
							// 	}
							// }else{
							// 	echo "
							// 	<option value=''>- Select -</option>
							// 	";
							// 	$sql = "SELECT * FROM department WHERE dept_id = '".$_SESSION["deptid"]."' ORDER BY CONVERT (dept_name USING tis620)";
							// 	$query = $conn->query($sql);
							// 	while($drow = $query->fetch_assoc()){
							// 		echo "
							// 		<option value='".$drow['dept_id']."' selected>".$drow['dept_name']."</option>
							// 		";
							// 		$dept_head2 = $drow['dept_head'];
							// 		$dept_position2 = $drow['dept_position'];
							// 		$dept_part2 = $drow['dept_part'];
							// 		$dept_bookno2 = $drow['dept_bookno'];
							// 	}
							// }							
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
						// $sql = "SELECT * FROM app_type ORDER BY CONVERT (app_type_name USING tis620)";
						// $query = $conn->query($sql);
						// while($atrow = $query->fetch_assoc()){
						// 	echo "
						// 	<option value='".$atrow['app_type_id']."'>".$atrow['app_type_name']."</option>
						// 	";
						// }
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
						<input type="text" class="form-control" id="edit_app_doc_no" name="edit_app_doc_no" value="<?php // echo $dept_bookno2;?>" required>
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
				</div>		 -->


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
    <!-- <div class="modal-dialog modal-lg"> -->
	<div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="del_dept_name"></span></b></h4>
				<!-- <h4 class="modal-title"><b>Delete Propose Form</b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_form_delete.php">
            		<input type="hidden" id="del_app_id" name="del_app_id">
					<div class="form-group">
                        <label for="fiscal_id" class="col-sm-3 control-label">ปีการศึกษา <span style="color:red;">*</span></label>
						<div class="col-sm-9">
						<select class="form-control" name="del_fiscal_id" id="del_fiscal_id" required disabled>
							<option value="" selected>- Select -</option>
							<?php
							$sql = "select fiscal_id, fiscal_name from fiscal order by fiscal_name DESC;";
							$query = $conn->query($sql);
							$curYear = date('Y')+543;							
							while($yrow = $query->fetch_assoc()){
								if($yrow["year_name"]==$curYear){
									echo "
									<option value='".$yrow['fiscal_id']."' selected>".$yrow['fiscal_name']."</option>
									";
								}else{
									echo "
									<option value='".$yrow['fiscal_id']."'>".$yrow['fiscal_name']."</option>
									";	
								}
							}
							?>
						</select>
						</div>
					</div>
                    <div class="form-group">
                        <label for="sem_id" class="col-sm-3 control-label">ภาคการศึกษา <span style="color:red;">*</span></label>
                        <div class="col-sm-9">                      
                        <?php						  
                        $sql = "select sem_id, sem_name from ta_sem order by sem_id;";
                        // $query = mysqli_query($conn,$sql);
                        $query = $conn->query($sql);
                        ?>
                            <select class="form-control" id="del_sem_id" name="del_sem_id" required disabled>
                            <option value="">Not Selected</option>
                            <?php
                            // while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            while($row = $query->fetch_assoc()){
                            ?>
                                <option value="<?php echo $row["sem_id"];?>">
                                <?php echo $row["sem_name"];?>
                                </option>
                            <?php
                            }
                            // mysqli_free_result($query);
                            $query->free_result();
                            ?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
						<label for="app_name" class="col-sm-3 control-label">ครั้งที่</label>

						<div class="col-sm-9">
                            <select class="form-control" name="del_app_times" id="del_app_times" required disabled>
                                <option value="" selected>- Select -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>                                
                            </select>
						</div>
					</div>														
					<div class="form-group">
						<label for="datepicker_add" class="col-sm-3 control-label">วันที่เริ่มต้น</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" required> -->
                            <input type="text" class="form-control" id="datepicker_del" name="datepicker_del" required disabled>
						</div>
						</div>
					</div>

                    <div class="form-group">
						<label for="datepicker_add2" class="col-sm-3 control-label">วันที่สิ้นสุด</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add2" name="datepicker_approval_add2" value="<?php // echo date("Y-m-d");?>" required> -->
                            <input type="text" class="form-control" id="datepicker_del2" name="datepicker_del2" required disabled>
						</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="start_month" class="col-sm-3 control-label">เดือนที่เริ่มต้น</label>
						<div class="col-sm-9">
						<select class="form-control" name="del_start_month" id="del_start_month" required disabled>
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
						<label for="start_month" class="col-sm-3 control-label">เดือนที่สิ้นสุด</label>
						<div class="col-sm-9">
						<select class="form-control" name="del_end_month" id="del_end_month" required disabled>
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
            		<!-- <div class="form-group">
					<label for="year_id" class="col-sm-3 control-label">ปี</label>
					<div class="col-sm-9">
					<select class="form-control" name="del_year_id" id="del_year_id" required readonly>
						<option value="" selected>- Select -</option>
						<?php
						// $sql = "SELECT * FROM years";
						// $query = $conn->query($sql);
						// while($yrow = $query->fetch_assoc()){
						// 	echo "
						// 	<option value='".$yrow['year_id']."'>".$yrow['year_name']."</option>
						// 	";
						// }
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
							// if($_SESSION["deptid"]=='99'){
							// 	echo "
							// 	<option value='' selected>- Select -</option>
							// 	";
							// 	$sql = "SELECT * FROM department ORDER BY CONVERT (dept_name USING tis620)";
							// 	$query = $conn->query($sql);
							// 	while($drow = $query->fetch_assoc()){
							// 		echo "
							// 		<option value='".$drow['dept_id']."'>".$drow['dept_name']."</option>
							// 		";
							// 	}
							// }else{
							// 	echo "
							// 	<option value=''>- Select -</option>
							// 	";
							// 	$sql = "SELECT * FROM department WHERE dept_id = '".$_SESSION["deptid"]."' ORDER BY CONVERT (dept_name USING tis620)";
							// 	$query = $conn->query($sql);
							// 	while($drow = $query->fetch_assoc()){
							// 		echo "
							// 		<option value='".$drow['dept_id']."' selected>".$drow['dept_name']."</option>
							// 		";
							// 	}
							// }							
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
						// $sql = "SELECT * FROM app_type ORDER BY CONVERT (app_type_name USING tis620)";
						// $query = $conn->query($sql);
						// while($atrow = $query->fetch_assoc()){
						// 	echo "
						// 	<option value='".$atrow['app_type_id']."'>".$atrow['app_type_name']."</option>
						// 	";
						// }
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
				</div>		 -->

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     