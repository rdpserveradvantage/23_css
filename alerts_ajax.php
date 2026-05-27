<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "esurv");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// DataTables server-side parameters
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$length = isset($_GET['length']) ? intval($_GET['length']) : 25;

// Filters
$atmid = isset($_GET['atmid']) ? $_GET['atmid'] : '';
$panelid = isset($_GET['panelid']) ? $_GET['panelid'] : '';
$dvrip = isset($_GET['dvrip']) ? $_GET['dvrip'] : '';
$fromdate = isset($_GET['fromdate']) ? $_GET['fromdate'] : date('Y-m-d');
$todate = isset($_GET['todate']) ? $_GET['todate'] : date('Y-m-d');

// WHERE clause
$where = array();
if ($atmid !== '') $where[] = "a.ATMID = '" . mysqli_real_escape_string($conn, $atmid) . "'";
if ($panelid !== '') $where[] = "(a.OldPanelID = '" . mysqli_real_escape_string($conn, $panelid) . "' OR a.NewPanelID = '" . mysqli_real_escape_string($conn, $panelid) . "')";
if ($dvrip !== '') $where[] = "a.DVRIP = '" . mysqli_real_escape_string($conn, $dvrip) . "'";
if ($fromdate !== '' && $todate !== '') $where[] = "b.receivedtime BETWEEN '" . mysqli_real_escape_string($conn, $fromdate . " 00:00:00") . "' AND '" . mysqli_real_escape_string($conn, $todate . " 23:59:59") . "'";
$where_sql = '';
if (!empty($where)) $where_sql = 'WHERE ' . implode(' AND ', $where);

// Total records before filtering
$totalQuery = "
SELECT COUNT(*) as total
FROM sites a
JOIN alerts_backup b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
$where_sql
UNION ALL
SELECT COUNT(*)
FROM sites a
JOIN backalerts_backup b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
$where_sql
";
$totalResult = mysqli_query($conn, $totalQuery);
$total = 0;
while($row = mysqli_fetch_assoc($totalResult)) {
    $total += $row['total'];
}

// Main data query with limit for pagination
$dataQuery = "
SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
       a.Panel_make, a.zone AS zon, a.City, a.State,
       b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
       b.zone AS alarmzone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
FROM sites a
JOIN alerts_backup b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
$where_sql
UNION ALL
SELECT a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress, a.DVRIP,
       a.Panel_make, a.zone AS zon, a.City, a.State,
       b.id, b.panelid, b.createtime, b.receivedtime, b.comment,
       b.zone AS alarmzone, b.alarm, b.closedBy, b.closedtime, b.sendip, b.sip2
FROM sites a
JOIN backalerts_backup b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
$where_sql
ORDER BY receivedtime ASC
LIMIT $start, $length
";

$result = mysqli_query($conn, $dataQuery);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array_values($row); // DataTables expects numeric array
}

// Output JSON
echo json_encode([
    "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
    "recordsTotal" => $total,
    "recordsFiltered" => $total,
    "data" => $data
]);

mysqli_close($conn);
?>
