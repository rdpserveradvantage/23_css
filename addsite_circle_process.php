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
$atmid = $_POST['atmid'];
$site_type = $_POST['site_type'];
$name=$_POST['circle'];
$zonal = $_POST['zonal'];
$bank = 'PNB';

$upper_name = strtoupper($name);

if(isset($_POST['sub'])){
$check_circle = mysqli_query($conn,'select * from site_circle WHERE ATMID="'.$atmid.'"');

if(mysqli_num_rows($check_circle)==0){

    $sn = mysqli_fetch_assoc(mysqli_query($conn,"select SN from sites where ATMID='".$atmid."'"))['SN'];


 $sql="insert into site_circle(ATMID,site_type,Bank,Zonal,Circle,sn)
values('$atmid','$site_type','$bank','$zonal','$name','$sn')";
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
alert("SiteCircle Added Successfull!");
window.open("viewsitecircle.php","_self");
</script> 
<?php }else{
  // echo mysqli_error($conn);
}
}else{
?>

<script>
alert("SiteCircle Already Exists!");
window.open("addsite_circle.php","_self");
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

