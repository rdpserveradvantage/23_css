<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('MAX_EXECUTION_TIME', '-1');
set_time_limit(30000);    
include('config.php');

error_reporting(0);

//$viewalert=$_REQUEST['viewalert'];
$panelid=$_REQUEST['panelid'];
$ATMID=$_REQUEST['ATMID'];
$DVRIP=$_REQUEST['DVRIP'];
$compy=$_REQUEST['compy'];
$from=$_REQUEST['from'];
$to=$_REQUEST['to'];
$strPage=$_REQUEST['Page'];
$fix=670;


function get_sensor($zone){
    global $conn;
    $sql = mysqli_query($conn,"select SensorName from rass where ZONE like '".$zone."'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['SensorName'];

}
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

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
  



    // $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)";
   //echo $abc; 

    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('029','030') and b.alarm='AT' ";

    // $abc2="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid)";


    $abc2="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('001','002')and a.panel_make='SMART -I' and b.alarm='BA'";


//$result=mysqli_query($conn,$abc);

if($panelid!=""){
$abc.=" and b.panelid='".$panelid."'";
$abc2.=" and b.panelid='".$panelid."'";

}

if($ATMID!=""){
$abc.=" and a.ATMID='".$ATMID."'";
$abc2.=" and a.ATMID='".$ATMID."'";
}

if($DVRIP!=""){
$abc.=" and a.DVRIP='".$DVRIP."'";
$abc2.=" and a.DVRIP='".$DVRIP."'";
}
if($compy!=""){
$abc.=" and a.Customer='".$compy."'";
$abc2.=" and a.Customer='".$compy."'";
}


if($fromdt!="" && $todt!==""){
$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime ;";
$abc2.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime ;";
}
else if($fromdt!="")
{
    $abc.=" and b.receivedtime='".$fromdt."' order by createtime";
	$abc2.=" and b.receivedtime='".$fromdt."' order by createtime";
}
else if($todt!="")
{
$abc.=" and receivedtime='".$todt."' order by createtime";
$abc2.=" and receivedtime='".$todt."' order by createtime";
}
else
{
$fromdt=date('Y-m-d 00:00:00');
$todt=date('Y-m-d 23:59:59');

$abc.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime";
$abc2.=" and b.receivedtime between '".$fromdt."' and '".$todt."' order by createtime";
}




$result=mysqli_query($conn,$abc);
$result2=mysqli_query($conn,$abc2);
    
$Num_Rows1=mysqli_num_rows($result);
$Num_Rows2=mysqli_num_rows($result2);
$Num_Rows=$Num_Rows1+$Num_Rows2;



while($row = mysqli_fetch_array($result)) {


$Customer = $row['Customer'];
$Bank = $row['Bank'];
$ATMID = $row['ATMID'];
$ATMShortName = $row['ATMShortName'];
$SiteAddress = $row['SiteAddress'];
$DVRIP = $row['DVRIP'];
$Panel_make = $row['Panel_make'];
$zon = $row['zon'];
$City = $row['City'];
$State = $row['State'];
$id = $row['id'];
$panelid = $row['panelid'];
$createtime = $row['createtime']; 
$receivedtime = $row['receivedtime'];
$comment = $row['comment'];
$zone = $row['zone'];
$alarm = $row['alarm'];
$closedBy = $row['closedBy'];
$closedtime = $row['closedtime']; 

$sensor = get_sensor($zone);

    $timestamp = $row["createtime"];


$splitTimeStamp = explode(" ",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];

if($row["alarm"]=="AT" and $row["zone"]=="029"){

        $eb_powerfailure = $date . ' ' . $time ;
        $ups_power_available =  $date. ' ' .$time;

    $xyz="select createtime from alerts where panelid='".$row['panelid']."' and zone='029' and alarm='AR' and createtime>'".$row['createtime']."' order by createtime limit 1";
    $xyzresult=mysqli_query($conn,$xyz);
    $xyzfetch=mysqli_fetch_array($xyzresult);
    
}else { $xyzfetch[0]='-';
        $eb_powerfailure = '-' ;
        $ups_power_available =  '-';
     }
    if($row["alarm"]=="AT" and $row["zone"]=="030"){
        $ups_power_failure =  $date . ' ' .$time ;
    $xyz1="select createtime from alerts where panelid='".$row['panelid']."' and zone='030' and alarm='AR' and createtime>'".$row['createtime']."' order by createtime limit 1";

    $xyzresult1=mysqli_query($conn,$xyz1);
    $xyzfetch1=mysqli_fetch_array($xyzresult1);
    }else {
        $xyzfetch1[0]='-';
        $ups_power_failure =  '-' ;
        }

$ups_power_restore = $xyzfetch1[0]  ;  
$eb_power_availabel = $xyzfetch[0] ; 

$data[] = ['Customer'=>$Customer,'Bank'=>$Bank,'ATMID'=>$ATMID,'ATMShortName'=>$ATMShortName,'SiteAddress'=>$SiteAddress,'DVRIP'=>$DVRIP,'Panel_make'=>$Panel_make,'zon'=>$zon,'City'=>$City,'State'=>$State,'id'=>$id,'panelid'=>$panelid,'createtime'=>$createtime,'receivedtime'=>$receivedtime,'comment'=>$comment,'zone'=>$zone,'alarm'=>$alarm,'closedBy'=>$closedBy,'closedtime'=>$closedtime,'sensor'=>$sensor,'eb_powerfailure'=>$eb_powerfailure,'ups_power_available'=>$ups_power_available,'ups_power_failure'=>$ups_power_failure,'ups_power_restore'=>$ups_power_restore,'eb_power_availabel'=>$eb_power_availabel];

$sr++;

}


 while($row = mysqli_fetch_array($result2)) { 


$Customer = $row['Customer'];
$Bank = $row['Bank'];
$ATMID = $row['ATMID'];
$ATMShortName = $row['ATMShortName'];
$SiteAddress = $row['SiteAddress'];
$DVRIP = $row['DVRIP'];
$Panel_make = $row['Panel_make'];
$zon = $row['zon'];
$City = $row['City'];
$State = $row['State'];
$id = $row['id'];
$panelid = $row['panelid'];
$createtime = $row['createtime']; 
$receivedtime = $row['receivedtime'];
$comment = $row['comment'];
$zone = $row['zone'];
$alarm = $row['alarm'];
$closedBy = $row['closedBy'];
$closedtime = $row['closedtime']; 

$sensor = get_sensor($zone);

    $timestamp = $row["createtime"];

$splitTimeStamp = explode(" ",$timestamp);
$date = $splitTimeStamp[0];
$time = $splitTimeStamp[1];

if($row["alarm"]=="AT" and $row["zone"]=="029"){

        $eb_powerfailure = $date . ' ' . $time ;
        $ups_power_available =  $date. ' ' .$time;

    $xyz="select createtime from alerts where panelid='".$row['panelid']."' and zone='029' and alarm='AR' and createtime>'".$row['createtime']."' order by createtime limit 1";
    $xyzresult=mysqli_query($conn,$xyz);
    $xyzfetch=mysqli_fetch_array($xyzresult);
    
}else { $xyzfetch[0]='-';
        $eb_powerfailure = '-' ;
        $ups_power_available =  '-';
     }
    if($row["alarm"]=="AT" and $row["zone"]=="030"){
        $ups_power_failure =  $date . ' ' .$time ;
    $xyz1="select createtime from alerts where panelid='".$row['panelid']."' and zone='030' and alarm='AR' and createtime>'".$row['createtime']."' order by createtime limit 1";

    $xyzresult1=mysqli_query($conn,$xyz1);
    $xyzfetch1=mysqli_fetch_array($xyzresult1);
    }else {
        $xyzfetch1[0]='-';
        $ups_power_failure =  '-' ;
        }

$ups_power_restore = $xyzfetch1[0]  ;  
$eb_power_availabel = $xyzfetch[0] ; 


$data[] = ['Customer'=>$Customer,'Bank'=>$Bank,'ATMID'=>$ATMID,'ATMShortName'=>$ATMShortName,'SiteAddress'=>$SiteAddress,'DVRIP'=>$DVRIP,'Panel_make'=>$Panel_make,'zon'=>$zon,'City'=>$City,'State'=>$State,'id'=>$id,'panelid'=>$panelid,'createtime'=>$createtime,'receivedtime'=>$receivedtime,'comment'=>$comment,'zone'=>$zone,'alarm'=>$alarm,'closedBy'=>$closedBy,'closedtime'=>$closedtime,'sensor'=>$sensor,'eb_powerfailure'=>$eb_powerfailure,'ups_power_available'=>$ups_power_available,'ups_power_failure'=>$ups_power_failure,'ups_power_restore'=>$ups_power_restore,'eb_power_availabel'=>$eb_power_availabel];

$sr++;

}


$json = ['data'=>$data];

$data =  json_encode($json);

$myfile = fopen("search.json", "w") or die("Unable to open file!");
fwrite($myfile, $data);
fclose($myfile);

echo '1' ;


?>

