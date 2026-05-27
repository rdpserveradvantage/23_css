<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';

$ATMID=$_POST['ATMID'];
$DVRIP=$_POST['DVRIP'];

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

 $sr=1;
 date_default_timezone_set('Asia/Kolkata');
$fromdt=date("Y-m-d H:i:s",strtotime("-30 minutes"));
$todt=date('Y-m-d H:i:s'); 




$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.receivedtime between '".$fromdt."' and '".$todt."'";
//echo $abc;

?>
<?php

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
//echo $abc;
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
//echo $abc;
}

$abc.=" order by b.receivedtime desc limit 30 ";
//echo $abc;
    $result=mysqli_query($conn,$abc);
    
     $Num_Rows=mysqli_num_rows($result);
 
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
	  <th>zone</th>
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
	 <th>Send Ip</th>
   <th>Closed By</th>
	 <th>Closed Date</th>
     <th>Remark</th> 
	 <th>Confirm</th>
      
       
       
  </tr>

  <?php  while($row = mysqli_fetch_array($result)) { 
  
   
   
   
  
  ?>

 <tr style="background-color:#cfe8c7">
    <!--<td><?php echo $sr;?></td>-->
    <td><?php echo $row["Customer"];?></td>
     <td><?php echo $row["id"];?></td>
     <td><?php echo $row["zon"];?></td>
      <!--<td><?php echo $row["City"].",".$row["State"];?></td>
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
		/* $sql2="select a.Description,a.Camera,a.SH ,b.Zone from zonecameras a , smartialarms b where (b.Zone=a.ZoneNo)";
		 $result2=mysqli_query($conn,$$sql2);
		 */
		 $sql1="select SensorName as Description,Camera from rass where (ZONE='".$row["zone"]."' and SCODE='".$row['alarm']."')"; 
	//	 $result2=mysqli_query($conn,$sql2);
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 ?>
	 

	 
	 	<td><?php echo $row1["Description"];?></td>
	 	<td><?php if(endsWith($row["alarm"], "R"))echo $row1["Description"].' Restoral';
else echo $row1["Description"];
?></td>
	 	 <td><?php echo $row["createtime"];?></td>
    <td><?php echo $row["receivedtime"];?></td>
    <td><?php echo $newDate;?></td>
    <td><?php echo $row["DVRIP"];?></td>
    <td><?php echo $row["Panel_make"];?></td>	
	<td><?php echo $row["panelid"];?></td>
     <td><?php echo $row["Bank"];?></td>
	
	<!--<td><?php echo $row["comment"];?></td>-->
<td><?php if(endsWith($row["alarm"], "R"))echo 'Non-Reactive';
else echo 'Reactive';
?></td>

<td><?php echo $row["sendip"];?></td>
<td><?php echo $row["closedBy"];?></td>
     <td><?php echo $row["closedtime"];?></td>
	      <td><?php echo $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];?></td>
<td> <?php if(endsWith($row["alarm"], "R"))echo " "; else echo "<input type='checkbox' name='testid[]'  value='".$row["id"]."' checked/>  ";?> </td>
 

    </tr>
   <?php
$sr++;
  ?>
<?php 
}
?>

</table>

</form>

	</div >

</body>
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>






