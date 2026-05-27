<?php session_start();
date_default_timezone_set('Asia/Kolkata');

$created_at = date('Y-m-d H:i:s');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';?>
<html>
    <head>
        
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        

<body>
<?php
$user_id = $_SESSION['id'];
//echo $user_id;
$name=$_POST['circle'];
$zonal = $_POST['zonal'];

$upper_name = strtoupper($name);
$zon_upper_name = strtoupper($zonal);

if(isset($_POST['sub'])){
$check_circle = mysqli_query($conn,'select * from circle_master WHERE UPPER(Circle)="'.$upper_name.'" AND UPPER(Zonal)="'.$zon_upper_name.'"');

if(mysqli_num_rows($check_circle)==0){
 $sql="insert into circle_master(Circle,Zonal,created_at,created_by)
values('$name','$zonal','$created_at','$user_id')";
$result=mysqli_query($conn,$sql);
//echo $sql;

if($result){
?>

<script>
/*
swal({
  title: "Register Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("addusers.php","_self");

*/
alert("Circle Added Successfull!");
window.open("viewcircle.php","_self");
</script> 
<?php }else{
  // echo mysqli_error($conn);
}
}else{
?>

<script>
alert("Circle Already Exists!");
window.open("addcircle.php","_self");
</script> 

<?php }?>
</body>
</html>

<?php
}}else
{ 
 header("location: index.php");
}
?>

