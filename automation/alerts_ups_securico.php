<?php include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];

function lastcommunicationdiff($datetime1,$datetime2){
	    $datetime2 = new DateTime($datetime2);
		$interval = $datetime1->diff($datetime2);
		
		$elapsedyear = $interval->format('%y');
		$elapsedmon = $interval->format('%m');
		$elapsed_day = $interval->format('%a');
		$elapsedhr = $interval->format('%h');
		$elapsedmin = $interval->format('%i');
		$not = 0;
		if($elapsedyear>0){$not=$not+1;}
		if($elapsedmon>0){$not=$not+1;}
		if($elapsed_day>0){$not=$not+1;}
		//if($elapsedhr>0){$not=$not+1;}
		$min = $elapsedmin;
		$hour = $elapsedhr;
		if($not>0){
			$return = 0;
		}else{
			if($hour<=24){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }

	
	$yesterday = date('Y-m-d',strtotime("-1 days"));
	$lastmonth = date('Y-m-d',strtotime("-30 days"));
	
	$alerts_acup_select = mysqli_query($con,"SELECT * FROM alerts_acup_new");
	
	if(mysqli_num_rows($alerts_acup_select)>0){
	  $truncate_table = mysqli_query($con,"TRUNCATE TABLE alerts_acup_new");
	}
	$_sql_qry = "insert into alerts_acup_new (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM `sites` a,`backalerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) AND (a.Panel_Make = 'securico_gx4816' OR a.Panel_Make = 'sec_sbi') AND (b.alarm IN ('BA','BR') AND b.zone IN ('551','552')) AND CAST(b.receivedtime AS DATE)= '".$yesterday."'
";
	$_sql = mysqli_query($con,$_sql_qry); 
	
	
	$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts_acup_new` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('551','552')and (a.Panel_Make = 'securico_gx4816' OR a.Panel_Make = 'sec_sbi') and b.alarm ='BA'";
	$result = mysqli_query($con, $abc);
	
	 
	  
// Include PHPExcel library
require_once '../PHPExcel/PHPExcel-1.8/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Dhaval")
    ->setLastModifiedBy("Your Name")
    ->setTitle("Daily UPS Report securico_gx4816")
    ->setSubject("Report")
    ->setDescription("Auto-generated report with PHPExcel.")
    ->setKeywords("report excel php")
    ->setCategory("Reports");

// Add data to cells
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Client')
    ->setCellValue('B1', 'Bank Name')
    ->setCellValue('C1', 'Incident Id')
    ->setCellValue('D1', 'Circle')
    ->setCellValue('E1', 'Location')
    ->setCellValue('F1', 'Address')
    ->setCellValue('G1', 'ATMID')
    ->setCellValue('H1', 'Full Address')
    ->setCellValue('I1', 'DVRIP')
    ->setCellValue('J1', 'Incident Date Time')
    ->setCellValue('K1', 'EB Power Failure Alert Received date')
    ->setCellValue('L1', 'EB Power Failure Alert Received Time')
    ->setCellValue('M1', 'UPS Power Available Alert Received Date')
    ->setCellValue('N1', 'UPS Power Available Alert Received time')
    ->setCellValue('O1', 'UPS Power Failure Alert Received Date')
    ->setCellValue('P1', 'UPS Power Failure Alert Received time')
    ->setCellValue('Q1', 'UPS Power Restore Alert Received Date')
    ->setCellValue('R1', 'UPS Power Restore Alert Received time')
    ->setCellValue('S1', 'EB Power Available Alert Received date')
    ->setCellValue('T1', 'EB Power Available Alert Received time'); 

$row = 2;
while ($res = mysqli_fetch_array($result)) {
	
	$timestamp = $res["createtime"];
	$splitTimeStamp = explode(" ", $timestamp);
	$date = $splitTimeStamp[0];
	$time = $splitTimeStamp[1];
	
	$_panel_id = $res['panelid'];
	
	if ($res["alarm"] == "BA" and $res["zone"] == "551") {
		$EB_Power_Failure_Alert_Received_date = $date;
		$EB_Power_Failure_Alert_Received_Time = $time;
		$UPS_Power_Available_Alert_Received_Date = $date;
		$UPS_Power_Available_Alert_Received_Time = $time;
 		
		$xyz = "select createtime from alerts_acup_new where panelid='" . $_panel_id . "' and zone='551' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
		$xyzresult = mysqli_query($con, $xyz);
		if(mysqli_num_rows($xyzresult)>0){
		   $xyzfetch = mysqli_fetch_array($xyzresult);
		}else{
			$xyzfetch[0] = '-';
		}
	}else{
		$EB_Power_Failure_Alert_Received_date = '-';
		$EB_Power_Failure_Alert_Received_Time = '-';
		$UPS_Power_Available_Alert_Received_Date = '-';
		$UPS_Power_Available_Alert_Received_Time = '-';
		$xyzfetch[0] = '-';
	}
	
	if ($res["alarm"] == "BA" and $res["zone"] == "552") {
		$UPS_Power_Failure_Alert_Received_Date = $date;
		$UPS_Power_Failure_Alert_Received_Time = $time;
		
		$xyz1 = "select createtime from alerts_acup_new where panelid='" . $_panel_id . "' and zone='552' and alarm='BR' and createtime>'" . $timestamp . "' order by createtime limit 1";
		$xyzresult1 = mysqli_query($con, $xyz1);
        if(mysqli_num_rows($xyzresult1)>0){ 
		    $xyzfetch1 = mysqli_fetch_array($xyzresult1);
		}else{
			$xyzfetch1[0] = '-';
		}
	}else{
		$UPS_Power_Failure_Alert_Received_Date = '-';
		$UPS_Power_Failure_Alert_Received_Time = '-';
		$xyzfetch1[0] = '-';
	}
	
	$UPS_Power_Restore_Alert_Received_Date = $xyzfetch1[0];
	$UPS_Power_Restore_Alert_Received_Time = $xyzfetch1[0];
	
	$EB_Power_Failure_Alert_Received_date = $xyzfetch[0];
	$EB_Power_Failure_Alert_Received_Time = $xyzfetch[0];
	
	$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A'.$row, $res["Customer"])
    ->setCellValue('B'.$row, $res["Bank"])
    ->setCellValue('C'.$row, $res["id"])
	->setCellValue('D'.$row, $res["zon"])
    ->setCellValue('E'.$row, $res["City"])
    ->setCellValue('F'.$row, $res["ATMShortName"])
	->setCellValue('G'.$row, $res["ATMID"])
	->setCellValue('H'.$row, $res["SiteAddress"])
    ->setCellValue('I'.$row, $res["DVRIP"])
    ->setCellValue('J'.$row, $res["createtime"])
	->setCellValue('K'.$row, $EB_Power_Failure_Alert_Received_date)
    ->setCellValue('L'.$row, $EB_Power_Failure_Alert_Received_Time)
    ->setCellValue('M'.$row, $UPS_Power_Available_Alert_Received_Date)
	->setCellValue('N'.$row, $UPS_Power_Available_Alert_Received_Time)
    ->setCellValue('O'.$row, $UPS_Power_Failure_Alert_Received_Date)
    ->setCellValue('P'.$row, $UPS_Power_Failure_Alert_Received_Time)
	->setCellValue('Q'.$row, $UPS_Power_Restore_Alert_Received_Date)
    ->setCellValue('R'.$row, $UPS_Power_Restore_Alert_Received_Time)
    ->setCellValue('S'.$row, $EB_Power_Failure_Alert_Received_date)
	->setCellValue('T'.$row, $EB_Power_Failure_Alert_Received_Time);
	$row++;
}

 CloseCon($con);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('DailyUPSReport');

// Get current date
$date = date('Y-m-d');

// Define file path
$folder = 'exports/';
$filename = "securico_report_{$date}.xlsx";
$fullPath = $folder . $filename;

// Create directory if it doesn't exist
if (!file_exists($folder)) {
    mkdir($folder, 0777, true); // Create with full permissions
}

// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($fullPath);

echo "Excel file saved as: $fullPath";
?>


                      
