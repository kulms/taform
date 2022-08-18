<?php
	include 'includes/session.php';

	$app_id = $_GET['appid'];
	
	if(isset($_GET['confirm'])){
		$userid = $_SESSION['member'];
		$sql = "UPDATE approval 
                SET                     
					app_status = '1',					
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_id = '$app_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Approval Form confirmed successfully';
        }else{
            $_SESSION['error'] = $conn->error;
        }
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:approval_form.php');

?>