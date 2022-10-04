<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

include ('../includes/db.php');
include ('../includes/extra_mysqli.php');
include ('../includes/functions.php');
include ('../includes/cfg_waterlevel.php');

// echo $_SESSION["person_id"]."<br>";
// echo $_SESSION["slogin"]."<br>";
// echo $_SESSION["utype"]."<br>";

include ('../getUserInfo.php');

if(!isset($_SESSION['slogin']) && empty($_SESSION['slogin'])) { 
	header("refresh:0;URL=../index.php?login=1");
}

$timeIndex = 99;
$curtimeIndex = 99;
$sitdate = date('Y-m-d', time());
$sittime = date('H', time());
$sittime = $sittime.":00";

$next_sitdate = date('Y-m-d', strtotime('+1 hours', time()));
$next_sittime = date('H', strtotime('+1 hours', time()));
$next_sittime = $next_sittime.":00";

$prev_sitdate = date('Y-m-d', strtotime('-1 hours', time()));
$prev_sittime = date('H', strtotime('-1 hours', time()));
$prev_sittime = $prev_sittime.":00";


$curdate = date('Y-m-d', time());
$curtime = date('H', time());
$curtime = $curtime.":00";

// $next_curdate = date('Y-m-d', strtotime('+1 hours', time()));
// $next_curtime = date('H', strtotime('+1 hours', time()));
// $next_curtime = $next_curtime.":00";

// $prev_curdate = date('Y-m-d', strtotime('-1 hours', time()));
// $prev_curtime = date('H', strtotime('-1 hours', time()));
// $prev_curtime = $prev_curtime.":00";

if(!isset($_GET['stype'])) { 
	//$stype = 0;
}else{
	$stype = $_GET['stype'];
}

if(isset($_POST['sitdate']) && isset($_POST['sittime'])){   
    $sitdate = $_POST['sitdate'];    
	$sittime = $_POST['sittime'].":00";   
	$inittime = $sitdate." ".$sittime;  

	$next_sitdate = date('Y-m-d', strtotime($sitdate.' '.$sittime.' +1 hours'));
	$next_sittime = date('H', strtotime($sitdate.' '.$sittime.' +1 hours'));
	$next_sittime = $next_sittime.":00";

	$prev_sitdate = date('Y-m-d', strtotime($sitdate.' '.$sittime.' -1 hours'));
	$prev_sittime = date('H', strtotime($sitdate.' '.$sittime.' -1 hours'));
	$prev_sittime = $prev_sittime.":00";

} else {
	$sqlinittime = "SELECT datetime AS initial_time 
            FROM initial_time 
            WHERE name = 'urbs_realtime'
            ";                        
	// echo $sqlimg."<br>";

	$qinittime = mysqli_query($conn,$sqlinittime);
	$inittime = mysqli_result($qinittime, 0, "initial_time");

}



$urlradar2 = "https://radar-backend1.eng.ku.ac.th";


if(!isset($_POST['stype'])) { 
	//$stype = 0;
	if($stype==2){
		$curtime = substr($inittime, 11, 5);
		$curdate = substr($inittime, 0, 10);

		$next_curdate = date('Y-m-d', strtotime($curdate.' '.$curtime.' +1 hours'));
		$next_curtime = date('H', strtotime($curdate.' '.$curtime.' +1 hours'));
		$next_curtime = $next_curtime.":00";

		$prev_curdate = date('Y-m-d', strtotime($curdate.' '.$curtime.' -1 hours'));
		$prev_curtime = date('H', strtotime($curdate.' '.$curtime.' -1 hours'));
		$prev_curtime = $prev_curtime.":00";
	}
	switch ($curtime) {
		case '00:00':
			$timeIndex = 0;
			$curtimeIndex = 0;
			break;
		case '01:00':
			$timeIndex = 1;
			$curtimeIndex = 1;
			break;
		case '02:00':
			$timeIndex = 2;
			$curtimeIndex = 2;
			break;
		case '03:00':
			$timeIndex = 3;
			$curtimeIndex = 3;
			break;
		case '04:00':
			$timeIndex = 4;
			$curtimeIndex = 4;
			break;
		case '05:00':
			$timeIndex = 5;
			$curtimeIndex = 5;
			break;
		case '06:00':
			$timeIndex = 6;
			$curtimeIndex = 6;
			break;
		case '07:00':
			$timeIndex = 7;
			$curtimeIndex = 7;
			break;
		case '08:00':
			$timeIndex = 8;
			$curtimeIndex = 8;
			break;
		case '09:00':
			$timeIndex = 9;
			$curtimeIndex = 9;
			break;
		case '10:00':
			$timeIndex = 10;
			$curtimeIndex = 10;
			break;
		case '11:00':
			$timeIndex = 11;
			$curtimeIndex = 11;
			break;
		case '12:00':
			$timeIndex = 12;
			$curtimeIndex = 12;
			break;
		case '13:00':
			$timeIndex = 13;
			$curtimeIndex = 13;
			break;
		case '14:00':
			$timeIndex = 14;
			$curtimeIndex = 14;
			break;
		case '15:00':
			$timeIndex = 15;
			$curtimeIndex = 15;
			break;
		case '16:00':
			$timeIndex = 16;
			$curtimeIndex = 16;
			break;
		case '17:00':
			$timeIndex = 17;
			$curtimeIndex = 17;
			break;
		case '18:00':
			$timeIndex = 18;
			$curtimeIndex = 18;
			break;
		case '19:00':
			$timeIndex = 19;
			$curtimeIndex = 19;
			break;
		case '20:00':
			$timeIndex = 20;
			$curtimeIndex = 20;
			break;
		case '21:00':
			$timeIndex = 21;
			$curtimeIndex = 21;
			break;
		case '22:00':
			$timeIndex = 22;
			$curtimeIndex = 22;
			break;
		case '23:00':
			$timeIndex = 23;
			$curtimeIndex = 23;
			break;
	}
}else{
	$stype = $_POST['stype'];
	$sitdate = $_POST['sitdate'];
	$sittime = $_POST['sittime'];

	if($stype==2){
		$curtime = substr($inittime, 11, 5);
		// $curdate = substr($inittime, 0, 10);

		// $next_curdate = date('Y-m-d', strtotime($curdate.' '.$curtime.' +1 hours'));
		// $next_curtime = date('H', strtotime($curdate.' '.$curtime.' +1 hours'));
		// $next_curtime = $next_curtime.":00";

		// $prev_curdate = date('Y-m-d', strtotime($curdate.' '.$curtime.' -1 hours'));
		// $prev_curtime = date('H', strtotime($curdate.' '.$curtime.' -1 hours'));
		// $prev_curtime = $prev_curtime.":00";
	}

	switch ($sittime) {
		case '00:00':
			$timeIndex = 0;			
			break;
		case '01:00':
			$timeIndex = 1;			
			break;
		case '02:00':
			$timeIndex = 2;			
			break;
		case '03:00':
			$timeIndex = 3;			
			break;
		case '04:00':
			$timeIndex = 4;			
			break;
		case '05:00':
			$timeIndex = 5;			
			break;
		case '06:00':
			$timeIndex = 6;			
			break;
		case '07:00':
			$timeIndex = 7;			
			break;
		case '08:00':
			$timeIndex = 8;			
			break;
		case '09:00':
			$timeIndex = 9;			
			break;
		case '10:00':
			$timeIndex = 10;			
			break;
		case '11:00':
			$timeIndex = 11;			
			break;
		case '12:00':
			$timeIndex = 12;			
			break;
		case '13:00':
			$timeIndex = 13;			
			break;
		case '14:00':
			$timeIndex = 14;			
			break;
		case '15:00':
			$timeIndex = 15;			
			break;
		case '16:00':
			$timeIndex = 16;			
			break;
		case '17:00':
			$timeIndex = 17;			
			break;
		case '18:00':
			$timeIndex = 18;			
			break;
		case '19:00':
			$timeIndex = 19;			
			break;
		case '20:00':
			$timeIndex = 20;			
			break;
		case '21:00':
			$timeIndex = 21;			
			break;
		case '22:00':
			$timeIndex = 22;			
			break;
		case '23:00':
			$timeIndex = 23;			
			break;
	}

	switch ($curtime) {
		case '00:00':
			$curtimeIndex = 0;			
			break;
		case '01:00':
			$curtimeIndex = 1;			
			break;
		case '02:00':
			$curtimeIndex = 2;			
			break;
		case '03:00':
			$curtimeIndex = 3;			
			break;
		case '04:00':
			$curtimeIndex = 4;			
			break;
		case '05:00':
			$curtimeIndex = 5;			
			break;
		case '06:00':
			$curtimeIndex = 6;			
			break;
		case '07:00':
			$curtimeIndex = 7;			
			break;
		case '08:00':
			$curtimeIndex = 8;			
			break;
		case '09:00':
			$curtimeIndex = 9;			
			break;
		case '10:00':
			$curtimeIndex = 10;			
			break;
		case '11:00':
			$curtimeIndex = 11;			
			break;
		case '12:00':
			$curtimeIndex = 12;			
			break;
		case '13:00':
			$curtimeIndex = 13;			
			break;
		case '14:00':
			$curtimeIndex = 14;			
			break;
		case '15:00':
			$curtimeIndex = 15;			
			break;
		case '16:00':
			$curtimeIndex = 16;			
			break;
		case '17:00':
			$curtimeIndex = 17;			
			break;
		case '18:00':
			$curtimeIndex = 18;			
			break;
		case '19:00':
			$curtimeIndex = 19;			
			break;
		case '20:00':
			$curtimeIndex = 20;			
			break;
		case '21:00':
			$curtimeIndex = 21;			
			break;
		case '22:00':
			$curtimeIndex = 22;			
			break;
		case '23:00':
			$curtimeIndex = 23;			
			break;
	}
}



// $stype = $_GET['stype'];

// echo $stype;

switch($stype){
	case 1:
		$strSitTitle = "น้ำรายชั่วโมงจากข้อมูลสถานีตรวจวัด";
		break;
	case 2:
		$strSitTitle = "น้ำรายชั่วโมงจากผลการวิเคราะห์แบบจำลอง (ข้อมูลฝนเรดาร์ใกล้เวลาจริง)";
		break;
	case 3:
		$strSitTitle = "ข้อมูลจากแบบจำลอง (ฝนพยากรณ์)";
		break;
}

