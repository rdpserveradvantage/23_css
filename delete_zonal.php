<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

$created_at = date('Y-m-d H:i:s');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    include ('config.php');
	$user_id = $_SESSION['id'];
	$id=$_REQUEST['id'];
	if($id!=""){
		$sql="delete from site_circle_zonal where id='".$id."'";
		$runsql=mysqli_query($conn,$sql);	
		echo '1';
	}else{ 
	    echo '0';
	}
}else{
	echo '2';
 	//header("location: index.php");
}
?>