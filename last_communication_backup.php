<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
$comm=$_POST['comm'];

$alt="select createtime from alerts order by id asc limit 1";
$runalt=mysqli_query($conn,$alt);
$altfetch=mysqli_fetch_array($runalt);
//echo $altfetch[0];
$altlast="select createtime from alerts order by id desc limit 1";
$runaltlast=mysqli_query($conn,$altlast);
$altlastfetch=mysqli_fetch_array($runaltlast);

$helth="select rtime from wsites order by id asc limit 1";
$runhelth=mysqli_query($conn,$helth);
$healthfetch=mysqli_fetch_array($runhelth);


$blanck_date = date('Y-m-d', strtotime($healthfetch[0] .' -1 day'));
$sr=0;
 
date_default_timezone_set('Asia/Kolkata');
$currtime=date('Y-m-d');
$pre_date = date('Y-m-d', strtotime($currtime .' -1 day'));
$pre_date2 = date('Y-m-d', strtotime($currtime .' -2 day'));
$pre_date7 = date('Y-m-d', strtotime($currtime .' -7 day'));
$pre_date15 = date('Y-m-d', strtotime($currtime .' -15 day'));
  
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

  <table border=1 style="margin-top:30px">
  <tr>
  <th>sr</th>
      <th>Customer</th>
      <th>Bank</th>
      <th>Atm Id</th>
      <th>ATM Short Name</th>
	  <th>City</th>
      <th>state</th>
      <th>panel_make</th>
	  <th>OLD Panel id</th>
	  <th>New panel id</th>
      <th>dvr ip</th>
      <th>dvr name</th>
	  <th>Last alert Receive</th>
	 <th>Bm Name</th>
	 <th>Bm Number</th>
	 <th>Zone</th>
  </tr>
   
  <?php 

if($comm=="1"){
    
    
    $sp="select OLDPanelid,NewPanelID,Customer,atmid,ATMShortName,City,state,panel_make,dvrip,dvrname,username,password,Zone,Bank from sites where live='Y'";;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
	  if(mysqli_num_rows($rst)>0){
     while($fetch=mysqli_fetch_array($rst)){
		$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."')  and rtime between '".$currtime. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
		//echo $sq;
		$runsq=mysqli_query($conn,$sq);
		if(mysqli_num_rows($runsq)>0){
	    $fetch3=mysqli_fetch_array($runsq);
		$s= substr($fetch3[0], 1);	
        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone,Bank from sites where live='Y'  and DVRIP='".$s."'";
        
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
        $fetch2=mysqli_fetch_array($runab);
		
		$bmname="select CSSBM,CSSBMNumber from esurvsites where ATM_ID='".$fetch2[1]."'";
		$runbmname=mysqli_query($conn,$bmname);
		$bmfetch=mysqli_fetch_array($runbmname);
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch['Customer'];?></td>
    <td><?php echo $fetch['Bank'];?></td>
    <td><?php echo $fetch2[2];?></td>
	<td><?php echo $fetch2[3];;?></td>
    <td><?php echo $fetch2[4];?></td>
    <td><?php echo $fetch2[5];?></td>
	<td><?php echo $fetch2[6];?></td>
	<td><?php echo $fetch2[11];?></td>
    <td><?php echo $fetch2[7];?></td>
    <td><?php echo $fetch2[8];?></td>
    <td><?php echo $fetch3[1];?></td>
	<td><?php echo $bmfetch[0];?></td>
	<td><?php echo $bmfetch[1];?></td>
    <td><?php echo $fetch2[12];?></td>
</tr>
<?php

     $sr++;
	}
     }  
   }
}


