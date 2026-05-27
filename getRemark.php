<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{

include ('config.php');

$atmid=$_POST['atmid'];
$sql="select * from custdatamaintainremark  where cust_id='".$atmid."'  ";
$result=mysqli_query($conn,$sql);
$Num_Rows=mysqli_num_rows($result);
?>
<!--<center><div>Total Records:<?php echo $Num_Rows?></div></center>-->
 <table border=1 >
			<tr><th>Srno</th><th>Remark</th><th>Entrydate</th><th>Updateby</th><th>ATM-ID / Tracker</th></tr>
           
		   <?php 
$srno=1;
 while($row = mysqli_fetch_array($result)) { 
 ?>
<tr style="background-color:#cfe8c7">
    <td><?php echo $srno;?></td>
    <td><?php echo $row["remark"];?></td>
    <td><?php echo $row["entrydate"];?></td>
    <td><?php echo $row["updateby"];?></td>
    <td><?php echo $atmid;?></td>
</tr>			
			
 <?php 
  $srno++;
 }
 ?>

    
     </table>
<?php }else
{ 
 header("location: index.php");
}