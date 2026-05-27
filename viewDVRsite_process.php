<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$DVRIP1=$_POST['DVRIP'];
$atmid=$_POST['atmid'];
$lstatus=$_POST['lstatus'];
$strPage=$_POST['Page'];
$cssbm=$_POST['cssbm'];
$customer=$_POST['cust'];
$track=$_POST['track'];
$cities=$_POST['cities'];

$sql="select * from dvrsite  where 1=1  ";

if($customer!=""){
$sql.=" and Customer='".$customer."'";	
}

if($lstatus!=""){
$sql.=" and live='".$lstatus."'";	
}

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


echo $sql;
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

$sql.=" LIMIT $Page_Start , $Per_Page";
	
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


<input type="hidden" name="expqry" id="expqry" value="<?php echo $sql;?>">
<!--<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>-->

<center><div>Total Records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
      <th>Sr No</th>
      <th>Customer</th>
      <th>Bank</th>
	  <th>Tracker No</th>
      <th>ATMID</th>
	  <th>ATMID_2</th>
      <th>ATMShortName</th>
	  <th>SiteAddress</th>
      <th>City</th>
      <th>State</th>
      <th>Zone</th>
	  <th>DVRIP</th>
      <th>DVRName</th>
      <th>DVR_Model_num</th>
	  
	  <th>DVR_Serial_num  </th>
      <th>CTSLocalBranch  </th>
	  <th>CTS_BM_Name  </th>
      <th>CTS_BM_Number  </th>
      <th>HDD </th>
	  <th>Camera1  </th>
	  <th>Camera2</th>
	  
	  <th>Camera3  </th>
      <th>Attachment1   </th>
	  <th>Attachment2  </th>
      <th>LiveDate   </th>
      <th>Site Remark  </th>
	   <th>User Name</th>
	   <th>Password</th>
	    <th>Live</th>
	  <th>Edit</th>
	
	
  </tr>
 <?php 
$srno=1;
 while($row = mysqli_fetch_array($qrys)) { 
 
  
 ?>

 

 <tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
    <!--<td><?php echo $row["SN"];?></td>-->
    <!--<td><?php echo $row["Status"];?></td>
    <td><?php echo $row["Phase"];?></td>-->
    <td><?php echo $row["Customer"];?></td>
    <td><?php echo $row["Bank"];?></td>
	<td><?php echo $row["TrackerNo"];?></td>
    <td><?php echo $row["ATMID"];?></td>
	
	<td><?php echo $row["ATMID_2"];?></td>
    <!--<td><?php echo $row["ATMID_3"];?></td>
    <td><?php echo $row["ATMID_4"];?></td>
    <td><?php echo $row["TrackerNo"];?></td>-->
    <td><?php echo $row["ATMShortName"];?></td>
	<td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row["City"];?></td>
    <td><?php echo $row["State"];?></td>
    <td><?php echo $row["Zone"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
	
	<td><?php echo $row["DVRName"];?></td>
    <td><?php echo $row["DVR_Model_num"];?></td>
	<td><?php echo $row["DVR_Serial_num"];?></td>
	<td><?php echo $row["CTSLocalBranch"];?></td>
    <td><?php echo $row["CTS_BM_Name"];?></td>
    <td><?php echo $row["CTS_BM_Number"];?></td>
    <td><?php echo $row["HDD"];?></td>
    <td><?php echo $row["Camera1"];?></td>
	<td><?php echo $row["Camera2"];?></td>
	<td><?php echo $row["Camera3"];?></td>
    <td><img src="<?php echo $row["Attachment1"];?>" style="height:60px;width:60px"></td>
    <td><img src="<?php echo $row["Attachment2"];?>" style="height:60px;width:60px"></td>
    <td><?php echo $row["liveDate"];?></td>
    <td><?php echo $row["site_remark"];?></td>
	 <td><?php echo $row["UserName"];?></td>
    <td><?php echo $row["Password"];?></td>
	
    
	
	<?php if($row['live']!='Y'){?><td> <a href="sitelive.php?id=<?php echo $row[0]; ?>"  title="Live" class="icon-1 info-tooltip">Live</a></td><?php }else{ ?><td> </td><?php } ?>
	
	<td> <a href="editDVR.php?atmid=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>
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


