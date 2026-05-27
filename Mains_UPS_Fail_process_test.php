<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
set_time_limit(3600);    
include 'config.php';

//$viewalert=$_POST['viewalert'];
$panelid=$_POST['panelid'];
$ATMID=$_POST['ATMID'];
$DVRIP=$_POST['DVRIP'];
$compy=$_POST['compy'];
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
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
  



    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts_acup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('029','030') and b.alarm='AT' ";
   //echo $abc; 

    $abc2="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts_acup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('001','002')and a.panel_make='SMART -I' and b.alarm='BA'";

   // $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts_acup` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) "; (a.Panel_Make = 'securico_gx4816' OR a.Panel_Make = 'sec_sbi') AND (b.alarm IN ('BA','BR') AND b.zone IN ('551','552')) 
//$result=mysqli_query($conn,$abc);

?>
<?php
if($panelid!=""){
$abc.=" and b.panelid='".$panelid."'";
$abc2.=" and b.panelid='".$panelid."'";

}

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
$abc2.=" and a.ATMID='".$ATMID."'";
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
$abc2.=" and a.DVRIP='".$DVRIP."'";
}
if($compy!=""){
$abc.=" and a.Customer='".$compy."'";
$abc2.=" and a.Customer='".$compy."'";
}


if($fromdt!="" && $todt!==""){
$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime ;";
$abc2.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime ;";
}
else if($fromdt!="")
{
    $abc.=" and b.receivedtime='".$fromdt."' order by createtime";
	$abc2.=" and b.receivedtime='".$fromdt."' order by createtime";
}
else if($todt!="")
{
$abc.=" and receivedtime='".$todt."' order by createtime";
$abc2.=" and receivedtime='".$todt."' order by createtime";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime";
$abc2.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime";
}

echo $abc;
echo $abc2;
    $result=mysqli_query($conn,$abc);
	$result2=mysqli_query($conn,$abc2);
    
     $Num_Rows1=mysqli_num_rows($result);
	 $Num_Rows2=mysqli_num_rows($result2);
  $Num_Rows=$Num_Rows1+$Num_Rows2;
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

