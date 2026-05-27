
<?php
ini_set('memory_limit', '1024M'); // Optional, just in case
set_time_limit(0); // Unlimited execution time

include 'db_connection.php';
$con = OpenCon();

date_default_timezone_set('Asia/Kolkata');
$yesterday = date('Y-m-d', strtotime("-1 days"));

// CSV file setup
$folder = 'exports/' . date('Y-m-d') . '/';
$filename = "alerts_view_monitoring_report_{$yesterday}.csv";
$fullPath = $folder . $filename;

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

// Open file for writing
$output = fopen($fullPath, 'w');

// CSV headers
$headers = [
    "Sr No",
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
    "Aging",
    "Remark",
    "Send Ip",
];
fputcsv($output, $headers);

// --- Preload panel descriptions once to avoid repeated queries ---
$panelTables = [
    "SMART -I" => "smarti",
    "SMART-IN" => "smartinew",
    "smarti_boi" => "smarti_boi",
    "smarti_hdfc32" => "smarti_hdfc32",
    "smarti_hdfc" => "smarti_hdfc32",
    "smarti_pnb" => "smarti_jupiter",
    "smarti_jupiter" => "smarti_jupiter",
    "SEC" => "securico",
    "sec_sbi" => "sec_sbi",
    "RASS" => "rass",
    "rass_cloud" => "rass_cloud",
    "rass_sbi" => "rass_sbi",
    "rass_boi" => "rass_boi",
    "rass_pnb" => "rass_pnb",
    "securico_gx4816" => "securico_gx4816",
    "comfort" => "comfort",
    "comfort_diebold" => "comfort_diebold",
    "comfort_axis" => "comfort_axis",
    "comfort_hdfc" => "comfort_hdfc",
    "comfort_jupiter" => "comfort_jupiter",
    "comfort_sbitom2" => "comfort_sbitom2",
];

$panelDescriptions = [];
foreach ($panelTables as $panelName => $tableName) {
    $sql = "SELECT Zone, SCODE, SensorName, Camera FROM $tableName";
    $res = mysqli_query($con, $sql);
    while ($r = mysqli_fetch_assoc($res)) {
        $panelDescriptions[$panelName][$r['Zone'] . '_' . $r['SCODE']] = $r;
    }
}

// --- Main SQL query ---
$main_sql = "
SELECT *
FROM (
    SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
           a.Panel_make, a.zone AS zon, a.City, a.State,
           b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
           b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2,
           t.TestingByService, t.remark AS testing_remark
    FROM alerts_backup b
    JOIN sites a ON a.OldPanelID = b.panelid
    LEFT JOIN Testing_alertDetails t ON t.incident_id = b.id
    WHERE b.receivedtime BETWEEN '" . $yesterday . " 00:00:00' AND '" . $yesterday . " 23:59:59'
    and b.sendtoclient='S'
    UNION ALL

    SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
           a.Panel_make, a.zone AS zon, a.City, a.State,
           b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
           b.zone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2,
           t.TestingByService, t.remark AS testing_remark
    FROM alerts_backup b
    JOIN sites a ON a.NewPanelID = b.panelid
    LEFT JOIN Testing_alertDetails t ON t.incident_id = b.id
    WHERE b.receivedtime BETWEEN '" . $yesterday . " 00:00:00' AND '" . $yesterday . " 23:59:59'
    and b.sendtoclient='S'

) AS combined_all
ORDER BY receivedtime ASC
";

// Stream the main query row by row
//$result = mysqli_query($con, $main_sql, MYSQLI_USE_RESULT);

$result = mysqli_query($con, $main_sql);

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    return ($length === 0) || (substr($haystack, -$length) === $needle);
}
$srn = 1;

while ($row = mysqli_fetch_assoc($result)) {
    $TestingByService = '';
    $testing_remark = '';
    $incident_id = $row["id"];
    $incident_query = mysqli_query($con, "SELECT * FROM testing_alertdetails WHERE incident_id='" . $incident_id . "' ");
    if (mysqli_num_rows($incident_query) > 0) {
        $incident_fetch = mysqli_fetch_array($incident_query);
        $TestingByService = $incident_fetch['TestingByService'];
        $testing_remark = $incident_fetch['remark'];
    }
    $_panelMake = $row["Panel_make"];
    $key = $row["zone"] . '_' . $row["alarm"];
    $descRow = $panelDescriptions[$_panelMake][$key] ?? ['SensorName' => '', 'Camera' => ''];

    $alarmmsg = endsWith($row["alarm"], "R") ? $descRow["SensorName"] . ' Restoral' : $descRow["SensorName"];
    $reactive = endsWith($row["alarm"], "R") ? 'Non-Reactive' : 'Reactive';
    $incident_date = date('d-F-Y', strtotime($row["receivedtime"]));

    $_comment = htmlspecialchars($row["comment"]);

    if ($row["closedtime"]) {
        $closed = new DateTime($row["closedtime"]);
        $received = new DateTime($row["receivedtime"]);
        $interval = $received->diff($closed); // difference = closed - received

        // Convert the interval to total seconds, then format it
        $seconds = ($interval->days * 24 * 60 * 60) +
        ($interval->h * 60 * 60) +
        ($interval->i * 60) +
        $interval->s;

        // Calculate hours, minutes, and seconds
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        $aging = $hours . 'h ' . $minutes . 'm ' . $seconds . 's';

    } else { $aging = '-';}

    $rowData = [
        $srn,
        $row["Customer"],
        $row["id"],
        $row["zon"],
        $row["ATMID"],
        $row["SiteAddress"],
        $row["City"],
        $row["State"],
        $row["zone"],
        $row["alarm"],
        $descRow["SensorName"],
        $alarmmsg,
        $row["createtime"],
        $row["receivedtime"],
        $incident_date,
        $row["DVRIP"],
        $_panelMake,
        $row["panelid"],
        $row["Bank"],
        $reactive,
        $row["closedBy"],
        $row["closedtime"],
        $aging,
        $_comment,
        $row["sendip"],
    ];

    fputcsv($output, $rowData);
    $srn++;
}

// Close resources
mysqli_free_result($result);
fclose($output);
CloseCon($con);

echo "CSV export completed: $fullPath";
?>
