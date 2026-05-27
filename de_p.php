<?php session_start();
if(1==1)
{
// set_time_limit(1200);    
include 'config.php';

//$viewalert=$_POST['viewalert'];
$panelid=$_POST['panelid'];
$ATMID=$_POST['ATMID'];
$DVRIP=$_POST['DVRIP'];
$compy=$_POST['compy'];
$from=$_POST['from'];
$to=$_POST['to'];
$strPage=$_POST['Page'];
$fix=670;

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
  



    $abc="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('029','030') and b.alarm='AT' ";
   echo $abc; 

    $abc2="SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE (a.OldPanelID=b.panelid or a.NewPanelID=b.panelid) and b.zone IN ('001','002')and a.panel_make='SMART -I' and b.alarm='BA'";


   echo $abc2; 
