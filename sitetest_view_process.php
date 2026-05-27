<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');
//$atm=$_POST['atms'];
		
		
//$Zone1=$_POST['Zone2'];
$DVRIP1=$_POST['DVRIP'];
//$DVRName1=$_POST['DVRName'];
//$ATMShortName1=$_POST['ATMShortName'];
//$atmid=$_POST['atmid'];
//$lstatus=$_POST['lstatus'];
$strPage=$_POST['Page'];
$cssbm=$_POST['cssbm'];
$from=$_POST['from'];
$to=$_POST['to'];

$sql="select * from site_testing_log  where 1=1  ";

if($cssbm!=""){
$sql.=" and testby ='".$cssbm."'";	
}

if($DVRIP1!=""){
$sql.=" and dvrip='".$DVRIP1."'";	
}

if($from!="" && $to!=""){
$sql.=" and entrydt between '".$from." 00:00:00' and '".$to." 23:59:59'";
//echo $sql;
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$sql.=" and entrydt between '".$fromdt."' and '".$todt."'";
//echo $sql;
}
//echo $sql;
/*
if($cities!=""){
$sql.=" and City like '%".$cities."%'";
}

if($DVRIP1!=""){
$sql.=" and DVRIP='".$DVRIP1."'";
}
if($atmid!=""){
$sql.=" and ATMID like '%".$atmid."%' or ATMID_2 like '%".$atmid."%'";
}
 if($track!=""){
$sql.=" and TrackerNo like '%".$track."%' ";	
}
 
if($cssbm!=""){
$sql.=" and ATMID in(select ATM_ID from esurvsites where CSSBM='$cssbm')";	
}
*/

/*
if($DVRName1!=""){
$sql.=" and DVRName='".$DVRName1."'";
}

if($ATMShortName1!=""){
$sql.=" and ATMShortName='".$ATMShortName1."'";
}
*/

    $result=mysqli_query($conn,$sql);
    $Num_Rows=mysqli_num_rows($result);
   $qr22=$sql;
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
$sql.=" order by id desc";
$sql.=" LIMIT $Page_Start , $Per_Page";

echo $sql;
$qrys=mysqli_query($conn,$sql);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	    
	   $sr=($Page_Start* $Page)-$Page_Start;
	   
	   $sr=$sr+1;
	}

?>
   
<?php 
$sr++;

?>
</table>



	

<html><head>
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
tr,th{
	padding:10px;
	background-color:#8cb77e; 
	color:#fff;
	font-size:12px;
}
</style>
</head>
<body>
 

</body>


<!--<input type="hidden" name="expqry" id="expqry" value="<?php echo $sql;?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>-->

<center><div>Total Records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
   <th>Sr No</th>
    
    <th>Backroom</th>
      <th>Panic</th>
	  <th>Two Way</th>
       <th>Glass</th>
	   <th>Camara</th>
    
       <th>Back Camara</th>
	   <th>Out Camara</th>
    <th>HDD</th>
    <th>Dvr Ip</th>
      <th>Panel</th>
	 <th>panel Temper</th>
       <th>Dvr Status</th>
	   <th>Dvr Voltage</th>
	   <th>Eml Lock</th>
     <th>Ups Cable</th>
    <th>keypad</th>
      <th>Antenna</th>
       <th>pir Sensor</th>
	   <th>Smoke</th>
	   <th>Shutter</th>
	   
	   <th>AC1</th>
	   <th>AC2</th>
	   <th>DVR Recording Enable Loby Camera</th>
	   <th>DVR Recording Enable Back Room</th>
      <th>DVR Recording Enable Out Door</th>
       <th>Dvr Time</th>
	   <th>Recording_Scheduling</th>
    <th>Light</th>
	<th>CRA Sensor1</th>
	<th>CRA Sensor2</th>
	<th>CRA Sensor3</th>
	<th>Hdd___Footage</th>
	<th>Eng_Name</th>
	<th>Test By</th>
	<th>Entry_date</th>
	
  </tr>
 <?php 
