<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';

$ZH=$_POST['ZH'];

$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$fix=30;

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}
/*
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
                }*/
				if($from!="")
            {
            //$newDate = date_format($date,"y/m/d H:i:s");
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt=date('Y-m-d');;
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=date('Y-m-d'); 
                }

 $sr=1;
  

if($ZH=="1"){

$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)and b.alarm='ZH'";
}
if($_POST['ZH']=="2"){
$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)and b.alarm='ZL'";
	}
if($_POST['ZH']=="3"){
	$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)and (b.alarm='ZH' or b.alarm='ZL')";

}
//echo $abc;

?>
<?php

if($fromdt!="" && $todt!=""){
$abc.=" and b.receivedtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
}

    //echo $abc;
    $result=mysqli_query($conn,$abc);
    
     $Num_Rows=mysqli_num_rows($result);
  
   $Per_Page =$_POST['perpg'];   // Records Per Page

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
      <th>sr</th>
      <th>Client Name</th>
      <th> Incident Number</th>
      <th>Region</th>
      <th>Circle</th>
      <th>Location</th>
      
    
   
      
    <th>ATMID</th>
      <th>Address</th>
     <th>Alarm</th>
      <!--<th>Alarm Message</th>
       <th>Incident Date Time</th>
    <th>Alarm Received Date Time</th>
    <th> Close Date Time</th>-->
       <th>DVRIP</th>
       <th>Panel_make</th>
	   <th>panelid</th>
   
   
      <th>Bank</th>
	 <!--<th>comment</th>-->
	 <!--<th>Reactive</th>
   <th>Closed By</th>
	 <th>Closed Date</th>-->
     <th>Zone</th> 
	 <th>createtime</th>
	 <th>receivedtime</th>
	 <th>Description</th>
      
       
       
  </tr>

  <?php  
  
  
  while($row=mysqli_fetch_array($result)) {
  
  ?>

 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $row["Customer"];?></td>
     <td><?php echo $row["id"];?></td>
     <td><?php echo $row["zon"];?></td>
      <td><?php echo $row["City"].",".$row["State"];?></td>
        <td><?php echo $row["ATMShortName"];?></td>
  
  
    
     <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["SiteAddress"];?></td>
	<td><?php echo $row["alarm"];?></td>
	<td><?php echo $row["DVRIP"];?></td>
	<td><?php echo $row["Panel_make"];?></td>
	<td><?php echo $row["panelid"];?></td>
	<td><?php echo $row["Bank"];?></td>
	<!--<td><?php echo $row["closedBy"];?></td>
	<td><?php echo $row["closedtime"];?></td>-->
	<td><?php echo $row["zone"];?></td>
	<td><?php echo $row["createtime"];?></td>
	<td><?php echo $row["receivedtime"];?></td>
	
	
	<?php
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
	 ?>
	<td><?php echo $row1["Description"];?></td>
	
	
    </tr>
   <?php
$sr++;
  } 

?>

</table>

 </form>

 <?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}

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






