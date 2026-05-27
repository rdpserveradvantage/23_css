<?php session_start();
if(!isset($_SESSION['login_user']) && !isset($_SESSION['id']))
{
	 header("location: index.php");
}else{ include('config.php');
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     


<style>
table{
	width:80%;
	align:center;
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
<body style="background-color: #dce079">
<?php include 'menu.php'; ?>
<table border=1 style="margin-top:89px;">
<tr>
<th>BraodBand Name</th>
<th>ATMID</th>
<th>ProviderEmail</th>
<th>ProviderMobile</th>
<th>ExpiryDate</th>
<th>Days Remaining</th>
<th>Renewal</th>
</tr>



<?php $ExpiryQry=mysqli_query($conn,"SELECT * FROM `broadbanddetails` WHERE Status='1'");

while($FetchExpiry=mysqli_fetch_array($ExpiryQry)){
	
	$d=date('Y-m-d');
	$date1=date_create($FetchExpiry['ExpiryDate']);
$date2=date_create($d);
$diff=date_diff($date1,$date2);
 $day= $diff->format("%R%a days");
	
	?>



	<tr>
<td><?php echo $FetchExpiry['ProviderName'];?></td>
<td><?php echo $FetchExpiry['atmid'];?></td>
<td><?php echo $FetchExpiry['ProviderEmail'];?></td>
<td><?php echo $FetchExpiry['ProviderMobile'];?></td>

<td><?php echo $FetchExpiry['ExpiryDate'];?></td>
<td><?php echo $day;?></td>

<td><input type="button" value="Renewed" onclick='window.open("RenewalEditSite.php?SN=<?php echo $FetchExpiry[1]?>")'></td>
</tr>
	
<?php } ?>

	</table>
	
	
	
	
<?php } ?>