<?php
	include 'includes/session.php';
    
    if(isset($_POST['edit'])){
        $order_id = $_POST['order_id'];
        $fiscal_id = $_POST['edit_fiscal_id'];
        $sem_id = $_POST['edit_sem_id'];
        $app_times = $_POST['edit_app_times'];
        $order_detail = $_POST['edit_order_detail'];

        $userid = $_SESSION['member'];

        $sql = "UPDATE order_form
                SET 
                    fiscal_id = '$fiscal_id', 
                    sem_id = '$sem_id', 
                    app_times = '$app_times',
                    order_detail = '$order_detail',
                    lupdate_by = '$userid',
                    lupdate_date = now()
                WHERE order_id = '$order_id'";

        if($conn->query($sql)){
            $_SESSION['success'] = 'Propose form updated successfully';
            $error_txt = array();

            $path1 = "../files/order/".$order_id."/";
            // @mkdir($path1, 0777);	

            $type_image_upload=array('pdf');

            if($_FILES["order_file"]["name"] !=""){ 
                $file_type = substr(strtolower($_FILES["order_file"]["name"]),-3); 
                if(!in_array($file_type, $type_image_upload)) {
                    $error_txt[]="File does not macth.Please Upload pdf only.";        
                }
            }

            $num_error_check=@count($error_txt);
            if(!$num_error_check){ 
                if($_FILES["order_file"]["name"] !=""){
                    if (is_uploaded_file($_FILES['order_file']['tmp_name'])) { 
                        $file_type = substr(strtolower($_FILES["order_file"]["name"]),-3); 
                        $file_name = $_FILES["order_file"]["name"];             
                        $f1=date("dmYHis");            
                        // $f1=$wl_date;
                        $file_lastname=substr($file_name,-4);
                        $file_gen_name=time();
                        // $file_new_name="reqfile_1_"."$f1$file_gen_name$file_lastname";                            
                        $file_new_name="$f1$file_gen_name$file_lastname";                            
                        
                        if(move_uploaded_file($_FILES['order_file']['tmp_name'], $path1.$file_new_name)){
                            $picfile = $file_new_name;                    
                        }                                                
                    }
                    $upfileSet = "";
                    if($picfile!=""){
                        // $upfileSet = " order_file='".$picfile."' ";                        
                        $upfileSet = " order_file='".$picfile."' ";
                    }        
                    $sql_update1 = "UPDATE order_form SET ".$upfileSet." WHERE order_id= ".$order_id;
                    // echo $sql_update1."<br>";
                    $sqlqueryupdate1=mysqli_query($conn,$sql_update1);
                }
            }

        }else{
            $_SESSION['error'] = $conn->error;
        }
    }
	else{
		$_SESSION['error'] = 'Fill up edit form first';
    }    

	header('location: order_form.php?fid='.$fiscal_id.'&sid='.$sem_id);

?>