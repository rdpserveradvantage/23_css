<?php
include '../config.php';
$con = $conn;

// Set PHP configuration for error reporting (useful for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set unlimited memory
ini_set('memory_limit', '-1');  // Unlimited memory

// Set unlimited execution time
ini_set('max_execution_time', 0); // No time limit for execution

// Query to get the table name
$getsql = mysqli_query($con, "SELECT id, alerts_data_date, newtableName 
FROM alerts_data_tracker_datewise
WHERE is_viewalertReportCreated = 0 ORDER BY id DESC LIMIT 5");

while ($getsql_result = mysqli_fetch_assoc($getsql)) {
    // Get the table name from the query result
    $newtableName = $getsql_result['newtableName'];
    $alerts_data_date = $getsql_result['alerts_data_date'];

    $createtablestatement = "CREATE TABLE alert_data_$newtableName (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Client_name VARCHAR(255),
        Incident_number VARCHAR(30),
        Region VARCHAR(10),
        ATMID VARCHAR(40),
        SiteAddress TEXT,
        City VARCHAR(40),
        State VARCHAR(40),
        Zone VARCHAR(40),
        alarm VARCHAR(40),
        Incident_category VARCHAR(200),
        Alram_message VARCHAR(200),
        createtime DATETIME,
        receivedtime DATETIME,
        closeDateTime VARCHAR(40),
        DVRIP VARCHAR(40),
        Panel_make VARCHAR(40),
        panelid VARCHAR(40),
        bank VARCHAR(40),
        Reactive VARCHAR(40),
        Closed_By VARCHAR(40),
        Closed_Date VARCHAR(40),
        Remark TEXT,
        sendip VARCHAR(40),
        TestingByServiceTeam TEXT,
        Testing_remark TEXT
    )";

mysqli_query($con,$createtablestatement);


// echo $insertstatement = "

// INSERT INTO
//     alert_data_$newtableName (
//         Client_name,
//         Incident_number,
//         Region,
//         ATMID,
//         SiteAddress,
//         City,
//         State,
//         Zone,
//         alarm,
//         Incident_category,
//         Alram_message,
//         createtime,
//         receivedtime,
//         closeDateTime,
//         DVRIP,
//         Panel_make,
//         panelid,
//         bank,
//         Reactive,
//         Closed_By,
//         Closed_Date,
//         Remark,
//         sendip,
//         TestingByServiceTeam,
//         Testing_remark
//     )
// SELECT
//     a.Customer,
//     b.id,
//     COALESCE(
//         s1.Zone,s2.Zone,s3.Zone,s4.Zone,s5.Zone,s6.Zone,s7.Zone,s8.Zone,s9.Zone,s10.Zone,s11.Zone,s12.Zone,s13.Zone,s14.Zone,s15.Zone,s16.Zone
//     ) AS Region,
//     a.ATMID,
//     a.SiteAddress,
//     a.City,
//     a.State,
//     a.zone,
//     b.alarm,
//     COALESCE(
//         s1.SensorName,s2.SensorName,s3.SensorName,s4.SensorName,s5.SensorName,s6.SensorName,s7.SensorName,s8.SensorName,s9.SensorName,s10.SensorName,s11.SensorName,s12.SensorName,s13.SensorName,s14.SensorName,s15.SensorName,s16.SensorName
//     ) AS Incident_category,
//     CASE WHEN RIGHT(b.alarm, 1) = 'R' THEN 
// CONCAT(COALESCE(
//         s1.SensorName,s2.SensorName,s3.SensorName,s4.SensorName,s5.SensorName,s6.SensorName,s7.SensorName,s8.SensorName,s9.SensorName,s10.SensorName,s11.SensorName,s12.SensorName,s13.SensorName,s14.SensorName,s15.SensorName,s16.SensorName),' ', 'Restoral')
//          ELSE COALESCE(
//         s1.SensorName,s2.SensorName,s3.SensorName,s4.SensorName,s5.SensorName,s6.SensorName,s7.SensorName,s8.SensorName,s9.SensorName,s10.SensorName,s11.SensorName,s12.SensorName,s13.SensorName,s14.SensorName,s15.SensorName,s16.SensorName)
//          END AS Alram_message,
//     b.createtime,
//     b.receivedtime,
//     DATE (b.receivedtime),
//     a.DVRIP,
//     a.Panel_make,
//     b.panelid,
//     a.Bank,
//     CASE WHEN RIGHT(b.alarm, 1) = 'R' THEN 'Non-Reactive' ELSE 'Reactive' END AS alarm_status,
    
//     b.closedBy,
//     b.closedtime,
//     CONCAT (b.closedtime, '*', b.comment, '*', b.closedBy) AS concatenated_column,
//     b.sendip,
//     t.TestingByService,
//     t.remark
// FROM

//         sites a
//     JOIN 
//     $newtableName b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
//     LEFT JOIN 
//         smarti s1 ON (a.Panel_make = 'SMART -I' AND b.zone = s1.Zone AND b.alarm = s1.SCODE)
//     LEFT JOIN 
//         smartinew s2 ON (a.Panel_make = 'SMART-IN' AND b.zone = s2.Zone AND b.alarm = s2.SCODE)
//     LEFT JOIN 
//         securico s3 ON (a.Panel_make = 'SEC' AND b.zone = s3.Zone AND b.alarm = s3.SCODE)
//     LEFT JOIN 
//         sec_sbi s4 ON (a.Panel_make = 'sec_sbi' AND b.zone = s4.Zone AND b.alarm = s4.SCODE)
//     LEFT JOIN 
//         rass s5 ON (a.Panel_make = 'RASS' AND b.zone = s5.Zone AND b.alarm = s5.SCODE)
//     LEFT JOIN 
//         rass_cloud s6 ON (a.Panel_make = 'rass_cloud' AND b.zone = s6.Zone AND b.alarm = s6.SCODE)
//     LEFT JOIN 
//         rass_sbi s7 ON (a.Panel_make = 'rass_sbi' AND b.zone = s7.Zone AND b.alarm = s7.SCODE)
//     LEFT JOIN 
//         raxx s8 ON (a.Panel_make = 'Raxx' AND b.zone = s8.SCODE)
//     LEFT JOIN 
//         securico_gx4816 s9 ON (a.Panel_make = 'securico_gx4816' AND b.zone = s9.zone)
//     LEFT JOIN 
//         smarti_hdfc32 s10 ON (a.Panel_make = 'smarti_hdfc32' AND b.zone = s10.zone)
//     LEFT JOIN 
//         comfort_diebold s11 ON (a.Panel_make = 'comfort_diebold' AND b.zone = s11.zone)
//     LEFT JOIN 
//         comfort_sbitom2 s12 ON (a.Panel_make = 'comfort_sbitom2' AND b.zone = s12.zone)
//     LEFT JOIN 
//         comfort s13 ON (a.Panel_make = 'comfort' AND b.zone = s13.zone)
//     LEFT JOIN 
//         comfort_hdfc s14 ON (a.Panel_make = 'comfort_hdfc' AND b.zone = s14.zone)
//     LEFT JOIN 
//         smarti_pnb s15 ON (a.Panel_make = 'smarti_pnb' AND b.zone = s15.Zone AND b.alarm = s15.SCODE)
//     LEFT JOIN 
//         rass_boi s16 ON (a.Panel_make = 'rass_boi' AND b.zone = s16.Zone AND b.alarm = s16.SCODE)
//     LEFT JOIN 
//         Testing_alertDetails t ON b.id = t.incident_id
//     WHERE 
//         DATE(b.receivedtime) ='$alerts_data_date' ";

//         mysqli_query($con,$insertstatement);



echo         $insertstatement2 = "

        INSERT INTO
            alert_data_$newtableName (
                Client_name,
                Incident_number,
                Region,
                ATMID,
                SiteAddress,
                City,
                State,
                Zone,
                alarm,
                Incident_category,
                Alram_message,
                createtime,
                receivedtime,
                closeDateTime,
                DVRIP,
                Panel_make,
                panelid,
                bank,
                Reactive,
                Closed_By,
                Closed_Date,
                Remark,
                sendip,
                TestingByServiceTeam,
                Testing_remark
            )
        SELECT
            a.Customer,
            b.id,
            COALESCE(
                s1.Zone,s2.Zone,s3.Zone,s4.Zone,s5.Zone,s6.Zone,s7.Zone,s8.Zone,s9.Zone,s10.Zone,s11.Zone,s12.Zone,s13.Zone,s14.Zone,s15.Zone,s16.Zone
            ) AS Region,
            a.ATMID,
            a.SiteAddress,
            a.City,
            a.State,
            a.zone,
            b.alarm,
            COALESCE(
                s1.SensorName,s2.SensorName,s3.SensorName,s4.SensorName,s5.SensorName,s6.SensorName,s7.SensorName,s8.SensorName,s9.SensorName,s10.SensorName,s11.SensorName,s12.SensorName,s13.SensorName,s14.SensorName,s15.SensorName,s16.SensorName
            ) AS Incident_category,
            CASE WHEN RIGHT(b.alarm, 1) = 'R' THEN 
        CONCAT(COALESCE(
                s1.SensorName,s2.SensorName,s3.SensorName,s4.SensorName,s5.SensorName,s6.SensorName,s7.SensorName,s8.SensorName,s9.SensorName,s10.SensorName,s11.SensorName,s12.SensorName,s13.SensorName,s14.SensorName,s15.SensorName,s16.SensorName),' ', 'Restoral')
                 ELSE COALESCE(
                s1.SensorName,s2.SensorName,s3.SensorName,s4.SensorName,s5.SensorName,s6.SensorName,s7.SensorName,s8.SensorName,s9.SensorName,s10.SensorName,s11.SensorName,s12.SensorName,s13.SensorName,s14.SensorName,s15.SensorName,s16.SensorName)
                 END AS Alram_message,
            b.createtime,
            b.receivedtime,
            DATE (b.receivedtime),
            a.DVRIP,
            a.Panel_make,
            b.panelid,
            a.Bank,
            CASE WHEN RIGHT(b.alarm, 1) = 'R' THEN 'Non-Reactive' ELSE 'Reactive' END AS alarm_status,
            
            b.closedBy,
            b.closedtime,
            CONCAT (b.closedtime, '*', b.comment, '*', b.closedBy) AS concatenated_column,
            b.sendip,
            t.TestingByService,
            t.remark
        FROM
        
                sites a
            JOIN 
            back$newtableName b ON (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid)
            LEFT JOIN 
                smarti s1 ON (a.Panel_make = 'SMART -I' AND b.zone = s1.Zone AND b.alarm = s1.SCODE)
            LEFT JOIN 
                smartinew s2 ON (a.Panel_make = 'SMART-IN' AND b.zone = s2.Zone AND b.alarm = s2.SCODE)
            LEFT JOIN 
                securico s3 ON (a.Panel_make = 'SEC' AND b.zone = s3.Zone AND b.alarm = s3.SCODE)
            LEFT JOIN 
                sec_sbi s4 ON (a.Panel_make = 'sec_sbi' AND b.zone = s4.Zone AND b.alarm = s4.SCODE)
            LEFT JOIN 
                rass s5 ON (a.Panel_make = 'RASS' AND b.zone = s5.Zone AND b.alarm = s5.SCODE)
            LEFT JOIN 
                rass_cloud s6 ON (a.Panel_make = 'rass_cloud' AND b.zone = s6.Zone AND b.alarm = s6.SCODE)
            LEFT JOIN 
                rass_sbi s7 ON (a.Panel_make = 'rass_sbi' AND b.zone = s7.Zone AND b.alarm = s7.SCODE)
            LEFT JOIN 
                raxx s8 ON (a.Panel_make = 'Raxx' AND b.zone = s8.SCODE)
            LEFT JOIN 
                securico_gx4816 s9 ON (a.Panel_make = 'securico_gx4816' AND b.zone = s9.zone)
            LEFT JOIN 
                smarti_hdfc32 s10 ON (a.Panel_make = 'smarti_hdfc32' AND b.zone = s10.zone)
            LEFT JOIN 
                comfort_diebold s11 ON (a.Panel_make = 'comfort_diebold' AND b.zone = s11.zone)
            LEFT JOIN 
                comfort_sbitom2 s12 ON (a.Panel_make = 'comfort_sbitom2' AND b.zone = s12.zone)
            LEFT JOIN 
                comfort s13 ON (a.Panel_make = 'comfort' AND b.zone = s13.zone)
            LEFT JOIN 
                comfort_hdfc s14 ON (a.Panel_make = 'comfort_hdfc' AND b.zone = s14.zone)
            LEFT JOIN 
                smarti_pnb s15 ON (a.Panel_make = 'smarti_pnb' AND b.zone = s15.Zone AND b.alarm = s15.SCODE)
            LEFT JOIN 
                rass_boi s16 ON (a.Panel_make = 'rass_boi' AND b.zone = s16.Zone AND b.alarm = s16.SCODE)
            LEFT JOIN 
                Testing_alertDetails t ON b.id = t.incident_id
            WHERE 
                DATE(b.receivedtime) = '$alerts_data_date'";
        
                mysqli_query($con,$insertstatement2);
}