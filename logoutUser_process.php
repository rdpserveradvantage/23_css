<?php session_start();
include 'config.php';


$ip=$_POST['ip'];

$q=mysqli_query($conn,"update alertscount set status='0' where ip='".$ip."'");
if($q){
	echo "1";
}else{
	echo "0";
}

mysqli_close($conn);
?>