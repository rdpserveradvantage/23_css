<?php
ini_set('max_execution_time', 300);
include 'db_connection.php';
$con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$created_at = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$yesterday = date('Y-m-d', strtotime("-1 days"));
$lastmonth = date('Y-m-d', strtotime("-30 days"));

$split_created_at = explode(' ', $created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];

$folder = 'exports/' . $date . '/';
$filename = "all_alertview_report_{$yesterday}.xlsx";
$fullPath = $folder . $filename;

if (!file_exists($folder)) {
    mkdir($folder, 0777, true); // Create with full permissions
}

// Open file for writing
$output = fopen($fullPath, 'w');

function lastcommunicationdiff($datetime1, $datetime2)
{
    $datetime2 = new DateTime($datetime2);
    $interval = $datetime1->diff($datetime2);

    $elapsedyear = $interval->format('%y');
    $elapsedmon = $interval->format('%m');
    $elapsed_day = $interval->format('%a');
    $elapsedhr = $interval->format('%h');
    $elapsedmin = $interval->format('%i');
    $not = 0;
    if ($elapsedyear > 0) {$not = $not + 1;}
    if ($elapsedmon > 0) {$not = $not + 1;}
    if ($elapsed_day > 0) {$not = $not + 1;}
    //if($elapsedhr>0){$not=$not+1;}
    $min = $elapsedmin;
    $hour = $elapsedhr;
    if ($not > 0) {
        $return = 0;
    } else {
        if ($hour <= 24) {
            $return = 1;
        } else {
            $return = 0;
        }
    }

    return $return;
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 ||
        (substr($haystack, -$length) === $needle);
}

//  Lobby //

// $abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts_backup` b WHERE a.OldPanelID=b.panelid and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='smartinew')) or (b.zone='022' and (a.Panel_make='smart -i' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816')  ";
// $abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts_backup` b WHERE a.NewPanelID=b.panelid and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='smartinew')) or (b.zone='022' and (a.Panel_make='smart -i' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";

// $abcp = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts_backup` b WHERE a.NewPanelID=b.panelid and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='smartinew')) or (b.zone='022' and (a.Panel_make='smart -i' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";
// $abc_newp = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts_backup` b WHERE a.NewPanelID=b.panelid and (b.zone='024' and (a.Panel_make='RASS' or a.Panel_make='smartinew')) or (b.zone='022' and (a.Panel_make='smart -i' or a.Panel_make='SEC')) or ((b.zone='032' or b.zone='033') and a.Panel_make='securico_gx4816') ";

// Lobby

$abc = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts_backup` b WHERE a.OldPanelID=b.panelid AND CAST(b.receivedtime AS DATE) = '" . $yesterday . "'";
$abc_new = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts_backup` b WHERE a.OldPanelID=b.panelid AND CAST(b.receivedtime AS DATE) = '" . $yesterday . "'";

$abcp = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`alerts_backup` b WHERE a.NewPanelID=b.panelid AND CAST(b.receivedtime AS DATE) = '" . $yesterday . "'";
$abc_newp = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2 FROM sites a,`backalerts_backup` b WHERE a.NewPanelID=b.panelid AND CAST(b.receivedtime AS DATE) = '" . $yesterday . "'";

$sr = 1;

/*
$_selectfield = "a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2";

(
SELECT $_selectfield
FROM sites a
JOIN alerts_backup b ON a.OldPanelID = b.panelid
WHERE b.receivedtime BETWEEN '2025-10-29 00:00:00' AND '2025-10-29 23:59:59'
)
UNION ALL
(
SELECT a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip,b.sip2
FROM sites a
JOIN alerts_backup b ON a.NewPanelID = b.panelid
WHERE b.receivedtime BETWEEN '2025-10-29 00:00:00' AND '2025-10-29 23:59:59'
)
ORDER BY receivedtime DESC
LIMIT 1000;

 */

$main_qry = "(" . $abc . ") UNION ALL (" . $abcp . ") ORDER BY receivedtime DESC LIMIT 1000";
$main_qry_excel = "(" . $abc . ") UNION ALL (" . $abcp . ") ORDER BY receivedtime DESC";

$main_qryp = "(" . $abc_new . ") UNION ALL (" . $abc_newp . ") ORDER BY receivedtime DESC LIMIT 1000";
$main_qryp_excel = "(" . $abc_new . ") UNION ALL (" . $abc_newp . ") ORDER BY receivedtime DESC";

$result = mysqli_query($con, $main_qry_excel);
//$result = mysqli_query($conn, $abc);

$Num_Rows = mysqli_num_rows($result);

$result_new = mysqli_query($con, $main_qryp_excel);

//$result_new = mysqli_query($conn, $abc_new);

