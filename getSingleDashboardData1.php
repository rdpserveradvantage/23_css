<?php include('config.php');

$terminal = $_REQUEST['terminal'];
$status = $_REQUEST['status'];
$shift = $_REQUEST['shift'];


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

$allCriticalAlerts = array('ATM Removal','Hood Door Open Sensor','Chest Door Open Sensor',
'ATM Vibration','Panic Alert','Emergency Switch Panic Switch','Panic Button', 'ATM Hood door', 'ATM2 Chest Door', 'ATM1 and 2 Hood Door', 'Panic Switch',
    'ATM1 Chest Door Sensor', 'ATM 2 Chest Door Open', 'Unauthorize Card', 'ATM3 Chest Door Open', 'ATM2 Chest Door Open', 'ATM1 Chest Door Open',
    'ATM1 Chest door', 'ATM 2 Hood Door Sensor', 'ATM 1 Hood Door Sensor', 'ATM 1 Vibration'
);


?>


<table>
    <thead>
        <tr>
            <th>Sr no</th>
            <th>ATMID</th>
            <th>Panel ID</th>
            <th>Zone</th>
            <th>City</th>
            <th>Received At</th>
            <th>Alert Type</th>
            <th>Comment</th>
            <th>Close By</th>
            <th>Closed At</th>
        </tr>
    </thead>
    <tbody>




        <?php

        if ($status == 'open') {
            $alertSql = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sendip='" . $terminal . "' and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
            $alertSql2 = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sip2='" . $terminal . "' and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");

            $i = 1;
            while ($row = mysqli_fetch_assoc($alertSql)) {
                $panelid = $row['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row['receivedtime'] . '</td>';
                echo '<td>' . $row['alerttype'] . '</td>';
                echo '<td>' . $row['comment'] . '</td>';
                echo '<td>' . $row['closedBy'] . '</td>';
                echo '<td>' . $row['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
            while ($row2 = mysqli_fetch_assoc($alertSql2)) {
                $panelid = $row2['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);


                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row2['receivedtime'] . '</td>';
                echo '<td>' . $row2['alerttype'] . '</td>';
                echo '<td>' . $row2['comment'] . '</td>';
                echo '<td>' . $row2['closedBy'] . '</td>';
                echo '<td>' . $row2['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }



        ?>


        <?php

        } else if ($status == 'close') {

            $alertSqlClose = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'C' and sendip='" . $terminal . "' and sendtoclient='S' and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
            $alertSqlClose2 = mysqli_query($conn, "SELECT * from  `alerts` WHERE `status` LIKE 'C' and sip2='" . $terminal . "' and sendtoclient='S'   and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");


            $i = 1;
            while ($row = mysqli_fetch_assoc($alertSqlClose)) {
                $panelid = $row['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row['receivedtime'] . '</td>';
                echo '<td>' . $row['alerttype'] . '</td>';
                echo '<td>' . $row['comment'] . '</td>';
                echo '<td>' . $row['closedBy'] . '</td>';
                echo '<td>' . $row['closedtime'] . '</td>';
                echo '<tr>';
                
                $i++;
            }
            while ($row2 = mysqli_fetch_assoc($alertSqlClose2)) {
                $panelid = $row2['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);


                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row2['receivedtime'] . '</td>';
                echo '<td>' . $row2['alerttype'] . '</td>';
                echo '<td>' . $row2['comment'] . '</td>';
                echo '<td>' . $row2['closedBy'] . '</td>';
                echo '<td>' . $row2['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
        } else if ($status == 'total') {
            $alertSqlClose = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` in ('O','C') and sendip='" . $terminal . "' and sendtoclient='S' and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
            $alertSqlClose2 = mysqli_query($conn, "SELECT * from  `alerts` WHERE `status` in ('O','C') and sip2='" . $terminal . "' and sendtoclient='S'   and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");


            $i = 1;
            while ($row = mysqli_fetch_assoc($alertSqlClose)) {
                $panelid = $row['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row['receivedtime'] . '</td>';
                echo '<td>' . $row['alerttype'] . '</td>';
                echo '<td>' . $row['comment'] . '</td>';
                echo '<td>' . $row['closedBy'] . '</td>';
                echo '<td>' . $row['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
            while ($row2 = mysqli_fetch_assoc($alertSqlClose2)) {
                $panelid = $row2['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);


                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row2['receivedtime'] . '</td>';
                echo '<td>' . $row2['alerttype'] . '</td>';
                echo '<td>' . $row2['comment'] . '</td>';
                echo '<td>' . $row2['closedBy'] . '</td>';
                echo '<td>' . $row2['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
        } else if ($status == 'criticalopen') {
// echo "SELECT * FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sendip='" . $terminal . "' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'" ; 
            $alertSqlcritical = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sendip='" . $terminal . "' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
            $alertSqlcritical2 = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'O' and sendtoclient='S' and sip2='" . $terminal . "' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");

            $i = 1;
            while ($row = mysqli_fetch_assoc($alertSqlcritical)) {
                $panelid = $row['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row['receivedtime'] . '</td>';
                echo '<td>' . $row['alerttype'] . '</td>';
                echo '<td>' . $row['comment'] . '</td>';
                echo '<td>' . $row['closedBy'] . '</td>';
                echo '<td>' . $row['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
            while ($row2 = mysqli_fetch_assoc($alertSqlcritical2)) {
                $panelid = $row2['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);


                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row2['receivedtime'] . '</td>';
                echo '<td>' . $row2['alerttype'] . '</td>';
                echo '<td>' . $row2['comment'] . '</td>';
                echo '<td>' . $row2['closedBy'] . '</td>';
                echo '<td>' . $row2['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
        } else if ($status == 'criticalClose') {


            $alertSqlClosecritical = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'C' and sendip='" . $terminal . "' and sendtoclient='S' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
            $alertSqlClosecritical2 = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` LIKE 'C' and sip2='" . $terminal . "' and sendtoclient='S'  and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
        
            $i = 1;
            while ($row = mysqli_fetch_assoc($alertSqlClosecritical)) {
                $panelid = $row['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row['receivedtime'] . '</td>';
                echo '<td>' . $row['alerttype'] . '</td>';
                echo '<td>' . $row['comment'] . '</td>';
                echo '<td>' . $row['closedBy'] . '</td>';
                echo '<td>' . $row['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
            while ($row2 = mysqli_fetch_assoc($alertSqlClosecritical2)) {
                $panelid = $row2['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);


                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row2['receivedtime'] . '</td>';
                echo '<td>' . $row2['alerttype'] . '</td>';
                echo '<td>' . $row2['comment'] . '</td>';
                echo '<td>' . $row2['closedBy'] . '</td>';
                echo '<td>' . $row2['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }


        
        } else if ($status == 'totalCritical') {
        
            $alertSqlClosecritical = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` in('C','O') and sendip='" . $terminal . "' and sendtoclient='S' and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
            $alertSqlClosecritical2 = mysqli_query($conn, "SELECT * FROM `alerts` WHERE `status` in('C','O') and sip2='" . $terminal . "' and sendtoclient='S'  and alerttype IN ('" . implode("','", $allCriticalAlerts) . "')  and receivedtime BETWEEN $ShiftWise  and critical_alerts='y'");
        
            $i = 1;
            while ($row = mysqli_fetch_assoc($alertSqlClosecritical)) {
                $panelid = $row['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);

                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row['receivedtime'] . '</td>';
                echo '<td>' . $row['alerttype'] . '</td>';
                echo '<td>' . $row['comment'] . '</td>';
                echo '<td>' . $row['closedBy'] . '</td>';
                echo '<td>' . $row['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }
            while ($row2 = mysqli_fetch_assoc($alertSqlClosecritical2)) {
                $panelid = $row2['panelid'];
                $sitesql = mysqli_query($conn, "SELECT * FROM `sites` where OldPanelID='" . $panelid . "' or NewPanelID='" . $panelid . "'");
                $sitesqlResult = mysqli_fetch_assoc($sitesql);


                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $sitesqlResult['ATMID'] . '</td>';
                echo '<td>' . $panelid . '</td>';
                echo '<td>' . $sitesqlResult['Zone'] . '</td>';
                echo '<td>' . $sitesqlResult['City'] . '</td>';
                echo '<td>' . $row2['receivedtime'] . '</td>';
                echo '<td>' . $row2['alerttype'] . '</td>';
                echo '<td>' . $row2['comment'] . '</td>';
                echo '<td>' . $row2['closedBy'] . '</td>';
                echo '<td>' . $row2['closedtime'] . '</td>';
                echo '<tr>';
                $i++;
            }



        }



        ?>

    </tbody>
</table>