elseif($comm=="2"){
 
$statement = "
SELECT 
    Customer, 
    Bank, 
    ATMID, 
    ATMShortName, 
    City, 
    state, 
    panel_make, 
    OLDPanelid, 
    NewPanelId, 
    dvrip, 
    dvrname, 
    Remark, 
    Zone 
FROM 
    (SELECT 
        s.Customer, 
        s.Bank, 
        s.ATMID, 
        s.ATMShortName, 
        s.City, 
        s.state, 
        s.panel_make, 
        s.OLDPanelid, 
        s.NewPanelId, 
        s.dvrip, 
        s.dvrname, 
        CASE WHEN MAX(w.rtime) >= CURDATE() THEN MAX(w.rtime) ELSE 'No today\'s data' END AS Remark, 
        s.Zone 
    FROM 
        sites s 
    INNER JOIN 
        sites_server_wise1 ssw ON s.ATMID = ssw.ATMID AND ssw.server_name = 21 
    LEFT JOIN 
        wsites w ON s.NewPanelId = w.panelid 
    WHERE 
        s.ATMID <> '' 
    GROUP BY 
        s.ATMID, 
        s.SN) AS subquery 
WHERE 
    CASE 
        WHEN STR_TO_DATE(Remark, '%Y-%m-%d %H:%i:%s') IS NULL THEN 1 
        ELSE CAST(Remark AS DATE) 
    END <> CURDATE() 
ORDER BY 
    Remark ASC;

" ; 
$sql = mysqli_query($conn,$statement);
$sr = 1; 
while($sqlResult = mysqli_fetch_assoc($sql)){

    $atmid = $sqlResult['ATMID'];

    $Customer = $sqlResult['Customer'];
    $Bank = $sqlResult['Bank'];
    $ATMID = $sqlResult['ATMID'];
    $ATMShortName = $sqlResult['ATMShortName'];
    $City = $sqlResult['City'];
    $state = $sqlResult['state'];
    $panel_make = $sqlResult['panel_make'];
    $OLDPanelid = $sqlResult['OLDPanelid'];
    $NewPanelID = $sqlResult['NewPanelID'];
    $dvrip = $sqlResult['dvrip'];
    $dvrname = $sqlResult['dvrname'];
    $remarkdate = $sqlResult['Remark'];
    $Zone = $sqlResult['Zone'];





    $bmname="select CSSBM,CSSBMNumber from esurvsites where ATM_ID='".$atmid."'";
    $runbmname=mysqli_query($conn,$bmname);
    $bmfetch=mysqli_fetch_array($runbmname);

?>


    <tr style="background-color:#cfe8c7">
        <td><?php echo $sr;?></td>
        <td><?php echo $Customer;?></td>
        <td><?php echo $Bank;?></td>
        <td><?php echo $atmid;?></td>
        <td><?php echo $ATMShortName;?></td>
        <td><?php echo $City; ?></td>
        <td><?php echo $State ; ?></td>
        <td><?php echo $panel_make;?></td>
        <td><?php echo $OLDPanelid;?></td>
        <td><?php echo $NewPanelID;?></td>
        <td><?php echo $dvrip;?></td>
        <td><?php echo $dvrname;?></td>
        <td><?php echo $remarkdate;?></td>
        <td><?php echo $bmfetch[0];?></td>
        <td><?php echo $bmfetch[1];?></td>
        <td><?php echo $Zone ;?></td>
    </tr>
    <?php


$sr++;

}

     ?>
	
     
<?php
     
  	
  
	 $abs=$sr++;
	 $absf=$abs -1;
	 $sites_server_wiseCount = mysqli_fetch_assoc(mysqli_query($conn,"SELECT count(1) as totalSites FROM `sites_server_wise1` where server_name=21"))['totalSites'] ; 
$foundRecords = $sr-1 ;
    ?>

    <h3 style="text-align:center;">Total Sites : <?php echo $sites_server_wiseCount ;  ?> </h3>
    <hr>

	 <div align="center">Not Working :<?php echo $foundRecords.'  Working -'.($sites_server_wiseCount - $foundRecords) ;
     
     ?></div> 

	 <?php
}
	
