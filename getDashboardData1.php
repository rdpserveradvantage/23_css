<?php
include('config.php');

$data = array(); // Create an array to store the data


$grandtotalOpenAlerts = 0;
$grandtotalCloseAlerts = 0;
$grandtotalAlerts = 0;
$grandtoalCriticalOpen = 0;
$grandtotalCloseCriticalAlert = 0;
$grandtotalCritical = 0;

$date = date('Y-m-d');
$nextDay = date('Y-m-d', strtotime($date . ' +1 day'));


$Shift = $_REQUEST['shift'];

if ($Shift == "1") {
    $ShiftWise = " '$date 07:00:00' and '$date 14:59:59' ";
} else if ($Shift == "2") {
    $ShiftWise = " '$date 15:00:00' and '$date 22:59:59' ";
} else if ($Shift == "3") {
    $ShiftWise = " '$date 23:00:00' and '$nextDay 06:59:59' ";
}




$allCriticalAlerts = array(
    'Panic Button', 'ATM Hood door', 'ATM2 Chest Door', 'ATM1 and 2 Hood Door', 'Panic Switch',
    'ATM1 Chest Door Sensor', 'ATM 2 Chest Door Open', 'Unauthorize Card', 'ATM3 Chest Door Open', 'ATM2 Chest Door Open', 'ATM1 Chest Door Open',
    'ATM1 Chest door', 'ATM 2 Hood Door Sensor', 'ATM 1 Hood Door Sensor', 'ATM 1 Vibration'
);

