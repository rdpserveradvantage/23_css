<?php


include('./config.php');
include('./vendor/autoload.php');

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



$con = $conn;




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

$sheet->getStyle('A:AK')->getAlignment()->setHorizontal('center');

foreach (range('A', $sheet->getHighestColumn()) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}



$sheet->getStyle('A1:AD1')->applyFromArray($headerStyle);

$sheet->setCellValue('A1', 'Sr No');
$sheet->setCellValue('B1', 'Unique ID');

$sheet->setCellValue('C1', 'Customer');
$sheet->setCellValue('D1', 'Bank');
$sheet->setCellValue('E1', 'Tracker No');
$sheet->setCellValue('F1', 'Unique ID');
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
$sheet->setCellValue('R1', 'CTS_LocalBranch');
$sheet->setCellValue('S1', 'CTS BM');
$sheet->setCellValue('T1', 'CTS BM Number');
$sheet->setCellValue('U1', 'HDD');


$sheet->setCellValue('V1', 'Camera1');
$sheet->setCellValue('W1', 'Camera2');
$sheet->setCellValue('X1', 'Camera3');

$sheet->setCellValue('Y1', 'Live Date');

$sheet->setCellValue('Z1', 'Site Remarks');

$sheet->setCellValue('AA1', 'UserName');
$sheet->setCellValue('AB1', 'Password');

$sheet->setCellValue('AC1', 'Live');
$sheet->setCellValue('AD1', 'Old ATMID');




$row = 2;
while ($rowarr = mysqli_fetch_array($sqry)) {

    $excelCount = 0;
    $id = $rowarr['SN'];
    $sql1 = "select * from esurvsites where ATM_ID='" . $rowarr["ATMID"] . "'";

    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);



    $site_details = mysqli_query($conn, "select * from sites_details where site_id ='" . $id . "' and project=2");

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


    $uniqueID = '';
    

    $sheet->setCellValue('A' . $row, $row - 1); // Assuming this is Sr No
    $sheet->setCellValue('B' . $row, $rowarr['unique_id']);
    $sheet->setCellValue('C' . $row, $rowarr['Customer']);
    $sheet->setCellValue('D' . $row, $rowarr['Bank']);
    $sheet->setCellValue('E' . $row, $rowarr['TrackerNo']);

    $sheet->setCellValue('F' . $row, $uniqueID);


    $sheet->setCellValue('G' . $row, $rowarr['ATMID']);
    $sheet->setCellValue('H' . $row, $rowarr['ATMID_2']);
    $sheet->setCellValue('I' . $row, $rowarr['ATMShortName']);
    $sheet->setCellValue('J' . $row, $rowarr['SiteAddress']);
    $sheet->setCellValue('K' . $row, $rowarr['City']);


    $sheet->setCellValue('L' . $row, $rowarr['State']);
    $sheet->setCellValue('M' . $row, $rowarr['Zone']);
    $sheet->setCellValue('N' . $row, $rowarr['DVRIP']);
    $sheet->setCellValue('O' . $row, $rowarr['DVRName']);
    $sheet->setCellValue('P' . $row, $rowarr['DVR_Model_num']);
    $sheet->setCellValue('Q' . $row, $rowarr['DVR_Serial_num']);
    $sheet->setCellValue('R' . $row, $rowarr['CTS_LocalBranch']);
    $sheet->setCellValue('S' . $row, $rowarr['CTS_BM_Name']);
    $sheet->setCellValue('T' . $row, $rowarr['CTS_BM_Number']);
    $sheet->setCellValue('U' . $row, $rowarr['HDD']);

    $sheet->setCellValue('V' . $row, $rowarr['Camera1']);
    $sheet->setCellValue('W' . $row, $rowarr['Camera2']);
    $sheet->setCellValue('X' . $row, $rowarr['Camera3']);

    $sheet->setCellValue('Y' . $row, $rowarr['liveDate']);
    $sheet->setCellValue('Z' . $row, $rowarr['site_remark']);

    $sheet->setCellValue('AA' . $row, $rowarr['UserName']);
    $sheet->setCellValue('AB' . $row, $rowarr['Password']);

    $sheet->setCellValue('AC' . $row, $rowarr['live']);




    $sheet->setCellValue('AD' . $row, $rowarr['old_atmid']);




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
header('Content-Disposition: attachment;filename="exported_data_DVRSITE.xlsx"');
header('Cache-Control: max-age=0');

// Instantiate PhpSpreadsheet Writer
$writer = new Xlsx($spreadsheet);

// Save the file to output
$writer->save('php://output');

// Exit script
exit();
