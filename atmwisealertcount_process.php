<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
date_default_timezone_set('Asia/Kolkata');
$currtime=date('Y-m-d');
?>


<html>

<style>
table{
	width:100%;
}
td{
	padding:10px;
	font-size:12px;
	font-weight: bold;
	color:#000;
}

tr:hover {
background-color:#eee !important;
}
tr,th{
	padding:10px;
	background-color:#8cb77e; 
	color:#fff;
	font-size:12px;
}
</style>

<!--<div align="center">total records:<?php echo $Num_Rows?></div>-->
  <table border=1 style="margin-top:30px">
  <tr>
    <th>S.No.</th>
    <th>ATMID</th>
	<th>Panel Name</th>
	<th>DVR Name</th>
	<th>Alert Count</th>
  </tr>

  <?php 
    $sp = "SELECT s.ATMID,s.NewPanelID,s.Panel_Make,s.DVRName, IF(a.cnt IS NULL, 0, a.cnt) AS alert_count
                 FROM `sites` s LEFT JOIN (select panelid,COUNT(id) AS cnt from alerts WHERE sendtoclient='S' AND CAST(receivedtime AS DATE)='".$currtime."' 
				 GROUP BY panelid) a ON a.panelid = s.NewPanelID WHERE s.live='Y' AND DVRName IN ('Hikvision','CPPLUS_INDIGO','CPPLUS') ORDER BY alert_count DESC"; 
	//$sp="select ATMID,NewPanelID,Panel_Make,DVRName from sites where live='Y' AND DVRName IN ('Hikvision','CPPLUS_INDIGO','CPPLUS')";;
	//echo $sp;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	$sr = 1;
	?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	    $_atmid = $fetch['ATMID'];
		$panelid = $fetch['NewPanelID'];
		$_panelname = $fetch['Panel_Make'];
		$_dvrname = $fetch['DVRName'];
		$alert_count = $fetch['alert_count'];
		//$query = "select id from alerts where panelid ='".$panelid."' AND status='O' AND sendtoclient='S' AND CAST(receivedtime AS DATE)='".$currtime."'";
		//$sql = mysqli_query($conn,$query);
		//$alert_count = mysqli_num_rows($sql);
	
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $_atmid;?></td>
    <td><?php echo $_panelname;?></td>
    <td><?php echo $_dvrname;?></td>
    <td><?php echo $alert_count;?></td>
	
</tr>
<?php

     $sr++;
	
     }
	 $abs=$sr++;
	 $absf=$abs -1;
	 ?><div align="center">total records:<?php echo $absf;?></div>  <?php

  
?>

</table>

 </form>

	</div >

</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>








