<?php
// Database connection parameters
include('./config.php');

$con= $conn;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


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
// SQL Query (You can replace this part with dynamic input)
$query = $_REQUEST['exportsql']; // Accepting SQL query from a GET request

// Sanitize the query (Optional but good practice to prevent SQL injection in production)
// $query = mysqli_real_escape_string($conn, $query);


$sql = mysqli_query($con,$query);
// Check if query execution is successful
if (mysqli_fetch_assoc($sql)) {
    // Open output stream to PHP output (this is the CSV file)
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export_rms_reports.csv"');

    $output = fopen('php://output', 'w');
    
    // Define the CSV column headers
    $headers = [
        'Sr No','Unique ID', 'Customer', 'Bank', 'Tracker No', 'Comfort ID', 'ATMID', 'OLD ATMID', 
        'ATMID_2', 'ATMID_3', 'ATMShortName', 'SiteAddress', 'City', 'State', 'Zone', 
        'CTS_LocalBranch', 'Panel_Make', 'OldPanelID', 'NewPanelID', 'PanelIP', 'DVRIP', 
        'DVRName', 'UserName', 'Password', 'Live', 'Live Date', 'Installation Engineer Name', 
        'CTS Engineer Name', 'CTS Engineer Number', 'CSSBM', 'CSSBMNumber', 'CSS BM Email', 
        'BackofficerName', 'BackofficerNumber', 'HeadSupervisorName', 'HeadSupervisorNumber', 
        'SupervisorName', 'Supervisornumber', 'RA Name', 'RA Number', 'Police Number', 
        'Police Station', 'Fire Station Name', 'Fire Station number', 'Atm Officer Name', 
        'Atm Officer Number', 'ATM Officer Email', 'Zonal Co-ordinator Name', 
        'Zonal Co-ordinator Number', 'Zonal Co-ordinator Email', 'Bank Officer Email ID', 
        'CO Owner Name', 'CO Owner Number', 'CO Owner Email ID', 'Zonal Name', 'Zonal Number', 
        'Zonal Email ID', 'Installation date', 'Site Add By', 'Site Edit By', 'GSM Number', 
        'DVR_Model_num', 'Router_Model_num', 'Remarks', 'Router Id', 'SIM Number', 'SIM Owner', 
        'Router Brand', 'Camera IP', 'Port', 'Ip Camera', 'Bank Officer Name', 'Bank Officer Number', 
        'panel_power_connection'
    ];
    
    // Write the headers to CSV
    fputcsv($output, $headers);

    // Fetch and process the results
    $srn = 1; // Initialize Sr No
    while ($rowarr = mysqli_fetch_array($sql)) {
        $array_row = [];

        // Fetch site details
        $id = $rowarr['SN'];
        $sql1 = "SELECT * FROM esurvsites WHERE ATM_ID='" . $rowarr["ATMID"] . "'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);

        // Fetch additional site details
        $site_details = mysqli_query($conn, "SELECT * FROM sites_details WHERE site_id ='" . $id . "' and project='1'");

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

        // Gather camera IP, port, and camera names
        $camera_ip = get_sites_info($rowarr["ATMID"], 'cam_ip');
        $port = get_sites_info($rowarr["ATMID"], 'port');
        $cam_name = get_sites_info($rowarr["ATMID"], 'cam_name');

        // Start populating the data array
        array_push($array_row, $srn++);
        array_push($array_row, $rowarr['unique_id']);
        array_push($array_row, $rowarr['Customer']);
        array_push($array_row, $rowarr['Bank']);
        array_push($array_row, remove_special($rowarr['TrackerNo']));
        
        $uniqueID = '';
        array_push($array_row, $uniqueID);

        array_push($array_row, $rowarr['ATMID']);
        array_push($array_row, $rowarr['old_atmid']);
        array_push($array_row, $rowarr['ATMID_2']);
        array_push($array_row, $rowarr['ATMID_3']);
        array_push($array_row, remove_special($rowarr['ATMShortName']));
        array_push($array_row, remove_special($rowarr['SiteAddress']));
        array_push($array_row, $rowarr['City']);
        array_push($array_row, $rowarr['State']);
        array_push($array_row, $rowarr['Zone']);
        array_push($array_row, remove_special($row1['CTS_LocalBranch']));
        array_push($array_row, $rowarr['Panel_Make']);
        array_push($array_row, $rowarr['OldPanelID']);
        array_push($array_row, $rowarr['NewPanelID']);
        array_push($array_row, $rowarr['PanelIP']);
        array_push($array_row, $rowarr['DVRIP']);
        array_push($array_row, $rowarr['DVRName']);
        array_push($array_row, $rowarr['UserName']);
        array_push($array_row, $rowarr['Password']);
        array_push($array_row, $rowarr['live']);
        array_push($array_row, $rowarr['live_date']);
        array_push($array_row, $rowarr['eng_name']);
        array_push($array_row, $row1['CTS_Engineer_Name']);
        array_push($array_row, $row1['CTS_Engineer_Number']);
        array_push($array_row, $row1['CSSBM']);
        array_push($array_row, $row1['CSSBMNumber']);
        array_push($array_row, $row1['CSSBM_Email']);
        array_push($array_row, $row1['BackofficerName']);
        array_push($array_row, $row1['BackofficerNumber']);
        array_push($array_row, $row1['HeadSupervisorName']);
        array_push($array_row, $row1['HeadSupervisorNumber']);
        array_push($array_row, $row1['SupervisorName']);
        array_push($array_row, remove_special($row1['Supervisornumber']));
        array_push($array_row, remove_special($row1['RA_QRT_NAME']));
        array_push($array_row, remove_special($row1['RA_QRT_NUMBER']));
        array_push($array_row, remove_special($row1['Policestation']));
        array_push($array_row, remove_special($row1['Polstnname']));
        array_push($array_row, remove_special($row1['firestation_name']));
        array_push($array_row, remove_special($row1['firestation_number']));
        array_push($array_row, remove_special($row1['atm_officer_name']));
        array_push($array_row, remove_special($row1['atm_officer_number']));
        array_push($array_row, $row1['atm_officer_email']);
        array_push($array_row, remove_special($row1['zonal_co_ordinator_name']));
        array_push($array_row, remove_special($row1['zonal_co_ordinator_number']));
        array_push($array_row, remove_special($row1['zonal_co_ordinator_email']));
        array_push($array_row, remove_special($row1['Bank_Officer_Email_ID']));
        array_push($array_row, remove_special($row1['CO_Owner_Name']));
        array_push($array_row, remove_special($row1['CO_Owner_Number']));
        array_push($array_row, remove_special($row1['CO_Owner_Email_ID']));
        array_push($array_row, remove_special($row1['Zonal_Name']));
        array_push($array_row, remove_special($row1['Zonal_Number']));
        array_push($array_row, $row1['Zonal_Email_ID']);
        array_push($array_row, $rowarr['current_dt']);
        array_push($array_row, remove_special($rowarr['addedby']));
        array_push($array_row, remove_special($rowarr['editby']));
        array_push($array_row, remove_special($rowarr['TwoWayNumber']));
        array_push($array_row, remove_special($rowarr['DVR_Model_num']));
        array_push($array_row, remove_special($rowarr['Router_Model_num']));
        array_push($array_row, remove_special($rowarr['site_remark']));
        array_push($array_row, $router_id);
        array_push($array_row, getsiminfo($rowarr['ATMID'], 'simnnumber'));
        array_push($array_row, getsiminfo($rowarr['ATMID'], 'simowner'));
        array_push($array_row, $router_brand);
        array_push($array_row, implode(",", $camera_ip));
        array_push($array_row, remove_special($port));
        array_push($array_row, remove_special($cam_name));
        array_push($array_row, remove_special($row1['bank_officer_name']));
        array_push($array_row, remove_special($row1['bank_officer_number']));
        array_push($array_row, remove_special($rowarr['panel_power_connection']));

        // Write the row to CSV
        fputcsv($output, $array_row);
    }

    fclose($output);
} else {
    echo "No data found for the query.";
}

// Close the connection
$conn->close();
?>
