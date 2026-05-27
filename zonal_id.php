<?php
include 'config.php';
$Zonal=$_REQUEST['Zonal'];

$data=array();
$sql="select Circle from circle_master where Zonal='".$Zonal."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['zonalid'=>$row['Circle']];
}
echo json_encode($data);
?>