$Num_Rows_new = mysqli_num_rows($result_new);

$Num_Rows = $Num_Rows + $Num_Rows_new;

$headers = [
    "Client Name",
    "Incident Number",
    "Region",
    "ATMID",
    "Address",
    "City",
    "State",
    "Zone",
    "Alarm",
    "Incident Category",
    "Alarm Message",
    "Incident Date Time",
    "Alarm Received Date Time",
    "Close Date Time",
    "DVRIP",
    "Panel_make",
    "Panel ID",
    "Bank",
    "Reactive",
    "Closed By",
    "Closed Date",
    "Remark",
    "Send Ip",
    "Testing By Service Team",
    "Testing Remark",
];

// Write the column headers to the CSV file
fputcsv($output, $headers);

// Loop through the first query result (exportsql) and fetch data
while ($row = mysqli_fetch_array($result)) {
    // Fetch additional data from the second table (Testing_alertDetails)
    $incident_query = mysqli_query($con, "SELECT TestingByService, remark FROM Testing_alertDetails WHERE incident_id='" . $row["id"] . "' ");
    $incident_fetch = mysqli_fetch_array($incident_query);

    // Prepare the row data for the CSV
    $incident_date = date('d-F-Y', strtotime($row["receivedtime"]));

    $_panelMake = $row["Panel_make"];
    $_alertZone = $row["zone"];
    $_alertAlarm = $row['alarm'];

     if ($row["Panel_make"] == "SMART -I") {
        $sql1 = "select SensorName as Description,Camera from smarti where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "SMART-IN") {
        $sql1 = "select SensorName as Description,Camera from smartinew where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "SEC") {
        $sql1 = "select sensorname as Description,camera from securico where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "sec_sbi") {
        $sql1 = "select SensorName as Description,Camera from sec_sbi where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "RASS") {
        $sql1 = "select SensorName as Description,Camera from rass where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "rass_cloud") {
        $sql1 = "select SensorName as Description,Camera from rass_cloud where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "rass_sbi") {
        $sql1 = "select SensorName as Description,Camera from rass_sbi where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "Raxx") {
        $sql1 = "select SensorsName as Description,Camera from raxx where ZoneNumber='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "securico_gx4816") {
        $sql1 = "select sensorname as Description,camera from securico_gx4816 where zone='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "smarti_hdfc32") {
        $sql1 = "select SensorName as Description,Camera from smarti_hdfc32 where zone='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "comfort_diebold") {
        $sql1 = "select SensorName as Description,Camera from comfort_diebold where ZONE='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "smarti_hdfc") {
        $sql1 = "select sensorname as Description,camera from smarti_hdfc32 where  Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "' ";
    } else {
      //  $sql1 = "select SensorName as Description,Camera from " . $_panelMake . " where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "' ";
        $sql1 = "select SensorName as Description,Camera from " . $_panelMake . " where Zone='" . $_alertZone . "' ";
    }

    $result1 = mysqli_query($con, $sql1);

    $alarmmsg = "";
    $panel_desc = "";

    $row1 = mysqli_fetch_array($result1);

    if (endsWith($row["alarm"], "R")) {
       if(isset($row1["Description"])){
          $alarmmsg = $row1["Description"] . ' Restoral';
          $panel_desc = $row1["Description"];
       }


    } else {
       if(isset($row1["Description"])){
          $alarmmsg = $row1["Description"];
          $panel_desc = $row1["Description"];
        }
    }
    $_TestingByService = "";$_TestingRemark = "";
    if(isset($incident_fetch["TestingByService"])){
       $_TestingByService = $incident_fetch["TestingByService"];
    }

    if(isset($incident_fetch["remark"])){
       $_TestingRemark = $incident_fetch["remark"];
    }


    $rowData = [
        $row["Customer"], // Client Name
        $row["id"], // Incident Number
        $row["zon"], // Region
        $row["ATMID"], // ATMID
        $row["SiteAddress"], // Address
        $row["City"], // City
        $row["State"], // State
        $row["zone"], // Zone
        $row["alarm"], // Alarm
        $panel_desc,
        $alarmmsg, // Alarm Message

        $row["receivedtime"], // Incident Date Time
        $row["receivedtime"], // Alarm Received Date Time
        $incident_date, // Close Date Time
        $row["DVRIP"], // DVRIP
        $row["Panel_make"], // Panel_make
        $row["panelid"], // Panel ID
        $row["Bank"], // Bank
        (endsWith($row["alarm"], "R")) ? 'Non-Reactive' : 'Reactive', // Reactive
        $row["closedBy"], // Closed By
        $row["closedtime"], // Closed Date
        $row["closedtime"] . '*' . $row["comment"] . '*' . $row["closedBy"], // Remark
        $row["sendip"], // Send IP
        $_TestingByService, // Testing By Service Team
        $_TestingRemark, // Testing Remark
    ];

    // Write this row of data to the CSV file
    fputcsv($output, $rowData);
}

