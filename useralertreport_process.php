<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$user=$_POST['user'];
$shift=$_POST['shift'];

if($_POST['dt']=='')
	{
		$fdate=date('Y-m-d');
		$tdate=date('Y-m-d');
	}
	else{
		$fdate=$_POST['dt'];

	$fromdate1=date("Y-m-d", strtotime($fdate) );
	
	$tdate=$_POST['dt2'];
	
	$todate1=date("Y-m-d", strtotime($tdate) );
		
	
		$fromdate=$fromdate1.' '.'00:00:00';
		$todate=$todate1.' '.'23:59:59';
		
	}

	/*$date=date('Y-m-d');

$next_date = date('Y-m-d', strtotime($date .' +1 day'));
$pre_date = date('Y-m-d', strtotime($date .' -1 day'));
$strPage=$_POST['Page'];
//$fix=20;
*/
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}


  ?>
      
<?php
$sql="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";
//$sql="select * from alerts  where 1=1 ";
if($user!=""){
$sql.=" and LTRIM(RTRIM(b.closedBy)) LIKE '%".$user."'";	
}

if($user=="all"){
//$sql="select * from alerts  where 1=1 ";	
$sql="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime,b.sendip FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";

}


if($shift=="all" && $fromdate!="" && $todate!=="" && $user=="all"){
$sql.=" and b.receivedtime between '".$fromdate."' and '".$todate."' ";
}
/*
else if($fromdate!="")
{
    $sql.=" and b.receivedtime='".$fromdate."'";
}
else if($todate!="")
{
$sql.=" and receivedtime='".$todate."'";
}
*/
//else
	if($fromdate=="" && $todate=="")
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$sql.=" and b.receivedtime between '".$fromdt."' and '".$todt."'";
}
//echo $sql;
//$date=date('Y-m-d');
//echo $date;
$next_date = date('Y-m-d', strtotime($fromdate .' +1 day'));


if($shift=="1" && $fromdate!="" && $todate!==""){
	$sql.=" and b.receivedtime between '".$fromdate1." 07:00:00' and '".$todate1." 15:00:00' ";
//echo $sql;
}

if($shift=="2" && $fromdate!="" && $todate!==""){
	$sql.=" and b.receivedtime between '".$fromdate1." 15:00:00' and '".$todate1." 23:00:00' ";
	//echo $sql;
}

if($shift=="3" && $fromdate!="" && $todate!==""){
	$sql.=" and b.receivedtime between '".$fromdate1." 23:00:00' and '".$next_date." 07:00:00' ";
	//echo $sql;
}

$sql.=" order by b.receivedtime Asc ";

echo $sql;



    $result=mysqli_query($conn,$sql);
    $Num_Rows=mysqli_num_rows($result);
   
    
       
 /* 
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

$sql.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$sql);

	//$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr=+1;
	}
*/
?>
   

</table>



	

<html>

<style>
table{
	width:50%;
	text-align:center;
	
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
  <div id="finish"><table  border=1 style="margin-top:30px" align="center"></div>
  <tr>
     <th>Sr no</th>  
      <th>panelid</th>
	  <th>Customer</th>
	  <th>ATMID</th>
	  <th>State</th>
    <th>City</th>
	 <th>SiteAddress</th>
     <th>Bank</th>
	 <th>DVRIP</th>
	<th>Panel_make</th>
	<th>Zone </th>
	
	<th>alarm</th>
    <th>createtime</th>
	<th>receivedtime</th>
    <th>comment</th> 
    <th>closedBy</th>
	<th>send_ip</th>
	<th>closedtime</th>
      
  </tr>
  
 
  
 <?php 
 $sr=1;
    while($row=mysqli_fetch_array($result)){
		
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
		/* $sql2="select a.Description,a.Camera,a.SH ,b.Zone from zonecameras a , smartialarms b where (b.Zone=a.ZoneNo)";
		 $result2=mysqli_query($conn,$$sql2);
		 */
		 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
	//	 $result2=mysqli_query($conn,$sql2);
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 ?>
	 

	 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $row['panelid'];?></td>
	 <td><?php echo $row['Customer'];?></td>
	 <td><?php echo $row['ATMID'];?></td>
	 <td><?php echo $row['State'];?></td>
	<td><?php echo $row['City'];?></td>
	<td><?php echo $row['SiteAddress'];?></td>
	<td><?php echo $row['Bank'];?></td>
	<td><?php echo $row['DVRIP'];?></td> 
	
	<td><?php echo $row['Panel_make'];?></td>
	<td><?php echo $row['zone'];?></td>
	 	<!--<td><?php echo $row1["Description"];?></td>-->
	 	<td><?php if(endsWith($row["alarm"], "R"))echo $row1["Description"].' Restoral';
else echo $row1["Description"];
?></td>	

 
	<!--<td><?php echo $row['alarm'];?></td>-->
	<td><?php echo $row['createtime'];?></td>
	<td><?php echo $row['receivedtime'];?></td>
	<td><?php echo $row['comment'];?></td>
	<td><?php echo $row['closedBy'];?></td>
	<td><?php echo $row['sendip'];?></td>
	<td><?php echo $row['closedtime'];?></td>
    
  
</tr>
 <?php 
     $sr++;
} 
?>
    



 </table>
 </form>
<div>
   
 <?php /*
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></a></center> ";
}
*/
?>

</div>

</body>
</html>

<?php

}else
{ 
 header("location: index.php");
}
?>


