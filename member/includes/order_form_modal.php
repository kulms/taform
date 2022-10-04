<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Order Form</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="order_form_add.php" enctype="multipart/form-data">  
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
						<label for="datepicker_add" class="col-sm-3 control-label">รายละเอียดคำสั่ง</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" required> -->
                            <input type="text" class="form-control" id="order_detail" name="order_detail" required>
						</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="order_file" class="col-sm-3 control-label">File คำสั่ง</label>
						<div class="col-sm-9">
                        <input type="file" class="form-control col-sm-8" id="order_file" name="order_file" required>
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
    <!-- <div class="modal-dialog modal-lg"> -->
	<div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="dept_name"></span></b></h4> -->
				<h4 class="modal-title"><b>Edit Order Form</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="order_form_edit.php" enctype="multipart/form-data">
            		<input type="hidden" id="order_id" name="order_id">
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
						<label for="edit_order_detail" class="col-sm-3 control-label">รายละเอียดคำสั่ง</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" required> -->
                            <input type="text" class="form-control" id="edit_order_detail" name="edit_order_detail" required>
						</div>
						</div>
					</div>
                    <div class="form-group">
						<label for="order_file" class="col-sm-3 control-label">File คำสั่ง</label>
						<div class="col-sm-9">
                        <input type="file" class="form-control col-sm-8" id="order_file" name="order_file" required>
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
    <!-- <div class="modal-dialog modal-lg"> -->
	<div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span id="del_dept_name"></span></b></h4> -->
				<h4 class="modal-title"><b>Delete Order Form</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="order_form_delete.php">
            		<input type="hidden" id="del_order_id" name="del_order_id">
                    <input type="hidden" id="del_fiscal_id2" name="del_fiscal_id2">
                    <input type="hidden" id="del_sem_id2" name="del_sem_id2">
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
						<label for="del_order_detail" class="col-sm-3 control-label">รายละเอียดคำสั่ง</label>

						<div class="col-sm-9"> 
						<div class="date">
							<!-- <input type="text" class="form-control" id="datepicker_approval_add" name="datepicker_approval_add" required> -->
                            <input type="text" class="form-control" id="del_order_detail" name="del_order_detail" required disabled>
						</div>
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


     