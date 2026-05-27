<?php

session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';?>
<html>
    <head>
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
  -->
<body>
<?php
$State=$_POST['State'];
$City=$_POST['City'];


$sql="insert into cities(city,state_id) values('$City','$State')";
//echo $sql;
$result=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);

if($last){
?>
<script>
alert("Added successfully");
          window.open("addsite.php", "_self");
        </script>
<script>

/*
swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("addsite.php","_self");
*/

</script> 

</body>
</html>

<?php
}
}else
{ 
 header("location: index.php");
}
?>

