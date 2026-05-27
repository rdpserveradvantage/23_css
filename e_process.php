<?php session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


error_reporting(0);

// var_dump($_REQUEST);

		  $project=$_REQUEST['project'];


// return ; 



if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{ include 'config.php';?>

    <html>
       <head>
         <body>
		 
		 <?php

$routebrand = $_REQUEST['router_brand'];
$router_id = $_REQUEST['router_id'];
$simnumber= $_REQUEST['sim_number'];
$simowner = $_REQUEST['sim_owner'];



if($project=="1" || $project=="10"){ 

if(isset($_REQUEST['port'])){
$port = $_REQUEST['port'];
}else{
	$port = "";
}
$created_at = date('Y-m-d'); 
$RouterIP=$_REQUEST['AddSite_RouterIP'];
$CtsLocalBranch=$_REQUEST['AddSite_CtsLocalBranch'];
$Status=$_REQUEST['AddSite_Status'];
$Phase=$_REQUEST['AddSite_Phase'];
$Customer=$_REQUEST['AddSite_Customer'];
$DVRIP=$_REQUEST['AddSite_DVRIP'];
$DVRName=$_REQUEST['AddSite_DVRName'];
$UserName=$_REQUEST['AddSite_UserName'];
$Password=$_REQUEST['AddSite_Password'];

$ATMID=$_REQUEST['AddSite_ATMID'];
$ATMID_2=$_REQUEST['AddSite_ATMID_2'];
$ATMID_3=$_REQUEST['AddSite_ATMID_3'];
$ATMID_4=$_REQUEST['AddSite_ATMID_4'];
$TrackerNo=$_REQUEST['AddSite_TrackerNo'];
$ATMShortName=$_REQUEST['AddSite_ATMShortName'];
$SiteAddress=$_REQUEST['AddSite_SiteAddress'];
$City=$_REQUEST['AddSite_City'];
$GSM=$_REQUEST['AddSite_GSM'];
$State=$_REQUEST['AddSite_State'];
$Zone=$_REQUEST['AddSite_Zone'];
$Panel_Make=$_REQUEST['AddSite_Panel_Make'];
$OldPanelID=$_REQUEST['AddSite_OldPanelID'];
$NewPanelID=$_REQUEST['AddSite_NewPanelID'];
$PanelsIP=$_REQUEST['AddSite_PanelsIP'];
$DVR_Model_num=$_REQUEST['AddSite_DVR_Model_num'];
$Router_Model_num=$_REQUEST['AddSite_Router_Model_num'];
$engname=$_REQUEST['AddSite_engname'];

$Bank=$_REQUEST['AddSite_Bank'];

$installationDate = $_REQUEST['installationDate'];

$AddSite_PPS = $_REQUEST['AddSite_PPS'];

date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$instdt=$_REQUEST['AddSite_date'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}
$remark=$_REQUEST['AddSite_Remark'];

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$newname="";
$image_name='';
$maxsize='2140';
//$_FILES['email_cpy']['name'];
$size=($_FILES['AddSite_email_cpy']['size']/1024);

if($_FILES['AddSite_email_cpy']['name']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{
echo "Your file size is ".$size."File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
$error++;
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['AddSite_email_cpy']['name']; 

//echo $fichier;
 function getExtension1($str)
 {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
 }
	
	//echo $fichier;
	
if($fichier){
//echo "hi" ;
$filename = stripslashes($_FILES['AddSite_email_cpy']['name']);
//echo $filename;
			//get the extension of the file in a lower case format
				$extension = getExtension1($filename);
				$extension = strtolower($extension);
				//echo $extension;
				$image_name=time().'.'.$extension;
				//echo $image_name;
$newname="ram/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['AddSite_email_cpy']['tmp_name'], $newname);


if (!$copied) 
{
	echo "<h1>Copy unsuccessfull!</h1>";
		$error++;
}
}

//echo $newname;
}
}

//mysqli_query($conn,"LOCK TABLES Sites WRITE");


//$chkAvailable= mysqli_query($conn,"select ATMID from Sites where ATMID='".$ATMID."' or NewPanelID='".$NewPanelID."' or PanelIP='".$PanelsIP."' or DVRIP='".$DVRIP."' and live Not IN ('N','Y') ");
// echo "select ATMID from Sites where ATMID='".$ATMID."' or NewPanelID='".$NewPanelID."' or PanelIP='".$PanelsIP."' or DVRIP='".$DVRIP[0]."'";

echo "select ATMID from Sites where ATMID='".$ATMID."' or NewPanelID='".$NewPanelID."' or PanelIP='".$PanelsIP."' or DVRIP='".$DVRIP[0]."'";
 $chkAvailable= mysqli_query($conn,"select ATMID from Sites where ATMID='".$ATMID."' or NewPanelID='".$NewPanelID."' or PanelIP='".$PanelsIP."' or DVRIP='".$DVRIP[0]."'");
$n=mysqli_num_rows($chkAvailable);
  
   
   if($n >"0")   {
 echo "<script>alert('Error : Duplicate Site ! ')</script>";
}else{

echo $sql="insert into sites(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP,CTS_LocalBranch,RouterIp,last_modified,installationDate,panel_power_connection,live_date)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP[0]','$DVRName[0]','$UserName[0]','$Password[0]','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','$DVR_Model_num','$Router_Model_num','$PanelsIP','$CtsLocalBranch','$RouterIP',1,'".$installationDate."','".$AddSite_PPS."', '".$created_at."')";
//echo $sql;
$result2=mysqli_query($conn,$sql);
$last2=mysqli_insert_id($conn);

$site_details = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at,project) values('".$last2."', '".$routebrand."', '".$router_id."', '".$simnumber."', '".$simowner."', '1', '".$created_at."','".$project."')" ; 

mysqli_query($conn,$site_details);

if($Bank=='PNB' || $Bank=='SBI TOM 2'){

        mysqli_query($con,"update sites_info set status=0 where site_id='".$last2."'");

		for ($i=1; $i < count($DVRIP) ; $i++) { 
			$j = $i-1;
			$add_banksql = "insert into sites_info(site_id,atmid,cam_ip,cam_name,username,password,created_at,status,port) values('".$last2."','".$ATMID."','".$DVRIP[$i]."','".$DVRName[$i]."','".$UserName[$i]."','".$Password[$i]."','".$curentdt."','1','".$port[$j]."')";
			mysqli_query($conn,$add_banksql);
	}
}




// echo $last2.'<br>';
//  insert in 192.168.0.11 =======================

if($last2){
	echo 'Success<br>';
	$sql_dvrhealth="insert into `dvr_health`(ip,atmid,dvrtype,live) values('$DVRIP[0]','$ATMID','$DVRName[0]','P')";
	// echo "insert into `dvr_health`(ip,atmid,dvrtype,live) values('$DVRIP','$ATMID','$DVRName','P')<br>";
	mysqli_query($conn,$sql_dvrhealth);
	
//	$sql_panelhealth="insert into `panel_health`(ip,atmid,panelName,panelid) values('$PanelsIP','$ATMID','$Panel_Make','$NewPanelID')";
//	echo "insert into `panel_health`(ip,atmid,panelName,panelid) values('$PanelsIP','$ATMID','$Panel_Make','$NewPanelID')<br>";
//	mysqli_query($conn,$sql_panelhealth);
    
    $sql2="insert into site_Attachment(site_id,mail_attachment) values('".$last2."','".$newname."')";
    $result2=mysqli_query($conn,$sql2);
	
	$sql3="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP[0]','$DVRName[0]','$UserName[0]','$Password[0]','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','".$last2."')";
$result3=mysqli_query($conn,$sql3);
 
$sql4="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$GSM."')" ;
$runsql4=mysqli_query($conn,$sql4);
} 

/*if($cn){
	echo "came In<br>";
$sql10="insert into sites(SN,Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP,CTS_LocalBranch,RouterIp,last_modified)
values('$last2','$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','$DVR_Model_num','$Router_Model_num','$PanelsIP','$CtsLocalBranch','$RouterIP',1)";

$result1=mysqli_query($cn,$sql10);
if($result1) {
	echo "done";
	mysqli_query($conn,"update sites set last_modified=0 where ATMID='".$ATMID."'");
	$last1=mysqli_insert_id($cn);
}
else {
	 echo "No";	 
}


//  insert in 192.168.0.10 =======================
if($last1){
	Echo "Success 10<br>";
	$sql_dvrhealth="insert into `dvr_health`(ip,atmid,dvrtype,live) values('$DVRIP','$ATMID','$DVRName','P')";
	mysqli_query($cn,$sql_dvrhealth);
	
	$sql_panelhealth="insert into `panel_health`(ip,atmid,panelName,panelid) values('$PanelsIP','$ATMID','$Panel_Make','$NewPanelID')";
	mysqli_query($cn,$sql_panelhealth);
	
	$sqlcpy="insert into site_Attachment(site_id,mail_attachment) values('".$last1."','".$newname."')";
	$resultcpy=mysqli_query($cn,$sqlcpy);
	
	$sqlQcpy="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id)
    values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','".$last1."')";
    $resultQcpy=mysqli_query($cn,$sqlQcpy);
 
    $sql4cpy="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$GSM."')" ;
    $runsql4cpy=mysqli_query($cn,$sql4cpy);
	
}

}*/

//  insert in online Server  =======================
/*
if($last3){
    
	
    $resultdvr=mysqli_query($cont,"insert into dvr_health(ip,cdate,atmid,dvrtype,live) values('".$DVRIP."','".$curentdt."','".$ATMID."','".$DVRName."','P')");
	
	
    $resultpanel=mysqli_query($cont,"insert into panel_health(ip,panelName,panelid,atmid,date) values('".$PanelsIP."','".$Panel_Make."','".$NewPanelID."','".$ATMID."','".$curentdt."')");
	
	
    $result3=mysqli_query($cont,"insert into site_Attachment(site_id,mail_attachment) values('".$last3."','".$newname."')");
	
	$sql4="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','".$last3."')";
$result4=mysqli_query($cont,$sql4);
 
$sql5="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$GSM."')" ;
$runsql5=mysqli_query($cont,$sql5);
} */

		
if($last2){

?>
<script>
alert("registered successfully");
window.open("Project_Add.php", "_self");
</script>
<?php } 

}

 //mysqli_query($conn,"UNLOCK TABLES");


 ?>

</body>
</html>




<!--////////////////////////////////////////////////// RNM Form Code End //////////////////////////////////////////////-->


<!--///////////////////////////////////////////////// DVR Form Code Start ////////////////////////////////////////////-->
<?php 

 }else if($project=="2"){
	 
$datetime = date('Y-m-d h:i:s');
	$userid = $_SESSION['id'];
$Status=$_REQUEST['AddDVR_Status'];
$Phase=$_REQUEST['AddDVR_Phase'];
$Customer=$_REQUEST['AddDVR_Customer'];
$Bank=$_REQUEST['AddDVR_Bank'];
$ATMID=$_REQUEST['AddDVR_ATMID'];
$ATMID_2=$_REQUEST['AddDVR_ATMID_2'];
$ATMID_3=$_REQUEST['AddDVR_ATMID_3'];
$ATMID_4=$_REQUEST['AddDVR_ATMID_4'];
$TrackerNo=$_REQUEST['AddDVR_TrackerNo'];
$ATMShortName=$_REQUEST['AddDVR_ATMShortName'];
$SiteAddress=$_REQUEST['AddDVR_SiteAddress'];
$City=$_REQUEST['AddDVR_City'];
$CTS_UserName=$_REQUEST['AddDVR_UserName'];
$CTS_Password=$_REQUEST['AddDVR_Password'];
$State=$_REQUEST['AddDVR_State'];
$Zone=$_REQUEST['AddDVR_Zone'];
$CTSLocalBranch=$_REQUEST['AddDVR_LocalBranch'];
$CTS_BM_Name=$_REQUEST['AddDVR_BM_Name'];
$CTS_BM_Number=$_REQUEST['AddDVR_BM_Number'];
$install_Status=$_REQUEST['AddDVR_install_Status'];
$Cloud_engineerName = $_REQUEST['Cloud_engineerName'];
$Cloud_livesnapshots = $_REQUEST['Cloud_livesnapshots'];
date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");


$installationDate = $_POST['installationDate'];
$old_atmid = $_REQUEST['old_atmid'];

$instdt=$_REQUEST['AddDVR_date'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}


$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);



