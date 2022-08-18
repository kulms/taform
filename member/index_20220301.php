<?php
  session_start();
  if(isset($_SESSION['member'])){
    header('location:home.php');
	}

	// include_once 'gpConfig.php';
	// include_once 'User.php';

	// $authUrl = $gClient->createAuthUrl();

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
	  <h3>ระบบติดตามค่าล่วงเวลาด้วยลายนิ้วมือ</h3>
	  <h3>(OT Monitoring by Fingerprint Scanning)</h3>
	  <b>Officer Login</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start</p>

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
			<input name="logintype" type="radio" value="2" checked="checked" />
			เข้าสู่ระบบโดยใช้ KU Nontri Account (@ku.ac.th)<br>
			<input name="logintype" type="radio" value="1"   />
			เข้าสู่ระบบโดยใช้ System Account (ผู้ดูแลระบบ)
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="1"><i class="fa fa-sign-in"></i> Sign In</button>			
        		</div>
      		</div>
    	</form>      		    	
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
<div class="login-box">
	<div class="login-box-body">
		<p class="login-box-msg">แหล่งการเก็บองค์ความรู้</p>		
		<div class="row">			
			<div class="col-xs-8">          			
				<img src="../images/Book.png"><a href="#"> คู่มือการใช้งานระบบ </a>
			</div>
		</div>
		<div class="row">			
			<div class="col-xs-8">          			
				<img src="../images/Book.png"><a href="../files/manual/Manual_OT_20191118.pdf"> คู่มือการใช้งานคุณสมบัติที่ปรับปรุง </a>
			</div>
		</div>
		<div class="row">			
			<div class="col-xs-12">          			
				<img src="../images/Book.png"><a href="#"> ระเบียบมหาวิทยาลัยในการเบิกจ่ายค่าล่วงเวลาฉบับปรับปรุง (มีนาคม พ.ศ. 2563)</a>
			</div>
		</div>
		<div class="row">			
			<div class="col-xs-12">          			
				<img src="../images/Book.png"><a href="#"> ระเบียบโครงการภาคพิเศษในการเบิกจ่ายค่าล่วงเวลาฉบับปรับปรุง (ตุลาคม พ.ศ. 2563)</a>
			</div>
		</div>
	</div>
</div>
<div class="login-box">
	<div class="login-box-body">
		<p class="login-box-msg">Register New User</p>		
			<div class="row">
			<div class="col-xs-4">          			
						<button type="submit" class="btn btn-primary btn-flat" id="login" name="login" onclick="window.location='register.php';"><i class="fa fa-sign-in"></i> ลงทะเบียนเข้าใช้งานระบบครั้งแรก</button>
				</div>
			</div>
	</div>
</div>
<!-- <div class="login-box">
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start with Google account</p>		
			<div class="row">
			<div class="col-xs-4">          			
						<button type="submit" class="btn btn-primary btn-flat" id="login" name="login" onclick="window.location = '<?php echo $authUrl;?>';"><i class="fa fa-sign-in"></i> Sign In with Google</button>
				</div>
			</div>
	</div>
</div>	 -->

<?php include 'includes/scripts.php' ?>
</body>
</html>