<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';?>
<html>
    <head>
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
  -->
<body>
<?php

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
$CTS_UserName=$_POST['CTS_UserName'];
$CTS_Password=$_POST['CTS_Password'];

$State=$_POST['State'];
$Zone=$_POST['Zone'];
/*
$DVRIP=$_POST['DVRIP'];
$DVRName=$_POST['DVRName'];
$DVR_Model_num=$_POST['DVR_Model_num'];*/

$CTSLocalBranch=$_POST['CTSLocalBranch'];
$CTS_BM_Name=$_POST['CTS_BM_Name'];
$CTS_BM_Number=$_POST['CTS_BM_Number'];
$install_Status=$_POST['install_Status'];

		     

date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$instdt=$_POST['dates'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}

$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);
/*
$image_name='';
$maxsize='2140';
$size=($_FILES['email_cpy']['size']/1024);

if($_FILES['email_cpy']['name']!=''){

if($size>$maxsize)
{

echo "Your file size is ".$size."File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
$error++;
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['email_cpy']['name'];*/ 

//echo $fichier;
 




$sql="insert into dvrsite(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,UserName,Password,live,current_dt,mailreceive_dt,addedby,site_remark,DVR_Model_num,DVR_Serial_num,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,install_Status)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','".$CTS_UserName."','".$CTS_Password."','P','$curentdt','$instdt.$t','".$_SESSION['name']."','','','','','','','','','','".$CTSLocalBranch."','".$CTS_BM_Name."','".$CTS_BM_Number."','".$install_Status."')";
//echo $sql;
$result=mysqli_query($conn,$sql);

$last=mysqli_insert_id($conn);

if($last){
    
  
?>
<script>
alert("Add successfully");
window.open("AddDvrSite.php", "_self");
        </script>
<script>
alert("error");
</script> 

</body>
</html>

<?php
}
}else
{ 
 header("location: index.php");
}
?>

 