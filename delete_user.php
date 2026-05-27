<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');
?>


<?php
$id=$_REQUEST['id'];
if($id!=""){?>
<script>
var conf=confirm("Are you sure to Delete User");
	if(conf==true){
	
		<?php
		
	$sql="delete from loginusers where id='".$id."'";
    $runsql=mysqli_query($conn,$sql);	
	
	?>
	window.open("viewusers.php","_self");
	}else{
		alert("Your User Is Safe");
		window.open("viewusers.php","_self");
	}
	</script>
	<?php
	
}
}else
{ 
 header("location: index.php");
}
?>