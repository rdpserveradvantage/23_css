<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include ('config.php');

$hideip=$_POST['hideip'];
$backroom=$_POST['backroom'];
$rebackroom=$_POST['rebackroom'];
$panic=$_POST['panic'];
$repanic=$_POST['repanic'];
$twoway=$_POST['two'];
$retwoway=$_POST['retwo'];
$glass=$_POST['glass'];
$reglass=$_POST['reglass'];
$Camara=$_POST['Camara'];
$reCamara=$_POST['reCamara'];
$bCamara=$_POST['bCamara'];
$rebCamara=$_POST['rebCamara'];
$oCamara=$_POST['oCamara'];
$reobCamara=$_POST['reobCamara'];
$HDD=$_POST['HDD'];
$reHDD=$_POST['reHDD'];
$eng_name=$_POST['eng_name'];  
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');

$panel=$_POST['panel'];
$repanel=$_POST['repanel'];
$paneltemper=$_POST['paneltem'];
$repaneltemper=$_POST['repaneltem'];
$dvrstatus=$_POST['dvrst'];
$redvrstatus=$_POST['redvrst'];
$dvrvol=$_POST['dvrvol'];
$redvrvol=$_POST['redvrvol'];
$eml=$_POST['eml'];
$reeml=$_POST['reeml'];
$upscable=$_POST['upscable'];
$reupscable=$_POST['reupscable'];
$keypad=$_POST['keypad'];
$rekeypad=$_POST['rekeypad'];
$Antenna=$_POST['Antenna'];
$reAntenna=$_POST['reAntenna'];
$pirsensor=$_POST['pir'];
$repirsensor=$_POST['repir'];
$Smoke=$_POST['Smoke'];
$reSmoke=$_POST['reSmoke'];
$Shutter=$_POST['Shutter'];
$reShutter=$_POST['reShutter'];
$Hooter=$_POST['Hooter'];
$reHooter=$_POST['reHooter'];
$AC1=$_POST['AC1'];
$reAC1=$_POST['reAC1'];
$AC2=$_POST['AC2'];
$reAC2=$_POST['reAC2'];
$enableloby=$_POST['enableloby'];
$reenableloby=$_POST['reenableloby'];
$enableback=$_POST['enableback'];
$reenableback=$_POST['reenableback'];
$enableOut=$_POST['enableOut'];
$reenableOut=$_POST['reenableOut'];
$dvrtime=$_POST['dvrtime'];
$redvrtime=$_POST['redvrtime'];
$recording_scheduling=$_POST['recscheduling'];
$rerecording_scheduling=$_POST['rerecscheduling'];
$Light=$_POST['Light'];
$reLight=$_POST['reLight'];
$CRAsensor1=$_POST['CRAsensor1'];
$reCRAsensor1=$_POST['reCRAsensor1'];
$CRAsensor2=$_POST['CRAsensor2'];
$reCRAsensor2=$_POST['reCRAsensor2'];
$CRAsensor3=$_POST['CRAsensor3'];
$reCRAsensor3=$_POST['reCRAsensor3'];
$hddfoot=$_POST['hddfoot'];
$fromdt=$_POST['from_dt'];
$todate=$_POST['todate'];




$sql="insert into site_testing_log(backroom,rebackroom,panic,repanic,twoway,retwoway,
glass,reglass,Camara,reCamara,HDD,reHDD,eng_name,testby,dvrip,entrydt,bCamara,rebCamara,
oCamara,reobCamara,panel,repanel,paneltemper,repaneltemper,dvrstatus,redvrstatus,dvrvol,redvrvol,eml,reeml,upscable,reupscable,keypad,
rekeypad,Antenna,reAntenna,pirsensor,repirsensor,Smoke,reSmoke,Shutter,reShutter,Hooter,reHooter,AC1,reAC1,AC2,reAC2,
enableloby,reenableloby,enableback,reenableback,enableOut,reenableOut,dvrtime,redvrtime,recording_scheduling,rerecording_scheduling,
Light,reLight,CRAsensor1,reCRAsensor1,CRAsensor2,reCRAsensor2,CRAsensor3,reCRAsensor3,hddfoot,fromdt,todate) values('".$backroom."','".$rebackroom."','".$panic."','".$repanic."',
'".$twoway."','".$retwoway."','".$glass."','".$reglass."','".$Camara."','".$reCamara."','".$HDD."','".$reHDD."',
'".$eng_name."','".$_SESSION['id']."','".$hideip."','".$dates."','".$bCamara."','".$rebCamara."','".$oCamara."',
'".$reobCamara."','".$panel."','".$repanel."','".$paneltemper."','".$repaneltemper."','".$dvrstatus."','".$redvrstatus."',
'".$dvrvol."','".$redvrvol."','".$eml."','".$reeml."','".$upscable."','".$reupscable."','".$keypad."','".$rekeypad."',
'".$Antenna."','".$reAntenna."','".$pirsensor."','".$repirsensor."','".$Smoke."','".$reSmoke."','".$Shutter."','".$reShutter."',
'".$Hooter."','".$reHooter."','".$AC1."','".$reAC1."','".$AC2."','".$reAC2."','".$enableloby."','".$reenableloby."',
'".$enableback."','".$reenableback."','".$enableOut."','".$reenableOut."','".$dvrtime."','".$redvrtime."','".$recording_scheduling."',
'".$rerecording_scheduling."','".$Light."','".$reLight."','".$CRAsensor1."','".$reCRAsensor1."','".$CRAsensor2."',
'".$reCRAsensor2."','".$CRAsensor3."','".$reCRAsensor3."','".$hddfoot."','".$fromdt."','".$todate."')";
$runsql=mysqli_query($conn,$sql);
//echo $sql;
$last=mysqli_insert_id($conn);
if($last){?>
<script>
alert("submitted successfully!!!");
window.open("testsite.php","_self");
</script>	
<?php }
}else
{ 
 header("location: index.php");
}
?>