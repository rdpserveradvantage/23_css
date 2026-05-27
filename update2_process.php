<?php
session_start();
include 'config.php';

$sn=$_POST['sn'];
//echo $sn;
$insdates=$_POST['insdates'];

date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

if($insdates==""){
$insdates=date("Y-m-d");	
}



//=====Broadband Details===========
/*$site_id=$_POST['site_id'];
$NetworkType=$_POST['NetworkType'];
$ProviderName=$_POST['ProviderName'];
$ProviderEmail=$_POST['ProviderEmail'];
$ProviderMobile=$_POST['ProviderMobile'];
$InternetPlans=$_POST['InternetPlans'];
$MonthPlans=$_POST['MonthPlans'];
$StartInternetDate=$_POST['StartInternetDate'];
$BroadbandAmount=$_POST['BroadbandAmount'];
$BroadbandAddress=$_POST['BroadbandAddress'];
$AddSite_RouterIp=$_POST['AddSite_RouterIp'];*/
///////////////////////////////////



$Router_Model_num=$_POST['Router_Model_num'];
$DVR_Model_num=$_POST['DVR_Model_num'];
$Status=$_POST['Status'];
$Phase=$_POST['Phase'];
$Customer=$_POST['Customer'];
$Bank=$_POST['Bank'];
$ATMID=$_POST['ATMID'];
$ATMID_2=$_POST['ATMID_2'];
$ATMID_3=$_POST['ATMID_3'];
$ATMID_4=$_POST['ATMID_4'];
$TrackerNo=$_POST['TrackerNo'];
$ATMShortName=$_POST['ATMShortName'];
$SiteAddress=$_POST['SiteAddress'];
$City=$_POST['City'];
$State=$_POST['State'];
$Zone=$_POST['Zone'];
$Panel_Make=$_POST['Panel_Make'];
$OldPanelID=$_POST['OldPanelID'];
$NewPanelID=$_POST['NewPanelID'];
$DVRIP=$_POST['DVRIP'];
$PanelsIP=$_POST['PanelsIP'];
$DVRName=$_POST['DVRName'];
$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$live=$_POST['live'];
$engname=$_POST['engname'];
$oldimg=$_POST['hidimg'];
$remark=$_POST['Remark'];
$addbysite=$_POST['addbysite'];
$name=$_FILES['up']['name'];
$size=$_FILES['up']['size'];
$type=$_FILES['up']['type'];
$tmp_name=$_FILES['up']['tmp_name'];
$location="file_img/".time().$name;

$gsmnum=$_POST['GSM'];


$AddSite_DVRName = $_REQUEST['AddSite_DVRName'];
$AddSite_UserName = $_REQUEST['AddSite_UserName'];
$AddSite_Password = $_REQUEST['AddSite_Password'];
$port = $_REQUEST['port'];

$sites_info = $_REQUEST['sites_info'];

for ($i=0; $i < count($sites_info); $i++) { 	
	$sites_infoid = $sites_info[$i];
	$j = $i+1;
	$sql = "update sites_info set cam_ip='".$DVRIP[$j]."',port='".$port[$j]."',cam_name='".$AddSite_DVRName[$j]."',username='' where id='".$sites_infoid."'";
}


//$location="ram/";
$imgdir = $location;
  
if(move_uploaded_file($tmp_name,$location)){
	
}else{
	$imgdir =$oldimg;
}

$SQ="select * from site_attachment where site_id='".$sn."'";
$sqrun=mysqli_query($conn,$SQ);
$counts=mysqli_num_rows($sqrun);

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