$srno=1;
 while($row = mysqli_fetch_array($qrys)) { 

 $sql1="select name from loginusers where id='".$row["testby"]."'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
 /* 
 $sql2="select files from site_attachment where site_id='".$row[0]."'";
 $result2=mysqli_query($conn,$sql2);
 $row2=mysqli_fetch_array($result2);
  
  */
 
 ?>

 

 <tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
    <td><?php echo $row["backroom"]."<hr>".$row["rebackroom"];?></td>
	<td><?php echo $row["panic"]."<hr>".$row["repanic"];?></td>
	<td><?php echo $row["twoway"]."<hr>".$row["retwoway"];?></td>
	<td><?php echo $row["glass"]."<hr>".$row["reglass"];?></td>
	<td><?php echo $row["Camara"]."<hr>".$row["reCamara"];?></td>
	
	<td><?php echo $row["bCamara"]."<hr>".$row["rebCamara"];?></td>
	<td><?php echo $row["oCamara"]."<hr>".$row["reobCamara"];?></td>
	<td><?php echo $row["HDD"]."<hr>".$row["reHDD"];?></td>
	<td><?php echo $row["dvrip"];?></td>
	<td><?php echo $row["panel"]."<hr>".$row["repanel"];?></td>
    

    <td><?php echo $row["paneltemper"]."<hr>".$row["repaneltemper"];?></td>
	<td><?php echo $row["dvrstatus"]."<hr>".$row["redvrstatus"];?></td>
	<td><?php echo $row["dvrvol"]."<hr>".$row["redvrvol"];?></td>
	<td><?php echo $row["eml"]."<hr>".$row["reeml"];?></td>
	<td><?php echo $row["upscable"]."<hr>".$row["reupscable"];?></td>
	
	<td><?php echo $row["keypad"]."<hr>".$row["rekeypad"];?></td>
	<td><?php echo $row["Antenna"]."<hr>".$row["reAntenna"];?></td>
	<td><?php echo $row["pirsensor"]."<hr>".$row["repirsensor"];?></td>
	<td><?php echo $row["Smoke"]."<hr>".$row["reSmoke"];?></td>
	<td><?php echo $row["Shutter"]."<hr>".$row["reShutter"];?></td>
	
	<td><?php echo $row["AC1"]."<hr>".$row["reAC1"];?></td>
	<td><?php echo $row["AC2"]."<hr>".$row["reAC2"];?></td>
	<td><?php echo $row["enableloby"]."<hr>".$row["reenableloby"];?></td>
	<td><?php echo $row["enableback"]."<hr>".$row["reenableback"];?></td>
	<td><?php echo $row["enableOut"]."<hr>".$row["reenableOut"];?></td>
	
	<td><?php echo $row["dvrtime"]."<hr>".$row["redvrtime"];?></td>
	<td><?php echo $row["recording_scheduling"]."<hr>".$row["rerecording_scheduling"];?></td>
	<td><?php echo $row["Light"]."<hr>".$row["reLight"];?></td>
	<td><?php echo $row["CRAsensor1"]."<hr>".$row["reCRAsensor1"];?></td>
	<td><?php echo $row["CRAsensor2"]."<hr>".$row["reCRAsensor2"];?></td>
	<td><?php echo $row["CRAsensor3"]."<hr>".$row["reCRAsensor3"];?></td>
	
	<td><?php echo $row["hddfoot"]."<hr>".$row["fromdt"]."to".$row["todate"];?></td>
	<td><?php echo $row["eng_name"];?></td>
	<td><?php echo $row1["name"];?></td>
	<td><?php echo $row["entrydt"];?></td>
  </tr>
  
     
    <?php 
  $srno++;
 }
 ?>

    
     </table>

	 </form>
<div>
 <?php 

if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></a></center> ";
}

if($Page!=$Num_Pages)
{
	echo "<center> <a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></a></center> ";
}
?>
<!--<form name="frm" method="post" action="exportsite_ram.php" target="_new">
<input type="text" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" ></span>
</form>-->
</div>



	
</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}
?>


