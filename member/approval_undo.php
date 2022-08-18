<?php
    include 'includes/session.php';
    include 'includes/functions.php';

	$app_id = $_GET['appid'];
	
	if(isset($_GET['confirm'])){
		$userid = $_SESSION['member'];
        
        $sql = "SELECT username, firstname, lastname FROM member WHERE id = '".$userid."'";
        //echo $sql."<br>";

        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $memEmail = $row["username"]."@ku.ac.th"; 
        $memFName = $row["firstname"];
        $memLName = $row["lastname"];

        $data = "123";
        // echo $app_id;
        // echo $memEmail;
        // echo $memFName;
        // echo $memLName;

        // $data = base64url_encode($memEmail);

        // echo $data;

        if(sendRegisterEmail($app_id,$data,$memEmail,$memFName,$memLName)==1){            
            $_SESSION['success'] = 'Confirmation request successful.';
        }else{
            $_SESSION['error'] = 'Confirmation request failed.';
        }

	}
	else{
		$_SESSION['error'] = 'Select form first';
	}

	header('location:approval_form.php');

?>