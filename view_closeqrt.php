<?php
include 'config.php';


$alert_id=$_REQUEST['alertid'];

$sql="select id,comment,qrt_arrangetime,user_id from qrt_arrange where alert_id='".$alert_id."'";

$runsql=mysqli_query($conn,$sql);
$fetch=mysqli_fetch_array($runsql);



?>
<table align="center" border="1">
<tr>
<th>Comment</th>
<th>Date</th>
<th>Close By</th>
</tr>
<?php 
$sql2="select * from qrt_update where qid='".$fetch[0]."'";
$runsql2=mysqli_query($conn,$sql2);

$sql3="select name from users where id='".$fetch[3]."'";
$runsql3=mysqli_query($conn,$sql3);
$fetch3=mysqli_fetch_array($runsql3);
?>
<tr>
<td><?php echo $fetch[1];?></td>
<td><?php echo $fetch[2];?></td>
<td><?php echo $fetch3[0];?></td>
</tr>
<?php
while($fetch2=mysqli_fetch_array($runsql2)){?>

<tr>
<td><?php echo $fetch2['close_comment'];?></td>
<td><?php echo $fetch2['close_date'];?></td>
<td><?php echo $fetch2['closeby'];?></td>

</tr>	
	
	
	
<?php 
}

?>

</table>

	
	
