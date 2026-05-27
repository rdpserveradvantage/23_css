<?php  //set_time_limit(100);
error_reporting(0);
ini_set('memory_limit', '512M');
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';

$viewalert=$_POST['viewalert'];
$panelid=$_POST['panelid'];
$ATMID=$_POST['ATMID'];
$DVRIP=$_POST['DVRIP'];
$compy=$_POST['compy'];
$panelmk=$_POST['panelmak'];
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$fix=670;

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
   return $length === 0 || (substr($haystack, -$length) === $needle);
}

if($from!=""){
//$newDate = date_format($date,"y/m/d H:i:s");
    $fromdt = date("Y-m-d", strtotime($from));
}else{
    $fromdt="";
}
if($to!=""){
    $todt = date("Y-m-d", strtotime($to));
}else{
    $todt=""; 
}

$sr=1;
  
if($viewalert=="" || $viewalert ==3){
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
}
else if($viewalert ==1)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";
}
else if($viewalert ==2)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='O' ";
}
else if($viewalert ==4)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='014' and a.Panel_make='smart -i') or (b.zone='015' and a.Panel_make='rass') or (b.zone='008' and a.Panel_make='sec')) ";
}
else if($viewalert ==5)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='001' and a.Panel_make='smart -i') or (b.zone='029' and a.Panel_make='rass') or (b.zone='027' and a.Panel_make='sec') )  ";
}
else if($viewalert ==6)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='008' and a.Panel_make='smart -i') or (b.zone='023' and a.Panel_make='rass') or (b.zone='021' and a.Panel_make='sec') )   ";
}
else if($viewalert ==7)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='007' and a.Panel_make='smart -i') or (b.zone='003' and a.Panel_make='rass') or (b.zone='003' and a.Panel_make='sec') )   ";
}
else if($viewalert ==8)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='002' and a.Panel_make='smart -i') or (b.zone='030' and a.Panel_make='rass') or (b.zone='028' and a.Panel_make='sec') )   ";
}
else if($viewalert ==9)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='998' and a.Panel_make='rass'))   ";
   //echo $abc; 
}
else if($viewalert ==10)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='004' and a.Panel_make='rass') or (b.zone='004' and a.Panel_make='sec') or (b.zone='015' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}

else if($viewalert ==11)
{
    $abc="SELECT a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='024' and a.Panel_make='rass') or (b.zone='032' and a.Panel_make='securico_gx4816') or (b.zone='033' and a.Panel_make='securico_gx4816') or (b.zone='022' and a.Panel_make='securico') or (b.zone='024' and a.Panel_make='securico') or (b.zone='022' and a.Panel_make='smart -i'))";
   //echo $abc; 
}

else if($viewalert ==12)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='025' and a.Panel_make='rass') or (b.zone='013' and a.Panel_make='sec') or (b.zone='017' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}

else if($viewalert ==13)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='006' and a.Panel_make='rass') or (b.zone='006' and a.Panel_make='sec') or (b.zone='011' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}

else if($viewalert ==14)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='013' and a.Panel_make='rass') or (b.zone='007' and a.Panel_make='sec') or (b.zone='013' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}
else if($viewalert ==15)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='009' and a.Panel_make='rass') or (b.zone='005' and a.Panel_make='sec') or (b.zone='012' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}

else if($viewalert ==16)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='002' and a.Panel_make='rass') or (b.zone='002' and a.Panel_make='sec') or (b.zone='010' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}

else if($viewalert ==17)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='001' and a.Panel_make='rass') or (b.zone='001' and a.Panel_make='sec') or (b.zone='009' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}
else if($viewalert ==18)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='004' and a.Panel_make='smart -i') or (b.zone='100' and a.Panel_make='sec') )  ";
   //echo $abc; 
}
else if($viewalert ==19)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and ((b.zone='011' and a.Panel_make='rass') or (b.zone='041' and a.Panel_make='sec') or (b.zone='059' and a.Panel_make='smart -i'))  ";
   //echo $abc; 
}
?>
<?php
if($panelid!=""){
$abc.=" and b.panelid='".$panelid."'";
}

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
}
if($compy!=""){
$abc.=" and a.Customer='".$compy."'";
}
if($panelmk!=""){
$abc.=" and a.Panel_Make='".$panelmk."'";
}

if($fromdt!="" && $todt!=""){
$abc.=" and b.receivedtime between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by receivedtime desc;";
//echo $abc;
}
else if($fromdt!="")
{
    $abc.=" and b.receivedtime='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and receivedtime='".$todt."'";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."'";
}


echo $abc;
    $result=mysqli_query($conn,$abc);
    
     $Num_Rows=mysqli_num_rows($result);
 $qr22=$abc; 
   /* $Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	 //   echo $Page_Start."-".$Page."-".$Page_Start;
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr+1;
	}
*/
?>

<html>

<style>
table{
	width:100%;
}
td{
	padding:10px;
	font-size:12px;
	font-weight: bold;
	color:#000;
}

tr:hover {
background-color:#eee !important;
}
tr,th{
	padding:10px;
	background-color:#8cb77e; 
	color:#fff;
	font-size:12px;
}
</style>

<input type="hidden" name="expqry" id="expqry" value="<?php echo $abc;?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>