if($counts >0){
	
	//ATMShortName='$ATMShortName',SiteAddress='".$SiteAddress."',
	
$sql="update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID' ,
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='".$_SESSION['name']."',site_remark='".$remark."',PanelIP='".$PanelsIP."',DVR_Model_num='".$DVR_Model_num."',Router_Model_num='".$Router_Model_num."'   where SN='$sn'";
$result=mysqli_query($conn,$sql);
$result10=mysqli_query($cn,$sql);
$resultOnline=mysqli_query($cont,$sql);

$qDVR_health="update dvr_health set ip='".$DVRIP."' , dvrtype='".$DVRName."',live='".$live."' where atmid='".$ATMID."' ";
mysqli_query($cont,$qDVR_health);
mysqli_query($cn,$qDVR_health);
mysqli_query($conn,$qDVR_health);

$qryPanel_health="update panel_health set ip='".$PanelsIP."' , panelName='".$Panel_Make."',panelid='".$NewPanelID."' where atmid='".$ATMID."' ";
mysqli_query($cont,$qryPanel_health);
mysqli_query($cn,$qryPanel_health);
mysqli_query($conn,$qryPanel_health);


//echo $result;
//echo $sql;
$sql2="update site_attachment set files='".$imgdir."',installation_dt='".$insdates.' '.$t."' where site_id='".$sn."'";
$runsql2=mysqli_query($conn,$sql2);
$result2_10=mysqli_query($cn,$sql2);
$result2_Online=mysqli_query($cont,$sql2);


//echo $sql;

$sql3="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id,editby)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','$live','$curentdt','$insdates.$t','$engname','".$addbysite."','$remark','".$sn."','".$_SESSION['name']."')";
//echo $sql3;
$result3=mysqli_query($conn,$sql3);
$result3=mysqli_query($cn,$sql3);
$result3=mysqli_query($cont,$sql3);

$gsm="select TwoWayNumber from esurvsites where ATM_ID='".$ATMID."'";
//echo $gsm;
$gsmrun=mysqli_query($conn,$gsm);
$gnum=mysqli_num_rows($gsmrun);

if($gnum >0){
	$gsmupdate="update esurvsites set TwoWayNumber='".$gsmnum."' where ATM_ID='".$ATMID."'";
	$gsmupdaterun=mysqli_query($conn,$gsmupdate);
	$gsmupdaterun10=mysqli_query($cn,$gsmupdate);
	$gsmupdaterunOnline=mysqli_query($cont,$gsmupdate);
}else{
	$gsmins="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$gsmnum."')";
	$gsminsrun=mysqli_query($conn,$gsmins);
	$gsminsrun10=mysqli_query($cn,$gsmins);
	$gsminsrunOnline=mysqli_query($cont,$gsmins);
	
}
}


else{
	
	$sql="update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID',
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='".$_SESSION['name']."',site_remark='".$remark."',PanelIP='".$PanelsIP."',DVR_Model_num='".$DVR_Model_num."',Router_Model_num='".$Router_Model_num."' where SN='$sn'";


$result=mysqli_query($conn,$sql);
$result10=mysqli_query($cn,$sql);
$resultOnline=mysqli_query($cont,$sql);

$qryDvr_health="update dvr_health set ip='".$DVRIP."' , dvrtype='".$DVRName."',live='".$live."' where atmid='".$ATMID."' ";
mysqli_query($cont,$qryDvr_health);
mysqli_query($cn,$qryDvr_health);
mysqli_query($conn,$qryDvr_health);

$qryPanel_health="update panel_health set ip='".$PanelsIP."' , panelName='".$Panel_Make."',panelid='".$NewPanelID."' where atmid='".$ATMID."' ";
mysqli_query($cont,$qryPanel_health);
mysqli_query($cn,$qryPanel_health);
mysqli_query($conn,$qryPanel_health);


$sql2="insert into  site_attachment(site_id,files,installation_dt)values('".$sn."','".$imgdir."','".$insdates.' '.$t."')";
$runsql2=mysqli_query($conn,$sql2);
$runsql2_10=mysqli_query($cn,$sql2);
$runsql2_Online=mysqli_query($cont,$sql2);	

$sql3="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id,editby)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','$live','$curentdt','$insdates.$t','$engname','".$addbysite."','$remark','".$sn."','".$_SESSION['name']."')";
//echo $sql;
$result3=mysqli_query($conn,$sql3);
$result3_10=mysqli_query($cn,$sql3);
$result3_Online=mysqli_query($cont,$sql3);

$gsm="select TwoWayNumber from esurvsites where ATM_ID='".$ATMID."'";
//echo $gsm;
$gsmrun=mysqli_query($conn,$gsm);
$gnum=mysqli_num_rows($gsmrun);

if($gnum >0){
	$gsmupdate="update esurvsites set TwoWayNumber='".$gsmnum."' where ATM_ID='".$ATMID."'";
	$gsmupdaterun=mysqli_query($conn,$gsmupdate);
	$gsmupdaterun10=mysqli_query($cn,$gsmupdate);
	$gsmupdaterunOnline=mysqli_query($cont,$gsmupdate);
}else{
	$gsmins="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$gsmnum."')";
	$gsminsrun=mysqli_query($conn,$gsmins);
	$gsminsrun10=mysqli_query($cn,$gsmins);
	$gsminsrunOnline=mysqli_query($cont,$gsmins);
	
}


	//$broadbanddetails="update broadbanddetails set NetworkType='".$NetworkType."',ProviderName='".$ProviderName."',ProviderEmail='".$ProviderEmail."',ProviderMobile='".$ProviderMobile."',InternetPlans='".$InternetPlans."',BroadbandAmount='".$BroadbandAmount."',BroadbandAddress='".$BroadbandAddress."',RouterIp='".$RouterIp."',MonthPlans='".$MonthPlans."',StartInternetDate='".$StartInternetDate."' where site_id='".$site_id."' ";
	//$resultBroad=mysqli_query($conn,$broadbanddetails);



}
//echo $sql2;
if($result!=""){
	?>
        <script>
           alert("register successfully");
           window.open("viewsite.php", "_self");
        </script>
		<?php 
}
?>