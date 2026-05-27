<?php session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');
//$atm=$_POST['atms'];
		
$arr=explode(",",$_SESSION['permission']);
$project=$_POST['project'];

$sql="";



if($project=="1"){
	
			
//$Zone1=$_POST['Zone2'];
$DVRIP1=$_POST['DVRIP'];
//$DVRName1=$_POST['DVRName'];
//$ATMShortName1=$_POST['ATMShortName'];
$atmid=$_POST['atmid'];
$lstatus=$_POST['lstatus'];
$strPage=$_POST['Page'];
$cssbm=$_POST['cssbm'];
$customer=$_POST['cust'];
$track=$_POST['track'];
$cities=$_POST['cities'];
$from=$_POST['F_date'];
$to=$_POST['T_date'];	
	
	
	$sql.="select * from sites  where 1=1 ";

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
	
if($customer!=""){
$sql.=" and Customer='".$customer."'";	
}
/*
if($lstatus!="" && $lstatus!='T'){
$sql.=" and live='".$lstatus."'";	
}*/

if($lstatus!="" ){
$sql.=" and live='".$lstatus."'";	
}

/*
if($lstatus!="" && $lstatus=='T'){
$sql.=" and ATMID IN (select atmid from TestingSites)";	
}*/

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


if($fromdt!="" && $todt!=""){
$sql.=" and live_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' ";
//echo $abc;
}
else if($fromdt!="")
{
    $sql.=" and live_date='".$fromdt."'";
}
else if($todt!="")
{
$sql.=" and live_date='".$todt."'";
}

$sql.=" order by SN desc";



//echo $sql;
/*
if($DVRName1!=""){
$sql.=" and DVRName='".$DVRName1."'";
}

if($ATMShortName1!=""){
$sql.=" and ATMShortName='".$ATMShortName1."'";
}
*/

    $result  =mysqli_query($conn,$sql);
    $Num_Rows=mysqli_num_rows($result);
    $qr22    =$sql;
    $Per_Page= $_POST['perpg'];   // Records Per Page

	
	
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
<input type="hidden" name="expdata" id="expdata" value="<?php echo "RMS"?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>

<center><div>Total Records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
   <th>Sr No</th>
      <!--<th>SN</th>-->
    <!--<th>Status</th>
    <th>Phase</th>-->
    <th>Customer</th>
    <th>Live</th>
      <th>Bank</th>
	  <th>Tracker No</th>
       <th>ATMID</th>
	   <th>ATMID_2</th>
    <!--<th>ATMID_3</th>
    <th>ATMID_4</th>
      <th>TrackerNo</th-->
       <th>ATMShortName</th>
	   <th>SiteAddress</th>
    <th>City</th>
    <th>State</th>
      <th>Zone</th>
	  <!--<th>View</th>-->
       <th>Panel_Make</th>
	   <th>OldPanelID</th>
	   <th>NewPanelID</th>
     <th>DVRIP</th>
    <th>DVRName</th>
	<th>DVR_Model_num</th>
	<th>Router_Model_num</th>
	
      <th>UserName</th>
       <th>Password</th>
	   <th>Live</th>
	   <th>LiveDate</th>
	   <th>Engineer Name</th>
	   <th>GSM Number</th>
	   <th>CSS BM</th>
	   <th>CSS BM Number</th>
	   <th>Back Officer Name</th>
	   <th>Back Officer Number</th>
      <th>HeadSupervisor Name</th>
       <th>HeadSupervisor Number</th>
	   <th>Supervisor Name</th>
    <th>Supervisor number</th>
	<th>Police number</th>
	<th>Police Station</th>
	<th>Atm Officer Name</th>
	<th>Atm Officer Number</th>
	<th>RA Name</th>
	<th>RA Number</th>
	<th>Installation date</th>
	<th>Site Add By</th>
	<th>Site Edit By</th>
	<th>Remark</th>
	<th>RouterIp  </th>
	
	
	<th>Edit</th>
	   <th>Image</th>
	<th>Update</th>
	<?php if($_SESSION['id']==27 || $_SESSION['id']==24){?>
     <th>Send Mail</th> 
	 
	<?php }?> 
       <th>Action</th> 
  </tr>
 <?php 
$srno=1;
 while($row = mysqli_fetch_array($qrys)) { 
 
 $sql1="select * from esurvsites where ATM_ID='".$row["ATMID"]."'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
 
 $sql2="select files from site_attachment where site_id='".$row[0]."'";
 $result2=mysqli_query($conn,$sql2);
 $row2=mysqli_fetch_array($result2);
  
  
  /*
  $sql1="select * from esurvsites2 where ATM_ID='".$row["ATMID"]."'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
 
 $sql2="select files from site_attachment where site_id='".$row[0]."'";
 $result2=mysqli_query($conn,$sql2);
 $row2=mysqli_fetch_array($result2);
 */
 ?>

 

 <tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
    <td><?php echo $row["Customer"];?></td>
    <td>
      <a href="updateSites.php?process=rms&id=<?php echo $row[0];?>">Live</a>

      <?php $rms_sql = mysqli_query($conn,"select * from rms_update where rms_id = '".$row[0]."'");
if($rms_sql_result = mysqli_fetch_assoc($rms_sql)){ ?>

| <a href="tcpdf/TCPDF-main/examples/report.php?id=<?php echo $row[0];?>" target="_blank">PDF</a>
<?php }      ?>  
    </td>
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

	<td><?php echo $row["Panel_Make"];?></td>
	 <td><?php echo $row["OldPanelID"];?></td>
	<td><?php echo $row["NewPanelID"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
	
    <td><?php echo $row["DVRName"];?></td>
	<td><?php echo $row["DVR_Model_num"];?></td>
	<td><?php echo $row["Router_Model_num"];?></td>
	
	
	
    <td><?php echo $row["UserName"];?></td>
    <td><?php echo $row["Password"];?></td>
	<td><?php echo $row["live"];?></td>
	<td><?php echo $row["live_date"];?></td>
	<td><?php echo $row["eng_name"];?></td>
   <?php
   $gsm="select TwoWayNumber from esurvsites where ATM_ID='".$row["ATMID"]."'";
$gsmrun=mysqli_query($conn,$gsm);
$gsmfetch=mysqli_fetch_array($gsmrun);
   
   ?>
   <td><?php echo $gsmfetch[0];?></td>
   <td><?php echo $row1["CSSBM"];?></td>
   <td><?php echo $row1["CSSBMNumber"];?></td>
   <td><?php echo $row1["BackofficerName"];?></td>
   <td><?php echo $row1["BackofficerNumber"];?></td>
   <td><?php echo $row1["HeadSupervisorName"];?></td>
   <td><?php echo $row1["HeadSupervisorNumber"];?></td>
   <td><?php echo $row1["SupervisorName"];?></td>
   <td><?php echo $row1["Supervisornumber"];?></td>
   
   <td><?php echo $row1["Policestation"];?></td>
   <td><?php echo $row1["Polstnname"];?></td>
   <td><?php echo $row1["atm_officer_name"];?></td>
   <td><?php echo $row1["atm_officer_number"];?></td>
   <td><?php echo $row1["RA_QRT_NAME"];?></td>
   <td><?php echo $row1["RA_QRT_NUMBER"];?></td>

   <td><?php echo $row["current_dt"];?></td>
   <td><?php echo $row["addedby"];?></td>
   <td><a onclick="window.open('sitelogview.php?siteid=<?php echo $row[0];?>', '_blank', 'location=yes,height=500,width=1200,left=100,scrollbars=yes,status=yes');" style="color: red;">view</a></br></br>
 <?php echo $row["editby"];?></td>
   <td><?php echo $row["site_remark"];?></td>
   
   
   <?php 
   $brodChkAvilable=mysqli_query($conn,"select * from broadbanddetails where atmid='".$row["ATMID"]."' ");
   $brodChkfetch=mysqli_fetch_array($brodChkAvilable);
   ?>
   
   
   <td><?php echo $row["RouterIp"];?></td>

   
   
   <td><?php if(in_array ( 51, $arr)){ ?> <a href="edit2Demo.php?atmid=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a><?php } ?></td>
   <td><a href="<?php echo $row2["files"] ?>" download ><?php echo '<img src="'.$row2["files"].'" height="120" width="120">';?></a></td>
   <td><?php if(in_array ( 51, $arr)){ ?><a href="editwith_update.php?atmid=<?php echo $row[5];?>"  title="Edit" class="icon-1 info-tooltip">update</a><?php } ?></td>
   <td>
  <?php if(($_SESSION['id']==24 && $row["live"]=='Y')  || ($_SESSION['id']==27 && $row["live"]=='Y')){?>
    <a href="gmail_attached?ids=<?php echo $row[0]; ?>"  title="send" class="icon-1 info-tooltip">Send Mail</a>
   <?php } ?> 
  </td>
   <td> <?php if($row["live"]!="T"){?><input type="button" value="Testing" id="testing<?php echo $row[0];?>" name="testing<?php echo $row[0];?>" onclick="TestingAction1('T','<?php echo $row[0];?>','<?php echo $row['ATMID'];?>')" />
        <?php }else{?><input type="button" value="Live" id="Live<?php echo $row[0];?>" name="Live<?php echo $row[0];?>" onclick="TestingAction1('Y','<?php echo $row[0];?>','<?php echo $row['ATMID'];?>')" /></td><?php }?>
 

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


}else if($project=="2"){


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


//echo $sql;
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
<input type="hidden" name="expdata" id="expdata" value="<?php echo "DVR"?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>

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
} else if($project=="3"){
	
	
$DVRIP1=$_POST['DVRIP'];
$atmid=$_POST['atmid'];
$lstatus=$_POST['lstatus'];
$strPage=$_POST['Page'];
$cssbm=$_POST['cssbm'];
$customer=$_POST['cust'];
$track=$_POST['track'];




$sql="select * from dvronline  where 1=1  ";

if($customer!=""){
$sql.=" and customer='".$customer."'";	
}

if($lstatus!=""){
$sql.=" and Status='".$lstatus."'";	
}



if($DVRIP1!=""){
$sql.=" and IPAddress='".$DVRIP1."'";
}

if($atmid!=""){
$sql.=" and ATMID like '%".$atmid."%' ";
}

 
if($cssbm!=""){
$sql.=" and ATMID in(select ATM_ID from esurvsites where CSSBM='$cssbm')";	
}


//echo $sql;
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
<input type="hidden" name="expdata" id="expdata" value="<?php echo "Cloud"?>">
<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>

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
	    <th>Router ID</th>
	  <th>Edit</th>
	
	
  </tr>
 <?php 
$srno=1;
 while($row = mysqli_fetch_array($qrys)) { 
 
  
 ?>

 

 <tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
    
    <td><?php echo $row["customer"];?></td>
    <td><?php echo "NA";?></td>
	<td><?php echo "NA";?></td>
    <td><?php echo $row["ATMID"];?></td>
	
	<td><?php echo "NA";?></td>
    
    <td><?php echo $row["Address"];?></td>
	<td><?php echo $row["Location"];?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo $row["State"];?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo $row["IPAddress"];?></td>
	
	<td><?php echo $row["dvrname"];?></td>
    <td><?php echo "NA";?></td>
	<td><?php echo "NA";?></td>
	<td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
	 <td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo "NA";?></td>
    <td><?php echo $row["Live Date"];?></td>
     <td><?php echo "NA";?></td>
	 <td><?php echo $row["UserName"];?></td>
    <td><?php echo $row["Password"];?></td>
	<td><?php echo $row["Rourt ID"];?></td>
    
	
	<td> <a href="editOnlineDVR.php?atmid=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>
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
}

}else
{ 
 header("location: index.php");
}
?>