$chkAvailable= mysqli_query($conn,"select ATMID from dvrsite where ATMID='".$ATMID."' ");
$n=mysqli_num_rows($chkAvailable);
   
if($n > "0")   {
 echo "<script>alert('Error : Duplicate Site ! ')</script>";
}else{

$sql="insert into dvrsite(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,UserName,Password,live,current_dt,mailreceive_dt,addedby,site_remark,DVR_Model_num,DVR_Serial_num,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,install_Status,last_modified,installationDate,old_atmid)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$instdt.$t','".$_SESSION['name']."','','','','','','','','','','".$CTSLocalBranch."','".$CTS_BM_Name."','".$CTS_BM_Number."','".$install_Status."','$curentdt','$installationDate','$old_atmid')";


//$sql="insert into sitesd(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,UserName,Password,live,current_dt,mailreceive_dt,addedby,site_remark,DVR_Model_num,DVR_Serial_num,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,install_Status,Project_Id)
//values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$instdt.$t','".$_SESSION['name']."','','','','','','','','','','".$CTSLocalBranch."','".$CTS_BM_Name."','".$CTS_BM_Number."','".$install_Status."','$project')";
//$resultcpy=mysqli_query($cn,$sql);
$result=mysqli_query($conn,$sql);

$last=mysqli_insert_id($conn);

$site_details = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at) values('".$last."', '".$routebrand."', '".$router_id."', '".$simnumber."', '".$simowner."', '1', '".$created_at."')" ; 

