<?php
  session_start();
  if(isset($_SESSION['member'])){
    header('location:home.php');
	}
    include 'includes/conn.php';
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<!-- <div class="login-logo">
  		<b>Register New User</b>
  	</div> -->
    <div class="login-logo">
        <h3>ระบบติดตามค่าล่วงเวลาด้วยลายนิ้วมือ</h3>
        <h3>(OT Monitoring by Fingerprint Scanning)</h3>
        <b>ลงทะเบียนเข้าใช้งาน</b>
    </div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">ระบุ Nontri Account (@ku.ac.th)</p>

    	<form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="username" placeholder="input Username" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="input Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <select class="form-control" name="dept_id" id="dept_id" required>
                    <option value="" selected>- Select -</option>
                <?php
                    $sql = "SELECT * FROM department ORDER BY CONVERT(department.dept_name USING tis620);";
                    $query = $conn->query($sql);
                    while($yrow = $query->fetch_assoc()){
                        echo "
                        <option value='".$yrow['dept_id']."'>".$yrow['dept_name']."</option>
                        ";
                    }
                ?>
                </select>	
            </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="register" value="1"><i class="fa fa-sign-in"></i> ลงทะเบียน</button>			
        		</div>
      		</div>
    	</form>      		    	
  	</div>

    <div class="login-box-body">
        <p class="login-box-msg"><a href="index.php">< กลับหน้าแรก</a></p>
    </div>  		
    
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>	

<?php include 'includes/scripts.php' ?>
</body>
</html>