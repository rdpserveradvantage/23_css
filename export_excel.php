<?php include('config.php'); 
error_reporting(0);

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


$customer = $_REQUEST['compy'];
$from= $_REQUEST['from'];

$to = $from;


// $tableName = 'alerts_' . date('Y_m_d', strtotime($to));
$tableName = 'alerts' ;

$statement = "select a.Customer as 'Client Name',b.id as 'Incident Number', a.Zone as Region, a.ATMID, b.panelid,
a.City,a.State,a.SiteAddress,
 b.createtime as 'Incident Date Time',
 b.receivedtime as 'Alarm Received Date Time',b.receivedtime as 'Close Date Time',a.DVRIP,
(CASE WHEN LOWER(RIGHT(b.alarm,1))='R' THEN 'Non-Reactive'
 ELSE 'Reactive'
END) AS `Reactive`,
b.closedBy as 'Closed By',b.closedtime as 'Closed Date', 
CONCAT(b.closedtime, '*', b.comment, '*', b.closedBy) as Remark,
b.zone,b.alarm,
a.Panel_Make,
'' as  `Incident Category`,
(CASE WHEN LOWER(RIGHT(b.alarm,1))='R' THEN 'Restoral'
END) AS `Alarm Message`

from alerts b 
INNER JOIN sites a ON b.panelid = a.NewPanelID
LEFT JOIN sites c ON b.panelid = c.OldPanelID
WHERE 1  ";


if(isset($customer) && !empty($customer)){

  $statement .= " and a.customer='".$customer."' " ; 
}

$statement .= " and b.receivedtime between '".$to." 00:00:00' and '".$from." 23:59:59'"; 

// echo $statement ; 


// WHERE a.Customer='".$customer."' and b.receivedtime between '".$to." 00:00:00' and '".$from." 23:59:59'

$contents='';
    $contents.="Sr No \t Client Name \t Incident Number \t Region \t ATMID \t PANELID \t City \t State \t Address \t Incident Category \t Alarm Message \t Incident Date Time \t Alarm Received Date Time \t Close Date Time \t DVRIP \t Panel_make \t Reactive \t Closed By \t Closed Date \t Remark \t Zone \t alarm \t";
?>



      

<?php 

// echo $statement ; 

// return ; 

$i=1;
$sql = mysqli_query($conn,$statement);
while($sql_result = mysqli_fetch_assoc($sql)){
  // if($i<100){

$_panel_make = $sql_result['Panel_Make'] ; 
$_zone = $sql_result['zone'];


if($_panel_make=='RASS'){
    $_b_sql = mysqli_query($conn,"select SensorName from rass WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='rass_sbi'){
    $_b_sql = mysqli_query($conn,"select SensorName from rass_sbi WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='rass_cloud'){
    $_b_sql = mysqli_query($conn,"select SensorName from rass_cloud WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='rass_boi'){
    $_b_sql = mysqli_query($conn,"select SensorName from rass_boi WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }

  elseif($_panel_make=='Raxx'){
    $_b_sql = mysqli_query($conn,"select SensorsName from Raxx WHERE ZoneNumber like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorsName'];
  }
  elseif($_panel_make=='sec_sbi'){
    $_b_sql = mysqli_query($conn,"select sensorname from sec_sbi WHERE zone like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['sensorname'];
  }
  elseif($_panel_make=='securico_gx4816'){
    $_b_sql = mysqli_query($conn,"select sensorname from securico_gx4816 WHERE zone like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['sensorname'];
  }
  elseif($_panel_make=='smarti_hdfc32'){
    $_b_sql = mysqli_query($conn,"select SensorName from smarti_hdfc32 WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='SMART-IN'){
    $_b_sql = mysqli_query($conn,"select SensorName from smartinew WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='SMART -I'){
    $_b_sql = mysqli_query($conn,"select SensorName from smartinew WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='smarti_boi'){
    $_b_sql = mysqli_query($conn,"select SensorName from smarti_boi WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  }
  elseif($_panel_make=='smarti_pnb'){
    $_b_sql = mysqli_query($conn,"select SensorName from smarti_pnb WHERE ZONE like '".$_zone."'");
    $_b_sql_result = mysqli_fetch_assoc($_b_sql);
    $sensorname = $_b_sql_result['SensorName'];
  } 




	$contents.= "\n".$i."\t";
	$contents.= $sql_result['Client Name']."\t";
	$contents.= $sql_result['Incident Number']."\t";

       // $contents.=$sql_result['Incident Number']."\t"; 
       $contents.=$sql_result['Region']."\t"; 
       $contents.=$sql_result['ATMID']."\t"; 
       $contents.=$sql_result['panelid']."\t"; 
       $contents.=$sql_result['City']."\t"; 
       $contents.=$sql_result['State']."\t"; 
       $contents.=$sql_result['SiteAddress']."\t"; 
       $contents.=$sensorname."\t"; 


       if(endsWith($sql_result["alarm"], "R")) $alarm_msg = $sensorname.' Restoral'; 
                else $alarm_msg = $sensorname; 

      $contents.=remove_special($alarm_msg)."\t";

       $contents.=$sql_result['Incident Date Time']."\t"; 
       $contents.=$sql_result['Alarm Received Date Time']."\t"; 
       $contents.=$sql_result['Close Date Time']."\t"; 
       $contents.=$sql_result['DVRIP']."\t"; 
       $contents.=$_panel_make."\t"; 
       $contents.=$sql_result['Reactive']."\t"; 
       $contents.=$sql_result['Closed By']."\t"; 
       $contents.=$sql_result['Closed Date']."\t"; 
       $contents.=$sql_result['Remark']."\t"; 
       $contents.=$sql_result['zone']."\t"; 
       $contents.=$sql_result['alarm']."\t"; 
 $i++ ;
}

$name = $customer .'-'.date('Ymd');
    $contents = strip_tags($contents);
    header("Content-Disposition: attachment; filename=$name.xls");
    header("Content-Type: application/vnd.ms-excel");
    print $contents;
?>