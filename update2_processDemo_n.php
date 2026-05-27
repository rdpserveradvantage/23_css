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
$site_id=$_POST['sn'];
$NetworkType=$_POST['NetworkType'];
$ProviderName=$_POST['ProviderName'];
$ProviderEmail=$_POST['ProviderEmail'];
$ProviderMobile=$_POST['ProviderMobile'];
$InternetPlans=$_POST['InternetPlans'];
$MonthPlans=$_POST['MonthPlans'];
$StartInternetDate=$_POST['StartInternetDate'];
$BroadbandAmount=$_POST['BroadbandAmount'];
$BroadbandAddress=$_POST['BroadbandAddress'];
$RouterIp=$_POST['AddSite_RouterIp'];
$FreeMonthPlans=$_POST['FreeMonthPlans'];

$created_at = date('Y-m-d'); 
$routebrand = $_POST['router_brand'];
$router_id = $_POST['router_id'];
$simnumber= $_POST['sim_number'];
$simowner = $_POST['sim_owner'];


///////////////////////////////////




$check_sql = mysqli_query($conn,"select * from sites_details where site_id = '".$site_id."' and project='1'");
if($check_sql_result = mysqli_fetch_assoc($check_sql)){

    $query = "update sites_details set routebrand='".$routebrand."' , router_id='".$router_id."' , simnumber='".$simnumber."', simowner='".$simowner."' where site_id = '".$site_id."' and project='1'"; 
}else{
    $query = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at,project) values('".$site_id."', '".$routebrand."', '".$router_id."', '".$simnumber."', '".$simowner."', '1', '".$created_at."','1')" ; 
}

mysqli_query($conn,$query);


//=========For get Expiry Date=============


function addTime($time, $days, $months, $years)
{
    // Convert unix time to date format
    if (is_numeric($time))
    $time = date('Y-m-d', $time);

    try
    {
        $date_time = new DateTime($time);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        exit;
    }

    if ($days)
    $date_time->add(new DateInterval('P'.$days.'D'));

    // Preserve day number
    if ($months or $years)
    $old_day = $date_time->format('d');

    if ($months)
    $date_time->add(new DateInterval('P'.$months.'M'));

    if ($years)
    $date_time->add(new DateInterval('P'.$years.'Y'));

    // Patch for adding months or years    
    if ($months or $years)
    {
        $new_day = $date_time->format("d");

        // The day is changed - set the last day of the previous month
        if ($old_day != $new_day)
        $date_time->sub(new DateInterval('P'.$new_day.'D'));
    }
    // You can chage returned format here
    return $date_time->format('Y-m-d');
}


$TotalMonth=$MonthPlans+$FreeMonthPlans;
$ExpiryDate=addTime($StartInternetDate, 0, $TotalMonth, 0); 


///////////////////////////////////////////

$CtsLocalBranch=$_POST['AddSite_CtsLocalBranch'];
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

