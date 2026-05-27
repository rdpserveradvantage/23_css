<?php
include 'config.php';
$id=$_POST['id'];
//echo $id; 
$fn=$_POST['fn'];
$name=$_POST['name'];
$password=$_POST['password'];
$drop=$_POST['drop'];


$RMS = $_POST['RMS'];
$DVR = $_POST['DVR'];
$Cloud = $_POST['Cloud'];
$GPS = $_POST['GPS'];
$microRMS = $_POST['MicroRMS'];


$sql="update LoginUsers set name='$fn',uname='".$name."',pwd='$password',permission='$drop',
RMS='".$RMS."',DVR='".$DVR."',Cloud='".$Cloud."',GPS='".$GPS."',`Micro RMS`='".$microRMS."'
 where id='".$id."'";
$result=mysqli_query($conn,$sql);
if($result!=""){
  echo "1";  
}
else
{
    echo "0";
}
?>