if(!isset($_POST['stype'])) { 
	
	// $today = date('Y-m-d', time());
	$today = date("Y-m-d", strtotime($sitdate));
	// echo $today."<br>";
	$time = date('H', time());
	$time = $time.":00";
	
	// $yesterday = date('Y-m-d',strtotime("-1 days"));
	$yesterday = date('Y-m-d',strtotime($sitdate." -1 days"));
	// echo $yesterday."<br>";

	// $twodayago = date('Y-m-d',strtotime("-2 days"));
	$twodayago = date('Y-m-d',strtotime($sitdate." -2 days"));
	// echo $twodayago."<br>";

	// $tomorrow = date("Y-m-d", strtotime("+1 day"));
	$tomorrow = date("Y-m-d", strtotime($sitdate." +1 day"));
	// echo $tomorrow."<br>";

	$tomorrow2 = date("Y-m-d", strtotime($sitdate." +2 day"));


	// $sqlmap4="SELECT mb.*, CAST(mb.water_value AS DECIMAL(10,2)) AS nwater_value, mb.waterlevel_id AS waterlevel00_id, d.dept_name_eng				
	// 			FROM mb_station_group_waterlevel mb, station s, department d
	// 			WHERE mb.id = s.STA_GROUP_ID 
	// 			AND mb.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
	// 			AND mb.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
	// 			AND mb.id IN (4328,2224,2225,5172)
	// 			AND s.DEPARTMENT = d.dept_id
	// 			ORDER BY id
	// 			LIMIT 10";
	if($stype==1){
		$sqlmap4="SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.waterlevel_offset AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (4328,2224,2225,5172,5173)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date = '".$sitdate."'
					AND w01.water_time = '".$sittime."'
					ORDER BY w01.water_date, w01.water_time
					LIMIT 10";
		// echo $sqlmap4;
		$query4 = mysqli_query($conn,$sqlmap4);

		$sqlmap4_all="SELECT sg.id, d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM station_group sg, station s, department d
					WHERE sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.id IN (4328,2224,2225,5172,5173)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID					
					LIMIT 10";
		// echo $sqlmap4;
		$query4_all = mysqli_query($conn,$sqlmap4_all);

		$sqlmap = "SELECT mm.accepted_value,mm.supplied_value,mm.meter_ref_level,
					mm.external_id,mm.shortname,mm.created,mm.lon,mm.lat, mm.created AS created_date, mm.id, mm.meter
					FROM mwm_measurement mm
					WHERE mm.meter IN (7440,7442,7443)				
					AND mm.accepted_value IS NOT NULL
					AND mm.created = '".$sitdate."'
					ORDER BY mm.meter
					";
		// echo $sqlmap."<br>";				
		$query = mysqli_query($conn,$sqlmap);

		$sqlmap_all = "SELECT mm.id,mm.code_all,mm.mwm_station_name,mm.longitude AS lon,mm.latitude AS lat, mm.created_date
					FROM mwm_station mm
					WHERE mm.id IN (7440,7442,7443)					
					";
		// echo $sqlmap_all;				
		$query_all = mysqli_query($conn,$sqlmap_all);

		$sql2224 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.waterlevel_offset AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (2224)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_DateAll = array();
		$data_2224All = array();
		$data_2224Full = array();
		$q2224 = mysqli_query($conn,$sql2224);

		while($row2224=@mysqli_fetch_array($q2224,MYSQLI_ASSOC)){      
			$data_DateAll[] = "'".$row2224['water_date']." ".$row2224['water_time']."'";
			if($row2224['nwater_value']=="-" || $row2224['nwater_value']=="0" || $row2224['nwater_value']==NULL){
				$data_2224All[] = "null";     				
			}else{
				$data_2224All[] = $row2224['nwater_value']; 												
			}
			$data_2224Full[] = $full2224;
		}
		mysqli_free_result($q2224);		

		$strDateAll = join( ',', $data_DateAll);
		$str2224All = join( ',', $data_2224All);
		$str2224Full = join( ',', $data_2224Full);
		// ========================================================
		$sql2225 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.waterlevel_offset AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (2225)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date2225All = array();
		$data_2225All = array();
		$data_2225Full = array();
		$q2225 = mysqli_query($conn,$sql2225);

		while($row2225=@mysqli_fetch_array($q2225,MYSQLI_ASSOC)){      
			$data_Date2225All[] = "'".$row2225['water_date']." ".$row2225['water_time']."'";
			if($row2225['nwater_value']=="-" || $row2225['nwater_value']=="0" || $row2225['nwater_value']==NULL){
				$data_2225All[] = "null";     				
			}else{
				$data_2225All[] = $row2225['nwater_value']; 												
			}
			$data_2225Full[] = $full2225;
		}
		mysqli_free_result($q2225);

		$strDate2225All = join( ',', $data_Date2225All);
		$str2225All = join( ',', $data_2225All);
		$str2225Full = join( ',', $data_2225Full);
		// ========================================================
		$sql4328 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (4328)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date4328All = array();
		$data_4328All = array();
		$data_4328Full = array();
		$q4328 = mysqli_query($conn,$sql4328);

		while($row4328=@mysqli_fetch_array($q4328,MYSQLI_ASSOC)){      
			$data_Date4328All[] = "'".$row4328['water_date']." ".$row4328['water_time']."'";
			if($row4328['nwater_value']=="-" || $row4328['nwater_value']=="0" || $row4328['nwater_value']==NULL){
				$data_4328All[] = "null";     				 
			}else{
				$data_4328All[] = $row4328['nwater_value']; 												
			}
			$data_4328Full[] = $full4328;
		}
		mysqli_free_result($q4328);

		$strDate4328All = join( ',', $data_Date4328All);
		$str4328All = join( ',', $data_4328All);
		$str4328Full = join( ',', $data_4328Full);
		// ========================================================
		$sql5172 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (5172)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date5172All = array();
		$data_5172All = array();
		$data_5172Full = array();
		$q5172 = mysqli_query($conn,$sql5172);

		while($row5172=@mysqli_fetch_array($q5172,MYSQLI_ASSOC)){      
			$data_Date5172All[] = "'".$row5172['water_date']." ".$row5172['water_time']."'";
			if($row5172['nwater_value']=="-" || $row5172['nwater_value']=="0" || $row5172['nwater_value']==NULL){
				$data_5172All[] = "null";     				
			}else{
				$data_5172All[] = $row5172['nwater_value']; 												
			}
			$data_5172Full[] = 0;
		}
		mysqli_free_result($q5172);

		$strDate5172All = join( ',', $data_Date5172All);
		$str5172All = join( ',', $data_5172All);
		$str5172Full = join( ',', $data_5172Full);
		// ========================================================
		$sql5173 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (5173)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date5173All = array();
		$data_5173All = array();
		$data_5173Full = array();
		$q5173 = mysqli_query($conn,$sql5173);

		while($row5173=@mysqli_fetch_array($q5173,MYSQLI_ASSOC)){      
			$data_Date5173All[] = "'".$row5173['water_date']." ".$row5173['water_time']."'";
			if($row5173['nwater_value']=="-" || $row5173['nwater_value']=="0" || $row5173['nwater_value']==NULL){
				$data_5173All[] = "null";     				
			}else{
				$data_5173All[] = $row5173['nwater_value']; 												
			}
			$data_5173Full[] = 0;
		}
		mysqli_free_result($q5173);

		$strDate5173All = join( ',', $data_Date5173All);
		$str5173All = join( ',', $data_5173All);
		$str5173Full = join( ',', $data_5173Full);
		// ========================================================

	}else{
		if($stype==2){
			$sitdatetime = $sitdate." ".$sittime;
			$timeend = substr($inittime, 10);

			// $todaydatetime = $today." ".$time;
			// $todaydatetime = $tomorrow." ".$time;
			$todaydatetime = $tomorrow." ".$timeend;
			$yesterdaydatetime = $yesterday." 00:00";

			$sqlimg = "SELECT DATE_FORMAT(created_date, '%Y-%m-%d %H:%i') AS date_img, geo_json_subbasin AS file_subbasin
						FROM radar_bias
						WHERE created_date = '".$inittime."'		
						ORDER BY id ASC";
			$queryimg = mysqli_query($conn,$sqlimg);
			$file_subbasin = mysqli_result($queryimg,0,"file_subbasin");
			$geojson_url = $urlradar2.$file_subbasin;

			// $sqlmap4="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, 
			// 		us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_realtime_warning ur, urbs_station us
			// 		WHERE ur.station IN (SELECT code_all FROM urbs_station)
			// 		AND ur.station = us.code_all 
			// 		AND us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
			// 		AND ur.datetime = '".$sitdatetime."'				
			// 		ORDER BY ur.datetime
			// 		LIMIT 12";
			// update 20220709
			// $sqlmap4="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
			// 		us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_station us 
			// 		LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
			// 		WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
			// 		AND ur.datetime = '".$sitdatetime."'				
			// 		ORDER BY ur.datetime DESC
			// 		LIMIT 12";
			$sqlmap4="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND ur.datetime = '".$inittime."'				
					ORDER BY ur.datetime DESC
					LIMIT 12";
			// echo $sqlmap4."<br>";
			$query4 = mysqli_query($conn,$sqlmap4);

			// $sqlmap4_novalue="SELECT DISTINCT us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_station us	
			// 		WHERE us.code_all NOT IN (SELECT station FROM urbs_realtime_warning WHERE datetime = '".$sitdatetime."')
			// 		AND us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 												
			// 		ORDER BY us.code_all
			// 		LIMIT 12";
			$sqlmap4_novalue="SELECT DISTINCT us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us	
					WHERE us.code_all NOT IN (SELECT station FROM urbs_realtime_warning WHERE datetime = '".$inittime."')
					AND us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 												
					ORDER BY us.code_all
					LIMIT 12";
			// echo $sqlmap4_novalue;
			$query4_novalue = mysqli_query($conn,$sqlmap4_novalue);

			// $sqlmap4over="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
			// 		us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_station us 
			// 		LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
			// 		WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
			// 		AND ur.datetime = '".$sitdatetime."'	
			// 		AND ur.over_th = '1'			
			// 		ORDER BY ur.datetime DESC
			// 		LIMIT 12";
			// // echo $sqlmap4over."<br>";
			// $query4_over = mysqli_query($conn,$sqlmap4over);
			$sqlmap4over="SELECT *
					FROM urbs_realtime_floodmap					
					WHERE datetime = '".$inittime."' AND data_status = 1						
					ORDER BY datetime DESC
					LIMIT 12";
			// echo $sqlmap4over."<br>";
			$query4_over = mysqli_query($conn,$sqlmap4over);
			$floodmap_id = mysqli_result($query4_over,0,"id");
			if(mysqli_num_rows($query4_over)>0){
				$strFloodMap = "<span style='font-size:26px;color:red'> มีพื้นที่น้ำท่วม)</span>";
			}else{
				$strFloodMap = "<span style='font-size:26px;color:blue'> ไม่มีพื้นที่น้ำท่วม)</span>";
			}
			mysqli_data_seek($query4_over,0);

			$sqlRadarStatus="SELECT radar_status
					FROM urbs_realtime_floodmap					
					WHERE datetime = '".$inittime."'
					ORDER BY id DESC, datetime DESC LIMIT 1
					";
			// echo $sqlRadarStatus."<br>";
			$qRadarStatus = mysqli_query($conn,$sqlRadarStatus);
			$radar_status = mysqli_result($qRadarStatus,0,"radar_status");
			// mysqli_data_seek($sqlRadarStatus,0);
			if($radar_status==1){
				$strRadarStatus = "<span style='font-size:26px;color:blue'>(มีข้อมูลฝนเรดาร์</span>";
			}else{
				$strRadarStatus = "<span style='font-size:26px;color:red'>(ไม่มีข้อมูลฝนเรดาร์</span>";
			}

			// ========================================================
			$sqlmry01 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_Z62'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime";

			$data_mry01DateAll = array();
			$data_mry01All = array();
			$data_mry01Full = array();
			$qmry01 = mysqli_query($conn,$sqlmry01);
			$i = 1;
			$idx = 0;
			while($rowmry01=@mysqli_fetch_array($qmry01,MYSQLI_ASSOC)){      
				if($rowmry01['datetime'] == $inittime){ $idx = $i;}

				$data_mry01DateAll[] = "'".$rowmry01['datetime']."'";
				if($rowmry01['nwater_value']=="0"){
					$data_mry01All[] = "null";     					   
				}else{
					$data_mry01All[] = $rowmry01['nwater_value']; 												
				}
				$data_mry01Full[] = $full_mry01;
				$i++;
			}
			mysqli_free_result($qmry01);

			$strmry01DateAll = join( ',', $data_mry01DateAll);
			$strmry01All = join( ',', $data_mry01All);
			$strmry01Full = join( ',', $data_mry01Full);
			// ========================================================
			$sqlmry02 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_02'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry02DateAll = array();
			$data_mry02All = array();
			$data_mry02Full = array();
			$qmry02 = mysqli_query($conn,$sqlmry02);

			while($rowmry02=@mysqli_fetch_array($qmry02,MYSQLI_ASSOC)){      
				$data_mry02DateAll[] = "'".$rowmry02['datetime']."'";
				if($rowmry02['nwater_value']=="0"){
					$data_mry02All[] = "null";     					
				}else{
					$data_mry02All[] = $rowmry02['nwater_value']; 												
				}
				$data_mry02Full[] = $full_mry02;
			}
			mysqli_free_result($qmry02);

			$strmry02DateAll = join( ',', $data_mry02DateAll);
			$strmry02All = join( ',', $data_mry02All);
			$strmry02Full = join( ',', $data_mry02Full);
			// ========================================================
			$sqlmry03 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_03'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry03DateAll = array();
			$data_mry03All = array();
			$data_mry03Full = array();
			$qmry03 = mysqli_query($conn,$sqlmry03);

			while($rowmry03=@mysqli_fetch_array($qmry03,MYSQLI_ASSOC)){      
				$data_mry03DateAll[] = "'".$rowmry03['datetime']."'";
				if($rowmry03['nwater_value']=="0"){
					$data_mry03All[] = "null";     					
				}else{
					$data_mry03All[] = $rowmry03['nwater_value']; 												
				}
				$data_mry03Full[] = $full_mry03;
			}
			mysqli_free_result($qmry03);

			$strmry03DateAll = join( ',', $data_mry03DateAll);
			$strmry03All = join( ',', $data_mry03All);
			$strmry03Full = join( ',', $data_mry03Full);
			// ========================================================
			$sqlmry04 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_RAY004'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry04DateAll = array();
			$data_mry04All = array();
			$data_mry04Full = array();
			$qmry04 = mysqli_query($conn,$sqlmry04);

			while($rowmry04=@mysqli_fetch_array($qmry04,MYSQLI_ASSOC)){      
				$data_mry04DateAll[] = "'".$rowmry04['datetime']."'";
				if($rowmry04['nwater_value']=="0"){
					$data_mry04All[] = "null";     					
				}else{
					$data_mry04All[] = $rowmry04['nwater_value']; 												
				}
				$data_mry04Full[] = $full_mry04;
			}
			mysqli_free_result($qmry04);

			$strmry04DateAll = join( ',', $data_mry04DateAll);
			$strmry04All = join( ',', $data_mry04All);
			$strmry04Full = join( ',', $data_mry04Full);
			// ========================================================
			$sqlmry05 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_05'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry05DateAll = array();
			$data_mry05All = array();
			$data_mry05Full = array();
			$qmry05 = mysqli_query($conn,$sqlmry05);

			while($rowmry05=@mysqli_fetch_array($qmry05,MYSQLI_ASSOC)){      
				$data_mry05DateAll[] = "'".$rowmry05['datetime']."'";
				if($rowmry05['nwater_value']=="0"){
					$data_mry05All[] = "null";     					 
				}else{
					$data_mry05All[] = $rowmry05['nwater_value']; 												
				}
				$data_mry05Full[] = $full_mry05;
			}
			mysqli_free_result($qmry05);

			$strmry05DateAll = join( ',', $data_mry05DateAll);
			$strmry05All = join( ',', $data_mry05All);
			$strmry05Full = join( ',', $data_mry05Full);
			// ========================================================
			$sqlmry06 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_06'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry06DateAll = array();
			$data_mry06All = array();
			$data_mry06Full = array();
			$qmry06 = mysqli_query($conn,$sqlmry06);

			while($rowmry06=@mysqli_fetch_array($qmry06,MYSQLI_ASSOC)){      
				$data_mry06DateAll[] = "'".$rowmry06['datetime']."'";
				if($rowmry06['nwater_value']=="0"){
					$data_mry06All[] = "null";     					   
				}else{
					$data_mry06All[] = $rowmry06['nwater_value']; 												
				}
				$data_mry06Full[] = $full_mry06;
			}
			mysqli_free_result($qmry06);

			$strmry06DateAll = join( ',', $data_mry06DateAll);
			$strmry06All = join( ',', $data_mry06All);
			$strmry06Full = join( ',', $data_mry06Full);
			// ========================================================
			$sqlmry07 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_07'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry07DateAll = array();
			$data_mry07All = array();
			$data_mry07Full = array();
			$qmry07 = mysqli_query($conn,$sqlmry07);

			while($rowmry07=@mysqli_fetch_array($qmry07,MYSQLI_ASSOC)){      
				$data_mry07DateAll[] = "'".$rowmry07['datetime']."'";
				if($rowmry07['nwater_value']=="0"){
					$data_mry07All[] = "null";     					
				}else{
					$data_mry07All[] = $rowmry07['nwater_value']; 												
				}
				$data_mry07Full[] = $full_mry07;
			}
			mysqli_free_result($qmry07);

			$strmry07DateAll = join( ',', $data_mry07DateAll);
			$strmry07All = join( ',', $data_mry07All);
			$strmry07Full = join( ',', $data_mry07Full);
			// ========================================================
			$sqlmry08 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_08'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry08DateAll = array();
			$data_mry08All = array();
			$data_mry08Full = array();
			$qmry08 = mysqli_query($conn,$sqlmry08);

			while($rowmry08=@mysqli_fetch_array($qmry08,MYSQLI_ASSOC)){      
				$data_mry08DateAll[] = "'".$rowmry08['datetime']."'";
				if($rowmry08['nwater_value']=="0"){
					$data_mry08All[] = "null";     					 
				}else{
					$data_mry08All[] = $rowmry08['nwater_value']; 												
				}
				$data_mry08Full[] = 0;
			}
			mysqli_free_result($qmry08);

			$strmry08DateAll = join( ',', $data_mry08DateAll);
			$strmry08All = join( ',', $data_mry08All);
			$strmry08Full = join( ',', $data_mry08Full);
			// ========================================================
			$sqlmtm01 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_Z38'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm01DateAll = array();
			$data_mtm01All = array();
			$data_mtm01Full = array();
			$qmtm01 = mysqli_query($conn,$sqlmtm01);

			while($rowmtm01=@mysqli_fetch_array($qmtm01,MYSQLI_ASSOC)){      
				$data_mtm01DateAll[] = "'".$rowmtm01['datetime']."'";
				if($rowmtm01['nwater_value']=="0"){
					$data_mtm01All[] = "null";     					
				}else{
					$data_mtm01All[] = $rowmtm01['nwater_value']; 												
				}
				$data_mtm01Full[] = $full_mtm01;
			}
			mysqli_free_result($qmtm01);

			$strmtm01DateAll = join( ',', $data_mtm01DateAll);
			$strmtm01All = join( ',', $data_mtm01All);
			$strmtm01Full = join( ',', $data_mtm01Full);
			// ========================================================
			$sqlmtm02 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_02'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm02DateAll = array();
			$data_mtm02All = array();
			$data_mtm02Full = array();
			$qmtm02 = mysqli_query($conn,$sqlmtm02);

			while($rowmtm02=@mysqli_fetch_array($qmtm02,MYSQLI_ASSOC)){      
				$data_mtm02DateAll[] = "'".$rowmtm02['datetime']."'";
				if($rowmtm02['nwater_value']=="0"){
					$data_mtm02All[] = "null";     					
				}else{
					$data_mtm02All[] = $rowmtm02['nwater_value']; 												
				}
				$data_mtm02Full[] = $full_mtm02;
			}
			mysqli_free_result($qmtm02);

			$strmtm02DateAll = join( ',', $data_mtm02DateAll);
			$strmtm02All = join( ',', $data_mtm02All);
			$strmtm02Full = join( ',', $data_mtm02Full);
			// ========================================================
			$sqlmtm03 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_03'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm03DateAll = array();
			$data_mtm03All = array();
			$data_mtm03Full = array();
			$qmtm03 = mysqli_query($conn,$sqlmtm03);

			while($rowmtm03=@mysqli_fetch_array($qmtm03,MYSQLI_ASSOC)){      
				$data_mtm03DateAll[] = "'".$rowmtm03['datetime']."'";
				if($rowmtm03['nwater_value']=="0"){
					$data_mtm03All[] = "null";     					
				}else{
					$data_mtm03All[] = $rowmtm03['nwater_value']; 												
				}
				$data_mtm03Full[] = $full_mtm03;
			}
			mysqli_free_result($qmtm03);

			$strmtm03DateAll = join( ',', $data_mtm03DateAll);
			$strmtm03All = join( ',', $data_mtm03All);
			$strmtm03Full = join( ',', $data_mtm03Full);
			// ========================================================
			$sqlmtm04 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_04'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm04DateAll = array();
			$data_mtm04All = array();
			$data_mtm04Full = array();
			$qmtm04 = mysqli_query($conn,$sqlmtm04);

			while($rowmtm04=@mysqli_fetch_array($qmtm04,MYSQLI_ASSOC)){      
				$data_mtm04DateAll[] = "'".$rowmtm04['datetime']."'";
				if($rowmtm04['nwater_value']=="0"){
					$data_mtm04All[] = "null";     					
				}else{
					$data_mtm04All[] = $rowmtm04['nwater_value']; 												
				}
				$data_mtm04Full[] = $full_mtm04;
			}
			mysqli_free_result($qmtm04);

			$strmtm04DateAll = join( ',', $data_mtm04DateAll);
			$strmtm04All = join( ',', $data_mtm04All);
			$strmtm04Full = join( ',', $data_mtm04Full);
			// ========================================================

		}else{

		}

	}


}else{
	// $today = date('Y-m-d', time());
	$today = date("Y-m-d", strtotime($sitdate));
	// echo $today."<br>";
	$time = date('H', time());
	$time = $time.":00";
	// echo $time."<br>";

	// $yesterday = date('Y-m-d',strtotime("-1 days"));
	$yesterday = date('Y-m-d',strtotime($sitdate." -1 days"));
	// echo $yesterday."<br>";

	// $twodayago = date('Y-m-d',strtotime("-2 days"));
	$twodayago = date('Y-m-d',strtotime($sitdate." -2 days"));
	// echo $twodayago."<br>";

	// $tomorrow = date("Y-m-d", strtotime("+1 day"));
	$tomorrow = date("Y-m-d", strtotime($sitdate." +1 day"));
	// echo $tomorrow."<br>";

	$tomorrow2 = date("Y-m-d", strtotime($sitdate." +2 day"));

	if($stype==1){
		
		// $station_id = 2224;
		// $sqlexp = "SELECT * FROM waterlevel00 WHERE station = '".$station_id."' ORDER BY water_year DESC LIMIT 1;";
		// $qexp = mysqli_query($conn,$sqlexp);
		// $waterlevel00_id = mysqli_result($qexp,0,"id");

		// $sqlexp02 = "SELECT * FROM waterlevel01_1hr WHERE waterlevel00_id = '".$waterlevel00_id."' 
		// 			AND water_date = '".$today."' AND water_time = '".$time."'
		// 			;";
		// echo $sqlexp02;
			
		// $qexp02 = mysqli_query($conn,$sqlexp02);
		// $water_value_2224 = mysqli_result($qexp02,0,"water_value");

		// mysqli_free_result($qexp);
		// mysqli_free_result($qexp02);

		// $sqlmap4="SELECT mb.*, CAST(mb.water_value AS DECIMAL(10,2)) AS nwater_value, mb.waterlevel_id AS waterlevel00_id, d.dept_name_eng				
		// 		FROM mb_station_group_waterlevel mb, station s, department d
		// 		WHERE mb.id = s.STA_GROUP_ID 
		// 		AND mb.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
		// 		AND mb.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
		// 		AND mb.id IN (4328,2224,2225,5172)
		// 		AND s.DEPARTMENT = d.dept_id
		// 		ORDER BY id
		// 		LIMIT 10";
		$sqlmap4="SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.waterlevel_offset AS DECIMAL(10,2)) AS nwater_value, 
				d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
				FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
				WHERE w00.station = sg.id 
				AND w00.id = w01.waterlevel00_id 
				AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
				AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
				AND w00.station IN (4328,2224,2225,5172,5173)
				AND s.DEPARTMENT = d.dept_id
				AND sg.id = s.STA_GROUP_ID
				AND w01.water_date = '".$sitdate."'
				AND w01.water_time = '".$sittime."'
				ORDER BY w01.water_date, w01.water_time
				LIMIT 10";
		// echo $sqlmap4."<br>";
		$query4 = mysqli_query($conn,$sqlmap4);

		$sqlmap4_all="SELECT sg.id, d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM station_group sg, station s, department d
					WHERE sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.id IN (4328,2224,2225,5172,5173)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID					
					LIMIT 10";
		// echo $sqlmap4;
		// echo $sqlmap4_all."<br>";
		$query4_all = mysqli_query($conn,$sqlmap4_all);

		$sqlmap = "SELECT mm.accepted_value,mm.supplied_value,mm.meter_ref_level,
					mm.external_id,mm.shortname,mm.created,mm.lon,mm.lat, mm.created AS created_date, mm.id, mm.meter
					FROM mwm_measurement mm
					WHERE mm.meter IN (7440,7442,7443)				
					AND mm.accepted_value IS NOT NULL
					AND mm.created = '".$sitdate."'
					ORDER BY mm.meter
					";
		// echo $sqlmap;	

		$query = mysqli_query($conn,$sqlmap);

		$sqlmap_all = "SELECT mm.id, mm.code_all,mm.mwm_station_name,mm.longitude AS lon,mm.latitude AS lat, mm.created_date
					FROM mwm_station mm
					WHERE mm.id IN (7440,7442,7443)					
					";
		// echo $sqlmap;				
		$query_all = mysqli_query($conn,$sqlmap_all);

		$sql2224 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.waterlevel_offset AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (2224)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_DateAll = array();
		$data_2224All = array();
		$data_2224Full = array();
		$q2224 = mysqli_query($conn,$sql2224);

		while($row2224=@mysqli_fetch_array($q2224,MYSQLI_ASSOC)){      
			$data_DateAll[] = "'".$row2224['water_date']." ".$row2224['water_time']."'";
			if($row2224['nwater_value']=="-" || $row2224['nwater_value']=="0" || $row2224['nwater_value']==NULL){
				$data_2224All[] = "null";     				
			}else{
				$data_2224All[] = $row2224['nwater_value']; 												
			}
			$data_2224Full[] = $full2224;
		}
		mysqli_free_result($q2224);

		$strDateAll = join( ',', $data_DateAll);
		$str2224All = join( ',', $data_2224All);
		$str2224Full = join( ',', $data_2224Full);
		// ========================================================
		$sql2225 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.waterlevel_offset AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (2225)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date2225All = array();
		$data_2225All = array();
		$data_2225Full = array();
		$q2225 = mysqli_query($conn,$sql2225);

		while($row2225=@mysqli_fetch_array($q2225,MYSQLI_ASSOC)){      
			$data_Date2225All[] = "'".$row2225['water_date']." ".$row2225['water_time']."'";
			if($row2225['nwater_value']=="-" || $row2225['nwater_value']=="0" || $row2225['nwater_value']==NULL){
				$data_2225All[] = "null";     				
			}else{
				$data_2225All[] = $row2225['nwater_value']; 												
			}
			$data_2225Full[] = $full2225;
		}
		mysqli_free_result($q2225);

		$strDate2225All = join( ',', $data_Date2225All);
		$str2225All = join( ',', $data_2225All);
		$str2225Full = join( ',', $data_2225Full);
		// ========================================================
		$sql4328 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (4328)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date4328All = array();
		$data_4328All = array();
		$data_4328Full = array();
		$q4328 = mysqli_query($conn,$sql4328);

		while($row4328=@mysqli_fetch_array($q4328,MYSQLI_ASSOC)){      
			$data_Date4328All[] = "'".$row4328['water_date']." ".$row4328['water_time']."'";
			if($row4328['nwater_value']=="-" || $row4328['nwater_value']=="0" || $row4328['nwater_value']==NULL){
				$data_4328All[] = "null";     				
			}else{
				$data_4328All[] = $row4328['nwater_value']; 												
			}
			$data_4328Full[] = $full4328;
		}
		mysqli_free_result($q4328);

		$strDate4328All = join( ',', $data_Date4328All);
		$str4328All = join( ',', $data_4328All);
		$str4328Full = join( ',', $data_4328Full);
		// ========================================================
		$sql5172 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (5172)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date5172All = array();
		$data_5172All = array();
		$data_5172Full = array();
		$q5172 = mysqli_query($conn,$sql5172);

		while($row5172=@mysqli_fetch_array($q5172,MYSQLI_ASSOC)){      
			$data_Date5172All[] = "'".$row5172['water_date']." ".$row5172['water_time']."'";
			if($row5172['nwater_value']=="-" || $row5172['nwater_value']=="0" || $row5172['nwater_value']==NULL){
				$data_5172All[] = "null";     				
			}else{
				$data_5172All[] = $row5172['nwater_value']; 												
			}
			$data_5172Full[] = 0;
		}
		mysqli_free_result($q5172);

		$strDate5172All = join( ',', $data_Date5172All);
		$str5172All = join( ',', $data_5172All);
		$str5172Full = join( ',', $data_5172Full);
		// ========================================================
		$sql5173 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
					d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
					FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
					WHERE w00.station = sg.id 
					AND w00.id = w01.waterlevel00_id 
					AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND w00.station IN (5173)
					AND s.DEPARTMENT = d.dept_id
					AND sg.id = s.STA_GROUP_ID
					AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
					ORDER BY w01.water_date, w01.water_time";

		$data_Date5173All = array();
		$data_5173All = array();
		$data_5173Full = array();
		$q5173 = mysqli_query($conn,$sql5173);

		while($row5173=@mysqli_fetch_array($q5173,MYSQLI_ASSOC)){      
			$data_Date5173All[] = "'".$row5173['water_date']." ".$row5173['water_time']."'";
			if($row5173['nwater_value']=="-" || $row5173['nwater_value']=="0" || $row5173['nwater_value']==NULL){
				$data_5173All[] = "null";     				
			}else{
				$data_5173All[] = $row5173['nwater_value']; 												
			}
			$data_5173Full[] = 0;
		}
		mysqli_free_result($q5173);

		$strDate5173All = join( ',', $data_Date5173All);
		$str5173All = join( ',', $data_5173All);
		$str5173Full = join( ',', $data_5173Full);
		// ========================================================


	}else{
		if($stype==2){
			$sitdatetime = $sitdate." ".$sittime;
			$timeend = substr($inittime, 10);

			// $todaydatetime = $today." ".$time;
			$todaydatetime = $tomorrow." ".$timeend;
			$yesterdaydatetime = $yesterday." 00:00";

			$sqlimg = "SELECT DATE_FORMAT(created_date, '%Y-%m-%d %H:%i') AS date_img, geo_json_subbasin AS file_subbasin
						FROM radar_bias
						WHERE created_date = '".$inittime."'		
						ORDER BY id ASC";
			$queryimg = mysqli_query($conn,$sqlimg);
			$file_subbasin = mysqli_result($queryimg,0,"file_subbasin");
			$geojson_url = $urlradar2.$file_subbasin;

			// $sqlmap4="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, 
			// 		us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_realtime_warning ur, urbs_station us
			// 		WHERE ur.station IN (SELECT code_all FROM urbs_station)
			// 		AND ur.station = us.code_all 
			// 		AND us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
			// 		AND ur.datetime = '".$sitdatetime."'				
			// 		ORDER BY ur.datetime
			// 		LIMIT 12";
			// $sqlmap4="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
			// 		us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_station us 
			// 		LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
			// 		WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
			// 		AND ur.datetime = '".$sitdatetime."'				
			// 		ORDER BY ur.datetime DESC
			// 		LIMIT 15";
			$sqlmap4="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND ur.datetime = '".$inittime."'				
					ORDER BY ur.datetime DESC
					LIMIT 15";

			// echo $sqlmap4;
			$query4 = mysqli_query($conn,$sqlmap4);

			// $sqlmap4_novalue="SELECT DISTINCT us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_station us	
			// 		WHERE us.code_all NOT IN (SELECT station FROM urbs_realtime_warning WHERE datetime = '".$sitdatetime."')
			// 		AND us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 												
			// 		ORDER BY us.code_all
			// 		LIMIT 12";
			$sqlmap4_novalue="SELECT DISTINCT us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us	
					WHERE us.code_all NOT IN (SELECT station FROM urbs_realtime_warning WHERE datetime = '".$inittime."')
					AND us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 												
					ORDER BY us.code_all
					LIMIT 12";
			// echo $sqlmap4_novalue;
			$query4_novalue = mysqli_query($conn,$sqlmap4_novalue);

			// $sqlmap4over="SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
			// 		us.code_all, us.station_group_name, us.latitude, us.longitude
			// 		FROM urbs_station us 
			// 		LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
			// 		WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
			// 		AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
			// 		AND ur.datetime = '".$sitdatetime."'	
			// 		AND ur.over_th = '1'			
			// 		ORDER BY ur.datetime DESC
			// 		LIMIT 12";
			// // echo $sqlmap4over."<br>";
			// $query4_over = mysqli_query($conn,$sqlmap4over);
			$sqlmap4over="SELECT *
					FROM urbs_realtime_floodmap					
					WHERE datetime = '".$sitdatetime."'	AND data_status = 1					
					ORDER BY datetime DESC
					LIMIT 12";
			// echo $sqlmap4over."<br>";
			$query4_over = mysqli_query($conn,$sqlmap4over);
			$floodmap_id = mysqli_result($query4_over,0,"id");
			if(mysqli_num_rows($query4_over)>0){
				$strFloodMap = "<span style='font-size:26px;color:red'> มีพื้นที่น้ำท่วม)</span>";
			}else{
				$strFloodMap = "<span style='font-size:26px;color:blue'> ไม่มีพื้นที่น้ำท่วม)</span>";
			}
			mysqli_data_seek($query4_over,0);

			$sqlRadarStatus="SELECT radar_status
					FROM urbs_realtime_floodmap					
					WHERE datetime = '".$sitdatetime."'
					ORDER BY id DESC, datetime DESC LIMIT 1
					";
			// echo $sqlRadarStatus."<br>";
			$qRadarStatus = mysqli_query($conn,$sqlRadarStatus);
			$radar_status = mysqli_result($qRadarStatus,0,"radar_status");
			// mysqli_data_seek($sqlRadarStatus,0);
			if($radar_status==1){
				$strRadarStatus = "<span style='font-size:26px;color:blue'>(มีข้อมูลฝนเรดาร์</span>";
			}else{
				$strRadarStatus = "<span style='font-size:26px;color:red'>(ไม่มีข้อมูลฝนเรดาร์</span>";
			}

			// ========================================================
			$sqlmry01 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_Z62'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime";

			$data_mry01DateAll = array();
			$data_mry01All = array();
			$data_mry01Full = array();
			$qmry01 = mysqli_query($conn,$sqlmry01);
			$i = 1;
			$idx = 0;
			while($rowmry01=@mysqli_fetch_array($qmry01,MYSQLI_ASSOC)){      
				// if($rowmry01['datetime'] == $inittime){ $idx = $i;}
				$data_mry01DateAll[] = "'".$rowmry01['datetime']."'";
				if($rowmry01['nwater_value']=="0"){
					$data_mry01All[] = "null";     					
				}else{
					$data_mry01All[] = $rowmry01['nwater_value']; 												
				}
				$data_mry01Full[] = $full_mry01;
				$i++;
			}
			$idx = $i;
			mysqli_free_result($qmry01);

			$strmry01DateAll = join( ',', $data_mry01DateAll);
			$strmry01All = join( ',', $data_mry01All);
			$strmry01Full = join( ',', $data_mry01Full);
			// ========================================================
			$sqlmry02 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_02'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry02DateAll = array();
			$data_mry02All = array();
			$data_mry02Full = array();
			$qmry02 = mysqli_query($conn,$sqlmry02);

			while($rowmry02=@mysqli_fetch_array($qmry02,MYSQLI_ASSOC)){      
				$data_mry02DateAll[] = "'".$rowmry02['datetime']."'";
				if($rowmry02['nwater_value']=="0"){
					$data_mry02All[] = "null";     					
				}else{
					$data_mry02All[] = $rowmry02['nwater_value']; 												
				}
				$data_mry02Full[] = $full_mry02;
			}
			mysqli_free_result($qmry02);

			$strmry02DateAll = join( ',', $data_mry02DateAll);
			$strmry02All = join( ',', $data_mry02All);
			$strmry02Full = join( ',', $data_mry02Full);
			// ========================================================
			$sqlmry03 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_03'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry03DateAll = array();
			$data_mry03All = array();
			$data_mry03Full = array();
			$qmry03 = mysqli_query($conn,$sqlmry03);

			while($rowmry03=@mysqli_fetch_array($qmry03,MYSQLI_ASSOC)){      
				$data_mry03DateAll[] = "'".$rowmry03['datetime']."'";
				if($rowmry03['nwater_value']=="0"){
					$data_mry03All[] = "null";     					
				}else{
					$data_mry03All[] = $rowmry03['nwater_value']; 												
				}
				$data_mry03Full[] = $full_mry03;
			}
			mysqli_free_result($qmry03);

			$strmry03DateAll = join( ',', $data_mry03DateAll);
			$strmry03All = join( ',', $data_mry03All);
			$strmry03Full = join( ',', $data_mry03Full);
			// ========================================================
			$sqlmry04 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_RAY004'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry04DateAll = array();
			$data_mry04All = array();
			$data_mry04Full = array();
			$qmry04 = mysqli_query($conn,$sqlmry04);

			while($rowmry04=@mysqli_fetch_array($qmry04,MYSQLI_ASSOC)){      
				$data_mry04DateAll[] = "'".$rowmry04['datetime']."'";
				if($rowmry04['nwater_value']=="0"){
					$data_mry04All[] = "null";     					
				}else{
					$data_mry04All[] = $rowmry04['nwater_value']; 												
				}
				$data_mry04Full[] = $full_mry04;
			}
			mysqli_free_result($qmry04);

			$strmry04DateAll = join( ',', $data_mry04DateAll);
			$strmry04All = join( ',', $data_mry04All);
			$strmry04Full = join( ',', $data_mry04Full);
			// ========================================================
			$sqlmry05 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_05'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry05DateAll = array();
			$data_mry05All = array();
			$data_mry05Full = array();
			$qmry05 = mysqli_query($conn,$sqlmry05);

			while($rowmry05=@mysqli_fetch_array($qmry05,MYSQLI_ASSOC)){      
				$data_mry05DateAll[] = "'".$rowmry05['datetime']."'";
				if($rowmry05['nwater_value']=="0"){
					$data_mry05All[] = "null";     					
				}else{
					$data_mry05All[] = $rowmry05['nwater_value']; 												
				}
				$data_mry05Full[] = $full_mry05;
			}
			mysqli_free_result($qmry05);

			$strmry05DateAll = join( ',', $data_mry05DateAll);
			$strmry05All = join( ',', $data_mry05All);
			$strmry05Full = join( ',', $data_mry05Full);
			// ========================================================
			$sqlmry06 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_06'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry06DateAll = array();
			$data_mry06All = array();
			$data_mry06Full = array();
			$qmry06 = mysqli_query($conn,$sqlmry06);

			while($rowmry06=@mysqli_fetch_array($qmry06,MYSQLI_ASSOC)){      
				$data_mry06DateAll[] = "'".$rowmry06['datetime']."'";
				if($rowmry06['nwater_value']=="0"){
					$data_mry06All[] = "null";     					
				}else{
					$data_mry06All[] = $rowmry06['nwater_value']; 												
				}
				$data_mry06Full[] = $full_mry06;
			}
			mysqli_free_result($qmry06);

			$strmry06DateAll = join( ',', $data_mry06DateAll);
			$strmry06All = join( ',', $data_mry06All);
			$strmry06Full = join( ',', $data_mry06Full);
			// ========================================================
			$sqlmry07 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_07'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry07DateAll = array();
			$data_mry07All = array();
			$data_mry07Full = array();
			$qmry07 = mysqli_query($conn,$sqlmry07);

			while($rowmry07=@mysqli_fetch_array($qmry07,MYSQLI_ASSOC)){      
				$data_mry07DateAll[] = "'".$rowmry07['datetime']."'";
				if($rowmry07['nwater_value']=="0"){
					$data_mry07All[] = "null";     					
				}else{
					$data_mry07All[] = $rowmry07['nwater_value']; 												
				}
				$data_mry07Full[] = $full_mry07;
			}
			mysqli_free_result($qmry07);

			$strmry07DateAll = join( ',', $data_mry07DateAll);
			$strmry07All = join( ',', $data_mry07All);
			$strmry07Full = join( ',', $data_mry07Full);
			// ========================================================
			$sqlmry08 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MRY_08'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mry08DateAll = array();
			$data_mry08All = array();
			$data_mry08Full = array();
			$qmry08 = mysqli_query($conn,$sqlmry08);

			while($rowmry08=@mysqli_fetch_array($qmry08,MYSQLI_ASSOC)){      
				$data_mry08DateAll[] = "'".$rowmry08['datetime']."'";
				if($rowmry08['nwater_value']=="0"){
					$data_mry08All[] = "null";     					
				}else{
					$data_mry08All[] = $rowmry08['nwater_value']; 												
				}
				$data_mry08Full[] = 0;
			}
			mysqli_free_result($qmry08);

			$strmry08DateAll = join( ',', $data_mry08DateAll);
			$strmry08All = join( ',', $data_mry08All);
			$strmry08Full = join( ',', $data_mry08Full);
			// ========================================================
			$sqlmtm01 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_Z38'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm01DateAll = array();
			$data_mtm01All = array();
			$data_mtm01Full = array();
			$qmtm01 = mysqli_query($conn,$sqlmtm01);

			while($rowmtm01=@mysqli_fetch_array($qmtm01,MYSQLI_ASSOC)){      
				$data_mtm01DateAll[] = "'".$rowmtm01['datetime']."'";
				if($rowmtm01['nwater_value']=="0"){
					$data_mtm01All[] = "null";     					
				}else{
					$data_mtm01All[] = $rowmtm01['nwater_value']; 												
				}
				$data_mtm01Full[] = $full_mtm01;
			}
			mysqli_free_result($qmtm01);

			$strmtm01DateAll = join( ',', $data_mtm01DateAll);
			$strmtm01All = join( ',', $data_mtm01All);
			$strmtm01Full = join( ',', $data_mtm01Full);
			// ========================================================
			$sqlmtm02 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_02'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm02DateAll = array();
			$data_mtm02All = array();
			$data_mtm02Full = array();
			$qmtm02 = mysqli_query($conn,$sqlmtm02);

			while($rowmtm02=@mysqli_fetch_array($qmtm02,MYSQLI_ASSOC)){      
				$data_mtm02DateAll[] = "'".$rowmtm02['datetime']."'";
				if($rowmtm02['nwater_value']=="0"){
					$data_mtm02All[] = "null";     					
				}else{
					$data_mtm02All[] = $rowmtm02['nwater_value']; 												
				}
				$data_mtm02Full[] = $full_mtm02;
			}
			mysqli_free_result($qmtm02);

			$strmtm02DateAll = join( ',', $data_mtm02DateAll);
			$strmtm02All = join( ',', $data_mtm02All);
			$strmtm02Full = join( ',', $data_mtm02Full);
			// ========================================================
			$sqlmtm03 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_03'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm03DateAll = array();
			$data_mtm03All = array();
			$data_mtm03Full = array();
			$qmtm03 = mysqli_query($conn,$sqlmtm03);

			while($rowmtm03=@mysqli_fetch_array($qmtm03,MYSQLI_ASSOC)){      
				$data_mtm03DateAll[] = "'".$rowmtm03['datetime']."'";
				if($rowmtm03['nwater_value']=="0"){
					$data_mtm03All[] = "null";     					
				}else{
					$data_mtm03All[] = $rowmtm03['nwater_value']; 												
				}
				$data_mtm03Full[] = $full_mtm03;
			}
			mysqli_free_result($qmtm03);

			$strmtm03DateAll = join( ',', $data_mtm03DateAll);
			$strmtm03All = join( ',', $data_mtm03All);
			$strmtm03Full = join( ',', $data_mtm03Full);
			// ========================================================
			$sqlmtm04 = "SELECT ur.station, ur.datetime, CAST(ur.q AS DECIMAL(10,2)) AS nwater_value, ur.area, ur.over_th, 
					us.code_all, us.station_group_name, us.latitude, us.longitude
					FROM urbs_station us 
					LEFT JOIN urbs_realtime_warning ur ON us.code_all = ur.station
					WHERE us.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
					AND us.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 				
					AND us.code_all = 'MTM_04'								
					AND CAST(ur.datetime AS DATETIME) BETWEEN CAST('".$yesterdaydatetime."' AS DATETIME) AND CAST('".$todaydatetime."' AS DATETIME)
					ORDER BY ur.datetime ";

			$data_mtm04DateAll = array();
			$data_mtm04All = array();
			$data_mtm04Full = array();
			$qmtm04 = mysqli_query($conn,$sqlmtm04);

			while($rowmtm04=@mysqli_fetch_array($qmtm04,MYSQLI_ASSOC)){      
				$data_mtm04DateAll[] = "'".$rowmtm04['datetime']."'";
				if($rowmtm04['nwater_value']=="0"){
					$data_mtm04All[] = "null";     					
				}else{
					$data_mtm04All[] = $rowmtm04['nwater_value']; 												
				}
				$data_mtm04Full[] = $full_mtm04;
			}
			mysqli_free_result($qmtm04);

			$strmtm04DateAll = join( ',', $data_mtm04DateAll);
			$strmtm04All = join( ',', $data_mtm04All);
			$strmtm04Full = join( ',', $data_mtm04Full);
			// ========================================================

		}else{

		}

	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<!-- <title>Modern an Admin Panel Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title> -->
<title>RADAR4FLOOD | การประเมินปริมาณน้ำฝนเชิงพื้นที่ความละเอียดสูงด้วยเรดาร์</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" type="text/css" href="../css/jquery.CalendarHeatmap.min.css">
 <!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="../css/lines.css" rel='stylesheet' type='text/css' />
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Nav CSS -->
<link href="../css/custom.css" rel="stylesheet">
<!-- Graph JavaScript -->
<script src="../js/d3.v3.js"></script>
<script src="../js/rickshaw.js"></script>
<!---//webfonts--->  
<!-- chart -->
<!-- <script src="../js/Chart.js"></script> -->
<!-- //chart -->
<script src="../js/jquery.hottie.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="../js/jquery.CalendarHeatmap.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/maps/modules/map.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/offline-exporting.js"></script>

<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script src="http://code.highcharts.com/modules/heatmap.js"></script>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<style type="text/css">
.leaflet-popup {
	position: absolute;
	text-align: center;
	margin-bottom: 20px;
	}
.leaflet-popup-content-wrapper {
	padding: 1px;
	text-align: left;
	border-radius: 12px;
	}
.leaflet-popup-content {
	width:800px;
	margin: 13px 19px;
	line-height: 1.4;
	}
	.leaflet-popup-content p {
	margin: 18px 0;
	}
.leaflet-popup-tip-container {
	width: 40px;
	height: 20px;
	position: absolute;
	left: 50%;
	margin-left: -20px;
	overflow: hidden;
	pointer-events: none;
	}
.leaflet-popup-tip {
	width: 17px;
	height: 17px;
	padding: 1px;

	margin: -10px auto 0;
	transform: rotate(45deg);
	}
.leaflet-popup-content-wrapper,
.leaflet-popup-tip {
	background: white;
	color: #333;
	box-shadow: 0 3px 14px rgba(0,0,0,0.4);
	}
.leaflet-container a.leaflet-popup-close-button {
	position: absolute;
	top: 0;
	right: 0;
	padding: 4px 4px 0 0;
	border: none;
	text-align: center;
	width: 18px;
	height: 14px;
	font: 16px/14px Tahoma, Verdana, sans-serif;
	color: #c3c3c3;
	text-decoration: none;
	font-weight: bold;
	background: transparent;
	}
.leaflet-container a.leaflet-popup-close-button:hover {
	color: #999;
	}
.leaflet-popup-scrolled {
	overflow: auto;
	border-bottom: 1px solid #ddd;
	border-top: 1px solid #ddd;
	}
textarea {
	margin:0px 0px;    
	min-height:16px;
	line-height:22px;
	display:block;
	margin:0px auto;
	width: 100%;
	font-size: 0.85em;
	font-weight: 300;    
	border: 1px solid #e0e0e0;
	padding: 5px 8px;
	color: #616161;
}
</style>
<style>
/* #map { width: 800px; height: 500px; } */
.info { 
	padding: 6px 8px; 
	font: 14px/16px Arial, Helvetica, sans-serif; 
	background: white; 
	background: rgba(255,255,255,0.8); 
	box-shadow: 0 0 15px rgba(0,0,0,0.2); 
	border-radius: 5px; 
} 
.info h4 { margin: 0 0 5px; color: #777; }
.legend { 
	text-align: left; line-height: 18px; color: #555; 
} 
.legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
</style>
<style type="text/css">
    @media (min-width: 768px) {
      .modal-xl {
        width: 98%;
       	max-width:1300px;
      }
    }

	ul li a:hover, ul li a:focus {
	color:green;
	}
	a.ex3:hover, a.ex3:active {background: red;}

	pre#csv {
    display: none;
	}

	.column {
		float: left;
		width: 33.33%;
		padding: 10px;		
	}
	</style>
</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../dashboard.php">
					<img src="../images/logo.png" alt=""/>
					<!-- <img src="images/R4R2.png" width="48px"> -->
				</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
	        		<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-comments-o"></i><span class="badge">4</span></a> -->
	                <!-- <ul class="dropdown-menu">
						<li class="dropdown-menu-header">
							<strong>Messages</strong>
							<div class="progress thin">
							  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
							    <span class="sr-only">40% Complete (success)</span>
							  </div>
							</div>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="images/1.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
								<span class="label label-info">NEW</span>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="images/2.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
								<span class="label label-info">NEW</span>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="images/3.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="images/4.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="images/5.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="avatar">
							<a href="#">
								<img src="images/pic1.png" alt=""/>
								<div>New message</div>
								<small>1 minute ago</small>
							</a>
						</li>
						<li class="dropdown-menu-footer text-center">
							<a href="#">View all messages</a>
						</li>	
	        		</ul> -->
	      		</li>
				  <?php
					include ('../topmenu.php');
				  ?>
				</ul>
						<!-- <form class="navbar-form navbar-right">
              <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
            </form> -->
            <?php
			include ('../sidebar.php');
			?>
        </nav>
		<div id="page-wrapper">
			<div class="col-md-12 graphs">
				<div class="xs" style="font-size:15px;padding: 5px 5px 5px 5px;" align="right">        
				<a href="<?php echo BASE_URL;?>dashboard.php">หน้าหลัก</a> / รายงานสถานการณ์<?php echo $strSitTitle;?>
				</div>
				<div class="xs">
					<h4 style="font-size:32px;">รายงานสถานการณ์<?php echo $strSitTitle;?></h4>
					<?php // echo $sqlmap4."<br>";?>
					<?php // echo $sqlmap4_novalue;?>
					<?php // echo $sitdate." ".$sittime."<br>";?>
					<?php // echo $timeIndex." ".$curtimeIndex;?>
					<?php // echo count($data_2224Full);?>
					<?php // echo count($data_mry01Full);?>
					<!-- <br />					 -->
					<!-- <div class="clearfix"> </div> -->
					<div class="row">                                        
						<div class="col-md-12" align="right">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">+ เพิ่มข้อมูลรายงานสถานการณ์</button> -->
						</div>
						<div class="clearfix"> </div>
                	</div> 										
                    <br />
					<div class="tab-pane active" id="horizontal-form" style="background-color: white;">
				
                    
						<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<div class="form-group">
							</div>
							<div class="form-group">
								<div class="row">
									<!-- <label for="focusedinput" class="col-sm-2 control-label">วันที่เริ่มต้น</label> -->
									<label for="focusedinput" class="col-sm-2 control-label">วันที่</label>
									<?php
									if($stype==1){
									?>
									<div class="col-sm-2">
										<input type="date" class="form-control1" id="sitdate" name="sitdate" placeholder="Default Input" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
										<!-- <select name="sitdate" id="sitdate" class="form-control1" required>
                                        	<option value="">--- เลือกวันที่ ---</option>
											<option value="<?php echo $today;?>"><?php echo $today;?></option>
											<option value="<?php echo $yesterday;?>"><?php echo $yesterday;?></option>
											<option value="<?php echo $twodayago;?>"><?php echo $twodayago;?></option>
										</select> -->
									</div>
									<?php
									}else{
									?>
									<div class="col-sm-2">
										<input type="date" class="form-control1" id="sitdate" name="sitdate" placeholder="Default Input" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
										<!-- <select name="sitdate" id="sitdate" class="form-control1" required>
                                        	<option value="">--- เลือกวันที่ ---</option>
											<option value="<?php echo $tomorrow;?>"><?php echo $tomorrow;?></option>
											<option value="<?php echo $today;?>"><?php echo $today;?></option>
											<option value="<?php echo $yesterday;?>"><?php echo $yesterday;?></option>
										</select> -->
									</div>
									<?php
									}
									?>
									<label for="focusedinput" class="col-sm-1 control-label">เวลา</label>
									<div class="col-sm-2">
										<!-- <input type="date" class="form-control1" id="end_date" name="end_date" placeholder="Default Input" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"> -->
										<select name="sittime" id="sittime" class="form-control1" required>
                                        	<option value="">--- เลือกเวลา ---</option>
											<option value="00:00">00:00</option>
											<option value="01:00">01:00</option>
											<option value="02:00">02:00</option>
											<option value="03:00">03:00</option>
											<option value="04:00">04:00</option>
											<option value="05:00">05:00</option>
											<option value="06:00">06:00</option>
											<option value="07:00">07:00</option>
											<option value="08:00">08:00</option>
											<option value="09:00">09:00</option>
											<option value="10:00">10:00</option>
											<option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
											<option value="13:00">13:00</option>
											<option value="14:00">14:00</option>
											<option value="15:00">15:00</option>
											<option value="16:00">16:00</option>
											<option value="17:00">17:00</option>
											<option value="18:00">18:00</option>
											<option value="19:00">19:00</option>
											<option value="20:00">20:00</option>
											<option value="21:00">21:00</option>
											<option value="22:00">22:00</option>
											<option value="23:00">23:00</option>
										</select>
									</div>
								</div>                            
							</div>							
							<div class="panel-footer">
								<div class="row">
									<div class="col-sm-8 col-sm-offset-2">
										<button class="btn-success btn" type="submit">แสดงข้อมูล</button>
										<button class="btn-inverse btn" type="reset">ล้างข้อมูล</button>
									</div>
								</div>
							</div>
						</form>					
					</div>
					<?php 
					if(isset($_POST['sitdate']) && isset($_POST['sittime'])){  
					?>
					<div class="row">                                        
						<div class="col-md-6" align="left">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">< เวลาก่อนหน้า</button> -->
							<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<input type="hidden" id="sitdate" name="sitdate" value="<?php echo $prev_sitdate;?>">
							<input type="hidden" id="sittime" name="sittime" value="<?php echo $prev_sittime;?>">
							<button class="btn-success btn" type="submit">< เวลาก่อนหน้า</button>
							</form>
						</div>
						<div class="col-md-6" align="right">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">เวลาถัดไป ></button> -->
							<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<input type="hidden" id="sitdate" name="sitdate" value="<?php echo $next_sitdate;?>">
							<input type="hidden" id="sittime" name="sittime" value="<?php echo $next_sittime;?>">
							<button class="btn-success btn" type="submit">เวลาถัดไป ></button>
							</form>
						</div>
						<div class="clearfix"> </div>
                	</div> 	
					<?php
					}else{
						if($stype==1){
					?>
					<div class="row">                                        
						<div class="col-md-6" align="left">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">< เวลาก่อนหน้า</button> -->
							<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<input type="hidden" id="sitdate" name="sitdate" value="<?php echo $prev_sitdate;?>">
							<input type="hidden" id="sittime" name="sittime" value="<?php echo $prev_sittime;?>">
							<button class="btn-success btn" type="submit">< เวลาก่อนหน้า</button>
							</form>
						</div>
						<div class="col-md-6" align="right">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">เวลาถัดไป ></button> -->
							<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<input type="hidden" id="sitdate" name="sitdate" value="<?php echo $next_sitdate;?>">
							<input type="hidden" id="sittime" name="sittime" value="<?php echo $next_sittime;?>">
							<button class="btn-success btn" type="submit">เวลาถัดไป ></button>
							</form>
						</div>
						<div class="clearfix"> </div>
                	</div>
					<?php
						}
						if($stype==2){
					?>
					<div class="row">                                        
						<div class="col-md-6" align="left">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">< เวลาก่อนหน้า</button> -->
							<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<input type="hidden" id="sitdate" name="sitdate" value="<?php echo $prev_curdate;?>">
							<input type="hidden" id="sittime" name="sittime" value="<?php echo $prev_curtime;?>">
							<button class="btn-success btn" type="submit">< เวลาก่อนหน้า</button>
							</form>
						</div>
						<div class="col-md-6" align="right">
							<!-- <button class="btn-primary btn" onclick="location.href='new_situation.php'">เวลาถัดไป ></button> -->
							<form class="form-horizontal" action="situation_report.php" method="post" enctype="multipart/form-data">
							<input type="hidden" id="stype" name="stype" value="<?php echo $stype;?>">
							<input type="hidden" id="sitdate" name="sitdate" value="<?php echo $next_curdate;?>">
							<input type="hidden" id="sittime" name="sittime" value="<?php echo $next_curtime;?>">
							<button class="btn-success btn" type="submit">เวลาถัดไป ></button>
							</form>
						</div>
						<div class="clearfix"> </div>
                	</div>
					<?php
						}
					}
					?>

                    <br />

					<div class="panel panel-success" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
						<div class="panel-heading">
							<h2 style="font-size:20px">รายการข้อมูลสถานการณ์</h2>
							<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
						</div>	
						<?php 
						if($stype==1){
							// echo $sqlmap4."<br>";
							// echo $strDateAll."<br>";
							// echo $str4328All ."<br>";
							// echo $str2224Full  ."<br>";
							// echo $sql2224."<br>";
						?>
						<div class="panel-body no-padding" style="display: block;">
						<!-- สถานการณ์ 24 ชั่วโมงย้อนหลังของวันที่ <?php // echo $sitdate;?> ณ เวลา <?php // echo $sittime;?> น. -->
						สถานการณ์น้ำรายชั่วโมง ระหว่างวันที่ ถึง <?php echo $twodayago;?> เวลา <?php echo "00:00";?> น. <?php echo $sitdate;?> เวลา <?php echo $sittime;?> น.
						</div>					
						<div id="container-test" class="container" style="height: 300px;"></div>	
						<br>
						<div class="container">
							<div class="row">	
								<div class="col-xs-3">						
									&nbsp;
								</div>
								<div class="col-xs-3" style="border:3px solid;border-color:#a6a6a6;text-align:center;color: black;">
									<!-- <h2>Column 2</h2> -->
									<p>วันเวลาที่เลือกในอดีต</p>
								</div>
								<div class="col-xs-3" style="border:3px solid;border-color:#73b2ff;text-align:center;color: black;">
									<!-- <h2>Column 3</h2> -->
									<p>วันเวลาปัจจุบัน</p>
								</div>
								<div class="col-xs-3">						
									&nbsp;
								</div>
							</div>
						</div>
						<br>
						<div class="container">
							<div class="row">
								<div class="column" style="background-color:#0f9c4d;text-align:center;color: white;">
									<!-- <h2>Column 1</h2> -->
									<p>ปกติ</p>
								</div>
								<div class="column" style="background-color:#ffc107;text-align:center;color: white;">
									<!-- <h2>Column 2</h2> -->
									<p>เฝ้าระวัง</p>
								</div>
								<div class="column" style="background-color:#c4463a;text-align:center;color: white;">
									<!-- <h2>Column 3</h2> -->
									<p>วิกฤติ</p>
								</div>
							</div>
						</div>
						<br>
						<div class="panel-body no-padding" style="display: block;">
						<p>สถานการณ์น้ำรายชั่วโมง ณ วันที่ <?php echo $sitdate;?> เวลา <?php echo $sittime;?> น.</p>
						<br>
						<?php
						if($_SESSION["utype"]==1){
						?>
						<button id="xlsx" class="btn-info btn" onclick="location.href='download_situation_waterlevel.php?stype=1&ftype=xlsx&sdate=<?php echo $twodayago;?>&edate=<?php echo $today;?>';">ส่งออกข้อมูลระดับน้ำจากสถานีตรวจวัด</button>
						<?php
						}
						?>
						</div>
						
						<!-- <div class="panel-body no-padding" style="display: block;"> 
							<div id="heatmap-1"></div>
						</div> -->
						<?php
						}else{
							// echo $sqlmry03."<br>";
							// echo $strmry01DateAll."<br>";
							// echo $strmry01All."<br>";
							// echo $strmry01Full."<br>";
							// echo $sqlimg."<br>";
							// echo $file_subbasin."<br>";
							// echo $geojson_url."<br>"; 
							// echo $sqlmap4over."<br>";	
							// echo $sqlRadarStatus."<br>";							
						?>
						<div class="panel-body no-padding" style="display: block;">
						<!-- สถานการณ์ 24 ชั่วโมงย้อนหลังและพยากรณ์ล่วงหน้า 24 ชั่วโมงของวันที่ <?php //echo $sitdate;?> ณ เวลา <?php //echo $sittime;?> น. -->
						<!-- สถานการณ์น้ำรายชั่วโมง ระหว่างวันที่ ถึง <?php //echo $yesterday;?> เวลา <?php //echo "00:00";?> น. <?php //echo $tomorrow;?> เวลา <?php //echo $sittime;?> น. -->
						สถานการณ์น้ำรายชั่วโมง ระหว่างวันที่ ถึง <?php echo $yesterday;?> เวลา <?php echo "00:00";?> น. <?php echo $tomorrow;?> เวลา <?php echo $timeend;?> น.
						</div>										
						<div id="container-test2" class="container" style="height: 300px;"></div>	
						<br>
						<div class="container">
							<div class="row">	
								<div class="col-xs-3">						
									&nbsp;
								</div>
								<div class="col-xs-3" style="border:3px solid;border-color:#a6a6a6;text-align:center;color: black;">
									<!-- <h2>Column 2</h2> -->
									<p>วันเวลาที่เลือก</p>
								</div>
								<div class="col-xs-3" style="border:3px solid;border-color:#73b2ff;text-align:center;color: black;">
									<!-- <h2>Column 3</h2> -->
									<p>วันเวลาปัจจุบัน</p>
								</div>
								<div class="col-xs-3">						
									&nbsp;
								</div>
							</div>
						</div>
						<br>
						<div class="container">
							<div class="row">
								<div class="column" style="background-color:#0f9c4d;text-align:center;color: white;">
									<!-- <h2>Column 1</h2> -->
									<p>ปกติ</p>
								</div>
								<div class="column" style="background-color:#ffc107;text-align:center;color: white;">
									<!-- <h2>Column 2</h2> -->
									<p>เฝ้าระวัง</p>
								</div>
								<div class="column" style="background-color:#c4463a;text-align:center;color: white;">
									<!-- <h2>Column 3</h2> -->
									<p>วิกฤติ</p>
								</div>
							</div>
						</div>
						<br>
						<div class="panel-body no-padding" style="display: block;">
						<!-- <p>สถานการณ์น้ำรายชั่วโมง ณ วันที่ <?php //echo $sitdate;?> ณ เวลา <?php //echo $sittime;?> น.</p> -->
						<p>สถานการณ์น้ำรายชั่วโมง ณ วันที่ <?php echo $sitdate;?> ณ เวลา <?php echo $timeend;?> น. <?php echo $strRadarStatus.$strFloodMap;?></p>
						<br>
						<?php
						if($_SESSION["utype"]==1){
						?>
						<button id="rainfall" class="btn-info btn" onclick="location.href='download_situation_rainfall.php?stype=2&ftype=xlsx&sdate=<?php echo $yesterday;?>&edate=<?php echo $tomorrow2;?>';">ส่งออกข้อมูลน้ำฝนลุ่มน้ำย่อย</button>
						<button id="runoff" class="btn-info btn" onclick="location.href='download_situation_runoff.php?stype=2&ftype=xlsx&sdate=<?php echo $yesterday;?>&edate=<?php echo $tomorrow2;?>';">ส่งออกข้อมูลอัตราการไหล ณ ตำแหน่งเฝ้าระวัง</button>
						<button id="floodmap" class="btn-info btn" onclick="location.href='download_situation_floodmap.php?stype=2&ftype=geojson&sdate=<?php echo $yesterday;?>&edate=<?php echo $tomorrow;?>';">ส่งออกแผนที่น้ำท่วม</button>
						<?php
						}
						?>
						</div>						
						<?php
						}
						?>												
						<!-- <div class="col-md-12 widget_1_box2">							 -->
						<div class="panel-body no-padding" style="display: block;">
							<div id="mapid" style="width: 100%; height: 620px;"></div>
							<script src="../dist/bundle.js"></script>
							<script>

								// get color depending on population density value
								// function getColorRain(d) {
								// 	return d > 1000 ? '#800026' :
								// 			d > 500  ? '#BD0026' :
								// 			d > 200  ? '#E31A1C' :
								// 			d > 100  ? '#FC4E2A' :
								// 			d > 50   ? '#FD8D3C' :
								// 			d > 20   ? '#FEB24C' :
								// 			d > 10   ? '#FED976' :
								// 						'#FFEDA0';
								// }
								// function getColorRain(d) {
								// 	return d > 1000 ? '#ef7972' :
								// 			d > 500  ? '#ef7972' :
								// 			d > 91  ? '#ef7972' :
								// 			d > 36  ? '#ef7972' :
								// 			d > 35   ? '#f7d151' :
								// 			d > 11   ? '#f7d151' :
								// 			d > 10   ? '#0f9c4d' :
								// 			d > 0.1   ? '#0f9c4d' :
								// 						'#ffffff';
								// }
								function getColorRain(d) {
									return d > 1000 ? '#8e0ccf' :
											d > 50.1  ? '#8e0ccf' :
											d > 50  ? '#ef7972' :
											d > 25.1  ? '#ef7972' :
											d > 25   ? '#f7d151' :
											d > 5.1   ? '#f7d151' :
											d > 5   ? '#0f9c4d' :
											d > 0.1   ? '#0f9c4d' :
														'#ffffff';
								}

								function style(feature) {
									return {
										weight: 2,
										opacity: 1,
										color: 'white',
										dashArray: '3',
										fillOpacity: 0.7,
										fillColor: getColor(feature.properties.density)
									};
								}

								function highlightFeature(e) {
									var layer = e.target;

									layer.setStyle({
										weight: 5,
										color: '#666',
										dashArray: '',
										fillOpacity: 0.7
									});

									if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
										layer.bringToFront();
									}

									info.update(layer.feature.properties);
								}

								// var greenIcon = L.icon({
								// 	iconUrl: './images/mwm_green.png',
								// 	iconSize:     [20, 20], // size of the icon
								// 	// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
								// 	popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								// });

								var greenIcon = L.icon({
									iconUrl: '../images/mwm_green.png',
									iconSize:     [20, 20], // size of the icon
									// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
									popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								});

								var redRainIcon = L.icon({
									iconUrl: '../images/red.png',
									iconSize:     [12, 12], // size of the icon
									// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
									popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								});

								var redWLIcon = L.icon({
									iconUrl: '../images/wl_red.png',
									// iconSize:     [8, 8], // size of the icon
									iconSize:     [16, 16], // size of the icon
									// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
									popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								});

								var yellowWLIcon = L.icon({
									iconUrl: '../images/wl_yellow.png',
									// iconSize:     [8, 8], // size of the icon
									iconSize:     [16, 16], // size of the icon
									// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
									popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								});

								var greenWLIcon = L.icon({
									iconUrl: '../images/wl_green.png',
									// iconSize:     [8, 8], // size of the icon
									iconSize:     [16, 16], // size of the icon
									// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
									popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								});

								var blankWLIcon = L.icon({
									iconUrl: '../images/wl_grey.png',
									// iconSize:     [8, 8], // size of the icon
									iconSize:     [16, 16], // size of the icon
									// iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
									popupAnchor:  [-3, -12] // point from which the popup should open relative to the iconAnchor
								});

								// var mymap = L.map('mapid').setView([12.78, 101.2], 12);
								// var mymap = L.map('mapid').setView([12.72682, 101.30041], 12);	
								var mymap = L.map('mapid').setView([12.751935, 101.300753], 12);	

								var streets = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
									maxZoom: 18,
									attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
										'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
									id: 'mapbox/streets-v11',
									tileSize: 512,
									zoomOffset: -1
								}).addTo(mymap);

								var printer = L.easyPrint({
									tileLayer: streets,
									sizeModes: ['Current', 'A4Landscape', 'A4Portrait'],
									filename: 'myMap',
									exportOnly: true,
									hideControlContainer: false
								}).addTo(mymap);

								var imageUrl ='../images/river_name_transparent.png',								
								// // imageBounds = [[topleft], [bottomright]];
								imageBounds = [[12.995659, 101.066128], [12.650766, 101.594496]];
								var pngOverlay = L.imageOverlay(imageUrl, imageBounds, {opacity: 1.0}).addTo(mymap);
								
								//logo position: bottomright, topright, topleft, bottomleft
								var logo = L.control({position: 'bottomleft'});
								logo.onAdd = function(map){
									var div = L.DomUtil.create('div', 'myclass');
									div.innerHTML= "<img src='../images/logo_map.png'/>";
									return div;
								}
								logo.addTo(mymap);

								<?php
								if($stype==2){	 
								?>
								var imageUrl2 ='../images/subbasin_URBS_name_transparent.png',								
								// // imageBounds = [[topleft], [bottomright]];
								imageBounds2 = [[12.995859, 101.040914 ], [12.65052, 101.619666]];
								var pngOverlay2 = L.imageOverlay(imageUrl2, imageBounds2, {opacity: 1.0}).addTo(mymap);
								<?php
								}
								?>
								<?php

									// $sqlmap = "SELECT DISTINCT m.id, m.code_all, m.mwm_station_name, m.latitude, m.longitude
									// 			FROM mwm_station m												
									// 			WHERE m.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
									// 			AND m.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
									// 			AND m.mwm_station_type = 2
									// 			GROUP BY m.id
									// 			ORDER BY m.province, m.id";
									
									// $query = mysqli_query($conn,$sqlmap);
									
									

								?>
								
								<?php				
																 
								if($stype==1){									
								?>
								
								var popup2224 = L.popup().setContent('<p style="font-size:100%;"><b>สถานีวัดระดับน้ำ</b><br />Z.62 (คลองใหญ่)</p><div id="container" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popup2225 = L.popup().setContent('<p style="font-size:100%;"><b>สถานีวัดระดับน้ำ</b><br />Z.38 (คลองทับมา บ้านเขาโบสถ์)</p><div id="container2" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popup4328 = L.popup().setContent('<p style="font-size:100%;"><b>สถานีวัดระดับน้ำ</b><br />RAY004 (บ้านค่าย)</p><div id="container3" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popup5172 = L.popup().setContent('<p style="font-size:100%;"><b>สถานีวัดระดับน้ำ</b><br />MD.02 (ปากน้ำระยอง)</p><div id="container4" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popup5173 = L.popup().setContent('<p style="font-size:100%;"><b>สถานีวัดระดับน้ำ</b><br />EW001 (EW001)</p><div id="container5" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								
								<?php
									$arrStation = array();
									while ($row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC)){
										$station=$row4['station'];
										array_push($arrStation,$station);

										$code_all=$row4['code_all'];
										$sg_name=$row4['station_group_name'];
										$lat=$row4['latitude'];
										$lon=$row4['longitude'];
										$dept_name_eng=$row4['dept_name_eng'];
										// $waterlevel00_id=$row4['waterlevel00_id'];
										$water_date=$row4['water_date'];
										$water_time=$row4['water_time'];
										$water_value=$row4['nwater_value'];
	
										$newwater_value=number_format($water_value,2);
	
										if($station=="5172" || $station=="5173"){
											if($water_value>=0){
												$icon = "greenWLIcon";
											}else{
												$icon = "blankWLIcon";
											}											
										}else{
											switch($station){
												case "2224":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min2224){
														$icon = "greenWLIcon";
														}elseif($water_value>$min2224 && $water_value<=$med2224){
															$icon = "greenWLIcon";
															}elseif($water_value>$med2224 && $water_value<=$max2224){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max2224){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "2225":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min2225){
														$icon = "greenWLIcon";
														}elseif($water_value>$min2225 && $water_value<=$med2225){
															$icon = "greenWLIcon";
															}elseif($water_value>$med2225 && $water_value<=$max2225){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max2225){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "4328":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min4328){
														$icon = "greenWLIcon";
														}elseif($water_value>$min4328 && $water_value<=$med4328){
															$icon = "greenWLIcon";
															}elseif($water_value>$med4328 && $water_value<=$max4328){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max4328){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												default:
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value>0 && $water_value<=10){
														$icon = "greenWLIcon";
														}elseif($water_value>10 && $water_value<=35){
															$icon = "greenWLIcon";
															}elseif($water_value>35 && $water_value<=90){
																$icon = "yellowWLIcon";
																}elseif($water_value>90){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
											}											
										}

								?>
								// L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap4).bindPopup('<b>Water Station</b><br /><?php echo $code_all;?> (<?php echo $sg_name;?>)<br />Date: <?php echo $water_date;?><br />Value: <?php echo $water_value;?>');									
								L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup(<?php echo "popup".$station ?>, {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $sg_name;?>)');
								<?php
								}
								// mysqli_free_result($query2);
								mysqli_data_seek($query4,0);
								// sg.id, d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
								while ($row4all = mysqli_fetch_array($query4_all,MYSQLI_ASSOC)){
									if (!in_array($row4all["id"], $arrStation)){																			
										$code_all=$row4all['code_all'];
										$sg_name=$row4all['station_group_name'];
										$lat=$row4all['latitude'];
										$lon=$row4all['longitude'];
										$dept_name_eng=$row4all['dept_name_eng'];
										$icon = "blankWLIcon";															
								?>								
								L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup('<b>Water Station</b><br /><?php echo $code_all;?> (<?php echo $sg_name;?>)<br />Date: <?php echo $water_date;?>', {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $sg_name;?>)');
								<?php			
									}
								}
								mysqli_data_seek($query4_all,0);
								?>
								
								// L.marker([12.783579, 101.295947], {icon: redWLIcon}).addTo(mymap).bindPopup(popup2224, {maxWidth : 800}).bindTooltip('Z.62 (คลองใหญ่)');
								// L.marker([12.737965, 101.228398], {icon: redWLIcon}).addTo(mymap).bindPopup(popup2225, {maxWidth : 800}).bindTooltip('Z.38 (คลองทับมา บ้านเขาโบสถ์)');																
								// L.marker([12.70682, 101.30041], {icon: yellowWLIcon}).addTo(mymap).bindPopup(popup4328, {maxWidth : 800}).bindTooltip('RAY004 (บ้านค่าย)');
								// L.marker([12.657322, 101.276164], {icon: yellowWLIcon}).addTo(mymap).bindPopup(popup5172, {maxWidth : 800}).bindTooltip('MD.02 (ปากน้ำระยอง)');
								<?php
								$arrMWMStation = array();
								while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
									// $mid=$row['id'];
									$code_all=$row['code_all'];							
									$mwm_name=$row['mwm_station_name'];
									$lat=$row['latitude'];
									$lon=$row['longitude'];										
									$created_date=$row['created_date'];
									$accepted_value=$row['accepted_value'];						
									$mmid=$row['id'];
									$mid=$row['meter'];
									array_push($arrMWMStation,$mid);

									if($accepted_value==0){
										$icon = "greenWLIcon";
									}elseif($accepted_value>0 && $accepted_value<=30){
										$icon = "greenWLIcon";
										}elseif($accepted_value>30 && $accepted_value<=70){
											$icon = "greenWLIcon";
											}elseif($accepted_value>70 && $accepted_value<=100){
												$icon = "yellowWLIcon";
												}elseif($accepted_value>100){
													$icon = "redWLIcon";
									}
								?>
								L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup('<b>Staff Guage</b><br /><?php echo $code_all;?> (<?php echo $mwm_name;?>)');										
								<?php
								}

								mysqli_data_seek($query,0);	
								// print_r($arrMWMStation);	
								
								// mm.code_all,mm.mwm_station_name,mm.longitude AS lon,mm.latitude AS lat, mm.created_date
								while ($rowall = mysqli_fetch_array($query_all,MYSQLI_ASSOC)){
									if(count($arrMWMStation)>0){
										if (!in_array($rowall["id"], $arrMWMStation)){																			
											$code_all=$rowall['code_all'];
											$mwm_name=$rowall['mwm_station_name'];
											$lat=$rowall['lat'];
											$lon=$rowall['long'];										
											$created_date=$rowall['created_date'];
											$icon = "blankWLIcon";
										}
									}else{
										$code_all=$rowall['code_all'];
										$mwm_name=$rowall['mwm_station_name'];
										$lat=$rowall['lat'];
										$lon=$rowall['lon'];										
										$created_date=$rowall['created_date'];
										$icon = "blankWLIcon";
									}	
								?>
								// L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup('<b>Staff Guage</b><br /><?php echo $code_all;?> (<?php echo $mwm_name;?>)');										
								L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup('<b>Water Station</b><br /><?php echo $code_all;?> (<?php echo $mwm_name;?>)<br />Date: <?php echo $sitdate;?>', {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $mwm_name;?>)');
								<?php
								}
								mysqli_data_seek($query_all,0);
								?>
								// L.marker([12.761393, 101.29231], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />CS_WRY.01');
								// L.marker([12.685391, 101.293369], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />CS_WRY.03');
								// L.marker([12.6873, 101.29231], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />CS_WRY.04');	

								mymap.on('popupopen', function(e) {
									// $.ajax({
									// 	type: "GET",
									// 	url: "data01.json"
									// 	})
									// 	.done(function(data) {
										<?php
										// station 2224
										// $sql2224 = "SELECT w00.station, w01.water_date, w01.water_time, CAST(w01.water_value AS DECIMAL(10,2)) AS nwater_value, 
										// 			d.dept_name_eng, sg.code_all, sg.station_group_name, sg.latitude, sg.longitude
										// 			FROM waterlevel00 w00, waterlevel01_1hr w01, station_group sg, station s, department d
										// 			WHERE w00.station = sg.id 
										// 			AND w00.id = w01.waterlevel00_id 
										// 			AND sg.latitude REGEXP '^[0-9]+\\.?[0-9]*$' 
										// 			AND sg.longitude REGEXP '^[0-9]+\\.?[0-9]*$' 
										// 			AND w00.station IN (2224)
										// 			AND s.DEPARTMENT = d.dept_id
										// 			AND sg.id = s.STA_GROUP_ID
										// 			AND w01.water_date BETWEEN '".$twodayago."' AND '".$today."'
										// 			ORDER BY w01.water_date, w01.water_time";

										// $data_DateAll = array();
										// $data_2224All = array();
										// $data_2224Full = array();
										// $q2224 = mysqli_query($conn,$sql2224);

										// while($row2224=@mysqli_fetch_array($q2224,MYSQLI_ASSOC)){      
										// 	$data_DateAll[] = "'".$row2224['water_date']." ".$row2224['water_time']."'";
										// 	if($row2224['water_value']=="-"){
										// 		$data_2224All[] = 0;     
										// 		$data_2224All[] = 0;     
										// 	}else{
										// 		$data_2224All[] = $row2224['water_value']; 												
										// 	}
										// 	$data_2224Full[] = $full2224;
										// }
										// mysqli_free_result($q2224);
										// $strDateAll = join( ',', $data_DateAll);
										// $str2224All = join( ',', $data_2224All);
										// $str2224Full = join( ',', $data_2224Full);

										?>
										$('#container').highcharts({
											// data[6].push({enabled: true, radius: 10});
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;
														// alert(points.length);

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == (points.length-1)){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', 110, 355, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 140, 372, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 20
														}).add()
													}
												}
											},
											title: {text: ''},											
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45										
												},     
												categories: [
													<?php echo $strDateAll;?>
												],
												"plotLines": [{
													"color": "rgba(0, 0, 0, 0.3)",
													"width": 1,
													"value": "2022-07-21 14:00",
													"dashStyle": "longdash"
													}
												],
												// plotBands: [{ 
												// 	from: 74,
												// 	to: 75,
												// 	color: '#f8f8f8',
												// 	label: {
												// 		text: '<em>FORECAST</em>',
												// 		style: {
												// 		color: '#057aff',
												// 		fontWeight: 'bold'
												// 		},
												// 		y: 20
												// 	}
												// }]
											},	
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'ระดับน้ำ (ม.รทก.)'
												}
											},										
											series: [
												{
													"name": "Z.62 (คลองใหญ่)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													// "data": [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 
													// 		{
													// 			y:25.2,
													// 			marker: {
													// 				// symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
													// 				symbol: 'circle',
													// 				radius: 10
													// 			}
													// 		}, 
													// 		26.5, 23.3, 18.3, 13.9, 9.6]
													"data": [<?php echo $str2224All;?>]
												},{
													"name": "ระดับตลิ่ง",
													"data": [<?php echo $str2224Full;?>],
													"color": "red"
												}
											]
										});

										$('#container2').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == (points.length-1)){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', 110, 355, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 140, 372, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 20
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45										
												},  
												categories: [<?php echo $strDate2225All;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'ระดับน้ำ (ม.รทก.)'
												}
											},										
											series: [
												{
													"name": "Z.38 (คลองทับมา บ้านเขาโบสถ์)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													// "data": [
													// 			-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6,
													// 			{
													// 			y: 2.5,
													// 			marker: {
													// 				symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
													// 			}
													// 		}
													// 		]
													"data": [<?php echo $str2225All;?>]
												},{
													"name": "ระดับตลิ่ง",
													// "data": [20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0],
													"data": [<?php echo $str2225Full;?>],
													"color": "red"
												}
											]
										});

										$('#container3').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == (points.length-1)){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', 110, 355, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 140, 372, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 20
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,		
													rotation: 45									
												},  
												categories: [<?php echo $strDate4328All;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'ระดับน้ำ (ม.รทก.)'
												}
											},		
											series: [
												{
													"name": "RAY004 (บ้านค่าย)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													// "data": [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
													"data": [<?php echo $str4328All;?>]
												},{
													"name": "ระดับตลิ่ง",												
													"data": [<?php echo $str4328Full;?>],
													"color": "red"
												}
											]
										});

										$('#container4').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == (points.length-1)){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', 110, 355, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 140, 372, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 20
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,		
													rotation: 45											
												},  
												categories: [<?php echo $strDate5172All;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'ระดับน้ำ (ม.รทก.)'
												}
											},										
											series: [
												{
													"name": "MD.02 (ปากน้ำระยอง)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													// "data": [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
													"data": [<?php echo $str5172All;?>]
												},
												// {
												// 	"name": "ระดับตลิ่ง",
												// 	// "data": [20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0],
												// 	"data": [<?php // echo $str5172Full;?>],
												// 	"color": "red"
												// }
											]
										});

										$('#container5').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == (points.length-1)){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', 110, 355, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 140, 372, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 20
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,		
													rotation: 45											
												},  
												categories: [<?php echo $strDate5173All;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'ระดับน้ำ (ม.รทก.)'
												}
											},										
											series: [
												{
													"name": "EW001 (EW001)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													// "data": [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
													"data": [<?php echo $str5173All;?>]
												},
												// {
												// 	"name": "ระดับตลิ่ง",
												// 	// "data": [20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0],
												// 	"data": [<?php // echo $str5172Full;?>],
												// 	"color": "red"
												// }
											]
										});
									// });
								});

								mymap.on('popupclose', function(e){
									$('#container').html("Loading...");
									$('#container2').html("Loading...");
									$('#container3').html("Loading...");
									$('#container4').html("Loading...");
									$('#container5').html("Loading...");
								});

								var geojson_data1;

								$.ajax({
									// url: "http://127.0.0.1/leaflet/json/thailandwithdensity.geojson",
									// url: "http://127.0.0.1/radar2021/json/th-Rayong-high.geojson",
									url: "../json/th-Rayong-high.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_data1 = JSON.parse(data);
										}
								});

								var geojson_data2;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/river_urbs.geojson",
									url: "../json/river_urbs.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_data2 = JSON.parse(data);
										}
								});

								var geojson_data3;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/URBS_subbasin.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_data3 = JSON.parse(data);
										}
								});

								var geojson_mainriver;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/main_river_radar4flood.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_mainriver = JSON.parse(data);
										}
								});

								var geojson_subriver;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/sub_river_radar4flood.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_subriver = JSON.parse(data);
										}
								});

								var geojson_tambon_rayong;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/tambon_rayong.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_tambon_rayong = JSON.parse(data);
										}
								});

								var geojson_amphoe_rayong;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/amphoe_rayong.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_amphoe_rayong = JSON.parse(data);
										}
								});

								var geojson_province_rayong;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/province_rayong.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_province_rayong = JSON.parse(data);
										}
								});

								<?php
								}else{									
								?>
								var popupMRY_Z62 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_Z62 (แม่น้ำระยอง ณ ที่ตั้งสถานี Z.62 (กรมชลประทาน))</p><div id="contMRY01" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_02 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_02 (แม่น้ำระยอง ณ ที่ตั้งสถานี CS_WRY.01 (สถานีพลเมือง) และท้ายจุดบรรจบคลองยายล้ำ)</p><div id="contMRY02" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_03 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_03 (แม่น้ำระยอง ท้ายจุดบรรจบคลองอ่าง)</p><div id="contMRY03" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_RAY004 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_RAY004 (แม่น้ำระยอง ณ ที่ตั้งสถานี RAY004 (สถาบันสารสนเทศทรัพยากรน้ํา (องค์การมหาชน)))</p><div id="contMRY04" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_05 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_05 (แม่น้ำระยอง ท้ายจุดบรรจบคลองจัด )</p><div id="contMRY05" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_06 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_06 (แม่น้ำระยอง ท้ายจุดบรรจบคลองทับมา ณ สถานี CS_WRY.03 (สถานีพลเมือง))</p><div id="contMRY06" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_07 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_07 (แม่น้ำระยอง ท้ายจุดบรรจบคลองคา)</p><div id="contMRY07" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMRY_08 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MRY_08 (จุดออกทะเล ณ ที่ตั้งสถานี MD.02 (กรมเจ้าท่า))</p><div id="contMRY08" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMTM_Z38 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MTM_Z38 (ณ ที่ตั้งสถานี Z.38 (กรมชลประทาน))</p><div id="contMTM01" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMTM_02 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MTM_02 (คลองทับมาบริเวณ ต.ทับมา ถนนเกาะพรวด)</p><div id="contMTM02" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMTM_03 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MTM_03 (คลองทับมาบริเวณ ต.ทับมา ถนนทุ่งนอก-สะพานแตง)</p><div id="contMTM03" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');
								var popupMTM_04 = L.popup().setContent('<p style="font-size:100%;"><b>ตำแหน่งเฝ้าระวัง</b><br />MTM_04 (จุดออกลุ่มน้ำทับมา ณ สถานี CS_WRY.04  (สถานีพลเมือง))</p><div id="contMTM04" style="width: 800px; height: 400px; margin: 0 auto">Loading...</div>');

								<?php
									while ($row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC)){
										// $station=$row4['station'];
										$code_all=$row4['code_all'];
										$sg_name=$row4['station_group_name'];
										$lat=$row4['latitude'];
										$lon=$row4['longitude'];
										// $dept_name_eng=$row4['dept_name_eng'];
										// $waterlevel00_id=$row4['waterlevel00_id'];
										$water_date=$row4['datetime'];
										$water_time=$row4['datetime'];
										$water_value=$row4['nwater_value'];
	
										$newwater_value=number_format($water_value,2);

										if($code_all=="MRY_08"){
											if($water_value>=0){
												$icon = "greenWLIcon";
											}else{
												$icon = "blankWLIcon";
											}											
										}else{
											
											// if($water_value==0){
											// 	$icon = "greenWLIcon";
											// }elseif($water_value>0 && $water_value<=10){
											// 	$icon = "greenWLIcon";
											// 	}elseif($water_value>10 && $water_value<=35){
											// 		$icon = "greenWLIcon";
											// 		}elseif($water_value>35 && $water_value<=90){
											// 			$icon = "yellowWLIcon";
											// 			}elseif($water_value>90){
											// 				$icon = "redWLIcon";
											// }else{
											// 	$icon = "blankWLIcon";
											// }

											switch($code_all){
												case "MRY_Z62":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry01){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry01 && $water_value<=$med_mry01){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry01 && $water_value<=$max_mry01){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry01){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MRY_02":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry02){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry02 && $water_value<=$med_mry02){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry02 && $water_value<=$max_mry02){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry02){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MRY_03":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry03){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry03 && $water_value<=$med_mry03){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry03 && $water_value<=$max_mry03){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry03){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MRY_RAY004":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry04){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry04 && $water_value<=$med_mry04){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry04 && $water_value<=$max_mry04){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry04){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MRY_05":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry05){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry05 && $water_value<=$med_mry05){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry05 && $water_value<=$max_mry05){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry05){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MRY_06":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry06){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry06 && $water_value<=$med_mry06){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry06 && $water_value<=$max_mry06){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry06){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MRY_07":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry07){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry07 && $water_value<=$med_mry07){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry07 && $water_value<=$max_mry07){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mry07){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MTM_Z38":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mtm01){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mtm01 && $water_value<=$med_mtm01){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mtm01 && $water_value<=$max_mtm01){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mtm01){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MTM_02":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mtm02){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mtm02 && $water_value<=$med_mtm02){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mtm02 && $water_value<=$max_mtm02){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mtm02){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;
												case "MTM_03":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mtm03){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mtm03 && $water_value<=$med_mtm03){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mtm03 && $water_value<=$max_mtm03){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mtm03){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;	
												case "MTM_04":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mtm04){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mtm04 && $water_value<=$med_mtm04){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mtm04 && $water_value<=$max_mtm04){
																$icon = "yellowWLIcon";
																}elseif($water_value>$max_mtm04){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
													break;	
												default:
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value>0 && $water_value<=10){
														$icon = "greenWLIcon";
														}elseif($water_value>10 && $water_value<=35){
															$icon = "greenWLIcon";
															}elseif($water_value>35 && $water_value<=90){
																$icon = "yellowWLIcon";
																}elseif($water_value>90){
																	$icon = "redWLIcon";
													}else{
														// $icon = "greyWaterIcon";
														$icon = "blankWLIcon";
													}
											}

										}
								?>								
								// L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup(<?php echo "popup".$code_all ?>, {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $sg_name;?>)');								
								// L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup('<b>Water Station</b><br /><?php echo $code_all;?> (<?php echo $sg_name;?>)<br />Date: <?php echo $water_date;?>', {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $sg_name;?>)');
								L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup(<?php echo "popup".$code_all ?>, {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $sg_name;?>)');
								<?php
								}
								// mysqli_free_result($query2);
								mysqli_data_seek($query4,0);
								?>

								<?php
									while ($row4_novalue = mysqli_fetch_array($query4_novalue,MYSQLI_ASSOC)){
										// $station=$row4['station'];
										$code_all=$row4_novalue['code_all'];
										$sg_name=$row4_novalue['station_group_name'];
										$lat=$row4_novalue['latitude'];
										$lon=$row4_novalue['longitude'];
										// $dept_name_eng=$row4['dept_name_eng'];
										// $waterlevel00_id=$row4['waterlevel00_id'];
										// $water_date=$row4['datetime'];
										// $water_time=$row4['datetime'];
										// $water_value=$row4['nwater_value'];
	
										// $newwater_value=number_format($water_value,2);
	
										// if($water_value==0){
										// 	$icon = "greenWLIcon";
										// }elseif($water_value>0 && $water_value<=10){
										// 	$icon = "greenWLIcon";
										// 	}elseif($water_value>10 && $water_value<=35){
										// 		$icon = "greenWLIcon";
										// 		}elseif($water_value>35 && $water_value<=90){
										// 			$icon = "yellowWLIcon";
										// 			}elseif($water_value>90){
										// 				$icon = "redWLIcon";
										// }else{
											$icon = "blankWLIcon";
										// }
								?>								
								L.marker([<?php echo $lat;?>, <?php echo $lon;?>], {icon: <?php echo $icon;?>}).addTo(mymap).bindPopup('<b>Water Station</b><br /><?php echo $code_all;?> (<?php echo $sg_name;?>)<br />Date: <?php echo $water_date;?>', {maxWidth : 800}).bindTooltip('<?php echo $code_all;?> (<?php echo $sg_name;?>)');
								<?php
								}
								// mysqli_free_result($query2);
								mysqli_data_seek($query4_novalue,0);
								?>


								// L.marker([12.783579, 101.295947], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY01 (แม่น้ำระยอง ณ ที่ตั้งสถานี Z.62 (กรมชลประทาน))');
								// L.marker([12.761393, 101.29231], {icon: redWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY02 (แม่น้ำระยอง ณ ที่ตั้งสถานี CS_WRY.01 (สถานีพลเมือง) และท้ายจุดบรรจบคลองยายล้ำ)');
								// L.marker([12.716486, 101.29582], {icon: redWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY03');
								// L.marker([12.70682, 101.30041], {icon: redWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY_RAY004');
								// L.marker([12.70012, 101.303251], {icon: yellowWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY05');
								// L.marker([12.685391, 101.293369], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY06');
								// L.marker([12.675989, 101.283342], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY07');
								// L.marker([12.657322, 101.276164], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MRY08');
								// L.marker([12.737965, 101.228398], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MTM_Z38');
								// L.marker([12.715452, 101.246265], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MTM02');
								// L.marker([12.69141, 101.252915], {icon: redWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MTM03');
								// L.marker([12.6873, 101.29231], {icon: greenWLIcon}).addTo(mymap).bindPopup('<b>Staff Guage</b><br />MTM04');

								mymap.on('popupopen', function(e) {
									// $.ajax({
									// 	type: "GET",
									// 	url: "data01.json"
									// 	})
									// 	.done(function(data) {
										$('#contMRY01').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},											
											xAxis: {
												labels: {
													step: 6,
													rotation: 45													
												}, 
												categories: [<?php echo $strmry01DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},
											series: [
												{
													"name": "แม่น้ำระยอง ณ ที่ตั้งสถานี Z.62 (กรมชลประทาน)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry01All;?>]
												},
												{
													"name": "ระดับตลิ่ง",
													"data": [<?php echo $strmry01Full;?>],
													"color": "red"
												}

											]
										});

										$('#contMRY02').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,
													rotation: 45													
												}, 
												categories: [<?php echo $strmry02DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "แม่น้ำระยอง ณ ที่ตั้งสถานี CS_WRY.01 (สถานีพลเมือง) และท้ายจุดบรรจบคลองยายล้ำ",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry02All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmry02Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMRY03').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45												
												}, 
												categories: [<?php echo $strmry03DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "แม่น้ำระยอง ท้ายจุดบรรจบคลองอ่าง",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry03All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmry03Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMRY04').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45												
												}, 
												categories: [<?php echo $strmry04DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "แม่น้ำระยอง ณ ที่ตั้งสถานี RAY004 (สถาบันสารสนเทศทรัพยากรน้ํา (องค์การมหาชน))",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry04All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmry04Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMRY05').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45												
												}, 
												categories: [<?php echo $strmry05DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "แม่น้ำระยอง ท้ายจุดบรรจบคลองจัด",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry05All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmry05Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMRY06').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,		
													rotation: 45											
												}, 
												categories: [<?php echo $strmry06DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "แม่น้ำระยอง ท้ายจุดบรรจบคลองทับมา ณ สถานี CS_WRY.03 (สถานีพลเมือง)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry06All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmry06Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMRY07').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45												
												}, 
												categories: [<?php echo $strmry07DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "แม่น้ำระยอง ท้ายจุดบรรจบคลองคา",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry07All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmry07Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMRY08').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,	
													rotation: 45												
												}, 
												categories: [<?php echo $strmry08DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "จุดออกทะเล ณ ที่ตั้งสถานี MD.02 (กรมเจ้าท่า)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmry08All;?>]
												},
												// {
												// 	"name": "ระดับตลิ่ง",
												// 	"data": [20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0, 20.0],
												// 	"color": "red"
												// }
											]
										});

										$('#contMTM01').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},		
											xAxis: {
												labels: {
													step: 6,		
													rotation: 45											
												}, 
												categories: [<?php echo $strmtm01DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},									
											series: [
												{
													"name": "ณ ที่ตั้งสถานี Z.38 (กรมชลประทาน)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmtm01All;?>]
												},
												{
													"name": "ระดับตลิ่ง",
													"data": [<?php echo $strmtm01Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMTM02').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},		
											xAxis: {
												labels: {
													step: 6,		
													rotation: 45											
												}, 
												categories: [<?php echo $strmtm02DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},									
											series: [
												{
													"name": "คลองทับมาบริเวณ ต.ทับมา ถนนเกาะพรวด",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmtm02All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmtm02Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMTM03').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},	
											xAxis: {
												labels: {
													step: 6,			
													rotation: 45										
												}, 
												categories: [<?php echo $strmtm03DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},										
											series: [
												{
													"name": "คลองทับมาบริเวณ ต.ทับมา ถนนทุ่งนอก-สะพานแตง",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmtm03All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmtm03Full;?>],
													"color": "red"
												}
											]
										});

										$('#contMTM04').highcharts({
											chart: {
												height: 400, width: 800,
												events: {
													load: function() {
														var chart = this,
														points = chart.series[0].points,
														maxValue,
														chosenPoint;

														points.forEach(function(point, index) {
														/* if (!maxValue || maxValue < point.y) {
															maxValue = point.y;
															chosenPoint = point;
														} */
														if(index == <?php echo $idx-1;?>){
														chosenPoint = point;
														}
														});

														chosenPoint.update({
														marker: {
															symbol: 'url(https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png)'
														}
														});
													},
													render() {
														let chart = this,
														legendAttr = chart.legend.box.getBBox(),
														padding = 5;

														// chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/sun.png', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).add();
														chart.renderer.image('https://radar4flood.eng.ku.ac.th/radar2021/images/redsun.png', 300, 375, 30, 30).add();
														
														// chart.plus = chart.renderer.text('| +', chart.legend.box.parentGroup.alignAttr.translateX + legendAttr.width + padding, chart.spacingBox.height + padding / 2).attr({
														// cursor: 'pointer',
														// }).css({
														// fontSize: 20
														// }).add()
														// chart.plus = chart.renderer.text('เวลาตรวจวัดล่าสุด', 120, 372, 30, 30).attr({
														chart.plus = chart.renderer.text('เวลาสิ้นสุดการประเมินฝนเรดาร์', 330, 392, 30, 30).attr({
														cursor: 'pointer',
														}).css({
														fontSize: 18
														}).add()
													}
												}
											},
											title: {text: ''},		
											xAxis: {
												labels: {
													step: 6,			
													rotation: 45										
												}, 
												categories: [<?php echo $strmtm04DateAll;?>]
											},
											yAxis: {
												labels: {
													format: '{text}' // The $ is literally a dollar unit
												},
												title: {
													text: 'อัตราการไหล (ลบ.ม./วินาที)'
												}
											},									
											series: [
												{
													"name": "จุดออกลุ่มน้ำทับมา ณ สถานี CS_WRY.04 (สถานีพลเมือง)",
													type : "area",
													fillColor : {
														linearGradient : [0, 0, 0, 300],
														stops : [
															[0, Highcharts.getOptions().colors[0]],
															[1, 'rgba(2,0,0,0)']
														]
													},
													"data": [<?php echo $strmtm04All;?>]
												},{
													"name": "ระดับตลิ่ง",													
													"data": [<?php echo $strmtm04Full;?>],
													"color": "red"
												}
											]
										});
									// });
								});

								mymap.on('popupclose', function(e){
									$('#contMRY01').html("Loading...");
									$('#contMRY02').html("Loading...");
									$('#contMRY03').html("Loading...");
									$('#contMRY04').html("Loading...");
									$('#contMRY05').html("Loading...");
									$('#contMRY06').html("Loading...");
									$('#contMRY07').html("Loading...");
									$('#contMRY08').html("Loading...");
									$('#contMTM01').html("Loading...");
									$('#contMTM02').html("Loading...");
									$('#contMTM03').html("Loading...");
									$('#contMTM04').html("Loading...");
								});

								var geojson_data1;

								$.ajax({
									// url: "http://127.0.0.1/leaflet/json/thailandwithdensity.geojson",
									// url: "http://127.0.0.1/radar2021/json/th-Rayong-high.geojson",
									url: "../json/th-Rayong-high.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",									
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_data1 = JSON.parse(data);
										}
								});

								var geojson_data2;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/river_urbs.geojson",
									url: "../json/river_urbs.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_data2 = JSON.parse(data);
										}
								});

								var geojson_data3;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/URBS_subbasin.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_data3 = JSON.parse(data);
										}
								});

								// var geojson_data4;

								// $.ajax({
								// 	// url: "http://127.0.0.1/radar2021/json/test_floodarea.geojson",
								// 	url: "../json/test_floodarea.geojson",
								// 	// url: "https://radar-backend1.eng.ku.ac.th/storage_01/flood/geojson/Q50_MRY_RY03.geojson",
								// 	// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
								// 	method: "GET",
								// 	async: false,
								// 		success : function(data){
								// 			// alert(data);
								// 			geojson_data4 = JSON.parse(data);
								// 		}
								// });

								// var geojson_data5;

								// $.ajax({
								// 	// url: "../json/dummy_floodmap_union_EN_latlon.geojson",
								// 	url: "https://radar-backend1.eng.ku.ac.th/storage_01/flood/geojson/Q50_MRY_RY03.geojson",
								// 	// url: "http://127.0.0.1/radar2021/json/Q50_MRY_RY03.geojson",
								// 	// url: "../json/Q50_MRY_RY03.geojson",
								// 	// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
								// 	method: "GET",
								// 	dataType: "json",
								// 	headers : {
								// 		Accept : "application/json; charset=utf-8", 
								// 		"Content-Type" : "application/json; charset=utf-8"
								// 	},
								// 	async: false,
								// 		success : function(data){
								// 			// alert(data);
								// 			// geojson_data5 = JSON.parse(data);
								// 			// alert("response is  : " + JSON.stringify(data));											
								// 			// geojson_data5 = JSON.stringify(data);			
								// 			geojson_data5 = JSON.parse(JSON.stringify(data));											
								// 		}
								// });	
								
								<?php
								// update 2022-09-01
								if(mysqli_num_rows($query4_over)>0){
								while($rowfloodmap=@mysqli_fetch_array($query4_over,MYSQLI_ASSOC)){  
									$floodmap_url = $urlradar2.$rowfloodmap["floodmap"];
									$code_all = $rowfloodmap["id"];    
								?>
									var geojson_<?php echo $code_all;?>;

									$.ajax({										
										url: "<?php echo $floodmap_url;?>",										
										method: "GET",
										dataType: "json",
										headers : {
											Accept : "application/json; charset=utf-8", 
											"Content-Type" : "application/json; charset=utf-8"
										},
										async: false,
											success : function(data){
												// alert(data);
												// geojson_data5 = JSON.parse(data);
												// alert("response is  : " + JSON.stringify(data));											
												// geojson_data5 = JSON.stringify(data);			
												geojson_<?php echo $code_all;?> = JSON.parse(JSON.stringify(data));											
											}
									});
								
								<?php
								}			
								// mysqli_free_result($query4_over); 
								mysqli_data_seek($query4_over,0);
								}
								// update 2022-09-01
								?>
							
								
								var geojson_mainriver;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/main_river_radar4flood.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_mainriver = JSON.parse(data);
										}
								});

								var geojson_subriver;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/sub_river_radar4flood.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_subriver = JSON.parse(data);
										}
								});

								var geojson_tambon_rayong;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/tambon_rayong.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_tambon_rayong = JSON.parse(data);
										}
								});

								var geojson_amphoe_rayong;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/amphoe_rayong.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_amphoe_rayong = JSON.parse(data);
										}
								});

								var geojson_province_rayong;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									url: "../json/province_rayong.geojson",
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_province_rayong = JSON.parse(data);
										}
								});

								var geojson_urbs;

								$.ajax({
									// url: "http://127.0.0.1/radar2021/json/URBS_subbasin.geojson",
									// url: "../json/Province_inRadarRadius_cutisland_latlon.geojson",
									url: "<?php echo $geojson_url;?>",									
									// url: "http://127.0.0.1/leaflet/json/thailand-22-basins.geojson",
									method: "GET",
									async: false,
										success : function(data){
											// alert(data);
											geojson_urbs = JSON.parse(data);
										}
								});

								<?php
								}
								?>

								// L.marker([12.783579, 101.295947], {icon: redWLIcon}).addTo(mymap).bindTooltip('<b>Staff Guage</b><br />Z.62 (คลองใหญ่)');
								
								
								// L.marker([12.694507, 101.242508], {icon: redRainIcon}).addTo(mymap).bindPopup('<b>Rain Station</b><br />CS_WRY.05 คลองกิ่ว');
								// L.marker([12.761393, 101.29231], {icon: redRainIcon}).addTo(mymap).bindPopup('<b>Rain Station</b><br />CS_WRY.01 วัดบ้านค่าย');
								// L.marker([12.728603, 101.293957], {icon: redRainIcon}).addTo(mymap).bindPopup('<b>Rain Station</b><br />CS_WRY.02 วัดบ้านเก่า');
								// L.marker([12.686617, 101.292931], {icon: redRainIcon}).addTo(mymap).bindPopup('<b>Rain Station</b><br />CS_WRY.04 ปตร.ทับมา_เหนือน้ำ');
															

								// alert(geojson_data);
								<?php
								if($stype==1){									
								?>
								var legend3 = L.control({position: 'topright'});
									legend3.onAdd = function(mymap){
										var div = L.DomUtil.create('div', 'info legend');
										labels = ['<strong>สถานการณ์น้ำรายชั่วโมง</strong>'],
										// categories = ["Tobacco","Whiskey","Beer","Cigar","Other"];
										labels.push(' ณ วันที่ <?php echo $sitdate;?> เวลา <?php echo $sittime;?> น.');
										div.innerHTML = labels.join('');
										return div;
									};
								legend3.addTo(mymap);
								<?php
								}else{									
								?>
								var legend3 = L.control({position: 'topright'});
									legend3.onAdd = function(mymap){
										var div = L.DomUtil.create('div', 'info legend');
										labels = ['<strong>สถานการณ์น้ำรายชั่วโมง</strong>'],
										// categories = ["Tobacco","Whiskey","Beer","Cigar","Other"];
										labels.push(' ณ วันที่ <?php echo $sitdate;?> ณ เวลา <?php echo $timeend;?>');
										div.innerHTML = labels.join('');
										return div;
									};
								legend3.addTo(mymap);
								<?php
								}
								?>

								var info = L.control();

								info.onAdd = function (map) {
									this._div = L.DomUtil.create('div', 'info');
									this.update();
									return this._div;
								};

								info.update = function (props) {
								// this._div.innerHTML = '<h4>Thai Population Density</h4>' +  
								// 	(props ? '<b>' + props.name + '</b><br />' + props.p + ' people / km<sup>2</sup>' : 'Hover over a state');
								this._div.innerHTML = '<h4>Information</h4>' +  
									// (props ? '<b>' + props.Code_Basin + '</b><br />' + props.area + ' km<sup>2</sup>' : 'Hover over a state');
									(props ? '<b>' + props.name + '</b><br /><b>Rainfall</b> ' + props.rain_avg.toFixed(4) + ' mm.' : 'Hover over a state');
									// (props ? '<b>ตำแหน่ง: </b>' + props.text_TH + '<br /><b>พื้นที่</b> ' + props.area_sqkm.toFixed(4) + ' km.' : 'Hover over a state');
								};

								info.addTo(mymap);

								// var info2 = L.control();

								// info2.onAdd = function (map) {
								// 	this._div = L.DomUtil.create('div', 'info');
								// 	this.update();
								// 	return this._div;
								// };

								// info2.update = function (props) {
								// // this._div.innerHTML = '<h4>Thai Population Density</h4>' +  
								// // 	(props ? '<b>' + props.name + '</b><br />' + props.p + ' people / km<sup>2</sup>' : 'Hover over a state');
								// this._div.innerHTML = '<h4>Information</h4>' +  
								// 	// (props ? '<b>' + props.Code_Basin + '</b><br />' + props.area + ' km<sup>2</sup>' : 'Hover over a state');
								// 	(props ? '<b>' + props.name + '</b><br /><b>Rainfall</b> ' + props.rain_avg.toFixed(4) + ' mm.' : 'Hover over a state');
								// 	// (props ? '<b>ตำแหน่ง: </b>' + props.text_TH + '<br /><b>พื้นที่</b> ' + props.area_sqkm.toFixed(4) + ' km.' : 'Hover over a state');
								// };

								// info2.addTo(mymap);

								function getColor(d) {
									return  d > 1000 ? '#800026' :
									d > 500  ? '#BD0026' :
									d > 200  ? '#E31A1C' :
									d > 100  ? '#FC4E2A' :
									d > 50   ? '#FD8D3C' :
									d > 20   ? '#FEB24C' :
									d > 10   ? '#FED976' :
									'#FED976';
								}

								function getColorStaff(d) {
									return d > 100  ? '#f44336' :
											d > 70   ? '#ffc107' :
											d > 30   ? '#8bc34a' :
											d > 0   ? '#00aced' :
														'#FFEDA0';
								}

								function style(feature) {
									return {
										fillColor: getColor(feature.properties.p),
										weight: 1,
										opacity: 1,
										color: 'white',
										dashArray: '3',
										// fillOpacity: 0.7
										fillOpacity: 0.5
									};
								}

								function style2(feature) {
									return {
										// fillColor: getColor(feature.properties.p),
										fillColor: '#FED976',
										weight: 3,
										opacity: 1,
										color: '#004da7',
										dashArray: '1',
										// fillOpacity: 0.7
										fillOpacity: 0.5
									};
								}

								function style3(feature) {
									return {
										// fillColor: '#db6f04',
										fillColor: '#004da7',										
										// fillColor: getColor(feature.properties.area),
										weight: 2,
										opacity: 1,
										color: '#800026',
										dashArray: '3',
										// fillOpacity: 0.7
										fillOpacity: 0.7
									};
								}

								function style4(feature) {
									return {
										// fillColor: getColor(feature.properties.p),
										fillColor: '#FED976',
										weight: 2,
										opacity: 1,
										color: '#73b2ff',
										dashArray: '1',
										// fillOpacity: 0.7
										fillOpacity: 0.5
									};
								}
								

								function style5(feature) {
									return {
										// fillColor: getColor(feature.properties.p),
										fillColor: '#FED976',
										weight: 1,
										opacity: 1,
										color: '#dc3522',
										dashArray: '1',
										// fillOpacity: 0.7
										fillOpacity: 0.5
									};
								}

								function style6(feature) {
									return {
										// fillColor: getColor(feature.properties.p),
										fillColor: '#ffffff',
										weight: 1,
										opacity: 1,
										color: '#272727',
										dashArray: '1',
										// fillOpacity: 0.7
										fillOpacity: 0.2
									};
								}

								function styleurbs(feature) {
									return {
										fillColor: getColorRain(feature.properties.rain_avg),
										// fillColor: '#BD0026',
										weight: 1,
										opacity: 1,
										color: '#800026',
										dashArray: '3',
										// fillOpacity: 0.7
										fillOpacity: 0.5
									};
								}

								function highlightFeature(e) {
									var layer = e.target;
									layer.setStyle({
										weight: 3,
										color: '#666',
										dashArray: '',
										// fillOpacity: 0.7
										fillOpacity: 0.5
								});

								if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
									layer.bringToFront();
								}
								info.update(layer.feature.properties);
								}

								var geojson;

								function resetHighlight(e) {
									geojson.resetStyle(e.target);
									info.update();
								}

								function zoomToFeature(e) {
									mymap.fitBounds(e.target.getBounds());
								}

								function onEachFeature(feature, layer) {
								layer.on({
									mouseover: highlightFeature,
									mouseout: resetHighlight,
									click: zoomToFeature
								});
								}

								<?php
								if($stype==1){									
								?>
								
									// geojson = L.geoJson(geojson_data1, {
									// 	// style: style,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);						

									// geojson = L.geoJson(geojson_data3, {
									// 	style: style2,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);

									// geojson = L.geoJson(geojson_data2, {
									// 	// style: style,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);

									geojson = L.geoJson(geojson_mainriver, {
										style: style2,
										// onEachFeature: onEachFeature
									}).addTo(mymap);

									geojson = L.geoJson(geojson_subriver, {
										style: style4,
										// onEachFeature: onEachFeature
									}).addTo(mymap);

									// geojson_tambon = L.geoJson(geojson_tambon_rayong, {
									// 	style: style5,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);
									geojson_tambon = L.geoJson(geojson_tambon_rayong, {
										style: style6,
										// onEachFeature: onEachFeature
									});

									geojson_amphoe = L.geoJson(geojson_amphoe_rayong, {
										style: style6,
										// onEachFeature: onEachFeature
									});

									geojson_province = L.geoJson(geojson_province_rayong, {
										style: style6,
										// onEachFeature: onEachFeature
									});

									var tambon = L.layerGroup([geojson_tambon]);
									var amphoe = L.layerGroup([geojson_amphoe]);
									var province = L.layerGroup([geojson_province]);

									var baseMaps = {						
										"Mapbox Streets": streets
									};

									var overlayMaps = {
										"Tambon in Rayong": tambon,
										"Amphoe in Rayong": amphoe,
										"Provincec in Rayong": province
									};

									var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(mymap);

								<?php 
								}else{
								?>
								
									// geojson = L.geoJson(geojson_data1, {
									// 	// style: style,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);						

									// geojson = L.geoJson(geojson_data3, {
									// 	style: style5,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);

									// geojson = L.geoJson(geojson_data2, {
									// 	// style: style,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);

									// geojson = L.geoJson(geojson_data4, {
									// 	style: style3,
									// 	onEachFeature: onEachFeature
									// }).addTo(mymap);
									

									// geojson = L.geoJson(geojson_data5, {
									// 	style: style3,
									// 	// onEachFeature: onEachFeature
									// }).addTo(mymap);
									

									geojson = L.geoJson(geojson_mainriver, {
										style: style2,
										// onEachFeature: onEachFeature
									}).addTo(mymap);

									geojson = L.geoJson(geojson_subriver, {
										style: style4,
										// onEachFeature: onEachFeature
									}).addTo(mymap);

									geojson_tambon = L.geoJson(geojson_tambon_rayong, {
										style: style6,
										// onEachFeature: onEachFeature
									});

									geojson_amphoe = L.geoJson(geojson_amphoe_rayong, {
										style: style6,
										// onEachFeature: onEachFeature
									});

									geojson_province = L.geoJson(geojson_province_rayong, {
										style: style6,
										// onEachFeature: onEachFeature
									});

									// geojson = L.geoJson(geojson_urbs, {
									// 	style: styleurbs,
									// 	onEachFeature: onEachFeature
									// }).addTo(mymap);

									<?php
									if(mysqli_num_rows($query4_over)>0){
										while($rowfloodmap=@mysqli_fetch_array($query4_over,MYSQLI_ASSOC)){  										
											$code_all = $rowfloodmap["id"];    
										?>
										geojson = L.geoJson(geojson_<?php echo $code_all;?>, {
											style: style3,
											// onEachFeature: onEachFeature
										}).addTo(mymap);
										<?php
										}			
										mysqli_free_result($query4_over); 	
									}								
									?>

									geojson = L.geoJson(geojson_urbs, {
										style: styleurbs,
										onEachFeature: onEachFeature
									}).addTo(mymap);

									

									var tambon = L.layerGroup([geojson_tambon]);
									var amphoe = L.layerGroup([geojson_amphoe]);
									var province = L.layerGroup([geojson_province]);

									var baseMaps = {						
										"Mapbox Streets": streets
									};

									var overlayMaps = {
										"Tambon in Rayong": tambon,
										"Amphoe in Rayong": amphoe,
										"Provincec in Rayong": province
									};

									var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(mymap);

								<?php
								}
								?>

								

								// var legend = L.control({position: 'bottomright'});

								// legend.onAdd = function (map) {

								// 	var div = L.DomUtil.create('div', 'info legend'),
								// 		grades = [0, 10, 20, 50, 100, 200, 500, 1000],
								// 		labels = [],
								// 		from, to;

								// 	for (var i = 0; i < grades.length; i++) {
								// 		from = grades[i];
								// 		to = grades[i + 1];

								// 		labels.push(
								// 			'<i style="background:' + getColorRain(from + 1) + '"></i> ' +
								// 			from + (to ? '&ndash;' + to : '+'));
								// 	}

								// 	div.innerHTML = labels.join('<br><br>');
								// 	return div;
								// };

								// legend.addTo(mymap);
								var legend = L.control({position: 'bottomright'});

								legend.onAdd = function (map) {

									var div = L.DomUtil.create('div', 'info legend'),
										// grades = [0, 10, 20, 50, 100, 200, 500, 1000],
										grades = [0, 30, 70, 100],
										// labels = [],
										labels = ['<strong> สถานการณ์ระดับน้ำ </strong>'],
										from, to;

									// for (var i = 0; i < grades.length; i++) {
									// 	from = grades[i];
									// 	to = grades[i + 1];

									// 	// labels.push(
									// 	// 	'<i style="background:' + getColorStaff(from + 1) + '"></i> ' +
									// 	// 	from + (to ? '&ndash;' + to : '+'));
									// 	// if(i==0) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> น้อย');
										
									// 	// if(i==1) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> ปกติ');
									// 	if(i==1) labels.push('<i style="background:#0f9c4d"></i> ปกติ');
									// 	if(i==2) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> เฝ้าระวัง');
									// 	if(i==3) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> วิกฤติ');
									// }
									for (var i = grades.length; i > 0; i--) {
										from = grades[i];
										to = grades[i + 1];

										// labels.push(
										// 	'<i style="background:' + getColorStaff(from + 1) + '"></i> ' +
										// 	from + (to ? '&ndash;' + to : '+'));																			
										if(i==3) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> น้ำมาก (สูงกว่า 80% ของความจุลำน้ำ)');
										if(i==2) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> น้ำดี (50.1-80% ของความจุลำน้ำ)');
										if(i==1) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> น้ำปกติ (30.1-50% ของความจุลำน้ำ)');
										if(i==0) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> น้ำน้อย (ต่ำกว่า 30% ของความจุลำน้ำ)');
									}

									div.innerHTML = labels.join('<br><br>');
									return div;
								};

								legend.addTo(mymap);								

								<?php																				 
								if($stype==2){									
								?>

								var legend2 = L.control({position: 'bottomright'});

								legend2.onAdd = function (map) {

									var div = L.DomUtil.create('div', 'info legend'),
										// grades = [0, 10, 20, 50, 100, 200, 500, 1000],
										grades = [0, 5, 25, 50, 51],
										// labels = [],
										labels = ['<strong> ข้อมูลฝนเรดาร์ใกล้เวลาจริง </strong>'],
										from, to;

									for (var i = 0; i < grades.length; i++) {
										from = grades[i];
										to = grades[i + 1];

										// labels.push(
										// 	'<i style="background:' + getColorStaff(from + 1) + '"></i> ' +
										// 	from + (to ? '&ndash;' + to : '+'));
										// if(i==0) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> น้อย');
										// if(i==1) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> ฝนเล็กน้อย 0.1-10 มม.');
										if(i==1) labels.push('<i style="background:#0f9c4d"></i> ฝนกำลังอ่อน 0.1-5.0 มม.');
										if(i==2) labels.push('<i style="background:#f7d151"></i> ฝนกำลังปานกลาง 5.1-25.0 มม.');
										if(i==3) labels.push('<i style="background:#ef7972"></i> ฝนกำลังแรง 25.1-50.0 มม.');
										if(i==4) labels.push('<i style="background:#8e0ccf"></i> ฝนกำลังแรงมาก 50.1 มม.');
										// if(i==2) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> ฝนปานกลาง 10-35 มม.');
										// if(i==3) labels.push('<i style="background:' + getColorStaff(from + 1) + '"></i> ฝนหนัก 35-90 มม.');
									}

									div.innerHTML = labels.join('<br><br>');
									return div;
								};

								legend2.addTo(mymap);

								<?php 
								} 
								?>

							</script>							
						</div>
						
						<div class="panel-body no-padding" style="display: block;">
							<!-- <table id="example1" class="table table-striped table-hover table-responsive">
								<thead>
									<tr class="success">
										<th width="5%" style="text-align:center">#</th>
										<th width="10%" style="text-align:center">วันที่รายงาน</th>
										<th width="30%" >หัวข้อ</th>
										<th width="10%" style="text-align:center">วันที่บันทึกข้อมูล</th>
										<th width="10%" style="text-align:center">ดำเนินการ</th>										
									</tr>
								</thead>
								<tbody> -->
								<!-- <?php
									// $i=1;
									// while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
									// 	$mid=$row['id'];
									// 	$code_all=$row['code_all'];
									// 	$mwm_name=$row['mwm_station_name'];
									// 	$lat=$row['latitude'];
									// 	$lon=$row['longitude'];	
								?>
									<tr>
										<td style="text-align:center"><?php // echo $i;?></td>
										<td><?php // echo $code_all." (".$mwm_name.")";?></td>
										<td style="text-align:center">Rain Gauge</td>
										<td style="text-align:center"><a class="btn-default btn" href="mwm_measurement_station.php?mid=<?php //echo $mid;?>">ดูรายการตรวจวัด</a></td>
									</tr>
								<?php
									// 	$i++;
									// }
									// mysqli_free_result($query);
								?>	 -->
									<!-- <tr>
										<td style="text-align:center">1</td>
										<td style="text-align:center">2021-09-08</td>
										<td>รายงานสถานการณ์เตือนภัยวันที่ 8 กันยายน 2564</td>
										<td style="text-align:center">2021-09-08 08:00:00</td>
										<td style="text-align:center"><a class="btn-default btn" href="mwm_measurement_station.php?mid=<?php //echo $mid;?>">แก้ไข</a> <a class="btn-default btn" href="#">ลบ</a></td>
									</tr>
									<tr>
										<td style="text-align:center">2</td>
										<td style="text-align:center">2021-09-07</td>
										<td>รายงานสถานการณ์เตือนภัยวันที่ 7 กันยายน 2564</td>
										<td style="text-align:center">2021-09-08 08:00:00</td>
										<td style="text-align:center"><a class="btn-default btn" href="mwm_measurement_station.php?mid=<?php //echo $mid;?>">แก้ไข</a> <a class="btn-default btn" href="#">ลบ</a></td>
									</tr>
									<tr>
										<td style="text-align:center">3</td>
										<td style="text-align:center">2021-09-06</td>
										<td>รายงานสถานการณ์เตือนภัยวันที่ 6 กันยายน 2564</td>
										<td style="text-align:center">2021-09-08 08:00:00</td>
										<td style="text-align:center"><a class="btn-default btn" href="mwm_measurement_station.php?mid=<?php //echo $mid;?>">แก้ไข</a> <a class="btn-default btn" href="#">ลบ</a></td>
									</tr>
									<tr>
										<td style="text-align:center">4</td>
										<td style="text-align:center">2021-09-06</td>
										<td>รายงานสถานการณ์เตือนภัยวันที่ 5 กันยายน 2564</td>
										<td style="text-align:center">2021-09-08 08:00:00</td>
										<td style="text-align:center"><a class="btn-default btn" href="mwm_measurement_station.php?mid=<?php //echo $mid;?>">แก้ไข</a> <a class="btn-default btn" href="#">ลบ</a></td>
									</tr>
									<tr>
										<td style="text-align:center">5</td>
										<td style="text-align:center">2021-09-06</td>
										<td>รายงานสถานการณ์เตือนภัยวันที่ 4 กันยายน 2564</td>
										<td style="text-align:center">2021-09-08 08:00:00</td>
										<td style="text-align:center"><a class="btn-default btn" href="mwm_measurement_station.php?mid=<?php //echo $mid;?>">แก้ไข</a> <a class="btn-default btn" href="#">ลบ</a></td>
									</tr>
								</tbody> -->
							</table>
						</div>											
					</div>
					<br />
					<div class="panel panel-success" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
						<?php 
						if($stype==2){
						?>
						<div class="panel-heading">
							<h2 style="font-size:20px">รายการข้อมูลพื้นที่น้ำท่วม</h2>
							<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
						</div>											
						<div class="panel-body no-padding" style="display: block;">						
                            <table id="example4" class="table table-striped table-hover table-responsive" style="font-size:20px">
							<thead>
                                    <tr class="success">
                                        <th width="5%" style="text-align:center">#</th>
                                        <th width="10%" style="text-align:center">ตำบล</th>
                                        <th width="10%" style="text-align:center">อำเภอ</th>
                                        <th width="10%" style="text-align:center">จังหวัด</th>											                                        
										<th width="10%" style="text-align:center">พื้นที่น้ำท่วม (ตร.กม.)</th>
										<th width="10%" style="text-align:center">วันที่สร้างข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 									
									$sqlFloodLoc = "SELECT * FROM urbs_floodmap_location WHERE floodmap_id = '".$floodmap_id."'";
									// echo $sqlFloodLoc;
									$qfloodLoc = mysqli_query($conn, $sqlFloodLoc);
									$i=1;
									while ($rowf = mysqli_fetch_array($qfloodLoc,MYSQLI_ASSOC)){
										$subdistrict = $rowf['subdistrict'];
										$district = $rowf['district'];
										$province = $rowf['province'];
										$area_sqkm = $rowf['area_sqkm'];
										$created_date = $rowf['created_date'];
									?>
									<tr>
										<td style="text-align:center;color:red"><?php echo $i;?></td>
										<td style="text-align:center;color:red"><?php echo $subdistrict;?></td>
										<td style="text-align:center;color:red"><?php echo $district;?></td>
										<td style="text-align:center;color:red"><?php echo $province;?></td>
										<td style="text-align:center;color:red"><?php echo $area_sqkm;?></td>
										<td style="text-align:center;color:red"><?php echo $created_date;?></td>
									</tr>
									<?php
										$i++;
									}
									mysqli_free_result($qfloodLoc);
									?>
								</tbody>
							</table>
						</div>
						<?php 
						}
						?>
						<div class="panel-heading">
							<h2 style="font-size:20px">รายการข้อมูลสถานการณ์</h2>
							<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
						</div>																			
						<?php 
						if($stype==1){
						?>
						<div class="panel-body no-padding" style="display: block;">						
                            <table id="example3" class="table table-striped table-hover table-responsive" style="font-size:20px">
								<thead>
                                    <tr class="success">
                                        <th width="5%">#</th>
                                        <th width="15%">ชื่อสถานี</th>
                                        <th width="5%" style="text-align:center">หน่วยงาน</th>
                                        <th width="10%" style="text-align:center">วันที่-เวลา</th>											
                                        <!-- <th width="12%" style="text-align:center">ระดับตลิ่ง (ม.รทก.)</th> -->
										<th width="12%" style="text-align:right">ระดับน้ำ (ม.รทก.)</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php										
									$i=1;
									while ($row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC)){
										$station=$row4['station'];
										$code_all=$row4['code_all'];
										$sg_name=$row4['station_group_name'];
										$lat=$row4['latitude'];
										$lon=$row4['longitude'];			
										$dept_name_eng=$row4['dept_name_eng'];								
										// $waterlevel00_id=$row4['waterlevel00_id'];
										$water_date=$row4['water_date'];
										$water_time=$row4['water_time'];
										$water_value=$row4['nwater_value'];
	
										switch($station){
											case "2224":
												if($water_value==0){
													$badge = "badge-success";
												}elseif($water_value<=$min2224){
													$badge = "badge-success";
													}elseif($water_value>$min2224 && $water_value<=$med2224){
														$badge = "badge-success";
														}elseif($water_value>$med2224 && $water_value<=$max2224){
															$badge = "badge-warning";
															}elseif($water_value>$max2224){
																$badge = "badge-danger";
												}else{
													// $icon = "greyWaterIcon";
													// $icon = "blankWLIcon";
												}
												break;
											case "2225":
												if($water_value==0){
													$badge = "badge-success";
												}elseif($water_value<=$min2225){
													$badge = "badge-success";
													}elseif($water_value>$min2225 && $water_value<=$med2225){
														$badge = "badge-success";
														}elseif($water_value>$med2225 && $water_value<=$max2225){
															$badge = "badge-warning";
															}elseif($water_value>$max2225){
																$badge = "badge-danger";
												}else{
													// $icon = "greyWaterIcon";
													// $icon = "blankWLIcon";
												}
												break;
											case "4328":
												if($water_value==0){
													$badge = "badge-success";
												}elseif($water_value<=$min4328){
													$badge = "badge-success";
													}elseif($water_value>$min4328 && $water_value<=$med4328){
														$badge = "badge-success";
														}elseif($water_value>$med4328 && $water_value<=$max4328){
															$badge = "badge-warning";
															}elseif($water_value>$max4328){
																$badge = "badge-danger";
												}else{
													// $icon = "greyWaterIcon";
													// $icon = "blankWLIcon";
												}
												break;
											default:
												if($water_value==0){
													$badge = "badge-success";
												}elseif($water_value>0 && $water_value<=10){
													$badge = "badge-success";
													}elseif($water_value>10 && $water_value<=35){
														$badge = "badge-success";
														}elseif($water_value>35 && $water_value<=90){
															$badge = "badge-warning";
															}elseif($water_value>90){
																$badge = "badge-danger";
												}else{
													// $icon = "greyWaterIcon";
													// $icon = "blankWLIcon";
												}
										}
										// if($water_value==0){
										// 	// $badge = "badge-nodata";
										// 	$badge = "badge-success";
										// }elseif($water_value>0 && $water_value<=10){
										// 	// $badge = "badge-primary";
										// 	$badge = "badge-success";
										// 	}elseif($water_value>10 && $water_value<=35){
										// 		$badge = "badge-success";
										// 		}elseif($water_value>35 && $water_value<=90){
										// 			$badge = "badge-warning";
										// 			}elseif($water_value>90){
										// 				$badge = "badge-danger";
										// }
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $code_all;?> (<?php echo $sg_name;?>)</td>
										<td style="text-align:center"><?php echo $dept_name_eng;?></td>
										<td style="text-align:center"><?php echo $water_date." ".$water_time.":00";?></td>
										<!-- <td style="text-align:center;color:green">-</td> -->
										<td><span class="badge <?php echo $badge;?>"><?php echo number_format($water_value,2);?></span></td>
									</tr>
									<!-- <tr>
										<td>2</td>
										<td>Z.38 (คลองทับมา บ้านเขาโบสถ์)</td>
										<td style="text-align:center">RID</td>
										<td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>										
										<td><span class="badge badge-primary">0.70</span></td>
									</tr>
									<tr>
                                        <td>3</td>
                                        <td>RAY004 (บ้านค่าย)</td>
                                        <td style="text-align:center">HII</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>                                        
										<td><span class="badge badge-primary">0.99</span></td>
                                    </tr>
									<tr>
                                        <td>4</td>
                                        <td>MD.02 (ปากน้ำระยอง)</td>
                                        <td style="text-align:center">MD</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr> -->
									<?php
										$i++;
									}
									mysqli_free_result($query4);

									while ($row4all = mysqli_fetch_array($query4_all,MYSQLI_ASSOC)){
										if (!in_array($row4all["id"], $arrStation)){																			
											$code_all=$row4all['code_all'];
											$sg_name=$row4all['station_group_name'];
											$lat=$row4all['latitude'];
											$lon=$row4all['longitude'];
											$dept_name_eng=$row4all['dept_name_eng'];
											$icon = "blankWLIcon";
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $code_all;?> (<?php echo $sg_name;?>)</td>
										<td style="text-align:center"><?php echo $dept_name_eng;?></td>
										<td style="text-align:center"><?php echo $sitdate." ".$sittime.":00";?></td>
										<!-- <td style="text-align:center;color:green">-</td> -->
										<td style="text-align:right">N/A</td>
									</tr>
									<?php
										}	
										$i++;										
									}
									mysqli_free_result($query4_all);

									$i=5;	
									while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
										$code_all=$row['external_id'];									
										$mwm_name=$row['shortname'];
										$lat=$row['lat'];
										$lon=$row['lon'];
										$created_date=$row['created_date'];
										$accepted_value=$row['accepted_value'];	
										$mmid=$row['id'];
										$mid=$row['meter'];

										if($accepted_value==0){
											$badge = "badge-nodata";
										}elseif($accepted_value>0 && $accepted_value<=10){
												$badge = "badge-primary";
											}elseif($accepted_value>10 && $accepted_value<=35){
												$badge = "badge-success";
												}elseif($accepted_value>35 && $accepted_value<=90){
													$badge = "badge-warning";
													}elseif($accepted_value>90){
														$badge = "badge-danger";
										}					
									?>

									<tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $code_all." (".$mwm_name.")";?></td>
                                        <td style="text-align:center">MWM</td>
                                        <td style="text-align:center"><?php echo $created_date;?></td>											
                                        <!-- <td style="text-align:center;color:green">-</td> -->
										<td style="text-align:center"><span class="badge <?php echo $badge;?>"><?php echo $accepted_value;?></span></td>
                                    </tr>

									<?php
										$i++;
									}
									mysqli_free_result($query);

									while ($rowall = mysqli_fetch_array($query_all,MYSQLI_ASSOC)){
										if(count($arrMWMStation)>0){
											if (!in_array($rowall["id"], $arrMWMStation)){																			
												$code_all=$rowall['code_all'];
												$mwm_name=$rowall['mwm_station_name'];
												$lat=$rowall['lat'];
												$lon=$rowall['lon'];										
												// $created_date=$rowall['created_date'];
												$icon = "blankWLIcon";
											}
										}else{
											$code_all=$rowall['code_all'];
											$mwm_name=$rowall['mwm_station_name'];
											$lat=$rowall['lat'];
											$lon=$rowall['lon'];										
											// $created_date=$rowall['created_date'];
											$icon = "blankWLIcon";
										}	
									?>
									<tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $code_all." (".$mwm_name.")";?></td>
                                        <td style="text-align:center">MWM</td>
                                        <td style="text-align:center"><?php echo $sitdate." ".$sittime.":00";?></td>
                                        <!-- <td style="text-align:center;color:green">-</td> -->
										<td style="text-align:right">N/A</td>
                                    </tr>
									<?php
										$i++;
									}
									mysqli_free_result($query_all);


									?>

									<!-- <tr>
                                        <td>6</td>
                                        <td>CS_WRY.04</td>
                                        <td style="text-align:center">MWM</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>	
									<tr>
                                        <td>7</td>
                                        <td>CS_WRY.03</td>
                                        <td style="text-align:center">MWM</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>								                                    									 -->
									                                                                        
                                </tbody>
                            </table>
						</div>
						<?php 
						}else{
						?>						
						<div class="panel-body no-padding" style="display: block;">						
                            <table id="example3" class="table table-striped table-hover table-responsive" style="font-size:20px">
								<thead>
                                    <tr class="success">
                                        <th width="5%">#</th>
                                        <th width="8%">ชื่อสถานี</th>
                                        <th width="27%" style="text-align:center">รายละเอียด</th>
                                        <th width="10%" style="text-align:center">วันที่-เวลา</th>											
                                        <!-- <th width="12%" style="text-align:center">ระดับตลิ่ง (ม.รทก.)</th> -->
										<th width="13%" style="text-align:right">อัตราการไหล (ลบ.ม./วินาที)</th>
                                    </tr>
                                </thead>
                                <tbody>
									<!-- <tr>
										<td>1</td>
										<td>MRY_Z62</td>
										<td style="text-align:left">แม่น้ำระยอง ณ ที่ตั้งสถานี Z.62 (กรมชลประทาน)</td>
										<td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>										
										<td><span class="badge badge-primary">2.47</span></td>
									</tr>
									<tr>
										<td>2</td>
										<td>MRY_02</td>
										<td style="text-align:left">แม่น้ำระยอง ณ ที่ตั้งสถานี CS_WRY.01 (สถานีพลเมือง) และท้ายจุดบรรจบคลองยายล้ำ</td>
										<td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>										
										<td><span class="badge badge-primary">0.70</span></td>
									</tr>
									<tr>
                                        <td>3</td>
                                        <td>MRY_03</td>
                                        <td style="text-align:left">แม่น้ำระยอง ท้ายจุดบรรจบคลองอ่าง</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>                                        
										<td><span class="badge badge-primary">0.99</span></td>
                                    </tr>
									<tr>
                                        <td>4</td>
                                        <td>MRY_RAY004</td>
                                        <td style="text-align:left">แม่น้ำระยอง ณ ที่ตั้งสถานี RAY004 (สถาบันสารสนเทศทรัพยากรน้ํา (องค์การมหาชน))</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>5</td>
                                        <td>MRY_05</td>
                                        <td style="text-align:left">แม่น้ำระยอง ท้ายจุดบรรจบคลองจัด </td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>6</td>
                                        <td>MRY_06</td>
                                        <td style="text-align:left">แม่น้ำระยอง ท้ายจุดบรรจบคลองทับมา ณ สถานี CS_WRY.03 (สถานีพลเมือง)</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>	
									<tr>
                                        <td>7</td>
                                        <td>MRY_07</td>
                                        <td style="text-align:left">แม่น้ำระยอง ท้ายจุดบรรจบคลองคา</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                    
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>8</td>
                                        <td>MRY_08</td>
                                        <td style="text-align:left">จุดออกทะเล ณ ที่ตั้งสถานี MD.02 (กรมเจ้าท่า)</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>9</td>
                                        <td>MTM_Z38</td>
                                        <td style="text-align:left">ณ ที่ตั้งสถานี Z.38 (กรมชลประทาน)</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>10</td>
                                        <td>MTM_02</td>
                                        <td style="text-align:left">คลองทับมาบริเวณ ต.ทับมา ถนนเกาะพรวด</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>11</td>
                                        <td>MTM_03</td>
                                        <td style="text-align:left">คลองทับมาบริเวณ ต.ทับมา ถนนทุ่งนอก-สะพานแตง</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr>
									<tr>
                                        <td>12</td>
                                        <td>MTM_04</td>
                                        <td style="text-align:left">จุดออกลุ่มน้ำทับมา ณ สถานี CS_WRY.04  (สถานีพลเมือง)</td>
                                        <td style="text-align:center"><?php echo "2022-03-14 11:30:00";?></td>											                                        
										<td><span class="badge badge-success">11.66</span></td>
                                    </tr> -->
									<?php										
									$i=1;
									while ($row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC)){										
										$code_all=$row4['code_all'];
										$sg_name=$row4['station_group_name'];
										$lat=$row4['latitude'];
										$lon=$row4['longitude'];			
										// $dept_name_eng=$row4['dept_name_eng'];								
										// $waterlevel00_id=$row4['waterlevel00_id'];
										$water_date=$row4['datetime'];
										$water_time=$row4['datetime'];
										$water_value=$row4['nwater_value'];
	
										// if($water_value==0){
										// 	// $badge = "badge-nodata";
										// 	$badge = "badge-success";
										// }elseif($water_value>0 && $water_value<=10){
										// 	// $badge = "badge-primary";
										// 	$badge = "badge-success";
										// 	}elseif($water_value>10 && $water_value<=35){
										// 		$badge = "badge-success";
										// 		}elseif($water_value>35 && $water_value<=90){
										// 			$badge = "badge-warning";
										// 			}elseif($water_value>90){
										// 				$badge = "badge-danger";
										// }
										if($code_all=="MRY_08"){
											if($water_value>=0){
												$badge = "badge-success";
											}else{
												$badge = "badge-success";
											}											
										}else{					
											switch($code_all){
												case "MRY_Z62":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mry01){
														$badge = "badge-success";
														}elseif($water_value>$min_mry01 && $water_value<=$med_mry01){
															$badge = "badge-success";
															}elseif($water_value>$med_mry01 && $water_value<=$max_mry01){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry01){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MRY_02":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mry02){
														$badge = "badge-success";
														}elseif($water_value>$min_mry02 && $water_value<=$med_mry02){
															$badge = "badge-success";
															}elseif($water_value>$med_mry02 && $water_value<=$max_mry02){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry02){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MRY_03":
													if($water_value==0){
														$icon = "greenWLIcon";
													}elseif($water_value<=$min_mry03){
														$icon = "greenWLIcon";
														}elseif($water_value>$min_mry03 && $water_value<=$med_mry03){
															$icon = "greenWLIcon";
															}elseif($water_value>$med_mry03 && $water_value<=$max_mry03){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry03){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MRY_RAY004":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mry04){
														$badge = "badge-success";
														}elseif($water_value>$min_mry04 && $water_value<=$med_mry04){
															$badge = "badge-success";
															}elseif($water_value>$med_mry04 && $water_value<=$max_mry04){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry04){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MRY_05":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mry05){
														$badge = "badge-success";
														}elseif($water_value>$min_mry05 && $water_value<=$med_mry05){
															$badge = "badge-success";
															}elseif($water_value>$med_mry05 && $water_value<=$max_mry05){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry05){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MRY_06":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mry06){
														$badge = "badge-success";
														}elseif($water_value>$min_mry06 && $water_value<=$med_mry06){
															$badge = "badge-success";
															}elseif($water_value>$med_mry06 && $water_value<=$max_mry06){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry06){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MRY_07":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mry07){
														$badge = "badge-success";
														}elseif($water_value>$min_mry07 && $water_value<=$med_mry07){
															$badge = "badge-success";
															}elseif($water_value>$med_mry07 && $water_value<=$max_mry07){
																$badge = "badge-warning";
																}elseif($water_value>$max_mry07){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MTM_Z38":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mtm01){
														$badge = "badge-success";
														}elseif($water_value>$min_mtm01 && $water_value<=$med_mtm01){
															$badge = "badge-success";
															}elseif($water_value>$med_mtm01 && $water_value<=$max_mtm01){
																$badge = "badge-warning";
																}elseif($water_value>$max_mtm01){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MTM_02":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mtm02){
														$badge = "badge-success";
														}elseif($water_value>$min_mtm02 && $water_value<=$med_mtm02){
															$badge = "badge-success";
															}elseif($water_value>$med_mtm02 && $water_value<=$max_mtm02){
																$badge = "badge-warning";
																}elseif($water_value>$max_mtm02){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;
												case "MTM_03":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mtm03){
														$badge = "badge-success";
														}elseif($water_value>$min_mtm03 && $water_value<=$med_mtm03){
															$badge = "badge-success";
															}elseif($water_value>$med_mtm03 && $water_value<=$max_mtm03){
																$badge = "badge-warning";
																}elseif($water_value>$max_mtm03){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;	
												case "MTM_04":
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value<=$min_mtm04){
														$badge = "badge-success";
														}elseif($water_value>$min_mtm04 && $water_value<=$med_mtm04){
															$badge = "badge-success";
															}elseif($water_value>$med_mtm04 && $water_value<=$max_mtm04){
																$badge = "badge-warning";
																}elseif($water_value>$max_mtm04){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
													break;	
												default:
													if($water_value==0){
														$badge = "badge-success";
													}elseif($water_value>0 && $water_value<=10){
														$badge = "badge-success";
														}elseif($water_value>10 && $water_value<=35){
															$badge = "badge-success";
															}elseif($water_value>35 && $water_value<=90){
																$badge = "badge-warning";
																}elseif($water_value>90){
																	$badge = "badge-danger";
													}else{
														// $icon = "greyWaterIcon";
														$badge = "badge-success";
													}
											}

										}

									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $code_all;?></td>										
										<td><?php echo $sg_name;?></td>										
										<td style="text-align:center"><?php echo $water_date;?></td>										
										<td><span class="badge <?php echo $badge;?>"><?php echo number_format($water_value,2);?></span></td>
									</tr>
									
									<?php
										$i++;
									}
									mysqli_free_result($query4);

									?>
									<?php										
									// $i=1;
									while ($row4_novalue = mysqli_fetch_array($query4_novalue,MYSQLI_ASSOC)){										
										$code_all=$row4_novalue['code_all'];
										$sg_name=$row4_novalue['station_group_name'];
										$lat=$row4_novalue['latitude'];
										$lon=$row4_novalue['longitude'];			
										// $dept_name_eng=$row4['dept_name_eng'];								
										// $waterlevel00_id=$row4['waterlevel00_id'];
										// $water_date=$row4['datetime'];
										// $water_time=$row4['datetime'];
										// $water_value=$row4['nwater_value'];
	
										// if($water_value==0){
										// 	// $badge = "badge-nodata";
										// 	$badge = "badge-success";
										// }elseif($water_value>0 && $water_value<=10){
										// 	// $badge = "badge-primary";
										// 	$badge = "badge-success";
										// 	}elseif($water_value>10 && $water_value<=35){
										// 		$badge = "badge-success";
										// 		}elseif($water_value>35 && $water_value<=90){
										// 			$badge = "badge-warning";
										// 			}elseif($water_value>90){
										// 				$badge = "badge-danger";
										// }
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $code_all;?></td>										
										<td><?php echo $sg_name;?></td>										
										<td style="text-align:center"><?php echo $sitdatetime.":00";?></td>										
										<td style="text-align:right">N/A</td>
									</tr>
									
									<?php
										$i++;
									}
									mysqli_free_result($query4_novalue);

									?>
									                                                                        
                                </tbody>
                            </table>
						</div>
						<?php 
						}
						?>											
					</div>
					<br />
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-xl">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Water Level Stations</h4>
							</div>
							<div class="modal-body">
								<!-- <p>Some text in the modal.</p> -->
								<table id="example2" class="table table-striped table-hover table-responsive">
								<thead>
									<tr class="success">
										<th width="5%" style="text-align:center">#</th>
										<th width="15%" style="text-align:center">Name</th>
										<th width="10%" >Department</th>
										<th width="10%" style="text-align:center">Date-time</th>
										<th width="15%" style="text-align:center">ระดับน้ำ (ม.รทก.</th>										
									</tr>									
								</thead>
								<tr>
										<td>1</td>
										<td>Z.62 (คลองใหญ่)</td>
										<td>RID</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-primary">0.99</span></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Z.38 (คลองทับมา บ้านเขาโบสถ์)</td>
										<td>RID</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-primary">0.99</span></td>
									</tr>
									<tr>
										<td>3</td>
										<td>RAY004 (บ้านค่าย)</td>
										<td>HII</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-primary">0.99</span></td>
									</tr>
									<tr>
										<td>4</td>
										<td>MD.02 (ปากน้ำระยอง)</td>
										<td>MD</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-nodata">0.0</span></td>
									</tr>
									<tr>
										<td>5</td>
										<td>CS_WRY.01</td>
										<td>MWM</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-nodata"></span></td>
									</tr>
									<tr>
										<td>6</td>
										<td>CS_WRY.03</td>
										<td>MWM</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-nodata"></span></td>
									</tr>
									<tr>
										<td>7</td>
										<td>CS_WRY.04</td>
										<td>MWM</td>
										<td style="text-align:center">2022-03-16 00:00</td>
										<td><span class="badge badge-nodata"></span></td>
									</tr>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>

						</div>
					</div>
					<!-- Modal -->
					<div id="myModalRed" class="modal fade" role="dialog">
						<div class="modal-dialog modal-xl">

							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Water Level Stations</h4>
							</div>
							<div class="modal-body">
								<!-- <p>Some text in the modal.</p> -->
								<table id="example3" class="table table-striped table-hover table-responsive">
								<thead>
									<tr class="success">
										<th width="5%" style="text-align:center">#</th>
										<th width="15%" style="text-align:center">Name</th>
										<th width="10%" >Department</th>
										<th width="10%" style="text-align:center">Date-time</th>
										<th width="15%" style="text-align:center">ระดับน้ำ (ม.รทก.</th>										
									</tr>									
								</thead>
								<tr>
										<td>1</td>
										<td>Z.62 (คลองใหญ่)</td>
										<td>RID</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-danger">109.99</span></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Z.38 (คลองทับมา บ้านเขาโบสถ์)</td>
										<td>RID</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-primary">0.99</span></td>
									</tr>
									<tr>
										<td>3</td>
										<td>RAY004 (บ้านค่าย)</td>
										<td>HII</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-primary">0.99</span></td>
									</tr>
									<tr>
										<td>4</td>
										<td>MD.02 (ปากน้ำระยอง)</td>
										<td>MD</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-nodata">0.0</span></td>
									</tr>
									<tr>
										<td>5</td>
										<td>CS_WRY.01</td>
										<td>MWM</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-nodata"></span></td>
									</tr>
									<tr>
										<td>6</td>
										<td>CS_WRY.03</td>
										<td>MWM</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-nodata"></span></td>
									</tr>
									<tr>
										<td>7</td>
										<td>CS_WRY.04</td>
										<td>MWM</td>
										<td style="text-align:center">2022-03-16 23:00</td>
										<td><span class="badge badge-nodata"></span></td>
									</tr>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
							</div>

						</div>
					</div>
					<!-- <div class="bs-example4" data-example-id="simple-responsive-table">
						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th>#</th>
									<th>Table heading</th>
									<th>Table heading</th>
									<th>Table heading</th>
									<th>Table heading</th>
									<th>Table heading</th>
									<th>Table heading</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
									<td>Table cell</td>
								</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>#</th>
								<th>Table heading</th>
								<th>Table heading</th>
								<th>Table heading</th>
								<th>Table heading</th>
								<th>Table heading</th>
								<th>Table heading</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
								<td>Table cell</td>
							</tr>
							</tbody>
						</table>
						</div>
					</div> -->
				</div><!-- /.xs -->

			<!-- <div class="copy_layout">
				<p>Copyright © 2015 Modern. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div> -->
			<?php include ('../includes/footer.php');?>
			</div><!-- /.col-md-12 graphs -->
		</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<link href="../css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<script src="../js/custom.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../Datatables/jquery.dataTables.min.js"></script>
<script src="../Datatables/dataTables.bootstrap.min.js"></script>

<script>
$(function () {
	$('document').ready(function()
	{
		$('textarea').each(function(){
				$(this).val($(this).val().trim());
			}
		);
	});
	/*
	$("#example1").DataTable({			
			"columnDefs": [
				{ "visible": false, "targets": [0] }
			],
			//"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
			"order": [[ 0, 'desc' ]],
			"displayLength": 25,
			
			"drawCallback": function ( settings ) {
				var api = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last=null;
	
				api.column(0, {page:'current'} ).data().each( function ( group, i ) {
					if ( last !== group ) {
						$(rows).eq( i ).before(
							'<tr class="group"><td colspan=8">'+group+'</td></tr>'
						);
	
						last = group;
					}
				} );			
			},
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": false,
			"autoWidth": false			
		}
	);
	*/
	$("#example1").DataTable({
		"responsive": true,
		// "scrollX": true,
		// "columnDefs": [{
		// "visible": false,
		// "targets": [2,3]
		// }],
		//"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
		// "order": [
		//     [2, 'asc'],[3, 'asc']
		// ],
		"displayLength": 10,
		"drawCallback": function (settings) {
			var api = this.api();
		var rows = api.rows({
			page: 'current'
		}).nodes();
		var last = null;
		},   
		"language": {
			"sProcessing": "กำลังดำเนินการ...",
			"sLengthMenu": "แสดง_MENU_ ต่อหน้า",
			"sZeroRecords": "ไม่พบข้อมูล",
			"sInfo": "แสดงผล _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
			"sInfoEmpty": "แสดงผล 0 ถึง 0 จากทั้งหมด 0 รายการ",
			"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกรายการ)",
			"sInfoPostFix": "",
			"sSearch": "ค้นหา:",
			"sUrl": "",
			"oPaginate": {
							"sFirst": "เิริ่มต้น",
							"sPrevious": "ก่อนหน้า",
							"sNext": "ถัดไป",
							"sLast": "สุดท้าย"
			},
			"searchPlaceholder": "ระบุคำค้นหา"
		},
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": true	
	});

	$("#example2").DataTable({
		"responsive": true,
		// "scrollX": true,
		// "columnDefs": [{
		// "visible": false,
		// "targets": [2,3]
		// }],
		//"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
		// "order": [
		//     [2, 'asc'],[3, 'asc']
		// ],
		"displayLength": 10,
		"drawCallback": function (settings) {
			var api = this.api();
		var rows = api.rows({
			page: 'current'
		}).nodes();
		var last = null;
		},   
		"language": {
			"sProcessing": "กำลังดำเนินการ...",
			"sLengthMenu": "แสดง_MENU_ ต่อหน้า",
			"sZeroRecords": "ไม่พบข้อมูล",
			"sInfo": "แสดงผล _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
			"sInfoEmpty": "แสดงผล 0 ถึง 0 จากทั้งหมด 0 รายการ",
			"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกรายการ)",
			"sInfoPostFix": "",
			"sSearch": "ค้นหา:",
			"sUrl": "",
			"oPaginate": {
							"sFirst": "เิริ่มต้น",
							"sPrevious": "ก่อนหน้า",
							"sNext": "ถัดไป",
							"sLast": "สุดท้าย"
			},
			"searchPlaceholder": "ระบุคำค้นหา"
		},
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": true	
	});	

	$("#example3").DataTable({
		"responsive": true,
		// "scrollX": true,
		// "columnDefs": [{
		// "visible": false,
		// "targets": [2,3]
		// }],
		//"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
		// "order": [
		//     [2, 'asc'],[3, 'asc']
		// ],
		"displayLength": 25,
		"drawCallback": function (settings) {
			var api = this.api();
		var rows = api.rows({
			page: 'current'
		}).nodes();
		var last = null;
		},   
		"language": {
			"sProcessing": "กำลังดำเนินการ...",
			"sLengthMenu": "แสดง_MENU_ ต่อหน้า",
			"sZeroRecords": "ไม่พบข้อมูล",
			"sInfo": "แสดงผล _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
			"sInfoEmpty": "แสดงผล 0 ถึง 0 จากทั้งหมด 0 รายการ",
			"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกรายการ)",
			"sInfoPostFix": "",
			"sSearch": "ค้นหา:",
			"sUrl": "",
			"oPaginate": {
							"sFirst": "เิริ่มต้น",
							"sPrevious": "ก่อนหน้า",
							"sNext": "ถัดไป",
							"sLast": "สุดท้าย"
			},
			"searchPlaceholder": "ระบุคำค้นหา"
		},
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": true	
	});

	$("#example4").DataTable({
		"responsive": true,
		// "scrollX": true,
		// "columnDefs": [{
		// "visible": false,
		// "targets": [2,3]
		// }],
		//"order": [[ 0, 'asc' ],[ 1, 'asc' ],[ 3, 'asc' ],[ 4, 'asc' ]],
		// "order": [
		//     [2, 'asc'],[3, 'asc']
		// ],
		"displayLength": 25,
		"drawCallback": function (settings) {
			var api = this.api();
		var rows = api.rows({
			page: 'current'
		}).nodes();
		var last = null;
		},   
		"language": {
			"sProcessing": "กำลังดำเนินการ...",
			"sLengthMenu": "แสดง_MENU_ ต่อหน้า",
			"sZeroRecords": "ไม่พบข้อมูล",
			"sInfo": "แสดงผล _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
			"sInfoEmpty": "แสดงผล 0 ถึง 0 จากทั้งหมด 0 รายการ",
			"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกรายการ)",
			"sInfoPostFix": "",
			"sSearch": "ค้นหา:",
			"sUrl": "",
			"oPaginate": {
							"sFirst": "เิริ่มต้น",
							"sPrevious": "ก่อนหน้า",
							"sNext": "ถัดไป",
							"sLast": "สุดท้าย"
			},
			"searchPlaceholder": "ระบุคำค้นหา"
		},
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": true	
	});

	// $('#example2').DataTable({
	//   "paging": false,
	//   "lengthChange": false,
	//   "searching": false,
	//   "ordering": false,
	//   "info": false,
	//   "autoWidth": false
	// });
	// $('#example3').DataTable({
	//   "paging": false,
	//   "lengthChange": false,
	//   "searching": false,
	//   "ordering": false,
	//   "info": false,
	//   "autoWidth": false
	// });
	// $('#example4').DataTable({
	//   "paging": false,
	//   "lengthChange": false,
	//   "searching": false,
	//   "ordering": false,
	//   "info": false,
	//   "autoWidth": false
	// });
});
</script>

<script>
	function randomDate(start, end) {
		var date = new Date(+start + Math.random() * (end - start));
		var out = String(date.getFullYear())+ "-";
		if (date.getMonth() + 1 < 10)
			out += "0" + String(date.getMonth() + 1);
		else
			out += String(date.getMonth() + 1);
		out += "-";
		if (date.getDate() < 10)
			out += "0" + String(date.getDate());
		else
			out += String(date.getDate());
		return out;
	}

	var events = ( Math.random() * 200 ).toFixed(0);
	var data = [];
	for (var i = 0; i < events; i++ ) {
		var current = new Date();
		var rndStart = new Date( current.getFullYear() - 1, current.getMonth() - 5, current.getDate() );
		data.push({
			count: parseInt( ( Math.random() * 200 ).toFixed(0) ),
			date: randomDate( rndStart.valueOf(), current.valueOf() )
		});
	}
	// data = [
	// 	{ count: 10, date: '2022-03-21 10:00'},
	// 	{ count: 1, date: '2022-03-22 11:00'},
	// 	{ count: 1, date: '2022-03-23 12:00'},
	// 	{ count: 1, date: '2022-03-24 13:00'},
	// 	{ count: 1, date: '2022-03-25 14:00'},
	// ];

	// $("#heatmap-1").CalendarHeatmap(data, {
	// 	// title: "Default Layout"
	// 	lastMonth: new Date().getMonth() + 1,
	// 	coloring: "red",
	// 	legend: {
	// 		minLabel: "Fewer"
	// 	},
	// });

	// $("#heatmap-2").CalendarHeatmap(data, {
	// 	title: "Gradient \"red\", end one month from current",
	// 	lastMonth: new Date().getMonth() + 1,
	// 	coloring: "red",
	// 	legend: {
	// 		minLabel: "Fewer"
	// 	},
	// 	labels: {
	// 		custom: {
	// 			monthLabels: "MMM"
	// 		}
	// 	}
	// });

	// $("#heatmap-3").CalendarHeatmap(data, {
	// 	title: "Gradient \"electric\", labels days and custom month labels, end one year from current, week starts on Sunday",
	// 	months: 5,
	// 	lastYear: new Date().getFullYear() - 1,
	// 	coloring: "electric",
	// 	legend: {
	// 		align: "left",
	// 		minLabel: "Fewer"
	// 	},
	// 	weekStartDay: 0,
	// 	labels: {
	// 		days: true,
	// 		custom: {
	// 			monthLabels: "MMM 'YY"
	// 		}
	// 	},
	// 	tooltips:{
	// 		show: true
	// 	}
	// });

	// $("#heatmap-4").CalendarHeatmap( data, {
	// 	title: "Tile shape \"Circle\" and using Moment to localize Weekday and Month Labels",
	// 	tiles: {
	// 		shape: "circle"
	// 	},
	// 	labels: {
	// 		months: true,
	// 		days: true,
	// 		custom: {
	// 			weekDayLabels: function( weekday ) {
	// 				moment.locale('ar');
	// 				return moment.weekdays(true, weekday);
	// 			},
	// 			monthLabels: function( year, month ) {
	// 				moment.locale('ar');
	// 				return moment.months(true, month) 
	// 					+ " '"
	// 					+ moment().year(year).format("YY");
	// 			}
	// 		}
	// 	}
	// });

	// $("#heatmap-5").CalendarHeatmap( [], {
	// 	title: "Interactive",
	// 	labels: {
	// 		days: true,
	// 		custom: {
	// 			weekDayLabels: "dd"
	// 		}
	// 	}
	// });

	// $("#heatmap-5-random").on("click", function(){

	// 	var events = ( Math.random() * 200 ).toFixed(0);
	// 	var data = [];
	// 	for (var i = 0; i < events; i++ ) {
	// 		var current = new Date();
	// 		var rndStart = new Date( current.getFullYear() - 1, current.getMonth() - 5, current.getDate() );
	// 		data.push({
	// 			count: parseInt( ( Math.random() * 200 ).toFixed(0) ),
	// 			date: randomDate( rndStart.valueOf(), current.valueOf() )
	// 		});
	// 	}

	// 	$("#heatmap-5").CalendarHeatmap( 'updateDates', data );
	// });

	// $("#heatmap-5-empty").on("click", function(){
	// 	$("#heatmap-5").CalendarHeatmap( 'updateDates', [] );
	// });

	// $("#heatmap-5-append").on("click", function(){
	// 	var events = ( Math.random() * 10 ).toFixed(0);
	// 	var data = [];
	// 	for (var i = 0; i < events; i++ ) {
	// 		var current = new Date();
	// 		var rndStart = new Date( current.getFullYear() - 1, current.getMonth() - 5, current.getDate() );
	// 		data.push({
	// 			count: parseInt( ( Math.random() * 200 ).toFixed(0) ),
	// 			date: randomDate( rndStart.valueOf(), current.valueOf() )
	// 		});
	// 	}
	// 	$("#heatmap-5").CalendarHeatmap( 'appendDates', data );
	// });

	// $("#heatmap-5-wkday").on("click", function(){
	// 	var labels = $("#heatmap-5").CalendarHeatmap( 'getOptions' ).labels;
	// 	$("#heatmap-5").CalendarHeatmap( 'updateOptions', {
	// 		labels: {
	// 			days: (labels.days === true)? false : true
	// 		}
	// 	} );
	// });

	// $("#heatmap-5-coloring").on("change", function(){
	// 	$("#heatmap-5").CalendarHeatmap( 'updateOptions', {
	// 		coloring: $(this).val(),
	// 		legend: {
	// 			divider: " - "
	// 		}
	// 	} );
	// });

	// Highcharts.chart('container-heatmap', {
	// 	chart: {
	// 		type: 'heatmap',
	// 		inverted: true
	// 	},

	// 	data: {
	// 		csv: document.getElementById('csv').innerHTML,
	// 	},

	// 	title: {
	// 		// text: 'Highcharts heat map',
	// 		// align: 'left'
	// 		text: 'รายงานสถานการณ์จากสถานีตรวจวัด'
	// 	},

	// 	subtitle: {
	// 		// text: 'Temperature variation by day and hour through May 2017',
	// 		// text: 'รายงานสถานการณ์จากสถานีตรวจวัด',			
	// 		// align: 'left'
	// 	},
	// 	<?php 
	// 	if($stype==1){
	// 	?>
	// 	xAxis: {
	// 		tickPixelInterval: 50,
	// 		min: Date.UTC(2022, 3, 02),
	// 		max: Date.UTC(2022, 3, 04)
	// 	},
	// 	<?php 
	// 	}else{
	// 	?>
	// 	xAxis: {
	// 		tickPixelInterval: 50,
	// 		min: Date.UTC(2022, 3, 03),
	// 		max: Date.UTC(2022, 3, 05)
	// 	},
	// 	<?php
	// 	}
	// 	?>

	// 	yAxis: {
	// 		title: {
	// 			text: null
	// 		},
	// 		labels: {
	// 			format: '{value}:00'
	// 		},
	// 		minPadding: 0,
	// 		maxPadding: 0,
	// 		startOnTick: false,
	// 		endOnTick: false,
	// 		tickPositions: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
	// 		tickWidth: 1,
	// 		min: 0,
	// 		max: 23
	// 	},

	// 	colorAxis: {
	// 		// stops: [
	// 		// 	[0, '#3060cf'],
	// 		// 	[0.5, '#fffbbc'],
	// 		// 	[0.9, '#c4463a']
	// 		// ],
	// 		stops: [
	// 			[0, '#109c4d'],
	// 			[0.5, '#ffc107'],
	// 			[0.9, '#c4463a'],
	// 		],
	// 		// stops: [
	// 		// 	[0, '#73b2ff'],
	// 		// 	[0.3, '#109c4d'],
	// 		// 	[0.6, '#ffc107'],
	// 		// 	[0.9, '#c4463a']
	// 		// ],
	// 		// stops: [
	// 		// 	[0, '#ebe9e9'],
	// 		// 	[1, '#00aced'],
	// 		// 	[2, '#8bc34a'],
	// 		// 	[3, '#ffc107'],
	// 		// 	[4, '#f44336'],
	// 		// ],
	// 		// min: -5
	// 	},
		
	// 	series: [{
	// 		borderWidth: 0,
	// 			// data: [{
	// 			// 		x: '2022-04-02',
	// 			// 		y: 0,
	// 			// 		value: 3,
	// 			// 		borderWidth: 10,
	// 			// 		borderColor: 'green'
	// 			// 	}, {
	// 			// 		x: '2022-04-02',
	// 			// 		y: 1,
	// 			// 		value: 2,
	// 			// 		borderWidth: 10,
	// 			// 		borderColor: 'orange'
	// 			// 	}, {
	// 			// 		x: '2022-04-02',
	// 			// 		y: 2,
	// 			// 		value: 1,
	// 			// 		borderWidth: 10,
	// 			// 		borderColor: 'red'
	// 			// 	},
	// 			// 	['2022-04-02', 3, 1],
	// 			// 	{
	// 			// 		x: '2022-04-04',
	// 			// 		y: 18,
	// 			// 		value: 2,
	// 			// 		borderWidth: 10,
	// 			// 		borderColor: 'red'
	// 			// 	}
	// 			// ],
	// 			// data: [
	// 			// 	['2022-04-02', 0, 1],
	// 			// 	['2022-04-02', 1, 1],
	// 			// 	['2022-04-02', 2, 1],
	// 			// 	['2022-04-02', 3, 1],
	// 			// 	['2022-04-02', 4, 1],
	// 			// 	['2022-04-02', 5, 1],
	// 			// 	['2022-04-02', 6, 1],
	// 			// 	['2022-04-02', 7, 1],
	// 			// 	['2022-04-02', 8, 1],
	// 			// 	['2022-04-02', 9, 1],
	// 			// 	['2022-04-02', 10, 1],
	// 			// 	['2022-04-02', 11, 1],
	// 			// 	['2022-04-02', 12, 1],
	// 			// 	['2022-04-02', 13, 1],
	// 			// 	['2022-04-02', 14, 1],
	// 			// 	['2022-04-02', 15, 1],
	// 			// 	['2022-04-02', 16, 1],
	// 			// 	['2022-04-02', 17, 1],
	// 			// 	['2022-04-02', 18, 1],
	// 			// 	['2022-04-02', 19, 1],
	// 			// 	['2022-04-02', 20, 1],
	// 			// 	['2022-04-02', 21, 1],
	// 			// 	['2022-04-02', 22, 1],
	// 			// 	['2022-04-02', 23, 1],
	// 			// ],
	// 		colsize: 24 * 36e5, // one day
	// 		tooltip: {
	// 			// headerFormat: 'Temperature<br/>',
	// 			// pointFormat: '{point.x:%e %b, %Y} {point.y}:00: <b>{point.value} ℃</b>'
	// 			headerFormat: 'รายงานสถานการณ์จากสถานีตรวจวัด<br/>',
	// 			pointFormat: '{point.x:%e %b, %Y} {point.y}:00'
	// 		},
	// 		// dataLabels: {
    //         // 	enabled: true,
    //         // 	color: '#000000'
    //     	// }
	// 	}]
	// });
	

	

	$(function() {
		(function(H) {
			H.wrap(H.seriesTypes.heatmap.prototype, 'translate', function(proceed) {
			var each = H.each,
				series = this,
				options = series.options,
				xAxis = series.xAxis,
				yAxis = series.yAxis,
				between = function(x, a, b) {
				return Math.min(Math.max(a, x), b);
				},
				pixelSpacing = options.pixelSpacing || [0, 0, 0, 0];

			series.generatePoints();

			each(series.points, function(point) {
				var xPad = (options.colsize || 1) / 2,
				yPad = (options.rowsize || 1) / 2,
				x1 = between(Math.round(xAxis.len - xAxis.translate(point.x - xPad, 0, 1, 0, 1) + pixelSpacing[3]), 0, xAxis.len),
				x2 = between(Math.round(xAxis.len - xAxis.translate(point.x + xPad, 0, 1, 0, 1) - pixelSpacing[1]), 0, xAxis.len),
				y1 = between(Math.round(yAxis.translate(point.y - yPad, 0, 1, 0, 1) - pixelSpacing[2]), 0, yAxis.len),
				y2 = between(Math.round(yAxis.translate(point.y + yPad, 0, 1, 0, 1) + pixelSpacing[0]), 0, yAxis.len);

				// Set plotX and plotY for use in K-D-Tree and more
				point.plotX = point.clientX = (x1 + x2) / 2;
				point.plotY = (y1 + y2) / 2;

				point.shapeType = 'rect';
				point.shapeArgs = {
				x: Math.min(x1, x2),
				y: Math.min(y1, y2),
				width: Math.abs(x2 - x1),
				height: Math.abs(y2 - y1)
				};
			});

			series.translateColors();

			// Make sure colors are updated on colorAxis update (#2893)
			if (this.chart.hasRendered) {
				each(series.points, function(point) {
				point.shapeArgs.fill = point.options.color || point.color; // #3311
				});
			}
			});
		}(Highcharts));

		$('#container-test').highcharts({
			chart: {
			type: 'heatmap',
			marginTop: 40,
			marginBottom: 40
			},


			title: {
			text: 'รายงานสถานการณ์จากสถานีตรวจวัด'
			},

			xAxis: {
			// categories: ['Alexander', 'Marie', 'Maximilian', 'Sophia', 'Lukas', 'Maria', 'Leon', 'Anna', 'Tim', 'Laura']
			categories: ['0:00', '1:00', '2:00', '3:00', '4:00', '5:00', '6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00']
			},

			yAxis: {
			// categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
			categories: ['<?php echo $today;?>', '<?php echo $yesterday;?>', '<?php echo $twodayago;?>'],
			title: null
			},

			colorAxis: {
				min: 1,
				max: 3,
			// minColor: '#FFFFFF',
			// maxColor: Highcharts.getOptions().colors[0]
			// minColor: '#109c4d',
			// maxColor: '#c4463a'
				stops: [
					[0, '#109c4d'],
					[0.5, '#ffc107'],
					[0.9, '#c4463a'],
				],
				startOnTick: false,
    			endOnTick: false
			},

			// legend: {
			// 	align: 'right',
			// 	layout: 'vertical',
			// 	margin: 0,
			// 	verticalAlign: 'top',
			// 	y: 25,
			// 	symbolHeight: 320
			// },
			legend: {
				align: 'right',
				layout: 'vertical',
				margin: 0,
				verticalAlign: 'top',
				y: 25,
				symbolHeight: 220
			},

			tooltip: {
			formatter: function() {
				// return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> sold <br><b>' +
				// this.point.value + '</b> items on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
				return '<b>รายงานสถานการณ์จากสถานีตรวจวัด</b> <br>' +
				'ณ วันที่ '+ this.series.yAxis.categories[this.point.y] + ' เวลา ' + this.series.xAxis.categories[this.point.x] + ' น.';
			}
			},

			series: [{
			// pixelSpacing: [5, 5, 5, 5],
			pixelSpacing: [2, 2, 2, 2],
			/*	0: y-top,
			*	1: x-rigth,
			*	2: y-bottom,
			*	3: x-left
			*/

			name: 'Sales per employee',
			// borderWidth: 10,
			borderWidth: 1,
			// data: [{
			// 	x: 0,
			// 	y: 0,
			// 	value: 67,
			// 	borderWidth: 10,
			// 	borderColor: 'green'
			// 	}, {
			// 	x: 0,
			// 	y: 1,
			// 	value: 19,
			// 	borderWidth: 10,
			// 	borderColor: 'orange'
			// 	}, {
			// 	x: 0,
			// 	y: 2,
			// 	value: 8,
			// 	borderWidth: 10,
			// 	borderColor: 'red'
			// 	},
			// 	[0, 3, 24],
			// 	[0, 4, 67],
			// 	[1, 0, 92],
			// 	[1, 1, 58],
			// 	[1, 2, 78],
			// 	[1, 3, 117],
			// 	[1, 4, 48],
			// 	[2, 0, 35],
			// 	[2, 1, 15],
			// 	[2, 2, 123],
			// 	[2, 3, 64],
			// 	[2, 4, 52],
			// 	[3, 0, 72],
			// 	[3, 1, 132],
			// 	[3, 2, 114],
			// 	[3, 3, 19],
			// 	[3, 4, 16],
			// 	[4, 0, 38],
			// 	[4, 1, 5],
			// 	[4, 2, 8],
			// 	[4, 3, 117],
			// 	[4, 4, 115],
			// 	[5, 0, 88],
			// 	[5, 1, 32],
			// 	[5, 2, 12],
			// 	[5, 3, 6],
			// 	[5, 4, 120],
			// 	[6, 0, 13],
			// 	[6, 1, 44],
			// 	[6, 2, 88],
			// 	[6, 3, 98],
			// 	[6, 4, 96],
			// 	[7, 0, 31],
			// 	[7, 1, 1],
			// 	[7, 2, 82],
			// 	[7, 3, 32],
			// 	[7, 4, 30],
			// 	[8, 0, 85],
			// 	[8, 1, 97],
			// 	[8, 2, 123],
			// 	[8, 3, 64],
			// 	[8, 4, 84],
			// 	[9, 0, 47],
			// 	[9, 1, 114],
			// 	[9, 2, 31],
			// 	[9, 3, 48], {
			// 	x: 9,
			// 	y: 4,
			// 	value: 91,
			// 	borderWidth: 10,
			// 	borderColor: 'red'
			// 	}
			// ],

			// [0 = time 00:00, 0 = today, 1 = value]
			// [0 = time 00:00, 1 = yesterday, 1 = value]
			// [0 = time 00:00, 2 = 2dayago, 1 = value]
			<?php 
			// $sqlSitToday = "SELECT water_date, water_time, water_value, DATE_FORMAT(create_date, '%Y-%m-%d %H:%i') AS create_date 
			// 			FROM situation_waterlevel 
			// 			WHERE create_date > CURDATE()
			// 			ORDER BY water_date DESC, water_time ASC";			
			// $sqlSitYesterDay = "SELECT water_date, water_time, water_value, DATE_FORMAT(create_date, '%Y-%m-%d %H:%i') AS create_date 
			// 			FROM situation_waterlevel 
			// 			WHERE create_date > (CURDATE() - INTERVAL 1 DAY) 
			// 			ORDER BY water_date DESC, water_time ASC";
			$sqlSitToday = "SELECT water_date, water_time, water_value, DATE_FORMAT(create_date, '%Y-%m-%d %H:%i') AS create_date 
						FROM situation_waterlevel 
						WHERE water_date = '".$today."'
						ORDER BY water_date DESC, water_time ASC";
			
			$sqlSitYesterDay = "SELECT water_date, water_time, water_value, DATE_FORMAT(create_date, '%Y-%m-%d %H:%i') AS create_date 
						FROM situation_waterlevel 
						WHERE water_date = '".$yesterday."'
						ORDER BY water_date DESC, water_time ASC";
			
			$sqlSit2DayAgo = "SELECT water_date, water_time, water_value, DATE_FORMAT(create_date, '%Y-%m-%d %H:%i') AS create_date 
						FROM situation_waterlevel 
						WHERE water_date = '".$twodayago."'
						ORDER BY water_date DESC, water_time ASC";
			

			$qSitToday = mysqli_query($conn,$sqlSitToday);
			$rowcount=mysqli_num_rows($qSitToday);
			$rowcount=$rowcount-1;
			?>
			data: [
			<?php
			$i=0;
			while($rowSitToday=@mysqli_fetch_array($qSitToday,MYSQLI_ASSOC)){
				if($i!=$rowcount){
					// echo "[".$i.", 0,".$rowSitToday["water_value"]."],";
					if($rowSitToday["water_date"]==$sitdate){
						if($i!=$timeIndex){
							echo "[".$i.", 0,".$rowSitToday["water_value"]."],";
						}else{
							echo "{ x:".$i.",y:0, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
						}
					}else{
						echo "[".$i.", 0,".$rowSitToday["water_value"]."],";
					}
				}else{
					echo "{ x:".$i.",y:0, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#73b2ff'},";
				}
				$i++;
			}
			mysqli_free_result($qSitToday);

			$i=0;
			$qSitYesterDay = mysqli_query($conn,$sqlSitYesterDay);
			while($rowSitYesterDay=@mysqli_fetch_array($qSitYesterDay,MYSQLI_ASSOC)){				
				if($rowSitYesterDay["water_date"]==$sitdate){
					if($i!=$timeIndex){
						echo "[".$i.", 1,".$rowSitYesterDay["water_value"]."],";
					}else{
						echo "{ x:".$i.",y:1, value:".$rowSitYesterDay["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
					}
				}else{
					echo "[".$i.", 1,".$rowSitYesterDay["water_value"]."],";
				}
				$i++;
			}
			mysqli_free_result($qSitYesterDay);

			$i=0;
			$qSit2DayAgo = mysqli_query($conn,$sqlSit2DayAgo);
			while($rowSit2DayAgo=@mysqli_fetch_array($qSit2DayAgo,MYSQLI_ASSOC)){				
				if($rowSit2DayAgo["water_date"]==$sitdate){
					if($i!=$timeIndex){
						echo "[".$i.", 2,".$rowSit2DayAgo["water_value"]."],";
					}else{
						echo "{ x:".$i.",y:2, value:".$rowSit2DayAgo["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
					}
				}else{
					echo "[".$i.", 2,".$rowSit2DayAgo["water_value"]."],";
				}
				$i++;
			}
			mysqli_free_result($qSit2DayAgo);
			?>

			],

			// data: [
			// 	[0, 0, 1],
			// 	[1, 0, 1],
			// 	[2, 0, 1],
			// 	[3, 0, 1],
			// 	[4, 0, 1],
			// 	[5, 0, 1],
			// 	[6, 0, 1],
			// 	[7, 0, 1],
			// 	[8, 0, 1],
			// 	[9, 0, 1],
			// 	[10, 0, 3],
			// 	[11, 0, 3],
			// 	[12, 0, 2],
			// 	[13, 0, 2],				
			// 	{
			// 	x: 14,
			// 	y: 0,
			// 	value: 2,
			// 	borderWidth: 8,
			// 	borderColor: '#73b2ff'
			// 	},
			// 	[0, 1, 1],
			// 	[1, 1, 1],
			// 	[2, 1, 1],
			// 	[3, 1, 1],
			// 	[4, 1, 1],
			// 	[5, 1, 1],
			// 	[6, 1, 1],
			// 	[7, 1, 1],
			// 	[8, 1, 1],
			// 	[9, 1, 1],
			// 	[10, 1, 1],
			// 	[11, 1, 1],
			// 	[12, 1, 1],
			// 	[13, 1, 1],
			// 	[14, 1, 1],				
			// 	[15, 1, 1],
			// 	[16, 1, 1],
			// 	[17, 1, 1],
			// 	[18, 1, 1],				
			// 	[19, 1, 1],
			// 	[20, 1, 1],
			// 	[21, 1, 1],
			// 	[22, 1, 1],				
			// 	[23, 1, 1],	
			// 	[0, 2, 1],
			// 	[1, 2, 1],
			// 	[2, 2, 1],
			// 	[3, 2, 1],
			// 	[4, 2, 1],
			// 	[5, 2, 1],
			// 	[6, 2, 1],
			// 	[7, 2, 1],
			// 	[8, 2, 1],
			// 	[9, 2, 1],
			// 	[10, 2, 1],
			// 	[11, 2, 1],
			// 	[12, 2, 1],
			// 	[13, 2, 1],
			// 	[14, 2, 1],				
			// 	[15, 2, 1],
			// 	[16, 2, 1],
			// 	[17, 2, 1],
			// 	[18, 2, 1],				
			// 	[19, 2, 1],
			// 	[20, 2, 1],
			// 	[21, 2, 1],
			// 	[22, 2, 1],				
			// 	[23, 2, 1],				
			// ],

			// data: [
			// 	[0, 0, 1],
			// 	[0, 1, 2],
			// 	[0, 2, 3],			
			// 	[1, 0, 1],
			// 	[1, 1, 1],
			// 	[1, 2, 1],			
			// 	[2, 0, 1],
			// 	[2, 1, 1],
			// 	[2, 2, 1],			
			// 	[3, 0, 1],
			// 	[3, 1, 1],
			// 	[3, 2, 1],			
			// 	[4, 0, 1],
			// 	[4, 1, 1],
			// 	[4, 2, 1],			
			// 	[5, 0, 1],
			// 	[5, 1, 1],
			// 	[5, 2, 1],			
			// 	[6, 0, 1],
			// 	[6, 1, 1],
			// 	[6, 2, 1],			
			// 	[7, 0, 1],
			// 	[7, 1, 1],
			// 	[7, 2, 1],			
			// 	[8, 0, 1],
			// 	[8, 1, 1],
			// 	[8, 2, 1],	
			// 	[9, 0, 1],				
			// 	[9, 1, 1],
			// 	[9, 2, 1],
			// 	[10, 0, 1],
			// 	[10, 1, 1],
			// 	[10, 2, 1],
			// 	[11, 0, 1],
			// 	[11, 1, 1],
			// 	[11, 2, 1],
			// 	[12, 0, 1],
			// 	[12, 1, 1],
			// 	[12, 2, 1],			
			// 	{
			// 	x: 13,
			// 	y: 0,
			// 	value: 2,
			// 	borderWidth: 8,
			// 	borderColor: '#a6a6a6'
			// 	},
			// 	[13, 1, 1],
			// 	[13, 2, 1],
			// 	[14, 0, 1],
			// 	[14, 1, 1],
			// 	[14, 2, 1],
			// 	[15, 0, 1],
			// 	[15, 1, 3],
			// 	[15, 2, 1],				
			// 	[16, 0, 1],
			// 	[16, 1, 1],
			// 	[16, 2, 1],
			// 	[17, 0, 1],
			// 	[17, 1, 1],
			// 	[17, 2, 1],
			// 	{
			// 	x: 18,
			// 	y: 0,
			// 	value: 1,
			// 	borderWidth: 8,
			// 	borderColor: '#73b2ff'
			// 	},
			// 	[18, 1, 1],
			// 	[18, 2, 1],
			// 	// [19, 0, 2],
			// 	[19, 1, 1],
			// 	[19, 2, 1],
			// 	// [20, 0, 2],
			// 	[20, 1, 1],
			// 	[20, 2, 1],
			// 	// [21, 0, 2],
			// 	[21, 1, 1],
			// 	[21, 2, 1],
			// 	// [22, 0, 2],
			// 	[22, 1, 1],
			// 	[22, 2, 1],
			// 	// [23, 0, 2],
			// 	[23, 1, 1],
			// 	[23, 2, 1],						
			// ],
			// dataLabels: {
			// 	enabled: true,
			// 	color: 'black',
			// 	style: {
			// 	textShadow: 'none',
			// 	HcTextStroke: null
			// 	}
			// }
			}]

		});

		$('#container-test2').highcharts({
			chart: {
			type: 'heatmap',
			marginTop: 40,
			marginBottom: 40
			},


			title: {
			text: 'รายงานสถานการณ์จากแบบจำลอง'
			},

			xAxis: {
			// categories: ['Alexander', 'Marie', 'Maximilian', 'Sophia', 'Lukas', 'Maria', 'Leon', 'Anna', 'Tim', 'Laura']
			categories: ['0:00', '1:00', '2:00', '3:00', '4:00', '5:00', '6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00']
			},

			yAxis: {
			// categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
			// categories: ['<?php //echo $yesterday;?>', '<?php //echo $today;?>', '<?php //echo $tomorrow;?>'],
			categories: ['<?php echo $tomorrow;?>', '<?php echo $today;?>', '<?php echo $yesterday;?>'],
			title: null
			},

			colorAxis: {
				min: 1,
				max: 3,
			// minColor: '#FFFFFF',
			// maxColor: Highcharts.getOptions().colors[0]
			// minColor: '#109c4d',
			// maxColor: '#c4463a'
				stops: [
					[0, '#109c4d'],
					[0.5, '#ffc107'],
					[0.9, '#c4463a'],
				],
				startOnTick: false,
    			endOnTick: false
			},

			// legend: {
			// 	align: 'right',
			// 	layout: 'vertical',
			// 	margin: 0,
			// 	verticalAlign: 'top',
			// 	y: 25,
			// 	symbolHeight: 320
			// },
			legend: {
				align: 'right',
				layout: 'vertical',
				margin: 0,
				verticalAlign: 'top',
				y: 25,
				symbolHeight: 220
			},

			tooltip: {
			formatter: function() {
				// return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> sold <br><b>' +
				// this.point.value + '</b> items on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
				return '<b>รายงานสถานการณ์จากแบบจำลอง</b> <br>' +
				'ณ วันที่ '+ this.series.yAxis.categories[this.point.y] + ' เวลา ' + this.series.xAxis.categories[this.point.x] + ' น.';
			}
			},

			series: [{
			// pixelSpacing: [5, 5, 5, 5],
			pixelSpacing: [2, 2, 2, 2],
			/*	0: y-top,
			*	1: x-rigth,
			*	2: y-bottom,
			*	3: x-left
			*/

			name: 'Sales per employee',
			// borderWidth: 10,
			borderWidth: 1,
			// data: [{
			// 	x: 0,
			// 	y: 0,
			// 	value: 67,
			// 	borderWidth: 10,
			// 	borderColor: 'green'
			// 	}, {
			// 	x: 0,
			// 	y: 1,
			// 	value: 19,
			// 	borderWidth: 10,
			// 	borderColor: 'orange'
			// 	}, {
			// 	x: 0,
			// 	y: 2,
			// 	value: 8,
			// 	borderWidth: 10,
			// 	borderColor: 'red'
			// 	},
			// 	[0, 3, 24],
			// 	[0, 4, 67],
			// 	[1, 0, 92],
			// 	[1, 1, 58],
			// 	[1, 2, 78],
			// 	[1, 3, 117],
			// 	[1, 4, 48],
			// 	[2, 0, 35],
			// 	[2, 1, 15],
			// 	[2, 2, 123],
			// 	[2, 3, 64],
			// 	[2, 4, 52],
			// 	[3, 0, 72],
			// 	[3, 1, 132],
			// 	[3, 2, 114],
			// 	[3, 3, 19],
			// 	[3, 4, 16],
			// 	[4, 0, 38],
			// 	[4, 1, 5],
			// 	[4, 2, 8],
			// 	[4, 3, 117],
			// 	[4, 4, 115],
			// 	[5, 0, 88],
			// 	[5, 1, 32],
			// 	[5, 2, 12],
			// 	[5, 3, 6],
			// 	[5, 4, 120],
			// 	[6, 0, 13],
			// 	[6, 1, 44],
			// 	[6, 2, 88],
			// 	[6, 3, 98],
			// 	[6, 4, 96],
			// 	[7, 0, 31],
			// 	[7, 1, 1],
			// 	[7, 2, 82],
			// 	[7, 3, 32],
			// 	[7, 4, 30],
			// 	[8, 0, 85],
			// 	[8, 1, 97],
			// 	[8, 2, 123],
			// 	[8, 3, 64],
			// 	[8, 4, 84],
			// 	[9, 0, 47],
			// 	[9, 1, 114],
			// 	[9, 2, 31],
			// 	[9, 3, 48], {
			// 	x: 9,
			// 	y: 4,
			// 	value: 91,
			// 	borderWidth: 10,
			// 	borderColor: 'red'
			// 	}
			// ],
			// data: [
			// 	[0, 0, 1],
			// 	[0, 1, 1],
			// 	[0, 2, 1],			
			// 	[1, 0, 2],
			// 	[1, 1, 2],
			// 	[1, 2, 2],			
			// 	[2, 0, 2],
			// 	[2, 1, 2],
			// 	[2, 2, 3],			
			// 	[3, 0, 2],
			// 	[3, 1, 3],
			// 	[3, 2, 3],			
			// 	[4, 0, 1],
			// 	[4, 1, 1],
			// 	[4, 2, 1],			
			// 	[5, 0, 2],
			// 	[5, 1, 1],
			// 	[5, 2, 1],			
			// 	[6, 0, 1],
			// 	[6, 1, 1],
			// 	[6, 2, 2],			
			// 	[7, 0, 1],
			// 	[7, 1, 1],
			// 	[7, 2, 2],			
			// 	[8, 0, 2],
			// 	[8, 1, 2],
			// 	[8, 2, 3],	
			// 	[9, 0, 2],				
			// 	[9, 1, 3],
			// 	[9, 2, 1],
			// 	[10, 0, 2],
			// 	[10, 1, 2],
			// 	[10, 2, 3],
			// 	[11, 0, 2],
			// 	[11, 1, 2],
			// 	[11, 2, 3],
			// 	[12, 0, 2],
			// 	[12, 1, 2],
			// 	[12, 2, 3],			
			// 	[13, 0, 2],
			// 	[13, 1, 2],
			// 	[13, 2, 3],
			// 	[14, 0, 2],
			// 	[14, 1, 2],
			// 	[14, 2, 3],
			// 	[15, 0, 2],
			// 	[15, 1, 2],
			// 	[15, 2, 3],		
			// 	[16, 0, 2],
			// 	[16, 1, 2],									
			// 	[16, 2, 3],
			// 	[17, 0, 2],
			// 	[17, 1, 2],
			// 	[17, 2, 3],
			// 	[18, 0, 2],
			// 	{
			// 	x: 18,
			// 	y: 1,
			// 	value: 2,
			// 	borderWidth: 8,
			// 	borderColor: '#73b2ff'
			// 	},
			// 	[18, 2, 3],
			// 	// [19, 0, 2],
			// 	[19, 1, 2],
			// 	[19, 2, 3],
			// 	// [20, 0, 2],
			// 	[20, 1, 2],
			// 	[20, 2, 3],
			// 	// [21, 0, 2],
			// 	[21, 1, 2],
			// 	[21, 2, 3],
			// 	// [22, 0, 2],
			// 	[22, 1, 2],
			// 	[22, 2, 3],
			// 	// [23, 0, 2],
			// 	[23, 1, 2],
			// 	[23, 2, 2],						
			// ],
			<?php 			
			
			$sqlSitYesterDay = "SELECT us.water_date, us.water_time, us.water_value, DATE_FORMAT(us.create_date, '%Y-%m-%d %H:%i') AS create_date, rf.radar_status
						FROM urbs_situation_waterlevel us, urbs_realtime_floodmap rf
						WHERE us.water_date = '".$yesterday."'
						AND rf.datetime = '".$yesterday."'
						AND us.water_date = rf.datetime
						ORDER BY us.water_date DESC, us.water_time ASC";
			
			$sqlSitToday = "SELECT us.water_date, us.water_time, us.water_value, DATE_FORMAT(us.create_date, '%Y-%m-%d %H:%i') AS create_date, rf.radar_status
						FROM urbs_situation_waterlevel us, urbs_realtime_floodmap rf
						WHERE us.water_date = '".$today."'
						AND rf.datetime = '".$today."'
						AND us.water_date = rf.datetime
						ORDER BY us.water_date DESC, us.water_time ASC";
			
			$sqlCountSitTomorrow = "SELECT COUNT(id) AS cStiTommorow 
									FROM urbs_situation_waterlevel 
									WHERE water_date = '".$tomorrow."'";			
			
			$qCountSitTomorrow = mysqli_query($conn,$sqlCountSitTomorrow);
			$cStiTommorow = mysqli_result($qCountSitTomorrow,0,"cStiTommorow");
			
			if(!isset($_POST['stype'])) {				
				$limitTommorow = $cStiTommorow-3;
			}else{
				$limitTommorow = $cStiTommorow;
			}
			
			// $sqlSitTomorrow = "SELECT us.water_date, us.water_time, us.water_value, DATE_FORMAT(us.create_date, '%Y-%m-%d %H:%i') AS create_date, rf.radar_status
			// 			FROM urbs_situation_waterlevel us, urbs_realtime_floodmap rf
			// 			WHERE us.water_date = '".$tomorrow."'
			// 			AND rf.datetime = '".$tomorrow."'
			// 			AND us.water_date = rf.datetime
			// 			ORDER BY us.water_date DESC, us.water_time ASC
			// 			LIMIT ".$limitTommorow;			
			
			$sqlSitTomorrow = "SELECT us.water_date, us.water_time, us.water_value, DATE_FORMAT(us.create_date, '%Y-%m-%d %H:%i') AS create_date
						FROM urbs_situation_waterlevel us
						WHERE us.water_date = '".$tomorrow."'						
						ORDER BY us.water_date DESC, us.water_time ASC
						LIMIT ".$limitTommorow;			

			$qSitToday = mysqli_query($conn,$sqlSitToday);
			$rowcount=mysqli_num_rows($qSitToday);
			// $rowcount=$rowcount-1;
			?>
			data: [
			<?php
			$i=0;
			while($rowSitToday=@mysqli_fetch_array($qSitToday,MYSQLI_ASSOC)){
				// if($i!=$rowcount){
					// echo "[".$i.", 0,".$rowSitToday["water_value"]."],";
					if($rowSitToday["water_date"]==$sitdate){
						if(($i!=$timeIndex) && ($i!=$curtimeIndex)){
							// if($rowSitToday["radar_status"]==1){
							// 	echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#000000'},";
							// }else{
							// 	echo "[".$i.", 1,".$rowSitToday["water_value"]."],";							
							// }
							echo "[".$i.", 1,".$rowSitToday["water_value"]."],";
						}else{
							if($i==$curtimeIndex && $i==$timeIndex){
								echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#73b2ff'},";
							}

							if($i==$curtimeIndex && $i!=$timeIndex){
								echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#73b2ff'},";
							}

							if($i==$timeIndex && $i!=$curtimeIndex){
								echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
							}							
						}
					}else{
						if($rowSitToday["water_date"]==$curdate){
							if(($i!=$timeIndex) && ($i!=$curtimeIndex)){
								if($rowSitToday["radar_status"]==1){
									echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#000000'},";
								}else{
									echo "[".$i.", 1,".$rowSitToday["water_value"]."],";
								}
							}else{
								if($i==$curtimeIndex && $i==$timeIndex){
									echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#73b2ff'},";
								}
	
								if($i==$curtimeIndex && $i!=$timeIndex){
									echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#73b2ff'},";
								}
	
								if($i==$timeIndex && $i!=$curtimeIndex){
									// echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
									echo "[".$i.", 1,".$rowSitToday["water_value"]."],";
								}							
							}	
						}else{
							echo "[".$i.", 1,".$rowSitToday["water_value"]."],";
						}
					}
				// }else{
				// 	echo "{ x:".$i.",y:1, value:".$rowSitToday["water_value"].",borderWidth: 8,borderColor: '#73b2ff'},";
				// }
				$i++;
			}
			mysqli_free_result($qSitToday);

			$i=0;
			$qSitYesterDay = mysqli_query($conn,$sqlSitYesterDay);
			while($rowSitYesterDay=@mysqli_fetch_array($qSitYesterDay,MYSQLI_ASSOC)){				
				if($rowSitYesterDay["water_date"]==$sitdate){
					if($i!=$timeIndex){
						if($rowSitYesterDay["radar_status"]==1){
							echo "{ x:".$i.",y:2, value:".$rowSitYesterDay["water_value"].",borderWidth: 8,borderColor: '#000000'},";	
						}else{
							echo "[".$i.", 2,".$rowSitYesterDay["water_value"]."],";
						}
					}else{
						echo "{ x:".$i.",y:2, value:".$rowSitYesterDay["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
					}
				}else{
					echo "[".$i.", 2,".$rowSitYesterDay["water_value"]."],";
				}
				$i++;
			}
			mysqli_free_result($qSitYesterDay);

			$i=0;
			$qSitTomorrow = mysqli_query($conn,$sqlSitTomorrow);
			while($rowSitTomorrow=@mysqli_fetch_array($qSitTomorrow,MYSQLI_ASSOC)){				
				if($rowSitTomorrow["water_date"]==$sitdate){
					if($i!=$timeIndex){
						if($rowSitTomorrow["radar_status"]==1){
							echo "{ x:".$i.",y:0, value:".$rowSitTomorrow["water_value"].",borderWidth: 8,borderColor: '#000000'},";
						}else{
							echo "[".$i.", 0,".$rowSitTomorrow["water_value"]."],";
						}
					}else{
						echo "{ x:".$i.",y:0, value:".$rowSitTomorrow["water_value"].",borderWidth: 8,borderColor: '#a6a6a6'},";
					}
				}else{
					echo "[".$i.", 0,".$rowSitTomorrow["water_value"]."],";
				}
				$i++;
			}
			mysqli_free_result($qSitTomorrow);
			?>

			],
			// dataLabels: {
			// 	enabled: true,
			// 	color: 'black',
			// 	style: {
			// 	textShadow: 'none',
			// 	HcTextStroke: null
			// 	}
			// }
			}]

		});
	});



</script>
</body>
</html>
