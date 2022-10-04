<?php
	include 'includes/session.php';
    
    if(isset($_POST['edit'])){
        $app_id = $_POST['app_id'];
        $app_std_id = $_POST['app_std_id'];
        $std_id = $_POST['edit_std_id'];
        $std_title_name = $_POST['edit_std_title_name'];
        $std_name = $_POST['edit_std_name'];
        $std_degree = $_POST['edit_std_degree'];
		$std_class = $_POST['edit_std_class'];
		$std_subject = $_POST['edit_std_subject'];
        $std_section = $_POST['edit_std_section'];
        $std_number = $_POST['edit_std_number'];
        $std_amount = $_POST['edit_std_amount'];
        $std_gpa = $_POST['edit_std_gpa'];
        $std_score = $_POST['edit_std_score'];
        $std_bankno = $_POST['edit_std_bankno'];
        $std_bankname = $_POST['edit_std_bankname'];
        $std_phone = $_POST['edit_std_phone'];

		$userid = $_SESSION['member'];

        $sql = "UPDATE approval_std 
                SET 
                    std_id = '$std_id', 
                    std_title_name = '$std_title_name', 
                    std_name = '$std_name',
                    std_degree = '$std_degree',
                    std_class = '$std_class',
					std_subject = '$std_subject',
					std_section = '$std_section',
                    std_number = '$std_number',
                    std_amount = '$std_amount',
                    std_gpa = '$std_gpa',
                    std_score = '$std_score',
                    std_bankno = '$std_bankno',
                    std_bankname = '$std_bankname',
                    std_phone = '$std_phone',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_std_id = '$app_std_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Approval std updated successfully';
            $sql = "UPDATE approval_std_rec 
                SET 
                    std_id = '$std_id', 
                    std_title_name = '$std_title_name', 
                    std_name = '$std_name',
                    std_degree = '$std_degree',
                    std_class = '$std_class',
                    std_amount = '$std_amount',
                    std_phone = '$std_phone',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE app_std_id = '$app_std_id'";
             if($conn->query($sql)){
                $_SESSION['success'] = 'Approval std rec updated successfully';
             }else{
                $_SESSION['error'] = $conn->error;    
             }
        }else{
            $_SESSION['error'] = $conn->error;
        }
    }
	else{
		$_SESSION['error'] = 'Fill up edit form first';
    }    

	header('location: propose.php?appid='.$app_id);

?>