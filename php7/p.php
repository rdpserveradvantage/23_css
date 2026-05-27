<?php
ini_set('memory_limit', '-1');

// Step 1: Establish database connection
$dbHost = 'localhost';
$dbName = 'esurv';
$dbUser = 'root';
$dbPass = '';



try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


// Step 2: Define batch size
$batchSize = 500000;


// Step 2: Execute the SQL query
$query = "
    SELECT
    SensorName,
    CASE
        WHEN alarm LIKE '%R' THEN CONCAT(SensorName, ' Restoral')
        ELSE SensorName
    END AS alarm_description,
    Customer, Bank, ATMID, ATMShortName, SiteAddress,
    DVRIP, Panel_make, zon, City, State, id, panelid,
    createtime, receivedtime, comment, zone, alarm, closedBy, closedtime
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
        b.createtime, b.receivedtime, b.comment, b.zone, b.alarm, b.closedBy, b.closedtime
    FROM
        sites a
    INNER JOIN
        `24052023_alert` b ON a.NewPanelID = b.panelid
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
) AS subquery
";

try {
    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query execution failed: " . $e->getMessage());
}


try {
    $stmt = $pdo->query($query);
    $totalRows = $stmt->rowCount();
} catch (PDOException $e) {
    die("Query execution failed: " . $e->getMessage());
}

// Step 4: Set up PHPExcel library
require_once 'PHPExcel/Classes/PHPExcel.php';

// Step 5: Calculate number of batches
$numBatches = ceil($totalRows / $batchSize);

// Step 6: Process records in batches
for ($batch = 1; $batch <= $numBatches; $batch++) {
    // Step 7: Fetch records for current batch
    $offset = ($batch - 1) * $batchSize;
    $queryBatch = $query . " LIMIT $offset, $batchSize";
    $stmtBatch = $pdo->query($queryBatch);
    $results = $stmtBatch->fetchAll(PDO::FETCH_ASSOC);

    // Step 8: Create Excel file for current batch
    $excel = new PHPExcel();
    $excel->setActiveSheetIndex(0);
    $sheet = $excel->getActiveSheet();

    // Write column headers
    $headers = ["SensorName", "alarm_description", "Customer", "Bank", "ATMID", "ATMShortName", "SiteAddress", "DVRIP", "Panel_make", "zon", "City", "State", "id", "panelid", "createtime", "receivedtime", "comment", "zone", "alarm", "closedBy", "closedtime"];
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    // Write records
    $row = 2;
    foreach ($results as $record) {
        $column = 'A';
        foreach ($record as $value) {
            $sheet->setCellValue($column . $row, $value);
            $column++;
        }
        $row++;
    }

    // Save Excel file
    $filename = "batch{$batch}.xlsx";
    $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $writer->save($filename);
}
?>