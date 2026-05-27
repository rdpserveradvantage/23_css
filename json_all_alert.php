<?php
ini_set('memory_limit','-1');
set_time_limit(0);

date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="root";
$pass="";
$dbname="esurv";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected succesfully";
   
}


$table_name = $_REQUEST['table_name'];
$customer = $_REQUEST['customer'];
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

// select a.Customer as "Client Name",b.id as "Incident Number", a.Zone as Region, a.ATMID, a.SiteAddress as Address,a.City,a.State,b.createtime as "Incident Date Time",b.receivedtime as "Alarm Received Date Time",b.receivedtime as "Close Date Time",a.DVRIP,b.panelid,a.Bank,
// (CASE WHEN LOWER(RIGHT(b.alarm,1))="R" THEN "Non-Reactive"
//  ELSE "Reactive"
// END) AS `Reactive`,
// b.closedBy as "Closed By",b.closedtime as "Closed Date", 
// CONCAT(b.closedtime, "*", b.comment, "*", b.closedBy) as Remark,
// b.zone,b.alarm,
// a.Panel_Make,
// "" as  `Incident Category`,
// (CASE WHEN LOWER(RIGHT(b.alarm,1))="R" THEN "Restoral"
// END) AS `Alarm Message`
// from alerts b 
// INNER JOIN sites a ON b.panelid = a.NewPanelID
// LEFT JOIN sites c ON b.panelid = c.OldPanelID
// WHERE a.Customer="FSS" and b.receivedtime between "2022-11-22 00:00:00" and "2022-11-22 23:59:59"


$statement = 'select a.Customer as "Client Name",b.id as "Incident Number", a.Zone as Region, a.ATMID, a.SiteAddress as Address,a.City,a.State,b.createtime as "Incident Date Time",b.receivedtime as "Alarm Received Date Time",b.receivedtime as "Close Date Time",a.DVRIP,b.panelid,a.Bank,
(CASE WHEN LOWER(RIGHT(b.alarm,1))="R" THEN "Non-Reactive"
 ELSE "Reactive"
END) AS `Reactive`,
b.closedBy as "Closed By",b.closedtime as "Closed Date", 
CONCAT(b.closedtime, "*", b.comment, "*", b.closedBy) as Remark,
b.zone,b.alarm,
a.Panel_Make,
"" as  `Incident Category`,
(CASE WHEN LOWER(RIGHT(b.alarm,1))="R" THEN "Restoral"
END) AS `Alarm Message`
from alerts b 
INNER JOIN sites a ON b.panelid = a.NewPanelID
LEFT JOIN sites c ON b.panelid = c.OldPanelID
WHERE a.Customer="'.$customer.'" and b.receivedtime between "'.$from.' 00:00:00" and "'.$to.' 23:59:59"';

if(mysqli_query($conn,"create table $table_name as $statement")){
	

	mysqli_query($conn,"ALTER TABLE $table_name CHANGE `Incident Category` `Incident Category` TEXT");

	mysqli_query($conn,"ALTER TABLE $table_name ADD PRIMARY KEY(`Incident Number`)");

	
	$sql = mysqli_query($conn,"select * from $table_name");
	while($sql_result = mysqli_fetch_assoc($sql)){

		$_id = $sql_result['Incident Number'];
		$_incident_category = $sql_result['Incident Category'];
		$_panel_make = $sql_result['Panel_Make'];
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
	elseif($_panel_make=='SMART -I'){
		$_b_sql = mysqli_query($conn,"select SensorName from smarti WHERE ZONE like '".$_zone."'");
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


	$s  = "update $table_name set `Incident Category`='".$sensorname."' where `Incident Number`='".$_id."'"; 
	mysqli_query($conn,$s);
	}


	mysqli_query($conn,"update $table_name set alarm='YY' where alarm='ÿÿ'");


	$table = $table_name;
	$primaryKey = 'Incident Number';

	$columns = array(
	array( 'db' => 'Client Name','dt'=> 0),
	array( 'db' => 'Incident Number','dt'=> 1),
	array( 'db' => 'Region','dt'=> 2),
	array( 'db' => 'ATMID','dt'=> 3),
	array( 'db' => 'Address','dt'=> 4),
	array( 'db' => 'City','dt'=> 5),
	array( 'db' => 'State','dt'=> 6),
	array( 'db' => 'Incident Date Time','dt'=> 7),
	array( 'db' => 'Alarm Received Date Time','dt'=> 8),
	array( 'db' => 'Close Date Time','dt'=> 9),
	array( 'db' => 'DVRIP','dt'=> 10),
	array( 'db' => 'panelid','dt'=> 11 ),
	array( 'db' => 'Bank','dt'=> 12),
	array( 'db' => 'Reactive','dt'=> 13),
	array( 'db' => 'Closed By','dt'=> 14),
	array( 'db' => 'Closed Date','dt'=> 15),
	array( 'db' => 'Remark','dt'=> 16),
	array( 'db' => 'zone','dt'=> 17),
	array( 'db' => 'alarm','dt'=> 18),
	array( 'db' => 'Panel_Make','dt'=> 19),
	array( 'db' => 'Incident Category','dt'=> 20),
	array( 'db' => 'Alarm Message','dt'=> 21),
	);

	include('ssp_config.php');
	require( 'ssp.class.php' );

	echo json_encode(
		SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"" ) 
	);	
}else{
	echo mysqli_error($conn);
}

    
