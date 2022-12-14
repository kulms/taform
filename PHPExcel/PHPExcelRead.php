<?php

/** PHPExcel */
require_once 'Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';


$inputFileName = "myData.xlsx";  
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  


// for No header
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$r = -1;
$namedDataArray = array();
for ($row = 1; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        $namedDataArray[$r] = $dataRow[$row];
    }
}

/*
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}
*/

//echo '<pre>';
//var_dump($namedDataArray);
//echo '</pre><hr />';


//print_r($namedDataArray);
for($i=1;$i<count($namedDataArray);$i++) {
	echo $namedDataArray[$i]["A"];
	echo $namedDataArray[$i]["B"];
	echo $namedDataArray[$i]["C"];
	echo $namedDataArray[$i]["D"];
	echo $namedDataArray[$i]["E"];
	echo $namedDataArray[$i]["F"]."<br>";
}
?>
<!--
<table width="500" border="1">
  <tr>
    <td>CustomerID</td>
    <td>Name</td>
    <td>Email</td>
    <td>CountryCode</td>
    <td>Budget</td>
    <td>Used</td>
  </tr>
<?
foreach ($namedDataArray as $result) {
?>
	  <tr>
		<td><?=$result["CustomerID"];?></td>
		<td><?=$result["Name"];?></td>
		<td><?=$result["Email"];?></td>
		<td><?=$result["CountryCode"];?></td>
		<td><?=$result["Budget"];?></td>
		<td><?=$result["Used"];?></td>
	  </tr>
<?
}
?>
</table>
-->
<table width="500" border="1">
  <tr>
    <td>CustomerID</td>
    <td>Name</td>
    <td>Email</td>
    <td>CountryCode</td>
    <td>Budget</td>
    <td>Used</td>
  </tr>
<?php
for($i=1;$i<count($namedDataArray);$i++) {
?>
	  <tr>
		<td><?php echo $namedDataArray[$i]["A"];?></td>
		<td><?php echo $namedDataArray[$i]["B"];?></td>
		<td><?php echo $namedDataArray[$i]["C"];?></td>
		<td><?php echo $namedDataArray[$i]["D"];?></td>
		<td><?php echo $namedDataArray[$i]["E"];?></td>
		<td><?php echo $namedDataArray[$i]["F"];?></td>
	  </tr>
<?php
}
?>
</table>