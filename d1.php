<?php  include('config.php');

ini_set('memory_limit','-1');

ini_set('max_execution_time', '0'); // for infinite time of execution 



function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}




if(isset($_REQUEST['viewalert'])){
	$viewalert=$_REQUEST['viewalert']; 
}

if($viewalert=="" || $viewalert ==3){

$abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='C'";
}
else if($viewalert ==1)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) ";
    
}
else if($viewalert ==2)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.`status`='O' ";
    
}
else if($viewalert ==4)
{
      $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('014') ";
  
}
else if($viewalert ==5)
{
    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('001','002','018') ";
}





if(isset($_REQUEST['panelid'])){
	$panelid=$_REQUEST['panelid'];
	 }
if(isset($_REQUEST['ATMID'])){
	$ATMID=$_REQUEST['ATMID'];
 }
if(isset($_REQUEST['DVRIP'])){
	$DVRIP=$_REQUEST['DVRIP']; 
}
if(isset($_REQUEST['compy'])){
	$compy=$_REQUEST['compy'];
 }




if(isset($_REQUEST['from'])){
	$from=$_REQUEST['from'];

	if($from!="")
            {
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
	 }            else
            {
                $fromdt="";
            }





if(isset($_REQUEST['to'])){
	$to=$_REQUEST['to'];
	   if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }
              }else
                {
                   $todt=""; 
                }




if(isset($_REQUEST['Page'])){
	$strPage=$_REQUEST['Page']; 
}
// $fix=670;
 $sr=1;
 
 if($panelid!=""){
$abc.=" and b.panelid='".$panelid."'";
}

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
}
if($compy!=""){
$abc.=" and a.Customer='".$compy."'";
}


if($fromdt!="" && $todt!=""){
$abc.=" and b.receivedtime between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by receivedtime ASC;";

}
else if($fromdt!="")
{
    $abc.=" and b.receivedtime='".$fromdt."'";
}
else if($todt!="")
{
$abc.=" and receivedtime='".$todt."'";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."'";
}



// echo $abc ; 
// return;

$result=mysqli_query($conn,$abc);

$contents ='' ;
$contents .= "Sn No. \t customer  \t id  \t zon  \t ATMID  \t SiteAddress  \t City  \t State ,  \t Description  \t Description_R  \t createtime  \t receivedtime  \t newDate  \t DVRIP  \t Panel_make  \t panelid  \t bank  \t row_alarm_r  \t closedBy  \t closedtime  \t remark  \t zone  \t alarm \t";

$i=1 ; 

while($row = mysqli_fetch_assoc($result)){
    
 $Customer = $row["Customer"];
 $id = $row["id"];
 $zon = $row["zon"];
 $ATMID = $row["ATMID"];
 $SiteAddress = $row["SiteAddress"];
 $SiteAddress = str_replace('"',"",$SiteAddress);

 $City = $row["City"];
 $State = $row["State"];


$dtconvt=$row["receivedtime"];
$timestamp = strtotime($dtconvt);
$newDate = date('d-F-Y', $timestamp); 

if(strpos($row["Panel_make"], 'SMART') !== FALSE)
{

$sql1="select Description,Camera from smartialarms where (Zone='".$row["zone"]."')";

}
else if(strpos($row["Panel_make"], 'SEC') !== FALSE)
{

$sql1="select sensorname as Description,camera from securico where (Zone='".$row["zone"]."')";

}

else
{
$sql1="select Description,Camera from zonecameras where (ZoneNo='".$row["zone"]."')"; 
}
$result1=mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($result1);

$Description = $row1["Description"];



if(endsWith($row["alarm"], "R"))
{ 
	$Description_R  = $row1["Description"].' Restoral';}
else {
	$Description_R =  $row1["Description"];	
} 


$createtime = $row["createtime"];
// $createtime = date("m/d/Y h:i:s A", strtotime($createtime));

$receivedtime = $row["receivedtime"];
 $newDate;
$DVRIP  = $row["DVRIP"];
$Panel_make  = $row["Panel_make"];	
$panelid  = $row["panelid"];
$Bank  = $row["Bank"];

 if(endsWith($row["alarm"], "R")){
 	$row_alarm_r = 'Non-Reactive'; }
else{
		$row_alarm_r =  'Reactive';	
} 



$closedBy = $row["closedBy"];
$closedtime = $row["closedtime"];
$remark = $row["closedtime"].'*'.$row["comment"].'*'.$row["closedBy"];

$remark = str_replace('"',"",$remark);
$zone = $row["zone"];
$alarm = $row["alarm"];









$contents .= "\n" . $i . "\t";
$contents .= trim($Customer) . "\t";
$contents .= trim($id) ."\t";
$contents .= trim($zon) ."\t";
$contents .= trim($ATMID) ."\t";
$contents .= trim($SiteAddress) ."\t";
$contents .= trim($City) ."\t";
$contents .= trim($State) ."\t" ; 
$contents .= trim($Description) ."\t";
$contents .= trim($Description_R) ."\t";
$contents .= trim($createtime) ."\t";
$contents .= trim($receivedtime) ."\t";
$contents .= trim($newDate) ."\t";
$contents .= trim($DVRIP) ."\t";
$contents .= trim($Panel_make) ."\t";
$contents .= trim($panelid) ."\t";
$contents .= trim($Bank) ."\t";
$contents .= trim($row_alarm_r) ."\t";
$contents .= trim($closedBy) ."\t";
$contents .= trim($closedtime) ."\t";
$contents .= trim($remark) ."\t";
$contents .= trim($zone) ."\t";
$contents .= trim($alarm)."\t" ;

$i++ ;
}




$contents = strip_tags($contents);

header("Content-Disposition: attachment; filename=mis.xls");
header("Content-Type: application/vnd.ms-excel");
print $contents;
 ?>
