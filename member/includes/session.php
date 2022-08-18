<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['member']) || trim($_SESSION['member']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM member WHERE id = '".$_SESSION['member']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();

	// $asso_dean = "รศ.ดร.พัชราภรณ์ ญาณภิรัต";
	// $asso_dean_pos = "รองคณบดีฝ่ายวางแผนและควบคุม ปฏิบัติหน้าที่แทน";
	// $asso_dean_pos2 = "คณบดีคณะวิศวกรรมศาสตร์";
	$asso_dean = "รศ.ดร.พีรยุทธ์ ชาญเศรษฐิกุล";
	$asso_dean_pos = "";
	$asso_dean_pos2 = "คณบดีคณะวิศวกรรมศาสตร์";
	
	
?>