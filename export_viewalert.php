<?php
include 'config.php';

$sql = $_REQUEST['exportsql'] ;
//$sql2 = $_REQUEST['exportsql2'];

//$main_sql = $sql ." UNION ALL ". $sql2 . " ORDER BY receivedtime ASC";

//$main_sql = $sql2 ." ORDER BY receivedtime ASC";

//var_dump($_REQUEST) ;

//return ; 

// Execute your SQL queries to fetch the data

$result = mysqli_query($conn, $sql);

// $result = mysqli_query($conn, $sql);
// $result_new = mysqli_query($conn, $sql2);

// Set the headers to trigger CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="exportalertReport.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Open the output stream to write to CSV
$output = fopen('php://output', 'w');

// Column headers for the CSV file
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
    "Testing Remark"
];

// Write the column headers to the CSV file
fputcsv($output, $headers);

// Loop through the first query result (exportsql) and fetch data
while ($row = mysqli_fetch_array($result)) {
    // Fetch additional data from the second table (Testing_alertDetails)
    $incident_query = mysqli_query($conn, "SELECT TestingByService, remark FROM Testing_alertDetails WHERE incident_id='" . $row["id"] . "' ");
    $incident_fetch = mysqli_fetch_array($incident_query);

    // Prepare the row data for the CSV
    $incident_date = date('d-F-Y', strtotime($row["receivedtime"]));


    $_panelMake = $row["Panel_make"];

    if ($row["Panel_make"] == "SMART -I") {
        $sql1 = "select SensorName as Description,Camera from smarti where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "SMART-IN") {
        $sql1 = "select SensorName as Description,Camera from smartinew where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "SEC") {
        $sql1 = "select sensorname as Description,camera from securico where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "sec_sbi") {
        $sql1 = "select SensorName as Description,Camera from sec_sbi where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "RASS") {
        $sql1 = "select SensorName as Description,Camera from rass where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "rass_cloud") {
        $sql1 = "select SensorName as Description,Camera from rass_cloud where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "rass_sbi") {
        $sql1 = "select SensorName as Description,Camera from rass_sbi where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    } else if ($row["Panel_make"] == "Raxx") {
        $sql1 = "select SensorsName as Description,Camera from raxx where ZoneNumber='" . $row["zone"] . "' ";
    } else if ($row["Panel_make"] == "securico_gx4816") {
        $sql1 = "select sensorname as Description,camera from securico_gx4816 where zone='" . $row["zone"] . "' ";
    } else if ($row["Panel_make"] == "smarti_hdfc32") {
        $sql1 = "select SensorName as Description,Camera from smarti_hdfc32 where zone='" . $row["zone"] . "' ";
    } else if ($row["Panel_make"] == "comfort_diebold") {
        $sql1 = "select SensorName as Description,Camera from comfort_diebold where zone='" . $row["zone"] . "' ";
    } else{
        $sql1 = "select SensorName as Description,Camera from ".$_panelMake." where (Zone='" . $row["zone"] . "' and SCODE='" . $row['alarm'] . "')";
    }


    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);


    if (endsWith($row["alarm"], "R"))
        $alarmmsg = $row1["Description"] . ' Restoral';
    else
        $alarmmsg = $row1["Description"];



    $rowData = [
        $row["Customer"],           // Client Name
        $row["id"],                 // Incident Number
        $row["zon"],                // Region
        $row["ATMID"],              // ATMID
        $row["SiteAddress"],        // Address
        $row["City"],               // City
        $row["State"],              // State
        $row["zone"],               // Zone
        $row["alarm"],              // Alarm
        $row1["Description"],
        $alarmmsg,              // Alarm Message


        $row["receivedtime"],       // Incident Date Time
        $row["receivedtime"],       // Alarm Received Date Time
        $incident_date,             // Close Date Time
        $row["DVRIP"],              // DVRIP
        $row["Panel_make"],         // Panel_make
        $row["panelid"],            // Panel ID
        $row["Bank"],               // Bank
        (endsWith($row["alarm"], "R")) ? 'Non-Reactive' : 'Reactive', // Reactive
        $row["closedBy"],           // Closed By
        $row["closedtime"],         // Closed Date
        $row["closedtime"] . '*' . $row["comment"] . '*' . $row["closedBy"], // Remark
        $row["sendip"],             // Send IP
        $incident_fetch["TestingByService"], // Testing By Service Team
        $incident_fetch["remark"],  // Testing Remark
    ];

    // Write this row of data to the CSV file
    fputcsv($output, $rowData);
}


// Close the output stream
fclose($output);

// Function to check if the string ends with a given substring (used for Reactive/Non-Reactive logic)
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
?>