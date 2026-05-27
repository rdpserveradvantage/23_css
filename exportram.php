<?php
include 'config.php';
//$sqlme="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C' and a.Customer='Diebold' and b.receivedtime between '2018-12-13' and '2018-12-14' order by receivedtime desc";
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;
$table=mysqli_query($conn,$sqlme);
//echo mysql_num_rows($table);
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}
$contents='';
 $contents.="Client Name \t Incident Number \t Region \t Circle \t Location \t ATMID \t Address \t Incident Category \t Alarm Message \t Incident Date Time \t Alarm Received Date Time \t Close Date Time \t DVRIP \t Panel_make \t panelid \t Bank \t Reactive \t Closed By \t Closed Date \t Remark \t\n";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_array($table))
{
$cnt++;

	 
     $contents.=$row["Customer"]."\t";
	 $contents.=$row["id"]."\t";
	 $contents.=$row["zon"]."\t";
	
	 $contents.=$row["City"].",".$row["State"]."\t";
	 $contents.=$row["ATMShortName"]."\t";
	 $contents.=$row["ATMID"]."\t";
         $contents.=$row["SiteAddress"]."\t";
	$dtconvt=$row["receivedtime"];
	 $timestamp = strtotime($dtconvt);
$newDate = date('d-F-Y', $timestamp); 

if(strpos($row["Panel_make"], 'SMART') !== FALSE)
    {
    
$sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";

    }
	 else
	{
		
		 $sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
	
	}
	$result1=mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_array($result1);
	 
	 $contents.=$row1["Description"]."\t";
	if(endsWith($row["alarm"], "R")){$contents.=$row1["Description"].' Restoral'."\t";
	
	}else {$contents.=$row1["Description"]."\t";}
      $contents.=$row["createtime"]."\t";
      $contents.=$row["receivedtime"]."\t";
	  $contents.=$newDate."\t";
	  $contents.=$row["DVRIP"]."\t";
	  $contents.=$row["Panel_make"]."\t";
	  $contents.=$row["panelid"]."\t";
      $contents.=$row["Bank"]."\t";
	  
	  if(endsWith($row["alarm"], "R")){$contents.= 'Non-Reactive'."\t";
	  //if(($row["alarm"]=="AR"))$contents.= 'Non-Reactive';
	  }else {$contents.= 'Reactive'."\t";}
     
	 $contents.=$row["closedBy"]."\t";
	 $contents.=$row["closedtime"]."\t";
     $contents.=$row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"]."\n";
	}
 
 //$contents.="\t";
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>