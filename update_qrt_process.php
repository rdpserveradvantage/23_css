<?php
session_start();
include 'config.php';

$SN=$_POST['SN'];
$cmt=$_POST['cmt'];
$drop=$_POST['drop'];

date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");

$SQ="select * from qrt_arrange where id='".$SN."'";
$sqrun=mysqli_query($conn,$SQ);
$counts=mysqli_num_rows($sqrun);
//echo $counts;
if($counts >0){

	
	
	$sql2="update qrt_arrange set status='".$drop."' where id='".$SN."'";
	$runsql2=mysqli_query($conn,$sql2);
	//echo $sql2;
	
	$sql="insert into qrt_update(qid,close_comment,close_date,status,closeby) values('".$SN."','".$cmt."','".$curentdt."','".$drop."','".$_SESSION['login_user']."')";
	$runsql=mysqli_query($conn,$sql);
}

if($runsql || $runsql2)
{
  echo "1";  
}
else
{
    echo "0";
}

?>