$sql = mysqli_query($conn, "select * from alertscount where status=1");
while ($sqlResult = mysqli_fetch_assoc($sql)) {

    $terminal = $sqlResult['ip'];
    $userid = $sqlResult['userid'];

    $getuser = mysqli_query($conn, "select * from loginusers where id ='" . $userid . "'");
    $getuserResult = mysqli_fetch_assoc($getuser);
    $username = $getuserResult['name'];

    // echo "SELECT count(1) as openAlerts FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and 
    // sendip='" . $terminal . "' and receivedtime BETWEEN $ShiftWise " ; 

    $alertSql = mysqli_query($conn, "SELECT count(1) as openAlerts FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and 
    sendip='" . $terminal . "' and receivedtime BETWEEN $ShiftWise and critical_alerts='y'");
    $alertSqlResult = mysqli_fetch_assoc($alertSql);
    $openAlerts = $alertSqlResult['openAlerts'];

    $alertSql2 = mysqli_query($conn, "SELECT count(1) as openAlerts2 FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and 
    sip2='" . $terminal . "'   and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
    $alertSqlResult2 = mysqli_fetch_assoc($alertSql2);
    $openAlerts2 = $alertSqlResult2['openAlerts2'];

    $totalOpenAlerts = $openAlerts + $openAlerts2;

    // echo "SELECT count(1) as closeAlerts FROM `alerts` WHERE `status` LIKE 'C' and sendip='".$terminal."' and sendtoclient='S' and receivedtime BETWEEN $ShiftWise " ; 
    $alertSqlClose = mysqli_query($conn, "SELECT count(1) as closeAlerts FROM `alerts` WHERE `status` LIKE 'C' and sendip='" . $terminal . "' and sendtoclient='S' and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
    $alertSqlCloseResult = mysqli_fetch_assoc($alertSqlClose);
    $closeAlerts = $alertSqlCloseResult['closeAlerts'];

    $alertSqlClose2 = mysqli_query($conn, "SELECT count(1) as closeAlerts2 FROM `alerts` WHERE `status` LIKE 'C' and sip2='" . $terminal . "' and sendtoclient='S'   and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
    $alertSqlCloseResult2 = mysqli_fetch_assoc($alertSqlClose2);
    $closeAlerts2 = $alertSqlCloseResult2['closeAlerts2'];

    $totalCloseAlerts = $closeAlerts + $closeAlerts2;

    $totalAlerts = $totalOpenAlerts + $totalCloseAlerts;

    //$alertSqlcritical = mysqli_query($conn, "SELECT count(1) as criticalAlerts FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sendip='" . $terminal . "' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise ");
	$alertSqlcritical = mysqli_query($conn, "SELECT count(1) as criticalAlerts FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sendip='" . $terminal . "' and critical_alerts='y' and receivedtime BETWEEN $ShiftWise ");
    $alertSqlcriticalResult = mysqli_fetch_assoc($alertSqlcritical);
    $criticalAlerts = $alertSqlcriticalResult['criticalAlerts'];

    //$alertSqlcritical2 = mysqli_query($conn, "SELECT count(1) as criticalAlerts2 FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sip2='" . $terminal . "' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise ");
	$alertSqlcritical2 = mysqli_query($conn, "SELECT count(1) as criticalAlerts2 FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sip2='" . $terminal . "' and critical_alerts='y' and receivedtime BETWEEN $ShiftWise ");
    $alertSqlcriticalResult2 = mysqli_fetch_assoc($alertSqlcritical2);
    $criticalAlerts2 = $alertSqlcriticalResult2['criticalAlerts2'];

    $toalCriticalOpen = $criticalAlerts + $criticalAlerts2;

    //$alertSqlClosecritical = mysqli_query($conn, "SELECT count(1) as closeAlertsCritical FROM `alerts` WHERE `status` LIKE 'C' and sendip='" . $terminal . "' and sendtoclient='S' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise ");
	$alertSqlClosecritical = mysqli_query($conn, "SELECT count(1) as closeAlertsCritical FROM `alerts` WHERE `status` LIKE 'C' and sendip='" . $terminal . "' and sendtoclient='S' and critical_alerts='y' and receivedtime BETWEEN $ShiftWise ");
    $alertSqlClosecriticalResult = mysqli_fetch_assoc($alertSqlClosecritical);
    $closeAlertsCritical = $alertSqlClosecriticalResult['closeAlertsCritical'];

    //$alertSqlClosecritical2 = mysqli_query($conn, "SELECT count(1) as closeAlertsCritical2 FROM `alerts` WHERE `status` LIKE 'C' and sip2='" . $terminal . "' and sendtoclient='S'  and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise ");
	$alertSqlClosecritical2 = mysqli_query($conn, "SELECT count(1) as closeAlertsCritical2 FROM `alerts` WHERE `status` LIKE 'C' and sip2='" . $terminal . "' and sendtoclient='S'  and critical_alerts='y' and receivedtime BETWEEN $ShiftWise ");
    $alertSqlClosecriticalResult2 = mysqli_fetch_assoc($alertSqlClosecritical2);
    $closeAlertsCritical2 = $alertSqlClosecriticalResult2['closeAlertsCritical2'];

    $totalCloseCriticalAlert = $closeAlertsCritical + $closeAlertsCritical2;

    $totalCritical = $toalCriticalOpen + $totalCloseCriticalAlert;

    $row = array(
        'username' => ucwords($username),
        'terminal' => $terminal,
        'open' => $totalOpenAlerts,
        'close' => $totalCloseAlerts,
        'total' => $totalAlerts,
        'criticalopen' => $toalCriticalOpen,
        'criticalClose' => $totalCloseCriticalAlert,
        'totalCritical' => $totalCritical,
    );


    $grandtotalOpenAlerts = $grandtotalOpenAlerts + $totalOpenAlerts;
    $grandtotalCloseAlerts = $grandtotalCloseAlerts + $totalCloseAlerts;
    $grandtotalAlerts = $grandtotalAlerts + $totalAlerts;
    $grandtoalCriticalOpen = $grandtoalCriticalOpen + $toalCriticalOpen;
    $grandtotalCloseCriticalAlert = $grandtotalCloseCriticalAlert + $totalCloseCriticalAlert;
    $grandtotalCritical = $grandtotalCritical + $totalCritical;


    $data[] = $row;
}

$total = [
    'data' => $data,
    'grandtotalOpenAlerts' => $grandtotalOpenAlerts,
    'grandtotalCloseAlerts' => $grandtotalCloseAlerts,
    'grandtotalAlerts' => $grandtotalAlerts,
    'grandtoalCriticalOpen' => $grandtoalCriticalOpen,
    'grandtotalCloseCriticalAlert' => $grandtotalCloseCriticalAlert,
    'grandtotalCritical' => $grandtotalCritical
];

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($total);
