<?php
include 'config.php';

$SN=$_POST['SN'];
$Customer=$_POST['Customer'];
$Bank=$_POST['Bank'];
$ATMID=$_POST['ATMID'];
$ATMID_2=$_POST['ATMID_2'];
$ATMID_3=$_POST['ATMID_3'];
$ATMID_4=$_POST['ATMID_4'];
$siteAddress=$_POST['siteAddress'];
$ATMShortName=$_POST['ATMShortName'];
$City=$_POST['City'];
$State=$_POST['State'];
$DVRIP=$_POST['DVRIP'];
$network=$_POST['network'];
$DVRName=$_POST['DVRName'];

$dvrport=$_POST['dvrport'];
$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$email=$_POST['email'];
$backofficename=$_POST['backofficename'];
$backofficenumber=$_POST['backofficenumber'];
$cssbm=$_POST['cssbm'];

$cssbmnumber=$_POST['cssbmnumber'];
$HeadSupervisorName=$_POST['HeadSupervisorName'];
$HeadSupervisorNumber=$_POST['HeadSupervisorNumber'];
$SupervisorName=$_POST['SupervisorName'];
$Supervisornumber=$_POST['Supervisornumber'];
$hideatmid=$_POST['hideatmid'];

$Policestation=$_POST['Policestation'];
$Polstnname=$_POST['Polstnname'];

$atm_officer_name=$_POST['atm_officer_name'];
$atm_officer_number=$_POST['atm_officer_number'];
$RA_QRT_NAME=$_POST['RA_QRT_NAME'];
$RA_QRT_NUMBER=$_POST['RA_QRT_NUMBER'];



$SQ="select * from esurvsites where ATM_ID='".$hideatmid."'";
$sqrun=mysqli_query($conn,$SQ);
$counts=mysqli_num_rows($sqrun);

if($counts >0){
  
echo	$sql="update esurvsites set Network='".$network."',DVRPort='".$dvrport."',EMail_ID='".$email."',BackofficerName='".$backofficename."',BackofficerNumber='".$backofficenumber."',
	CSSBM='".$cssbm."',CSSBMNumber='".$cssbmnumber."',HeadSupervisorName='".$HeadSupervisorName."',
	HeadSupervisorNumber='".$HeadSupervisorNumber."',SupervisorName='".$SupervisorName."',Supervisornumber='".$Supervisornumber."',Policestation='".$Policestation."',Polstnname='".$Polstnname."',
	atm_officer_name='".$atm_officer_name."',atm_officer_number='".$atm_officer_number."',RA_QRT_NAME='".$RA_QRT_NAME."',RA_QRT_NUMBER='".$RA_QRT_NUMBER."' where ATM_ID='".$hideatmid."'";
	$result=mysqli_query($conn,$sql);
	$result_10server=mysqli_query($cn,$sql);
	if(!$result_10server) {
	mysqli_query($conn,"update esurvsites set modify=2 where ATM_ID='".$hideatmid."'");
}
	//$result_online=mysqli_query($cont,$sql);
	
	//echo $sql;
	
	/*
	$sql="update esurvsites2 set Network='".$network."',DVRPort='".$dvrport."',EMail_ID='".$email."',BackofficerName='".$backofficename."',BackofficerNumber='".$backofficenumber."',
	CSSBM='".$cssbm."',CSSBMNumber='".$cssbmnumber."',HeadSupervisorName='".$HeadSupervisorName."',
	HeadSupervisorNumber='".$HeadSupervisorNumber."',SupervisorName='".$SupervisorName."',Supervisornumber='".$Supervisornumber."',Policestation='".$Policestation."',Polstnname='".$Polstnname."' where ATM_ID='$hideatmid'";
	$result=mysqli_query($conn,$sql);
	*/
}else{
/*
	$sql2="insert into esurvsites2(ATM_ID,ATM_ID2,ATM_ID3,ATM_ID4,Network,DVRPort,CSSBM,CSSBMNumber,EMail_ID,BackofficerName,BackofficerNumber,HeadSupervisorName,HeadSupervisorNumber,SupervisorName,Supervisornumber,Policestation,Polstnname)
values('$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$network','$dvrport','$cssbm','$cssbmnumber','$email','$backofficename','$backofficenumber','$HeadSupervisorName','$HeadSupervisorNumber','$SupervisorName','$Supervisornumber','$Policestation','$Polstnname')";
$result2=mysqli_query($conn,$sql2);
*/
echo $sql2="insert into esurvsites(SN, Customer, Bank, ATM_ID, ATM_ID2, ATM_ID3, ATM_ID4, ATMShortName, SiteAddress, City, State, DVRIP, Network, DVRPort, UserName, Password, CSSBM, CSSBMNumber, EMail_ID, BackofficerName, BackofficerNumber, HeadSupervisorName, HeadSupervisorNumber, SupervisorName, Supervisornumber, Policestation, Polstnname, atm_officer_name, atm_officer_number, RA_QRT_NAME, RA_QRT_NUMBER,Site_SN) values('".$SN."', '".$Customer."', '".$Bank."', '".$ATMID."','".$ATMID_2."','".$ATMID_3."','".$ATMID_4."','".$ATMShortName."','".$siteAddress."','".$City."','".$State."','".$DVRIP."','".$network."','".$dvrport."','".$UserName."','".$Password."','".$cssbm."','".$cssbmnumber."','".$email."','".$backofficename."','".$backofficenumber."','".$HeadSupervisorName."','".$HeadSupervisorNumber."','".$SupervisorName."','".$Supervisornumber."','".$Policestation."','".$Polstnname."','".$atm_officer_name."','".$atm_officer_number."','".$RA_QRT_NAME."','".$RA_QRT_NUMBER."','0')";

$result2=mysqli_query($conn,$sql2);

$result2_10server=mysqli_query($cn,$sql2);

if(!$result2_10server) {
	mysqli_query($conn,"update esurvsites set modify=1 where ATM_ID='".$ATMID."'");
}
//$result2_online=mysqli_query($cont,$sql2);
}

if($result2||$result)
{
  echo "1";  
}
else
{
    echo "0";
}

?>