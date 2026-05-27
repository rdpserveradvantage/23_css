<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;
	//ini_set('memory_limit',0);
    
  

include ('config.php');

$qry=$_POST['expqry'];
//echo $qry;
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}
require_once 'Classes/PHPExcel.php';

require_once "Classes/PHPExcel/IOFactory.php";

include_once 'Classes/PHPExcel/Writer/Excel5.php';

// create new PHPExcel object
$objPHPExcel = new PHPExcel();

ini_set('memory_limit', '-1');
//Prevent your script from timing out

// This increases the excution time from 30 secs to 3000 secs.
//set_time_limit ( 3000 ); 


// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

//rename the sheet
$objSheet->setTitle('Quotation detail');

 	
$objSheet->setCellValue('A1', 'Sr No');
$objSheet->setCellValue('B1', 'Client Name');
$objSheet->setCellValue('C1', 'Incident Number');
$objSheet->setCellValue('D1', 'Region');
$objSheet->setCellValue('E1', 'Circle');
$objSheet->setCellValue('F1', 'Location');

$objSheet->setCellValue('G1', 'ATMID');
$objSheet->setCellValue('H1', 'Address');

$objSheet->setCellValue('I1', 'Incident Category');
$objSheet->setCellValue('J1', 'Alarm Message');
$objSheet->setCellValue('K1', 'Incident Date Time');
$objSheet->setCellValue('L1', 'Alarm Received Date Time');
$objSheet->setCellValue('M1', 'Close Date Time');
$objSheet->setCellValue('N1', 'DVRIP');

$objSheet->setCellValue('O1', 'Panel_make');
$objSheet->setCellValue('P1', 'panelid');

$objSheet->setCellValue('Q1', 'Bank');
$objSheet->setCellValue('R1', 'Reactive');
$objSheet->setCellValue('S1', 'Closed By');
$objSheet->setCellValue('T1', 'Closed Date');
$objSheet->setCellValue('U1', 'Remark');









$objSheet->getStyle('Q')->getAlignment()->setWrapText(true);
$sqry=mysqli_query($conn,$qry);
$num=mysqli_num_rows($sqry);


$count=0;
$srn=1;
$apptotamt=0;
$row = 2;
while($rowarr=mysqli_fetch_array($sqry))
{

			//$qsales=mysql_query("select salesmanName from salesman_login where id='".$rowarr[13]."' ");
			//$qsalesdata=mysql_fetch_array($qsales);
			$ct=$rowarr["City"].",".$rowarr["State"];

$objSheet->setCellValueByColumnAndRow(0, $row, $srn);
$objSheet->setCellValueByColumnAndRow(1, $row,$rowarr["Customer"]);
$objSheet->setCellValueByColumnAndRow(2, $row,$rowarr["id"]);
$objSheet->setCellValueByColumnAndRow(3, $row, $rowarr["zon"]);
$objSheet->setCellValueByColumnAndRow(4, $row, $ct);
$objSheet->setCellValueByColumnAndRow(5, $row, $rowarr["ATMShortName"]);
$objSheet->setCellValueByColumnAndRow(6, $row, $rowarr["ATMID"]);
$objSheet->setCellValueByColumnAndRow(7, $row, $rowarr["SiteAddress"]);



   
     $dtconvt=$rowarr["receivedtime"];
	 $timestamp = strtotime($dtconvt);
     $newDate = date('d-F-Y', $timestamp); 
//echo $newDate; //outputs 02-March-2011

if(strpos($rowarr["Panel_make"], 'SMART') !== FALSE)
    {
    
$sql1="select Description,Camera from smartialarms where (Zone='".$rowarr["zone"]."')";

    }
	else if(strpos($rowarr["Panel_make"], 'SEC') !== FALSE)
    {
    
$sql1="select sensorname as Description,camera from securico where (Zone='".$rowarr["zone"]."')";

    }
	 else
	{
		/* $sql2="select a.Description,a.Camera,a.SH ,b.Zone from zonecameras a , smartialarms b where (b.Zone=a.ZoneNo)";
		 $result2=mysqli_query($conn,$$sql2);
		 */
		 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$rowarr["zone"]."')"; 
	//	 $result2=mysqli_query($conn,$sql2);
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 
	 





$objSheet->setCellValueByColumnAndRow(8, $row,$row1["Description"]);

if(endsWith($rowarr["alarm"], "R"))
{
	$ds= $row1["Description"].' Restoral';
	}
else {
	$ds= $row1["Description"];
	}



$objSheet->setCellValueByColumnAndRow(9, $row, $ds);
$objSheet->setCellValueByColumnAndRow(10, $row, $rowarr["createtime"]);
$objSheet->setCellValueByColumnAndRow(11, $row,$rowarr["receivedtime"]);
$objSheet->setCellValueByColumnAndRow(12, $row,$newDate);
$objSheet->setCellValueByColumnAndRow(13, $row,$rowarr["DVRIP"]);
$objSheet->setCellValueByColumnAndRow(14, $row,$rowarr["Panel_make"]);
$objSheet->setCellValueByColumnAndRow(15, $row,$rowarr["panelid"]);
$objSheet->setCellValueByColumnAndRow(16, $row,$rowarr["Bank"]);

 if(endsWith($row["alarm"], "R")){$re='Non-Reactive';}
else{ $re='Reactive';}


$objSheet->setCellValueByColumnAndRow(17, $row, $re);
$objSheet->setCellValueByColumnAndRow(18, $row, $rowarr["closedBy"]);
$objSheet->setCellValueByColumnAndRow(19, $row, $rowarr["closedtime"]);

 $cm= $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];


$objSheet->setCellValueByColumnAndRow(20, $row, $cm);


$row++;
$srn++;
}


$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
$objSheet->setCellValueByColumnAndRow(21,$lastrow,$apptotamt);




















 header("Content-Disposition: attachment; filename=preSales.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");
?>