<div align="center">total records:<?php echo $Num_Rows?></div>
  <table border=1 style="margin-top:30px">
  <tr>
  <!--<th>sr</th>-->
      <th>Client</th>
      <th>Bank Name</th>
      <th>Incident Id</th>
      <th>Circle</th>
      <th>Location</th>
      
      <th>Address</th>
	   <th>ATMID</th>
     <th>Full Address</th>
      <th>DVRIP</th>
       <th>Incident Date Time</th>
    <th>EB Power Failure Alert Received date</th>
	<th>EB Power Failure Alert Received Time</th>
    <th>UPS Power Available Alert Received Date</th>
	<th>UPS Power Available Alert Received time</th>
      
	   <th>UPS Power Failure Alert Received Date</th>
	   <th>UPS Power Failure Alert Received time</th>
	   <th>UPS Power Restore Alert Received Date</th>
	   <th>UPS Power Restore Alert Received time</th>
	   <th>EB Power Available Alert Received date</th>
	   <th>EB Power Available Alert Received time</th>
	  
       
  </tr>

  <?php  
   while($row = mysqli_fetch_array($result)) {?>

 <tr style="background-color:#cfe8c7">
    <!--<td><?php echo $sr;?></td>-->
    <td><?php echo $row["Customer"];?></td>
	<td><?php echo $row["Bank"];?></td>
     <td><?php echo $row["id"];?></td>
     <td><?php echo $row["zon"];?></td>
      <td><?php echo $row["City"].",".$row["State"];?></td>
        <td><?php echo $row["ATMShortName"];?></td>
  
  
    
     <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
	
    <?php
//$dtconvt=$row["receivedtime"];
	 //$timestamp = strtotime($dtconvt);
//$newDate = date('d-F-Y', $timestamp); 
//echo $newDate; //outputs 02-March-2011
	?> 



	<td><?php echo $row["createtime"];?></td>
	<?php
	$timestamp = $row["createtime"];
$splitTimeStamp = explode(" ",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];

if($row["alarm"]=="AT" and $row["zone"]=="029"){
?>
    <td><?php echo $date;?></td>
	<td><?php echo $time;?></td>
    <td><?php echo $date;?></td>
	<td><?php echo $time;?></td>
    
	<?php
	$xyz="select createtime from alerts_acup where panelid='".$row['panelid']."' and zone='029' and alarm='AR' and createtime>'".$row['createtime']."' order by createtime limit 1";
	$xyzresult=mysqli_query($conn,$xyz);
	$xyzfetch=mysqli_fetch_array($xyzresult);
	
}else { $xyzfetch[0]='-';
	?>
	<td>-</td>
	<td>-</td>
    <td>-</td>
	<td>-</td>
   
<?php }
	if($row["alarm"]=="AT" and $row["zone"]=="030"){
	?>	
    <td><?php echo $date;?></td>	
	<td><?php echo $time;?></td>
	<?php 
	$xyz1="select createtime from alerts_acup where panelid='".$row['panelid']."' and zone='030' and alarm='AR' and createtime>'".$row['createtime']."' order by createtime limit 1";
	$xyzresult1=mysqli_query($conn,$xyz1);
	
	$xyzfetch1=mysqli_fetch_array($xyzresult1);
	}else {
		$xyzfetch1[0]='-';
		?>
	<td>-</td>
	<td>-</td>
 <?php }
  
	?>	
    <td><?php echo $xyzfetch1[0]; ?></td>	
	<td><?php echo $xyzfetch1[0]; ?></td>	

    <td><?php echo $xyzfetch[0];  ?></td>	
	<td><?php echo $xyzfetch[0];  ?></td>

    </tr>
   <?php
$sr++;
  ?>
<?php 
}


 while($row = mysqli_fetch_array($result2)) { ?>

 <tr style="background-color:#cfe8c7">
    <!--<td><?php echo $sr;?></td>-->
    <td><?php echo $row["Customer"];?></td>
	<td><?php echo $row["Bank"];?></td>
     <td><?php echo $row["id"];?></td>
     <td><?php echo $row["zon"];?></td>
      <td><?php echo $row["City"].",".$row["State"];?></td>
        <td><?php echo $row["ATMShortName"];?></td>
  
  
    
     <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["SiteAddress"];?></td>
     <td><?php echo $row["DVRIP"];?></td>
	
    <?php
//$dtconvt=$row["receivedtime"];
	 //$timestamp = strtotime($dtconvt);
//$newDate = date('d-F-Y', $timestamp); 
//echo $newDate; //outputs 02-March-2011
	?> 



	<td><?php echo $row["createtime"];?></td>
	<?php
	$timestamp = $row["createtime"];
$splitTimeStamp = explode(" ",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];

if($row["alarm"]=="BA" and $row["zone"]=="001"){
?>
    <td><?php echo $date;?></td>
	<td><?php echo $time;?></td>
    <td><?php echo $date;?></td>
	<td><?php echo $time;?></td>
    
	<?php 
	$xyz2="select createtime from alerts_acup where panelid='".$row['panelid']."' and zone='001' and alarm='BR' and createtime>'".$row['createtime']."' order by createtime limit 1";
	$xyzresult2=mysqli_query($conn,$xyz2);
	$xyzfetch2=mysqli_fetch_array($xyzresult2);
	
	
}else { $xyzfetch2[0]='-';
	?>
	<td>-</td>
	<td>-</td>
    <td>-</td>
	<td>-</td>
   
<?php 
}
	if($row["alarm"]=="BA" and $row["zone"]=="002"){
	?>	
    <td><?php echo $date;?></td>	
	<td><?php echo $time;?></td>
	<?php 
	 
	$xyz1="select createtime from alerts_acup where panelid='".$row['panelid']."' and zone='002' and alarm='BR' and createtime>'".$row['createtime']."' order by createtime limit 1";
	$xyzresult1=mysqli_query($conn,$xyz1);
	$xyzfetch3=mysqli_fetch_array($xyzresult1);
	}else { $xyzfetch3[0]='-';?>
	<td>-</td>
	<td>-</td>
 <?php  }
  
	?>	
    <td><?php echo $xyzfetch3[0];?></td>	
	<td><?php echo $xyzfetch3[0];?></td>	
 	
    <td><?php echo $xyzfetch2[0];?></td>	
	<td><?php echo $xyzfetch2[0];?></td>
	
	</tr>
  <?php 
	
$sr++;
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






