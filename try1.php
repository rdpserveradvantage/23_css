<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
$comm=$_POST['comm'];
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$fix=30;
            if($from!="")
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

 $sr=1;
 $numrow=0;
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
	background-color:#283E56; 
	color:#fff;
	font-size:12px;
}
</style>



 
  <table border=1 style="margin-top:30px">
  <tr>
  <th>sr</th>
      <th>Customer</th>
      <th>Bank</th>
      <th>ATMID</th>
      <th>ATMShortName</th>
      <th>SiteAddress</th>
      <th>State</th>
      <th>DVRIP</th>
      <th>Panel_make</th>
       <th>Alert Type</th>
	  <th>Last alert Receive</th>
	 
  </tr>
 
 <?php
 //==============================================
 
 $today_start = date('Y-m-d 00:00:00');
$today_end = date('Y-m-d 23:59:59');

 $abc1="select Customer,Bank,ATMID,ATMShortName,SiteAddress,DVRIP,live,OldPanelID,NewPanelID,Panel_make,State from sites where live='Y'";
 $result=mysqli_query($conn,$abc1);
 while($row = mysqli_fetch_array($result)) {  
  
  if($comm==1 || $comm==""){
    $lastCom= "select max(id), max(receivedtime),panelid from alerts where 1=1";
}

if($comm==2 ){
    $lastCom= "select id,receivedtime,panelid from alerts where 1=1";
}


   if($fromdt!="" && $todt!="" )
    {
      $lastCom.=" and receivedtime between '".$fromdt." 00:00:00"."' and '".$todt." 23:59:59"."' and ( panelid='".$row['OldPanelID']."' or panelid='".$row['NewPanelID']."')";
    }
     else{
         if($comm==1 || $comm==""){
         $lastCom.= " and  receivedtime between '".$today_start."' and '".$today_end."' and ( panelid='".$row['OldPanelID']."' or panelid='".$row['NewPanelID']."')  ";
         }
       elseif ($comm==2 )
       {
          $lastCom.= " and  ( panelid='".$row['OldPanelID']."' or panelid='".$row['NewPanelID']."')  ";
       
       }
       
     }
     
   $lastC= mysqli_query($conn,$lastCom);
    $fetlast=mysqli_fetch_array($lastC);
    
    
     if($fetlast['panelid']!="")
     {
         $lt=$fetlast['panelid'];
         
     }
     
     
     $abc2="select Customer,Bank,ATMID,ATMShortName,SiteAddress,DVRIP,live,OldPanelID,NewPanelID,Panel_make,State from sites where live='Y' and ( OldPanelID='".$lt."' or NewPanelID='".$lt."') ";
      //echo $abc2;
      $result2=mysqli_query($conn,$abc2);
      $row2 = mysqli_fetch_array($result2);
      $Num_Rows=mysqli_num_rows($result2);
      
      if($row2['OldPanelID']!="" || $row2['NewPanelID']!="")
      {
      
if($comm==1 || $comm==""){
    $lastCom1= "select max(id), max(receivedtime),panelid from alerts where 1=1";
}


if($comm==2){
    $lastCom1= "select id,receivedtime,panelid from alerts where 1=1";
}

   if($fromdt!="" && $todt!="" )
    {
      $lastCom1.=" and receivedtime between '".$fromdt." 00:00:00"."' and '".$todt." 23:59:59"."' and ( panelid='".$row2['OldPanelID']."' or panelid='".$row2['NewPanelID']."')";
    }
  else{ 
       if($comm==1 || $comm==""){
      $lastCom1.= " and  receivedtime between '".$today_start."' and '".$today_end."' and ( panelid='".$row2['OldPanelID']."' or panelid='".$row2['NewPanelID']."')  ";
       }
       elseif ($comm==2 )
       {
          $lastCom1.= " and  ( panelid='".$row2['OldPanelID']."' or panelid='".$row2['NewPanelID']."')  ";
       
       }
       
     }
  // echo $lastCom1;
   $lastCo= mysqli_query($conn,$lastCom1);
    $fetlast1=mysqli_fetch_array($lastCo);
    
     if($fetlast1[0]!=""){
    
     $q= mysqli_query($conn,"select zone,receivedtime from alerts where  id='".$fetlast1[0]."'  ");
          $fetch= mysqli_fetch_array($q);
     }
     
          if($fetch[0]!=""){
          
          
     if(strpos($row2["Panel_make"], 'SMART') !== FALSE)
    {
      $sql1="select Description,Camera from smartialarms where (Zone='".$fetch[0]."')";
    }
	 else if($row2["Panel_make"]=="RASS")
	{
	 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$fetch[0]."')"; 
	}
    	$result3=mysqli_query($conn,$sql1);
	$row3 = mysqli_fetch_array($result3); }
 ?>
 
 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $row2["Customer"];?></td>
    <td><?php echo $row2["Bank"];?></td>
    <td><?php echo $row2["ATMID"];?></td>
    <td><?php echo $row2["ATMShortName"];?></td>
    <td><?php echo $row2["SiteAddress"];?></td>
      <td><?php echo $row2["State"];?></td>
    <td><?php echo $row2["DVRIP"];?></td>
    
    <td><?php echo $row2["Panel_make"];?></td>	
    <td><?php echo $row3[0]; ?></td>
    
    <td><?php echo $fetlast1[1];?></td>
 </tr>
<?php  $sr++; $numrow++; } } ?>
<div align="center"><?php echo "Total Record :". $numrow; ?></div>
 <!--==============================================-->
 


 


</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>