<div align="center">total records:<?php echo $Num_Rows?></div>
  <table border=1 style="margin-top:30px">
  <tr>
  <!--<th>sr</th>-->
      <th>Client Name</th>
      <th> Incident Number</th>
      <th>Region</th>
      <!--<th>Circle</th>
      <th>Location</th>-->
      <th>ATMID</th>
      <th>Address</th>
	  <th>City</th>
	  <th>State</th>
	  <th>Zone</th>
	  <th>Alarm</th>
	  
      <th>Incident Category</th>
      <th>Alarm Message</th>
      <th>Incident Date Time</th>
      <th>Alarm Received Date Time</th>
      <th> Close Date Time</th>
      <th>DVRIP</th>
      <th>Panel_make</th>
	  <th>panelid</th>
      <th>Bank</th>
	 <!--<th>comment</th>-->
	 <th>Reactive</th>
     <th>Closed By</th>
	 <th>Closed Date</th>
     <th>Remark</th> 
	 <th>Send Ip</th>
	 <th>TestingByServiceTeam</th>
     <th>Testing Remark</th>
       
       
  </tr>

  <?php  while($row = mysqli_fetch_array($result)) { 
  
  $incident_query= mysqli_query($conn,"select TestingByService,remark from Testing_alertDetails where incident_id='".$row["id"]."' ");
   $incident_fetch=mysqli_fetch_array($incident_query);
	   

  
  
  
  ?>

 <tr style="background-color:#cfe8c7">
    <!--<td><?php echo $sr;?></td>-->
    <td><?php echo $row["Customer"];?></td>
     <td><?php echo $row["id"];?></td>
     <td><?php echo $row["zon"];?></td>
     <!-- <td><?php echo $row["City"].",".$row["State"];?></td>
     <td><?php echo $row["ATMShortName"];?></td>-->
    <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["SiteAddress"];?></td>
	<td><?php echo $row["City"];?></td>
	<td><?php echo $row["State"];?></td>
	<td><?php echo $row["zone"];?></td>
	<td><?php echo $row["alarm"];?></td>
 	
    <?php
     $dtconvt=$row["receivedtime"];
	 $timestamp = strtotime($dtconvt);
     $newDate = date('d-F-Y', $timestamp); 
//echo $newDate; //outputs 02-March-2011
	 

/*
if(strpos($row["Panel_make"], 'SMART') !== FALSE)
    {
    
$sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";

    }
	else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
    {
    
$sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

    }
	
	 else
	{
		 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	
	*/
	
	if($row["Panel_make"]== "SMART -I"){		 
     $sql1="select SensorName as Description,Camera from smarti where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	}
	else if($row["Panel_make"]== "SMART-IN"){		 
     $sql1="select SensorName as Description,Camera from smartinew where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	}
	else if($row["Panel_make"]== "SEC"){		 
      $sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	}
	else if($row["Panel_make"]== "sec_sbi"){		 
     $sql1="select SensorName as Description,Camera from sec_sbi where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	}
	else if($row["Panel_make"]== "RASS" || $row["Panel_make"]== "rass"){		 
     $sql1="select SensorName as Description,Camera from rass where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	}
	  else if($row["Panel_make"]== "rass_cloud"){    
	  $sql1="select SensorName as Description,Camera from rass_cloud where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	  }
	else if($row["Panel_make"]== "rass_sbi"){		 
     $sql1="select SensorName as Description,Camera from rass_sbi where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";
	}
	else if($row["Panel_make"]== "Raxx"){		 
     $sql1="select SensorsName as Description,Camera from raxx where ZoneNumber='".$row["zone"]."' ";
	}
	else if($row["Panel_make"]== "securico_gx4816"){		 
     $sql1="select sensorname as Description,camera from securico_gx4816 where zone='".$row["zone"]."' ";
	} 
	else if($row["Panel_make"]== "smarti_hdfc32"){		 
     $sql1="select SensorName as Description,Camera from smarti_hdfc32 where zone='".$row["zone"]."' ";
	} 
	
	
	/*
	if(strpos($row["Panel_make"], 'SMART') !== FALSE)
    {
    
     $sql1="select SensorName as Description,Camera from smarti where (Zone='".$row["zone"]."' and SCODE='".$row['alarm']."')";

    }
	else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
    {
    
     $sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

    }
	
	 else
	{
		
		 $sql1="select SensorName as Description,Camera from rass where (ZONE='".$row["zone"]."' and SCODE='".$row['alarm']."')"; 
	}*/
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 ?>
	 

	 
	 	<td><?php echo $row1["Description"];?></td>
	 	<td><?php if(endsWith($row["alarm"], "R"))echo $row1["Description"].' Restoral'; else echo $row1["Description"];?></td>
        <td><?php echo $row["createtime"];?></td>
		<td><?php echo $row["receivedtime"];?></td>
		<td><?php echo $newDate;?></td>
		<td><?php echo $row["DVRIP"];?></td>
		<td><?php echo $row["Panel_make"];?></td>	
		<td><?php echo $row["panelid"];?></td>
        <td><?php echo $row["Bank"];?></td>
	    <!--<td><?php echo $row["comment"];?></td>-->
        <td><?php if(endsWith($row["alarm"], "R"))echo 'Non-Reactive'; else echo 'Reactive';?></td>
        <td><?php echo $row["closedBy"];?></td>
        <td><?php echo $row["closedtime"];?></td>
	    <td><?php echo $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];?></td>
		<td><?php echo $row["sendip"];?></td>
		<td><?php echo $incident_fetch["TestingByService"];?></td>
		<td><?php echo $incident_fetch["remark"];?></td>
  </tr>
	
  <?php  $sr++; } ?>
	
    

</table>

 </form>

 <?php 
 /*
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}
*/
?>
<!--<form name="frm" method="post" action="exportram.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" ></span>
</form>-->

</div >
</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>	







