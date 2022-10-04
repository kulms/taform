<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		
        $fiscal_id = $_POST['fiscal_id'];
        $sem_id = $_POST['sem_id'];
        $app_times = $_POST['app_times'];
        $order_detail = $_POST['order_detail'];
		
		$userid = $_SESSION['member'];
                
        $sql = "INSERT INTO order_form 
                (fiscal_id, 
                sem_id, 
                app_times, 
                order_detail, 
                create_by, 
                create_date, 
                lupdate_by, 
                lupdate_date) 
                VALUES 
                ('$fiscal_id', 
                '$sem_id', 
                '$app_times', 
                '$order_detail', 
                '$userid', 
                now(), 
                '$userid', 
                now());";
        // echo $sql."<br>";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Order form added successfully';
            $new_id = $conn->insert_id;
            $error_txt = array();

            $path1 = "../files/order/".$new_id."/";
            @mkdir($path1, 0777);	

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
                        $file_new_name="$f1$file_gen_name$file_lastname";                            
                        
                        if(move_uploaded_file($_FILES['order_file']['tmp_name'], $path1.$file_new_name)){
                            $picfile = $file_new_name;                    
                        }                                                
                    }
                    $upfileSet = "";
                    if($picfile!=""){
                        
                        $upfileSet = " order_file='".$picfile."' ";
                        
                    }        
                    $sql_update1 = "UPDATE order_form SET ".$upfileSet." WHERE order_id= ".$new_id;
                    // echo $sql_update1."<br>";
                    $sqlqueryupdate1=mysqli_query($conn,$sql_update1);
                }
            }

        }else{
            $_SESSION['error'] = $conn->error;
        }
               
	}else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: order_form.php?fid='.$fiscal_id.'&sid='.$sem_id);

?>