mysqli_query($conn,$site_details);


$allfiles = array();

if (!empty($_FILES['Cloud_livesnapshots']['name'][0])) {
    $destinationFolder = 'dvrdetails/';
    $totalFiles = count($_FILES['Cloud_livesnapshots']['name']);
    $allfiles = array();

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['Cloud_livesnapshots']['name'][$i];
        $fileTmpPath = $_FILES['Cloud_livesnapshots']['tmp_name'][$i];
       
        if ($fileName !== '') {
            $newFileName = uniqid() . '_' . $fileName;

            $destinationFilePath = $destinationFolder . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
                $allfiles[] = $destinationFilePath;
            } 
        }
    }
} 

$allfiles = json_encode($allfiles);
$Cloud_livesnapshots = $allfiles ;

$details_sql = "insert into dvronline_details(dvrid,tracker,bmName,engineerName,snapshots,status,created_at,created_by,statusDate) values('".$last."','".$TrackerNo."','".$CTS_BM_Name."','".$Cloud_engineerName."','".$Cloud_livesnapshots."',1,'".$datetime."','".$userid."','".$installationDate."')";

mysqli_query($conn,$details_sql);



if($cn){
	$sql10="insert into dvrsite(SN,Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,UserName,Password,live,current_dt,mailreceive_dt,addedby,site_remark,DVR_Model_num,DVR_Serial_num,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,install_Status)
values('$last','$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$instdt.$t','".$_SESSION['name']."','','','','','','','','','','".$CTSLocalBranch."','".$CTS_BM_Name."','".$CTS_BM_Number."','".$install_Status."')";

$result10=mysqli_query($cn,$sql10);
if($result10) {
	echo "done";
	mysqli_query($conn,"update dvrsite set last_modified=0 where ATMID='".$ATMID."'");
	//$last10=mysqli_insert_id($cn);
}
}