else if($comm=="0"){
	$sp="select OLDPanelid,NewPanelID,Customer,atmid,ATMShortName,City,state,panel_make,dvrip,dvrname,username,password,Bank from sites where live='Y'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";;
	//echo $sp;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
    <!--<div align="center">total records:<?php echo $Num_Rows?></div>-->
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$altfetch[0]."' and '".$altlastfetch[0]."'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
		
		$runsq=mysqli_query($conn,$sq);
		//if(mysqli_num_rows($runsq)>0){ continue; }
	   // $fetch3=mysqli_fetch_array($runsq);
		//$s= substr($fetch3[0], 1);
		
        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='".$fetch[0]."' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
        //echo $ab;
		
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
		
		
		
        $fetch2=mysqli_fetch_array($runab);
	$q="select max(rtime) from wsites where ip='/".$fetch[0]."'";
		//echo $sq;
		$runq=mysqli_query($conn,$q);
		
		$fet2=mysqli_fetch_array($runq);
		
		
	
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch['Customer'];?></td>
    <td><?php echo $fetch['Bank'];?></td>
    <td><?php echo $fetch['atmid'];?></td>
    <td><?php echo $fetch['ATMShortName'];?></td>
	<td><?php echo $fetch['City'];?></td>
    <td><?php echo $fetch['state'];?></td>
    <td><?php echo $fetch['panel_make'];?></td>
	<td><?php echo $fetch['OLDPanelid'];?></td>
	<td><?php echo $fetch['NewPanelID'];?></td>
    <td><?php echo $fetch['dvrip'];?></td>
    <td><?php echo $fetch['dvrname'];?></td>
	<?php if($fet2[0]!=""){ ?>
    <td><?php echo $fet2[0];?></td>
	<?php }else{?>
   <td><?php echo $blanck_date;?></td>
   <?php }?>
   
</tr>
<?php

     $sr++;
	
     }
	 $abs=$sr++;
	 $absf=$abs -1;
	 ?><div align="center">total records:<?php echo $absf;?></div>  <?php
}
		
    
elseif($comm=="3"){
   $sp="select oldpanelid,newpanelid from sites where live='Y'  and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
  
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$pre_date2. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
		
		$runsq=mysqli_query($conn,$sq);
		if(mysqli_num_rows($runsq)>0){ continue; }
	   
        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='".$fetch[0]."' and DVRName in('CPPLUS','Hikvision','CPPLUS_INDIGO')";
       
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
		
		
		
        $fetch2=mysqli_fetch_array($runab);
	$q="select max(rtime) from wsites where ip='/".$fetch[0]."'";
		
		$runq=mysqli_query($conn,$q);
		
		$fet2=mysqli_fetch_array($runq);
		
		
	
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2[0];?></td>
    <td><?php echo $fetch2[1];?></td>
    <td><?php echo $fetch2[2];?></td>
	<td><?php echo $fetch2[3];;?></td>
    <td><?php echo $fetch2[4];?></td>
    <td><?php echo $fetch2[5];?></td>
	<td><?php echo $fetch2[6];?></td>
	<td><?php echo $fetch2[11];?></td>
    <td><?php echo $fetch2[7];?></td>
    <td><?php echo $fetch2[8];?></td>
    <td><?php echo $fet2[0];?></td>
   
</tr>
<?php

     $sr++;
	
     }
	 $abs=$sr++;
	 $absf=$abs -1;
	 ?><div align="center">total records:<?php echo $absf;?></div>  <?php
}
   
   
    
elseif($comm=="4"){
    $sp="select oldpanelid,newpanelid from sites where live='Y'";;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
  
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$pre_date7. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
		
		$runsq=mysqli_query($conn,$sq);
		if(mysqli_num_rows($runsq)>0){ continue; }
	   
        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='".$fetch[0]."'";
       
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
		
		
		
        $fetch2=mysqli_fetch_array($runab);
	$q="select max(rtime) from wsites where ip='/".$fetch[0]."'";
		
		$runq=mysqli_query($conn,$q);
		
		$fet2=mysqli_fetch_array($runq);
		
		
	
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2[0];?></td>
    <td><?php echo $fetch2[1];?></td>
    <td><?php echo $fetch2[2];?></td>
	<td><?php echo $fetch2[3];;?></td>
    <td><?php echo $fetch2[4];?></td>
    <td><?php echo $fetch2[5];?></td>
	<td><?php echo $fetch2[6];?></td>
	<td><?php echo $fetch2[11];?></td>
    <td><?php echo $fetch2[7];?></td>
    <td><?php echo $fetch2[8];?></td>
    <td><?php echo $fet2[0];?></td>
   
</tr>
<?php

     $sr++;
	
     }
	 $abs=$sr++;
	 $absf=$abs -1;
	 ?><div align="center">total records:<?php echo $absf;?></div>  <?php
}
    
  
elseif($comm=="5"){
    $sp="select oldpanelid,newpanelid from sites where live='Y'";;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
  
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$pre_date15. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
		
		$runsq=mysqli_query($conn,$sq);
		if(mysqli_num_rows($runsq)>0){ continue; }
	   
        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID from sites where live='Y'  and DVRIP='".$fetch[0]."'";
       
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
		
		
		
        $fetch2=mysqli_fetch_array($runab);
	$q="select max(rtime) from wsites where ip='/".$fetch[0]."'";
		
		$runq=mysqli_query($conn,$q);
		
		$fet2=mysqli_fetch_array($runq);
		
		
	
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2[0];?></td>
    <td><?php echo $fetch2[1];?></td>
    <td><?php echo $fetch2[2];?></td>
	<td><?php echo $fetch2[3];;?></td>
    <td><?php echo $fetch2[4];?></td>
    <td><?php echo $fetch2[5];?></td>
	<td><?php echo $fetch2[6];?></td>
	<td><?php echo $fetch2[11];?></td>
    <td><?php echo $fetch2[7];?></td>
    <td><?php echo $fetch2[8];?></td>
    <td><?php echo $fet2[0];?></td>
   
</tr>
<?php

     $sr++;
	
     }
	 $abs=$sr++;
	 $absf=$abs -1;
	 ?><div align="center">total records:<?php echo $absf;?></div>  <?php
}
   
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