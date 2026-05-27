<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';
error_reporting(0);

$panelid=$_POST['panelid'];
$ATMID=$_POST['ATMID'];
$DVRIP=$_POST['DVRIP'];
$compy=$_POST['compy'];
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];

$callsup=$_POST['callsup'];
//echo $callsup;
$fix=670;


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

$abc="SELECT a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime ,c.user_id,c.qrt_arrangetime,c.alert_id,c.comment,c.status FROM `sites` a,`alerts` b ,`qrt_arrange` c WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.id=c.alert_id";

//echo $abc;
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

if($callsup!=""){
$abc.=" and c.status='".$callsup."'";
//echo $abc;
}


if($fromdt!="" && $todt!=""){
$abc.=" and b.createtime between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by createtime desc;";
//echo $abc;
}
else if($fromdt!="")
{
    $abc.=" and b.createtime='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and createtime='".$todt."'";
}


else
{
//$fromdt=date('Y-m-d 00:00:00');
//$todt=date('Y-m-d 23:59:59');

//$abc.=" and b.createtime between '".$fromdt."' and '".$todt."'";
//echo $abc;
}
$xyz=$abc;

//echo $abc;
    
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
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
.tbl_th{
	padding:10px;
	background-color:#d20000;
	color:#fff;
	font-size:12px;
}
</style>

<div align="center">total records:<?php echo $Num_Rows?></div>
  <table border=1 style="margin-top:30px">
  <tr class="tbl_th">
  <!--<th>sr</th>-->
      <th class="tbl_th">Client Name</th>
      <th class="tbl_th"> Incident Number</th>
     
      <th class="tbl_th">Circle</th>
      <th class="tbl_th">Location</th>
      
    
   
      
    <th class="tbl_th">ATMID</th>
      <th class="tbl_th">Address</th>
     
       <th class="tbl_th">DVRIP</th>
       <th class="tbl_th">Panel_make</th>
	   <th class="tbl_th">panelid</th>
      <th class="tbl_th">Zone</th>
   
      <th class="tbl_th">Bank</th>
	  <th class="tbl_th">Description</th>
	  <th class="tbl_th">Close by</th>
	  <th class="tbl_th">aging</th>
	  	  <th class="tbl_th">QrtArrangeTime</th>
	  	  	  	  <th class="tbl_th">Last Comment</th>
	 <th class="tbl_th">Update</th>
      
       
       
  </tr>

  <?php  while($row = mysqli_fetch_array($result)) { 
  
  date_default_timezone_set('Asia/Kolkata');
 $curentdt=date("Y-m-d");
$date1=date_create($curentdt);
//echo $row['qrt_arrangetime'];
$datetime = new DateTime($row['qrt_arrangetime']);
$createdate = $datetime->format('Y-m-d');
$date2=date_create($createdate);
$diff=date_diff($date1,$date2);
//echo $diff->format(" %a days");
  ?>

  
 <tr style="background-color:white">
    <!--<td><?php echo $sr;?></td>-->
    <td><?php echo $row["Customer"];?></td>
     <td><?php echo $row["id"];?></td>
    
      <td><?php echo $row["City"].",".$row["State"];?></td>
        <td><?php echo $row["ATMShortName"];?></td>
  
  
    
     <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["SiteAddress"];?></td>
   

    <td><?php echo $row["DVRIP"];?></td>
    <td><?php echo $row["Panel_make"];?></td>	
	<td><?php echo $row["panelid"];?></td>
	<td><?php echo $row["zone"];?></td>
     <td><?php echo $row["Bank"];?></td>
	 <?php
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
		<?php 
		$name="select name from loginusers where id='".$row['user_id']."'";
		$runname=mysqli_query($conn,$name);
		$namefetch=mysqli_fetch_array($runname);
		
		?>
		<td><?php echo $namefetch['name'];?></td>
		<td><?php echo $diff->format(" %a days");?></td>
		
		
		
		
		<td><?php echo $row['qrt_arrangetime'];?></td>
		<td><?php echo $row['comment'];?></td>
		<?php 
		if($row['status']!=2){ 
		?>
	<td> <a href="update_qrt.php?unicid=<?php echo $row[10];?>&zone=<?php echo $row['zone'];?>&des=<?php echo $row1['Description'];?>&lastup=<?php echo $row['comment'];?>"  title="Edit" class="icon-1 info-tooltip">update</a></td>
		<?php }else{?>
		<td><a onclick="window.open('view_closeqrt.php?alertid=<?php echo $row[10];?>', '_blank', 'location=yes,height=400,width=600,left=400,scrollbars=yes,status=yes');" style="color: red;">view</a></td>
		<?php }?>
    </tr>
   <?php
$sr++;
  ?>
<?php 
}
?>

</table>
<form action="excelmail.php" method="POST">

    <input type="hidden" name="excelmail" id="excelmail" value="<?php echo $xyz;?>"/>
    <input type="submit" name="sub" value="Send Mail"/>
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






