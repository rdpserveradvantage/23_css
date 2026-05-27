<?php
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);

ini_set('max_execution_time', -1); 
$conn = new mysqli("localhost", "root", "", "esurv");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pattern = '/#(?P<panel_id>\d+)\[#\d+\|(?P<zone_full>[A-Z]+)(?P<zone>\d+)\]_(?P<time>\d{2}:\d{2}:\d{2}),(?P<date>\d{2}-\d{2}-\d{4})/';

$sql = mysqli_query($conn, "SELECT wdata,rtime FROM data_wsites");

$ip_array = [
    '192.168.100.69',
    '192.168.100.73',
    '192.168.100.74',
    '192.168.100.75',
    '192.168.100.76',
    '192.168.100.77',
    '192.168.100.78',
    '192.168.100.79',
    '192.168.100.80',
    '192.168.100.81'
];
$i = 1;
while ($row = mysqli_fetch_assoc($sql)) {

    $string = $row['wdata'];

    if (preg_match($pattern, $string, $matches)) {

        $panel_id = $matches['panel_id'];

        $panel_make_sql = mysqli_query($conn, "SELECT Panel_Make FROM sites WHERE NewPanelID = '$panel_id' LIMIT 1");
        $panel_make_row = mysqli_fetch_assoc($panel_make_sql);
        $panel_make = $panel_make_row ? $panel_make_row['Panel_Make'] : 'Unknown';

        $full_zone_string = $matches['zone_full'] . $matches['zone'];
        $alarm = substr($matches['zone_full'], -2);
        $zone = $matches['zone'];

        $datetime = DateTime::createFromFormat(
            'd-m-Y H:i:s',
            $matches['date'] . ' ' . $matches['time']
        );

        $created_at = $datetime ? $datetime->format('Y-m-d H:i:s') : '';

        // sensor name mapping
        $sensor_sql = mysqli_query($conn, "select * from $panel_make where zone='$zone' LIMIT 1");
        $sensor_row = mysqli_fetch_assoc($sensor_sql);
        $sensor = $sensor_row['SensorName'];

        if ($sensor_row['PRIORITY'] == 'Y') {
            // $sensor = 'Unknown';
            $sendtoclient = 'S';
        } else {
            $sensor = $sensor_row['SensorName'];
            $sendtoclient = NULL;
        }



        $sendtoclient_final = substr($alarm, -1) == 'R' ? '' : $sendtoclient;
        $sendip = $ip_array[array_rand($ip_array)];
        $seqno = rand(1000, 9999);
        $insert_sql = "insert into alerts_20260107(panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus,level,sip2,c_status,auto_alert,critical_alerts,Readstatus,synced_at,sync_batch_id) 
                    
                    VALUES ('$panel_id',
 '$seqno',
 '$zone',
 '$alarm',
 '$created_at',
 '$row[rtime]',
 '',
 'O',
 '$sendtoclient_final',
 '',
 NULL,
 '$sendip',
 '$sensor',
 '',
 '',
 '',
 '1',
 '',
 '',
 '0',
 '',
 '0',
 null,
 null)";



 mysqli_query($conn, $insert_sql);
        



    }
}
?>