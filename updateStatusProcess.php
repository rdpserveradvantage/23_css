<?php session_start();
include("config.php");

$status=$_POST['status'];
$remark=$_POST['remark'];
$Mstatus=$_POST['MUstatus'];
$Customerstatus=$_POST['Customerstatus'];

$hd_id=$_POST['hd_id'];
$entrydt=date("Y-m-d H:i:s");


$q=mysqli_query($conn,"insert into custdatamaintainremark (cust_Id,remark,entrydate,updateby) value('".$hd_id."','".$remark."','".$entrydt."','".$_SESSION['name']."')");
$U=mysqli_query($conn,"update CustomerDataMaintain set  live='".$status."',MaterialStatus='".$Mstatus."',custStatus='".$Customerstatus."'  where ATMID_TrackerID='".$hd_id."' ");


if($q && $U){
	echo "1";
}else{
	echo "0";
}

?>