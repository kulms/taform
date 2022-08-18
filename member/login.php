<?php
	session_start();
	include 'includes/conn.php';

	//echo $_POST['login']."<br>";
	//echo $_POST['register']."<br>";

	if(isset($_POST['login'])){
		$login = 1;
	}else{
		$login = 0;
	}

	if(isset($_POST['register'])){
		$register = 1;
	}else{
		$register = 0;
	}

	if($login||$register){
		
		if($login){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$logintype = $_POST['logintype'];
			
			echo $username." ".$password." ".$logintype;

			$sql = "SELECT * FROM member WHERE username = '$username'";
			$query = $conn->query($sql);

			if($query->num_rows < 1){
				$_SESSION['error'] = 'Cannot find account with the username';
			}
			else{
				if($logintype==1){
					$row = $query->fetch_assoc();
					if(password_verify($password, $row['password'])){
						$_SESSION['member'] = $row['id'];
						$_SESSION['deptid'] = $row['dept_id'];
						$_SESSION['is_admin'] = $row['is_admin'];
						$_SESSION['is_edit'] = $row['is_edit'];
						$_SESSION['is_approve'] = $row['is_approve'];
					}
					else{
						$_SESSION['error'] = 'Incorrect password';
					}
				}else{
					// KU LDAP Verify
					include 'encode.php';
					include 'ldap.php';

					if (isset($_POST["username"]) && !empty($_POST["username"])) {
						$your_account = str_replace("*","",strtolower(trim($_POST['username'])));
					}

					if (isset($_POST["password"]) && !empty($_POST["password"])) {
						$your_password = $_POST["password"];
					}

					$ldap_authen_result = user_authen($your_account, $your_password);
					$row = $query->fetch_assoc();

					if ($ldap_authen_result > 0) {
						//echo "<center><font color=RED>" . $ldap_error[$ldap_authen_result] . "</font></center><br>";
						$_SESSION['error'] = $ldap_error[$ldap_authen_result];
					} else {
						//--- authentication สำเร็จ  สร้างตัวแปร session ชื่อว่า Logon กำหนดค่าให้เป็น 1  เพื่อแสดงว่า เข้าสู่ระบบได้ 
						//$_SESSION["Logon"] = 1;
						$_SESSION['member'] = $row['id'];
						$_SESSION['deptid'] = $row['dept_id'];
						$_SESSION['is_admin'] = $row['is_admin'];
						$_SESSION['is_edit'] = $row['is_edit'];
						$_SESSION['is_approve'] = $row['is_approve'];
					}

				}
			}


		}
		if($register){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$hashpassword = password_hash($password, PASSWORD_DEFAULT);

			$dept_id = $_POST['dept_id'];

			$sql = "SELECT * FROM member WHERE username = '$username'";
			$query = $conn->query($sql);

			if($query->num_rows >= 1){
				$_SESSION['error'] = 'This account already exists.';
			}else{
				// KU LDAP Verify
				include 'encode.php';
				include 'ldap.php';

				if (isset($_POST["username"]) && !empty($_POST["username"])) {
					$your_account = str_replace("*","",strtolower(trim($_POST['username'])));
				}

				if (isset($_POST["password"]) && !empty($_POST["password"])) {
					$your_password = $_POST["password"];
				}

				$ldap_authen_result = user_authen($your_account, $your_password);
				
				if ($ldap_authen_result > 0) {
					//echo "<center><font color=RED>" . $ldap_error[$ldap_authen_result] . "</font></center><br>";
					$_SESSION['error'] = "<center><font color=RED>" . $ldap_error[$ldap_authen_result] . "</font></center><br>";
				} else {
					//--- authentication สำเร็จ  สร้างตัวแปร session ชื่อว่า Logon กำหนดค่าให้เป็น 1  เพื่อแสดงว่า เข้าสู่ระบบได้ 
					//$_SESSION["Logon"] = 1;
					$member_name = $ldap_thainame;
					$name_parts = explode(" ", $member_name);
					$firstname = $name_parts[0]; 
					$lastname = $name_parts[1];

					$sql = "INSERT INTO member 
							(username, 
							password, 
							firstname,
							lastname,
							photo,
							dept_id, 				
							created_on,
							is_admin
							) 
							VALUES 
							('$username', 
							'$hashpassword', 
							'$firstname', 				
							'$lastname', 
							'profile.jpg',
							'$dept_id',
							now(),
							'0'
							);";
					
					//echo $sql;

					if($conn->query($sql)){
						$_SESSION['success'] = 'Member registered successfully';
					}else{
						$_SESSION['error'] = $conn->error;
						header('location: register.php');
					}
					
					$newid = $conn->insert_id;

					$_SESSION['member'] = $newid;
					$_SESSION['deptid'] = $dept_id;
				}

			}

		}
		
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: index.php');

?>