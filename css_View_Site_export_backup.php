<?php
include('config.php');


require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

function getColumnLabel($index) {
  $base26 = '';
  if ($index >= 26) {
      $base26 .= chr(65 + ($index / 26) - 1);
  }    
  $base26 .= chr(65 + ($index % 26));
  return $base26;
}

// $exportSql = $_REQUEST['exportSql']; 
// $sql_app = mysqli_query($con, $exportSql); 

$qry = $_POST['expqry'];  // sql 
$qrydata = $_POST['expdata']; // request data

$_project_id = "1";
if(isset($_POST['project'])){
	$_project_id = $_POST['project']; 
}


// error_reporting(0);
// ini_set('max_execution_time', 0);
// set_time_limit(0);



function endsWith($haystack, $needle)
{
  $length = strlen($needle);

  return $length === 0 ||
    (substr($haystack, -$length) === $needle);
}

function clean($string)
{
  $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function remove_special($site_remark2)
{
  $site_remark2_arr = explode(" ", $site_remark2);

  foreach ($site_remark2_arr as $k => $v) {
    $a[] = preg_split('/\n/', $v);
  }

  $site_remark = '';
  foreach ($a as $key => $value) {
    foreach ($value as $ke => $va) {
      $site_remark .= $va . " ";
    }
  }

  return clean($site_remark);
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
  $sql = mysqli_query($conn, "select live_date from sites_log where ATMID='" . $atmid . "'");
  while ($sql_result = mysqli_fetch_assoc($sql)) {
    $live_date[] = $sql_result['live_date'];
  }
  return $live_date;
}



function get_sites_info($atmid, $parameter)
{
  global $conn;
  $info = array();


  $sql = mysqli_query($conn, "select $parameter from sites_info where atmid='" . $atmid . "' order by id desc");

  while ($sql_result = mysqli_fetch_assoc($sql)) {
    $info[] = $sql_result[$parameter];
  }

  return  $info;
}

if ($qrydata == "RMS") {
  $contents = '';
  $contents .= "Sr No \t Customer \t Bank \t Tracker No \t ATMID \t OLD ATMID \t ATMID_2 \t ATMID_3 \t ATMShortName \t SiteAddress \t City \t State \t Zone \t CTS_LocalBranch \t Panel_Make \t OldPanelID \t NewPanelID \t PanelIP \t DVRIP \t DVRName \t UserName \t Password \t Live \t Live Date \t Installation Engineer Name \t CTS Engineer Name \t CTS Engineer Number \t CSSBM \t CSSBMNumber \t CSS BM Email \t BackofficerName \t BackofficerNumber \t HeadSupervisorName \t HeadSupervisorNumber \t SupervisorName \t Supervisornumber \t RA Name \t RA Number \t Police Number \t Police Station \t Fire Station Name \t Fire Station number \t Atm Officer Name \t Atm Officer Number \t ATM Officer Email \t Zonal Co-ordinator Name \t Zonal Co-ordinator Number \t Zonal Co-ordinator Email \t Bank Officer Email ID \t CO Owner Name \t CO Owner Number \t CO Owner Email ID \t Zonal Name \t Zonal Number \t Zonal Email ID \t Installation date \t Site Add By \t Site Edit By \t GSM Number \t DVR_Model_num \t Router_Model_num \t Remarks \t Router Id \t SIM Number \t SIM Owner \t Router Brand \t Camera IP \t Port \t Ip Camera \t Bank Officer Name \t Bank Officer Number \t ";



  $sqry = mysqli_query($conn, $qry);

  $num = mysqli_num_rows($sqry);


  $count = 0;
  $srn = 1;
  $apptotamt = 0;
  $row = 2;



  while ($rowarr = mysqli_fetch_array($sqry)) {
    $excelCount = 0;
    $id = $rowarr['SN'];
    $sql1 = "select * from esurvsites where ATM_ID='" . $rowarr["ATMID"] . "'";

    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);



    $site_details = mysqli_query($conn, "select * from sites_details where site_id ='" . $id . "' and project='".$_project_id."'");

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
      $camera_ip .=  $value . ",";
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




    $rowarr['Customer'];

    $contents .= "\n" . $srn . "\t";

    $contents .= trim(remove_special($rowarr['Customer'])) . "\t";
    $contents .= trim(remove_special($rowarr['Bank'])) . "\t";
    $contents .= trim(remove_special($rowarr['TrackerNo'])) . "\t";
    $contents .= trim(remove_special($rowarr['ATMID'])) . "\t";
    $contents .= trim(remove_special($rowarr['old_atmid'])) . "\t";
    $contents .= trim(remove_special($rowarr['ATMID_2'])) . "\t";
    $contents .= trim(remove_special($rowarr['ATMID_3'])) . "\t";
    $contents .= trim(remove_special($rowarr['ATMShortName'])) . "\t";
    $contents .= trim(remove_special($rowarr['SiteAddress'])) . "\t";
    $contents .= trim(remove_special($rowarr['City'])) . "\t";
    $contents .= trim(remove_special($rowarr['State'])) . "\t";
    $contents .= trim(remove_special($rowarr['Zone'])) . "\t";
    $contents .= trim(remove_special($row1['CTS_LocalBranch'])) . "\t";
    $contents .= trim(remove_special($rowarr['Panel_Make'])) . "\t";
    $contents .= trim(remove_special($rowarr['OldPanelID'])) . "\t";
    $contents .= trim(remove_special($rowarr['NewPanelID'])) . "\t";
    $contents .= $rowarr['PanelIP'] . "\t";
    $contents .= $rowarr['DVRIP'] . "\t";
    $contents .= trim(remove_special($rowarr['DVRName'])) . "\t";
    $contents .= trim(remove_special($rowarr['UserName'])) . "\t";
    $contents .= trim(remove_special($rowarr['Password'])) . "\t";
    $contents .= trim(remove_special($rowarr['live'])) . "\t";
    $contents .= $rowarr['live_date'] . "\t";
    $contents .= trim(remove_special($rowarr['eng_name'])) . "\t";
    $contents .= trim(remove_special($row1['CTS_Engineer_Name'])) . "\t";
    $contents .= trim(remove_special($row1['CTS_Engineer_Number'])) . "\t";
    $contents .= trim(remove_special($row1['CSSBM'])) . "\t";
    $contents .= trim(remove_special($row1['CSSBMNumber'])) . "\t";
    $contents .= trim(remove_special($row1['CSSBM_Email'])) . "\t";
    $contents .= trim(remove_special($row1['BackofficerName'])) . "\t";
    $contents .= trim(remove_special($row1['BackofficerNumber'])) . "\t";
    $contents .= trim(remove_special($row1['HeadSupervisorName'])) . "\t";
    $contents .= trim(remove_special($row1['HeadSupervisorNumber'])) . "\t";
    $contents .= trim(remove_special($row1['SupervisorName'])) . "\t";
    $contents .= trim(remove_special($row1['Supervisornumber'])) . "\t";
    $contents .= trim(remove_special($row1['RA_QRT_NAME'])) . "\t";
    $contents .= trim(remove_special($row1['RA_QRT_NUMBER'])) . "\t";
    $contents .= trim(remove_special($row1['Policestation'])) . "\t";
    $contents .= trim(remove_special($row1['Polstnname'])) . "\t";
    $contents .= trim(remove_special($row1['firestation_name'])) . "\t";
    $contents .= trim(remove_special($row1['firestation_number'])) . "\t";
    $contents .= trim(remove_special($row1['atm_officer_name'])) . "\t";
    $contents .= trim(remove_special($row1['atm_officer_number'])) . "\t";
    $contents .= trim(remove_special($row1['atm_officer_email'])) . "\t";
    $contents .= trim(remove_special($row1['zonal_co_ordinator_name'])) . "\t";
    $contents .= trim(remove_special($row1['zonal_co_ordinator_number'])) . "\t";
    $contents .= trim(remove_special($row1['zonal_co_ordinator_email'])) . "\t";
    $contents .= trim(remove_special($row1['Bank_Officer_Email_ID'])) . "\t";
    $contents .= trim(remove_special($row1['CO_Owner_Name'])) . "\t";
    $contents .= trim(remove_special($row1['CO_Owner_Number'])) . "\t";
    $contents .= trim(remove_special($row1['CO_Owner_Email_ID'])) . "\t";
    $contents .= trim(remove_special($row1['Zonal_Name'])) . "\t";
    $contents .= trim(remove_special($row1['Zonal_Number'])) . "\t";
    $contents .= trim(remove_special($row1['Zonal_Email_ID'])) . "\t";
    $contents .= $rowarr['current_dt'] . "\t";
    $contents .= trim(remove_special($rowarr['addedby'])) . "\t";
    $contents .= trim(remove_special($rowarr['editby'])) . "\t";
    $contents .= trim(remove_special($row1['TwoWayNumber'])) . "\t";
    $contents .= trim(remove_special($rowarr['DVR_Model_num'])) . "\t";
    $contents .= trim(remove_special($rowarr['Router_Model_num'])) . "\t";
    $contents .= trim(remove_special($rowarr['site_remark'])) . "\t";
    $contents .= trim(remove_special($router_id)) . "\t";
    $contents .= trim(remove_special(getsiminfo($rowarr['ATMID'], 'simnnumber'))) . "\t";
    $contents .= trim(remove_special(getsiminfo($rowarr['ATMID'], 'simowner'))) . "\t";
    $contents .= trim(remove_special($router_brand)) . "\t";
    $contents .= $camera_ip . "\t";
    $contents .= trim(remove_special($port)) . "\t";
    $contents .= trim(remove_special($cam_name)) . "\t";
    $contents .= trim(remove_special($row1['bank_officer_name'])) . "\t";
    $contents .= trim(remove_special($row1['bank_officer_number'])) . "\t";



    $row++;
    $srn++;
  }
  header("Content-Disposition: attachment; filename=sites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;


  return;
} else if ($qrydata == "DVR") {

  $headerStyle = [
    'font' => [
        'bold' => true, // Make the text bold
        'color' => ['rgb' => 'FFFFFF'], // Font color (white)
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0070C0'], // Background color (blue)
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'], // Border color (black)
        ],
    ],
];
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $headerStyles = [
    'font' => [
      'bold' => true, // Make the text bold
      'color' => ['rgb' => 'FFFFFF'], // Font color (white)
    ],
    'fill' => [
      'fillType' => Fill::FILL_SOLID,
      'startColor' => ['rgb' => '0070C0'], // Background color (blue)
    ],
    'borders' => [
      'outline' => [
        'borderStyle' => Border::BORDER_THIN,
        'color' => ['argb' => 'FF000000'], // Border color (black)
      ],
    ],
  ];


  $headers = array(
    'Sr No',
    'Customer',
    'Bank',
    'Tracker No',
    'ATMID',
    'ATMID_2',
    'ATMShortName',
    'SiteAddress',
    'City',
    'State',
    'Zone',
    'PanelIP',
    'DVRIP',
    'DVRName',
    'DVR_Model_num',

    'DVR_Serial_num',
    'CTSLocalBranch',


    'CTS_BM_Name',
    'CTS_BM_Number',
    'HDD',
    'Camera1',

    'Camera2',
    'Camera3',
    'Attachment1',
    'Attachment2',
    'LiveDate',
    'Site Remark',
    'User Name',
    'Password',

    'Router Id',
    'SIM Number',
    'SIM Owner',
    'Router Brand',
    'Live Status',
    'OLD ATMID',

  );


  foreach ($headers as $index => $header) {
    $column = getColumnLabel($index);
    $sheet->setCellValue($column . '1', $header);
    $sheet->getStyle($column . '1')->applyFromArray($headerStyle);
}


  // Initialize the row counter
  $i = 2; // Start from row 2 for data
  $serial_number = 1; // Initialize the serial number




  // $objSheet->getStyle('Q')->getAlignment()->setWrapText(true);
  $sqry = mysqli_query($conn, $qry);
  $num = mysqli_num_rows($sqry);


  $count = 0;
  $srn = 1;
  $apptotamt = 0;
  $row = 2;
  while ($rowarr = mysqli_fetch_array($sqry)) {
    $sql1 = "select * from esurvsites where ATM_ID='" . $rowarr["ATMID"] . "'";

    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);
    //$qsales=mysql_query("select salesmanName from salesman_login where id='".$rowarr[13]."' ");
    //$qsalesdata=mysql_fetch_array($qsales);
    $id = $rowarr['SN'];
    $site_details = mysqli_query($conn, "select * from sites_details where site_id ='" . $id . "' and project='2'");
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


    $sheet->getStyle('A' . $i . ':AW' . $i)->applyFromArray([
      'borders' => [
          'allBorders' => [
              'borderStyle' => Border::BORDER_THIN,
              'color' => ['argb' => 'FF000000'], // Border color (black)
          ],
      ],
  ]);




    $sheet->setCellValue('A' . $i, $srn);
    $sheet->setCellValue('B' . $i, $rowarr['Customer']);
    $sheet->setCellValue('C' . $i, $rowarr['Bank']);
    $sheet->setCellValue('D' . $i, $rowarr['TrackerNo']);
    $sheet->setCellValue('E' . $i, $rowarr['ATMID']);
    $sheet->setCellValue('F' . $i, $rowarr['ATMID_2']);
    $sheet->setCellValue('G' . $i, $rowarr['ATMShortName']);
    $sheet->setCellValue('H' . $i, $rowarr['SiteAddress']);
    $sheet->setCellValue('I' . $i, $rowarr['City']);
    $sheet->setCellValue('J' . $i, $rowarr['State']);
    $sheet->setCellValue('K' . $i, $rowarr['Zone']);
    $sheet->setCellValue('L' . $i, $rowarr['PanelIP']);
    $sheet->setCellValue('M' . $i, $rowarr['DVRIP']);


    $sheet->setCellValue('N' . $i, $rowarr['DVRName']);
    $sheet->setCellValue('O' . $i, $rowarr['DVR_Model_num']);
    $sheet->setCellValue('P' . $i, $rowarr['DVR_Serial_num']);
    $sheet->setCellValue('Q' . $i, $rowarr['CTSLocalBranch']);
    $sheet->setCellValue('R' . $i, $rowarr['CTS_BM_Name']);
    $sheet->setCellValue('S' . $i, $rowarr['CTS_BM_Number']);
    $sheet->setCellValue('T' . $i, $rowarr['HDD']);
    $sheet->setCellValue('U' . $i, $rowarr['Camera1']);
    $sheet->setCellValue('V' . $i, $rowarr['Camera2']);
    $sheet->setCellValue('W' . $i, $rowarr['Camera3']);
    $sheet->setCellValue('X' . $i, $rowarr['Attachment1']);
    $sheet->setCellValue('Y' . $i, $rowarr['Attachment2']);
    $sheet->setCellValue('Z' . $i, $rowarr['liveDate']);
    $sheet->setCellValue('AA' . $i, $rowarr['site_remark']);
    $sheet->setCellValue('AB' . $i, $rowarr['UserName']);
    $sheet->setCellValue('AC' . $i, $rowarr['Password']);
    $sheet->setCellValue('AD' . $i, $router_id);

    $sheet->setCellValue('AE' . $i, getsiminfo($rowarr['ATMID'], 'simnnumber'));
    $sheet->setCellValue('AF' . $i, getsiminfo($rowarr['ATMID'], 'simowner'));

    $sheet->setCellValue('AG' . $i, $router_brand);
    $sheet->setCellValue('AH' . $i, $rowarr['live']);
    $sheet->setCellValue('AI' . $i, $rowarr['old_atmid']);

    $i++;
    $serial_number++;


    $row++;
    $srn++;
  }


  // Create a writer to save the Excel file
  $writer = new Xlsx($spreadsheet);

  // Save the Excel file to a temporary location
  $tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
  $writer->save($tempFile);

  // Provide the file as a download to the user
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="DVR SITES.xlsx"');
  header('Cache-Control: max-age  =0');
  readfile($tempFile);

  // Close the database connection
  mysqli_close($con);

  // Clean up and delete the temporary file
  unlink($tempFile);
} else if ($qrydata == "Cloud") {

  $objSheet->setCellValue('A1', 'Sr No');
  $objSheet->setCellValue('B1', 'Customer');
  $objSheet->setCellValue('C1', 'Bank');
  $objSheet->setCellValue('D1', 'Tracker No');
  $objSheet->setCellValue('E1', 'ATMID');
  $objSheet->setCellValue('F1', 'ATMID_2');
  $objSheet->setCellValue('G1', 'ATMShortName');
  $objSheet->setCellValue('H1', 'SiteAddress');
  $objSheet->setCellValue('I1', 'City');
  $objSheet->setCellValue('J1', 'State');
  $objSheet->setCellValue('K1', 'Zone');
  $objSheet->setCellValue('L1', 'PanelIP');
  $objSheet->setCellValue('M1', 'DVRIP');
  $objSheet->setCellValue('N1', 'DVRName');
  $objSheet->setCellValue('O1', 'DVR_Model_num');
  $objSheet->setCellValue('P1', 'DVR_Serial_num');
  $objSheet->setCellValue('Q1', 'CTSLocalBranch');
  $objSheet->setCellValue('R1', 'CTS_BM_Name');
  $objSheet->setCellValue('S1', 'CTS_BM_Number');
  $objSheet->setCellValue('T1', 'HDD');
  $objSheet->setCellValue('U1', 'Camera1');
  $objSheet->setCellValue('V1', 'Camera2');
  $objSheet->setCellValue('W1', 'Camera3');
  $objSheet->setCellValue('X1', 'Attachment1');
  $objSheet->setCellValue('Y1', 'Attachment2');
  $objSheet->setCellValue('Z1', 'LiveDate');
  $objSheet->setCellValue('AA1', 'Site Remark');
  $objSheet->setCellValue('AB1', 'User Name');
  $objSheet->setCellValue('AC1', 'Password');
  $objSheet->setCellValue('AD1', 'Router Id');
  $objSheet->setCellValue('AE1', 'SIM Number');
  $objSheet->setCellValue('AF1', 'SIM Owner');
  $objSheet->setCellValue('AG1', 'Router Brand');
  $objSheet->setCellValue('AH1', 'Tracker');
  $objSheet->setCellValue('AI1', 'BM Name');
  $objSheet->setCellValue('AJ1', 'Engineer Name');
  $objSheet->setCellValue('AK1', 'Status Date');

  $objSheet->setCellValue('AL1', 'OLD ATMID');
  $objSheet->setCellValue('AM1', 'Installation Date');
  $objSheet->setCellValue('AN1', 'Status');






  $objSheet->getStyle('Q')->getAlignment()->setWrapText(true);
  $sqry = mysqli_query($conn, $qry);
  $num = mysqli_num_rows($sqry);


  $count = 0;
  $srn = 1;
  $apptotamt = 0;
  $row = 2;
  while ($rowarr = mysqli_fetch_array($sqry)) {
    $sql1 = "select * from esurvsites where ATM_ID='" . $rowarr["ATMID"] . "'";

    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $id = $rowarr['id'];
    $site_details = mysqli_query($conn, "select * from sites_details where site_id ='" . $id . "' and project='3'");
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




    $dvronline_details = mysqli_query($conn, "select * from dvronline_details where dvrid='" . $id . "' order by id desc");
    $dvronline_details_result = mysqli_fetch_assoc($dvronline_details);

    $tracker = $dvronline_details_result['tracker'];
    $bmName = $dvronline_details_result['bmName'];
    $engineerName = $dvronline_details_result['engineerName'];
    $statusDate = $dvronline_details_result['statusDate'];




    $objSheet->setCellValueByColumnAndRow(0, $row, $srn);
    $objSheet->setCellValueByColumnAndRow(1, $row, $rowarr['customer']);
    $objSheet->setCellValueByColumnAndRow(2, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(3, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(4, $row, $rowarr['ATMID']);
    $objSheet->setCellValueByColumnAndRow(5, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(6, $row, $rowarr['Address']);
    $objSheet->setCellValueByColumnAndRow(7, $row, $rowarr['Location']);
    $objSheet->setCellValueByColumnAndRow(8, $row, $rowarr['city']);
    $objSheet->setCellValueByColumnAndRow(9, $row, $rowarr['State']);
    $objSheet->setCellValueByColumnAndRow(10, $row, $rowarr['zone']);
    $objSheet->setCellValueByColumnAndRow(11, $row, $rowarr['IPAddress']);

    $objSheet->setCellValueByColumnAndRow(12, $row, $rowarr['IPAddress']);
    $objSheet->setCellValueByColumnAndRow(13, $row, $rowarr['dvrname']);
    $objSheet->setCellValueByColumnAndRow(14, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(15, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(16, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(17, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(18, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(19, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(20, $row, "NA");

    $objSheet->setCellValueByColumnAndRow(21, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(22, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(23, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(24, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(25, $row, $rowarr['Live Date']);
    $objSheet->setCellValueByColumnAndRow(26, $row, "NA");
    $objSheet->setCellValueByColumnAndRow(27, $row, $rowarr['UserName']);
    $objSheet->setCellValueByColumnAndRow(28, $row, $rowarr['Password']);


    $objSheet->setCellValueByColumnAndRow(29, $row, $router_id);

    $objSheet->setCellValueByColumnAndRow(30, $row, getsiminfo($rowarr['ATMID'], 'simnnumber'));
    $objSheet->setCellValueByColumnAndRow(31, $row, getsiminfo($rowarr['ATMID'], 'simowner'));

    $objSheet->setCellValueByColumnAndRow(32, $row, $router_brand);


    $objSheet->setCellValueByColumnAndRow(33, $row, $tracker);
    $objSheet->setCellValueByColumnAndRow(34, $row, $bmName);
    $objSheet->setCellValueByColumnAndRow(35, $row, $engineerName);
    $objSheet->setCellValueByColumnAndRow(36, $row, $statusDate);

    $objSheet->setCellValueByColumnAndRow(37, $row, $rowarr['old_atm']);
    $objSheet->setCellValueByColumnAndRow(38, $row, $rowarr['installationDate']);
    $objSheet->setCellValueByColumnAndRow(39, $row, $rowarr['Status']);




    $row++;
    $srn++;
  }
}
