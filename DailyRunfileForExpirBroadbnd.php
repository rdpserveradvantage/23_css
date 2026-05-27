<?php
 include('config.php');
 $ExpiryQry=mysqli_query($conn,"SELECT id FROM `broadbanddetails` WHERE ExpiryDate < CURDATE() + interval 1 Month - interval 1 DAY");

while($FetchExpiry=mysqli_fetch_array($ExpiryQry)){
	
	$ExpUpdateQry=mysqli_query($conn,"update `broadbanddetails` set Status='1' WHERE id='".$FetchExpiry['id']."'");

}
	?>
 

	 
