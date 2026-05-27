<?php  


include ('./config.php');
include ('./vendor/autoload.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;


try {
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}



$con=$conn;




function is_image($path)
{
  $a = getimagesize($path);
  $image_type = $a[2];

  if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
    return true;
  }
  return false;
}





function getsiminfo($atmid, $parameter)
{
  global $conn;

  // echo "select $parameter from sites_siminfo where atmid='".$atmid."'";
  $sql = mysqli_query($conn, "select $parameter from sites_siminfo where atmid='" . $atmid . "'");
  $sql_result = mysqli_fetch_assoc($sql);
  return $sql_result[$parameter];
}


function get_livedatetime($atmid)
{
  global $conn;
  $live_date = array();
  // echo "select live_date from sites_log where ATMID='".$atmid."'";
  $sql = mysqli_query($conn, "select live_date from sites where ATMID='" . $atmid . "'");
  if (mysqli_num_rows($sql) > 0) {
    while ($sql_result = mysqli_fetch_assoc($sql)) {
      $live_date[] = $sql_result['live_date'];
    }
  }
  return $live_date;
}



function get_sites_info($atmid, $parameter)
{
  global $conn;
  $info = array();


  $sql = mysqli_query($conn, "select $parameter from sites_info where atmid='" . $atmid . "' order by id desc");
  if (mysqli_num_rows($sql) > 0) {
    while ($sql_result = mysqli_fetch_assoc($sql)) {
      $info[] = $sql_result[$parameter];
    }
  }
  return $info;
}


function convertDateTimeFormat($datetime, $outputFormat = "d/M/y H:i:s")
{
  // Convert input datetime string to Unix timestamp
  $timestamp = strtotime($datetime);

  // Format the timestamp to the desired output format
  $newDate = date($outputFormat, $timestamp);

  return $newDate;
}
function convertDateFormat($datetime, $outputFormat = "d-m-Y")
{
  // Convert input datetime string to Unix timestamp
  $timestamp = strtotime($datetime);

  // Format the timestamp to the desired output format
  $newDate = date($outputFormat, $timestamp);

  return $newDate;
}
function getPanelZoneStatus($panelip, $zone)
{
  global $con;
  $zone = ltrim($zone, '0');
  $zoneColumn = "zon$zone";

  // Check if the column exists in the panel_health table
  $columnExists = false;
  $result = mysqli_query($con, "SHOW COLUMNS FROM panel_health LIKE '$zoneColumn'");
  if (mysqli_num_rows($result) > 0) {
    $columnExists = true;
  }

  // If the column exists, proceed with the query
  if ($columnExists) {
    $sql = mysqli_query($con, "SELECT $zoneColumn FROM panel_health WHERE ip='$panelip'");
    if ($sql_result = mysqli_fetch_assoc($sql)) {
      return $sql_result[$zoneColumn];
    } else {
      return '';
    }
  } else {
    // Handle the case where the column does not exist
    return '';
  }
}

function getPanelZone($panelMake, $sensorType)
{
  global $con;
  $query = "SELECT ZONE FROM $panelMake WHERE SensorName like '%" . $sensorType . "%'";
  $result = mysqli_query($con, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $panelrow = mysqli_fetch_assoc($result);

    return $panelrow['ZONE'];
  } else {
    return 0;
  }

}



$statement = $_REQUEST['exportsql'];
$sqry = mysqli_query($con, $statement);


// Create new Spreadsheet object


$headerStyle = [
    'fill' => [
        'fillType' => Style\Fill::FILL_SOLID,
        'startColor' => ['argb' => 'FF4287f5'],
    ],
    'font' => [
        'bold' => true,
        'color' => ['argb' => 'FFFFFFFF'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Style\Border::BORDER_THIN,
        ],
    ],
];

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);

$sheet->getStyle('A:AL')->getAlignment()->setHorizontal('center');

foreach (range('A', $sheet->getHighestColumn()) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}



$sheet->getStyle('A1:AQ1')->applyFromArray($headerStyle);

$sheet->setCellValue('A1', 'Sr No');
$sheet->setCellValue('B1', 'Unique ID');
$sheet->setCellValue('C1', 'Customer');
$sheet->setCellValue('D1', 'Bank');
$sheet->setCellValue('E1', 'Tracker No');
$sheet->setCellValue('F1', 'Comfort ID');
$sheet->setCellValue('G1', 'ATMID');
$sheet->setCellValue('H1', 'ATMID_2');
$sheet->setCellValue('I1', 'ATMShortName');
$sheet->setCellValue('J1', 'SiteAddress');
$sheet->setCellValue('K1', 'City');
$sheet->setCellValue('L1', 'State');
$sheet->setCellValue('M1', 'Zone');
$sheet->setCellValue('N1', 'DVRIP');
$sheet->setCellValue('O1', 'DVRName');
$sheet->setCellValue('P1', 'DVR_Model_num');
$sheet->setCellValue('Q1', 'DVR_Serial_num');
$sheet->setCellValue('R1', 'CTSLocalBranch');
$sheet->setCellValue('S1', 'CTS_BM_Name');
$sheet->setCellValue('T1', 'CTS_BM_Number');
$sheet->setCellValue('U1', 'HDD');
$sheet->setCellValue('V1', 'Camera1');
$sheet->setCellValue('W1', 'Camera2');
$sheet->setCellValue('X1', 'Camera3');
$sheet->setCellValue('Y1', 'LiveDate');
$sheet->setCellValue('Z1', 'Site Remark'); // Correcting column Z skipped earlier
$sheet->setCellValue('AA1', 'User Name');  // Corrected sequence
$sheet->setCellValue('AB1', 'Password');
$sheet->setCellValue('AC1', 'Router ID');
$sheet->setCellValue('AD1', 'Edit');
$sheet->setCellValue('AE1', 'Remark');
$sheet->setCellValue('AF1', 'Tracker');
$sheet->setCellValue('AG1', 'BM Name');
$sheet->setCellValue('AH1', 'Engineer Name');
$sheet->setCellValue('AI1', 'Status Date');
$sheet->setCellValue('AJ1', 'OLD ATMID');
$sheet->setCellValue('AK1', 'Installation Date');
$sheet->setCellValue('AL1', 'Status');