//  insert in online Server  =======================
/*$sqlSarServer="insert into axissite(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,UserName,Password,live,current_dt,mailreceive_dt,addedby,site_remark,DVR_Model_num,DVR_Serial_num,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,install_Status)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$instdt.$t','".$_SESSION['name']."','','','','','','','','','','".$CTSLocalBranch."','".$CTS_BM_Name."','".$CTS_BM_Number."','".$install_Status."')";
$result_SARserver=mysqli_query($cont,$sqlSarServer);

$sqlSarServer2="insert into axisdvr_health(ip,atmid,dvrttype,live)
values('$DVRIP','$ATMID','','P')";
$result_SARserver2=mysqli_query($cont,$sqlSarServer2);
*/
	
	

if($last){
?>
<script>
alert("Added successfully");
window.open("Project_Add.php", "_self");
        </script>
<?php }else{ ?>
<script>
alert("error");
</script> 
</body>
</html>
 <?php }  }  ?>

<!--////////////////////////////////////////////////// DVR Form Code End //////////////////////////////////////////////-->



<!--///////////////////////////////////////////////// DVR Online Form Code Start ////////////////////////////////////////////-->	
	









<?php }









else if($project=="3"){




	$datetime = date('Y-m-d h:i:s');
	$userid = $_SESSION['id'];
	$ATMID=$_REQUEST['Cloud_ATMID'];
	$ATMID2=$_REQUEST['Cloud_ATMID2'];

	$SiteAddress=$_REQUEST['Cloud_SiteAddress'];
	$ATMShortName=$_REQUEST['Cloud_Location'];
	$State=$_REQUEST['Cloud_State'];
	$DVRIP=$_REQUEST['Cloud_DVRIP'];
	$Router_Model_num=$_REQUEST['Cloud_RourtID'];
	$CTS_UserName=$_REQUEST['Cloud_UserName'];
    $CTS_Password=$_REQUEST['Cloud_Password'];
	$Status=$_REQUEST['Cloud_Status'];  
    $dvrname=$_REQUEST['Cloud_dvrname'];
	$Customer=$_REQUEST['Cloud_Customer'];
	$bank = $_REQUEST['Bank'];
	$remark = $_REQUEST['AddSite_Remark'];



	$Cloud_OldATM = $_POST['Cloud_OldATM'];
	$Cloud_Zone = $_REQUEST['Cloud_Zone'];
	$Cloud_City = $_REQUEST['Cloud_City'];
	$Cloud_State = $_REQUEST['Cloud_State'];


$Cloud_trackerno = $_POST['Cloud_trackerno'];
$Cloud_bmname = $_POST['Cloud_bmname'];
$Cloud_engineerName = $_POST['Cloud_engineerName'];
$Cloud_livesnapshots = $_POST['Cloud_livesnapshots'];
$statusDate = $_POST['statusDate'];
$installationDate = $_POST['installationDate'];


date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

/*$instdt=$_REQUEST['date'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}*/

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$chkAvailable= mysqli_query($conn,"select ATMID from dvronline where ATMID='".$ATMID."' ");
$n=mysqli_num_rows($chkAvailable);
   
if($n>"0")   {
 echo "<script>alert('Error : Duplicate Site ! ')</script>";
}else{


 $sql="insert into dvronline(ATMID,ATMID2,Address,Location,State,IPAddress,`Rourt ID`,`LiveDate`,UserName,Password,Status,dvrname,customer,Bank,remark,zone,city,old_atm,installationDate)values('".$ATMID."','".$ATMID2."','".$SiteAddress."','".$ATMShortName."','".$fetch['state']."','".$DVRIP."','".$Router_Model_num."','".$curentdt."','".$CTS_UserName."','".$CTS_Password."','".$Status."','".$dvrname."','".$Customer."','".$bank."','".$remark."','".$Cloud_Zone."','".$Cloud_City."','".$Cloud_OldATM."','".$installationDate."')";

//$sql="insert into sitesd(Status,Customer,ATMID,ATMShortName,SiteAddress,State,UserName,Password,live,current_dt,DVRIP,Router_Model_num,DVRName,addedby,Project_Id)values('$Status','$Customer','$ATMID','$ATMShortName','$SiteAddress','".$fetch[0]."','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$DVRIP','$Router_Model_num','$dvrname','".$_SESSION['name']."','$project')";
//mysqli_query($cn,$sql);

//echo $sql; die;

if($result=mysqli_query($conn,$sql)){

$last=mysqli_insert_id($conn);
$site_details = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at) values('".$last."', '".$routebrand."', '".$router_id."', '".$simnumber."', '".$simowner."', '1', '".$created_at."')" ; 

mysqli_query($conn,$site_details);

$allfiles = array();

if (!empty($_FILES['Cloud_livesnapshots']['name'][0])) {
    $destinationFolder = 'dvrdetails/';
    $totalFiles = count($_FILES['Cloud_livesnapshots']['name']);
    $allfiles = array();

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['Cloud_livesnapshots']['name'][$i];
        $fileTmpPath = $_FILES['Cloud_livesnapshots']['tmp_name'][$i];
       
        if ($fileName !== '') {
            $newFileName = uniqid() . '_' . $fileName;

            $destinationFilePath = $destinationFolder . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
                $allfiles[] = $destinationFilePath;
            } 
        }
    }
} 

