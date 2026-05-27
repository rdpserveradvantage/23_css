<?php
include 'config.php';
$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";

$result=mysqli_query($conn,$abc);

?>
<table border=1 style="margin-top:30px">
 <!-- <tr>
      <th>Customer</th>
    <th>Bank</th>
    <th>ATMID</th>
    <th>ATMShortName</th>
      <th>SiteAddress</th>
       <th>DVRIP</th>
	   <th>Panel_make</th>
	   <th>panelid</th>
    <th>createtime</th>
    <th>receivedtime</th>
	 <th>comment</th>
	 
    
  </tr>-->
 <?php  while($row = mysqli_fetch_array($result)) { ?>

 <tr style="background-color:#cfe8c7">

    <td><?php echo $row["Customer"];?></td>
    <td><?php echo $row["Bank"];?></td>
    <td><?php echo $row["ATMID"];?></td>
    <td><?php echo $row["ATMShortName"];?></td>
    <td><?php echo $row["SiteAddress"];?></td>
    <td><?php echo $row["DVRIP"];?></td>
    <td><?php echo $row["Panel_make"];?></td>	
	<td><?php echo $row["panelid"];?></td>
    <td><?php echo $row["createtime"];?></td>
    <td><?php echo $row["receivedtime"];?></td>
	 
    <?php


//$a="smart";

if(strpos($row["Panel_make"], 'SMART') !== FALSE)
    {
    
$sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";
//	$result1=mysqli_query($conn,$sql1);
	
    }
	 else
	{
		/* $sql2="select a.Description,a.Camera,a.SH ,b.Zone from zonecameras a , smartialarms b where (b.Zone=a.ZoneNo)";
		 $result2=mysqli_query($conn,$$sql2);
		 */
		 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
	//	 $result2=mysqli_query($conn,$sql2);
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 ?>
	 
	<td><?php echo $row1["Description"];?></td>
	<td><?php echo $row["comment"];?></td>
    </tr>
<?php 
}
?>
</table>
