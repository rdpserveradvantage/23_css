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
//$from=$_POST['from'];
//$to=$_POST['to'];
//$strPage=$_POST['Page'];
//$fix=30;
/*            if($from!="")
            {
            //$newDate = date_format($date,"y/m/d H:i:s");
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }
*/
 $sr=0;
 
date_default_timezone_set('Asia/Kolkata');
$currtime=date('Y-m-d');
$pre_date = date('Y-m-d', strtotime($currtime .' -1 day'));
$pre_date2 = date('Y-m-d', strtotime($currtime .' -2 day'));
$pre_date7 = date('Y-m-d', strtotime($currtime .' -7 day'));
$pre_date15 = date('Y-m-d', strtotime($currtime .' -15 day'));
  

//$abc="select Customer,atmid,ATMShortName,state,panel_make,OLDPanelid,dvrip,dvrname,username,password from sites where live='Y'";

?>
<?php
/*
    $result=mysqli_query($conn,$abc);
    
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
    
    
    $sp="select oldpanelid,newpanelid from sites where live='Y' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";;
	//echo $sp;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
     while($fetch=mysqli_fetch_array($rst)){
		$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."')  and rtime between '".$currtime. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
		//echo $sq;
		$runsq=mysqli_query($conn,$sq);
		if(mysqli_num_rows($runsq)>0){
	    $fetch3=mysqli_fetch_array($runsq);
		$s= substr($fetch3[0], 1);	

        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone from sites where live='Y'  and DVRIP='".$s."' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";
        
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
        $fetch2=mysqli_fetch_array($runab);
		
		$bmname="select CSSBM,CSSBMNumber from esurvsites where ATM_ID='".$fetch2[1]."'";
		$runbmname=mysqli_query($conn,$bmname);
		$bmfetch=mysqli_fetch_array($runbmname);
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


elseif($comm=="2"){
	$sp="select oldpanelid,newpanelid from sites where live='Y' and ATMID IN (SELECT ATMID FROM sites_server_wise WHERE server_name='21')";
	//$sp="select oldpanelid,newpanelid from sites where live='Y' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";
	//echo $sp;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	//echo " totalsite-".$Num_Rows."<br>";
	?>
    <!--<div align="center">total records:<?php echo $Num_Rows?></div>-->
    <?php $test="0";
     while($fetch=mysqli_fetch_array($rst)){
	 
$sq="select ip,rtime,panelid from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."')   and rtime between '".$currtime. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";

		//echo $sq;
		$runsq=mysqli_query($conn,$sq);
	
		if(mysqli_num_rows($runsq)>0){ $test++; continue; }
	    //$fetch3=mysqli_fetch_array($runsq);
		//$s= substr($fetch3[0], 1);
		if($fetch[0]!='-' && $fetch[1]!='-'){
            $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone,Bank from sites where live='Y' and (OLDPanelid='".$fetch[0]."' or NewPanelID='".$fetch[1]."')";
	//	echo $ab."<br>";
	    }
		else if($fetch[1]!='-')
			$ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone,Bank from sites where live='Y' and NewPanelID='".$fetch[1]."'";
		else
		    $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Zone,Bank from sites where live='Y' and OLDPanelID='".$fetch[0]."'";
        $runab=mysqli_query($conn,$ab);
		$numrow=mysqli_num_rows($runab);
		
        $fetch2=mysqli_fetch_array($runab);
		
		//echo "Site -". $numrow."-".$fetch2['atmid']."<br>";
		
	$q="select max(rtime) from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."')";
		//echo $sq;
		$runq=mysqli_query($conn,$q);
		//$fet2rows=mysqli_num_rows($runq);
		
		$fet2=mysqli_fetch_array($runq);
		
		//$timestamp = $row['createtime'];
$splitTimeStamp = explode(" ",$fet2[0]);
$date = $splitTimeStamp[0];
//$time = $splitTimeStamp[1];
	$sr++;
	    $bmname="select CSSBM,CSSBMNumber from esurvsites where ATM_ID='".$fetch2[1]."'";
		$runbmname=mysqli_query($conn,$bmname);
		$bmfetch=mysqli_fetch_array($runbmname);
     ?>
	
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2[0];?></td>
    <td><?php echo $fetch2['Bank'];?></td>
    <td><?php echo $fetch2[1];?></td>
    <td><?php echo $fetch2[2];?></td>
	<td><?php echo $fetch2[3];;?></td>
    <td><?php echo $fetch2[4];?></td>
    <td><?php echo $fetch2[5];?></td>
	<td><?php echo $fetch2[6];?></td>
	<td><?php echo $fetch2[11];?></td>
    <td><?php echo $fetch2[7];?></td>
    <td><?php echo $fetch2[8];?></td>
	<?php if($fet2[0]!=""){ ?>
    <td><?php echo $date;?></td>
	<?php }else{?>
   <td><?php echo $blanck_date;?></td>
   <?php }?>
    <td><?php echo $bmfetch[0];?></td>
	<td><?php echo $bmfetch[1];?></td>
	<td><?php echo $fetch2[12];?></td>
</tr>
<?php

     
	
     }
	// $abs=$sr++;
	// $absf=$abs -1;
	 ?><div align="center">total records:<?php echo $sr.'  Skipped -'.$test;?></div>  <?php
}
	
elseif($comm=="0"){
	$sp="select oldpanelid,newpanelid from sites where live='Y' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";;
	//echo $sp;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
    <!--<div align="center">total records:<?php echo $Num_Rows?></div>-->
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$altfetch[0]."' and '".$altlastfetch[0]."'";
		
		$runsq=mysqli_query($conn,$sq);
		//if(mysqli_num_rows($runsq)>0){ continue; }
	   // $fetch3=mysqli_fetch_array($runsq);
		//$s= substr($fetch3[0], 1);
		
        $ab="select Customer,atmid,ATMShortName,City,state,panel_make,OLDPanelid,dvrip,dvrname,username,password,NewPanelID,Bank from sites where live='Y'  and DVRIP='".$fetch[0]."'";
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
    <td><?php echo $fetch2[0];?></td>
    <td><?php echo $fetch2['Bank'];?></td>
    <td><?php echo $fetch2[1];?></td>
    <td><?php echo $fetch2[2];?></td>
	<td><?php echo $fetch2[3];;?></td>
    <td><?php echo $fetch2[4];?></td>
    <td><?php echo $fetch2[5];?></td>
	<td><?php echo $fetch2[6];?></td>
	<td><?php echo $fetch2[11];?></td>
    <td><?php echo $fetch2[7];?></td>
    <td><?php echo $fetch2[8];?></td>
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
		
    /*
     $sp="select distinct(ip) from wsites where rtime NOT between '".$pre_date. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
  // echo $sp;
    $rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
     while($fetch=mysqli_fetch_array($rst)){
        
       $s= substr($fetch[0], 1);  
		 	
        $ab="select Customer,atmid,ATMShortName,state,panel_make,OLDPanelid,dvrip,dvrname,username,password from sites where live='Y'  and dvrip='".$s."'";
        //echo $ab;
        $runab=mysqli_query($conn,$ab);
        $fetch2=mysqli_fetch_array($runab);
		
		$sq="select max(rtime) from wsites where ip='".$fetch[0]."'";
		$runsq=mysqli_query($conn,$sq);
		$fetch3=mysqli_fetch_array($runsq);
		
		
     ?>
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2["Customer"];?></td>
    <td><?php echo $fetch2["atmid"];?></td>
    <td><?php echo $fetch2["ATMShortName"];?></td>
    <td><?php echo $fetch2["state"];?></td>
    <td><?php echo $fetch2["panel_make"];?></td>
	 <td><?php echo $fetch2["OLDPanelid"];?></td>
    <td><?php echo $fetch2["dvrip"];?></td>
    <td><?php echo $fetch2["dvrname"];?></td>
    <td><?php echo $fetch3[0];?></td>
   
    </tr>
<?php  
$sr++;
}
}
*/
elseif($comm=="3"){
   $sp="select oldpanelid,newpanelid from sites where live='Y' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
  
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$pre_date2. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
		
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
   
   
    
    /*
     $sp="select distinct(ip) from wsites where rtime NOT between '".$pre_date2. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
    //echo $sp;
    $rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
     while($fetch=mysqli_fetch_array($rst)){
        
       $s= substr($fetch[0], 1);  
		 	
        $ab="select Customer,atmid,ATMShortName,state,panel_make,OLDPanelid,dvrip,dvrname,username,password from sites where live='Y'  and dvrip='".$s."'";
        //echo $ab;
        $runab=mysqli_query($conn,$ab);
        $fetch2=mysqli_fetch_array($runab);
		
		$sq="select max(rtime) from wsites where ip='".$fetch[0]."'";
		$runsq=mysqli_query($conn,$sq);
		$fetch3=mysqli_fetch_array($runsq);
		
		
     ?>
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2["Customer"];?></td>
    <td><?php echo $fetch2["atmid"];?></td>
    <td><?php echo $fetch2["ATMShortName"];?></td>
    <td><?php echo $fetch2["state"];?></td>
    <td><?php echo $fetch2["panel_make"];?></td>
	 <td><?php echo $fetch2["OLDPanelid"];?></td>
    <td><?php echo $fetch2["dvrip"];?></td>
    <td><?php echo $fetch2["dvrname"];?></td>
    <td><?php echo $fetch3[0];?></td>
   
    </tr>
<?php 
$sr++;
}
}
*/
elseif($comm=="4"){
    $sp="select oldpanelid,newpanelid from sites where live='Y' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";;
	$rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);
	
	?>
  
    <?php
     while($fetch=mysqli_fetch_array($rst)){
	
	$sq="select ip,rtime from wsites where (panelid='".$fetch[0]."' or panelid='".$fetch[1]."') and rtime between '".$pre_date7. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
		
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
    
    /*
     $sp="select distinct(ip) from wsites where rtime  not between '".$pre_date7. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
    //echo $sp;
    $rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
     while($fetch=mysqli_fetch_array($rst)){
        
        $s= substr($fetch[0], 1);  
		 	
        $ab="select Customer,atmid,ATMShortName,state,panel_make,OLDPanelid,dvrip,dvrname,username,password from sites where live='Y'  and dvrip='".$s."'";
        //echo $ab;
        $runab=mysqli_query($conn,$ab);
        $fetch2=mysqli_fetch_array($runab);
		
		$sq="select max(rtime) from wsites where ip='".$fetch[0]."'";
		$runsq=mysqli_query($conn,$sq);
		$fetch3=mysqli_fetch_array($runsq);
		
		
     ?>
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2["Customer"];?></td>
    <td><?php echo $fetch2["atmid"];?></td>
    <td><?php echo $fetch2["ATMShortName"];?></td>
    <td><?php echo $fetch2["state"];?></td>
    <td><?php echo $fetch2["panel_make"];?></td>
	 <td><?php echo $fetch2["OLDPanelid"];?></td>
    <td><?php echo $fetch2["dvrip"];?></td>
    <td><?php echo $fetch2["dvrname"];?></td>
    <td><?php echo $fetch3[0];?></td>
   
    </tr>
<?php  
$sr++;
}
}
*/
elseif($comm=="5"){
    $sp="select oldpanelid,newpanelid from sites where live='Y' and DVRName in('Dahuva','UNV','Hikvision_Nvr')";;
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
    
    /*
     $sp="select distinct(ip) from wsites where rtime not between '".$pre_date15. " 00:00:00" ."' and '".$currtime. " 23:59:59" ."'";
    //echo $sp;
    $rst=mysqli_query($conn,$sp);
    $Num_Rows=mysqli_num_rows($rst);?>
    <div align="center">total records:<?php echo $Num_Rows?></div>
    <?php
     while($fetch=mysqli_fetch_array($rst)){
        
        $s= substr($fetch[0], 1);  
		 	
        $ab="select Customer,atmid,ATMShortName,state,panel_make,OLDPanelid,dvrip,dvrname,username,password from sites where live='Y'  and dvrip='".$s."'";
        //echo $ab;
        $runab=mysqli_query($conn,$ab);
        $fetch2=mysqli_fetch_array($runab);
		
		$sq="select max(rtime) from wsites where ip='".$fetch[0]."'";
		$runsq=mysqli_query($conn,$sq);
		$fetch3=mysqli_fetch_array($runsq);
		
		
     ?>
     <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $fetch2["Customer"];?></td>
    <td><?php echo $fetch2["atmid"];?></td>
    <td><?php echo $fetch2["ATMShortName"];?></td>
    <td><?php echo $fetch2["state"];?></td>
    <td><?php echo $fetch2["panel_make"];?></td>
	 <td><?php echo $fetch2["OLDPanelid"];?></td>
    <td><?php echo $fetch2["dvrip"];?></td>
    <td><?php echo $fetch2["dvrname"];?></td>
    <td><?php echo $fetch3[0];?></td>
   
    </tr>
<?php   
$sr++;
}
}
*/
?>
<?php
/*
$date2=date_create("2018-07-10 18:20:20");
$cat=implode(" ",$id);
$date2=date_create($cat);
$date1=date_create($currtime);

$diff=date_diff($date2,$date1);
echo $diff->format("%R%a");
$cat1=explode(" ",$cat);

*/
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








