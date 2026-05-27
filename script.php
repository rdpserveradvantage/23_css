<?php include('config.php');

$sql = mysqli_query($conn,"select * from sites where live='Y'");

while($sql_result = mysqli_fetch_assoc($sql)){
	$panel_make = $sql_result['Panel_Make'];
$new_panel_id = $sql_result['NewPanelID'];
$panel_ip = $sql_result['PanelIP'];
$atmid = $sql_result['ATMID'];

mysqli_query($conn,"insert into panel_health(panelName,ip,panelid,atmid) values('".$panel_make."','".$panel_ip."','".$new_panel_id."','".$atmid."')");
}




?>