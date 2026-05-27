<?php session_start();
include 'config.php';
$atm=$_POST['atm'];
$testRemark=$_POST['testRemark'];
$engiName=$_POST['engiName'];
$incidentId=$_POST['a'];
date_default_timezone_set('Asia/Kolkata');
$entryDate = date('Y-m-d H:i:s');


mysqli_query($conn, "START TRANSACTION");

$inc=explode(",",$incidentId);
for($i=0;$i<count($inc);$i++){
	$result=mysqli_query($conn,"insert into Testing_alertDetails(incident_id,TestingByService,remark,entrydate,engiName)values('".$inc[$i]."','".$_SESSION['name']."','".$testRemark."','".$entryDate."','".$engiName."') ");

	}


$updQuery=mysqli_query($conn,"update sites set live='Y' where ATMID='".$atm."' and live='T' ");
$dataQry=mysqli_query($conn,"Select * from sites where ATMID='".$atm."' and live='Y' ");
$fetchdata=mysqli_fetch_array($dataQry);

$sql="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,eng_name,addedby,site_remark,site_id,editby)
values('".$fetchdata['Status']."','".$fetchdata['Phase']."','".$fetchdata['Customer']."','".$fetchdata['Bank']."','".$fetchdata['ATMID']."','".$fetchdata['ATMID_2']."','".$fetchdata['ATMID_3']."','".$fetchdata['ATMID_4']."','".$fetchdata['TrackerNo']."','".$fetchdata['ATMShortName']."','".$fetchdata['SiteAddress']."','".$fetchdata['City']."','".$fetchdata['State']."','".$fetchdata['Zone']."','".$fetchdata['Panel_Make']."','".$fetchdata['OldPanelID']."','".$fetchdata['NewPanelID']."','".$fetchdata['DVRIP']."','".$fetchdata['DVRName']."','".$fetchdata['UserName']."','".$fetchdata['Password']."','".$fetchdata['live']."','".$entryDate."','".$fetchdata['eng_name']."','".$fetchdata['addedby']."','".$testRemark."','".$fetchdata['SN']."','".$_SESSION['name']."')";
$querdata=mysqli_query($conn,$sql);

$insrt=mysqli_query($conn,"insert into testingCount (Atmid,name,Action,engiName) value('".$fetchdata['ATMID']."','".$_SESSION['name']."','Y','".$engiName."')");

$las=$_POST['last_id'];
$sqlremarkQuery=mysqli_query($conn,"insert into  site_test_log_details(testcountid,atmid,remark,Added_By,entrydate,engiName)values('".$las."','".$fetchdata['ATMID']."','".$testRemark."','".$_SESSION['name']."','".$entryDate."','".$engiName."') " );


$deleteQuery=mysqli_query($conn,"Delete from TestingSites where atmid='".$atm."' ");

if($updQuery && $dataQry && $fetchdata &&  $insrt && $deleteQuery){
	mysqli_query($conn, "COMMIT");
	echo 1;
}else{
	 mysqli_query($conn, "ROLLBACK");
	echo 0;
}

?>