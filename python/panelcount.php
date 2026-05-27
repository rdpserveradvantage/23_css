<?php
include '../config.php';
$con = $conn;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Query to get the table name
$getsql = mysqli_query($con, "SELECT id, alerts_data_date, newtableName 
FROM backalerts_data_tracker_datewise
WHERE is_viewalertReportCreated = 0 ORDER BY id ASC LIMIT 20");

while ($getsql_result = mysqli_fetch_assoc($getsql)) {
    // Get the table name from the query result
    $newtableName = $getsql_result['newtableName'];

    // Create SQL query to add the indexes to the specified table
    $add_indexes_sql = "
    ALTER TABLE `$newtableName`
    ADD PRIMARY KEY (`id`),
    ADD KEY `receivedtime` (`receivedtime`),
    ADD KEY `panelid` (`panelid`),
    ADD KEY `status` (`status`),
    ADD KEY `closedBy` (`closedBy`),
    ADD KEY `createtime` (`createtime`),
    ADD KEY `sendip` (`sendip`),
    ADD KEY `sendtoclient` (`sendtoclient`),
    ADD KEY `zone` (`zone`),
    ADD KEY `alarm` (`alarm`),
    ADD KEY `level` (`level`),
    ADD KEY `sip2` (`sip2`),
    ADD KEY `auto_alert` (`auto_alert`),
    ADD KEY `critical_alerts` (`critical_alerts`),
    ADD KEY `idx_alerts_critical_1` (`status`,`sendtoclient`,`sendip`,`alerttype`,`receivedtime`,`critical_alerts`),
    ADD KEY `idx_alerts_critical_2` (`status`,`sendtoclient`,`sip2`,`alerttype`,`receivedtime`,`critical_alerts`);
    ";

    // Execute the query to add the indexes
    if (mysqli_query($con, $add_indexes_sql)) {
        echo "Indexes added successfully to the table: $newtableName";
    } else {
        echo "Error adding indexes to table: $newtableName. " . mysqli_error($con);
    }
}

?>