$now = date('Y-m-d H:i:s');
if($counts >0){
	
	//ATMShortName='$ATMShortName',SiteAddress='".$SiteAddress."',
	
$sql="update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID' ,
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='".$_SESSION['name']."',site_remark='".$remark."',PanelIP='".$PanelsIP."',DVR_Model_num='".$DVR_Model_num."',Router_Model_num='".$Router_Model_num."',CTS_LocalBranch='".$CtsLocalBranch."',RouterIp='".$RouterIp."'  where SN='$sn'";

$sql10="update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID' ,
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='".$_SESSION['name']."',site_remark='".$remark."',PanelIP='".$PanelsIP."',DVR_Model_num='".$DVR_Model_num."',Router_Model_num='".$Router_Model_num."',CTS_LocalBranch='".$CtsLocalBranch."',RouterIp='".$RouterIp."',last_modified='".$now."' where SN='$sn'";

//echo $sql;
$result=mysqli_query($conn,$sql);
$result10=mysqli_query($cn,$sql10);
if(!$result10){
	mysqli_query($conn,"update sites set modify=2 where ATMID='$ATMID'");
}
//$resultOnline=mysqli_query($cont,$sql);

$qDVR_health="update dvr_health set ip='".$DVRIP."' , dvrtype='".$DVRName."',live='".$live."',atmid='".$ATMID."' where atmid='".$ATMID."' ";
mysqli_query($conn,$qDVR_health);
mysqli_query($cn,$qDVR_health);

$qryPanel_health="update panel_health set ip='".$PanelsIP."' , panelName='".$Panel_Make."',panelid='".$NewPanelID."',atmid='".$ATMID."' where atmid='".$ATMID."' ";
mysqli_query($conn,$qryPanel_health);
mysqli_query($cn,$qryPanel_health);

$sql2="update site_attachment set files='".$imgdir."',installation_dt='".$insdates.' '.$t."' where site_id='".$sn."'";
$runsql2=mysqli_query($conn,$sql2);
$result2_10=mysqli_query($cn,$sql2);
//$result2_Online=mysqli_query($cont,$sql2);


//echo $sql;

$sql3="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id,editby)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','$live','$curentdt','$insdates.$t','$engname','".$addbysite."','$remark','".$sn."','".$_SESSION['name']."')";
//echo $sql3;
$result3=mysqli_query($conn,$sql3);
$result3=mysqli_query($cn,$sql3);
//$result3=mysqli_query($cont,$sql3);

$gsm="select TwoWayNumber from esurvsites where ATM_ID='".$ATMID."'";
//echo $gsm;
$gsmrun=mysqli_query($conn,$gsm);
$gnum=mysqli_num_rows($gsmrun);

if($gnum >0){
	$gsmupdate="update esurvsites set TwoWayNumber='".$gsmnum."' where ATM_ID='".$ATMID."'";
	$gsmupdaterun=mysqli_query($conn,$gsmupdate);
	mysqli_query($cn,$gsmupdate);
	//$gsmupdaterunOnline=mysqli_query($cont,$gsmupdate);
}else{
	$gsmins="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$gsmnum."')";
	$gsminsrun=mysqli_query($conn,$gsmins);
	mysqli_query($cn,$gsmins);
	//$gsminsrunOnline=mysqli_query($cont,$gsmins);
	
}
}


