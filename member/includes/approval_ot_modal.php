<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog" style="width:1024px;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Time Table</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_ot_add.php">
					<input type="hidden" id="appeid" name="appeid" value="<?php echo $app_emp_id;?>">
					<input type="hidden" id="appid" name="appid" value="<?php echo $app_id;?>">
					<input type="hidden" id="empid2" name="empid2" value="<?php echo $emp_id;?>">
					<div class="form-group">
						<label for="employee" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
						<div class="col-sm-9">
							<select class="form-control" name="empid" id="empid" required disabled>
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
									if($yrow['empid'] == $emp_id){
										echo "
										<option value='".$yrow['empid']."' selected>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
										";
									}else{
										echo "
										<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
										";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="datepicker_add" class="col-sm-3 control-label">วันที่</label>

						<div class="col-sm-9"> 
						<div class="date">
							<input type="text" class="form-control" id="datepicker_add" name="datepicker_add" required>
						</div>
						</div>
					</div>
					<div class="form-group">
						<label for="time_in" class="col-sm-3 control-label">เวลาเริ่มต้น</label>

						<div class="col-sm-9">
							<!-- <div class="bootstrap-timepicker">
								<input type="text" class="form-control timepicker" id="time_in" name="time_in">
							</div> -->
							<?php
							$deptid = $_SESSION['deptid'];
							// echo $deptid;
							switch($deptid){								
								case 2:     
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>										
										<option value='06:30:00'>6:30</option>
										<option value='07:00:00'>7:00</option>
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";									
									break;
								case 7:			
										echo "
										<select class='form-control' name='time_in' id='time_in' required>
											<option value='' selected>- Select -</option>										
											<option value='00:00:00'>0:00</option>
											<option value='00:30:00'>0:30</option>
											<option value='01:00:00'>1:00</option>
											<option value='01:30:00'>1:30</option>
											<option value='02:00:00'>2:00</option>
											<option value='02:30:00'>2:30</option>
											<option value='03:00:00'>3:00</option>
											<option value='03:30:00'>3:30</option>
											<option value='04:00:00'>4:00</option>
											<option value='04:30:00'>4:30</option>
											<option value='05:00:00'>5:00</option>
											<option value='05:30:00'>5:30</option>
											<option value='06:00:00'>6:00</option>
											<option value='06:30:00'>6:30</option>
											<option value='07:00:00'>7:00</option>
											<option value='07:30:00'>7:30</option>
											<option value='08:00:00'>8:00</option>
											<option value='08:30:00'>8:30</option>
											<option value='09:00:00'>9:00</option>
											<option value='09:30:00'>9:30</option>
											<option value='10:00:00'>10:00</option>
											<option value='10:30:00'>10:30</option>
											<option value='11:00:00'>11:00</option>
											<option value='11:30:00'>11:30</option>
											<option value='12:00:00'>12:00</option>
											<option value='12:30:00'>12:30</option>
											<option value='13:00:00'>13:00</option>
											<option value='13:30:00'>13:30</option>
											<option value='14:00:00'>14:00</option>
											<option value='14:30:00'>14:30</option>
											<option value='15:00:00'>15:00</option>
											<option value='15:30:00'>15:30</option>
											<option value='16:00:00'>16:00</option>
											<option value='16:30:00'>16:30</option>
											<option value='17:00:00'>17:00</option>
											<option value='17:30:00'>17:30</option>
											<option value='18:00:00'>18:00</option>
											<option value='18:30:00'>18:30</option>
											<option value='19:00:00'>19:00</option>
											<option value='19:30:00'>19:30</option>
											<option value='20:00:00'>20:00</option>
											<option value='20:30:00'>20:30</option>
											<option value='21:00:00'>21:00</option>
											<option value='21:30:00'>21:30</option>
											<option value='22:00:00'>22:00</option>
											<option value='22:30:00'>22:30</option>
											<option value='23:00:00'>23:00</option>
											<option value='23:30:00'>23:30</option>
										</select>
										";
										break;	 
								case 8:     
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																			
										<option value='07:00:00'>7:00</option>
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
									</select>
									";									
									break;          
								case 3:
								case 4:
								case 5:
								case 6:							
								case 13:								
								case 17:
								case 20:
								case 23:
								case 27:					
								case 28:
								case 30:
								case 32:
								case 35:			
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>										
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 15:			
										echo "
										<select class='form-control' name='time_in' id='time_in' required>
											<option value='' selected>- Select -</option>										
											<option value='07:30:00'>7:30</option>
											<option value='08:00:00'>8:00</option>
											<option value='08:30:00'>8:30</option>
											<option value='09:00:00'>9:00</option>
											<option value='09:30:00'>9:30</option>
											<option value='10:00:00'>10:00</option>
											<option value='10:30:00'>10:30</option>
											<option value='11:00:00'>11:00</option>
											<option value='11:30:00'>11:30</option>
											<option value='12:00:00'>12:00</option>
											<option value='12:30:00'>12:30</option>
											<option value='13:00:00'>13:00</option>
											<option value='13:30:00'>13:30</option>
											<option value='14:00:00'>14:00</option>
											<option value='14:30:00'>14:30</option>
											<option value='15:00:00'>15:00</option>
											<option value='15:30:00'>15:30</option>
											<option value='16:00:00'>16:00</option>
											<option value='16:30:00'>16:30</option>
										</select>
										";
										break;	
								case 9:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 14:
								case 21:
								case 22:
								case 37:
								case 38:
								case 40:
								case 58:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 16:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='08:30:00'>8:30</option>										
									</select>
									";
									break;
								case 24:								
									// echo "
									// <select class='form-control' name='time_in' id='time_in' required>
									// 	<option value='' selected>- Select -</option>										
									// 	<option value='05:30:00'>5:30</option>
									// 	<option value='06:00:00'>6:00</option>
									// 	<option value='06:30:00'>6:30</option>
									// 	<option value='07:00:00'>7:00</option>
									// 	<option value='07:30:00'>7:30</option>
									// 	<option value='08:00:00'>8:00</option>
									// 	<option value='08:30:00'>8:30</option>
									// 	<option value='09:00:00'>9:00</option>
									// 	<option value='09:30:00'>9:30</option>
									// 	<option value='10:00:00'>10:00</option>
									// 	<option value='10:30:00'>10:30</option>
									// 	<option value='11:00:00'>11:00</option>
									// 	<option value='11:30:00'>11:30</option>
									// 	<option value='12:00:00'>12:00</option>
									// 	<option value='12:30:00'>12:30</option>
									// 	<option value='13:00:00'>13:00</option>
									// 	<option value='13:30:00'>13:30</option>
									// 	<option value='14:00:00'>14:00</option>
									// 	<option value='14:30:00'>14:30</option>
									// 	<option value='15:00:00'>15:00</option>
									// 	<option value='15:30:00'>15:30</option>
									// 	<option value='16:00:00'>16:00</option>
									// 	<option value='16:30:00'>16:30</option>
									// </select>
									// ";
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;											
								case 25:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>										
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 26:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>										
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 29:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>										
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 31:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
									</select>
									";
									break;	
								case 33:								
									// echo "
									// <select class='form-control' name='time_in' id='time_in' required>
									// 	<option value='' selected>- Select -</option>																				
									// 	<option value='08:00:00'>8:00</option>
									// 	<option value='08:30:00'>8:30</option>
									// 	<option value='09:00:00'>9:00</option>
									// 	<option value='09:30:00'>9:30</option>
									// 	<option value='10:00:00'>10:00</option>
									// 	<option value='10:30:00'>10:30</option>
									// 	<option value='11:00:00'>11:00</option>
									// 	<option value='11:30:00'>11:30</option>
									// 	<option value='12:00:00'>12:00</option>
									// 	<option value='12:30:00'>12:30</option>
									// 	<option value='13:00:00'>13:00</option>
									// 	<option value='13:30:00'>13:30</option>
									// 	<option value='14:00:00'>14:00</option>
									// 	<option value='14:30:00'>14:30</option>
									// 	<option value='15:00:00'>15:00</option>
									// 	<option value='15:30:00'>15:30</option>
									// 	<option value='16:00:00'>16:00</option>
									// 	<option value='16:30:00'>16:30</option>
									// 	<option value='17:00:00'>17:00</option>
									// </select>
									// ";
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
									</select>
									";
									break;
								case 34:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 36:								
									// echo "
									// <select class='form-control' name='time_in' id='time_in' required>
									// 	<option value='' selected>- Select -</option>																				
									// 	<option value='08:00:00'>8:00</option>
									// 	<option value='08:30:00'>8:30</option>
									// 	<option value='09:00:00'>9:00</option>
									// 	<option value='09:30:00'>9:30</option>
									// 	<option value='10:00:00'>10:00</option>
									// 	<option value='10:30:00'>10:30</option>
									// 	<option value='11:00:00'>11:00</option>
									// 	<option value='11:30:00'>11:30</option>
									// 	<option value='12:00:00'>12:00</option>
									// 	<option value='12:30:00'>12:30</option>
									// 	<option value='13:00:00'>13:00</option>
									// 	<option value='13:30:00'>13:30</option>
									// 	<option value='14:00:00'>14:00</option>
									// 	<option value='14:30:00'>14:30</option>
									// 	<option value='15:00:00'>15:00</option>
									// 	<option value='15:30:00'>15:30</option>
									// 	<option value='16:00:00'>16:00</option>
									// 	<option value='16:30:00'>16:30</option>
									// </select>
									// ";
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
									</select>
									";
									break;
								case 39:								
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
									</select>
									";
									break;
								case 60:								
									// echo "
									// <select class='form-control' name='time_in' id='time_in' required>
									// 	<option value='' selected>- Select -</option>																				
									// 	<option value='08:00:00'>8:00</option>
									// 	<option value='08:30:00'>8:30</option>
									// 	<option value='09:00:00'>9:00</option>
									// 	<option value='09:30:00'>9:30</option>
									// 	<option value='10:00:00'>10:00</option>
									// 	<option value='10:30:00'>10:30</option>
									// 	<option value='11:00:00'>11:00</option>
									// 	<option value='11:30:00'>11:30</option>
									// 	<option value='12:00:00'>12:00</option>
									// 	<option value='12:30:00'>12:30</option>
									// 	<option value='13:00:00'>13:00</option>
									// 	<option value='13:30:00'>13:30</option>
									// 	<option value='14:00:00'>14:00</option>
									// 	<option value='14:30:00'>14:30</option>
									// 	<option value='15:00:00'>15:00</option>
									// 	<option value='15:30:00'>15:30</option>
									// 	<option value='16:00:00'>16:00</option>
									// 	<option value='16:30:00'>16:30</option>
									// 	<option value='17:00:00'>17:00</option>
									// 	<option value='17:30:00'>17:30</option>
									// 	<option value='18:00:00'>18:00</option>
									// 	<option value='18:30:00'>18:30</option>
									// 	<option value='19:00:00'>19:00</option>
									// 	<option value='19:30:00'>19:30</option>
									// </select>
									// ";
									echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																				
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
									</select>
									";
									break;
								case 61:     
										echo "
									<select class='form-control' name='time_in' id='time_in' required>
										<option value='' selected>- Select -</option>																			
										<option value='07:00:00'>7:00</option>
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
									</select>
									";									
									break;
							}		
							?>
							<!-- <select class="form-control" name="time_in" id="time_in" required>
								<option value="" selected>- Select -</option>
								<option value="00:00:00">0:00</option>
								<option value="00:30:00">0:30</option>
								<option value="01:00:00">1:00</option>
								<option value="01:30:00">1:30</option>
								<option value="02:00:00">2:00</option>
								<option value="02:30:00">2:30</option>
								<option value="03:00:00">3:00</option>
								<option value="03:30:00">3:30</option>
								<option value="04:00:00">4:00</option>
								<option value="04:30:00">4:30</option>
								<option value="05:00:00">5:00</option>
								<option value="05:30:00">5:30</option>
								<option value="06:00:00">6:00</option>
								<option value="06:30:00">6:30</option>
								<option value="07:00:00">7:00</option>
								<option value="07:30:00">7:30</option>
								<option value="08:00:00">8:00</option>
								<option value="08:30:00">8:30</option>
								<option value="09:00:00">9:00</option>
								<option value="09:30:00">9:30</option>
								<option value="10:00:00">10:00</option>
								<option value="10:30:00">10:30</option>
								<option value="11:00:00">11:00</option>
								<option value="11:30:00">11:30</option>
								<option value="12:00:00">12:00</option>
								<option value="12:30:00">12:30</option>
								<option value="13:00:00">13:00</option>
								<option value="13:30:00">13:30</option>
								<option value="14:00:00">14:00</option>
								<option value="14:30:00">14:30</option>
								<option value="15:00:00">15:00</option>
								<option value="15:30:00">15:30</option>
								<option value="16:00:00">16:00</option>
								<option value="16:30:00">16:30</option>
								<option value="17:00:00">17:00</option>
								<option value="17:30:00">17:30</option>
								<option value="18:00:00">18:00</option>
								<option value="18:30:00">18:30</option>
								<option value="19:00:00">19:00</option>
								<option value="19:30:00">19:30</option>
								<option value="20:00:00">20:00</option>
								<option value="20:30:00">20:30</option>
								<option value="21:00:00">21:00</option>
								<option value="21:30:00">21:30</option>
								<option value="22:00:00">22:00</option>
								<option value="22:30:00">22:30</option>
								<option value="23:00:00">23:00</option>
								<option value="23:30:00">23:30</option>
							</select>	 -->
						</div>
					</div>
					<div class="form-group">
						<label for="time_out" class="col-sm-3 control-label">เวลาสิ้นสุด</label>

						<div class="col-sm-9">
							<!-- <div class="bootstrap-timepicker">
								<input type="text" class="form-control timepicker" id="time_out" name="time_out">
							</div> -->
							<?php
							switch($deptid){								
								case 2:     
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																														
										<option value='07:00:00'>7:00</option>
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
										<option value='20:30:00'>20:30</option>
									</select>
									";									
									break;  
								case 7:			
										echo "
										<select class='form-control' name='time_out' id='time_out' required>
											<option value='' selected>- Select -</option>																					
											<option value='00:30:00'>0:30</option>
											<option value='01:00:00'>1:00</option>
											<option value='01:30:00'>1:30</option>
											<option value='02:00:00'>2:00</option>
											<option value='02:30:00'>2:30</option>
											<option value='03:00:00'>3:00</option>
											<option value='03:30:00'>3:30</option>
											<option value='04:00:00'>4:00</option>
											<option value='04:30:00'>4:30</option>
											<option value='05:00:00'>5:00</option>
											<option value='05:30:00'>5:30</option>
											<option value='06:00:00'>6:00</option>
											<option value='06:30:00'>6:30</option>
											<option value='07:00:00'>7:00</option>
											<option value='07:30:00'>7:30</option>
											<option value='08:00:00'>8:00</option>
											<option value='08:30:00'>8:30</option>
											<option value='09:00:00'>9:00</option>
											<option value='09:30:00'>9:30</option>
											<option value='10:00:00'>10:00</option>
											<option value='10:30:00'>10:30</option>
											<option value='11:00:00'>11:00</option>
											<option value='11:30:00'>11:30</option>
											<option value='12:00:00'>12:00</option>
											<option value='12:30:00'>12:30</option>
											<option value='13:00:00'>13:00</option>
											<option value='13:30:00'>13:30</option>
											<option value='14:00:00'>14:00</option>
											<option value='14:30:00'>14:30</option>
											<option value='15:00:00'>15:00</option>
											<option value='15:30:00'>15:30</option>
											<option value='16:00:00'>16:00</option>
											<option value='16:30:00'>16:30</option>
											<option value='17:00:00'>17:00</option>
											<option value='17:30:00'>17:30</option>
											<option value='18:00:00'>18:00</option>
											<option value='18:30:00'>18:30</option>
											<option value='19:00:00'>19:00</option>
											<option value='19:30:00'>19:30</option>
											<option value='20:00:00'>20:00</option>
											<option value='20:30:00'>20:30</option>
											<option value='21:00:00'>21:00</option>
											<option value='21:30:00'>21:30</option>
											<option value='22:00:00'>22:00</option>
											<option value='22:30:00'>22:30</option>
											<option value='23:00:00'>23:00</option>
											<option value='23:30:00'>23:30</option>
										</select>
										";
										break;  
								case 8:     
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																														
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
									</select>
									";									
									break;
								case 3:
								case 4:
								case 5:
								case 6:								
								case 13:								
								case 17:
								case 20:
								case 23:
								case 27:					
								case 28:
								case 30:
								case 32:
								case 35:			
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>										
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
										<option value='20:30:00'>20:30</option>
									</select>
									";
									break;
								case 15:			
										echo "
										<select class='form-control' name='time_out' id='time_out' required>
											<option value='' selected>- Select -</option>										
											<option value='08:00:00'>8:00</option>
											<option value='08:30:00'>8:30</option>
											<option value='09:00:00'>9:00</option>
											<option value='09:30:00'>9:30</option>
											<option value='10:00:00'>10:00</option>
											<option value='10:30:00'>10:30</option>
											<option value='11:00:00'>11:00</option>
											<option value='11:30:00'>11:30</option>
											<option value='12:00:00'>12:00</option>
											<option value='12:30:00'>12:30</option>
											<option value='13:00:00'>13:00</option>
											<option value='13:30:00'>13:30</option>
											<option value='14:00:00'>14:00</option>
											<option value='14:30:00'>14:30</option>
											<option value='15:00:00'>15:00</option>
											<option value='15:30:00'>15:30</option>
											<option value='16:00:00'>16:00</option>
											<option value='16:30:00'>16:30</option>
											<option value='17:00:00'>17:00</option>
											<option value='17:30:00'>17:30</option>
											<option value='18:00:00'>18:00</option>
											<option value='18:30:00'>18:30</option>
											<option value='19:00:00'>19:00</option>
											<option value='19:30:00'>19:30</option>
											<option value='20:00:00'>20:00</option>
											<option value='20:30:00'>20:30</option>
										</select>
										";
										break;
								case 9:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																														
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
									</select>
									";
									break;
								case 14:
								case 21:
								case 22:
								case 37:
								case 38:
								case 40:
								case 58:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
									</select>
									";
									break;
								case 16:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>							
									</select>
									";
									break;
								case 24:								
									// echo "
									// <select class='form-control' name='time_out' id='time_out' required>
									// 	<option value='' selected>- Select -</option>																				
									// 	<option value='06:00:00'>6:00</option>
									// 	<option value='06:30:00'>6:30</option>
									// 	<option value='07:00:00'>7:00</option>
									// 	<option value='07:30:00'>7:30</option>
									// 	<option value='08:00:00'>8:00</option>
									// 	<option value='08:30:00'>8:30</option>
									// 	<option value='09:00:00'>9:00</option>
									// 	<option value='09:30:00'>9:30</option>
									// 	<option value='10:00:00'>10:00</option>
									// 	<option value='10:30:00'>10:30</option>
									// 	<option value='11:00:00'>11:00</option>
									// 	<option value='11:30:00'>11:30</option>
									// 	<option value='12:00:00'>12:00</option>
									// 	<option value='12:30:00'>12:30</option>
									// 	<option value='13:00:00'>13:00</option>
									// 	<option value='13:30:00'>13:30</option>
									// 	<option value='14:00:00'>14:00</option>
									// 	<option value='14:30:00'>14:30</option>
									// 	<option value='15:00:00'>15:00</option>
									// 	<option value='15:30:00'>15:30</option>
									// 	<option value='16:00:00'>16:00</option>
									// 	<option value='16:30:00'>16:30</option>
									// 	<option value='17:00:00'>17:00</option>
									// 	<option value='17:30:00'>17:30</option>
									// 	<option value='18:00:00'>18:00</option>
									// 	<option value='18:30:00'>18:30</option>
									// 	<option value='19:00:00'>19:00</option>
									// 	<option value='19:30:00'>19:30</option>
									// </select>
									// ";
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>										
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
									</select>
									";
									break;											
								case 25:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
										<option value='20:30:00'>20:30</option>
									</select>
									";
									break;
								case 26:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>										
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
										<option value='20:30:00'>20:30</option>
										<option value='21:00:00'>21:00</option>
										<option value='21:30:00'>21:30</option>
									</select>
									";
									break;
								case 29:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
										<option value='20:30:00'>20:30</option>
										<option value='21:00:00'>21:00</option>
										<option value='21:30:00'>21:30</option>
									</select>
									";
									break;
								case 31:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
									</select>
									";
									break;	
								case 33:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
									</select>
									";
									break;
								case 34:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																														
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
									</select>
									";
									break;
								case 36:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																														
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
										<option value='20:30:00'>20:30</option>
									</select>
									";
									break;
								case 39:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
									</select>
									";
									break;
								case 60:								
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																				
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
									</select>
									";
									break;
								case 61:     
									echo "
									<select class='form-control' name='time_out' id='time_out' required>
										<option value='' selected>- Select -</option>																														
										<option value='07:30:00'>7:30</option>
										<option value='08:00:00'>8:00</option>
										<option value='08:30:00'>8:30</option>
										<option value='09:00:00'>9:00</option>
										<option value='09:30:00'>9:30</option>
										<option value='10:00:00'>10:00</option>
										<option value='10:30:00'>10:30</option>
										<option value='11:00:00'>11:00</option>
										<option value='11:30:00'>11:30</option>
										<option value='12:00:00'>12:00</option>
										<option value='12:30:00'>12:30</option>
										<option value='13:00:00'>13:00</option>
										<option value='13:30:00'>13:30</option>
										<option value='14:00:00'>14:00</option>
										<option value='14:30:00'>14:30</option>
										<option value='15:00:00'>15:00</option>
										<option value='15:30:00'>15:30</option>
										<option value='16:00:00'>16:00</option>
										<option value='16:30:00'>16:30</option>
										<option value='17:00:00'>17:00</option>
										<option value='17:30:00'>17:30</option>
										<option value='18:00:00'>18:00</option>
										<option value='18:30:00'>18:30</option>
										<option value='19:00:00'>19:00</option>
										<option value='19:30:00'>19:30</option>
										<option value='20:00:00'>20:00</option>
									</select>
									";									
									break;
							}
							?>
							<!-- <select class="form-control" name="time_out" id="time_out" required>								
								<option value="" selected>- Select -</option>
								<option value="00:00:00">0:00</option>
								<option value="00:30:00">0:30</option>
								<option value="01:00:00">1:00</option>
								<option value="01:30:00">1:30</option>
								<option value="02:00:00">2:00</option>
								<option value="02:30:00">2:30</option>
								<option value="03:00:00">3:00</option>
								<option value="03:30:00">3:30</option>
								<option value="04:00:00">4:00</option>
								<option value="04:30:00">4:30</option>
								<option value="05:00:00">5:00</option>
								<option value="05:30:00">5:30</option>
								<option value="06:00:00">6:00</option>
								<option value="06:30:00">6:30</option>
								<option value="07:00:00">7:00</option>
								<option value="07:30:00">7:30</option>
								<option value="08:00:00">8:00</option>
								<option value="08:30:00">8:30</option>
								<option value="09:00:00">9:00</option>
								<option value="09:30:00">9:30</option>
								<option value="10:00:00">10:00</option>
								<option value="10:30:00">10:30</option>
								<option value="11:00:00">11:00</option>
								<option value="11:30:00">11:30</option>
								<option value="12:00:00">12:00</option>
								<option value="12:30:00">12:30</option>
								<option value="13:00:00">13:00</option>
								<option value="13:30:00">13:30</option>
								<option value="14:00:00">14:00</option>
								<option value="14:30:00">14:30</option>
								<option value="15:00:00">15:00</option>
								<option value="15:30:00">15:30</option>
								<option value="16:00:00">16:00</option>
								<option value="16:30:00">16:30</option>
								<option value="17:00:00">17:00</option>
								<option value="17:30:00">17:30</option>
								<option value="18:00:00">18:00</option>
								<option value="18:30:00">18:30</option>
								<option value="19:00:00">19:00</option>
								<option value="19:30:00">19:30</option>
								<option value="20:00:00">20:00</option>
								<option value="20:30:00">20:30</option>
								<option value="21:00:00">21:00</option>
								<option value="21:30:00">21:30</option>
								<option value="22:00:00">22:00</option>
								<option value="22:30:00">22:30</option>
								<option value="23:00:00">23:00</option>
								<option value="23:30:00">23:30</option>
							</select> -->
						</div>
                </div>
				<div class="form-group">
					<label for="reponsibility" class="col-sm-3 control-label">งานที่ปฏิบัติ</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="reponsibility" name="reponsibility" required>
					</div>
				</div>
				<div class="form-group">
					<label for="otrate_id" class="col-sm-3 control-label">อัตราค่าล่วงเวลา</label>						
					<div class="col-sm-9">							
						<select class="form-control" name="otrate_id" id="otrate_id" required>
							<option value="" selected>- Select -</option>
							<?php
								if($_SESSION['deptid']==99){
									$sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name												
											FROM otrate_group
											LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
											LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
											WHERE otrate.is_active = 1 
											ORDER BY CONVERT(otrate.otrate_name USING tis620)
											;";
								}else{
									// $sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name		
									// 		FROM otrate_group
									// 		LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
									// 		LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
									// 		WHERE otrate_group.dept_id = '".$_SESSION['deptid']."'
									// 		ORDER BY CONVERT(otrate.otrate_name USING tis620)
									// 		;";	
									$sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name		
											FROM otrate_group
											LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
											LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
											WHERE otrate_group.dept_id = '".$_SESSION['deptid']."' 
											AND otrate.is_active = 1
											ORDER BY CONVERT(otrate.otrate_name USING tis620)
											;";
								}
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['otrateid']."'>".$drow['otrate_name']."</option>
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
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog" style="width:1024px;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="employee_name"></span></b></h4> -->
				<h4 class="modal-title"><b>Edit Time Table</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_ot_edit.php">
            		<input type="hidden" id="appeotid" name="appeotid">
					<input type="hidden" id="appeid" name="appeid" value="<?php echo $app_emp_id;?>">
					<input type="hidden" id="appid" name="appid" value="<?php echo $app_id;?>">
					<!-- <input type="hidden" id="empid" name="empid" value="<?php echo $emp_id;?>"> -->

				<div class="form-group">
					<label for="employee" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
					<div class="col-sm-9">
						<select class="form-control" name="empid" id="empid" required>
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
								if($yrow['empid'] == $emp_id){
									echo "
									<option value='".$yrow['empid']."' selected>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
									";
								}else{
									echo "
									<option value='".$yrow['empid']."'>".$yrow['titlename'].$yrow['firstname']." ".$yrow['lastname']."</option>
									";
								}
							}
							?>
						</select>
					</div>
				</div>

                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">วันที่</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="datepicker_edit">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_in" class="col-sm-3 control-label">เวลาเริ่มต้น</label>

                  	<div class="col-sm-9">
                  		<!-- <div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_in" name="edit_time_in">
                    	</div> -->
						<select class="form-control" name="edit_time_in" id="edit_time_in" required>
							<option value="" selected>- Select -</option>
							<option value="00:00:00">0:00</option>
							<option value="00:30:00">0:30</option>
							<option value="01:00:00">1:00</option>
							<option value="01:30:00">1:30</option>
							<option value="02:00:00">2:00</option>
							<option value="02:30:00">2:30</option>
							<option value="03:00:00">3:00</option>
							<option value="03:30:00">3:30</option>
							<option value="04:00:00">4:00</option>
							<option value="04:30:00">4:30</option>
							<option value="05:00:00">5:00</option>
							<option value="05:30:00">5:30</option>
							<option value="06:00:00">6:00</option>
							<option value="06:30:00">6:30</option>
							<option value="07:00:00">7:00</option>
							<option value="07:30:00">7:30</option>
							<option value="08:00:00">8:00</option>
							<option value="08:30:00">8:30</option>
							<option value="09:00:00">9:00</option>
							<option value="09:30:00">9:30</option>
							<option value="10:00:00">10:00</option>
							<option value="10:30:00">10:30</option>
							<option value="11:00:00">11:00</option>
							<option value="11:30:00">11:30</option>
							<option value="12:00:00">12:00</option>
							<option value="12:30:00">12:30</option>
							<option value="13:00:00">13:00</option>
							<option value="13:30:00">13:30</option>
							<option value="14:00:00">14:00</option>
							<option value="14:30:00">14:30</option>
							<option value="15:00:00">15:00</option>
							<option value="15:30:00">15:30</option>
							<option value="16:00:00">16:00</option>
							<option value="16:30:00">16:30</option>
							<option value="17:00:00">17:00</option>
							<option value="17:30:00">17:30</option>
							<option value="18:00:00">18:00</option>
							<option value="18:30:00">18:30</option>
							<option value="19:00:00">19:00</option>
							<option value="19:30:00">19:30</option>
							<option value="20:00:00">20:00</option>
							<option value="20:30:00">20:30</option>
							<option value="21:00:00">21:00</option>
							<option value="21:30:00">21:30</option>
							<option value="22:00:00">22:00</option>
							<option value="22:30:00">22:30</option>
							<option value="23:00:00">23:00</option>
							<option value="23:30:00">23:30</option>
						</select>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_out" class="col-sm-3 control-label">เวลาสิ้นสุด</label>

                  	<div class="col-sm-9">
                  		<!-- <div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_out" name="edit_time_out">
                    	</div> -->
						<select class="form-control" name="edit_time_out" id="edit_time_out" required>
							<option value="" selected>- Select -</option>
							<option value="00:00:00">0:00</option>
							<option value="00:30:00">0:30</option>
							<option value="01:00:00">1:00</option>
							<option value="01:30:00">1:30</option>
							<option value="02:00:00">2:00</option>
							<option value="02:30:00">2:30</option>
							<option value="03:00:00">3:00</option>
							<option value="03:30:00">3:30</option>
							<option value="04:00:00">4:00</option>
							<option value="04:30:00">4:30</option>
							<option value="05:00:00">5:00</option>
							<option value="05:30:00">5:30</option>
							<option value="06:00:00">6:00</option>
							<option value="06:30:00">6:30</option>
							<option value="07:00:00">7:00</option>
							<option value="07:30:00">7:30</option>
							<option value="08:00:00">8:00</option>
							<option value="08:30:00">8:30</option>
							<option value="09:00:00">9:00</option>
							<option value="09:30:00">9:30</option>
							<option value="10:00:00">10:00</option>
							<option value="10:30:00">10:30</option>
							<option value="11:00:00">11:00</option>
							<option value="11:30:00">11:30</option>
							<option value="12:00:00">12:00</option>
							<option value="12:30:00">12:30</option>
							<option value="13:00:00">13:00</option>
							<option value="13:30:00">13:30</option>
							<option value="14:00:00">14:00</option>
							<option value="14:30:00">14:30</option>
							<option value="15:00:00">15:00</option>
							<option value="15:30:00">15:30</option>
							<option value="16:00:00">16:00</option>
							<option value="16:30:00">16:30</option>
							<option value="17:00:00">17:00</option>
							<option value="17:30:00">17:30</option>
							<option value="18:00:00">18:00</option>
							<option value="18:30:00">18:30</option>
							<option value="19:00:00">19:00</option>
							<option value="19:30:00">19:30</option>
							<option value="20:00:00">20:00</option>
							<option value="20:30:00">20:30</option>
							<option value="21:00:00">21:00</option>
							<option value="21:30:00">21:30</option>
							<option value="22:00:00">22:00</option>
							<option value="22:30:00">22:30</option>
							<option value="23:00:00">23:00</option>
							<option value="23:30:00">23:30</option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
					<label for="edit_reponsibility" class="col-sm-3 control-label">งานที่ปฏิบัติ</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_reponsibility" name="edit_reponsibility" required>
					</div>
				</div>
				<div class="form-group">
					<label for="edit_otrate_id" class="col-sm-3 control-label">อัตราค่าล่วงเวลา</label>						
					<div class="col-sm-9">							
						<select class="form-control" name="edit_otrate_id" id="edit_otrate_id" required>
							<option value="" selected>- Select -</option>
							<?php
								if($_SESSION['deptid']==99){
									$sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name												
											FROM otrate_group
											LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
											LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
											WHERE otrate.is_active = 1 
											ORDER BY CONVERT(otrate.otrate_name USING tis620)
											;";
								}else{
									// $sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name		
									// 		FROM otrate_group
									// 		LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
									// 		LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
									// 		WHERE otrate_group.dept_id = '".$_SESSION['deptid']."'
									// 		ORDER BY CONVERT(otrate.otrate_name USING tis620)
									// 		;";
									$sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name		
											FROM otrate_group
											LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
											LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
											WHERE otrate_group.dept_id = '".$_SESSION['deptid']."'
											AND otrate.is_active = 1
											ORDER BY CONVERT(otrate.otrate_name USING tis620)
											;";	
								}
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['otrateid']."'>".$drow['otrate_name']."</option>
									";
								}
							?>
						</select>
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
    <div class="modal-dialog" style="width:1024px;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="attendance_date"></span></b></h4> -->
				<h4 class="modal-title"><b>Delete Time Table</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_ot_delete.php">
            		<!-- <input type="hidden" id="del_attid" name="id"> -->
					<input type="hidden" id="del_appeotid" name="del_appeotid">
					<input type="hidden" id="appeid" name="appeid" value="<?php echo $app_emp_id;?>">
					<input type="hidden" id="appid" name="appid" value="<?php echo $app_id;?>">
					<input type="hidden" id="empid" name="empid" value="<?php echo $emp_id;?>">
            		<!-- <div class="text-center">
	                	<p>DELETE ATTENDANCE</p>
	                	<h2 id="del_employee_name" class="bold"></h2>
	            	</div> -->
					<div class="form-group">
					<label for="employee" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
					<?php
						$sql = "SELECT * 
								FROM employees
								WHERE id = '".$emp_id."'
								;";
						$query = $conn->query($sql);
						$remp = $query->fetch_assoc();		
						$empname = $remp["titlename"].$remp["firstname"]." ".$remp["lastname"]; 
					?>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="employee" name="employee" value="<?php echo $empname;?>" required readonly>
					</div>
				</div>

                <div class="form-group">
                    <label for="datepicker_del" class="col-sm-3 control-label">วันที่</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_del" name="datepicker_del" readonly>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="del_time_in" class="col-sm-3 control-label">เวลาเริ่มต้น</label>

                  	<div class="col-sm-9">
                  		<!-- <div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_in" name="edit_time_in">
                    	</div> -->
						<select class="form-control" name="del_time_in" id="del_time_in" required disabled>
							<option value="" selected>- Select -</option>
							<option value="00:00:00">0:00</option>
							<option value="00:30:00">0:30</option>
							<option value="01:00:00">1:00</option>
							<option value="01:30:00">1:30</option>
							<option value="02:00:00">2:00</option>
							<option value="02:30:00">2:30</option>
							<option value="03:00:00">3:00</option>
							<option value="03:30:00">3:30</option>
							<option value="04:00:00">4:00</option>
							<option value="04:30:00">4:30</option>
							<option value="05:00:00">5:00</option>
							<option value="05:30:00">5:30</option>
							<option value="06:00:00">6:00</option>
							<option value="06:30:00">6:30</option>
							<option value="07:00:00">7:00</option>
							<option value="07:30:00">7:30</option>
							<option value="08:00:00">8:00</option>
							<option value="08:30:00">8:30</option>
							<option value="09:00:00">9:00</option>
							<option value="09:30:00">9:30</option>
							<option value="10:00:00">10:00</option>
							<option value="10:30:00">10:30</option>
							<option value="11:00:00">11:00</option>
							<option value="11:30:00">11:30</option>
							<option value="12:00:00">12:00</option>
							<option value="12:30:00">12:30</option>
							<option value="13:00:00">13:00</option>
							<option value="13:30:00">13:30</option>
							<option value="14:00:00">14:00</option>
							<option value="14:30:00">14:30</option>
							<option value="15:00:00">15:00</option>
							<option value="15:30:00">15:30</option>
							<option value="16:00:00">16:00</option>
							<option value="16:30:00">16:30</option>
							<option value="17:00:00">17:00</option>
							<option value="17:30:00">17:30</option>
							<option value="18:00:00">18:00</option>
							<option value="18:30:00">18:30</option>
							<option value="19:00:00">19:00</option>
							<option value="19:30:00">19:30</option>
							<option value="20:00:00">20:00</option>
							<option value="20:30:00">20:30</option>
							<option value="21:00:00">21:00</option>
							<option value="21:30:00">21:30</option>
							<option value="22:00:00">22:00</option>
							<option value="22:30:00">22:30</option>
							<option value="23:00:00">23:00</option>
							<option value="23:30:00">23:30</option>
						</select>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="del_time_out" class="col-sm-3 control-label">เวลาสิ้นสุด</label>
                  	<div class="col-sm-9">
                  		<!-- <div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_out" name="edit_time_out">
                    	</div> -->
						<select class="form-control" name="del_time_out" id="del_time_out" required disabled>
							<option value="" selected>- Select -</option>
							<option value="00:00:00">0:00</option>
							<option value="00:30:00">0:30</option>
							<option value="01:00:00">1:00</option>
							<option value="01:30:00">1:30</option>
							<option value="02:00:00">2:00</option>
							<option value="02:30:00">2:30</option>
							<option value="03:00:00">3:00</option>
							<option value="03:30:00">3:30</option>
							<option value="04:00:00">4:00</option>
							<option value="04:30:00">4:30</option>
							<option value="05:00:00">5:00</option>
							<option value="05:30:00">5:30</option>
							<option value="06:00:00">6:00</option>
							<option value="06:30:00">6:30</option>
							<option value="07:00:00">7:00</option>
							<option value="07:30:00">7:30</option>
							<option value="08:00:00">8:00</option>
							<option value="08:30:00">8:30</option>
							<option value="09:00:00">9:00</option>
							<option value="09:30:00">9:30</option>
							<option value="10:00:00">10:00</option>
							<option value="10:30:00">10:30</option>
							<option value="11:00:00">11:00</option>
							<option value="11:30:00">11:30</option>
							<option value="12:00:00">12:00</option>
							<option value="12:30:00">12:30</option>
							<option value="13:00:00">13:00</option>
							<option value="13:30:00">13:30</option>
							<option value="14:00:00">14:00</option>
							<option value="14:30:00">14:30</option>
							<option value="15:00:00">15:00</option>
							<option value="15:30:00">15:30</option>
							<option value="16:00:00">16:00</option>
							<option value="16:30:00">16:30</option>
							<option value="17:00:00">17:00</option>
							<option value="17:30:00">17:30</option>
							<option value="18:00:00">18:00</option>
							<option value="18:30:00">18:30</option>
							<option value="19:00:00">19:00</option>
							<option value="19:30:00">19:30</option>
							<option value="20:00:00">20:00</option>
							<option value="20:30:00">20:30</option>
							<option value="21:00:00">21:00</option>
							<option value="21:30:00">21:30</option>
							<option value="22:00:00">22:00</option>
							<option value="22:30:00">22:30</option>
							<option value="23:00:00">23:00</option>
							<option value="23:30:00">23:30</option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
					<label for="del_reponsibility" class="col-sm-3 control-label">งานที่ปฏิบัติ</label>

					<div class="col-sm-9">
						<input type="text" class="form-control" id="del_reponsibility" name="del_reponsibility" required readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="del_otrate_id" class="col-sm-3 control-label">อัตราค่าล่วงเวลา</label>						
					<div class="col-sm-9">							
						<select class="form-control" name="del_otrate_id" id="del_otrate_id" required disabled>
							<option value="" selected>- Select -</option>
							<?php
								if($_SESSION['deptid']==99){
									$sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name												
											FROM otrate_group
											LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
											LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
											ORDER BY CONVERT(otrate.otrate_name USING tis620)
											;";
								}else{
									$sql = "SELECT DISTINCT otrate.otrate_id AS otrateid, otrate.otrate_name		
											FROM otrate_group
											LEFT JOIN otrate  ON otrate.otrate_id=otrate_group.otrate_id 
											LEFT JOIN department ON department.dept_id=otrate_group.dept_id 
											WHERE otrate_group.dept_id = '".$_SESSION['deptid']."'
											ORDER BY CONVERT(otrate.otrate_name USING tis620)
											;";	
								}
								$query = $conn->query($sql);
								while($drow = $query->fetch_assoc()){
									echo "
									<option value='".$drow['otrateid']."'>".$drow['otrate_name']."</option>
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


     