<?php 
include('config.php');



ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0); 



function removeSpecialCharacters($string) {
    // Remove special characters from within the string
    $cleanString = preg_replace('/[^a-zA-Z0-9 ]/', '', $string);
    
    // Remove leading and trailing spaces
    $cleanString = trim($cleanString);
    
    return $cleanString;
}


$previousDate = date('dmY', strtotime('yesterday'));
$tableName = $previousDate . '_alert';

mysqli_query($conn,"DROP TABLE IF EXISTS $tableName"); 

$query = "CREATE TABLE $tableName SELECT * FROM alerts WHERE DATE(receivedtime) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
$result = mysqli_query($conn, $query);





mysqli_query($conn,"ALTER TABLE $tableName ADD PRIMARY KEY(`id`)");

mysqli_query($conn,"ALTER TABLE $tableName ADD INDEX(`panelid`,`seqno`,`zone`,`alarm`,`createtime`,`receivedtime`,`status`,`sendtoclient`,`closedBy`,`closedtime`,`sendip`,`alerttype`,`location`,`priority`,`AlertUserStatus`,`level`,`sip2`)");




mysqli_query($conn,"DROP TABLE IF EXISTS `modified_alerts`"); 
mysqli_query($conn,"CREATE table modified_alerts
    SELECT
    SensorName,
    CASE
        WHEN alarm LIKE '%R' THEN 'Restoral'
        ELSE SensorName
    END AS alarm_description,
    CASE
        WHEN alarm LIKE '%R' THEN 'Non-Reactive'
        ELSE 'Reactive'
    END AS reactive_status,

    Customer, Bank, ATMID, ATMShortName, SiteAddress,
    DVRIP, Panel_make, zon, City, State, id, panelid,
    createtime, receivedtime, comment, zone, alarm, closedBy, closedtime,sendip
FROM (
    SELECT
        CASE
            WHEN a.Panel_make = 'SMART-IN' THEN c.SensorName
            WHEN a.Panel_make = 'SEC' THEN d.SensorName
            WHEN a.Panel_make = 'SMART -I' THEN e.sensorname
            WHEN a.Panel_make = 'sec_sbi' THEN f.sensorname
            WHEN a.Panel_make = 'RASS' THEN g.sensorname
            WHEN a.Panel_make = 'rass_cloud' THEN h.sensorname
            WHEN a.Panel_make = 'rass_sbi' THEN i.sensorname
            WHEN a.Panel_make = 'securico_gx4816' THEN j.sensorname
    
            ELSE NULL
        END AS SensorName,
        a.Customer, a.Bank, a.ATMID, a.ATMShortName, a.SiteAddress,
        a.DVRIP, a.Panel_make, a.zone AS zon, a.City, a.State, b.id, b.panelid,
        b.createtime, b.receivedtime, b.comment, b.zone, b.alarm, b.closedBy, b.closedtime,b.sendip
    FROM
        sites a
    INNER JOIN
        $tableName b ON a.NewPanelID = b.panelid
    LEFT JOIN
        smartinew c ON b.zone = c.ZONE AND b.alarm = c.SCODE
    LEFT JOIN
        securico d ON b.zone = d.ZONE AND b.alarm = d.scode
    LEFT JOIN
        smarti e ON b.zone = e.ZONE AND b.alarm = e.SCODE
    LEFT JOIN
        sec_sbi f ON b.zone = f.zone AND b.alarm = f.scode
    LEFT JOIN
        rass g ON b.zone = g.ZONE AND b.alarm = g.SCODE
    LEFT JOIN
        rass_cloud h ON b.zone = h.ZONE AND b.alarm = h.SCODE
    LEFT JOIN
        rass_sbi i ON b.zone = i.ZONE AND b.alarm = i.SCODE
    LEFT JOIN
        securico_gx4816 j ON b.zone = j.zone AND b.alarm = j.scode
    LEFT JOIN
        securico_gx4816 k ON b.zone = k.ZONE AND b.alarm = k.SCODE
) AS subquery");



mysqli_query($conn,"ALTER TABLE modified_alerts ADD COLUMN primeid INT AUTO_INCREMENT PRIMARY KEY FIRST");

mysqli_query($conn,"ALTER TABLE `modified_alerts` ADD INDEX( `Customer`, `Bank`, `ATMID`, `DVRIP`, `Panel_make`, `zon`, `City`, `State`, `id`, `panelid`, `createtime`, `receivedtime`, `zone`, `alarm`, `closedBy`, `closedtime`)");











// Step 1: Start output buffering
ob_start();

// Step 2: Define batch size
$batchSize = 750000;

$query2 = "SELECT COUNT(1) AS totalRows FROM modified_alerts";
$sql = mysqli_query($conn, $query2);
$sql_result = mysqli_fetch_assoc($sql);
$totalRows = $sql_result['totalRows'];

$query = "SELECT primeid, SensorName, alarm_description, Customer, Bank, ATMID, SiteAddress, DVRIP, Panel_make, zon, City, State, id, panelid, createtime, receivedtime, comment, zone, alarm, closedBy, closedtime FROM modified_alerts";

$numBatches = ceil($totalRows / $batchSize);

// Step 6: Process records in batches
for ($batch = 1; $batch <= $numBatches; $batch++) {
    $offset = ($batch - 1) * $batchSize;
    $queryBatch = $query . " LIMIT $offset, $batchSize";
    $stmtBatch = mysqli_query($conn, $queryBatch);
    $content = "";



$content .= "Client Name \t Incident Number \t Region \t ATMID \t  Address \t City \t State \t Zone \t Alarm \t Incident Category \t Alarm Message \t Incident Date Time \t Alarm Received Date Time \t Close Date Time \t DVRIP   Panel_make \t panelid \t Bank \t Reactive \t Closed By \t Closed Date \t Remark \t Send Ip \t TestingByServiceTeam \t Testing Remark" ;



    // $content .= "Sr No \t  SensorName \t alarm_description \t Customer \t Bank \t ATMID \t Address \t DVRIP \t Panel_make \t zon \t City \t State \t id \t panelid \t createtime \t receivedtime \t comment \t zone \t alarm \t closedBy \t closedtime";

    while ($stmtBatch_result = mysqli_fetch_assoc($stmtBatch)) {
        $primeid = $stmtBatch_result['primeid'];

        $content .= "\n".$stmtBatch_result['Customer']."\t"; 
        $content .= $primeid."\t";
        $content .= $stmtBatch_result['zon']."\t"; 
        $content .= $stmtBatch_result['ATMID']."\t"; 
        $content .= removeSpecialCharacters($stmtBatch_result['SiteAddress'])."\t"; 
        $content .= $stmtBatch_result['City']."\t"; 
        $content .= $stmtBatch_result['State']."\t"; 
        $content .= $stmtBatch_result['zone']."\t"; 
        $content .= $stmtBatch_result['alarm']."\t"; 

        $content .= removeSpecialCharacters($stmtBatch_result['SensorName'])."\t"; 
        $content .= removeSpecialCharacters($stmtBatch_result['alarm_description'])."\t"; 
        $content .= $stmtBatch_result['createtime']."\t"; 
        $content .= $stmtBatch_result['receivedtime']."\t"; 
        $content .= $stmtBatch_result['closedtime']."\t";
        $content .= $stmtBatch_result['DVRIP']."\t"; 
        $content .= $stmtBatch_result['Panel_make']."\t"; 
        $content .= $stmtBatch_result['panelid']."\t"; 
        $content .= $stmtBatch_result['Bank']."\t"; 
        $content .= $stmtBatch_result['reactive_status']."\t"; 
        $content .= $stmtBatch_result['closedBy']."\t"; 
        $content .= $stmtBatch_result['closedtime']."\t";

        $content .= $stmtBatch_result["closedtime"].'*'.removeSpecialCharacters($stmtBatch_result["comment"]).'*'.$stmtBatch_result["closedBy"]."\t";
        $content .= $stmtBatch_result['sendip']."\t";
        $content .= ''."\t"; 
        $content .= ''."\t"; 

    }

    $previousDate = date('dmY', strtotime('yesterday'));
    $tableName = $previousDate . '_alert';

    $filename = $tableName . $batch . ".xls"; 
    $filepath = "alertreports/" . $filename; 

    file_put_contents($filepath, $content);
}
?>