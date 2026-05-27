<?php
// Include necessary files and setup
include ('./config.php');
require './vendor/autoload.php';

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



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;


$statement = $_REQUEST['exportsql'];
$sqry = mysqli_query($con, $statement);

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


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
$sheet->getStyle('A1:AI1')->applyFromArray($headerStyle);



// Set headers (assuming $sheet is your PHPExcel or PHPSpreadsheet worksheet object)
$sheet->setCellValue('A1', 'Sr No');
$sheet->setCellValue('B1', 'Customer');
$sheet->setCellValue('C1', 'Bank');
$sheet->setCellValue('D1', 'Tracker No');
$sheet->setCellValue('E1', 'ATMID');
$sheet->setCellValue('F1', 'ATMID_2');
$sheet->setCellValue('G1', 'ATMShortName');
$sheet->setCellValue('H1', 'SiteAddress');
$sheet->setCellValue('I1', 'City');
$sheet->setCellValue('J1', 'State');
$sheet->setCellValue('K1', 'Zone');
$sheet->setCellValue('L1', 'PanelIP');
$sheet->setCellValue('M1', 'DVRIP');
$sheet->setCellValue('N1', 'DVRName');
$sheet->setCellValue('O1', 'DVR_Model_num');
$sheet->setCellValue('P1', 'DVR_Serial_num');
$sheet->setCellValue('Q1', 'CTSLocalBranch');
$sheet->setCellValue('R1', 'CTS_BM_Name');
$sheet->setCellValue('S1', 'CTS_BM_Number');
$sheet->setCellValue('T1', 'HDD');
$sheet->setCellValue('U1', 'Camera1');
$sheet->setCellValue('V1', 'Camera2');
$sheet->setCellValue('W1', 'Camera3');
$sheet->setCellValue('X1', 'Attachment1');
$sheet->setCellValue('Y1', 'Attachment2');
$sheet->setCellValue('Z1', 'LiveDate');
$sheet->setCellValue('AA1', 'Site Remark');
$sheet->setCellValue('AB1', 'User Name');
$sheet->setCellValue('AC1', 'Password');
$sheet->setCellValue('AD1', 'Router Id');
$sheet->setCellValue('AE1', 'SIM Number');
$sheet->setCellValue('AF1', 'SIM Owner');
$sheet->setCellValue('AG1', 'Router Brand');
$sheet->setCellValue('AH1', 'Live Status');
$sheet->setCellValue('AI1', 'OLD ATMID');

// Execute your SQL query to fetch data
$row = 2; // Start populating data from row 2 (assuming row 1 is for headers)

while ($rowarr = mysqli_fetch_array($sqry)) {

    $id = $rowarr['SN'];
    $site_details = mysqli_query($con, "SELECT * FROM sites_details WHERE site_id ='" . $id . "' AND project='2'");
    if ($site_details_result = mysqli_fetch_assoc($site_details)) {
        $router_id = $site_details_result['router_id'];
        $simnumber = $site_details_result['simnumber'];
        $simowner = $site_details_result['simowner'];
        $router_brand = $site_details_result['routebrand'];
    } else {
        $router_id = '';
        $simnumber = '';
        $simowner = '';
        $router_brand = '';
    }
    $sheet->setCellValue('A' . $row, $row - 1);
    $sheet->setCellValue('B' . $row, $rowarr['Customer']);
    $sheet->setCellValue('C' . $row, $rowarr['Bank']);
    $sheet->setCellValue('D' . $row, $rowarr['TrackerNo']);
    $sheet->setCellValue('E' . $row, $rowarr['ATMID']);
    $sheet->setCellValue('F' . $row, $rowarr['ATMID_2']);
    $sheet->setCellValue('G' . $row, $rowarr['ATMShortName']);
    $sheet->setCellValue('H' . $row, $rowarr['SiteAddress']);
    $sheet->setCellValue('I' . $row, $rowarr['City']);
    $sheet->setCellValue('J' . $row, $rowarr['State']);
    $sheet->setCellValue('K' . $row, $rowarr['Zone']);
    $sheet->setCellValue('L' . $row, $rowarr['PanelIP']);
    $sheet->setCellValue('M' . $row, $rowarr['DVRIP']);
    $sheet->setCellValue('N' . $row, $rowarr['DVRName']);
    $sheet->setCellValue('O' . $row, $rowarr['DVR_Model_num']);
    $sheet->setCellValue('P' . $row, $rowarr['DVR_Serial_num']);
    $sheet->setCellValue('Q' . $row, $rowarr['CTSLocalBranch']);
    $sheet->setCellValue('R' . $row, $rowarr['CTS_BM_Name']);
    $sheet->setCellValue('S' . $row, $rowarr['CTS_BM_Number']);
    $sheet->setCellValue('T' . $row, $rowarr['HDD']);
    $sheet->setCellValue('U' . $row, $rowarr['Camera1']);
    $sheet->setCellValue('V' . $row, $rowarr['Camera2']);
    $sheet->setCellValue('W' . $row, $rowarr['Camera3']);
    $sheet->setCellValue('X' . $row, $rowarr['Attachment1']);
    $sheet->setCellValue('Y' . $row, $rowarr['Attachment2']);
    $sheet->setCellValue('Z' . $row, $rowarr['liveDate']);
    $sheet->setCellValue('AA' . $row, $rowarr['site_remark']);
    $sheet->setCellValue('AB' . $row, $rowarr['UserName']);
    $sheet->setCellValue('AC' . $row, $rowarr['Password']);
    $sheet->setCellValue('AD' . $row, $router_id);
    $sheet->setCellValue('AE' . $row, getsiminfo($rowarr['ATMID'], 'simnnumber'));
    $sheet->setCellValue('AF' . $row, getsiminfo($rowarr['ATMID'], 'simowner'));
    $sheet->setCellValue('AG' . $row, $router_brand);
    $sheet->setCellValue('AH' . $row, $rowarr['live']);
    $sheet->setCellValue('AI' . $row, $rowarr['old_atmid']);


    $row++;
}


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

// Set auto width for all columns
foreach (range('A', $highestColumn) as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="exported_data.xlsx"');
header('Cache-Control: max-age=0');

// Instantiate PhpSpreadsheet Writer
$writer = new Xlsx($spreadsheet);

// Save the file to output
$writer->save('php://output');

// Exit script
exit();
