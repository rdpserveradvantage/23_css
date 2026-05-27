<?php
include 'config.php';
 
$stmt=mysql_query("SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'");

 
 
$columnHeader ='';
$columnHeader = "Sr NO"."\t"."Book Name"."\t"."Book Author"."\t"."Book ISBN"."\t";
 
 
$setData='';
 
while($rec =mysql_fetch_assoc($stmt))
{
  $rowData = '';
  foreach($rec as $value)
  {
    $value = '"' . $value . '"' . "\t";
    $rowData .= $value;
  }
  $setData .= trim($rowData)."\n";
}
 
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Book record sheet.xls");
header("Pragma: no-cache");
header("Expires: 0");
 
echo ucwords($columnHeader)."\n".$setData."\n";
 
?>