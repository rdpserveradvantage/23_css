<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');
$strPage=$_POST['Page'];
$fix=670;

$DVRIP1=$_POST['DVRIP'];
$atmid=$_POST['atmid'];
//$cities=$_POST['cities'];
$from=$_POST['from'];
$to=$_POST['to'];


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
				
$sql="select * from bypassatmdetails  where 1=1  ";


/*if($cities!=""){
$sql.=" and City like '%".$cities."%'";
}
*/
if($DVRIP1!=""){
$sql.=" and DVRIP='".$DVRIP1."'";
}
if($atmid!=""){
$sql.=" and ATMID like '%".$atmid."%'";
}

if($fromdt!="" && $todt!=""){
$abc.=" and ByPassDateTime  between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by ByPassDateTime desc;";
//echo $abc;
}
/*
else{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');	

$sql.=" and ByPassDateTime between '".$fromdt."' and '".$todt."'";
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


<!--<input type="hidden" name="expqry" id="expqry" value="<?php echo $sql;?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>-->

<center><div>Total Records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
   <th>Sr No</th> 
   <th>Incident No</th>
    <th>Customer</th>
      <th>Bank</th>
	  <th>Tracker No</th>
       <th>ATMID</th>
	   <th>ATMID_2</th>
 
	   <th>SiteAddress</th>
    <th>City</th>
    <th>State</th>
      <th>Zone</th>
       <th>Panel_Make</th>
	   <th>PanelID</th>
        <th>DVRIP</th>
        <th>by pass date</th>
		<th>Send Ip</th>
		<th>by pass Zone</th>
		<th>Alert Type</th>
		<th>User Name</th>
     
  </tr>
 <?php 
$srno=1;
 while($row = mysqli_fetch_array($qrys)) { 
 
 $sql1="select * from sites where DVRIP='".$row["DVRIP"]."'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);

$sql2="select name from loginusers where id='".$row['LogUserID']."'";
$runsql2=mysqli_query($conn,$sql2);
$sql2fetch=mysqli_fetch_array($runsql2);
 
 ?>

 

 <tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
   <td><?php echo $row["AlertNo"];?></td>
    <td><?php echo $row1["Customer"];?></td>
    <td><?php echo $row1["Bank"];?></td>
	<td><?php echo $row1["TrackerNo"];?></td>
    <td><?php echo $row1["ATMID"];?></td>
	
	<td><?php echo $row1["ATMID_2"];?></td>
   
	<td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row1["City"];?></td>
    <td><?php echo $row1["State"];?></td>
    <td><?php echo $row1["Zone"];?></td>
	
	<td><?php echo $row["PanelName"];?></td>
	<td><?php echo $row["PanelID"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
	<td><?php echo $row["ByPassDateTime"];?></td>
	<td><?php echo $row["LogSysIP"];?></td>
	<td><?php echo $row["bypasszone"];?></td>
	<td><?php echo $row["AlertType"];?></td>
	<td><?php echo $sql2fetch[0];?></td>

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


