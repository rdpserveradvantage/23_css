<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{ include 'config.php';?>

    <html>
       <head>
         <body>
		 
		 <?php $project=$_POST['project'];  if($project=="1"){ ?>
		 
<!--//////////////////////////////////////////// For  RNM Form	 //////////////////////////////////////////////////////////////-->
<?php

$Status=$_POST['AddSite_Status'];
$Phase=$_POST['AddSite_Phase'];
$Customer=$_POST['AddSite_Customer'];
$Bank=$_POST['AddSite_Bank'];
$ATMID=$_POST['AddSite_ATMID'];
$ATMID_2=$_POST['AddSite_ATMID_2'];
$ATMID_3=$_POST['AddSite_ATMID_3'];
$ATMID_4=$_POST['AddSite_ATMID_4'];
$TrackerNo=$_POST['AddSite_TrackerNo'];
$ATMShortName=$_POST['AddSite_ATMShortName'];
$SiteAddress=$_POST['AddSite_SiteAddress'];
$City=$_POST['AddSite_City'];
$GSM=$_POST['AddSite_GSM'];
$State=$_POST['AddSite_State'];
$Zone=$_POST['AddSite_Zone'];
$Panel_Make=$_POST['AddSite_Panel_Make'];
$OldPanelID=$_POST['AddSite_OldPanelID'];
$NewPanelID=$_POST['AddSite_NewPanelID'];
$DVRIP=$_POST['AddSite_DVRIP'];
$PanelsIP=$_POST['AddSite_PanelsIP'];
$DVRName=$_POST['AddSite_DVRName'];
$DVR_Model_num=$_POST['AddSite_DVR_Model_num'];
$Router_Model_num=$_POST['AddSite_Router_Model_num'];
$UserName=$_POST['AddSite_UserName'];
$Password=$_POST['AddSite_Password'];
$engname=$_POST['AddSite_engname'];
date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$instdt=$_POST['AddSite_date'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}
$remark=$_POST['AddSite_Remark'];

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);


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
	$newname="";
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



 



$sql="insert into sitesd(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP,Project_Id )
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','$DVR_Model_num','$Router_Model_num','$PanelsIP','$project')";
$result1=mysqli_query($cn,$sql);
$result2=mysqli_query($conn,$sql);

$last1=mysqli_insert_id($cn);
$last2=mysqli_insert_id($conn);

//  insert in 192.168.0.10 =======================
if($last1){
	 
    $sqlcpy="insert into site_Attachment(site_id,mail_attachment) values('".$last1."','".$newname."')";
    $resultcpy=mysqli_query($cn,$sqlcpy);
	
	$sqlQcpy="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','".$last1."')";
$resultQcpy=mysqli_query($cn,$sqlQcpy);
 
$sql4cpy="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$GSM."')" ;
$runsql4cpy=mysqli_query($cn,$sql4cpy);
	
}

//  insert in 192.168.0.11 =======================

if($last2){
    
    $sql2="insert into site_Attachment(site_id,mail_attachment) values('".$last2."','".$newname."')";
    $result2=mysqli_query($conn,$sql2);
	
	$sql3="insert into sites_log(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','P','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','".$last2."')";
$result3=mysqli_query($conn,$sql3);
 
$sql4="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$GSM."')" ;
$runsql4=mysqli_query($conn,$sql4);
} 
?>
<script>
alert("register successfully");
//window.open("addsite.php", "_self");
</script>


</body>
</html>

<!--////////////////////////////////////////////////// RNM Form Code End //////////////////////////////////////////////-->


<!--///////////////////////////////////////////////// DVR Form Code Start ////////////////////////////////////////////-->
<?php 

 }else if($project=="2"){
	 
	$Status=$_POST['AddDVR_Status'];
$Phase=$_POST['AddDVR_Phase'];
$Customer=$_POST['AddDVR_Customer'];
$Bank=$_POST['AddDVR_Bank'];
$ATMID=$_POST['AddDVR_ATMID'];
$ATMID_2=$_POST['AddDVR_ATMID_2'];
$ATMID_3=$_POST['AddDVR_ATMID_3'];
$ATMID_4=$_POST['AddDVR_ATMID_4'];
$TrackerNo=$_POST['AddDVR_TrackerNo'];
$ATMShortName=$_POST['AddDVR_ATMShortName'];
$SiteAddress=$_POST['AddDVR_SiteAddress'];
$City=$_POST['AddDVR_City'];
$CTS_UserName=$_POST['AddDVR_UserName'];
$CTS_Password=$_POST['AddDVR_Password'];
$State=$_POST['AddDVR_State'];
$Zone=$_POST['AddDVR_Zone'];
$CTSLocalBranch=$_POST['AddDVR_LocalBranch'];
$CTS_BM_Name=$_POST['AddDVR_BM_Name'];
$CTS_BM_Number=$_POST['AddDVR_BM_Number'];
$install_Status=$_POST['AddDVR_install_Status'];
date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$instdt=$_POST['AddDVR_date'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$sql="insert into sitesd(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,UserName,Password,live,current_dt,mailreceive_dt,addedby,site_remark,DVR_Model_num,DVR_Serial_num,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,install_Status,Project_Id)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$instdt.$t','".$_SESSION['name']."','','','','','','','','','','".$CTSLocalBranch."','".$CTS_BM_Name."','".$CTS_BM_Number."','".$install_Status."','$project')";
$resultcpy=mysqli_query($cn,$sql);
$result=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);

if($last){
?>
<script>
alert("Add successfully");
window.open("AddDvrSite.php", "_self");
        </script>
<?php }else{ ?>
<script>
alert("error");
</script> 
</body>
</html>
<?php } ?>

	
<!--////////////////////////////////////////////////// DVR Form Code End //////////////////////////////////////////////-->


<!--///////////////////////////////////////////////// DVR Online Form Code Start ////////////////////////////////////////////-->	
	
<?php }else if($project=="3"){
	
	$ATMID=$_POST['Cloud_ATMID'];
	$SiteAddress=$_POST['Cloud_SiteAddress'];
	$ATMShortName=$_POST['Cloud_Location'];
	$State=$_POST['Cloud_State'];
	$DVRIP=$_POST['Cloud_DVRIP'];
	$Router_Model_num=$_POST['Cloud_RourtID'];
	$CTS_UserName=$_POST['Cloud_UserName'];
    $CTS_Password=$_POST['Cloud_Password'];
	$Status=$_POST['Cloud_Status'];  
    $dvrname=$_POST['Cloud_dvrname'];
	$Customer=$_POST['Cloud_Customer'];



date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

/*$instdt=$_POST['date'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}*/

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$sql="insert into sitesd(Status,Customer,ATMID,ATMShortName,SiteAddress,State,UserName,Password,live,current_dt,DVRIP,Router_Model_num,DVRName,addedby,Project_Id)
values('$Status','$Customer','$ATMID','$ATMShortName','$SiteAddress','".$fetch[0]."','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$DVRIP','$Router_Model_num','$dvrname','".$_SESSION['name']."','$project')";
mysqli_query($cn,$sql);
$result=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);

if($last){
?>
<script>
alert("Add successfully");
window.open("AddDvrSite.php", "_self");
</script>

</body>
</html>

<?php
}
		
} ?> 


<?php
}
}else
{ 
 header("location: index.php");
}
?>

