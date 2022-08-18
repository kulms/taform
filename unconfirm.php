<?php
	include 'conn.php';

	$app_id = $_GET['appid'];
	
	if(isset($_GET['confirm'])){
		$userid = 2;
		$sql = "UPDATE approval 
                SET                     
					app_status = '0',					
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_id = '$app_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Approval Form unconfirmed successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Select form first';
	}

	header('location:index.php');

?>