$allfiles = json_encode($allfiles);
$Cloud_livesnapshots = $allfiles ;

$details_sql = "insert into dvronline_details(dvrid,tracker,bmName,engineerName,snapshots,status,created_at,created_by,statusDate) values('".$last."','".$Cloud_trackerno."','".$Cloud_bmname."','".$Cloud_engineerName."','".$Cloud_livesnapshots."',1,'".$datetime."','".$userid."','".$statusDate."')";

mysqli_query($conn,$details_sql);
}

if($last){
?>
<script>
alert("Added successfully");
window.open("Project_Add.php", "_self");
</script>

</body>
</html>

<?php
}else{
	  echo("Error description: " . $conn -> error);

 ?>
<script>
	alert('Error');
</script>
<?php } 
}	
} 












else if($project=="4"){




	$datetime = date('Y-m-d h:i:s');
	$userid = $_SESSION['id'];
	$ATMID=$_REQUEST['Cloud_ATMID'];
	$ATMID2=$_REQUEST['Cloud_ATMID2'];

	$SiteAddress=$_REQUEST['Cloud_SiteAddress'];
	$ATMShortName=$_REQUEST['Cloud_Location'];
	$State=$_REQUEST['Cloud_State'];
	$DVRIP=$_REQUEST['Cloud_DVRIP'];
	$Router_Model_num=$_REQUEST['Cloud_RourtID'];
	$CTS_UserName=$_REQUEST['Cloud_UserName'];
    $CTS_Password=$_REQUEST['Cloud_Password'];
	$Status=$_REQUEST['Cloud_Status'];  
    $dvrname=$_REQUEST['Cloud_dvrname'];
	$Customer=$_REQUEST['Cloud_Customer'];
	$bank = $_REQUEST['Bank'];
	$remark = $_REQUEST['AddSite_Remark'];



	$Cloud_OldATM = $_POST['Cloud_OldATM'];
	$Cloud_Zone = $_REQUEST['Cloud_Zone'];
	$Cloud_City = $_REQUEST['Cloud_City'];
	$Cloud_State = $_REQUEST['Cloud_State'];


$Cloud_trackerno = $_POST['Cloud_trackerno'];
$Cloud_bmname = $_POST['Cloud_bmname'];
$Cloud_engineerName = $_POST['Cloud_engineerName'];
$Cloud_livesnapshots = $_POST['Cloud_livesnapshots'];
$statusDate = $_POST['statusDate'];
$installationDate = $_POST['installationDate'];


date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");


$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$chkAvailable= mysqli_query($conn,"select ATMID from gpssites where ATMID='".$ATMID."' ");
$n=mysqli_num_rows($chkAvailable);
   
if($n>"0")   {
 echo "<script>alert('Error : Duplicate Site ! ')</script>";
}else{


 $sql="insert into gpssites(ATMID,ATMID2,Address,Location,State,IPAddress,`Rourt ID`,`Live Date`,UserName,Password,Status,dvrname,customer,Bank,remark,zone,city,old_atm,installationDate)values('".$ATMID."','".$ATMID2."','".$SiteAddress."','".$ATMShortName."','".$fetch['state']."','".$DVRIP."','".$Router_Model_num."','".$curentdt."','".$CTS_UserName."','".$CTS_Password."','".$Status."','".$dvrname."','".$Customer."','".$bank."','".$remark."','".$Cloud_Zone."','".$Cloud_City."','".$Cloud_OldATM."','".$installationDate."')";

if($result=mysqli_query($conn,$sql)){

$last=mysqli_insert_id($conn);
$site_details = "insert into sites_details(site_id, routebrand, router_id, simnumber, simowner, status, created_at) 
values('".$last."', '".$routebrand."', '".$router_id."', '".$simnumber."', '".$simowner."', '1', '".$created_at."')" ; 

mysqli_query($conn,$site_details);

$allfiles = array();

if (!empty($_FILES['Cloud_livesnapshots']['name'][0])) {
    $destinationFolder = 'gpsdetails/';
    $totalFiles = count($_FILES['Cloud_livesnapshots']['name']);
    $allfiles = array();

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['Cloud_livesnapshots']['name'][$i];
        $fileTmpPath = $_FILES['Cloud_livesnapshots']['tmp_name'][$i];
       
        if ($fileName !== '') {
            $newFileName = uniqid() . '_' . $fileName;

            $destinationFilePath = $destinationFolder . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
                $allfiles[] = $destinationFilePath;
            } 
        }
    }
} 

$allfiles = json_encode($allfiles);
$Cloud_livesnapshots = $allfiles ;

$details_sql = "insert into gpssites_details(dvrid,tracker,bmName,engineerName,snapshots,status,created_at,created_by,statusDate) 
values('".$last."','".$Cloud_trackerno."','".$Cloud_bmname."','".$Cloud_engineerName."','".$Cloud_livesnapshots."',1,'".$datetime."','".$userid."','".$statusDate."')";

mysqli_query($conn,$details_sql);
}


if($last){
?>
<script>
alert("Added successfully");
window.open("Project_Add.php", "_self");
</script>

</body>
</html>

<?php
}else{
	  echo("Error description: " . $conn -> error);

 ?>
<script>
	alert('Error');
</script>
<?php } 
}	
} 






?> 


<?php
//}
}else
{ 
 header("location: index.php");
}
?>

