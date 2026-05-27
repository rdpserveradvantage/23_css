<?php  
// return ;

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

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);

$sheet->getStyle('A:AK')->getAlignment()->setHorizontal('center');

foreach (range('A', $sheet->getHighestColumn()) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}



$sheet->getStyle('A1:AQ1')->applyFromArray($headerStyle);

$sheet->setCellValue('A1', 'Sr No');
$sheet->setCellValue('B1', 'Customer');
$sheet->setCellValue('C1', 'Bank');
$sheet->setCellValue('D1', 'Tracker No');
$sheet->setCellValue('E1', 'ATMID');
$sheet->setCellValue('F1', 'OLD ATMID');
$sheet->setCellValue('G1', 'ATMID_2');
$sheet->setCellValue('H1', 'ATMID_3');
$sheet->setCellValue('I1', 'ATMShortName');
$sheet->setCellValue('J1', 'SiteAddress');
$sheet->setCellValue('K1', 'City');
$sheet->setCellValue('L1', 'State');
$sheet->setCellValue('M1', 'Zone');
$sheet->setCellValue('N1', 'CTS_LocalBranch');
$sheet->setCellValue('O1', 'Panel_Make');
$sheet->setCellValue('P1', 'OldPanelID');
$sheet->setCellValue('Q1', 'NewPanelID');
$sheet->setCellValue('R1', 'PanelIP');
$sheet->setCellValue('S1', 'DVRIP');
$sheet->setCellValue('T1', 'DVRName');
$sheet->setCellValue('U1', 'UserName');
$sheet->setCellValue('V1', 'Password');
$sheet->setCellValue('W1', 'Live');
$sheet->setCellValue('X1', 'Live Date');
$sheet->setCellValue('Y1', 'Installation Engineer Name');
$sheet->setCellValue('Z1', 'CTS Engineer Name');
$sheet->setCellValue('AA1', 'CTS Engineer Number');
$sheet->setCellValue('AB1', 'Installation date');
$sheet->setCellValue('AC1', 'Site Add By');
$sheet->setCellValue('AD1', 'Site Edit By');
$sheet->setCellValue('AE1', 'GSM Number');
$sheet->setCellValue('AF1', 'DVR_Model_num');
$sheet->setCellValue('AG1', 'Router_Model_num');
$sheet->setCellValue('AH1', 'Remarks');
$sheet->setCellValue('AI1', 'Router Id');
$sheet->setCellValue('AJ1', 'SIM Number');
$sheet->setCellValue('AK1', 'SIM Owner');
$sheet->setCellValue('AL1', 'Router Brand');
$sheet->setCellValue('AM1', 'Camera IP');
$sheet->setCellValue('AN1', 'Port');
$sheet->setCellValue('AO1', 'Ip Camera');
$sheet->setCellValue('AP1', 'Bank Officer Name');
$sheet->setCellValue('AQ1', 'Bank Officer Number');




$row = 2;
while ($rowarr = mysqli_fetch_array($sqry)) {


    $excelCount = 0;
    $id = $rowarr['SN'];
    $sql1 = "select * from esurvsites where ATM_ID='" . $rowarr["ATMID"] . "'";

    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);



    $site_details = mysqli_query($conn, "select * from sites_details where site_id ='" . $id . "' and project=1");

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

    $data = '';
    $camera_ip = '';
    $data = get_sites_info($rowarr["ATMID"], 'cam_ip');
    foreach ($data as $key => $value) {
        $camera_ip .= $value . ",";
    }

    $data = '';
    $port = '';
    $data = get_sites_info($rowarr["ATMID"], 'port');
    foreach ($data as $key => $value) {
        $port .= $value . ",";
    }

    $data = '';
    $cam_name = '';
    $data = get_sites_info($rowarr["ATMID"], 'cam_name');
    foreach ($data as $key => $value) {
        $cam_name .= $value . ",";
    }

    $sheet->setCellValue('A' . $row, $row - 1); // Assuming this is Sr No
    $sheet->setCellValue('B' . $row, $rowarr['Customer']);
    $sheet->setCellValue('C' . $row, $rowarr['Bank']);
    $sheet->setCellValue('D' . $row, $rowarr['TrackerNo']);
    $sheet->setCellValue('E' . $row, $rowarr['ATMID']);
    $sheet->setCellValue('F' . $row, $rowarr['old_atmid']);
    $sheet->setCellValue('G' . $row, $rowarr['ATMID_2']);
    $sheet->setCellValue('H' . $row, $rowarr['ATMID_3']);
    $sheet->setCellValue('I' . $row, $rowarr['ATMShortName']);
    $sheet->setCellValue('J' . $row, $rowarr['SiteAddress']);
    $sheet->setCellValue('K' . $row, $rowarr['City']);
    $sheet->setCellValue('L' . $row, $rowarr['State']);
    $sheet->setCellValue('M' . $row, $rowarr['Zone']);
    $sheet->setCellValue('N' . $row, $row1['CTS_LocalBranch']);
    $sheet->setCellValue('O' . $row, $rowarr['Panel_Make']);
    $sheet->setCellValue('P' . $row, $rowarr['OldPanelID']);
    $sheet->setCellValue('Q' . $row, $rowarr['NewPanelID']);
    $sheet->setCellValue('R' . $row, $rowarr['PanelIP']);
    $sheet->setCellValue('S' . $row, $rowarr['DVRIP']);
    $sheet->setCellValue('T' . $row, $rowarr['DVRName']);
    $sheet->setCellValue('U' . $row, $rowarr['UserName']);
    $sheet->setCellValue('V' . $row, $rowarr['Password']);
    $sheet->setCellValue('W' . $row, $rowarr['live']);
    $sheet->setCellValue('X' . $row, $rowarr['live_date']);
    $sheet->setCellValue('Y' . $row, $rowarr['eng_name']);
    $sheet->setCellValue('Z' . $row, $row1['CTS_Engineer_Name']);
    $sheet->setCellValue('AA' . $row, $row1['CTS_Engineer_Number']);
    $sheet->setCellValue('AB' . $row, $rowarr['current_dt']);
    $sheet->setCellValue('AC' . $row, $rowarr['addedby']);
    $sheet->setCellValue('AD' . $row, $rowarr['editby']);
    $sheet->setCellValue('AE' . $row, $rowarr['TwoWayNumber']);
    $sheet->setCellValue('AF' . $row, $rowarr['DVR_Model_num']);
    $sheet->setCellValue('AG' . $row, $rowarr['Router_Model_num']);
    $sheet->setCellValue('AH' . $row, $rowarr['site_remark']);
    $sheet->setCellValue('AI' . $row, $router_id);
    $sheet->setCellValue('AJ' . $row, getsiminfo($rowarr['ATMID'], 'simnnumber'));
    $sheet->setCellValue('AK' . $row, getsiminfo($rowarr['ATMID'], 'simowner'));
    $sheet->setCellValue('AL' . $row, $router_brand);
    $sheet->setCellValue('AM' . $row, $camera_ip);
    $sheet->setCellValue('AN' . $row, $port);
    $sheet->setCellValue('AO' . $row, $cam_name);
    $sheet->setCellValue('AP' . $row, $row1['bank_officer_name']);
    $sheet->setCellValue('AQ' . $row, $row1['bank_officer_number']);



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
header('Content-Disposition: attachment;filename="exported_data_rms.xlsx"');
header('Cache-Control: max-age=0');

// Instantiate PhpSpreadsheet Writer
$writer = new Xlsx($spreadsheet);

// Save the file to output
$writer->save('php://output');

// Exit script
exit();