$row = 2;
while ($rowarr = mysqli_fetch_array($sqry)) {



    $id = $rowarr['id'];

    $uniqueID = '';
    $dvronline_details = mysqli_query($conn, "select * from dvronline_details where dvrid='" . $id . "' order by id desc");
    $dvronline_details_result = mysqli_fetch_assoc($dvronline_details);

    $tracker = $dvronline_details_result['tracker'];
    $bmName = $dvronline_details_result['bmName'];
    $engineerName = $dvronline_details_result['engineerName'];
    $statusDate = $dvronline_details_result['statusDate'];

    $sheet->setCellValue('A' . $row, $row - 1); // Sr No
    $sheet->setCellValue('B' . $row, $rowarr["unique_id"]); // Customer
    $sheet->setCellValue('C' . $row, $rowarr["customer"]); // Customer
    $sheet->setCellValue('D' . $row, $rowarr["Bank"]); // Bank
    $sheet->setCellValue('E' . $row, $rowarr["NA"]); // NA
    $sheet->setCellValue('F' . $row, $uniqueID); // Comfort ID (uniqueID)
    $sheet->setCellValue('G' . $row, $rowarr["ATMID"]); // ATMID
    $sheet->setCellValue('H' . $row, $rowarr["ATMID2"]); // ATMID2
    $sheet->setCellValue('I' . $row, $rowarr["Address"]); // Address
    $sheet->setCellValue('J' . $row, $rowarr["Location"]); // Location
    $sheet->setCellValue('K' . $row, $rowarr["city"]); // City
    $sheet->setCellValue('L' . $row, $rowarr["State"]); // State
    $sheet->setCellValue('M' . $row, $rowarr["zone"]); // Zone
    
    $sheet->setCellValue('N' . $row, $rowarr["IPAddress"]); // DVR IP
    $sheet->setCellValue('O' . $row, $rowarr["dvrname"]); // DVR Name
    $sheet->setCellValue('P' . $row, 'NA'); // DVR Model Number (NA placeholder)
    $sheet->setCellValue('Q' . $row, 'NA'); // DVR Serial Number (NA placeholder)
    $sheet->setCellValue('R' . $row, 'NA'); // HDD (NA placeholder)
    $sheet->setCellValue('S' . $row, 'NA'); // Camera1 (NA placeholder)
    $sheet->setCellValue('T' . $row, 'NA'); // Camera2 (NA placeholder)
    $sheet->setCellValue('U' . $row, 'NA'); // Camera3 (NA placeholder)
    
    $sheet->setCellValue('V' . $row, 'NA'); // Attachment1 (NA placeholder)
    $sheet->setCellValue('W' . $row, 'NA'); // Attachment2 (NA placeholder)
    $sheet->setCellValue('X' . $row, 'NA'); // Live Date (NA placeholder)
    $sheet->setCellValue('Y' . $row, $rowarr['LiveDate']); // LiveDate from array
    
    $sheet->setCellValue('Z' . $row, 'NA'); // Site Remark (NA placeholder)
    
    $sheet->setCellValue('AA' . $row, $rowarr['UserName']); // User Name
    $sheet->setCellValue('AB' . $row, $rowarr['Password']); // Password
    $sheet->setCellValue('AC' . $row, $rowarr['Router ID']); // Router ID
    $sheet->setCellValue('AD' . $row, 'Edit'); // Edit (Placeholder for editing)
    
    $sheet->setCellValue('AE' . $row, $rowarr['remark']); // Remark
    $sheet->setCellValue('AF' . $row, $tracker); // Tracker
    
    $sheet->setCellValue('AG' . $row, $bmName); // BM Name
    $sheet->setCellValue('AH' . $row, $engineerName); // Engineer Name
    
    $sheet->setCellValue('AI' . $row, $statusDate); // Status Date
    $sheet->setCellValue('AJ' . $row, $rowarr['old_atm']); // OLD ATMID
    $sheet->setCellValue('AK' . $row, $rowarr['installationDate']); // Installation Date
    $sheet->setCellValue('AL' . $row, $rowarr['Status']); // Status
    


    $row++;
}

foreach ($sheet->getColumnIterator() as $column) {
    $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
}


// foreach (range('A', $sheet->getHighestColumn()) as $col) {
//    $sheet->getColumnDimension($col)->setAutoSize(true);
// }



// Apply borders to all cells
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Style\Border::BORDER_THIN,
        ],
    ],
];
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray($styleArray);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="exported_data_cloud.xlsx"');
header('Cache-Control: max-age=0');

// Instantiate PhpSpreadsheet Writer
$writer = new Xlsx($spreadsheet);

// Save the file to output
$writer->save('php://output');

// Exit script
exit();
