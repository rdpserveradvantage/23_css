<?php
include 'config.php';
//$sqlme="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C' and a.Customer='Diebold' and b.receivedtime between '2018-12-13' and '2018-12-14' order by receivedtime desc";
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;
$table=mysqli_query($conn,$sqlme);
//echo mysql_num_rows($table);

$contents='';
 $contents.="Customer \t Bank  \t ATMID \t ATMID_2 \t TrackerNo \t ATMShortName \t SiteAddress \t City \t State \t Zone \t Panel_Make \t OldPanelID \t NewPanelID \t DVRIP \t DVRName \t UserName \t Password \t live \t eng_name \t CSSBM \t CSSBMNumber \t BackofficerName \t BackofficerNumber \t HeadSupervisorName \t HeadSupervisorNumber \t SupervisorName \t Supervisornumber \t Police Number \t Police Station \t Atm Officer Name \t Atm Officer Number \t RA Name \t RA Number \t Installation date \t Site Add By \t Site Edit By \t \n";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_array($table))
{
$cnt++;
$sql1="select * from esurvsites where ATM_ID='".$row["ATMID"]."'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);
	 
     $contents.=$row["Customer"]."\t";
	 $contents.=$row["Bank"]."\t";
	 $contents.=$row["TrackerNo"]."\t";
	
	 $contents.=$row["ATMID"]."\t";
	 $contents.=$row["ATMID_2"]."\t";
	 $contents.=$row["ATMShortName"]."\t";
     $contents.=$row["SiteAddress"]."\t";
	
      $contents.=$row["City"]."\t";
      $contents.=$row["State"]."\t";
	  
	  $contents.=$row["Zone"]."\t";
	  $contents.=$row["Panel_Make"]."\t";
	  $contents.=$row["OldPanelID"]."\t";
      $contents.=$row["NewPanelID"]."\t";
	
	 $contents.=$row["DVRIP"]."\t";
	 $contents.=$row["DVRName"]."\t";
	 
	 $contents.=$row["UserName"]."\t";
	 $contents.=$row["Password"]."\t";
	 $contents.=$row["live"]."\t";
	 $contents.=$row["eng_name"]."\t";
	 
	 
	 $contents.=$row1["CSSBM"]."\t";
	 $contents.=$row1["CSSBMNumber"]."\t";
	 $contents.=$row1["BackofficerName"]."\t";
	 $contents.=$row1["BackofficerNumber"]."\t";
	 $contents.=$row1["HeadSupervisorName"]."\t";
	 
	 $contents.=$row1["HeadSupervisorNumber"]."\t";
	 $contents.=$row1["SupervisorName"]."\t";
	 $contents.=$row1["Supervisornumber"]."\t";
	 $contents.=$row1["Policestation"]."\t";
	 $contents.=$row1["Polstnname"]."\t";
	 
	 $contents.=$row1["atm_officer_name"]."\t";
	 $contents.=$row1["atm_officer_number"]."\t";
	 $contents.=$row1["RA_QRT_NAME"]."\t";
	 $contents.=$row1["RA_QRT_NUMBER"]."\t";
	 
	 $contents.=$row["current_dt"]."\t";
	 $contents.=$row["addedby"]."\t";
	 $contents.=$row["editby"]."\t"."\n";
} 
     
 //$contents.="\t";
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=site.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>