<?php
	include 'includes/session.php';

    function Delete($path)
    {
        if (is_dir($path) === true)
        {
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file)
            {
                Delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        }

        else if (is_file($path) === true)
        {
            return unlink($path);
        }

        return false;
    }

	if(isset($_POST['delete'])){
		$order_id = $_POST['del_order_id'];
        $fiscal_id = $_POST['del_fiscal_id2'];
        $sem_id = $_POST['del_sem_id2'];

		// $sqlempot = "DELETE FROM approval_emp_ot WHERE app_id = '$app_id'";
		// if($conn->query($sqlempot)){
		// 	$_SESSION['success'] = 'Approval form deleted successfully';
		// }
		// else{
		// 	$_SESSION['error'] = $conn->error;
		// }

		// $sqlemp = "DELETE FROM approval_emp WHERE app_id = '$app_id'";
		// if($conn->query($sqlemp)){
		// 	$_SESSION['success'] = 'Approval form deleted successfully';
		// }
		// else{
		// 	$_SESSION['error'] = $conn->error;
		// }

		$sql = "DELETE FROM order_form WHERE order_id = '$order_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Order form deleted successfully';
			$path1 = "../files/order/".$order_id."/";
            if(Delete($path1)){
                $_SESSION['success'] = 'Order form path deleted successfully';
            }else{
                $_SESSION['error'] = 'Order form path deleted fail';
            }
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: order_form.php?fid='.$fiscal_id.'&sid='.$sem_id);
	
?>