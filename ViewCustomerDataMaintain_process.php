<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$Callreceivedfrom=$_POST['Callreceivedfrom'];
$Bank=$_POST['Bank'];
$action=$_POST['action'];
$strPage=$_POST['Page'];
$cssbm=$_POST['cssbm'];
$customer=$_POST['cust'];
$track=$_POST['track'];
$Mstatus=$_POST['Mstatus'];
$Customerstatus=$_POST['CustomerStatus'];

$sql="select * from customerdatamaintain  where 1=1  ";

if($customer!=""){
$sql.=" and CustomerName='".$customer."'";	
}
if($action!="" && $action!="All"){
$sql.=" and live='".$action."'";	
}

if($Mstatus!=""){
$sql.=" and MaterialStatus='".$Mstatus."'";	
}

if($Callreceivedfrom!=""){
$sql.=" and Callreceivedfrom='".$Callreceivedfrom."'";	
}

if($Bank!=""){
$sql.=" and Bank like '%".$Bank."%'";
}

if($cssbm!=""){
$sql.=" and BranchManager='".$cssbm."'";
}

 if($track!=""){
$sql.=" and ATMID_TrackerID like '%".$track."%' ";	
}
if($Customerstatus!=""){
$sql.=" and custStatus like '%".$Customerstatus."%' ";	
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
<!--<button id="myButtonControlID" onClick="expfunc();">Export Table data into Excel</button>-->

<center><div>Total Records:<?php echo $Num_Rows?></div></center>
  <table border=1 style="margin-top:30px">
  <tr>
      <th>Sr No</th>
      <th>Date_of_Call  </th>
	  <th>Bank  </th>
      <th>CustomerName  </th>
	  <th>CallReceivedFrom </th>
      <th>ATMID_TrackerID  </th>
	  <th>Address  </th>
      <th>City </th>
	  <th>State  </th>
      <th>Zone </th>
      <th>MaterialStatus  </th>
      <th>BranchManager </th>
	  <th>POD_Details  </th>
	  <th>Customerstatus  </th>
      <th>RequiredMaterial  </th>
      <th>MatetialDispatchDate  </th>
	  
	  <th>MaterialDeliveredDate   </th>
      <th>FundRequiredAmount   </th>
	  <th>FundTransferDate   </th>
      <th>FundStatus   </th>
      <th>FundTransferTo  </th>
	  <th>Remarks   </th>
	  <th>PartiallySiteMaterialDetails </th>
	  
	  <th>PartiallySitePOD_Details   </th>
      <th>PartiallyLiveSiteSchedule    </th>
	  <th>PartiallySiteLiveStatus    </th>
      <th>Aging    </th>
	  <th>Live Status</th>
      <th>Entry_Date </th>
	   <th>Remark Last/All </th>
	  <th>Update </th>
	  <th>Edit</th>
	
	
  </tr>
 <?php 
$srno=1;
 while($row = mysqli_fetch_array($qrys)) { 
 
 
 if($row["Date_of_Call"]!="1997-01-01"){
 $c=date('Y-m-d');
   $dStart = new DateTime($row["Date_of_Call"]);
   $dEnd  = new DateTime($c);
   $dDiff = $dStart->diff($dEnd);
   $diffAgging= $dDiff->format('%r%a'); 
   
   $show_Date_of_Call=$row["Date_of_Call"];
 }else{
	 $diffAgging= "NA";
	 $show_Date_of_Call="";
 }
 
 if($row["MatetialDispatchDate"]!="1997-01-01"){
	 $showMatetialDisDate=$row["MatetialDispatchDate"];
 }else{
	 $showMatetialDisDate="";
 }
 
 if($row["MaterialDeliveredDate"]!="1997-01-01"){
	 $showMatDelDate=$row["MaterialDeliveredDate"];
 }else{
	 $showMatDelDate="";
 }
 
 
 if($row["FundTransferDate"]!="1997-01-01"){
	 $showFundTraDate=$row["FundTransferDate"];
 }else{
	 $showFundTraDate="";
 }
 
 ?>

 

 <tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
   
    <td><?php echo $show_Date_of_Call;?></td>
    <td><?php echo $row["Bank"];?></td>
    <td><?php echo $row["CustomerName"];?></td>
    <td><?php echo $row["CallReceivedFrom"];?></td>
	<td><?php echo $row["ATMID_TrackerID"];?></td>
    <td><?php echo $row["Address"];?></td>
	
	<td><?php echo $row["City"];?></td>
     <td><?php echo $row["State"];?></td>
    <td><?php echo $row["Zone"];?></td>
    <td><?php echo $row["MaterialStatus"];?></td>
    <td><?php echo $row["BranchManager"];?></td>
	<td><?php echo $row["POD_Details"];?></td>
	<td><?php echo $row["custStatus"];?></td>
    <td><?php echo $row["RequiredMaterial"];?></td>
    <td><?php echo $showMatetialDisDate;?></td>
    <td><?php echo $showMatDelDate;?></td>
    <td><?php echo $row["FundRequiredAmount"];?></td>
	
	<td><?php echo $showFundTraDate;?></td>
    <td><?php echo $row["FundStatus"];?></td>
	<td><?php echo $row["FundTransferTo"];?></td>
	<td><?php echo $row["Remarks"];?></td>
    <td><?php echo $row["PartiallySiteMaterialDetails"];?></td>
    <td><?php echo $row["PartiallySitePOD_Details"];?></td>
    <td><?php echo $row["PartiallyLiveSiteSchedule"];?></td>
    <td><?php echo $row["PartiallySiteLiveStatus"];?></td>
	<td><?php echo $diffAgging;?></td>
	<td><?php echo $row["live"];?></td>
	<td><?php echo $row["Entrydate"];?></td>
    
	<?php $GetValue=mysqli_query($conn,"select remark from custdatamaintainremark where cust_Id='". $row["ATMID_TrackerID"]."' order by id desc limit 1");
	      $fetchValue=mysqli_fetch_array($GetValue);
	?>
	<td><?php echo $fetchValue["remark"];?>
	
	</td>
	
	
	<td><input type="button" id="opene" onclick="dailogBox('<?php echo $row[5]; ?>')" value="Update"/></td>
	
	<td> <a href="edit_custDataMaintain.php?atmid=<?php echo $row[0]; ?>"  title="Edit" class="icon-1 info-tooltip">Edit</a></td>
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


