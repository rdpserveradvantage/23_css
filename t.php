<?php
include('config.php');



function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function remove_special($site_remark2){
	$site_remark2_arr = explode(" ",$site_remark2);
	
	foreach($site_remark2_arr as $k=>$v){
		$a[] = preg_split ('/\n/', $v);	
	}
	
	$site_remark ='' ; 
	foreach($a as $key=>$value){
		foreach($value as $ke=>$va){
			$site_remark .= $va . " " ; 
		} 

	}

return clean($site_remark) ; 

}



// Step 1: Start output buffering
ob_start();

// Step 2: Define batch size
$batchSize = 500000;

$query2 = "SELECT COUNT(1) AS totalRows FROM modified_alerts";
$sql = mysqli_query($conn, $query2);
$sql_result = mysqli_fetch_assoc($sql);
$totalRows = $sql_result['totalRows'];

$query = "SELECT primeid, SensorName, alarm_description, Customer, Bank, ATMID, ATMShortName, SiteAddress, DVRIP, Panel_make, zon, City, State, id, panelid, createtime, receivedtime, comment, zone, alarm, closedBy, closedtime FROM modified_alerts";

$numBatches = ceil($totalRows / $batchSize);

// Step 6: Process records in batches
for ($batch = 1; $batch <= $numBatches; $batch++) {
    $offset = ($batch - 1) * $batchSize;
    $queryBatch = $query . " LIMIT $offset, $batchSize";
    $stmtBatch = mysqli_query($conn, $queryBatch);
    $content = "";

    $content .= "Sr No \t  SensorName \t alarm_description \t Customer \t Bank \t ATMID \t ATMShortName \t SiteAddress \t DVRIP \t Panel_make \t zon \t City \t State \t id \t panelid \t createtime \t receivedtime \t comment \t zone \t alarm \t closedBy \t closedtime";

    while ($stmtBatch_result = mysqli_fetch_assoc($stmtBatch)) {
        $primeid = $stmtBatch_result['primeid'];

        $content .="\n".$primeid."\t";
        $content .= remove_special($stmtBatch_result['SensorName'])."\t"; 
        $content .= remove_special($stmtBatch_result['alarm_description'])."\t"; 
        $content .= $stmtBatch_result['Customer']."\t"; 
        $content .= $stmtBatch_result['Bank']."\t"; 
        $content .= $stmtBatch_result['ATMID']."\t"; 
        $content .= remove_special($stmtBatch_result['ATMShortName'])."\t"; 
        $content .= remove_special($stmtBatch_result['SiteAddress'])."\t"; 
        $content .= $stmtBatch_result['DVRIP']."\t"; 
        $content .= $stmtBatch_result['Panel_make']."\t"; 
        $content .= $stmtBatch_result['zon']."\t"; 
        $content .= $stmtBatch_result['City']."\t"; 
        $content .= $stmtBatch_result['State']."\t"; 
        $content .= $stmtBatch_result['id']."\t"; 
        $content .= $stmtBatch_result['panelid']."\t"; 
        $content .= $stmtBatch_result['createtime']."\t"; 
        $content .= $stmtBatch_result['receivedtime']."\t"; 
        $content .= remove_special($stmtBatch_result['comment'])."\t"; 
        $content .= $stmtBatch_result['zone']."\t"; 
        $content .= $stmtBatch_result['alarm']."\t"; 
        $content .= $stmtBatch_result['closedBy']."\t"; 
        $content .= $stmtBatch_result['closedtime']."\t";
    }

    $previousDate = date('dmY', strtotime('yesterday'));
    $tableName = $previousDate . '_alert';

    $filename = $tableName . $batch . ".xls"; 
    $filepath = "alertreports/" . $filename; 

    file_put_contents($filepath, $content);
}
?>
