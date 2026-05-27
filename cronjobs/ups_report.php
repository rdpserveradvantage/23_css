<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "esurv";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$truncateQuery = "TRUNCATE TABLE alerts_acup";
if ($conn->query($truncateQuery) === TRUE) {
    echo "Table alerts_acup truncated successfully.\n";
} else {
    echo "Error truncating table: " . $conn->error . "\n";
}
echo '<br />';

// RASS 
$insertQuery = "
INSERT INTO alerts_acup (id, panelid, seqno, zone, alarm, createtime, receivedtime, comment, status, sendtoclient, closedBy, closedtime, sendip, alerttype, location, priority, AlertUserStatus)
SELECT 
    b.id, b.panelid, b.seqno, b.zone, b.alarm, b.createtime, b.receivedtime, 
    b.comment, b.status, b.sendtoclient, b.closedBy, b.closedtime, 
    b.sendip, b.alerttype, b.location, b.priority, b.AlertUserStatus  
FROM 
    `sites` a, `alerts` b 
WHERE 
    (a.OldPanelID = b.panelid OR a.NewPanelID = b.panelid) 
    AND (a.Panel_Make IN ('RASS', 'rass_boi', 'rass_pnb', 'rass_sbi')) 
    AND (b.alarm IN ('AT', 'AR') AND b.zone IN ('029', '030')) 
    AND CAST(b.receivedtime AS DATE) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
    
";

echo '<br />';


if ($conn->query($insertQuery) === TRUE) {
    echo "RASS Records inserted successfully.\n";
} else {
    echo "Error inserting records: " . $conn->error . "\n";
}

$Securicoinsert = "insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM `sites` a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) AND (a.Panel_Make = 'securico_gx4816' OR a.Panel_Make = 'sec_sbi') AND (b.alarm IN ('BA','BR') AND b.zone IN ('551','552'))
 AND CAST(b.receivedtime AS DATE) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
 
";

if ($conn->query($Securicoinsert) === TRUE) {
    echo "Securico Records inserted successfully.\n";
} else {
    echo "Error inserting records: " . $conn->error . "\n";
}

// SEC
$secinsert = "
insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM `sites` a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) AND a.Panel_Make = 'SEC' AND (b.alarm IN ('BA','BR') AND b.zone IN ('027','028'))
 AND CAST(b.receivedtime AS DATE) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
 
";

if ($conn->query($secinsert) === TRUE) {
    echo "Securico Records inserted successfully.\n";
} else {
    echo "Error inserting records: " . $conn->error . "\n";
}

// Smart I
$smartiinsert = "
insert into alerts_acup (id,panelid,seqno,zone,alarm,createtime,receivedtime,comment,status,sendtoclient,closedBy,closedtime,sendip,alerttype,location,priority,AlertUserStatus)
SELECT b.id,b.panelid,b.seqno,b.zone,b.alarm,b.createtime,b.receivedtime,b.comment,b.status,b.sendtoclient,b.closedBy,b.closedtime,b.sendip,b.alerttype,b.location,b.priority,b.AlertUserStatus FROM `alerts` b,sites a WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) AND (a.Panel_Make='SMART -I' OR a.Panel_Make ='SMART -IN' OR a.Panel_Make ='smarti_boi' OR a.Panel_Make ='smarti_pnb') AND (b.alarm IN ('BA','BR') AND b.zone IN ('001','002')) AND 
 CAST(b.receivedtime AS DATE) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) " ;

 if ($conn->query($smartiinsert) === TRUE) {
    echo "Smart I Records inserted successfully.\n";
} else {
    echo "Error inserting records: " . $conn->error . "\n";
}



$conn->close();


?>
