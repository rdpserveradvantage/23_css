<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';


$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$panel=$_POST['panels'];
$fix=30;

        if($from!="")
            {
            //$newDate = date_format($date,"y/m/d H:i:s");
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt=date('Y-m-d');;
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=date('Y-m-d'); 
                }

 $sr=1;
  
/*
if($viewalert=="" || $viewalert ==3){

$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
}
*/
if($panel==""){?>
<table border=1 style="margin-top:30px">
  <tr>
  <!--<th>sr</th>-->
       <th>Sr</th>
	   <th>DVRIP</th>
      <th>Panel_make</th>
	  <th>id</th>
      <th>panelid</th>
	  <th>zone</th>
      <!--<th>Zone</th>
      <th>Description</th>
	  <th>Code</th>
      <th>Camera</th>-->
	  <th>Count</th>
     
  </tr>
<?php

$xyz2="select distinct(zone) from alerts where createtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
$runxyz2=mysqli_query($conn,$xyz2);
$Num_Rows=mysqli_num_rows($runxyz2);
  
	  ?>
	  <div align="center">total records:<?php echo $Num_Rows?></div>
	  <?php
while($fetch=mysqli_fetch_array($runxyz2)){
	//echo $fetch[0];
$xyz="SELECT  a.DVRIP,a.Panel_make,b.id,b.panelid,b.zone FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and createtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."' and b.zone='".$fetch[0]."'";
$runxyz=mysqli_query($conn,$xyz);
$xyzfetch=mysqli_fetch_array($runxyz);

    $sql="select  count(*) from alerts where zone='".$xyzfetch[4]."' and createtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
    $runsql=mysqli_query($conn,$sql);
     $fetchsql=mysqli_fetch_array($runsql);	

?>
<tr style="background-color:#cfe8c7">
         <td><?php echo $sr;?></td>
    <td><?php echo $xyzfetch[0];?></td>
     <td><?php echo $xyzfetch[1];?></td>
     <td><?php echo $xyzfetch[2];?></td>
	 <td><?php echo $xyzfetch[3];?></td>
	 <td><?php echo $xyzfetch[4];?></td>
	 <td><?php echo $fetchsql[0];?></td>
	 </tr>
	 <?php
	 /*
     if(strpos($xyzfetch["Panel_make"], 'SMART') !== FALSE)
    {
    
$sql1="select Description,Camera from smartialarms where (Zone='".$xyzfetch[4]."')";

    }
	 else
	{
	 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$xyzfetch[4]."')"; 
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 ?>
	<td><?php echo $row1["Description"];?></td>
	<td><?php echo $row1["Camera"];?></td>
	<td><?php echo $fetchsql[0];?></td>
	*/
    ?>

   <?php
$sr++;
}
}

  ?>

<?php


//echo $abc;
  /* $result=mysqli_query($conn,$abc);
    
    $Num_Rows=mysqli_num_rows($result);
  
   $Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	 //   echo $Page_Start."-".$Page."-".$Page_Start;
	   $sr=($fix* $Page)-$fix;
	   
	   $sr=$sr+1;
	}
*/
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
 
       <th>Sr</th>
      <th>Zone</th>
      <th>Description</th>
	  <th>Code</th>
      <th>Camera</th>
	  <th>Count</th>
     
  </tr>

  <?php  
if($panel=="1"){
$abc="select Zone,Description,Code,Camera from smartialarms";
$result=mysqli_query($conn,$abc);
$Num_Rows=mysqli_num_rows($result);
  
	  ?>
	  <div align="center">total records:<?php echo $Num_Rows?></div>
	  <?php
  while($row = mysqli_fetch_array($result)) { 
  $sql="select  count(*) from alerts where zone='".$row[0]."' and createtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
 
  $runsql=mysqli_query($conn,$sql);
  $sqlfetch=mysqli_fetch_array($runsql);
 
  ?>

 <tr style="background-color:#cfe8c7">
         <td><?php echo $sr;?></td>
    <td><?php echo $row[0];?></td>
     <td><?php echo $row[1];?></td>
     <td><?php echo $row[2];?></td>
	 <td><?php echo $row[3];?></td>
	 <td><?php echo $sqlfetch[0];?></td>
     
    </tr>

   <?php
$sr++;
  ?>
<?php 
}
  } 
  
if($panel=="2"){
$abc="select ZoneNo,Description,SH,Camera from zonecameras";
$result=mysqli_query($conn,$abc);
$Num_Rows=mysqli_num_rows($result);
  
	  ?>
	  <div align="center">total records:<?php echo $Num_Rows?></div>
	  <?php
  while($row = mysqli_fetch_array($result)) { 
  $sql="select  count(*) from alerts where zone='".$row[0]."' and createtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
 
  $runsql=mysqli_query($conn,$sql);
  $sqlfetch=mysqli_fetch_array($runsql);
 
  ?>

 <tr style="background-color:#cfe8c7">
         <td><?php echo $sr;?></td>
    <td><?php echo $row[0];?></td>
     <td><?php echo $row[1];?></td>
     <td><?php echo $row[2];?></td>
	 <td><?php echo $row[3];?></td>
	 <td><?php echo $sqlfetch[0];?></td>
     
    </tr>

   <?php
$sr++;
  ?>
<?php 
}
  } 
  
if($panel=="3"){
$abc="select ZoneNumber,SensorsName,AlertCode,Camera from raxx";
$result=mysqli_query($conn,$abc);
$Num_Rows=mysqli_num_rows($result);
  
	  ?>
	  <div align="center">total records:<?php echo $Num_Rows?></div>
	  <?php
  while($row = mysqli_fetch_array($result)) { 
  $sql="select  count(*) from alerts where zone='".$row[0]."' and createtime between '".$fromdt. " 00:00:00" ."' and '".$todt. " 23:59:59" ."'";
 // echo $sql;
  
  $runsql=mysqli_query($conn,$sql);
  $sqlfetch=mysqli_fetch_array($runsql);
 // echo "ram".$sqlfetch[0];
  ?>

 <tr style="background-color:#cfe8c7">
         <td><?php echo $sr;?></td>
    <td><?php echo $row[0];?></td>
     <td><?php echo $row[1];?></td>
     <td><?php echo $row[2];?></td>
	 <td><?php echo $row[3];?></td>
	 <td><?php echo $sqlfetch[0];?></td>
     
    </tr>

   <?php
$sr++;
  ?>
<?php 
}
  } 
?>

</table>

 </form>

 <?php 
 /*
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}
*/
?>

	</div >

</body>
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>






