<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';

$viewalert=$_POST['viewalert'];
$panelid=$_POST['panelid'];
$ATMID=$_POST['ATMID'];
$DVRIP=$_POST['DVRIP'];
$compy=$_POST['compy'];
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$alerts=$_POST['months'];
$fix=670;


function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

            if($from!="")
            {
            //$newDate = date_format($date,"y/m/d H:i:s");
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }

 $sr=1;
  

if($viewalert=="" || $viewalert ==3){

$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`$alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
}
else if($viewalert ==1)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`$alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";
    
}
else if($viewalert ==2)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`$alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='O' ";
    
}
else if($viewalert ==4)
{
   // $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('015','014') ";
      $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`$alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('014') ";
  
}
else if($viewalert ==5)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`4alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('001','002','018') ";
   echo $abc; 
}


//$result=mysqli_query($conn,$abc);

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


if($fromdt!="" && $todt!=""){
$abc.=" and b.receivedtime between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by receivedtime ASC;";
//$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by receivedtime ASC;";
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
      <th>Zone</th>
	  <th>alarm</th>
       <th>SendIP</th>
       
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
	 else
	{
		
		 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 

	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	*/
	/*if(strpos($row["Panel_make"], 'SMART') !== FALSE)
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
	//	 $result2=mysqli_query($conn,$sql2);
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	
	*/
	
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


<td><?php echo $row["closedBy"];?></td>
     <td><?php echo $row["closedtime"];?></td>
	      <td><?php echo $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];?></td>
<td><?php echo $row["zone"];?></td>
<td><?php echo $row["alarm"];?></td>
<td><?php echo $row["sendip"];?></td>

    </tr>
   <?php
$sr++;
  ?>
<?php 
}
?>

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

	</div >

</body>
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>