else{
	
	$sql="update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID',
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='".$_SESSION['name']."',site_remark='".$remark."',PanelIP='".$PanelsIP."',DVR_Model_num='".$DVR_Model_num."',Router_Model_num='".$Router_Model_num."',RouterIp='".$RouterIp."' where SN='$sn'";

$sql10="update sites set Status='$Status',Phase='$Phase',Customer='$Customer',Bank='$Bank',ATMID='$ATMID',ATMID_2='$ATMID_2',ATMID_3='$ATMID_3',ATMID_4='$ATMID_4',
TrackerNo='$TrackerNo',City='$City',State='$fetch[0]',Zone='$Zone',Panel_Make='$Panel_Make',OldPanelID='$OldPanelID',
NewPanelID='$NewPanelID',DVRIP='$DVRIP',DVRName='$DVRName',UserName='$UserName',Password='$Password',live='$live',eng_name='$engname',editby='".$_SESSION['name']."',site_remark='".$remark."',PanelIP='".$PanelsIP."',DVR_Model_num='".$DVR_Model_num."',Router_Model_num='".$Router_Model_num."',RouterIp='".$RouterIp."',last_modified='".$now."' where SN='$sn'";
//echo $sql;
$result=mysqli_query($conn,$sql);
$result10=mysqli_query($cn,$sql10);
if(!$result10){
	mysqli_query($conn,"update sites set modify=2 where ATMID='$ATMID'");
}
//$resultOnline=mysqli_query($cont,$sql);

$qryDvr_health="update dvr_health set ip='".$DVRIP."' , dvrtype='".$DVRName."',live='".$live."',atmid='".$ATMID."' where atmid='".$ATMID."' ";
//mysqli_query($cont,$qryDvr_health);
mysqli_query($cn,$qryDvr_health);
mysqli_query($conn,$qryDvr_health);

$qryPanel_health="update panel_health set ip='".$PanelsIP."' , panelName='".$Panel_Make."',panelid='".$NewPanelID."',atmid='".$ATMID."' where atmid='".$ATMID."' ";
//mysqli_query($cont,$qryPanel_health);
mysqli_query($cn,$qryPanel_health);
mysqli_query($conn,$qryPanel_health);

$sql2="insert into  site_attachment(site_id,files,installation_dt)values('".$sn."','".$imgdir."','".$insdates.' '.$t."')";
$runsql2=mysqli_query($conn,$sql2);
$runsql2_10=mysqli_query($cn,$sql2);
//$runsql2_Online=mysqli_query($cont,$sql2);	

$sql3="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id,editby)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','$live','$curentdt','$insdates.$t','$engname','".$addbysite."','$remark','".$sn."','".$_SESSION['name']."')";
//echo $sql;
$result3=mysqli_query($conn,$sql3);
$result3_10=mysqli_query($cn,$sql3);
//$result3_Online=mysqli_query($cont,$sql3);

$gsm="select TwoWayNumber from esurvsites where ATM_ID='".$ATMID."'";
//echo $gsm;
$gsmrun=mysqli_query($conn,$gsm);
$gnum=mysqli_num_rows($gsmrun);

if($gnum >0){
	$gsmupdate="update esurvsites set TwoWayNumber='".$gsmnum."' where ATM_ID='".$ATMID."'";
	$gsmupdaterun=mysqli_query($conn,$gsmupdate);
	$gsmupdaterun10=mysqli_query($cn,$gsmupdate);
	//$gsmupdaterunOnline=mysqli_query($cont,$gsmupdate);
}else{
	$gsmins="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$gsmnum."')";
	$gsminsrun=mysqli_query($conn,$gsmins);
	$gsminsrun10=mysqli_query($cn,$gsmins);
	//$gsminsrunOnline=mysqli_query($cont,$gsmins);
	
}


}


$brodChkAvilable=mysqli_query($conn,"select atmid from broadbanddetails where atmid='".$ATMID."' ");
$brodChkAvilableNum=mysqli_num_rows($brodChkAvilable);
$broadbanddetails="";

if($brodChkAvilableNum>0){

	$broadbanddetails="update broadbanddetails set NetworkType='".$NetworkType."',ProviderName='".$ProviderName."',ProviderEmail='".$ProviderEmail."',ProviderMobile='".$ProviderMobile."',InternetPlans='".$InternetPlans."',BroadbandAmount='".$BroadbandAmount."',BroadbandAddress='".$BroadbandAddress."',MonthPlans='".$MonthPlans."',StartInternetDate='".$StartInternetDate."',FreeMonthPlans='".$FreeMonthPlans."',ExpiryDate='".$ExpiryDate."' where atmid='".$ATMID."' ";
    $resultBroad=mysqli_query($conn,$broadbanddetails);
}else{
	$broadbanddetails="insert into  broadbanddetails (site_id,NetworkType,ProviderName,ProviderEmail,ProviderMobile,InternetPlans,BroadbandAmount,BroadbandAddress,MonthPlans,StartInternetDate,atmid,FreeMonthPlans,ExpiryDate) values('".$site_id."','".$NetworkType."','".$ProviderName."','".$ProviderEmail."','".$ProviderMobile."','".$InternetPlans."','".$BroadbandAmount."','".$BroadbandAddress.",'".$MonthPlans."','".$StartInternetDate."','".$ATMID."','".$FreeMonthPlans."','".$ExpiryDate."') ";
    $resultBroad=mysqli_query($conn,$broadbanddetails);
}


//echo $sql2;
if($result!=""){
	?>
        <script>
           alert("Updated successfully");
           window.open("viewsite.php", "_self");
        </script>
		<?php 
}
?>