// Loop through the second query result (exportsql2) and fetch data
while ($row_new = mysqli_fetch_array($result_new)) {
    // Fetch additional data from the second table (Testing_alertDetails)
    $incident_query = mysqli_query($con, "SELECT TestingByService, remark FROM Testing_alertDetails WHERE incident_id='" . $row_new["id"] . "' ");
    $incident_fetch = mysqli_fetch_array($incident_query);

    // Prepare the row data for the CSV
    $incident_date = date('d-F-Y', strtotime($row_new["receivedtime"]));

    $_panelMake = $row_new["Panel_make"];

    $_alertZone = $row["zone"];
    $_alertAlarm = $row['alarm'];

    if ($row["Panel_make"] == "SMART -I") {
        $sql1 = "select SensorName as Description,Camera from smarti where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "SMART-IN") {
        $sql1 = "select SensorName as Description,Camera from smartinew where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "SEC") {
        $sql1 = "select sensorname as Description,camera from securico where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "sec_sbi") {
        $sql1 = "select SensorName as Description,Camera from sec_sbi where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "RASS") {
        $sql1 = "select SensorName as Description,Camera from rass where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "rass_cloud") {
        $sql1 = "select SensorName as Description,Camera from rass_cloud where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "rass_sbi") {
        $sql1 = "select SensorName as Description,Camera from rass_sbi where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "'";
    } else if ($row["Panel_make"] == "Raxx") {
        $sql1 = "select SensorsName as Description,Camera from raxx where ZoneNumber='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "securico_gx4816") {
        $sql1 = "select sensorname as Description,camera from securico_gx4816 where zone='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "smarti_hdfc32") {
        $sql1 = "select SensorName as Description,Camera from smarti_hdfc32 where zone='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "comfort_diebold") {
        $sql1 = "select SensorName as Description,Camera from comfort_diebold where ZONE='" . $_alertZone . "' ";
    } else if ($row["Panel_make"] == "smarti_hdfc") {
        $sql1 = "select sensorname as Description,camera from smarti_hdfc32 where  Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "' ";
    } else {
        $sql1 = "select SensorName as Description,Camera from " . $_panelMake . " where Zone='" . $_alertZone . "' and SCODE='" . $_alertAlarm . "' ";
    }

    $result1 = mysqli_query($con, $sql1);

    $alarmmsg = "";
    $panel_desc = "";

    $row1 = mysqli_fetch_array($result1);

    if (endsWith($row["alarm"], "R")) {
       if(isset($row1["Description"])){
          $alarmmsg = $row1["Description"] . ' Restoral';
          $panel_desc = $row1["Description"];
       }


    } else {
       if(isset($row1["Description"])){
          $alarmmsg = $row1["Description"];
          $panel_desc = $row1["Description"];
        }
    }

     $_TestingByService = "";$_TestingRemark = "";
    if(isset($incident_fetch["TestingByService"])){
       $_TestingByService = $incident_fetch["TestingByService"];
    }

    if(isset($incident_fetch["remark"])){
       $_TestingRemark = $incident_fetch["remark"];
    }



    $rowData = [
        $row_new["Customer"], // Client Name
        $row_new["id"], // Incident Number
        $row_new["zon"], // Region
        $row_new["ATMID"], // ATMID
        $row_new["SiteAddress"], // Address
        $row_new["City"], // City
        $row_new["State"], // State
        $row_new["zone"], // Zone
        $row_new["alarm"], // Alarm

        $panel_desc,
        $alarmmsg, // Alarm Message

        $row_new["receivedtime"], // Incident Date Time
        $row_new["receivedtime"], // Alarm Received Date Time
        $incident_date, // Close Date Time
        $row_new["DVRIP"], // DVRIP
        $row_new["Panel_make"], // Panel_make
        $row_new["panelid"], // Panel ID
        $row_new["Bank"], // Bank
        (endsWith($row_new["alarm"], "R")) ? 'Non-Reactive' : 'Reactive', // Reactive
        $row_new["closedBy"], // Closed By
        $row_new["closedtime"], // Closed Date
        $row_new["closedtime"] . '*' . $row_new["comment"] . '*' . $row_new["closedBy"], // Remark
        $row_new["sendip"], // Send IP
        $_TestingByService, // Testing By Service Team
        $_TestingRemark, // Testing Remark
    ];

    // Write this row of data to the CSV file
    fputcsv($output, $rowData);
}

fclose($output);

CloseCon($con);

echo "Excel file saved as: $fullPath";
