<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Position</b></h4>
          	</div>
			<form class="form-horizontal" method="POST" action="approval_position_add.php">
				<!-- <input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>">   -->
				<div class="modal-body">            	
                    <div class="form-group">
						<label for="dept_name" class="col-sm-3 control-label">ตำแหน่ง</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<input type="text" class="form-control" id="description" name="description" value="" required>
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
				    <h4 class="modal-title"><b>Edit Position</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_position_edit.php">
					<!-- <input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id;?>"> -->
					<input type="hidden" id="id" name="id">
                
				    <div class="form-group">
						<label for="edit_position_name" class="col-sm-3 control-label">ตำแหน่ง</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<input type="text" class="form-control" id="edit_position_name" name="edit_position_name" value="" required>
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
				<h4 class="modal-title"><b>Delete Position</b></h4>
				<!-- <h4 class="modal-title"><b><span id="del_employee_name"></span></b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="approval_position_delete.php">
                <input type="hidden" id="del_id" name="del_id">
                
                <div class="form-group">
						<label for="del_position_name" class="col-sm-3 control-label">ตำแหน่ง</label>
						<div class="col-sm-9">
						<?php //echo $_SESSION['deptid']." ".$app_id;?>
						<input type="text" class="form-control" id="del_position_name" name="del_position_name" value="" required readonly>
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


     