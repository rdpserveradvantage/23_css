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

$MainID=$_POST['MainID'];
$name=$_POST['name'];
$lname=$_POST['lname'];
$father=$_POST['father'];
$Mother=$_POST['Mother'];
$Address=$_POST['Address'];
$State=$_POST['State'];
$City=$_POST['City'];
$pincode=$_POST['pincode'];
$mob1=$_POST['mob1'];
$mob2=$_POST['mob2'];
$Email=$_POST['Email'];
//$dob=$_POST['dob'];
$marrage=$_POST['marriage'];
$Department=$_POST['Department'];
$Employeeid=$_POST['Employeeid'];
$Work=$_POST['Work'];
//$Joining=$_POST['Joining'];

$pname=$_POST['pname'];
$plname=$_POST['plname'];
$pAddress=$_POST['pAddress'];
$State1=$_POST['State1'];
$City1=$_POST['City1'];
$pincode2=$_POST['pincode2'];
$pmob1=$_POST['pmob1'];
$Relationship=$_POST['Relationship'];
$pmob2=$_POST['pmob2'];

/*date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
*/
/*$abc="select state from state where state_id='".$State."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$abc2="select state from state where state_id='".$State1."'";
$runabc2=mysqli_query($conn,$abc2);
$fetch2=mysqli_fetch_array($runabc2);
*/
//echo $sql;
$sql="update employee set name='".$name."',lname='".$lname."',father='".$father."',Mother='".$Mother."',Address='".$Address."',State='".$State."',City='".$City."',pincode='".$pincode."',mob1='".$mob1."',mob2='".$mob2."',Email='".$Email."',marriage='".$marrage."',Department='".$Department."',Employeeid='".$Employeeid."',Work='".$Work."',parent_name='".$pname."',parent_lastname='".$plname."',parent_Address='".$pAddress."',patent_State='".$State1."',parent_City='".$City1."',parent_pincode='".$pincode2."',parent_mob1='".$pmob1."',parent_mob2='".$pmob2."',Relationship='".$Relationship."' where id='".$MainID."'";
$result=mysqli_query($conn,$sql);

if($result){
 
?>
<script>
window.open("viewemp.php", "_self");
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

